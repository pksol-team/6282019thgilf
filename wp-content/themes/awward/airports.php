<?php 

/* Template Name: Airports */ 

get_header(); ?>
<main id="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
<h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
</header>
<div class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</div>
</article>
<?php if ( comments_open() && ! post_password_required() ) { comments_template( '', true ); } ?>
<?php endwhile; endif; ?>
</main>

<div class="rating-all">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="rating-info-box airline">
					<h1>Airports</h1>

					<div class="s004">

						<?php 
							global $wp;
						?>

						<form action="<?= home_url( $wp->request ); ?>" method="get">
							<fieldset>
								<div class="inner-form">
									<div class="input-field">
										<div class="choices" data-type="text" aria-haspopup="true" aria-expanded="false" dir="ltr">
											<div class="choices__inner">
												<input class="form-control choices__input is-hidden" id="choices-text-preset-values" type="text" placeholder="Type to search..." tabindex="-1" style="display:none;" aria-hidden="true" data-choice="active" value="">
												<div class="choices__list choices__list--multiple"></div>
												<input name="search" type="text" class="choices__input choices__input--cloned" autocomplete="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Type to search..." style="width: 109px;" value="<?= (isset($_GET['search'])) ? $_GET['search'] : ""; ?>">
											</div>
										</div>
										<button class="btn-search" type="submit">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
												<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
											</svg>
										</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>

					<?php
						
					$args = array(
						'post_type' => 'airport',
						'post_status' => 'publish',
						'posts_per_page' => 21,
						// 'orderby' => 'rand',
						'showposts'=> 21,
						'paged' => $paged,
						's' => (isset($_GET['search'])) ? $_GET['search'] : ''
					);
					if ( get_query_var('paged') ) {
						$paged = get_query_var('paged');
					} else if ( get_query_var('page') ) {
						$paged = get_query_var('page');
					} else {
						$paged = 1;
					}

					query_posts( array( 
						'post_type' => 'airport', 
						// 'orderby' => 'rand', 
						'paged' => $paged ,
						's' => (isset($_GET['search'])) ? $_GET['search'] : ''
					) );


					
					$my_query = null;
					$my_query = new WP_Query($args); ?>

					<?php // var_dump($GLOBALS['wp_query']->request); ?>
					
					<?php if( $my_query->have_posts() ) : ?>


					<div class="ratiing-box inner-raiting-box row grid">

						<?php $index = 0; while ($my_query->have_posts()) : $my_query->the_post(); $index++; ?>
						<ul class="col-md-6 col-lg-4 grid-item">

							<li>

								<?php 

									$airport_id = get_the_ID();
									$country_code = get_post_meta($airport_id, 'countryCode', true);
									
								?>



								<img src="<?= get_template_directory_uri(); ?>/flag-icon-css-master/flags/1x1/<?= strtolower($country_code); ?>.svg" alt="<?= the_title(); ?>" width="72">

								<h5><a href="<?= the_permalink(); ?>"><?php the_title(); ?></a></h5>

								<?php
									$avg_rating = do_shortcode('[stars_rating_avg]');
								?>
								
								<?php if (strlen($avg_rating) > 0): ?>
									<?= $avg_rating; ?>
								<?php else : ?>
									<div class="stars-avg-rating"><span class="rating-stars"><i class="fa stars-style-regular"></i><i class="fa stars-style-regular"></i><i class="fa stars-style-regular"></i><i class="fa stars-style-regular"></i><i class="fa stars-style-regular"></i></span>Not rated yet</div>
								<?php endif ?>
								
								
								<div class="detail">
								    <?php the_content(); ?>
								</div>

							</li>
						</ul>
						<?php endwhile; ?>
		    			
						

					</div>

					<?php wp_reset_postdata(); ?>

					<div class="center text-center">
						<br>
						<?php wp_pagenavi(); ?>
					</div>
					<?php else : ?>
						<h2 style="color:#FF6E3D;">No Record Found!</h2>
					<?php endif; ?>


				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div id="test">
						my text working 
</div> -->

<script>
   
	

    // $('.grid').masonry({
	// 	itemSelector: '.grid-item',
	// 	percentPosition: true
	// });

	// $(document).ready(function () {
		
	// 	var src_str = $("#test").text();
	// 	var term = "my text";
	// 	term = term.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*");
	// 	var pattern = new RegExp("("+term+")", "gi");

	// 	src_str = src_str.replace(pattern, "<mark>$1</mark>");
	// 	src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4");

	// 	$("#test").html(src_str);

	// });



</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>