<?php 

if ( isset( $styling ) ) {

	foreach( $styling as $title => $type ) {				

		$sanitized_title = sanitize_title( $title );
		$new_id = $id . '-' . $sanitized_title;

		if ( isset( $value[$sanitized_title] ) ) {
			$new_value = $value[$sanitized_title];
		} elseif ( isset( $default[$sanitized_title] ) ) {
			$new_value = $default[$sanitized_title];
		} else {
			$new_value = '';
		}

		if ( 'dimensions' === $type ) {

			// Only allow numeric characters
			if ( 'auto' !== $new_value ) {
				$new_value = preg_replace( "/[^(-?\d+\.)?-?\d]+/", '', $new_value );
			}
			
			echo '<span class="gp-styling-field gp-dimensions-field">';
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label>';
				echo '<input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text gp-small-text" name="' . esc_attr( $name ) . '[' . esc_attr( $sanitized_title ) . ']" value="' . esc_attr( $new_value ) . '" /><span class="gp-units">' . $units . '</span>';
			echo '</span>';

		} elseif ( 'color' === $type ) {

			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'ghostpool-color-field' );
			
			echo '<span class="gp-styling-field gp-color-picker-field"><label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label><input type="text" id="' . esc_attr( $new_id ) . '" class="gp-input-text" name="' . esc_attr( $name ) . '[' . esc_attr( $sanitized_title ) . ']" value="' . esc_attr( $new_value ) . '" data-id="' . esc_attr( $new_id ) . '" /></span>';

		} elseif ( 'icon' === $type ) {
		
			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_script( 'ghostpool-icon-field' );

			echo '<span class="gp-styling-field gp-icon-field"><label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label><span class="gp-icon-wrapper gp-closed">';

				$selected_icon = isset( $new_value ) ? '<i class="fa fa-lg ' . esc_attr( $new_value ) . '"></i>' : '';
				echo '<span class="gp-open-icons-box">' . wp_kses_post( $selected_icon ) . '<span class="gp-icon-box-arrow"></span></span>';

				echo '<span class="gp-icon-box">';

					foreach( ghostpool_icons() as $icon ) {		   
						echo '<a href="' . esc_attr( $icon ) . '" class="gp-icon-link"><i class="fa fa-lg ' . esc_attr( $icon ) . '"></i></a>';		
					}

				echo '</span>';

				echo '<input type="hidden" id="' . esc_attr( $new_id ) . '"  class="gp-selected-icon" name="' . esc_attr( $name ) . '[' . esc_attr( $sanitized_title ) . ']" value="' . esc_attr( $new_value ) . '" />';    

			echo '</span></span>';

		} elseif ( 'media' === $type ) {

			wp_enqueue_media();
			wp_enqueue_script( 'ghostpool-media-field' );
			
			echo '<span class="gp-styling-field gp-media-field" data-id="' . esc_attr( $new_id ) . '">';
			
				echo '<label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label>';
		
				echo '<span id="gp-media-preview-' . esc_attr( $new_id ) .'" class="gp-media-preview">';	
					if ( $new_value ) {		
						if ( is_numeric( $new_value ) ) {					
							$media_thumb = wp_get_attachment_image_src( $new_value, 'thumbnail' );
							$media_thumb = $media_thumb[0];
						} else {
							$media_thumb = $new_value;
						}	
						echo '<img src="' . esc_url( $media_thumb ) . '" class="gp-image-thumbnail" alt="" />';
					}
				echo '</span>';

				$text = ( $new_value > 0 ) ? esc_html__( 'Change Image', 'gpur' ) : esc_html__( 'Add Image', 'gpur' );

				echo '<input type="button" id="gp-media-' . esc_attr( $new_id ) . '" class="gp-media-button button button-primary" value="' . esc_attr( $text ) . '" data-add="' . esc_attr__( 'Add Image', 'gpur' ) . '" data-change="' . esc_attr__( 'Change Image', 'gpur' ) . '" />';

				$show_class = ( $new_value > 0 ) ? ' gp-show' : '';
				echo '<a class="gp-remove-media-button' . $show_class . '" id="gp-remove-media-' . esc_attr( $new_id ) . '" href="#">' . esc_html__( 'Remove Image', 'gpur' ) . '</a>';
			
			echo '</span>';	
			echo '<input type="hidden" id="' . esc_attr( $new_id ) . '" name="' . esc_attr( $name )  . '[' . esc_attr( $sanitized_title ) . ']" value="' . esc_attr( $new_value ) . '" />';
			
		} elseif ( 'extra_css' === $type ) {

			echo '<span class="gp-styling-field gp-extra-css-field"><label for="' . esc_attr( $new_id ) . '" class="gp-label">' . esc_attr( $title ) . '</label><input type="text" class="gp-input-text" id="' . esc_attr( $new_id ) . '"  name="' . esc_attr( $name ) . '[' . esc_attr( $sanitized_title ) . ']" value="' . esc_attr( $new_value ) . '" /></span>';

		}
		
	}
	
	echo '<div class="gp-clear"></div>';
		
}		