<?php 

wp_enqueue_script( 'ghostpool-typography-field' );

// Set order of variables
$key_order = array(
	'font-family',
	'font-backup',
	'font-size',
	'line-height',
	'color',
	'font-weight',
	'subsets',
	'font-style',
	'letter-spacing',
	'word-spacing',
	'text-transform',
	'text-align',
	'text-decoration',
);
$new_order = array();
foreach( $key_order as $key ) {
	if ( isset( $default[$key] ) ) {
		$new_order[$key] = $default[$key];
	}
}

if ( isset( $new_order ) ) {
	
	$count = count( $default );
	
	foreach( $new_order as $key => $default_value ) {				

		$new_id = $id . '-' . $key;
		$new_name = $name . '[' . $key . ']';
		$new_value = isset( $value[$key] ) ? $value[$key] : $default_value;

		$field_class = 'gp-' . $key . '-field';

		if ( 1 === $count ) {
			$field_class .= ' gp-single-styling-field';
		}
		
		// Settings
		if ( 'font-size' === $key ) {
		
			// Only allow numeric characters
			$new_value = preg_replace( "/[^(-?\d+\.)?-?\d]+/", '', $new_value );

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Font Size', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';

		} elseif ( 'line-height' === $key ) {
			
			// Only allow numeric characters
			
			$new_value = preg_replace( "/[^(-?\d+\.)?-?\d]+/", '', $new_value );

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Line Height', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';

		} elseif ( 'font-family' === $key ) {
		
			wp_enqueue_style( 'select2css' );
			wp_enqueue_script( 'select2js' );

			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
	
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Font Family', 'gpur' ) . '</label>';

				echo '<select id="' . esc_attr( $new_id ) . '" class="post_form select2-field" name="' . esc_attr( $new_name ) . '">';
				
					if ( ghostpool_google_fonts_array() ) {
						foreach( ghostpool_google_fonts_array() as $font ) {
							if ( $new_value === $font ) {
								$checked = ' selected="selected"';
							} else {
								$checked = '';
							}
							echo '<option value="' . esc_attr( $font ) . '"' . $checked . '>' . esc_attr( $font ) . '</option>';
						}
					}
										
				echo '</select>';
			
			echo '</span>';

		} elseif ( 'font-backup' === $key ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Backup Font Family', 'gpur' ) . '</label>';
				echo '<select id="' . esc_attr( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					if ( ghostpool_backup_fonts_array() ) {
						foreach( ghostpool_backup_fonts_array() as $font ) {
							if ( $new_value === $font ) {
								$checked = ' selected="selected"';
							} else {
								$checked = '';
							}
							echo '<option value="' . esc_attr( $font ) . '" ' . $checked . '>' . esc_attr( $font ) . '</option>';
						}
					}	
				echo '</select>';
			echo '</span>';
		
		} elseif ( 'font-weight' === $key ) {

			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Font Variants', 'gpur' ) . '</label>';
				echo '<select id="' . esc_attr( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					$font_family = isset( $value['font-family'] ) ? $value['font-family'] : $default['font-family'];
					echo $font_family;
					if ( ghostpool_google_font_variants_array( $font_family ) ) {
						foreach( ghostpool_google_font_variants_array( $font_family ) as $title => $key ) {
							if ( $new_value === $key ) {
								$checked = ' selected="selected"';
							} else {
								$checked = '';
							}
							echo '<option value="' . esc_attr( $key ) . '"' . $checked . '>' . esc_attr( $title ) . '</option>';
						}
					}	
				echo '</select>';
			echo '</span>';

		} elseif ( 'subsets' === $key ) {

			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Font Subsets', 'gpur' ) . '</label>';
				echo '<select id="' . esc_attr( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					$font_family = isset( $value['font-family'] ) ? $value['font-family'] : $default['font-family'];
					if ( ghostpool_google_font_subsets_array( $font_family ) ) {
						foreach( ghostpool_google_font_subsets_array( $font_family ) as $key => $title ) {
							if ( $new_value === $key ) {
								$checked = ' selected="selected"';
							} else {
								$checked = '';
							}
							echo '<option value="' . esc_attr( $key ) . '"' . $checked . '>' . esc_attr( $title ) . '</option>';
						}
					}
				echo '</select>';
			echo '</span>';
		
		} elseif ( 'color' === $key ) {

			echo '<span class="gp-color-picker-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Color', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" data-id="' . esc_attr( $new_id ) . '" />';
			echo '</span>';
		
		} elseif ( 'letter-spacing' === $key ) {
			
			// Only allow numeric characters
			$new_value = preg_replace( "/[^(-?\d+\.)?-?\d]+/", '', $new_value );

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Letter Spacing', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';
			
		} elseif ( 'word-spacing' === $key ) {
				
			// Only allow numeric characters			
			$new_value = preg_replace( "/[^(-?\d+\.)?-?\d]+/", '', $new_value );

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'WordPress Spacing', 'gpur' ) . '</label>';
				echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';
				
		} elseif ( 'text-transform' === $key ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Text Transform', 'gpur' ) . '</label>';
				echo '<select id="' . esc_attr( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
					$text_transforms = array(
						'none',
						'capitalize',
						'uppercase',
						'lowercase',
						'initial',
						'inherit'
					);
					foreach( $text_transforms as $text_transform ) {
						if ( $new_value === $text_transform ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						echo '<option value="' . $text_transform . '" ' . $checked . '>' . esc_attr( ucfirst( $text_transform ) ) . '</option>';
					}
				echo '</select>';
			echo '</span>';
		
		} elseif ( 'text-align' === $key ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Text Align', 'gpur' ) . '</label>';
				echo '<select id="' . esc_attr( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
					$alignments = array(
						'inherit',
						'left',
						'right',
						'center',
						'justify',
						'initial',
                	);
					foreach( $alignments as $alignment ) {
						if ( $new_value === $alignment ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						echo '<option value="' . $alignment . '" ' . $checked . '>' . esc_attr( ucfirst( $alignment ) ) . '</option>';
					}
				echo '</select>';
			echo '</span>';
							
		} elseif ( 'text-decoration' === $key ) {
	
			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_html__( 'Text Decoration', 'gpur' ) . '</label>';
				echo '<select id="' . esc_attr( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
  					$text_decorations = array(
						'none',
						'inherit',
						'underline',
						'overline',
						'line-through',
						'blink',
					);
					foreach( $text_decorations as $text_decoration ) {
						if ( $new_value === $text_decoration ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						echo '<option value="' . $text_decoration . '" ' . $checked . '>' . esc_attr( ucfirst( $text_decoration ) ) . '</option>';
					}
				echo '</select>';
			echo '</span>';
			
		}	

	}

}