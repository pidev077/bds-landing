( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		initMobileNav();
		initCarousels();
	} );

	function initMobileNav() {
		var nav = document.querySelector( '.bds-nav' );
		var toggle = document.querySelector( '.bds-nav__toggle' );
		if ( ! nav || ! toggle ) {
			return;
		}

		toggle.addEventListener( 'click', function () {
			var isOpen = nav.classList.toggle( 'is-open' );
			toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
		} );

		nav.querySelectorAll( '.bds-nav__links a' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				nav.classList.remove( 'is-open' );
				toggle.setAttribute( 'aria-expanded', 'false' );
			} );
		} );
	}

	function initCarousels() {
		document.querySelectorAll( '[data-carousel]' ).forEach( function ( carousel ) {
			var track = carousel.querySelector( '[data-carousel-track]' );
			var slides = track ? track.children : [];
			if ( ! track || slides.length === 0 ) {
				return;
			}

			var section = carousel.closest( '.bds-ecosystem' );
			var prevBtn = section ? section.querySelector( '[data-carousel-prev]' ) : null;
			var nextBtn = section ? section.querySelector( '[data-carousel-next]' ) : null;
			var index = 0;

			function visibleCount() {
				return window.innerWidth <= 900 ? 1 : 3;
			}

			function update() {
				var maxIndex = Math.max( 0, slides.length - visibleCount() );
				index = Math.min( Math.max( index, 0 ), maxIndex );
				var slideWidth = slides[ 0 ].getBoundingClientRect().width + 24; /* gap */
				track.style.transform = 'translateX(-' + ( index * slideWidth ) + 'px)';
			}

			if ( prevBtn ) {
				prevBtn.addEventListener( 'click', function () {
					index -= 1;
					update();
				} );
			}
			if ( nextBtn ) {
				nextBtn.addEventListener( 'click', function () {
					index += 1;
					update();
				} );
			}

			window.addEventListener( 'resize', update );
			update();
		} );
	}
} )();
