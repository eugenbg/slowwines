$( document ).ready
(
	function()
	{
		sLng	= "en";
		
		if( $( ".share-button" ).length > 0 )
		{
			new Share
			(
				".share-button",
				{
					networks: 
					{
						google_plus: { enabled: true },
						facebook: { enabled: true, app_id: 'abc123' },
						twitter: { enabled: true },
						pinterest: { enabled: false },
						email: { enabled: false }
					}
				}
			);
		}
		
		if( $( "#masterslider" ).length > 0 )
		{
			var slider = new MasterSlider();
			
			slider.control('arrows');
//			slider.control( 'timebar' , {insertTo:'#masterslider'} );
			slider.control( 'bullets' );
			slider.setup( 'masterslider' , { width:2000, height:600, view:'fade', space:1, layout:'fillwidth', loop:true, preload:0, autoplay:true } );
		}
		
		if( $( "#masterslidertour" ).length > 0 )
		{
			var slider = new MasterSlider();
			
			slider.control('arrows');
//			slider.control( 'timebar' , {insertTo:'#masterslider'} );
			slider.control( 'bullets' );
			slider.setup( 'masterslidertour' , { width:850, height:500, view:'fade', space:1, layout:'boxed', loop:true, preload:0, autoplay:true } );
		}		

		if( $( ".owl-carousel" ).length > 0 )
		{
	        $( '.owl-carousel' ).owlCarousel
	        (
	        	{
	            	autoplay: true,
	            	loop: true,
		            margin: 10,
	    	        responsiveClass: true,
	        	    dots: false,
	            	responsive: { 0:{ items: 1, nav: true }, 600:{ items: 2, nav: false }, 1000:{ items: 3, nav: true, loop: true, margin: 20 } }
		        }
	        )
        }

		/* Dropdown Menu - this is not currently working - needs fixing */
		$( '.navbar li ul' ).hide().removeClass( 'fallback' );
		$( '.navbar li.dropdown' ).hover
		(
			function()
			{
				$( 'ul', this ).stop().fadeIn( 240 );
			},
			function()
			{
				$( 'ul', this ).stop().fadeOut( 400 );
			}
		);
		
		/* Center Modal */
		function centerModals()
		{
			$( '.modal' ).each
			(
				function( i )
				{
					var $clone	= $( this ).clone().css( 'display', 'block' ).appendTo( 'body' );
					var top		= ( $clone.height() - $clone.find( '.modal-content' ).height() ) / 2;
						top		= top > 0 ? top : 0;
						
						$clone.remove();
						$( this ).find( '.modal-content' ).css( "margin-top", top );
				}
			);
		}
		
		$( '.modal' ).on( 'show.bs.modal', centerModals );
		$( window ).on( 'resize', centerModals );
		
		/* Isotope */
		if( $( ".isotope" ).length > 0 )
		{
			//	init Isotope
			var iso				= new Isotope( '.isotope', { itemSelector: '.element-item', layoutMode: 'fitRows' } );
				
			//	filter functions
			var filterFns		= { numberGreaterThan50: function( itemElem ){ var number = getText( itemElem.querySelector( '.number' ) ); return parseInt( number, 10 ) > 50; },
									ium: function( itemElem ){ 	var name = getText( itemElem.querySelector( '.name' ) ); return name.match( /ium$/ ); } };
				
			//	bind filter button click
			var filtersElem		= document.querySelector( '#filters' );
				
			eventie.bind
			(
				filtersElem, 
				'click', 
				function( event )
				{
					if( !matchesSelector( event.target, 'button' ) )
					{
						return; 
					}
					
					var filterValue = event.target.getAttribute( 'data-filter' );
					
					//	use matching filter function
					filterValue		= filterFns[ filterValue ] || filterValue;
					
					iso.arrange( { filter: filterValue } );
				}
			);
				
			//	change is-checked class on buttons
			var buttonGroups	= document.querySelectorAll( '.button-group' );
			
			for( var i=0, len=buttonGroups.length; i < len; i++ )
			{
				var buttonGroup	= buttonGroups[i];
				
				radioButtonGroup( buttonGroup );
			}
		}

		function radioButtonGroup( buttonGroup ) 
		{
			 eventie.bind
			 (
			 	buttonGroup, 
			 	'click', 
			 	function( event )
			 	{
				    if( !matchesSelector( event.target, 'button' ) ) 
				    {
						return;
				    }
				    
				    classie.remove( buttonGroup.querySelector( '.is-checked' ), 'is-checked' );
				    classie.add( event.target, 'is-checked' );
				}
			);
		}

		/* Testimonials */
		$('#carousel-testimonial').carousel( { interval: 10000 } )

		//	Cookies 
	    function cookieController() 
	    {
	        $.cookiesDirective.loadScript
	        (
	        	{
	            	uri:'google.js',
	            	appendTo: 'header'
	        	}
	        );
	    } 
	    
		$.cookiesDirective
		(
			{
				privacyPolicyUri: '/' + sLng + '/privacy/',
				explicitConsent: false,
				position : 'bottom',
				scriptWrapper: cookieController, 
				cookieScripts: 'Google Analytics', 
				backgroundColor: '#2D2D2D',
				backgroundOpacity: '80',
				fontColor: '#000000',
				linkColor: '#ffffff'
			}
		);
		

		if( $( ".func" ).length > 0 )
		{
			$( '.func' ).each
			(
				function( index )
				{
					$( this ).load
					( 
						'/jx/function.php?' +  $( this ).attr( 'datasrc' )
					);
				}
			)
		}

		if( $( "#frmEnquireMain" ).length > 0 )
		{
			$( '#frmEnquireMain' ).ajaxForm
			(
				{
					url: '/' + sLng + '/lead/generalenquiry/',
					type: 'post',
					beforeSubmit: function()
					{
						$( '#frmEnquireMain' ).validate
						(
							{
								rules: 
								{
									email: { required:true, email:true }
									
								},
								messages: 
								{
									email: ''
								},
								errorElement: "div"
							}
						);
						
						console.log( $( '#frmEnquireMain' ).valid() );
						
						if( $( '#frmEnquireMain' ).valid() )
						{
							return true;
						}
						
						return false;
					},
					success: function( response )
					{
//						$( '#frmEnquireMainWrapper' ).html( response );
						window.location	= "/en/thank-you-booking/";
					}
				}
			);
		}

		if( $( "#frmNewsletterSignup" ).length > 0 )
		{
			$( '#frmNewsletterSignup' ).ajaxForm
			(
				{
					url: '/' + sLng + '/lead/newsletter/',
					type: 'post',
					beforeSubmit: function()
					{
						$( '#frmNewsletterSignup' ).validate
						(
							{
								rules: 
								{
									email: { required:true, email:true },
									agree: { required:true }
								},
								messages: 
								{
									email: '',
									agree: 'You have to agree to the terms'
								},
								errorElement: "div",
                errorPlacement: function(error, element) {
                  if (element.attr("id") === "agree") {
                    error.insertAfter("#agree-label");
                  } else {
                    error.insertAfter(element);
                  }
                }
							}
						);
						
						console.log( $( '#frmNewsletterSignup' ).valid() );
						
						if( $( '#frmNewsletterSignup' ).valid() )
						{
							return true;
						}
						
						return false;
					},
					success: function( response )
					{
						$( '#frmNewsletterSignupWrapper' ).html( response );
					}
				}
			);
		}

		if( $( "#frmContactMain" ).length > 0 )
		{
			$( '#frmContactMain' ).ajaxForm
			(
				{
					url: '/' + sLng + '/lead/contact/',
					type: 'post',
					beforeSubmit: function()
					{
						$( '#frmContactMain' ).validate
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
						
						console.log( $( '#frmContactMain' ).valid() );
						
						if( $( '#frmContactMain' ).valid() )
						{
							return true;
						}
						
						return false;
					},
					success: function( response )
					{
//						$( '#myModal2 .modal-body' ).html( response );
						window.location	= "/en/thank-you-contact/";
					}
				}
			);
		}
		
		if( $( "#dt1" ).length > 0 )
		{
			$( "#dt1" ).datepicker( { dateFormat: 'dd-mm-yy' } );
		}
		
		if( $( "#dt2" ).length > 0 )
		{
			$( "#dt2" ).datepicker( { dateFormat: 'dd-mm-yy' } );
		}
		
		if( $( "#frmQuoteMain" ).length > 0 )
		{
			$( '#frmQuoteMain' ).ajaxForm
			(
				{
					url: '/' + sLng + '/lead/contact/',
					type: 'post',
					beforeSubmit: function()
					{
						$( '#frmQuoteMain' ).validate
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
						
						console.log( $( '#frmQuoteMain' ).valid() );
						
						if( $( '#frmQuoteMain' ).valid() )
						{
							return true;
						}
						
						return false;
					},
					success: function( response )
					{
//						$( '#frmQuoteMain' ).html( response );
						window.location	= "/en/thank-you-contact/";
					}
				}
			);
		}
		
		if( $( "#frmAvailabilityMain" ).length > 0 )
		{
			$( '#frmAvailabilityMain' ).ajaxForm
			(
				{
					url: '/' + sLng + '/lead/contact/',
					type: 'post',
					beforeSubmit: function()
					{
						$( '#frmAvailabilityMain' ).validate
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
						
						console.log( $( '#frmAvailabilityMain' ).valid() );
						
						if( $( '#frmAvailabilityMain' ).valid() )
						{
							return true;
						}
						
						return false;
					},
					success: function( response )
					{
//						$( '#frmAvailabilityMain' ).html( response );
						window.location	= "/en/thank-you-contact/";
					}
				}
			);
		}
		
		if( $( "#frmExpert" ).length > 0 )
		{
			$( '#frmExpert' ).ajaxForm
			(
				{
					url: '/' + sLng + '/lead/contact/',
					type: 'post',
					beforeSubmit: function()
					{
						$( '#frmExpert' ).validate
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
						
						console.log( $( '#frmExpert' ).valid() );
						
						if( $( '#frmExpert' ).valid() )
						{
							return true;
						}
						
						return false;
					},
					success: function( response )
					{
						$( '#frmExpert' ).html( response );
					}
				}
			);
		}
		
		if( $( "#frmSearch" ).length > 0  )
		{
			$( "#region" ).multiselect( { buttonWidth: '300px' } );
			$( "#duration" ).multiselect( { buttonWidth: '300px' } );
		}
	}
);