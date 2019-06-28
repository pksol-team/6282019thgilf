<?php

wp_enqueue_script( 'wp-color-picker' );
wp_enqueue_script( 'wp-color-picker-alpha' );
wp_enqueue_script( 'ghostpool-color-field' );

$key_order = array(
	'from',
	'to',
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
		
		if ( 'from' === $k ) {
			$title = esc_html__( 'From', 'gpur' );
		} elseif ( 'to' === $k ) {
			$title = esc_html__( 'To', 'gpur' );
		}
			
		echo '<span class="gp-styling-field gp-color-picker-field">';
			echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label>';
			echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $new_name ) . '" value="' . esc_attr( $new_value ) . '" data-id="' . esc_attr( $new_id ) . '" />';
		echo '</span>';
		
	}
		
}

	