<?php

wp_enqueue_script( 'wp-color-picker' );
wp_enqueue_script( 'ghostpool-color-field' );

echo '<span class="gp-color-picker-field">';
	echo '<input type="text" id="' . esc_attr( $id ) . '" class="gp-input-text" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" data-id="' . esc_attr( $id ) . '" data-alpha="false" data-default-color="' . esc_attr( $value ) . '"  />';
echo '</span>';
	