<?php

echo '<ul class="gp-checkbox-field" id="' . esc_attr( $id ) . '">';	

	if ( isset( $options ) && ! empty( $options ) ) {

		if ( '' === $data ) {
		
			foreach ( $options as $option_key => $option_value ) {

				if ( isset( $value[$option_key] ) ) {
					$new_value = $value[$option_key];
				} else {
					$new_value = 0;	
				}
				
				echo '<li><input name="' . esc_attr( $name ) . '[' . $option_key . ']"  type="checkbox" id="' . esc_attr( $id ) . '-' . esc_attr( $option_key ) . '" value="1"' . checked( $new_value, 1, false ) . ' />' . esc_attr( $option_value ) . '</li>';
							
			}
			
			// Needed if all group checkboxes unchecked
			if ( ! is_array( $value ) ) {
				echo '<input name="' . esc_attr( $name ) . '[]" type="hidden" value="1" />';
			}
		
		} else {
		
			foreach ( $options as $option_title => $option_value ) {

				$option_id = str_replace( ' ', '-', $option_title );
				$option_id = strtolower( $option_id );

				if ( in_array( $option_value, $value ) ) {
					$new_value = $option_value;
				} else {
					$new_value = '';
				}
				
				echo '<li><input name="' . esc_attr( $name ) . '[]"  type="checkbox" id="' . esc_attr( $id ) . '-' . esc_attr( $option_id ) . '" class="gp-data-checkbox" value="' . esc_attr( $option_value ) . '"' . checked( $new_value, $option_value, false ) . '/>' . esc_attr( $option_title ) . '</li>';

			}
						
			// Needed if all group checkboxes unchecked
			echo '<input name="' . esc_attr( $name ) . '[]" type="hidden" value="1" />';
			
		}	
	
	} else {

		echo '<li><input type="checkbox" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="1"' . checked( $value, 1, false ) . '/></li>';

	}
		
echo '</ul>';
