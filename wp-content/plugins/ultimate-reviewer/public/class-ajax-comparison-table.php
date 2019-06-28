<?php if ( ! class_exists( 'GPUR_Ajax_Comparison_Table' ) ) {
	class GPUR_Ajax_Comparison_Table {

		public function __construct() {
			add_action( 'wp_ajax_gpur_comparison_table_sorting', array( $this, 'gpur_comparison_table_sorting' ) );
			add_action( 'wp_ajax_nopriv_gpur_comparison_table_sorting', array( $this, 'gpur_comparison_table_sorting' ) );
		}

		public function gpur_comparison_table_sorting() {	
	
			if ( isset( $_GET['action'] ) && 'gpur_comparison_table_sorting' === $_GET['action'] ) {
	
				// Check the nonce
				check_ajax_referer( 'gpur_comparison_table_sorting_nonce', 'nonce' );
				
				// Query
				$args = array(
					'sort' => $_GET['sorting'],
				);
				
				$args = wp_parse_args( $args, $_GET['atts'] );
				
				echo gpur_do_shortcode_func( 'gpur_comparison_table', $args );
				
				die();

			}
			
		}	
	
	}
}
new GPUR_Ajax_Comparison_Table();	