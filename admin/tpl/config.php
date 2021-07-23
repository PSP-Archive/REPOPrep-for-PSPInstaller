<h2>Config</h2>

<div id="filters">
    <ul>
        <?php drawfilters(array('General config'=>'',
                              'Admin account'=>'account',
                              'Registration'=>'registration'), 'config', $sectionpage, 'li', 'active', 'section'); ?>
    </ul>
    <br class="cl" />
</div>

<form method="post" action="config.php" autocomplete="off">
<input type="hidden" name="section" value="<?php print $sectionpage; ?>" />
<input type="hidden" name="act" id="act" value="<?php fhp($default_action); ?>" />

	<br class="cl" />

	<?php if ($sectionpage == 'account') { ?>
       
    <p>Change the administrator account username and password.</p>
    <p>If you change either the username or the password, you will be logged out and will have to log in again, using the new username and password.</p>
    
    <div class="statsbox">
        <h3>Account configuration</h3>
        <div class="padding">
            <table cellpadding="0" cellspacing="0" class="configtable">
    			<tr>
                	<th>Current username:</th>
                    <td><?php fhp($username); ?></td>
                </tr>
            </table>
            <div id="change">
            <table cellpadding="0" cellspacing="0" class="configtable">
    			<tr>
                	<th></th>
                    <td><a href="javascript:;" class="btn change-account">Change the account</a></td>
                </tr>
            </table>
            </div>
            <div id="newstuff" style="display:none;">
            <table cellpadding="0" cellspacing="0" class="configtable">
    			<tr id="new1">
                	<th>New username:</th>
                    <td><input type="text" name="nu" value="<?php fhp($username); ?>" class="txt" size="20" /></td>
                </tr>
    			<tr id="new2">
                	<th>New password:</th>
                    <td><input type="password" name="np1" value="" class="txt" size="20" /></td>
                </tr>
    			<tr id="new3">
                	<th>Repeat new password:</th>
                    <td><input type="password" name="np2" value="" class="txt" size="20" /> </td>
                </tr>
    			<tr id="confirm">
                	<th>Confirm current password:</th>
                    <td>
                    	<input type="password" name="cp" value="" class="txt" size="20" />
                        <span class="descr">Confirm with the current administrator password.</span></td>
                </tr>
    			<tr>
                	<th></th>
                    <td>To complete the change, confirm with the current administrator password, and click &quot;Save account changes&quot;.</td>
                </tr>
            </table>
            </div>
        </div>
    </div>
    
    <input type="submit" name="savechanges" value="Save account changes" class="btn save-button" style="display:none;" />
    
    <?php } else if ($sectionpage == 'registration') { ?>
    
    <p>In order for the applications in your Repo to show up on the PSPInstaller, you must register your Repo system with the Master List.</p>
    <p></p>
    
    <div class="statsbox">
        <h3>Registration</h3>
        <div class="padding">
            <table cellpadding="0" cellspacing="0" class="configtable">
    			<tr>
                	<th>Current status:</th>
                    <td><?php print $reg_status; ?></td>
                </tr>
                <?php if ($is_registered) { ?>
                <tr>
                	<th>Repo name:</th>
                    <td><?php fhp($new_name); ?></td>
                </tr>
                <tr>
                	<th>Repo description:</th>
                    <td><?php fhp($new_description); ?></td>
                </tr>
                <tr>
                	<th>Contact email address:</th>
                    <td><?php fhp($new_contact); ?></td>
                </tr>
                <tr>
                	<th>Installation URL:</th>
                    <td><?php fhp($reg_url); ?></td>
                </tr>
                <tr>
                	<th>Last registration change:</th>
                    <td><?php print $reg_lastsynch; ?></td>
                </tr>
                <?php } else { ?>
                <tr>
                	<th></th>
                    <td>In order for the files uploaded to this Repo to be visible on the PSPInstaller, you must register this RepoPrep to the Master List.</td>
                </tr>
                <?php } ?>
                </table>
            </table>
            <div id="change" <?php p($change_style); ?>>
            <table cellpadding="0" cellspacing="0" class="configtable">
    			<tr>
                	<th></th>
                    <td><a href="javascript:;" class="btn change-registration">Change registration</a></td>
                </tr>
            </table>
            </div>
            <div id="newstuff" <?php p($newstuff_style); ?>>
            <hr />
            <table cellpadding="0" cellspacing="0" class="configtable">
                <tr>
                	<th><?php fhp($lbl_regname); ?>:</th>
                    <td><input type="text" name="name" value="<?php fhp($new_name); ?>" class="txt" size="20"  style="width:328px;" /> <span class="descr">The name for this REPO, as it will appear in the selection list on the PSPInstaller.</span></td>
                </tr>
                <tr>
                	<th><?php fhp($lbl_regdescription); ?>:</th>
                    <td><textarea name="description" rows="3" cols="50" style="width:328px;"><?php fhp($new_description); ?></textarea> <span class="descr">A short description for this REPO, this will be shown on the PSPInstaller.</span></td>
                </tr>
                <tr>
                	<th><?php fhp($lbl_regcontact); ?>:</th>
                    <td><input type="text" name="contact" value="<?php fhp($new_contact); ?>" class="txt" size="20"  style="width:328px;" /> <span class="descr">The email address that the PSPInstaller team can use to contact you.</span></td>
                </tr>
                <tr>
                	<th><?php fhp($lbl_regurl); ?>:</th>
                    <td><input type="text" name="url" value="<?php fhp($new_url); ?>" class="txt" size="20"  style="width:328px;" /><span class="descr">The URL of this RepoPrep installation. This is important for synchronizing the applications with the Master List. This URL has to be availible via the Internet. (Don't include the /admin/ folder).</span></td>
                </tr>
    			<tr id="confirm">
                	<th>Confirm with admin password:</th>
                    <td><input type="password" name="cp" value="" class="txt" size="20"  style="width:328px;" /> <span class="descr">Confirm with the current administrator password</span></td>
                </tr>
    			<tr>
                	<th></th>
                    <td>To complete the change, confirm with the administrator password, and click &quot;<?php fhp($savebutton); ?>&quot; to send the changes to the Master List, for review.</td>
                </tr>
                
            </table>
            </div>
        </div>
    </div>
    
    <input type="submit" name="savechanges" value="<?php fhp($savebutton); ?>" class="btn save-button" <?php p($savebutton_style); ?> />
    
    <?php } else { ?>
    
    <p>These are the general settings of the RepoPrep application.</p>
    <p>Changes for these settings will take affect immediately.</p>
    
    <div class="statsbox">
        <h3>General configuration</h3>
        <div class="padding">
            <table cellpadding="0" cellspacing="0" class="configtable">
                <tr>
                    <th>Title upload panel:</th>
                    <td><input type="text" name="name" value="<?php fhp($normalname); ?>" class="txt" size="50" style="width:328px;" /> <span class="descr">The name or title that will display on the top of the upload panel.</span></td>
                </tr>
                <tr>
                    <th>Welcome text upload panel:</th>
                    <td><textarea name="welcometext" rows="6" cols="50" class="txt" style="width:328px;"><?php fhp($welcometext); ?></textarea> <span class="descr">The text that will display on the upload panel, above the upload form.</span></td>
                </tr>
                <tr>
                    <th>File uploading:</th>
                    <td><input type="checkbox" name="upload" value="1" id="cUpload" <?php print $upload_enabled; ?> /> <label for="cUpload">Visitors can upload files with the </label><a href="../" target="_blank" title="Go to the upload panel.">upload panel</a>.</td>
                </tr>
                <tr>
                    <th>Max upload size:</th>
                    <td>
                    	<?php if ($can_max_upload) { ?>
                    	<input type="text" name="maxupload" value="<?php fhp($max_upload); ?>" class="txt right-align" size="3"  /> MB <span class="descr">This setting will be saved into the .htaccess file in the root folder of the RepoPrep.</span>
                        <?php } else { ?>
                        <?php fhp($max_upload); ?> MB <span class="descr">This setting can be changed in the php.ini file by setting these properties: <code><a href="http://www.php.net/manual/en/ini.core.php#ini.upload-max-filesize" target="_blank">upload_max_filesize</a></code> and <code><a href="http://www.php.net/manual/en/ini.core.php#ini.post-max-size" target="_blank">post_max_size</a></code>. Make sure that <code>post_max_size</code> is set a little bit bigger than <code>upload_max_filesize</code>.<br />If you want to make these settings specifically for the RepoPrep, make the .htaccess file, in the root folder of the RepoPrep, writable.</span>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>Date long format:</th>
                    <td>
                        <?php print $date_options; ?>
                    </td>
                </tr>
                <tr>
                    <th>Date short format:</th>
                    <td>
                        <?php print $date_short_options; ?>
                    </td>
                </tr>
                <tr>
                    <th>Time format:</th>
                    <td>
                        <?php print $time_format_options; ?>
                    </td>
                </tr>
                <tr>
                    <th>Number format:</th>
                    <td>
                        <?php print $number_format_options; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    
    <input type="submit" name="savechanges" value="Save changes" class="btn save-button" />
    
    <?php } ?>
	
</form>