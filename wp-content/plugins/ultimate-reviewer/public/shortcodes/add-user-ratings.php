<?php if ( ! function_exists( 'gpur_add_user_ratings' ) ) {

	function gpur_add_user_ratings( $atts, $content = null ) {

		ob_start(); 
		
		$post_id = gpur_get_hub_id( get_the_ID() );

		echo GPUR_Add_User_Ratings::gpur_add_user_ratings( $post_id, 'post', $atts );
		
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
add_shortcode( 'gpur_add_user_ratings', 'gpur_add_user_ratings' );