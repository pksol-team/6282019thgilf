function comparisonTableSorting( clickedElement ) {

	jQuery.ajax({
		type: 'GET',
		data: {			
			action: 'gpur_comparisonTableSorting',
			atts: clickedElement.closest( '.gpur-comparison-table' ).data( 'gpur-sorting-query' ),
			nonce: clickedElement.closest( '.gpur-comparison-table' ).data( 'gpur-nonce' ),
			sorting: clickedElement.data( 'gpur-sorting' )
		},
		dataType: 'html',
		url: gpur_comparisonTableSorting.ajax_url,
		success: function( data, textStatus ) {

			if ( 'success' === textStatus ) {
			
				var table = clickedElement.closest( '.gpur-comparison-table-wrapper' );

				table.addClass( 'gpur-loading' );
				
				setTimeout( function() {
					table.html( data ).removeClass( 'gpur-loading' );
					jQuery( 'input.rating' ).rating();
				}, 800 );
				
			}

		}
		
	});

}

jQuery( document ).ready( function( $ ) {

	'use strict';
	
	$( document ).on( 'click', '.gpur-sort-button', function( e ) {

		e.preventDefault();

		var clickedElement = $( this );
		
		comparisonTableSorting( clickedElement );
		
		return false;
		
	});
	
});