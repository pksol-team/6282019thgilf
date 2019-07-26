<?php 
	/* Template Name: Edit Airport */ 
?>
<?php get_header(); ?>

<main id="content">

	<?php
		

		$ID = $_GET['id'];
		$airport_post = get_post($ID);

		$latitude = get_post_meta($ID, 'latitude', true);
		$longitude = get_post_meta($ID, 'longitude', true);

		$url = get_post_permalink($ID);

	?>
<br>
<br>
<br>

<h1><?= $airport_post->post_title; ?> <a href="<?= $url; ?>" target="_blank"> <i class="fa fa-eye"></i> </a> </h1>

<form action="/action_page.php" id="airport_edit_page" method="post">

  <input type="hidden" name="action" value="update_airport_data">
  <input type="hidden" name="airport_id" value="<?= $ID; ?>">

  <img src="<?= get_the_post_thumbnail_url(); ?>" id="airport_image" >
  <div class="form-group">
    <label for="title">Image:</label>
	<input type="file" id="prescription_photo" class="inputfile" accept="image/gif, image/jpeg, image/png" />
	<img class="file-upload-loader" style="vertical-align: middle;" src="<?= get_stylesheet_directory_uri(); ?>/img/ajax-loader.gif">
	<input type="hidden" name="airport_image_id" id="airport_image_id" value="<?=  get_post_thumbnail_id( $airport_post ); ?>">
  </div>

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



</main>



<script>
	$(document).ready(function () {
		


	});
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
