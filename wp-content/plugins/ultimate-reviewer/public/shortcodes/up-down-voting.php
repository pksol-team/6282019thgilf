<?php if ( ! function_exists( 'gpur_up_down_voting' ) ) {

	function gpur_up_down_voting( $atts, $content = null ) {

		ob_start();
		
		echo GPUR_Up_Down_Voting::gpur_up_down_voting( get_the_ID(), 'post', $atts );
		
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_up_down_voting', 'gpur_up_down_voting' );