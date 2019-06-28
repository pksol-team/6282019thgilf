<?php

wp_enqueue_style( 'jquery-ui-theme-smoothness' );
wp_enqueue_script( 'jquery-ui-spinner' );	
wp_enqueue_script( 'ghostpool-spinner-field' );

echo '<div class="gp-spinner-field" data-id="' . esc_attr( $id ) . '" data-value="' . floatval( $value ) . '" data-step="' . floatval( $step ) . '" data-min="' . floatval( $min ) . '" data-max="' . floatval( $max ) . '">';
	echo '<input type="text" id="' . esc_attr( $id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $name ) . '" value="' . floatval( $value ) . '" data-step="' . floatval( $step ) . '" data-min="' . floatval( $min ) . '" data-max="' . floatval( $max ) . '" />';
echo '</div>';
