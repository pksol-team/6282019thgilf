<?php		

wp_enqueue_media();
wp_enqueue_script( 'ghostpool-media-field' );

echo '<div class="gp-gallery-field" data-id="' . esc_attr( $id ) . '">';

	echo '<div id="gp-gallery-preview-' . esc_attr( $id ) .'" class="gp-gallery-preview">';

		if ( $value > 0 ) {

			$attachments = explode( ',', $value );
	
			foreach( $attachments as $attachment ) {
				$media_thumb = wp_get_attachment_image_src( $attachment, 'thumbnail' );
				$media_thumb = $media_thumb[0];
				echo '<img src="' . esc_url( $media_thumb ) . '" alt="" />';
			}	

		}	

	echo '</div>';	

	$text = ( $value > 0 ) ? esc_html__( 'Edit Gallery', 'gpur' ) : esc_html__( 'Add Gallery', 'gpur' );

	echo '<input type="button" id="gp-gallery-' . esc_attr( $id ) . '" class="gp-media-button button button-primary" value="' . esc_attr( $text ) . '" data-add="' . esc_attr__( 'Add Gallery', 'gpur' ) . '" data-change="' . esc_attr__( 'Edit Gallery', 'gpur' ) . '" />';

	$show_class = ( $value > 0 ) ? ' gp-show' : '';
	echo '<a class="gp-remove-media-button' . $show_class . '" id="gp-remove-gallery-' . esc_attr( $id ) . '" href="#">' . esc_html__( 'Remove Gallery', 'gpur' ) . '</a>';

	echo '<input type="hidden" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '" />';

echo '</div>';
	