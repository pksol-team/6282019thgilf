<?php

wp_enqueue_script( 'ace-editor' );
wp_enqueue_script( 'ace-editor-mode-' . $format );
wp_enqueue_script( 'ghostpool-ace-editor-field' );

echo '<div class="gp-ace-editor-field">';

	echo '<div id="' . esc_attr( $id ) . '" class="gp-ace-editor" data-editor="' . esc_attr( $id ) . '" data-mode="' . esc_attr( $format ) . '"></div>';

	echo '<textarea id="' . esc_attr( $id ) . '-textarea" class="gp-ace-textarea" name="' . esc_attr( $name ) . '" data-textarea="' . esc_attr( $id ) . '-textarea">' . $value . '</textarea>';

echo '</div>';