$(document).ready(function () {

	var ajaxurl = '/wp-admin/admin-ajax.php';
	
	$('#airport_edit_page, #airline_edit_page').submit(e => { 
		
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
Dropzone.options.myAwesomeDropzone = {

	url: ajaxurl,
    acceptedFiles: "image/*",
    uploadMultiple: false,
	maxFilesize: 5,
	addRemoveLinks: true, 
    init: function() {
		
		
		this.on("sending", function (file, xhr, formData) {

			var form_type = $('[action="/action_page.php"]').attr('data-type');

			if(form_type == 'airport') {
				formData.append("action", "update_global_slider");
				formData.append("airport_id", $('#airport_id').val() );
			} else {
				formData.append("action", "update_global_slider");
				formData.append("airline_id", $('#airline_id').val() );
			}

			formData.append("form_type", form_type);

		});

		var $initThis = this;

		this.on('maxfilesexceeded', function (file) {
	        this.removeAllFiles();
	        this.addFile(file);
	    });

		$.each(json_images, function(index, val) {
			
			var mockFile = { name: val.filename, size: val.filesize, type: val.filetype, upload_id: val.upload_id };
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

		var form_type = $('[action="/action_page.php"]').attr('data-type');

		$.post(ajaxurl, { upload_id: file.upload_id, global_id: $('#'+form_type+'_id').val(), action: 'delete_file' }, function() {
			file.previewElement.remove();
		});

	}

};