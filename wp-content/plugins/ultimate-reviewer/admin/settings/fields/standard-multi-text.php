<?php

wp_enqueue_script( 'ghostpool-multi-text-field' );

echo '<div class="gp-multi-text-field" data-id="' . esc_attr( $id ) . '">';

	if ( $value && is_array( $value ) ) {

		foreach ( $value as $field ) {

			echo '<div class="gp-multi-text-field">';		
				echo '<input type="text"  id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '[]" value="' . esc_attr( $field ) . '" class="regular-text gp-input-text" />';
				echo '<a id="gp-remove-row-' . esc_attr( $id ) . '" class="gp-remove-row button button-small" href="#">' . esc_html__( 'Remove' , 'gpur' ) . '</a>';
			echo '</div>';

		}

	} else {

		echo '<div class="gp-multi-text-field">';		
			echo '<input type="text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '[]" value="" class="regular-text gp-input-text" />';
			echo '<a id="gp-remove-row-' . esc_attr( $id ) . '" class="gp-remove-row button button-small" href="#">' . esc_html__( 'Remove' , 'gpur' ) . '</a>';
		echo '</div>';	

	}

	echo '<div class="gp-hide screen-reader-text gp-multi-text-field">';
		echo '<input type="text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '[]" value="" class="regular-text gp-input-text" />';
		echo '<a id="gp-remove-row-' . esc_attr( $id ) . '" class="gp-remove-row button button-small" href="#">' . esc_html__( 'Remove' , 'gpur' ) . '</a>';
	echo '</div>';

	echo '<a id="gp-add-row-' . esc_attr( $id ) . '" class="gp-add-row button button-primary" href="#">' . esc_html__( 'Add Another' , 'gpur' ) . '</a>';

echo '</div>';