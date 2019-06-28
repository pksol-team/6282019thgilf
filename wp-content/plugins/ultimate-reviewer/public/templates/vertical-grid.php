<?php
	
echo '<div class="gpur-thead">';
			
	foreach( $fields as $field ) {

		// Get custom field data
		if ( false !== strpos( $field, 'CUSTOM_FIELD:' ) ) {
			preg_match_all( "~CUSTOM_FIELD:(.*?):~", $field, $m );
			$atts['meta_key'] = $m[1][0];
			$label = substr( $field, strrpos( $field, ':' ) + 1 )."\n";
			$field = 'CUSTOM_FIELD';
		} else {
			$label = $all_fields[$field][2];
		}
			
		$field_name = $all_fields[$field][1];
		$sorting = $all_fields[$field][3];
		
		if ( in_array( $field, $all_fields[$field] ) ) {		

			echo '<div class="gpur-th">';
				gpur_sort_icons( $field_name, $label, $sorting, $atts );
			echo '</div>';
			
		}
			
	}

echo '</div>';
		
while ( $query->have_posts() ) {
	$query->the_post();

	echo '<div class="gpur-tr">';

		foreach( $fields as $field ) {

			// Get custom field data
			if ( false !== strpos( $field, 'CUSTOM_FIELD:' ) ) {
				preg_match_all( "~CUSTOM_FIELD:(.*?):~", $field, $m );
				$atts['meta_key'] = $m[1][0];
				$label = substr( $field, strrpos( $field, ':' ) + 1 )."\n";
				$field = 'CUSTOM_FIELD';
			} else {
				$label = $all_fields[$field][2];
			}
				
			$field_name = $all_fields[$field][1];
			$sorting = $all_fields[$field][3];
				
			if ( in_array( $field, $all_fields[$field] ) ) {			

				echo '<div class="gpur-td gpur-comparison-table-' . esc_attr( $field_name ) . '">';
					
					echo '<div class="gpur-th-inner">';
						gpur_sort_icons( $field_name, $label, $sorting, $atts );
					echo '</div>';
					
					echo '<div class="gpur-td-inner">';
						gpur_comparison_table_fields( $field_name, $atts );
					echo '</div>';
				echo '</div>';	
				
			}
				
		}

	echo '</div>';

}