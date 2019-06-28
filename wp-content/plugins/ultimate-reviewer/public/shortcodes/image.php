<?php if ( ! function_exists( 'gpur_image' ) ) {

	function gpur_image( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'image_size' => 'thumbnail',
			'image_source' => 'review-image-1',
			'image_as_bg' => '',
			'css' => '',
		), $atts ) );
		
		// Unique ID
		$unique_id = 'gpur_' . uniqid();
		
		$style = '';
		$image = '';

		// Get image ID
		if ( 'review-image-1' === $image_source ) {
			$image_id = get_post_meta( get_the_ID(), 'gpur_review_image_1', true );
		} elseif ( 'review-image-2' === $image_source ) {
			$image_id = get_post_meta( get_the_ID(), 'gpur_review_image_2', true );
		} elseif ( 'featured-image' === $image_source ) {
			$image_id = get_post_thumbnail_id( get_the_ID() );
		}

		if ( $image_id > 0 ) {
			if ( true == $image_as_bg ) {
				$image_url = wp_get_attachment_image_src( $image_id, gpur_image_dimensions( $image_size ) );
				$style = ' style="background-image: url(' . $image_url[0] . ');"';
			} else {
				$image = wp_get_attachment_image( $image_id, gpur_image_dimensions( $image_size ) );
			}
		}
								
		// Classes
		$css_classes = array(
			'gpur-element-wrapper',
			'gpur-image-wrapper',
			( true == $image_as_bg ) ? 'gpur-image-background' : '',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
		$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $atts );

		ob_start(); ?>		

		<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $css_classes ); ?>"<?php echo wp_kses_post( $style ); ?>>
			
			<?php if ( $image ) { ?>
				<div class="gpur-review-image">
					<?php echo wp_kses_post( $image ); ?>
				</div>
			<?php } ?>
						
		</div>

		<?php

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_image', 'gpur_image' );