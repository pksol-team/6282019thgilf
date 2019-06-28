<?php 

$counter = $i++; 
if ( is_array( $criteria['fields'] ) ) {
	$length = count( $criteria['fields'] );
} else {
	$length = 0;
}

$order_class = '';
if ( 0 === $counter ) {
	$order_class = ' gpur-first';
} elseif ( ( $length - 1 ) === $counter ) {
	$order_class = ' gpur-last';
}

?>

<<?php echo esc_attr( $container_tag ); ?> class="gpur-criterion<?php echo esc_attr( $order_class ); ?>">
		
	<?php if ( isset( $criterion ) && $criterion ) { ?>	
	
		<?php if ( ( isset( $criterion ) && $criterion ) && 1 == $show_your_user_rating_text  && 'position-text-top' === $text_position ) { ?><<?php echo esc_attr( $container_tag ); ?> class="gpur-title-with-top-text"><?php } ?>
	
			<<?php echo esc_attr( $container_tag ); ?> class="gpur-criterion-title">
				<?php echo esc_attr( $criterion ); ?>
			</<?php echo esc_attr( $container_tag ); ?>>
		
	<?php } ?>
	
		<?php if ( ( 1 == $show_avg_user_rating_text OR 1 == $show_your_user_rating_text ) && 'position-text-bottom' !== $text_position ) { ?>
			<?php echo wp_kses_post( $display_rating[$counter] ); ?>
		<?php } ?>	
	
	<?php if ( ( isset( $criterion ) && $criterion ) && 1 == $show_your_user_rating_text && 'position-text-top' === $text_position ) { ?></<?php echo esc_attr( $container_tag ); ?>><?php } ?>

	<input type="hidden" name="gpur_rating[]" class="rating gpur-user-rating<?php if ( 'comment' === $meta ) { ?> gpur-comment-rating<?php } ?>" 
	data-post-id="<?php the_ID(); ?>"
	data-nonce="<?php echo wp_create_nonce( 'gpur_save_rating_nonce' ); ?>"
	data-weight="<?php echo isset( $criteria['weights'][$counter] ) ? floatval( $criteria['weights'][$counter] ) : ''; ?>" 
	data-filled="<?php echo esc_attr( $style['filled'] ); ?>" 
	data-empty="<?php echo esc_attr( $style['empty'] ); ?>" 
	data-start="0"
	data-min-rating="<?php echo esc_attr( $min_rating ); ?>" 
	data-stop="<?php echo esc_attr( $max_rating ); ?>" 
	data-step="<?php echo esc_attr( $step ); ?>" 
	data-fractions="<?php echo esc_attr( $fractions ); ?>" 
	value="<?php echo esc_attr( $your_user_rating_value[$counter] ); ?>"
	<?php if ( 'yes' === $is_rated ) { ?> data-readonly<?php } ?> />

	<?php if ( ( 1 == $show_avg_user_rating_text OR 1 == $show_your_user_rating_text ) && 'position-text-bottom' === $text_position ) { ?>
		<?php echo wp_kses_post( $display_rating[$counter] ); ?>
	<?php } ?>
	
</<?php echo esc_attr( $container_tag ); ?>>

<?php if ( 'format-column' === $format && 1 != $criterion_boxes ) { ?>
	<<?php echo esc_attr( $container_tag ); ?> class="gpur-clear"></<?php echo esc_attr( $container_tag ); ?>>
<?php } ?>