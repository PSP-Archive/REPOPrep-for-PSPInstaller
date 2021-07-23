<h2><?php _upload_title(); ?></h2>
<p><?php _upload_text(); ?></p>

<form method="post" action="index.php" enctype="multipart/form-data" autocomplete="off">
    <div class="uploadform">
        <h3>Upload a new file</h3>
        <div class="padding">
            
            <table cellpadding="0" cellspacing="0" border="0" class="uploadtable">
            	<tr>
                	<th>Name</th>
                    <td>
                    	<input type="text" class="txt w" name="file_name" id="file_name" size="40" value="<?php _file_name(); ?>" />
                        <div class="descr">The name of your application.</div>
                    </td>
                </tr>
            	<tr>
                	<th>Description (optional field)</th>
                    <td>
                    	<textarea type="text" class="txt w" name="file_description" cols="40" rows="3"><?php _file_description(); ?></textarea>
                        <div class="descr">A short description of your application.</div>
                    </td>
                </tr>
            	<tr>
                	<th>Category</th>
                    <td>
                    	<select name="file_category" id="file_category" size="1">
                        	<?php _category_options(); ?>
                        </select>
                    </td>
                </tr>
            	<tr>
                	<th>File:</th>
                    <td id="uploadarea">
                    	<div id="swfupload_box">
                            <input type="hidden" name="file_upload_id" id="file_upload_id" value="" />
                            <input type="text" class="txt w" disabled="disabled" id="file_upload" value="" size="40" />
                            <div id="swfupload_placeholder"><span id="swfupload_placeholder_element"></span></div>
                        </div>
                        <div id="fsUploadProgress"></div>
                        <div id="swfupload_alternative" style="display:none;">
                        	<input type="file" name="file_upload_legacy" />
                        </div>
                        <div class="descr">Select your application. Make sure it's a .zip file and no larger than <?php _max_upload(); ?>.</div>
                    </td>
                </tr>
                <tr>
                	<td colspan="2">&nbsp;</td>
                </tr>
            	<tr>
                	<th>Your name</th>
                    <td>
                    	<input type="text" class="txt w" name="author_name" id="author_name" size="40" value="<?php _author_name(); ?>" />
                    </td>
                </tr>
            	<tr>
                	<th>Your email address</th>
                    <td>
                    	<input type="text" class="txt w" name="author_email" id="author_email" size="40" value="<?php _author_email(); ?>" />
                    </td>
                </tr>
                <tr>
                	<td colspan="2">&nbsp;</td>
                </tr>
            	<tr>
                	<th>Human challenge</th>
                    <td>
                    	Enter the code you see in the image into the text box next to it. The code is not case sensative.<br />
                         If it's too difficult to read, <a href="#refreshcaptcha" class="refreshcaptcha">click here for a new code</a>.<br />
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>Code image:<br /><?php _captcha_image(); ?></td>
                                <td>Enter code:<br /><input type="text" name="captcha" id="captcha" class="txt captcha" /></td>
                            </tr>
                        </table>                        
                    </td>
                </tr>
            	<tr>
                	<th></th>
                    <td id="uploadbtn"><input type="submit" class="btn" value="Upload file" id="btnUpload" /></td>
                </tr>
            </table>
            
        </div>
    </div>
</form>