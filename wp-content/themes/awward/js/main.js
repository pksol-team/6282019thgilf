$(document).ready(function () {

	var ajaxurl = '/wp-admin/admin-ajax.php';

	$('#prescription_photo').change(function (e) {

		var fd = new FormData();
		var file = jQuery(document).find('#prescription_photo');

		fd.append('action', 'upload_file');
		var individual_file = file[0].files[0];
		fd.append("file", individual_file);
		
		fd.append("airport_name", $('#title').val() );

		$('.file-upload-loader').show();

		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			data: fd,
			contentType: false,
			processData: false,
			success: function (response) {
				
				var response_json_decoded = JSON.parse(response);
				$('#airport_image').attr('src', response_json_decoded.url);
				$('#airport_image_id').val(response_json_decoded.id);
				$('.file-upload-loader').hide();

			}
		});

	});

	
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