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

<div class="gpur-criterion<?php echo esc_attr( $order_class ); ?>">

	<?php if ( isset( $criterion ) && $criterion ) { ?>	
	
		<?php if ( ( isset( $criterion ) && $criterion ) && ( 1 == $show_avg_user_rating_text OR 1 == $show_your_user_rating_text ) && 'position-text-top' === $text_position ) { ?><div class="gpur-title-with-top-text"><?php } ?>
	
			<div class="gpur-criterion-title">
				<?php echo esc_attr( $criterion ); ?>
			</div>
		
	<?php } ?>
	
	<?php if ( 'style-stars' === $style['class'] OR 'style-squares' === $style['class'] OR 'style-circles' === $style['class'] OR 'style-hearts' === $style['class'] OR 'style-bars' === $style['class'] OR 'style-icon' === $style['class'] OR 'style-image' === $style['class'] ) { ?>

			<?php if ( ( 1 == $show_avg_user_rating_text OR 1 == $show_ranges_text OR 1 == $show_your_user_rating_text ) && $text_position != 'position-text-bottom' ) { ?>
				<?php echo wp_kses_post( $display_rating[$counter] ); ?>
			<?php } ?>	
		
		<?php if ( ( isset( $criterion ) && $criterion ) && ( 1 == $show_avg_user_rating_text OR 1 == $show_your_user_rating_text) && 'position-text-top' === $text_position ) { ?></div><?php } ?>
		
		<input type="hidden" class="rating gpur-user-rating" 
		data-filled="<?php echo esc_attr( $style['filled'] ); ?>" 
		data-empty="<?php echo esc_attr( $style['empty'] ); ?>" 
		data-start="0" 
		data-stop="<?php echo esc_attr( $max_rating ); ?>" 
		data-step="<?php echo esc_attr( $step ); ?>" 
		value="<?php echo floatval( $rating_value[$counter] ); ?>" 
		data-readonly />

		<?php if ( ( 1 == $show_avg_user_rating_text OR 1 == $show_ranges_text OR 1 == $show_your_user_rating_text ) && 'position-text-bottom' === $text_position ) { ?>	
			<?php echo wp_kses_post( $display_rating[$counter] ); ?>
		<?php } ?>
	
	<?php } else { ?>
	
		<div class="gpur-rating-outer<?php echo esc_attr( $degrees_class[$counter] ); ?>">
	
			<?php if ( 'style-gauge-circles-singular' === $style['class'] ) { ?>
				<div class="gpur-gauge-circle gpur-gauge-1">
					<div class="gpur-gauge-spinner"<?php echo ' style="-webkit-transform:rotate(' . absint( $degrees[$counter] ) . 'deg);transform:rotate(' . absint( $degrees[$counter] ) . 'deg);"'; ?>></div>
				</div>
				<div class="gpur-gauge-circle gpur-gauge-2">
					<div class="gpur-gauge-filler"></div>
				</div>		
			<?php } ?>
	
			<div class="gpur-rating-inner">
				<?php echo wp_kses_post( $display_rating[$counter] ); ?>
			</div>

		</div>

	<?php } ?>
	
</div>

<?php if ( 'format-column' === $format && 1 != $criterion_boxes ) { ?>
	<div class="gpur-clear"></div>
<?php } ?>