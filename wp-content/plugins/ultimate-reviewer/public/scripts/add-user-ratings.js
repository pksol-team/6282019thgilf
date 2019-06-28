/**
 * Cookie functions
 *
 */	

// Create cookie function
function createCookie( name, value, days ) {
	var expires = '';
	if ( days ) {
		var date = new Date();
		date.setTime( date.getTime() + ( days * 24 * 60 * 60 * 1000 ) );
	 	expires = '; expires=' + date.toGMTString();
	} else {
		expires = '';
	}
	document.cookie = name + '=' + value + expires + '; path=/';
}

// Read cookie function
function readCookie( name ) {
	var nameEQ = name + '=';
	var ca = document.cookie.split( ';' );
	for ( var i = 0; i < ca.length; i++ ) {
		var c = ca[i];
		while ( c.charAt(0) == ' ' ) {
			c = c.substring( 1, c.length );
		}
		if ( c.indexOf( nameEQ ) == 0 ) {
			return c.substring( nameEQ.length, c.length );
		}
	}
	return null;
}

/**
 * Submit ratings function
 *
 */	
function submitRatings( element ) {

	var hasError = '',
		parentContainer = element,
		criterionContainer = parentContainer.find( '.gpur-criterion' ),
		inputField = parentContainer.find( '.gpur-criterion .gpur-user-rating' ),
		nonce = inputField.data( 'nonce' ),
		//weight = inputField.data( 'weight' ),
		minRating = inputField.data( 'min-rating' ),
		maxRating = inputField.data( 'stop' ),
		count = 1,
		eachRatingValue = 0,
		ratingValue = 0,
		multiRatingValues = [];

	// Check if item has been rated
	if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
		if ( readCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id ) || gpur_add_user_ratings.userRating ) {
			hasError = 'yes';
		}
	}

	// Proceed, if user can rate
	if ( hasError != 'yes' ) {

		// Loop through each multi rating	
		criterionContainer.each( function( index ) {

			// Get counter value
			count = parseInt( index + 1 );

			var inputField = jQuery( this ).find( '.gpur-user-rating' ),
				weight = inputField.data( 'weight' );

			// Get each multi rating
			if ( weight !== undefined && weight !== '' ) {
				eachRatingValue += parseFloat( inputField.val() * weight );
			} else {
				eachRatingValue += parseFloat( inputField.val() );
			}
			multiRatingValues[index] = inputField.val();

			// Set rating to zero if submitted and left empty
			if ( multiRatingValues[index] === '' && minRating === 0 ) {		
				multiRatingValues[index] = 0;		
			}

			// Prevent rating lower than minimum
			if ( multiRatingValues[index] < minRating ) {
				multiRatingValues[index] = 0;		
			}

			// Prevent rating higher than maximum
			if ( multiRatingValues[index] > maxRating ) {
				multiRatingValues[index] = maxRating;
			}
						
			// Final check to make sure a valid rating is being submitted
			if ( ! jQuery.isNumeric( multiRatingValues[index] ) ) {
				hasError = 'yes';
				return false;
			}
			
		});

		// Get an average of all multi ratings 
		var avgRatingValue = parseFloat( eachRatingValue / count );
			ratingValue = Math.round( avgRatingValue * 10 ) / 10;

	}

	// Loading effect			
	parentContainer.find( '.gpur-success' ).hide();	
	parentContainer.find( '.gpur-error' ).hide();
	if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
		parentContainer.addClass( 'gpur-loading' );
	}
	
	// Proceed, if rating data is valid
	if ( hasError != 'yes' ) {
			
		// Prevent another rating being sent
		inputField.attr( 'data-readonly', '' );
			
		// Collect data ready for sending to PHP	
		var data = {
			action: 'gpur_save_rating',
			postID: gpur_add_user_ratings.post_id,
			nonce: nonce,
			//weight: weight,
			maxRating: maxRating,
			minRating: minRating,
			ratingValue: ratingValue,
			multiRatingValues: multiRatingValues
		};

		// Send rating data via ajax to PHP
		jQuery.post( gpur_add_user_ratings.ajax_url, data, function() {

			// Create cookies for logged out users
			if ( ! jQuery( 'body' ).hasClass( 'logged-in' ) ) {
				if ( multiRatingValues != '' ) {
					createCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id, multiRatingValues, 900 );
				} else {
					createCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id, ratingValue, 900 );
				}
			}
			
		});

		// Show success messages
		setTimeout( function() {
			parentContainer.find( '.gpur-submit-rating' ).fadeOut();
			parentContainer.removeClass( 'gpur-loading' );
			parentContainer.find( '.gpur-success' ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 600 );
		}, 800 );
				   
	} else {

		// Show error messages
		setTimeout( function() {
			parentContainer.removeClass( 'gpur-loading' );
			parentContainer.find( '.gpur-error' ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 600 );
		}, 800 );
		
		hasError = '';

	}		

}
	
jQuery( function( $ ) {

  'use strict';

	var hasError = '';

	/**
	 * Set width for rating bar sections
	 *
	 */	
	var criterionWrapper = $( '.gpur-style-bars .gpur-criterion' );
	criterionWrapper.each( function() {
		var eachCriterionWrapper = $( this ),
			barCount = $( this ).find( '.gpur-user-rating' ).data( 'stop' ),
			barWidth = ( 100 / barCount ) + '%';
			eachCriterionWrapper.find( '.rating-symbol' ).css( 'width', barWidth );	
	});
			
	/**
	 * Comment form character limits
	 *
	 */	
	 	
	// Review title character limit message
	$( '#gpur-comment-form-title' ).keyup( function() {
		var textlen = gpur_add_user_ratings.review_title_limit - $( this ).val().length;
		$( this ).next( '.gpur-character-limit-message' ).find( '.gpur-characters-remaining' ).text( textlen );
	});
	
	// Review text character limit message
	$( 'textarea#comment' ).keyup( function() {
		var textlen = gpur_add_user_ratings.review_text_limit - $( this ).val().length;
		$( this ).next( '.gpur-character-limit-message' ).find( '.gpur-characters-remaining' ).text( textlen );
	});
		
	/**
	 * Dynamically update rating value when hovering
	 *
	 */			
	$( document ).on( 'rating.rateenter', '.gpur-add-user-ratings-wrapper .rating-symbol', function( e, rate ) {
		
		var el = $( this ),
			inputField = el.parent().parent().find( '.gpur-user-rating' );	

		// Check if item has been rated
		if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
			if ( readCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id ) || gpur_add_user_ratings.user_rating ) {
				hasError = 'yes';
			}
		}

		if ( hasError != 'yes' ) {

			// Set rating to zero if submitted and left empty
			if ( rate === '' && inputField.data( 'min-rating' ) === 0 ) {		
				rate = 0;		
			}
						
			// Prevent rating lower than minimum
			if ( rate < inputField.data( 'min-rating' ) ) {
				rate = inputField.data( 'min-rating' );
			}

			// Prevent rating higher than maximum
			if ( rate > inputField.data( 'stop' ) ) {
				rate = inputField.data( 'stop' );
			}
	
			el.parent().parent().find( '.gpur-your-user-rating .gpur-rating-value' ).text( parseFloat( rate ) );
			
		}
					
	});
	
	$( document ).on( 'rating.rateleave', '.gpur-add-user-ratings-wrapper .rating-symbol', function() {
		
		var el = $( this ),
			inputField = el.parent().parent().find( '.gpur-user-rating' );	

		// Check if item has been rated
		if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
			if ( readCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id ) || gpur_add_user_ratings.user_rating ) {
				hasError = 'yes';
			}
		}
			
		if ( hasError != 'yes' ) {

			if ( inputField.val() === 0 ) {
				el.parent().parent().find( '.gpur-your-user-rating .gpur-rating-value' ).text( 0 );
			} else {
				el.parent().parent().find( '.gpur-your-user-rating .gpur-rating-value' ).text( inputField.val() );
			}
		
		}
		
	});

	/**
	 * Dynamically update your multi ratings when clicking
	 *
	 */	
	$( '.gpur-add-user-ratings-wrapper.gpur-multi-rating .rating-symbol' ).on( 'click', function ( e ) {
		
		var el = $( this ),
			inputField = el.parent().parent().find( '.gpur-user-rating' ),
			ratingText = el.parent().parent().find( '.gpur-your-user-rating .gpur-rating-value' );

		// Check if item has been rated
		if ( ! inputField.hasClass( 'gpur-comment-rating' ) ) {
			if ( readCookie( 'gpur_user_rating_' + gpur_add_user_ratings.post_id ) || gpur_add_user_ratings.user_rating ) {
				hasError = 'yes';
			}
		}
		
		if ( hasError != 'yes' ) {						
			ratingText.text( parseFloat( inputField.val() ) );		
		}
					
	});

	/**
	 * Submitting comment form
	 *
	 */
	$( 'body' ).on( 'submit', '#commentform', function( e ) {

		e.preventDefault();

		var commentform = $( this ),
			action = commentform.attr( 'action' ),
			formData = commentform.serializeArray(),
			titleField = commentform.find( '#gpur-comment-form-title' ),
			inputField = commentform.find( '.gpur-user-rating' ),
			commentField = commentform.find( '#comment' ),
			hasError = '';

		// Loading effect					
		commentform.find( '.gpur-success' ).hide();
		commentform.find( '.gpur-error' ).hide();	
		titleField.removeClass( 'gpur-required' );	
		inputField.removeClass( 'gpur-required' );	
		commentField.removeClass( 'gpur-required' );	
		commentform.addClass( 'gpur-loading' );
				
		// Check if required fields are empty
		if ( gpur_add_user_ratings.review_title === 'enabled' && titleField.val() === '' && ! commentform.closest( 'ol' ).hasClass( 'comment-list' ) ) {
			titleField.addClass( 'gpur-required' );
			hasError = 'yes';
		}
		
		if ( inputField.length && ( inputField.val() == 0 && gpur_add_user_ratings.comment_form_min_rating > 0 ) && ! commentform.closest( 'ol' ).hasClass( 'comment-list' ) ) {
			inputField.parent().parent().addClass( 'gpur-required' );
			hasError = 'yes';
		}
		
		if ( commentField.val() === '' ) {			
			commentField.addClass( 'gpur-required' );
			hasError = 'yes';
		}

		if ( hasError === 'yes' ) {

			// Show error messages
			setTimeout( function() {
				commentform.removeClass( 'gpur-loading' );
				commentform.find( '.gpur-error' ).text( gpur_add_user_ratings.comment_form_single_error_message ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 600 );
			}, 800 );
											
		} else {
		
			// Submitting comment
			$.ajax({
				type: 'post',
				url: action,
				clearForm: true,
				data: formData,
				beforeSend: function() {
				},
				success: function( data, textStatus ) {

					if ( textStatus === 'success') {
				
						// Prevent another rating being sent						
						commentform.find( 'input, textarea' ).attr( 'disabled', true );
						inputField.attr( 'data-readonly', '' );

						// Reload comment area with ajax
						$( '.comment-list' ).replaceWith( $( data ).find( '.comment-list' ) );
						$( '#respond' ).replaceWith( $( data ).find( '#respond' ) );

						// Reload ratings script
						$( 'input.rating' ).rating();
						
						// Add loading class to comment form
						$( '.comments-area #respond' ).addClass( 'gpur-loading' );
						
						// Hide already voted messages from showing
						$( '.comments-area .gpur-already-voted' ).hide();
						
						setTimeout( function() {
												
							// Hide comment form components
							if ( gpur_add_user_ratings.comment_rating_limit === 'one-rating-one-comment' ) {	
								$( '.comments-area #respond' ).hide();
							} else {
								$( '.comments-area' ).find( '.comment-form-rating' ).hide();
							}
							
							// Remove loading class from comment form
							$( '.comments-area #respond' ).removeClass( 'gpur-loading' );
						
							// Show success message
							$( '.comments-area' ).find( '.gpur-success' ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 300 );
							
						}, 800 );
																
					}
									
				},
				error: function( xhr, textStatus, errorThrown ) {

					// Show error messages
					setTimeout( function() {
						commentform.removeClass( 'gpur-loading' );
						commentform.find( '.gpur-error' ).text( gpur_add_user_ratings.comment_form_single_duplicate_comments ).css({ opacity: 0, display: 'block' }).animate({ opacity:1 }, 600 );
					}, 800 );
					
				}
			});
		
		}
				
		return false;
	});

	/**
	 * Submitting rating data when clicking rating icons
	 *
	 */		
	$( '.gpur-in-post.gpur-add-user-ratings-wrapper.gpur-no-submit-button .rating-symbol' ).on( 'click', function( e ) {
		submitRatings( $( this ).parent().parent().parent() );
	});

	/**
	 * Submitting rating data when clicking submit button
	 *
	 */		
	$( '.gpur-has-submit-button .gpur-submit-rating' ).on( 'click', function( e ) {
		submitRatings( $( this ).parent() );
	});
								
});