<?php if ( ! class_exists( 'GPUR_Review_Templates' ) ) {
	class GPUR_Review_Templates {
		
		public function __construct() {
			add_action( 'init', array( $this, 'register_post_type' ) );
			add_action( 'admin_menu', array( $this, 'add_menu_page' ) );		
		}

		public function add_menu_page() {
		
			add_menu_page( 
				esc_html__( 'Ultimate Reviewer', 'gpur' ), 
				esc_html__( 'Ultimate Reviewer', 'gpur' ), 
				'manage_options', 
				'gpur-templates-page',
				'',
				'dashicons-star-filled'
			);	
			
		} 

		/**
		 * Create review template post type
		 *
		 */			
		public function register_post_type() {		

			$labels = array(
				'name'               => _x( 'Review Templates', 'general name', 'gpur' ),
				'singular_name'      => _x( 'Review Template', 'singular name', 'gpur' ),
				'menu_name'          => _x( 'Review Templates', 'admin menu', 'gpur' ),
				'name_admin_bar'     => _x( 'Review Template', 'add new on admin bar', 'gpur' ),
				'add_new'            => _x( 'Add New', 'review', 'gpur' ),
				'add_new_item'       => esc_html__( 'Add New Review Template', 'gpur' ),
				'new_item'           => esc_html__( 'New Review Template', 'gpur' ),
				'edit_item'          => esc_html__( 'Edit Review Template', 'gpur' ),
				'view_item'          => esc_html__( 'View Review Template', 'gpur' ),
				'all_items'          => esc_html__( 'Review Templates', 'gpur' ),
				'search_items'       => esc_html__( 'Search Review Templates', 'gpur' ),
				'parent_item_colon'  => esc_html__( 'Parent Review Templates:', 'gpur' ),
				'not_found'          => esc_html__( 'No review templates found.', 'gpur' ),
				'not_found_in_trash' => esc_html__( 'No review templates found in Trash.', 'gpur' )
			);
			
			$args = array( 
				'labels'             => $labels,
                'description'        => esc_html__( 'Review template.', 'gpur' ),
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

			register_post_type( 'gpur-template', $args );
			
		}
					
	}
}
new GPUR_Review_Templates();