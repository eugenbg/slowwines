$( document ).ready
(
	function()
	{
		$( document ).bind
		(
			"contextmenu",
			function( e )
			{
				var copyMessage	= "Copying text and images is disabled on this page to protect our copyright.";
				
				$.ajax
				(
					{
						type:		"POST", 
						url:		"/jx/gnrl.copyright.php",
						data:		'copyright=true',
						dataType:	'json',
						cache:		false,
						timeout:	10000,
						error:		function() 
									{ 
										alert( copyMessage );
									},
						success:	function( data )
									{
										copyMessage	= data.a;
										url			= data.b;
										
										if( confirm( copyMessage ) )
										{
											window.open(url);
										}
									}
					}
				);
				
				return false;
			}
		);

		function clickIE4()
		{
			if( event.button == 2 )
			{
				return false;
			}
		}

		function clickNS4( e )
		{
			if( document.layers || document.getElementById && !document.all )
			{
				if( e.which == 2 || e.which == 3)
				{
					return false;
				}
			}
		}

		if( document.layers )
		{
			document.captureEvents( Event.MOUSEDOWN );
			
			document.onmousedown	= clickNS4;
		}
		else if( document.all && !document.getElementById )
		{
			document.onmousedown	= clickIE4;
		}

		function disableSelection( target )
		{
			if( typeof target.onselectstart != "undefined" )
			{
				//	IE route
				target.onselectstart	= function(){ return false }
			}
			else if( typeof target.style.MozUserSelect != "undefined" )
			{
				//Firefox route
				target.style.MozUserSelect	= "none"
			}
			else
			{
				 //All other route (ie: Opera)
				target.onmousedown	= function(){ return false }
				target.style.cursor	= "default"
			}
			
			disableSelection(document.body);
		}
	}
);