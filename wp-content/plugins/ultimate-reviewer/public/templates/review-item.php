<?php

$ratings = '';
$linear_class = '';	
if ( 1 == $show_site_rating OR 1 == $show_user_rating ) {

	$rating_args = array(
		'format' => $format,
		'style' => $style,
		'position' => $position,
		'text_position' => $text_position,
		'show_avg_user_rating_text' => $show_avg_user_rating_text,
		'show_your_user_rating_text' => $show_your_user_rating_text,
		'show_maximum_rating_text' => $show_maximum_rating_text,
		'show_user_votes_text' => $show_user_votes_text,		
		'show_ranges_text' => $show_ranges_text,
		'show_zero_rating' => $show_zero_rating,
		'rating_image' => $rating_image,
		'empty_icon' => $empty_icon,
		'empty_icon_color' => $empty_icon_color,
		'filled_icon' => $filled_icon,
		'filled_icon_color' => $filled_icon_color,
		'icon_width' => $icon_width,
		'icon_height' => $icon_height,
		'rating_width' => $rating_width,
		'rating_height' => $rating_height,
		'rating_text_size' => $rating_text_size,
		'rating_text_color' => $rating_text_color,
		'rating_background_color' => $rating_background_color,
		'rating_border_width' => $rating_border_width,
		'rating_border_color' => $rating_border_color,
		'rating_extra_css' => $rating_extra_css,
		'gauge_width' => $gauge_width,
		'gauge_filled_color_1' => $gauge_filled_color_1,
		'gauge_filled_color_2' => $gauge_filled_color_2,
		'gauge_empty_color' => $gauge_empty_color,
		'criteria_title_size' => $criteria_title_size,						
		'criteria_title_color' => $criteria_title_color,						
		'criteria_title_extra_css' => $criteria_title_extra_css,
		'maximum_rating_text_size' => $maximum_rating_text_size,
		'maximum_rating_text_color' => $maximum_rating_text_color,
		'maximum_rating_text_extra_css' => $maximum_rating_text_extra_css,
		'user_votes_text_size' => $user_votes_text_size,
		'user_votes_text_color' => $user_votes_text_color,
		'user_votes_text_extra_css' => $user_votes_text_extra_css,
		'ranges_text_size' => $ranges_text_size,
		'ranges_text_color' => $ranges_text_color,
		'ranges_text_extra_css' => $ranges_text_extra_css,
		'avg_user_rating_label' => $avg_user_rating_label,
		'your_user_rating_label' => $your_user_rating_label,
		'singular_vote_label' => $singular_vote_label,
		'plural_vote_label' => $plural_vote_label,	
	);

	$ratings = '<div class="gpur-reviews-list-ratings">';
		if ( 1 == $show_site_rating ) {
			$rating_args['data'] = 'site-rating';
			$rating_args['criteria'] = $site_criteria;
			$rating_args['max_rating'] = $site_max_rating;
			$ratings .= GPUR_Show_Rating::gpur_show_rating( get_the_ID(), 'post', $rating_args ); 
		}
		if ( 1 == $show_user_rating ) {
			$rating_args['data'] = 'user-rating';
			$rating_args['criteria'] = $user_criteria;
			$rating_args['max_rating'] = $user_max_rating;
			$ratings .= GPUR_Show_Rating::gpur_show_rating( get_the_ID(), 'post', $rating_args ); 
		}
	$ratings .= '</div>';

	if ( 'style-stars' === $style OR 'style-hearts' === $style OR 'style-squares' === $style OR 'style-circles' === $style OR 'style-bars' === $style OR 'style-icon' === $style OR 'style-image' === $style ) {
		$linear_class = 'gpur-linear';	
	} else {
		$linear_class = 'gpur-non-linear';	
	}
	
}

?>

<section <?php post_class( 'gpur-reviews-list-item ' . $linear_class ); ?>>

	<?php if ( 1 == $show_ranking ) { 
		if ( ! isset( $ranking_counter ) ) { $ranking_counter = 0; } 
		$ranking_counter++; 
		?>
		<div class="gpur-reviews-list-ranking-counter"><?php echo absint( $ranking_counter ); ?></div>
	<?php } 
	
	$review_image = '';
	if ( 'review-image-1' === $image_source && get_post_meta( get_the_ID(), 'gpur_review_image_1', true ) ) {
		$image_id = get_post_meta( get_the_ID(), 'gpur_review_image_1', true );
		$review_image = wp_get_attachment_image( $image_id, gpur_image_dimensions( $image_size ) );
	} elseif ( 'review-image-2' === $image_source && get_post_meta( get_the_ID(), 'gpur_review_image_2', true ) ) {
		$image_id = get_post_meta( get_the_ID(), 'gpur_review_image_2', true );
		$review_image = wp_get_attachment_image( $image_id, gpur_image_dimensions( $image_size ) );
	} elseif ( 'featured-image' === $image_source && has_post_thumbnail() ) {
		$review_image = get_the_post_thumbnail( get_the_ID(), gpur_image_dimensions( $image_size ) );
	}
	
	if ( $review_image && 1 == $show_image && 'gpur-format-list' === $post_format ) { ?>
		<div class="gpur-reviews-list-featured-image">
			<?php if ( 'gpur-ratings-over-image' === $ratings_position ) { echo $ratings; } ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php echo wp_kses_post( $review_image ); ?>
			</a>					
		</div>
	<?php } ?>	

	<div class="gpur-reviews-list-content">

		<?php if ( has_post_thumbnail() && 1 == $show_image && 'gpur-format-list' !== $post_format ) { ?>
			<div class="gpur-reviews-list-featured-image">
				<?php if ( 'gpur-ratings-over-image' === $ratings_position ) { echo $ratings; } ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( gpur_image_dimensions( $image_size ) ); ?>
				</a>					
			</div>
		<?php } ?>	
	
		<?php if ( 1 == $show_title ) {		
			$title = get_the_title();
			if ( '' !== $title_length ) {
				if ( mb_strlen( $title ) > $title_length ) {
					$title = mb_substr( $title, 0, $title_length ) . apply_filters( 'gpur_ellipses', '...' );
				}
			} ?>
			<h2 class="gpur-reviews-list-title gp-loop-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_attr( $title ); ?></a></h2>
		<?php } ?>
		
		<?php if ( 1 == $show_name OR 1 == $show_date OR 1 == $show_comments OR 1 == $show_likes ) { ?>
		
			<div class="gpur-reviews-list-meta gp-loop-meta">
	
				<?php if ( 1 == $show_name ) { ?>
					<span class="gpur-reviews-list-meta-item gpur-reviews-list-name gp-post-meta"><?php the_author_meta( 'display_name' ); ?></span>
				<?php } ?>

				<?php if ( 1 == $show_date ) { ?>
					<span class="gpur-reviews-list-meta-item gpur-reviews-list-date gp-post-meta"><?php the_time( get_option( 'date_format' ) ); ?></span>
				<?php } ?>
	
				<?php if ( 1 == $show_comments ) { ?>
					<span class="gpur-reviews-list-meta-item gpur-reviews-list-comments gp-post-meta">
						<?php comments_popup_link( esc_html__( 'No Comments', 'gpur' ), esc_html__( '1 Comment', 'gpur' ), esc_html__( '% Comments', 'gpur' ), 'comments-link', esc_html__( 'Comments Closed', 'gpur' ) ); ?>
					</span>
				<?php } ?>
	
				<?php if ( 1 == $show_likes ) { ?>
					<?php if ( get_post_meta( get_the_ID(), 'gpur_up_votes', true ) ) {
						if ( 1 == get_post_meta( get_the_ID(), 'gpur_up_votes', true ) ) {
							$text = esc_html__( 'like', 'gpur' );
						} else {
							$text = esc_html__( 'likes', 'gpur' );
						} ?>
					<span class="gpur-reviews-list-meta-item gpur-reviews-list-likes gp-post-meta"><?php sprintf( __( '%d %s', 'gpur' ), get_post_meta( get_the_ID(), 'gpur_up_votes', true ), $text ); ?></span>';
					<?php }
				} ?>
		
			</div>
			
		<?php } ?>	
		
		<?php if ( 1 == $show_excerpt ) {
		
			if ( get_post_meta( get_the_ID(), $excerpt_meta_key, true ) ) {
				$text = strip_tags( get_post_meta( get_the_ID(), $excerpt_meta_key, true ) );
			} else {
				$text = get_the_excerpt();
			}
			
			if ( $text ) {
			
				if ( '' !== $excerpt_length ) {	
					if ( mb_strlen( $text ) > $excerpt_length ) {	
						$text = mb_substr( $text, 0, $excerpt_length ) . apply_filters( 'gpur_ellipses', '...' );
					}
				}	
				$view_link = '';
				
				if ( 1 == $show_view_link ) {
					$view_link = ' <a href="' . get_permalink() . '">' . apply_filters( 'gpur_view_text', esc_html__( 'View', 'gpur' ) ) . '</a>';
				} ?>
				
				<div class="gpur-reviews-list-text">
					<?php echo esc_attr( $text ); ?><?php echo wp_kses_post( $view_link ); ?>
				</div>
				
			<?php }
		} ?>
		
		<?php if ( 'gpur-ratings-below' === $ratings_position ) { echo $ratings; } ?>

	</div>
	
	<?php if ( 'gpur-ratings-to-right' === $ratings_position ) { echo $ratings; } ?>

</section>