<?php if ( ! function_exists( 'gpur_reviews_list' ) ) {

	function gpur_reviews_list( $atts, $content = null ) {

		ob_start();
				
		echo GPUR_Reviews_List::gpur_reviews_list( '', 'post', $atts );
			
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_reviews_list', 'gpur_reviews_list' );