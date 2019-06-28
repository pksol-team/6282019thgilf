<?php if ( ! function_exists( 'gpur_review_template' ) ) {

	function gpur_review_template( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'id' => '',
			'classes' => '',
		), $atts ) );

		// If there's no review ID, bail
		if ( ! $id ) {
			return;
		}
		
		// If it's not a review template, bail
		if ( 'gpur-template' !== get_post_type( $id ) ) {
			return;
		}
		
		// Get review template data
		$post = get_post( $id );
		
		// Load custom CSS from review template	
		$inline_css = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );	
		wp_register_style( 'gpur-shortcodes', false );
		wp_enqueue_style( 'gpur-shortcodes' );
		wp_add_inline_style( 'gpur-shortcodes', $inline_css );
						
		// Classes
		$css_classes = array(
			'gpur-element-wrapper',
			'gpur-review-template-wrapper',
			$classes,
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );

		ob_start(); ?>
		
			<div class="<?php echo esc_attr( $css_classes ); ?>">
			
				<?php echo apply_filters( 'the_content', $post->post_content ); ?>
							
			</div>
		
		<?php

		wp_reset_postdata(); 
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_review_template', 'gpur_review_template' );