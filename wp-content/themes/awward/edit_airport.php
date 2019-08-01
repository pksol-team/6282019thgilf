<?php 
	/* Template Name: Edit Airport */ 
?>
<?php get_header();


?>

<?php
		

		$ID = $_GET['id'];
		$airport_post = get_post($ID);

		$latitude = get_post_meta($ID, 'latitude', true);
		$longitude = get_post_meta($ID, 'longitude', true);

		$url = get_post_permalink($ID);

	?>

<?php $access = get_user_meta(get_current_user_id(), 'airport_id', true); ?>
<?php if ($access != $ID): ?>
	
	<script>
		window.location.href= '<?= $url; ?>';
	</script>

<?php endif ?>

<main id="content">
<br>
<br>
<br>

<h1><?= $airport_post->post_title; ?> <a href="<?= $url; ?>" target="_blank"> <i class="fa fa-eye"></i> </a> </h1>


<form class="dropzone" id="my-awesome-dropzone"></form>
<br>

<form action="/action_page.php" id="airport_edit_page" method="post" data-type="airport">

  <input type="hidden" name="action" value="update_airport_data">
  <input type="hidden" name="airport_id" id="airport_id" value="<?= $ID; ?>">

  <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" id="title" value="<?= $airport_post->post_title; ?>" name="title">
  </div>
  
  <div class="form-group">
    <label for="description">Description:</label>
    
	<?php 
		wp_editor( $airport_post->post_content, 'description', [ 'media_buttons' => false, 'textarea_rows' => 5 ] ); 
	?>

  </div>

	<div class="form-group">
		
		<label for="latitude">Latitude:</label>
		<input type="text" class="form-control" id="latitude" name="latitude" value="<?= $latitude; ?>"> 

  	</div>

	<div class="form-group">
		
		<label for="longitude">Longitude:</label>
		<input type="text" class="form-control" id="longitude" name="longitude"  value="<?= $longitude; ?>">

  	</div>

  	<button type="submit" class="btn btn-default button button_submit"> Submit</button>
	<button type="button" class="btn btn-default button loader_buttom" disabled> <img class="submit-loader" style="vertical-align: middle;" src="<?= get_stylesheet_directory_uri(); ?>/img/ajax-loader.gif"> Submitting... </button>
	<button type="button" class="btn btn-danger button cancel_button" onclick="location.reload();">Cancel </button>

	<a href="<?= $url; ?>" target="_blank" class="btn btn-default button button_view"> <i class="fa fa-eye"></i> View</a>
	  

</form>

<br>
<div class="alert alert-success" id="success_msg">
	<strong>Saved</strong> Data has been successfully updated
</div>


<?php echo do_shortcode(' [wpuf_comments post_type="airport"] '); ?>


</main>


<script type="text/javascript">
<?php

	$existing_image = array_filter( explode( "-", get_post_meta($ID, 'slider_images', true) ) );

	$json_images = [];

	foreach ($existing_image as $key => $slider_images_each) {
		
		$image = wp_get_attachment_image_src( $existing_image[$key], 'thumbnail' )[0];

		$file = get_attached_file( $existing_image[$key] );
		$filename = str_replace('-1', '', basename ( $file ) );
		$filesize = filesize( $file );
		$filetype = get_post_mime_type($slider_images_each);

		array_push($json_images, ['src' => $image, 'filename' => $filename, 'filesize' => $filesize, 'upload_id' => $slider_images_each, 'filetype' => $filetype]);

	}

	echo 'var json_images = '. json_encode($json_images);

?>

var loader_image = '<img src="<?= get_stylesheet_directory_uri() ?>/img/ajax-loader.gif"> Removing';

</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
