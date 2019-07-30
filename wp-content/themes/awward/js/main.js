$(document).ready(function () {

	var ajaxurl = '/wp-admin/admin-ajax.php';

	// $('#prescription_photo').change(function (e) {

	// 	var fd = new FormData();
	// 	var file = jQuery(document).find('#prescription_photo');

	// 	fd.append('action', 'upload_file');
	// 	var individual_file = file[0].files[0];
	// 	fd.append("file", individual_file);
		
	// 	fd.append("airport_name", $('#title').val() );

	// 	$('.file-upload-loader').show();

	// 	jQuery.ajax({
	// 		type: 'POST',
	// 		url: ajaxurl,
	// 		data: fd,
	// 		contentType: false,
	// 		processData: false,
	// 		success: function (response) {
				
	// 			var response_json_decoded = JSON.parse(response);
	// 			$('#airport_image').attr('src', response_json_decoded.url);
	// 			$('#airport_image_id').val(response_json_decoded.id);
	// 			$('.file-upload-loader').hide();

	// 		}
	// 	});

	// });

	
	$('#airport_edit_page').submit(e => { 
		
		e.preventDefault();
 
		let $submit_button = $('.button_submit').hide();
		let $loader_button = $('.loader_buttom').show();

		let $this = $(e.currentTarget);
		let $data = $this.serializeArray();

		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			data: $data,
			success: function (response) {

				$submit_button.show();
				$loader_button.hide();

				$('#success_msg').slideDown();

				setTimeout(() => {
					
					$('#success_msg').slideUp();

				}, 3000);

			}
		});
		
		
	});

});

var ajaxurl = '/wp-admin/admin-ajax.php';

var file_up_names = [];
Dropzone.options.myAwesomeDropzone= {
	

	url: ajaxurl,
    acceptedFiles: "image/*",
    uploadMultiple: false,
	maxFilesize: 5,
	addRemoveLinks: true, 
    init: function() {
		
		
		this.on("sending", function (file, xhr, formData) {
			formData.append("action", "update_airport_slider");
			formData.append("airport_id", $('#airport_id').val() );
		});

		var $initThis = this;

		this.on('maxfilesexceeded', function (file) {
	        this.removeAllFiles();
	        this.addFile(file);
	    });

		$.each(json_images, function(index, val) {
			
			var mockFile = { name: val.filename, size: val.filesize, type: val.filetype, upload_id: val.upload_id };

			// var mockFile = { name: <filename>, size: <filesize>, type: <filetype>, url: <file_url> };
		    $initThis.files.push(mockFile);
		    $initThis.emit('addedfile', mockFile);
		    $initThis.createThumbnailFromUrl(mockFile, mockFile.url);
		    $initThis.emit('complete', mockFile);
			$initThis.options.thumbnail.call($initThis, mockFile, val.src);
		    $initThis._updateMaxFilesReachedClass();

		});

		setTimeout(() => {
			
			$('[data-dz-remove]').html('Remove file');

		}, 200); 

	},

	success: function (file, response) {

		file.upload_id = response;

	},

	removedfile: function (file) {
		
		x = confirm('Do you want to delete?');
		if(!x)  return false;

		$(file.previewElement).find('.dz-remove').html(loader_image);

		$.post(ajaxurl, { upload_id: file.upload_id, airport_id: $('#airport_id').val(), action: 'delete_file' }, function() {
			file.previewElement.remove();
		});

	}

};