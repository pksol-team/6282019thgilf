<?php if ( ! function_exists( 'gpur_bad_points' ) ) {

	function gpur_bad_points( $atts, $content = null ) {	
		
		extract( shortcode_atts( array(
			'title' => esc_html__( 'Bad', 'gpur' ),
			'title_size' => '',
			'title_color' => '',
			'title_extra_css' => '',
			'icon' => 'fa fa-angle-right',
			'icon_size' => '',
			'icon_color' => '',
			'icon_extra_css' => '',
			'text_size' => '',
			'text_color' => '',
			'text_extra_css' => '',
			'css' => '',
		), $atts ) );

		// Unique ID
		$unique_id = 'gpur_' . uniqid();
		
		// Get correct meta key
		$bad_point_meta_key = gpur_get_bad_points( get_the_ID() );

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
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-bad-list li {font-size: ' . ghostpool_add_units( $text_size ) . ';}';
		} 
		if ( $text_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-bad-list li {color: ' . esc_attr( $text_color ) . ';}';
		} 
		if ( $text_extra_css ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-bad-list li {' . esc_attr( $text_extra_css ) . '}';
		} 

		// Icon
		if ($icon_size ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-bad-list li i:before {font-size: ' . ghostpool_add_units( $icon_size ) . ';}';
		} 
		if ( $icon_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-bad-list li i:before {color: ' . esc_attr( $icon_color ) . ';}';
		} 
		if ( $icon_extra_css ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-bad-list li i:before {' . esc_attr( $icon_extra_css ) . '}';
		} 
		
		wp_register_style( 'gpur-shortcodes', false );
		wp_enqueue_style( 'gpur-shortcodes' );
		wp_add_inline_style( 'gpur-shortcodes', $inline_css );
			
		// Classes
		$css_classes = array(
			'gpur-element-wrapper',
			'gpur-bad-points-wrapper',
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );
		$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $atts );
		
		ob_start(); ?>		

		<div id="<?php echo esc_attr( $unique_id ); ?>" class="<?php echo esc_attr( $css_classes ); ?>">
			
			<?php if ( $title ) { ?>
				<h2 class="gpur-element-title"><?php echo esc_attr( $title ); ?></h2>
			<?php } ?>
			
			<?php
			
			$bad_points = get_post_meta( get_the_ID(), $bad_point_meta_key, true );
						
			if ( ! empty( $bad_points ) ) { ?>
			
				<ul class="gpur-bad-list">
				
					<?php foreach( $bad_points as $bad_point ) { ?>
						<li><i class="<?php echo esc_attr( $icon ); ?>"></i><?php echo esc_attr( $bad_point ); ?></li>
					<?php } ?>
				
				</ul>
				
			<?php } ?>

		</div>

		<?php

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_bad_points', 'gpur_bad_points' );