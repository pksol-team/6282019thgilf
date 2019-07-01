<?php get_header(); ?>
<div class="row">
  <div class="col-md-12">
    <main id="content">
      <?php if ( is_singular() ) {
        echo '<h1 class="entry-title">';
        } else {
        echo '<h2 class="entry-title">';
        } ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
      <?php if ( is_singular() ) {
        echo '</h1>';
        } else {
        echo '</h2>';
        } ?>
      <ul class="address-info">
        <li>
          <p><i class="fa fa-map"></i> <?php the_field('address'); ?>  </p>
        </li>
        <li>
          <p><i class="fa fa-phone"></i> <?php the_field('contact_no');  ?></p>
        </li>
        <li>
          <p><i class="fa fa-laptop"></i> <a href="<?php the_field('website'); ?>">Website </a> </p>
        </li>
		<li>
          <p><i class="fa fa-pencil-square-o"></i> <a href="#respond">Leave a Review </a> </p>
        </li>
      </ul>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php if( have_rows('slider_images') ): ?>
      <div id="airlineslider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php $count = 0; ?>
          <?php while( have_rows('slider_images') ): the_row(); 
            $image = get_sub_field('slider_img');  
            $count++;
            ?>
          <div class="carousel-item<?php if($count == 1){echo ' active';}?> ">
            <img src="<?php echo $image; ?>" alt="#" >
          </div>
          <?php endwhile; ?>
        </div>
        <a class="carousel-control-prev" href="#airlineslider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#airlineslider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
      </div>
      <?php endif; ?>
      <?php get_template_part( 'entry' ); ?>
      <?php if ( comments_open() && ! post_password_required() ) { comments_template( '', true ); } ?>
      <?php endwhile; endif; ?>
      <footer class="footer">
        <?php get_template_part( 'nav', 'below-single' ); ?>
      </footer>
      <?php echo do_shortcode(''); ?>
    </main>
  </div>
  <div class="col-md-4">
    <?php get_sidebar(); ?>		
  </div>
</div>
<?php get_footer(); ?>