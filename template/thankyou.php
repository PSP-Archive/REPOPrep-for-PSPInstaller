<h2><?php _upload_title(); ?></h2>

    <div class="statusmsg success">
        Upload completed!
    </div>
    
    <br style="clear:both" />

    <div class="uploadform">
        <h3>Upload completed.</h3>
        <div class="padding">
        	<p>Thank you for uploading your application.</p>
            <p>Your application will be reviewed before it appears on the PSPInstaller.</p>
            
            <table cellpadding="0" cellspacing="0" border="0" class="uploadtable">
            	<tr>
                	<th>Name</th>
                    <td><?php _file_name(); ?></td>
                </tr>
            	<tr>
                	<th>Description</th>
                    <td><?php _file_description(); ?></td>
                </tr>
            	<tr>
                	<th>Category</th>
                    <td><?php _file_category(); ?></td>
                </tr>
           </table>
            
        </div>
    </div>