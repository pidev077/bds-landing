( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var widget = document.querySelector( '.bds-floating-contact' );
		var toggle = widget ? widget.querySelector( '.bds-floating-contact__toggle' ) : null;
		if ( ! widget || ! toggle ) {
			return;
		}

		toggle.addEventListener( 'click', function () {
			var isOpen = widget.classList.toggle( 'is-open' );
			toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
		} );

		document.addEventListener( 'click', function ( event ) {
			if ( widget.classList.contains( 'is-open' ) && ! widget.contains( event.target ) ) {
				widget.classList.remove( 'is-open' );
				toggle.setAttribute( 'aria-expanded', 'false' );
			}
		} );
	} );
}() );
