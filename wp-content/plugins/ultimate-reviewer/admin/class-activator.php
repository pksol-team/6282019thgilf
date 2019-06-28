<?php if ( ! class_exists( 'GPUR_Activator' ) ) {
	class GPUR_Activator {

		public static function activate() {

			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			/**
			 * Create review template before creating default post type
			 *
			 */
			$args = array(
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => 'gpur-templates-page',
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'gpur-template' ),
				'capability_type'    => 'post',
				'has_archive'        => false,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'custom-fields' ),
			);

			register_post_type( 'gpur-template' );

			/**
			 * Create default review template upon activation once
			 *
			 */	
			if ( '' == get_option( 'gpur_default_template_installed' ) ) {	

				$post_content = '[vc_row][vc_column][gpur_show_rating criteria="Criterion 1,Criterion 2,Criterion 3,Criterion 4" format="format-column" style="style-bars" show_your_user_rating_text="" show_ranges_text=""][vc_row_inner content_placement="middle"][vc_column_inner width="5/6" css=".vc_custom_1540992759876{margin-bottom: 35px !important;}"][gpur_summary][/vc_column_inner][vc_column_inner width="1/6" css=".vc_custom_1540992765861{margin-bottom: 35px !important;}"][gpur_show_rating show_maximum_rating_text="1" show_ranges_text="" rating_text_size="30px" rating_text_color="#000000" maximum_rating_text_size="30px"][/vc_column_inner][/vc_row_inner][gpur_show_rating data="user-rating" max_rating="5" style="style-stars" show_ranges_text="" text_position="position-text-left" avg_user_rating_text_size="18px" avg_user_rating_label="User Rating:" rating_text_position="position-left" show_your_user_rating_text_at_top="1" bb_tab_container=""][/vc_column][/vc_row]';
		
				$args = array(
				  'post_title'    => esc_html__( 'Default Review Template', 'gpur' ),
				  'post_content'  => $post_content,
				  'post_status'   => 'publish',
				  'post_type'     => 'gpur-template',
				);
 
				wp_insert_post( $args );
			
				update_option( 'gpur_default_template_installed', 'yes' );

			}
		
		}

	}
}