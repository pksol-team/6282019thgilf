<?php if ( ! function_exists( 'gpur_show_rating' ) ) {

	function gpur_show_rating( $atts, $content = null ) {

		ob_start();
		
		$post_id = gpur_get_hub_id( get_the_ID() );
				
		echo GPUR_Show_Rating::gpur_show_rating( $post_id, 'post', $atts );
			
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_show_rating', 'gpur_show_rating' );