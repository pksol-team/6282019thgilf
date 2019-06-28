<?php if ( ! class_exists( 'GPUR_Gutenberg' ) ) {
	class GPUR_Gutenberg {

		public function __construct() {
				
			if ( is_admin() ) {
				add_action( 'init', array( $this, 'enqueue_scripts' ) );
			}
			add_action( 'init', array( $this, 'register_blocks' ) );
			
			function gpur_review_template_block( $attributes ) {
				$review_template_id = isset( $attributes['review_template_id'] ) ? $attributes['review_template_id'] : '';
				return do_shortcode( '[gpur_review_template id="'. $review_template_id . '"]' );
			}
			
		}	

		public function enqueue_scripts() {
			wp_enqueue_script( 'gpur-gutenberg-blocks', plugin_dir_url( __FILE__ ) . 'assets/gutenberg-blocks.js', array( 'wp-blocks', 'wp-element', 'wp-components' ), '', false );
		}
		
		public function register_blocks() {
			
			
			wp_localize_script( 'gpur-gutenberg-blocks', 'gpur_gutenberg_blocks', array(
				'review_templates' => gpur_templates_dropdown_values(),
			) );	

			register_block_type( 'gpur/review-template', 
				array(
					'render_callback' => 'gpur_review_template_block',
					'attributes' => array(
                		'review_template_id' => array(
                    		'type' => 'string',
						),
					),
				) 
			);
			
		}
		
	}
}
new GPUR_Gutenberg();