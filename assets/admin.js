/**
 * Plugin admin end scripts
 *
 * @package pootle_page_builder_for_photography
 * @version 1.0.0
 */
jQuery( function ( $ ) {
	ppbPhoto = {};
	ppbPhoto.dlog = $( '#photo-filter-dialog' );

	$( 'ppb-photo-canvas' ).click( function () {

	} );

	ppbPhoto.dlog.ppbDialog( {
		dialogClass : 'image-filter-dialog ppb-cool-panel-container',
		autoOpen : false,
		draggable : false,
		resizable : false,
		title : ppbPhoto.dlog.attr( 'data-title' ),
		height : $( window ).height() - 50,
		width : $( window ).width() - 50,
		open : function () {
			var data = ppbPhoto.photoData,
				url = data.thumb;
			console.log(ppbPhoto.photoData)

			//Refreshing caman canvas
			$( '.ppb-photo-canvas, .ppb-photo-canvas-main' ).removeAttr( "data-caman-id" );

			Caman( '#ppb-photo-canvas-0', url, function () {
				this.render();
			} );
			Caman( '#ppb-photo-canvas-1', url, function () {
				this.vintage().render();
			} );
			Caman( '#ppb-photo-canvas-2', url, function () {
				this.lomo().render();
			} );
			Caman( '#ppb-photo-canvas-3', url, function () {
				this.emboss().render();
			} );
			Caman( '#ppb-photo-canvas-4', url, function () {
				this.nostalgia().render();
			} );
			Caman( '#ppb-photo-canvas-5', url, function () {
				this.clarity().render();
			} );
			Caman( '#ppb-photo-canvas-6', url, function () {
				this.orangePeel().render();
			} );
			Caman( '#ppb-photo-canvas-7', url, function () {
				this.sinCity().render();
			} );
			Caman( '#ppb-photo-canvas-8', url, function () {
				this.sunrise().render();
			} );
			Caman( '#ppb-photo-canvas-9', url, function () {
				this.crossProcess().render();
			} );
			Caman( '#ppb-photo-canvas-10', url, function () {
				this.love().render();
			} );
			Caman( '#ppb-photo-canvas-11', url, function () {
				this.grungy().render();
			} );
			Caman( '#ppb-photo-canvas-12', url, function () {
				this.jarques().render();
			} );
			Caman( '#ppb-photo-canvas-13', url, function () {
				this.pinhole().render();
			} );
			Caman( '#ppb-photo-canvas-14', url, function () {
				this.oldBoot().render();
			} );
			Caman( '#ppb-photo-canvas-15', url, function () {
				this.glowingSun().render();
			} );
			Caman( '#ppb-photo-canvas-16', url, function () {
				this.hazyDays().render();
			} );
			Caman( '#ppb-photo-canvas-17', url, function () {
				this.herMajesty().render();
			} );
			Caman( '#ppb-photo-canvas-18', url, function () {
				this.hemingway().render();
			} );

			Caman( '#ppb-photo-canvas-main', data.medium, function () {
				window.ppbPhotoCamanThis = this;
				if ( typeof this[data.filter] == 'function' ) {
					this[data.filter]();
				}
				$.each( data.filterControls, function ( k, v ) {
					var $f = $( '.ppb-photo-control-' + k );
					if ( $f.length ) {
						$f.val( v );
						window.ppbPhotoCamanThis[k]( v );
						window.ppbPhotoCamanThis['render']();
					}
				} );
			} );
		},
		close : function () {
		},
		buttons : {
			Ok : function () {
				ppbPhoto.field.val( JSON.stringify( ppbPhoto.photoData ) );
				ppbPhoto.dlog.ppbDialog( 'close' );
			}
		}
	} );

	$( '.ppb-photo-canvas' ).click( function () {
		var $t = $( this ),
			filter = $t.data( 'filter' ),
			url = ppbPhoto.photoData.thumb;
		//Resetting old data
		ppbPhoto.photoData.filterControls = {};
		ppbPhoto.photoData.filters = '';
		ppbPhoto.photoData.filter = '';
		$.each( filter_controls.filters, function ( k ) {
			$( '.ppb-photo-control-' + k ).val( '0' );
		} );

		//Rendering current filter
		Caman( '#ppb-photo-canvas-main', function () {
			this.revert( false );
			if ( typeof this[filter] == 'function' ) {
				ppbPhoto.photoData.filters = filter + '()';
				ppbPhoto.photoData.filter = filter;
				this[filter]();
			}
			this.render();
		} );
	} );

	$( '.ppb-photo-control' ).change( function () {
		var filter = ppbPhoto.photoData.filter,
			i = 0;
		Caman( '#ppb-photo-canvas-main', function () {

			this.revert( false );
			if ( typeof this[filter] == 'function' ) {
				this[filter]();
			}

			window.ppbPhotoCamanThis = this;
			$.each( filter_controls.filters, function ( k ) {
				var $f = $( '.ppb-photo-control-' + k );
				if ( typeof window.ppbPhotoCamanThis[k] == 'function' && 0 != parseInt( $f.val() ) ) {
					window.ppbPhotoCamanThis[k]( parseInt( $f.val() ) );
					ppbPhoto.photoData.filters += ' ' + k + '(' + $f.val() + ')';
					ppbPhoto.photoData.filterControls[ k ] = $f.val();
				}
				i++;
				if ( i == filter_controls.number ) {
					window.ppbPhotoCamanThis.render();
				}
			} );
			//this.render()
		} );
	} );

	$( 'html' ).on( 'pootlepb_admin_input_field_event_handlers', function ( e, $this ) {
		$this.find( '.filter-button' ).click( function () {
			ppbPhoto.field = $( this ).siblings( 'input' );
			ppbPhoto.photoData = JSON.parse( ppbPhoto.field.val() );
			ppbPhoto.dlog.ppbDialog( 'open' );
		} );

		var ppbPhotoFrame;

		$this.find( '.ppb-photo-button' ).on( 'click', function ( event ) {
			ppbPhoto.field = $( this ).siblings( 'input' );
			ppbPhoto.photoData = JSON.parse( ppbPhoto.field.val() );

			event.preventDefault();

			$field = $( this ).siblings( 'input' );

			// If the media frame already exists, reopen it.
			if ( ppbPhotoFrame ) {
				ppbPhotoFrame.open();
				return;
			}

			// Create the media frame.
			ppbPhotoFrame = wp.media.frames.ppbPhotoFrame = wp.media( {
				title : 'Choose Background Image',
				button : { text : 'Set As Background Image' },
				multiple : false  // Set to true to allow multiple files to be selected
			} );

			// When an image is selected, run a callback.
			ppbPhotoFrame.on( 'select', function () {
				// We set multiple to false so only get one image from the uploader
				attachment = ppbPhotoFrame.state().get( 'selection' ).first().toJSON();

				//Updating photoData
				ppbPhoto.photoData.thumb = attachment.sizes.thumbnail.url;
				ppbPhoto.photoData.medium = attachment.sizes.medium.url;
				ppbPhoto.photoData.full = attachment.url;

				//Updating field
				$field.val( JSON.stringify( ppbPhoto.photoData ) );
				console.log(ppbPhoto.photoData);
				$field.change();

			} );

			// Finally, open the modal
			ppbPhotoFrame.open();
		} );

	} );
} );