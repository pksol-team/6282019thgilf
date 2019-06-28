<?php 

wp_enqueue_script( 'wp-color-picker' );
wp_enqueue_script( 'wp-color-picker-alpha' );
wp_enqueue_script( 'ghostpool-color-field' );

$key_order = array(
	'border-width',
	'border-top',
	'border-right',
	'border-bottom',
	'border-left',
	'border-style',
	'border-color',
);

$new_order = array();
foreach( $key_order as $key ) {
	if ( isset( $default[$key] ) ) {
		$new_order[$key] = $default[$key];
	}
}

if ( isset( $new_order ) ) {

	foreach( $new_order as $k => $v ) {					

		$new_id = $id . '-' . $k;
		$new_name = $name . '[' . $k . ']';
		$new_value = isset( $value[$k] ) ? $value[$k] : $v;
		$field_class = 'gp-' . $k . '-field';

		if ( 'border-width' === $k OR 'border-top' === $k OR 'border-right' === $k OR 'border-bottom' === $k OR 'border-left' === $k ) {
		
			// Only allow numeric characters
			if ( 'auto' !== $new_value ) {
				$new_value = preg_replace( "/[^(-?\d+\.)?-?\d]+/", '', $new_value );
			}

			echo '<span class="gp-text-field gp-styling-field ' . $field_class . '">';
				echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';
			
		}
			
		if ( 'border-style' === $k ) {

			echo '<span class="gp-select-field gp-styling-field ' . $field_class . '">';
				echo '<select id="' . esc_attr( $new_id ) . '" class="post_form" name="' . esc_attr( $new_name ) . '">';
					echo '<option value=""></option>';
					$border_styles = array(
						'solid'  => 'Solid',
						'dashed' => 'Dashed',
						'dotted' => 'Dotted',
						'double' => 'Double',
						'none'   => 'None',
					);
					foreach( $border_styles as $border_key => $border_style ) {
						if ( $new_value === $border_key ) {
							$checked = ' selected="selected"';
						} else {
							$checked = '';
						}
						echo '<option value="' . $border_key . '" ' . $checked . '>' . esc_attr( ucfirst( $border_style ) ) . '</option>';
					}
				echo '</select>';
			echo '</span>';
			
		}
		
		if ( 'border-color' === $k ) {

			echo '<span class="gp-color-picker-field gp-styling-field ' . $field_class . '">';
				echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" data-id="' . esc_attr( $new_id ) . '" data-alpha="true" data-default-color="' . esc_attr( $v ) . '" />';
			echo '</span>';
			
		}
		
	}
	
	echo '<div class="gp-clear"></div>';
	
}			


