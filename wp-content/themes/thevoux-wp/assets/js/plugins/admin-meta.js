jQuery(document).ready(function($){
	var thb_data = new FormData(),
			thb_once = false;
	
	thb_data.append( 'action', 'ocdi_import_demo_data' );
	thb_data.append( 'security', ocdi.ajax_nonce );
	
	function thb_ajaxCall() {
		var demo = $('input[name="option_tree[demo-select]"]:checked').val();

		thb_data.append( 'selected', demo );
		
		// AJAX call.
		$.ajax({
			method:     'POST',
			url:        ocdi.ajax_url,
			data:       thb_data,
			contentType: false,
			processData: false,
			beforeSend: function() {
				if (!thb_once) {
					$('#thb-import-messages').addClass('active').append( '<div class="notice notice-success"><p><strong>Starting Import</strong></p></div>' );
					thb_once = 1;
				}
			}
		})
		.done( function( response ) {
			if ( 'undefined' !== typeof response.status && 'newAJAX' === response.status ) {
				thb_ajaxCall( thb_data );
			} else {
				$( '#thb-import-messages' ).append( '<div class="error below-h2"><p>' + response.message + '</p></div>' );
			}
		})
		.fail( function( error ) {
			$('#thb-import-messages').append( '<div class="error thb-failed below-h2"> Error: ' + error.statusText + ' (' + error.status + ')' + '</div>' );
		});
	}
	
	$('#import-demo-content').on("click", function(e){
		$(this).addClass('disabled').attr('disabled', 'disabled').unbind('click');
		
		thb_ajaxCall(thb_data);
		
		e.preventDefault();
	});

	
	ThbImage = {

		// Call this from the upload button to initiate the upload frame.
		uploader : function( widget_id, widget_id_string, widget_alt ) {

			var frame = wp.media({
				title : ThbImageWidget.frame_title,
				multiple : false,
				library : { type : 'image' },
				button : { text : ThbImageWidget.button_title }
			});

			// Handle results from media manager.
			frame.on('close',function( ) {
				var attachments = frame.state().get('selection').toJSON();
				$('#'+widget_id_string).val(attachments[0].url);
				$('#'+widget_alt).val(attachments[0].alt);
			});

			frame.open();
			return false;
		},

	};

});