<?php if ( ! function_exists( 'gpur_summary' ) ) {

	function gpur_summary( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'title' => esc_html__( 'Summary', 'gpur' ),
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',
			'text_size' => '',
			'text_color' => '',
			'text_extra_css' => '',
			'css' => '',
		), $atts ) );
		
		// Unique ID
		$unique_id = 'gpur_' . uniqid();
		
		// Get correct meta key
		$summary_meta_key = gpur_get_summary( get_the_ID() );
		
		// Inline CSS
		$inline_css = '';
		
		// Title
		if ( $title_size ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {font-size: ' . ghostpool_add_units( $title_size ) . ';}';
		} 
		if ( $title_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {color: ' . esc_attr( $title_color ) . ';}';
		} 
		if ( $title_extra_css ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-element-title {' . esc_attr( $title_extra_css ) . '}';
		} 

		// Text
		if ( $text_size ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-summary-text {font-size: ' . ghostpool_add_units( $text_size ) . ';}';
		} 
		if ( $text_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-summary-text {color: ' . esc_attr( $text_color ) . ';}';
		} 
		if ( $text_extra_css ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-summary-text {' . esc_attr( $text_extra_css ) . '}';
		}
			
		wp_register_style( 'gpur-shortcodes', false );
		wp_enqueue_style( 'gpur-shortcodes' );
		wp_add_inline_style( 'gpur-shortcodes', $inline_css );
													
		// Classes
		$css_classes = array(
			'gpur-element-wrapper',
			'gpur-summary-wrapper',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
		$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $atts );

		ob_start(); ?>		

		<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $css_classes ); ?>">
			
			<?php if ( $title ) { ?>
				<h2 class="gpur-element-title"><?php echo esc_attr( $title ); ?></h2>
			<?php } ?>
			
			<div class="gpur-summary-text">
				<?php echo wp_kses_post( get_post_meta( get_the_ID(), $summary_meta_key, true ) ); ?>
			</div>
			
		</div>

		<?php

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_summary', 'gpur_summary' );