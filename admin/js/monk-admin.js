(function( $ ) {
	'use strict';

	$( document ).ready( function() {
		$( document ).on( 'change', 'select[name="monk_default_language"]', function() {
			var selected_language = $( this ).val();
			$( 'input[type="checkbox"][name="monk_active_languages[]"]' ).each( function() {
				var current_language = $( this ).val();
				if ( current_language === selected_language ) {
					$( this ).prop({
						'checked': true
					});
					$( this ).parent().addClass( 'option-disabled' );
				} else {
					if ( $( this ).hasClass( 'monk-saved-language' ) ) {
						$( this ).parent().removeClass( 'option-disabled' );
					} else {
						$( this ).parent().removeClass( 'option-disabled' );
					}
				}
			});
		});

		$( document ).on( 'click', 'span.monk-add-translation', function() {
			$( '.monk-post-meta-add-translation' ).slideToggle( 150 );
		});

		$( document ).on( 'click', 'a.monk-cancel-submit-translation', function( e ) {
			$( '.monk-post-meta-add-translation' ).slideUp( 150 );
			e.preventDefault();
		});

		$( document ).on( 'click', 'span.monk-change-language', function() {
			$( '.monk-change-current-language' ).slideToggle( 150 );
		});

		$( document ).on( 'change', '#new-post-language', function() {
			var new_name = $( 'select[name="monk_post_language"] option:selected' ).text();
			$( '#current-language' ).html( new_name );
		});

		$( document ).on( 'click', 'a.monk-cancel-language-change', function( e ) {
			$( '.monk-change-current-language' ).slideUp( 150 );
			$( 'select[name="monk_new_language"] option[value=""]').attr( 'selected', 'selected' );
			e.preventDefault();
		});

		$( document ).on( 'click', '#monk-attach', function( event ) {
			event.preventDefault();
			var form_data = {
				monk_id : $( '#monk-id' ).val(),
				previous_post_id : $( '#previous-post-id' ).val(),
				lang : $( '#monk-lang' ).val(),
				action : 'monk'
			}
			
			$.ajax({
				type: 'POST',
				url: monk.ajax_url,
				data: form_data,
				success: function( response ) {
					window.location.replace( response.data );
				}
			});

			return false;
		});

		$( document ).on( 'click', 'button.monk-change-post-language', function( e ) {
			e.preventDefault();
			$( '.monk-change-current-language' ).slideUp( 150 );
		});

		$( document ).on( 'click', 'button.monk-submit-translation', function( e ) {
			e.preventDefault();
			var encoded_url = $( 'select[name="monk_post_translation_id"]' ).val();
			window.location.replace( encoded_url );
		});

		$( document ).on( 'change', '#monk-term-translation', function( e ) {
			e.preventDefault();
			var encoded_url = $( 'select[name="monk-term-translation"]' ).val();
			window.location.replace( encoded_url );
		});

		var monk_id = $( '#monk-id' ).val();
		var path    = window.location.pathname.split( '/' );
		var url     = window.location.href.split( '&' );

		if ( 'edit-tags.php' === path[ path.length - 1 ] && monk_id ) {
			$( document ).ajaxComplete( function() {
				$( location ).attr( 'href', url[0] );
			});
		}
	});
})( jQuery );
