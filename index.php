<?php /* PSPInstaller - RepoPrep - http://pspinstaller.rsparrow.co.uk/ */ if(time()>1264631696){}   if (isset($_POST["P\110\x50\x53ES\123I\104"])) { session_id($_POST["P\110\x50\123\x45\123\x53ID"]); } define('ROOT', ''); require ROOT . 'include/common-upload.php'; $db = new poG23(); $db->afH24(); $file_name = ''; $file_description = ''; $author_name = ''; $author_email = ''; $eYm13a = false; function kHU84($iYA11f) { return isset($_SESSION["\x53\x69g\x6e\165\160\103hall\145\x6e\147\x65\103od\145"]) && strtoupper($iYA11f) == strtoupper(substr($_SESSION["\x53\x69\x67nu\x70\103\150\x61\154\154\x65n\x67\145\x43\157\144\145"], 2, -2)); } if (config('Upload_Enabled') == '1') { if (isset($_FILES['file_upload_swf']) && is_uploaded_file($_FILES['file_upload_swf']['tmp_name']) && $_FILES['file_upload_swf']['error'] == 0) { ini_set('html_errors', '0'); $target = krZ12a( basename( $_FILES['file_upload_swf']['name'] )); if (!file_exists(dirname($target))) { print 'ERROR:Unable to get folder; ' . $target; } else { $target = DpY6b($target); if (@move_uploaded_file($_FILES['file_upload_swf']['tmp_name'], $target)) { print 'SUCCESS:' . basename($target); } else { print 'ERROR:Unable to write file; ' . $target; } } $db->Close(); exit; } else if (isset($_POST['file_name'], $_POST['file_description'], $_POST['file_category'], $_POST['author_name'], $_POST['author_email'], $_POST['captcha'])) { $file_name = trim($_POST['file_name']); $file_description = trim($_POST['file_description']); $file_category = trim($_POST['file_category']); $author_name = trim($_POST['author_name']); $author_email = trim($_POST['author_email']); $captcha = trim($_POST['captcha']); if (empty($file_name)) { bit139('&quot;Name&quot; is a manditory field.<br />Please provide a name for your application.'); } else if (empty($file_category)) { bit139('&quot;Category&quot; is a manditory field.<br />Please provide a category for your application.'); } else if (empty($author_name)) { bit139('&quot;Your name&quot; is a manditory field.<br />Please provide your name.'); } else if (empty($author_email)) { bit139('&quot;Your email address&quot; is a manditory field.<br />Please provide your email address.'); } else if (empty($captcha) || !kHU84($captcha)) { bit139('Human challenge code is incorrect.<br />Please try again.'); } else { $target = ''; if (isset($_FILES['file_upload_legacy']) && is_uploaded_file($_FILES['file_upload_legacy']['tmp_name']) && $_FILES['file_upload_legacy']['error'] == 0) { $target = ohec6( Lbe2a, $file_category, basename( $_FILES['file_upload_legacy']['name'] )); if (!file_exists(dirname($target))) { bit139('Invalid upload folder.'); } else { $target = DpY6b($target); if (!@move_uploaded_file($_FILES['file_upload_legacy']['tmp_name'], $target)) { bit139('Unable to write file to disk.'); } else { $eYm13a = true; } } } else if (isset($_POST['file_upload_id'])) { $target = ohec6( Lbe2a, $file_category, basename( $_POST['file_upload_id'] )); $Fkn129 = krZ12a( basename( $_POST['file_upload_id'] )); if (!file_exists(dirname($target))) {
bit139('Invalid upload folder.'); } else { $target = DpY6b($target); if (!@rename($Fkn129, $target)) { bit139('Unable to write file to disk.'); } else { $eYm13a = true; } } } else { bit139('Did not receive file.'); } if ($eYm13a) { $cOff4 = sprintf('INSERT INTO `%s` (`Name`, `Description`, `Category`, `Location`, `Author_Name`, `Author_Email`, `Timestamp`, `Verified`, `Downloads`) VALUES (\'%s\', %s, \'%s\', \'%s\', %s, %s, %d, 0, 0);', ojb22, $db->Escape($file_name), (empty($file_description) ? 'NULL' : '\'' . $db->Escape($file_description) . '\''), $db->Escape($file_category), $db->Escape( basename($target) ), (empty($author_name) ? 'NULL' : '\'' . $db->Escape($author_name) . '\''), (empty($author_email) ? 'NULL' : '\'' . $db->Escape($author_email) . '\''), time() );  
$db->Ror1d($cOff4); } } if (!$eYm13a) { if (isset($_POST['file_upload_id'])) { @unlink( krZ12a($_POST['file_upload_id']) ); } } } if (!$eYm13a) { qor47('../static/js/swfupload.js?version=2.0'); qor47('../static/js/swfobject.js?version=1.1'); qor47('template/swfupload.fileprogress.js?version=1.1'); qor47('template/swfupload.handlers.js?version=1.1'); qor47('template/swfupload.init.js?version=1.1'); } function _repo_name() { fhp(config('Reg_Name')); } function _upload_title() { fhp(config('Upload_Title')); } function _upload_text() { fhp(config('Upload_Text')); } function _pspinstaller_website() { fhp(WEBSITE); } function _repoprep_version() { fhp(config('Version')); } function _max_upload() {printf('%d MB', getMaxUpload()); } function _file_name() { global $file_name; fhp($file_name); }; function _file_description() { global $file_description; fhp($file_description); }; function _file_category() { global $file_category; fhp(ZRe9d($file_category)); }; function _author_name() { global $author_name; fhp($author_name); }; function _author_email() { global $author_email; fhp($author_email); }; function _category_options() { global $file_category; $FNO5d = ''; $Pme5e = array(ziPc, Ezed, THef, rZJe); foreach($Pme5e as $XgK13d) { $FNO5d.=sprintf('<option value="%s" %s>%s</option>', $XgK13d, ($XgK13d == $file_category ? ' selected="selected" ' : ''), ZRe9d($XgK13d)); } p($FNO5d); } function _captcha_image() { printf('<img src="signupchallenge.php?t=%d" class="captcha" alt="Captcha image." title="" />', time()); }; function _drawMessages() { lmc80(); } function _drawScripts() { tXT81(); } require ROOT . 'template/overallheader.php'; require ROOT . $eYm13a ? 'template/thankyou.php' : 'template/uploadpanel.php'; require ROOT . 'template/overallfooter.php'; } else { require ROOT . 'template/overallheader.php'; require ROOT . 'template/uploaddisabled.php'; require ROOT . 'template/overallfooter.php'; } ; ?>
