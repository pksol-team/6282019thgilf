<?php if ( ! function_exists( 'gpur_update_database' ) ) {	
	function gpur_update_database() {
				
		/**
		 * Updating to v1.1
		 *
		 */			
		if ( get_option( 'gpur_db_version' ) < '1.1' ) {

			// Update theme options keys/values
			$options = get_option( 'gpur_settings' );
			if ( $options ) {								
				foreach ( $options as $key => $option ) {
					
					if ( 'review_post_types' === $key ) {
						$post_types = array_search( 'true', $option );
						if ( $post_types ) {
							$options['review_post_types'] = $post_types;
						}	
					}	
					
					if ( 'review_management' === $key ) {
						$roles = array_search( 'true', $option );
						if ( $roles ) {
							$options['review_management'] = $roles;
						}	
					}	
					
				}
				update_option( 'gpur_settings', $options );
			}
			
			update_option( 'gpur_db_version', '1.1' );
			
		}	
				
		/**
		 * Updating to v1.4
		 *
		 */
		if ( get_option( 'gpur_db_version' ) < '1.4' ) {

			// Update theme options keys/values
			$options = get_option( 'gpur_settings' );
			if ( $options ) {						
			
				foreach ( $options as $key => $value ) {
				
					if ( is_array( $options[$key] ) ) { 
					
						foreach( $options[$key] as $var_key => $var_value ) {
				
							if ( $var_key && strpos( $var_key, '_px' ) ) {
								$new_var_key = str_replace( '_px', '', $var_key );
								$options[$key][$new_var_key] = $var_value;
							}	
						
						}	
						
					}	
					
				}
				
				update_option( 'gpur_settings', $options );
			}
			
			update_option( 'gpur_db_version', '1.4' );
			
		}
				
	}	
}
add_action( 'init', 'gpur_update_database' );
