<?php if ( ! function_exists( 'gpur_review_button' ) ) {

	function gpur_review_button( $atts, $content = null ) {
		
		extract( shortcode_atts( array(			
			'text' => 'Button Text',
			'link' => '',
			'button_padding_width' =>'15px',
			'button_padding_height' =>'10px',
			'button_color' => '#000',
			'button_hover_color' => '#333',
			'text_size' => '20px',
			'text_color' => '#fff',
			'text_hover_color' => '#fff',
			'border_width' => '',
			'border_radius' => '',
			'border_color' => '',
			'border_hover_color' => '',
			'button_alignment' => 'button-left',
			'icon' => '',
			'icon_size' => '20px',
			'icon_color' => '#fff',
			'icon_hover_color' => '#fff',
			'icon_alignment' => 'icon-left',
			'css' => '',
		), $atts ) );

		// Unique ID
		$unique_id = 'gpur_' . uniqid();
			
		// Button Text
		if ( get_post_meta( get_the_ID(), 'gpur_review_button_text', true ) ) {
			$text = get_post_meta( get_the_ID(), 'gpur_review_button_text', true );
		}
		$text = '<span class="gpur-review-button-text">' . $text . '</span>';
		
		// Button Link
		if ( get_post_meta( get_the_ID(), 'gpur_review_button_link', true ) ) {
			$link = get_post_meta( get_the_ID(), 'gpur_review_button_link', true );
		}
		
		// Icon 
		if ( $icon ) {
			$icon = '<i class="' . $icon . '"></i>';
		}
			
		// Inline CSS
		$inline_css = ''; 
		
		// Button padding width
		if ( $button_padding_width ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button {padding-left: ' . ghostpool_add_units( $button_padding_width ) . '; padding-right: ' . ghostpool_add_units( $button_padding_width ) . ';}';
		}

		// Button padding height
		if ( $button_padding_height ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button {padding-top: ' . ghostpool_add_units( $button_padding_height ) . '; padding-bottom: ' . ghostpool_add_units( $button_padding_height ) . ';}';
		}
						
		// Button color
		if ( $button_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button {background-color: ' . esc_attr( $button_color ) . ';}';
		}
		
		// Button hover color
		if ( $button_hover_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button:hover {background-color: ' . esc_attr( $button_hover_color ) . ';}';
		}
		
		// Text size
		if ( $text_size ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button-text {font-size: ' . ghostpool_add_units( $text_size ) . ';}';
		}
		
		// Text color
		if ( $text_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button .gpur-review-button-text {color: ' . esc_attr( $text_color ) . ';}';
		}
		
		// Text hover color
		if ( $text_hover_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button:hover .gpur-review-button-text {color: ' . esc_attr( $text_hover_color ) . ';}';
		}
		
		// Border width
		if ( $border_width ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button {border-width: ' . ghostpool_add_units( $border_width ) . ';}';
		}
		
		// Border radius
		if ( $border_radius ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button {border-radius: ' . ghostpool_add_units( $border_radius ) . ';}';
		}
		
		// Border color
		if ( $border_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button {border-color: ' . esc_attr( $border_color ) . ';}';
		}
		
		// Border hover color
		if ( $border_hover_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button:hover {border-color: ' . esc_attr( $border_hover_color ) . ';}';
		}
		
		// Border hover color
		if ( $border_hover_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button:hover {border-color: ' . esc_attr( $border_hover_color ) . ';}';
		}
		
		// Icon size
		if ( $icon_size ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button i {font-size: ' . esc_attr( $icon_size ) . ';}';
		}
		
		// Icon color
		if ( $icon_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button i {color: ' . esc_attr( $icon_color ) . ';}';
		}
		
		// Icon hover color
		if ( $icon_hover_color ) {
			$inline_css .= '#' . esc_attr( $unique_id ) . ' .gpur-review-button:hover i {color: ' . esc_attr( $icon_hover_color ) . ';}';
		}
			
		wp_register_style( 'gpur-shortcodes', false );
		wp_enqueue_style( 'gpur-shortcodes' );
		wp_add_inline_style( 'gpur-shortcodes', $inline_css );
																				
		// Classes
		$css_classes = array(
			'gpur-button-wrapper',
			'gpur-' . $button_alignment,
			'gpur-' . $icon_alignment,
		);
		$css_classes = trim( implode( ' ', array_filter( array_unique( $css_classes ) ) ) );		
		$css_classes = apply_filters( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG', $css_classes . gpur_custom_css_class( $css, ' ' ), '', $atts );
								
		ob_start();
		
		echo '<div id="' . esc_attr( $unique_id ) . '" class="' . esc_attr( $css_classes ) . '">';
		
			if ( $link ) {
				echo '<a href="' . esc_url( $link ) . '" class="gpur-review-button">' . wp_kses_post( $icon . $text ) . '</a>';
			} else {
				echo '<div class="gpur-review-button">' . wp_kses_post( $icon . $text ) . '</div>';
			}
		
		echo '</div>';
					
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_review_button', 'gpur_review_button' );