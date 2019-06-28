<?php if ( ! function_exists( 'gpur_wpb_review_lists' ) ) {
	function gpur_wpb_review_lists() {

		// Review List 1
		$data = array();
		$data['name'] = esc_html__( 'Review List 1', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-review-list-1';
		$data['content'] = <<<CONTENT
[gpur_reviews_list orderby="site-rating-desc" show_ranking="true" show_user_rating="" show_excerpt="" excerpt_length="200" site_max_rating="5" user_max_rating="5" empty_icon_color=""]
CONTENT;
		vc_add_default_templates( $data );

		// Review List 2
		$data = array();
		$data['name'] = esc_html__( 'Review List 2', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-review-list-2';
		$data['content'] = <<<CONTENT
[gpur_reviews_list show_user_rating="" show_view_link="true" image_size="100 x 100" excerpt_length="" ratings_position="gpur-ratings-to-right" site_max_rating="5" user_max_rating="5" style="style-squares-singular" position="position-right" show_ranges_text="true" rating_width="75px" rating_height="75px" rating_text_size="40px" rating_background_color="#1e73be" posts_border_color="#ffffff"]
CONTENT;
		vc_add_default_templates( $data );
		
		// Review List 3
		$data = array();
		$data['name'] = esc_html__( 'Review List 3', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-review-list-3';
		$data['content'] = <<<CONTENT
[gpur_reviews_list post_format="gpur-format-columns-3" show_name="" show_date="" show_site_rating="" show_excerpt="" image_size="384 x 240" excerpt_length="" site_max_rating="10" user_max_rating="5" empty_icon_color="#989898" filled_icon_color="#000000" icon_width="30px" icon_height="30px"]
CONTENT;
		vc_add_default_templates( $data );
		
		// Review List 4
		$data = array();
		$data['name'] = esc_html__( 'Review List 4', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-review-list-4';
		$data['content'] = <<<CONTENT
[gpur_reviews_list orderby="site-rating-desc" show_ranking="true" show_image="" show_name="" excerpt_length="" ratings_position="gpur-ratings-to-right" site_max_rating="5" user_max_rating="5" style="style-gauge-circles-singular" position="position-right" rating_width="75px" rating_height="75px" rating_text_size="26px" rating_text_color="#ffffff" rating_background_color="#000000" rating_border_width="3px" rating_border_color="#ffffff" gauge_width="3px" gauge_filled_color_1="#dd3333" gauge_filled_color_2="#dd7133" gauge_empty_color="#ffffff"]
CONTENT;
		vc_add_default_templates( $data );
		
		// Review List 5
		$data = array();
		$data['name'] = esc_html__( 'Review List 5', 'gpur' );
		$data['weight'] = 0;
		$data['image_path'] = '';
		$data['custom_class'] = 'gpur-wpb-review-list-5';
		$data['content'] = <<<CONTENT
[gpur_reviews_list show_user_rating="" show_view_link="true" image_size="100 x 100" excerpt_length="" site_criteria="Criteria 1,Criteria 2,Criteria 3" site_max_rating="5" user_max_rating="5" style="style-hearts" empty_icon_color=""]
CONTENT;
		vc_add_default_templates( $data );						
	
	}
}	
add_action( 'vc_load_default_templates_action', 'gpur_wpb_review_lists' );