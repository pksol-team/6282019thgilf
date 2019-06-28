<?php

/**
 * WPB - Permission roles checkbox field values
 *
 */
function gpur_permissions_role_checkbox_values() {
	$roles = wp_roles()->get_names();
	if ( $roles ) {
		$output = array();
		foreach ( $roles as $id => $role ) {  			
			$output[ $role ] = $id;
		}
	}
	return $output;
}	

/**
* vc_row/vc_row_inner - Add visiblity option
*
*/
$attributes = array(
	'param_name' => 'offset',
	'heading' => esc_html__( 'Responsiveness', 'gpur' ),
	'description' => esc_html__( 'Adjust inner row for different screen sizes. Control visibility settings.', 'gpur' ),
	'type' => 'column_offset',
	'group' => esc_html__( 'Responsive Options', 'gpur' ),
);
vc_add_param( 'vc_row', $attributes );
vc_add_param( 'vc_row_inner', $attributes );	

if ( ! class_exists( 'GPUR_Page_Builder' ) ) {
	class GPUR_Page_Builder {

		public function __construct() {
		
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
					
			remove_action( 'admin_init', array( $this, 'vc_page_welcome_redirect' ) );
			
			add_action( 'vc_before_init', array( $this, 'page_builder_defaults' ), 9 );
			
			add_filter( 'vc_shortcodes_css_class', array( $this, 'row_classes' ), 10, 3 );
			
			add_filter( 'vc_grid_item_shortcodes', array( $this, 'add_grid_modules' ) );
		
			add_shortcode( 'gpur_grid_show_rating', array( $this, 'grid_show_rating_render' ) );
	
			add_filter( 'vc_gitem_template_attribute_gpur_grid_show_rating', array( $this, 'template_attribute_grid_show_rating' ), 10, 2 );

			vc_add_shortcode_param( 'gpur_header', array( $this, 'header_field' ) );
			$this->load_files();
			
		}

		public function enqueue_scripts() {
				
			wp_enqueue_style( 'gpur-page-builder', plugin_dir_url( __FILE__ ) . 'assets/page-builder.css', array(), GPUR_VERSION );	

		}

		public function load_files() {

			require_once( plugin_dir_path( __FILE__ ) . 'review-template-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'reviews-list-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'add-user-ratings-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'bad-points-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'comparison-table-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'good-points-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'show-rating-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'summary-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'up-down-voting-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'excerpt-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'image-options.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'review-button-options.php' );
			
			require_once( plugin_dir_path( __FILE__ ) . 'preset-review-lists-templates.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'preset-review-templates.php' );
			require_once( plugin_dir_path( __FILE__ ) . 'preset-comparison-table-templates.php' );

		}
	
		public function page_builder_defaults() {
			
			// Disable design options 
			vc_set_as_theme();
			
			// Enabled specified post types by default		
			vc_set_default_editor_post_types( array( 'page', 'post', 'gpur-template' ) );

			// Remove Visual Composer activation notice
			setcookie( 'vchideactivationmsg', '1', strtotime( '+3 years' ), '/' );
			setcookie( 'vchideactivationmsg_vc11', ( defined( 'WPB_VC_VERSION' ) ? WPB_VC_VERSION : '1' ), strtotime( '+3 years' ), '/' );
			
		}

		/**
		 * Create WPB header field
		 *
		*/
		public function header_field( $settings, $value ) {
			return '<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' . esc_attr( $settings['param_name'] ) . ' ' . esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />';
		}

		/**
		* vc_row - Add custom classes to vc_row
		*
		*/
		public function row_classes( $class_string, $tag, $atts ) {	
			if ( 'vc_row' === $tag OR 'vc_row_inner' === $tag ) {	
				$class_string .=  ' ' . $atts['offset'];		
			}
			return esc_attr( $class_string );	
		}
	
		/**
		 * Add grid modules
		 *
		 */			
		public function add_grid_modules( $shortcodes ) {
		
			global $gpur_show_rating_params;
		
			$shortcodes['gpur_grid_show_rating'] = array(
				'name' => esc_html__( 'Rating', 'huber' ),
				'base' => 'gpur_grid_show_rating',
				'class' => 'gpur-wpb-grid-show-rating',
				'category' => esc_html__( 'Content', 'huber' ),
				'description' => esc_html__( 'Show rating', 'huber' ),
				'icon' => 'gpur-icon-grid-show-rating',
				'post_type' => Vc_Grid_Item_Editor::postType(),
				'params' => $gpur_show_rating_params,	
		   );
	  
		   return $shortcodes;
   
		}

		public function grid_show_rating_render( $atts ) {	
			return '{{ gpur_grid_show_rating:' . http_build_query( (array) $atts ) . ' }}';
		}

		public function template_attribute_grid_show_rating( $value, $data ) {
			 extract( array_merge( array(
			  'post' => null,
			  'data' => '',
			 ), $data ) );	 
			parse_str( $data, $atts );	
			return GPUR_Show_Rating::gpur_show_rating( $post->ID, 'post', $atts );		
		}

	}
}	
new GPUR_Page_Builder();