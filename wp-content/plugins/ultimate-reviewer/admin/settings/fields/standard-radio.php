<?php 

echo '<ul class="gp-radio-field" id="' . esc_attr( $id ) . '">';
	foreach( $options as $option_value => $option_text ) {
		$checked = '';
		if ( ! isset( $value ) && $default === $option_value ) {
			$checked = ' checked="checked" ';
		} elseif ( isset( $value ) && $value === $option_value ) {
			$checked = ' checked="checked" ';
		}	
		echo '<li><input type="radio" id="' . esc_attr( $id ) . '-' . esc_attr( $option_value ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $option_value ) . '"' . $checked . '/>' . esc_attr( $option_text ) . '</li>';
	}
echo '</ul>';