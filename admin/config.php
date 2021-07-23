<?php

/****************************************************************************
**
** Project:      PSPInstaller - RepoPrep
** File:         /admin/config.php
** Version:      2010-01-20; 1.0.5.8
** Author:       Michel van den Brink (Just Like Ed.net)
** Decription:   
**
****************************************************************************/

define('ROOT', '../');
require ROOT . 'include/common-admin.php';

define('CURRENT_PAGE', PAGE_CONFIG);

$action = isset($_POST['act']) ? trim(strtolower($_POST['act'])) : false;

$default_action = '';
$sectionpage = '';
$sectioninput = isset($_GET['section']) ? trim(strtolower($_GET['section'])) : (isset($_POST['section']) ? trim(strtolower($_POST['section'])) : '');

if (isset($_GET['forfeitkey']) && $_GET['forfeitkey'] == config('Reg_ApiKey')) {
	config('Reg_ApiKey','');
	config('Reg_Status',SYS_NOTREGISTERED);
	addMessage('success','Your registration key has been unregistered.<div style="font-weight:normal;">Please re-register your RepoPrep with the Master List.</div>');
	$sectioninput = 'registration';
}

switch($sectioninput) {
	case 'account':
		$sectionpage = 'account';
		
		if ($action == 'changeaccount') {
			
			if (isset($_POST['nu'], $_POST['np1'], $_POST['np2'], $_POST['cp'])) {
				
				$username = trim($_POST['nu']);
				$np1 = trim($_POST['np1']);
				
				$password1 = encrypt($_POST['np1']);
				$password2 = encrypt($_POST['np2']);
				$currentpassword = encrypt($_POST['cp']);
							
				if (empty($username)) {
					addMessage('error', 'Please provide a new username.');
					
				} else if (empty($password1)) {
					addMessage('error', 'Please provide a new password.');
					
				} else if ($password1 != $password2) {
					addMessage('error', 'The new passwords do not match.');
					
				} else if ($currentpassword != config('Admin_Password')) {
					addMessage('error', 'The administrator password is invalid.');
					
				} else {
					
					config('Admin_Username', $username);
					config('Admin_Password', $password1);
					
					session_destroy();
					die('<div style="font-family:Arial;font-size:10pt;color:#000;"><h1>Administrator account change</h1><p>The administrator username and password have been changed.</p><p>You will have to <a href="login.php" style="color:#008;">log in</a> again, using the new username and password.</p><p style="color:#444;font-size:8pt;margin-top:10px;">PSPInstaller - RepoPrep</p></div>');
					
				}
				
			} else {
				addMessage('error', 'Incomplete post data.');
			}
			
			loadConfig($db);
		} else {
			
			$username = config('Admin_UserName');
			
		}
		
		break;
	case 'registration':
		$sectionpage = 'registration';
		$is_registered = false;
		
		$lastRegSynch = lastregsynch();
		$systemStatusFlag = systemstatus();
		$is_registered = $systemStatusFlag != SYS_NOTREGISTERED;
		
		if ($action == 'finishregistration' || $action == 'changeregistration') {
			
			if (isset($_POST['name'], $_POST['description'], $_POST['contact'], $_POST['url'], $_POST['cp'])) {
				
				$new_name = trim($_POST['name']);
				$new_description = trim($_POST['description']);
				$new_contact = trim($_POST['contact']);
				$new_url = trim($_POST['url']);
				
				if (empty($new_name)) {
					addMessage('error','Please provide a name for your Repo.');
				} else if (empty($new_description)) {
					addMessage('error','Please provide a short description for your Repo.');
				} else if (empty($new_contact)) {
					addMessage('error','Please provide a contact email address for your Repo.');
				} else if (empty($new_url)) {
					addMessage('error','Please provide the installation URL for your Repo.');
				} else if ( encrypt($_POST['cp']) != config('Admin_Password') ) {
					addMessage('error','The administrator password is invalid.');
				} else {
					
					$master = new MasterAPI();
					if ($master->Authenticate() !== API_INVALID) {
						if ($master->UpdateRegistration($new_name, $new_description, $new_contact, $new_url) !== API_INVALID) {
							
							TriggerUpdate();
							addMessage('success','Your registration has been sent to the Master List.<br />Your system status will be set to Pending Approval while the PSPInstaller team reviews your registration.');
							
							config('Reg_Status', SYS_PENDING);
							config('Reg_Name', $new_name);
							config('Reg_Description', $new_description);
							config('Reg_Contact', $new_contact);
							config('URL', $new_url);
							$reg_url = $new_url;
							
							loadConfig($db);
							$lastRegSynch = time();
							
							$systemStatusFlag = SYS_PENDING;
							$is_registered = true;
							
							
						} else {
							masterApiError('0x63');
						}
					} else {
						if ($master->IsKeyDenied()) {
							addMessage('error', sprintf('Invalid registration key for the Master List.<div style="font-weight:normal;">Each RepoPrep registration has a unique registration key. This RepoPrep\'s key is not be recognized by the Master List. Try one of these options:<ul><li>Contact the <a href="%s" target="_blank">PSPInstaller team</a>, and tell them about this error. Be sure to include your registration key (your key: &quot;<code>%s</code>&quot;) and the URL of your RepoPrep installation.</li><li>Unregister your current registration key, and start over with a new one. If this RepoPrep was previously registered with the Master List, that previous registration will be lost. <a href="#forfeitkey=%s" class="forfeitkey">Click here to unregister</a>.</li></ul></div>', WEBSITE, config('Reg_ApiKey'), config('Reg_ApiKey')));
						} else {
							masterApiError('0x62');
						}
					}
	
							
				}
			} else {
				addMessage('error', 'Incomplete post data.');
			}
		
		} else {
			
			$new_name = $reg_name;
			$new_description = config('Reg_Description');
			$new_contact = config('Reg_Contact');
			$new_url = str_replace('\\', '/', sprintf('%s://%s%s', (is_ssl() ? 'https' : 'http'), $_SERVER['HTTP_HOST'], substr(dirname($_SERVER['REQUEST_URI']),0,-5)));
		
			if ($is_registered) {
				$master = new MasterAPI();
				if ($master->RequireSynch()) {
					if ($master->Authenticate() !== API_INVALID) {
						$newStatusUpdate = $master->CheckStatus();
						if ($newStatusUpdate !== API_INVALID) {
							$systemStatusFlag = $newStatusUpdate;
							$lastRegSynch = time();
						} else {
							masterApiError();
						}
					} else {
						masterApiError();
					}
				}
			}
	
		
		}
		
		$reg_status = sprintf('<span class="%s">%s</span>', classSystemStatus($systemStatusFlag), friendlySystemStatus($systemStatusFlag));
		$reg_lastsynch = !empty($lastRegSynch) && is_numeric($lastRegSynch) ? sprintf('%s at %s', locDate($lastRegSynch), locTime($lastRegSynch)) : 'Never';
		
		if ($is_registered) {
			$lbl_regname = 'New repo name';
			$lbl_regdescription = 'New repo description';
			$lbl_regcontact = 'New contact email address';
			$lbl_regurl = 'New installation URL';
			
			$newstuff_style = ' style="display:none;" ';
			$change_style = '';
			$default_action = '';
			$savebutton = 'Send changes to Master List';
		} else {
			$lbl_regname = 'Repo name';
			$lbl_regdescription = 'Repo description';
			$lbl_regcontact = 'Contact email address';
			$lbl_regurl = 'Installation URL';
			
			$newstuff_style = '';
			$change_style = ' style="display:none;" ';
			$default_action = 'finishregistration';
			$savebutton = 'Send registration to Master List';

		}
		
		$newstuff_style = $savebutton_style = $is_registered ? ' style="display:none;" ' : '';
		$change_style = !$is_registered ? ' style="display:none;" ' : '';
		$default_action = !$is_registered ? 'finishregistration' : '';
		$savebutton = $is_registered ? 'Send changes to Master List' : 'Send registration to Master List';
		
		break;
	default:
		$sectionpage = false;
		
		$can_max_upload = (file_exists(sprintf('%s.htaccess', ROOT)) && is_writable(sprintf('%s.htaccess', ROOT))) || (!file_exists(sprintf('%s.htaccess', ROOT)) && is_writable(ROOT));
		$default_action = 'changeconfig';
		
		if ($action == 'changeconfig') {
			
			if (isset($_POST['name'], $_POST['welcometext'], $_POST['dateformat'], $_POST['dateshortformat'], $_POST['timeformat'], $_POST['numberformat'])) {		
			
				$normalname = trim($_POST['name']);
				$welcometext = trim($_POST['welcometext']);
				$local_numberformat = $_POST['numberformat'];
				$local_timeformat = $_POST['timeformat'];
				$local_datetypeformat = $_POST['dateshortformat'];
				$local_dateformat =$_POST['dateformat'];
				$upload_enabled = (isset($_POST['upload']) && $_POST['upload'] == '1') ? ' checked="checked" ' : '';
				if ($can_max_upload && isset($_POST['maxupload'])) {
					$max_upload = $_POST['maxupload'];
				} else {
					$max_upload = getMaxUpload();
				}
							
				if (empty($normalname)) {
					addMessage('error', 'Please provide a title for the upload panel.');
				} else if (!is_numeric($max_upload) || floor($max_upload) != $max_upload) {
					addMessage('error', 'Please provide a valid round (integer) number for the maximum upload size.');
				} else {	
				
					config('Upload_Title', $normalname);
					config('Upload_Text', $welcometext);
					config('Upload_Enabled', empty($upload_enabled) ? '0' : '1');
					config('Local_NumberFormat', $local_numberformat);
					config('Local_TimeFormat', $local_timeformat);
					config('Loc_DateTypeFormat', $local_datetypeformat);
					config('Local_DateFormat', $local_dateformat);
					
					if ($can_max_upload && isset($_POST['maxupload']) && $max_upload != getMaxUpload()) {
						
						$htaccess = sprintf('%s.htaccess', ROOT);
						$htaccess_content = file_exists($htaccess) ? @file_get_contents($htaccess) : '';
						$htaccess_content_new = $htaccess_content;
						$htaccess_lines = explode("\n", $htaccess_content);
						if (is_array($htaccess_lines) && sizeof($htaccess_lines) != 0) {
							$done1 = false;
							$done2 = false;
							$i = 0;
							for($i = 0; $i < sizeof($htaccess_lines); $i++) {
								$tline = str_replace("\r",'',trim($htaccess_lines[$i]));
								if ( !$done1 && ct($tline, 'php_value upload_max_filesize') ) {
									$done1 = true;
									$htaccess_lines[$i] = 'php_value upload_max_filesize ' . $max_upload . 'M';
									
								} else if ( !$done2 && ct($tline, 'php_value post_max_size') ) {
									$done2 = true;
									$htaccess_lines[$i] = 'php_value post_max_size ' . ($max_upload*1.5) . 'M';
								}
							}
							if (!$done1 || !$done2) $htaccess_lines[] = '# BEGIN - PSPInstaller RepoPrep Settings';
							if (!$done1) $htaccess_lines[] = 'php_value upload_max_filesize ' . $max_upload . 'M';
							if (!$done2)  $htaccess_lines[] = 'php_value post_max_size ' . ($max_upload*1.5) . 'M';
							if (!$done1 || !$done2) $htaccess_lines[] = '# END - PSPInstaller RepoPrep Settings';
							
							$htaccess_content_new = implode("\n", $htaccess_lines);
							
						} else {
							
							$htaccess_lines = array('# BEGIN - PSPInstaller RepoPrep Settings',
													'php_value upload_max_filesize ' . $max_upload . 'M',
													'php_value post_max_size ' . ($max_upload*1.5) . 'M',
													'# END - PSPInstaller RepoPrep Settings');
							
							$htaccess_content_new = implode("\n", $htaccess_lines);
							
						}
						
						if ($htaccess_content_new != $htaccess_content) {
							@file_put_contents($htaccess, $htaccess_content_new);
						}
						
					}
					
					TriggerUpdate();
					addMessage('success', 'Changes saved.');
					loadConfig($db);
				}
			} else {
				addMessage('error', 'Incomplete post data.');
			}
		} else {
			$normalname = config('Upload_Title');
			$welcometext = config('Upload_Text');
			$upload_enabled = config('Upload_Enabled') == '1' ? ' checked="checked" ' : '';
			$max_upload = getMaxUpload();
			$local_numberformat = config('Local_NumberFormat');
			$local_timeformat = config('Local_TimeFormat');
			$local_datetypeformat = config('Loc_DateTypeFormat');
			$local_dateformat = config('Local_DateFormat');
		}

		

		$number_format_options = radioOption('numberformat', array('N'=>'Decimal dot: <code>10.95</code>','R'=>'Decimal comma: <code>10,95</code>'), $local_numberformat );
		$time_format_options = radioOption('timeformat', array('g:i a'=>'8:00 pm','g:i A'=>'8:00 PM','H:i'=>'20:00'), $local_timeformat );
		$date_short_options = radioOption('dateshortformat', array('yyyy/mm/dd'=>'2010/01/15','mm/dd/yyyy'=>'01/15/2010','dd/mm/yyyy'=>'15/01/2010','yyyy-mm-dd'=>'2010-01-15','mm-dd-yyyy'=>'01-15-2010','dd-mm-yyyy'=>'15-01-2010'), $local_datetypeformat );
		$date_options = radioOption('dateformat', array('F j, Y'=>'January 15, 2010','j F Y'=>'15 January 2010'), $local_dateformat );

		break;
}



$db->Close();

require ROOT . 'admin/tpl/overallheader.php';
require ROOT . 'admin/tpl/config.php';
require ROOT . 'admin/tpl/overallfooter.php';

?>
