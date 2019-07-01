<?php 

/* Template Name: Airlines */ 

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
					<h1>Airlines</h1>
					<div class="ratiing-box inner-raiting-box row grid">
						<ul class="col-md-6 col-lg-4 grid-item">
							<li>
								<h5><a href="#">THIS IS TITLE</a></h5>
								<p>Stars</p>
								<div class="detail">
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus tortor.</p>
								</div>
							</li>
						</ul>
						<ul class="col-md-6 col-lg-4 grid-item">
							<li>
								<h5><a href="#">THIS IS TITLE</a></h5>
								<p>Stars</p>
								<div class="detail">
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus tortor.</p>
								</div>
							</li>
						</ul>
						<ul class="col-md-6 col-lg-4 grid-item">
							<li>
								<h5><a href="#">THIS IS TITLE</a></h5>
								<p>Stars</p>
								<div class="detail">
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus tortor.</p>
								</div>
							</li>
						</ul>
						<ul class="col-md-6 col-lg-4 grid-item">
							<li>
								<h5><a href="#">THIS IS TITLE</a></h5>
								<p>Stars</p>
								<div class="detail">
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus tortor.</p>
								</div>
							</li>
						</ul>
						<ul class="col-md-6 col-lg-4 grid-item">
							<li>
								<h5><a href="#">THIS IS TITLE</a></h5>
								<p>Stars</p>
								<div class="detail">
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus tortor.</p>
								</div>
							</li>
						</ul>
						<ul class="col-md-6 col-lg-4 grid-item">
							<li>
								<h5><a href="#">THIS IS TITLE</a></h5>
								<p>Stars</p>
								<div class="detail">
								    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis maximus tortor.</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $('.grid').masonry({
  itemSelector: '.grid-item',
  percentPosition: true
})
</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>