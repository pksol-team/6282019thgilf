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
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="rating-info-box airline">
					<h1>Airlines</h1>
					<div class="ratiing-box">
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="rating-info-box airport">
					<h1>Airport</h1>
					<div class="ratiing-box">
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="rating-info-box flight">
					<h1>Flights</h1>
					<div class="ratiing-box">
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
						<ul>
							<li>
								<h5>THIS IS TITLE</h5>
								<ul>
									<li>Lorem Ipsum</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>