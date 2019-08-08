<?php 

/* Template Name: HomePage */

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
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="rating-info-box airline">
					<h1>Top Airlines</h1>
					<div class="ratiing-box inner-raiting-box row grid">
						
						<?php 

							$args = array(
								'post_type' => 'airline',
								'post_status' => 'publish',
								'posts_per_page' => 6,
								
								'meta_query' => array(

									'average_clause' => array(
										'key' => 'average_ratings',
										'compare' => 'EXISTS',
									), 

								),

								'orderby' => array(
									'average_clause' => 'DESC',
								),

								'showposts'=> 6,
							);

							$my_query = new WP_Query($args); 

						?>
						<?php $index = 0; while ($my_query->have_posts()) : $my_query->the_post(); $index++; ?>
						<ul class="col-md-12 col-lg-12 rating_list_box">

							<?php 	
							
								$airline_id = get_the_ID();
								$iata = get_post_meta($airline_id, 'iata', true);
								$iata_in_title = ($iata) ? "($iata)" : "";

							?>

							<li>
						
								<img src="https://booking.kayak.com/rimg/provider-logos/airlines/v/<?= $iata; ?>.png?crop=false&width=64&height=64&fallback=default2.png&_v=8d8d0b60f9172bb9c10950f2fb00ce56377c2108" alt="<?= $iata; ?>">

								<h5><a href="<?= the_permalink(); ?>"><?php the_title(); ?> <?= $iata_in_title; ?> </a></h5>

								<?php
									$avg_rating = do_shortcode('[stars_rating_avg]');
								?>
								
								<?php if (strlen($avg_rating) > 0): ?>
									<?= $avg_rating; ?>
								<?php else : ?>
									<div class="stars-avg-rating"><span class="rating-stars"><i class="fa stars-style-regular"></i><i class="fa stars-style-regular"></i><i class="fa stars-style-regular"></i><i class="fa stars-style-regular"></i><i class="fa stars-style-regular"></i></span>Not rated yet</div>
								<?php endif ?>
								
								
								<div class="detail"></div>

							</li>
						</ul>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div>
				</div>
			</div>
			

			<div class="col-md-6">
				<div class="rating-info-box airline">
					<h1>Top Airports</h1>
					<div class="ratiing-box inner-raiting-box row grid">
						
						<?php 

							$args = array(
								'post_type' => 'airport',
								'post_status' => 'publish',
								'posts_per_page' => 6,
								
								'meta_query' => array(

									'average_clause' => array(
										'key' => 'average_ratings',
										'compare' => 'EXISTS',
									), 

								),

								'orderby' => array(
									'average_clause' => 'DESC',
								),

								'showposts'=> 6,
							);

							$my_query = new WP_Query($args); 

						?>
						
						<?php $index = 0; while ($my_query->have_posts()) : $my_query->the_post(); $index++; ?>
						<ul class="col-md-12 col-lg-12 rating_list_box">

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
								
								
								<div class="detail"></div>

							</li>
						</ul>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div>
				</div>
			</div>


		</div>
	</div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>