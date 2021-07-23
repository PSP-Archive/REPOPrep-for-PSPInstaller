var swfu = null;

$(document).ready(function() {
	swfu = new SWFUpload({
		// Backend settings
		upload_url: "index.php",
		file_post_name: "file_upload_swf",
		post_params: {
			"PHPSESSID": phpSessID
		},

		// Flash file settings
		file_size_limit : fileSizeLimit.toString() + ' MB',
		file_types : "*.zip",
		file_types_description : "Zip Files",
		file_upload_limit : "0",
		file_queue_limit : "1",

		// Event handler settings
		swfupload_loaded_handler : swfUploadLoaded,
		swfupload_load_failed_handler : swfUploadLoadFailed,
		
		file_dialog_start_handler: fileDialogStart,
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		
		
		//upload_start_handler : uploadStart,	// I could do some client/JavaScript validation here, but I don't need to.
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,

		// Button Settings
		button_placeholder_id : "swfupload_placeholder_element",
		button_image_url : "template/img/btnUpload.gif",
		button_width: 112,
		button_height: 25,
		button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
		button_cursor: SWFUpload.CURSOR.HAND,
		
		// Flash Settings
		flash_url : "static/swfupload/swfupload.swf",

		custom_settings : {
			progress_target : "fsUploadProgress",
			upload_successful : false
		},
		
		// Debug settings
		debug: false,
		
		minimum_flash_version : "9.0.0"
		
	});
});