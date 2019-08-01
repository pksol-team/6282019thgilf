<?php get_header(); ?>
<div class="row">
    <div class="col-md-12">
        <br>
        <br>
        <style>
            .reply {
                display: none;
            }
        </style>
        <br>

        <?php $access = get_user_meta(get_current_user_id(), 'airline_id', true); ?>

        <?php if ($access == get_the_ID()): ?>
        <a href="<?= get_home_url() ?>/edit_airline/?id=<?= get_the_ID(); ?>" style="text-decoration: underline; margin-bottom: 11px; display: block;">Edit Airline</a>
        <style>
            .reply {
                display: block;
            }
        </style>
        <?php endif ?>

        <?php   
            
            $airline_id = get_the_ID();
            
            $iata = get_post_meta($airline_id, 'iata', true);
            $icao = get_post_meta($airline_id, 'icao', true);
            $phoneNumber = get_post_meta($airline_id, 'phoneNumber', true);
            
        ?>
        <?php 

            if ( is_singular() ) {
                echo '<h1 class="entry-title">';
            
            } else {
                echo '<h2 class="entry-title">';
            } 
        ?>

        <img src="https://booking.kayak.com/rimg/provider-logos/airlines/v/<?= $iata; ?>.png?crop=false&width=72&height=72&fallback=default2.png&_v=8d8d0b60f9172bb9c10950f2fb00ce56377c2108" alt="<?= $iata; ?>">  

        <?php the_title(); ?>

        <?php 

            if ( is_singular() ) {
                echo '</h1>';
            } else {
                echo '</h2>';
            } 
        ?>

        <ul class="address-info">
            <li>
                <p><i class="fa fa-pencil-square-o"></i> <a href="#respond">Leave a Review </a> </p>
            </li>
        </ul>


        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <?php 

                $ID = get_the_ID();
                $existing_slider_image = array_filter( explode( "-", get_post_meta($ID, 'slider_images', true) ) );
            ?>

            <?php if( count($existing_slider_image) > 0 ): ?>
             <div id="airlineslider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                 <?php $count = 0; ?>
                 
                 <?php 

                    foreach ($existing_slider_image as $key => $slider_image_single) :
                    $image = wp_get_attachment_image_src( $slider_image_single, 'full' )[0];
                    $count++;
                ?>
                 <div class="carousel-item<?php if($count == 1){echo ' active';}?> ">
                   <img src="<?php echo $image; ?>" alt="#" >
                 </div>
                 <?php endforeach; ?>
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

            
            <p>

                <table class="airport_meta_data table-striped table-bordered">

                <?php if ($iata != ""): ?>
                    <tr>
                        <td>IATA Code</td>
                        <td><?= $iata; ?></td>
                    </tr>
                <?php endif ?>

                <?php if ($icao != ""): ?>
                    <tr>
                        <td>ICAO Code</td>
                        <td><?= $icao; ?></td>
                    </tr>
                <?php endif ?>

                <?php if ($phoneNumber != ""): ?>
                    <tr>
                        <td>Phone Number</td>
                        <td><?= $phoneNumber; ?></td>
                    </tr>
                <?php endif ?>

            </table>

            </p>

            
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











