<?php if ( ! class_exists( 'GPUR_Framework_Metaboxes' ) ) {
	class GPUR_Framework_Metaboxes {
     
		private $framework;
		
		public function __construct() {
		
			global $pagenow;
				
			// Framework data 
			$this->framework = gpur_framework_data();
			
			if ( 'post.php' === $pagenow OR 'post-new.php' === $pagenow ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			}
				
			add_action( 'add_meta_boxes', array( $this, 'register_metaboxes' ) );
			add_action( 'save_post', array( $this, 'save_settings' ) );
						
		}
				
		public function enqueue_scripts() {
			wp_enqueue_style( 'ghostpool-framework-settings' );
			wp_enqueue_script( 'ghostpool-framework-metaboxes' );
			wp_enqueue_script( 'ghostpool-framework-dependencies' );
		}
		 
		public function register_metaboxes() {
			
			$settings = gpur_metaboxes_settings();

			if ( $settings ) {
			
				foreach( $settings as $setting ) {
											
					$defaults = array(
						'id' => '',
						'title' => '',
						'post_types' => array( 'post' ),
						'position' => 'normal',	
						'priority' => 'high',
						'post_formats' => array(),
						'page_templates' => array(),
					);
			
					$setting = wp_parse_args( $setting, $defaults );
			
					add_meta_box( 
						$setting['id'], 
						$setting['title'], 
						array( $this, 'register_settings' ), 
						$setting['post_types'],
						$setting['position'],
						$setting['priority'],
						array( 
							'id' => $setting['id'],
							'post_formats' => $setting['post_formats'],
							'page_templates' => $setting['page_templates']
						)
					);

					if ( is_array( $setting['post_types'] ) ) {
						if ( in_array( 'page', $setting['post_types'] ) && ! empty( $setting['page_templates'] ) ) {
							add_filter( 'postbox_classes_page_' . $setting['id'], array( $this, 'add_metabox_classes' ) );	
						}
						if ( in_array( 'post', $setting['post_types'] ) && ! empty( $setting['post_formats'] ) ) {
							add_filter( 'postbox_classes_post_' . $setting['id'], array( $this, 'add_metabox_classes' ) );						
						}
					}	
					
				}			
						
			}		
				
		}
					
		public function add_metabox_classes( $classes = array() ) {
			global $post;
			if ( ! in_array( 'gp-postbox', $classes ) ) {
				$classes[] = 'gp-postbox';
				if ( 'post' === $post->post_type ) {
					$classes[] = 'gp-postbox-post-format';
				}
				if ( 'page' === $post->post_type ) {	
					$classes[] = 'gp-postbox-page-template';
				}
			}
			return $classes;
		}
																
		public function register_settings( $post, $args ) {
			
			wp_nonce_field( 'ghostpool_metaboxes_action', 'ghostpool_metaboxes_nonce' );

			$settings = gpur_metaboxes_settings();
				
			if ( $settings ) {
			
				echo '<div class="gp-settings-section gp-show">';

					foreach( $settings as $setting ) {

						// Check if this setting should be shown on this page
						if ( isset( $setting['id'] ) && isset( $args['args']['id'] ) && ( $setting['id'] === $args['args']['id'] ) ) {
					
							foreach( $setting['section'] as $single_setting ) {
						
								// Get extracted setting variables
								$settings = ghostpool_default_setting_fields( $single_setting );
								if ( $settings && is_array( $settings ) ) {
									extract( $settings );
								}
						
								echo '<div class="gp-setting ' . esc_attr( $class ) . '">';
						
									// Name variable
									$name = $id;
									
									// Get value 
									$value = get_post_meta( $post->ID, $id, true );

									if ( isset( $title ) ) {
										echo '<label>' . esc_html( $title ) . '</label>';
									}
							
									// Load field types
									ghostpool_settings_field_types( $name, $value, $settings );	
																				
								echo '</div>';					
				
							}
						
						}
					
					}
					
				echo '</div>';
	
			}
						 
		}

		public function save_settings( $post_id ) {
			
			$post_id = (int) $post_id;
			
			if ( ! isset( $_POST['ghostpool_metaboxes_nonce'] ) ) {
				return;
			}
 
			if ( ! wp_verify_nonce( $_POST['ghostpool_metaboxes_nonce'], 'ghostpool_metaboxes_action' ) ) {
				return;
			}
 
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
 
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
 
			if ( isset( $_POST['post_type'] ) ) {
 				$settings = gpur_metaboxes_settings();
			}

			if ( $settings ) {
	
				foreach( $settings as $setting ) {
				
					foreach( $setting['section'] as $single_setting ) {

						extract( $single_setting );
	
						// Get the data being saved
						if ( isset( $_POST[$id] ) ) {
					
							if ( 'multi_text' === $type ) {
						
								$new_value = array();
								$count = count( $_POST[$id] );
								for ( $i = 0; $i < $count - 1; $i++ ) {
									$new_value[$i] = $_POST[$id][$i];
								}
							
							} else {	
					
								$new_value = $_POST[$id];
						
							}
							
						} else {
					
							$new_value = '';
						
						}	

						// Get current value
						$current_value = get_post_meta( $post_id, $id, true );

						if ( $new_value && ( ( '' === $current_value ) OR ( $new_value !== $current_value ) ) ) {
							update_post_meta( $post_id, $id, $new_value, $current_value );
						} elseif ( ( '' === $new_value OR array() === $new_value ) && $current_value ) {
							delete_post_meta( $post_id, $id, $current_value );
						}
						
					}	

				}
			}
			
		}
				
	}
}		
if ( is_admin() ) {
	new GPUR_Framework_Metaboxes();
}