( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		initDuAnModal();
	} );

	function initDuAnModal() {
		var modal = document.querySelector( '[data-du-an-modal]' );
		if ( ! modal ) {
			return;
		}

		var imageEl = modal.querySelector( '[data-du-an-modal-image]' );
		var nameEl = modal.querySelector( '[data-du-an-modal-name]' );
		var descEl = modal.querySelector( '[data-du-an-modal-desc]' );
		var videoEl = modal.querySelector( '[data-du-an-modal-video]' );
		var prevBtn = modal.querySelector( '[data-du-an-prev]' );
		var nextBtn = modal.querySelector( '[data-du-an-next]' );

		var images = [];
		var index = 0;

		function renderImage() {
			if ( images.length === 0 ) {
				imageEl.src = '';
				imageEl.classList.remove( 'is-active' );
				return;
			}
			imageEl.src = images[ index ];
			imageEl.classList.add( 'is-active' );
		}

		function open( card ) {
			var name = card.getAttribute( 'data-name' ) || '';
			var description = card.getAttribute( 'data-description' ) || '';
			var video = card.getAttribute( 'data-video' ) || '';

			try {
				images = JSON.parse( card.getAttribute( 'data-images' ) || '[]' );
			} catch ( e ) {
				images = [];
			}
			index = 0;

			nameEl.textContent = name;
			descEl.textContent = description;
			videoEl.href = video;
			var hasMultiple = images.length > 1;
			prevBtn.style.display = hasMultiple ? '' : 'none';
			nextBtn.style.display = hasMultiple ? '' : 'none';
			renderImage();

			modal.classList.add( 'is-open' );
			modal.setAttribute( 'aria-hidden', 'false' );
			document.body.style.overflow = 'hidden';
		}

		function close() {
			modal.classList.remove( 'is-open' );
			modal.setAttribute( 'aria-hidden', 'true' );
			document.body.style.overflow = '';
		}

		document.querySelectorAll( '[data-du-an-card]' ).forEach( function ( card ) {
			var trigger = card.querySelector( '[data-du-an-open]' );
			if ( trigger ) {
				trigger.addEventListener( 'click', function () {
					open( card );
				} );
			}
		} );

		modal.querySelectorAll( '[data-du-an-close]' ).forEach( function ( el ) {
			el.addEventListener( 'click', close );
		} );

		prevBtn.addEventListener( 'click', function () {
			if ( images.length === 0 ) {
				return;
			}
			index = ( index - 1 + images.length ) % images.length;
			renderImage();
		} );
		nextBtn.addEventListener( 'click', function () {
			if ( images.length === 0 ) {
				return;
			}
			index = ( index + 1 ) % images.length;
			renderImage();
		} );

		document.addEventListener( 'keydown', function ( e ) {
			if ( ! modal.classList.contains( 'is-open' ) ) {
				return;
			}
			if ( e.key === 'Escape' ) {
				close();
			} else if ( e.key === 'ArrowLeft' ) {
				prevBtn.click();
			} else if ( e.key === 'ArrowRight' ) {
				nextBtn.click();
			}
		} );
	}
} )();
