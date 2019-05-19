function initializeMap() 
{
	var oPosition	= new google.maps.LatLng( $( '.lttd' ).html(), $( '.lngtd' ).html() );
	var aOption		= { zoom: 10, center: oPosition, scrollwheel: false, draggable: false };
	var map			= new google.maps.Map( document.getElementById( 'region-map'), aOption );
	var marker		= new google.maps.Marker( { position: oPosition, map: map, title: $( ".abstract h1:first" ).html() } );
}

function loadMap() 
{
	var script		= document.createElement( 'script' );
		script.type	= 'text/javascript';
		script.src	= 'https://maps.googleapis.com/maps/api/js?v=3.exp&' + 'callback=initializeMap';
		
	document.body.appendChild( script );
}

$( window ).load
(
	function()
	{
		if( $( "#listingSlider" ) )
		{
		    var slider = new MasterSlider();
		 
			slider.control( 'arrows' );  
		    slider.control( 'lightbox' );
		    slider.control( 'thumblist' , { autohide:false ,dir:'h',align:'bottom', width:130, height:85, margin:5, space:5, hideUnder:400 } );
			slider.setup( 'listingSlider', { width:750, height:500, space:5, loop:true, autoplay:true, view:'fade' } );
		     
	        $("a[rel^='prettyPhoto']").prettyPhoto( { deeplinking:false, social_tools:false, overlay_gallery:false } );
        }
		
		loadMap();
		
		$( '#back' ).on
		(
			'click',
			function( event )
			{
				event.preventDefault();
				history.go(-1);
			}
		)
		
		$( '#print' ).on
		(
			'click',
			function( event )
			{
				sLng	= $( 'meta[property="og:locale"]' ).attr( "content" ).split( "_" )[0];
				sType	= $( '.genus' ).html();
				sID		= $( '.lid' ).html();
				
				window.open( '/' + sLng + '/print/' + sType + '/' + sID + '/', '_print' );
			}
		)
		
		$( '#frmEnquiry' ).ajaxForm
		(
			{
				url: '/en/lead/enquiry/',
				type: 'post',
				beforeSubmit: function()
				{
					$( '#frmEnquiry' ).validate
					(
						{
							rules: 
							{
								name: { required:true },
								email: { required:true, email:true }
								
							},
							messages: 
							{
								name: '',
								email: ''
							},
							errorElement: "div"
						}
					);
					
					console.log( $( '#frmEnquiry' ).valid() );
					
					if( $( '#frmEnquiry' ).valid() )
					{
//						$.blockUI( { message:"<img src='/img/usr/ajax-wait.gif'>", css:{ backgroundColor:'transparent', border:'none' }, overlayCSS:{ opacity:'0.3' } } );
						
						return true;
					}
					
					return false;
				},
				success: function( response )
				{
					$( '#frmEnquiryWrapper' ).html( response );
//					$.unblockUI();
				}
			}
		);
	}
);