function message()
{
	this.success	=	function( sTitle, sMessage )
						{
							this.fade(); 
							$( '#alertHolder').html( '<div class="alert alert-success"><button class="close" data-dismiss="alert"> × </button><i class="fa fa-check-circle"></i>&nbsp;<strong>' + sTitle + '</strong>&nbsp;' + sMessage + '</div>' ).trigger( 'showAlert' ); 
						}
						
	this.info		=	function( sTitle, sMessage )
						{
							this.fade();
							$( '#alertHolder').html( '<div class="alert alert-info"><button class="close" data-dismiss="alert"> × </button><i class="fa fa-info-circle"></i>&nbsp;<strong>' + sTitle + '</strong>&nbsp;' + sMessage + '</div>' ) 
						}
						
	this.warning	=	function( sTitle, sMessage )
						{
							this.fade(); 
							$( '#alertHolder').html( '<div class="alert alert-warning"><button class="close" data-dismiss="alert"> × </button><i class="fa fa-exclamation-triangle"></i>&nbsp;<strong>' + sTitle + '</strong>&nbsp;' + sMessage + '</div>' ) 
						}
	
	this.failure	=	function( sTitle, sMessage )
						{
							this.fade(); 
							$( '#alertHolder').html( '<div class="alert alert-danger"><button class="close" data-dismiss="alert"> × </button><i class="fa fa-times-circle"></i>&nbsp;<strong>' + sTitle + '</strong>&nbsp;' + sMessage + '</div>' ) 
						}
						
	this.fade		=	function()
						{
							window.setTimeout
							(
								$.proxy
								(
									function()
									{
										$( '.alert' ).fadeTo( 500, 0 ).slideUp( 500, function(){ $( '.alert' ).remove(); } );
									}, 
									$( '.alert' ) 
								), 
								5000 
							); 
						}  
}

function listing( aLanguage, sLanguage )
{
	oListing				=	this;
	this.current			=	sLanguage;
	this.language			=	aLanguage;
	this.count				=	function()
								{
									for( nIndex=0; nIndex<this.language.length; ++nIndex )
									{
										$( '#' + this.language[ nIndex ] + "_title" ).limiter( 55, $( '#seoTitleCount_' + this.language[ nIndex ] ) );
										$( '#' + this.language[ nIndex ] + "_keyword" ).limiter( 255, $( '#seoKeywordCount_' + this.language[ nIndex ] ) );
										$( '#' + this.language[ nIndex ] + "_abstract" ).limiter( 160, $( '#seoAbstractCount_' + this.language[ nIndex ] ) );
									}
								};
	this.save				=	function( oForm )
								{
									for( nIndex=0; nIndex<this.language.length; ++nIndex )
									{
										var aField		= [ 'body', 'itinerary', 'accommodation', 'price', 'useful', 'availability', 'like' ];
										var sLanguage	= this.language[ nIndex ];
										
										$.each
										(
											aField,
											function( nPosition, vValue )
											{
												if( $( '#'  + sLanguage + '_' + vValue ).length != 0 )
												{
													var ed = tinyMCE.get( sLanguage + "_" + vValue );
													
													$( '#'  + sLanguage + '_' + vValue ).html( ed.getContent() );
												}
											}
										)
									}
									
									$( '#' + oForm ).ajaxSubmit
									(
										{
											async: false,
											beforeSubmit: function()
											{
												var	nIndex;
												
												$( '#' + oForm ).validate
												(
													{
														rules: 
														{
															ourID: { required:true }
														},
														messages: 
														{
															ourID: 'Reference required.'
														},
														errorElement: "div",
														errorLabelContainer: "#errorContainer",
        												wrapper: "li"
													}
												);
												
												if( $( '#' + oForm ).valid() )
												{
													$.blockUI( { message: "<img src='/thm/adm/assets/images/ajaxLoaderBig.gif' />", css: { backgroundColor: 'transparent', border:'0px solid transparent' } } );
													
													return true;
												}
												
												oAlert.failure( 'Errors', '<ul>' + $( '#errorContainer' ).html() + '</ul>' );
												
												return false;
											},
											error: function( jqXHR, textStatus, errorThrown )
											{
												oAlert.failure( 'Saved', textStatus + ' ' + errorThrown );
											},
											success: function( response )
											{
												$.unblockUI();
												
												var o	= $.parseJSON( response );

												$( "#id" ).val( o.id );
												
												oAlert.success( 'Saved.', '' );
												
												return true;
											},
											type: 'post',
											url: '/jx/frmSave.php'
										}
									);
									
									return true;
								}
								
	this.saveNew			=	function( oForm )
								{
									var	bResult	= this.save( oForm );
									
									if( bResult == true )
									{
										window.location.assign( "/" + this.current + '/adm/listing/new/'  );
									}
								}
								
	this.saveClose			=	function( oForm )
								{
									var	bResult	= this.save( oForm );
									
									if( bResult == true )
									{
										window.location.assign( $( "#referrer" ).html() );
									}
								}
								
	this.showDropZone		=	function( oForm )
								{
									console.log( "I:" + $( "#id" ).val() );
									if( $( "#id" ).val() == 0 )
									{
										$( "div.dropzone" ).hide();
									}
									else
									{
										$( "div.dropzone" ).show();
									}
								}
								
	this.eFlyer				=	function( sType )
								{
									nID	= $( "#id" ).val();
									
									$( '#eFlyer' ).modal( 'show' );
									
									$( '#eFlyer .btn-primary' ).click
									(
										function()
										{
											nLstID		= $( '#id' ).val();
											sEmail		= $( '#eFlyer #efLstEmail' ).val();
											sLng		= $( '#eFlyer #efLstLanguage' ).val();
											sLstType	= $( '#eFlyer #efLstType' ).val();
											
											$.ajax
											(
												{
													async: false,
													beforeSubmit: function(){},
													error: function( jqXHR, textStatus, errorThrown )
													{
														oAlert.failure( 'eFlyer: ', textStatus + ' ' + errorThrown );
													},
													success: function( response )
													{
														oAlert.success( 'eFlyer: Sent (' + sEmail + ')', '' );
														
														return true;
													},
													type: 'post',
													url: "/jb/94.mail.listing.php?id=" + nLstID + "&ty=" + sLstType + "&lng=" + sLng + "&email=" + sEmail
												}
											);
											
											$( '#eFlyer' ).modal( 'hide' );
											$( '#eFlyer #efLstEmail' ).val( null );
										}
									);	
								}
								
	this.duplicate			=	function( oForm )
								{
									
								}
								
	this.isResale			=	function()
								{
									if( $( '#isResale:checked' ) )
									{
										$( "#salePricing" ).show();
									}
									else
									{
										$( "#salePricing" ).hide();
									}
								}
								
	this.cancel				=	function()
								{
									if( $( '#frmListing').hasClass( 'dirty' ) )
									{
										$( '#dismisChanges' ).modal( 'show' );
										$( '#dismisChanges .btn-yes' ).click
										(
											function()
											{
												$( '#dismisChanges' ).modal( 'hide' );
												window.location.assign( $( "#referrer" ).html() );
											}
										);
									}
									else
									{
										window.location.assign( $( "#referrer" ).html() );
									}
								}
								
	this.noteRead			=	function( nID, sType )
								{
									
								}
								
	this.noteWrite			=	function( nID, sText, sType, sUsr )
								{
									if( sText.length > 0 )
									{
										$.ajax
										(
											{
												url: '/jx/gen.note.write.php',
												async: false,
												data: { 'id':nID, 'text':sText, 'type':sType, 'usr':sUsr },
												dataType: 'html',
												error: function( xhr, status, error )
												{
													oAlert.failure( 'Error:', 'Failed to write note.' );
													
													sResult	= '';
												},
												success: function( result, status, xhr )
												{
													sResult	= result;
												},
												type: 'POST'
											}
										)
									}
									
									return sResult;
								}
								
	this.note				=	function()
								{
									$( '#listingNote' ).modal( 'show' );
									$( '#listingNote .btn-add' ).click
									(
										function()
										{
											sText	= oListing.noteWrite( $( '#id' ).val(), $( '#listingNote #note' ).val(), 'lst', $( '#_editor' ).val() );
											$( '#notation' ).html( sText );
											
											$( '#listingNote' ).modal( 'hide' );
											$( '#listingNote #note' ).val( null );
										}
									);
								}
					
	this.getProvince		=	function( sState )
								{
									$.ajax
									(
										{
											url: '/jx/geo.get.data.php',
											async: false,
											beforeSend: function()
											{
												$( '#geoProvinceHolder' ).html( "<img src='/thm/adm/assets/images/ajaxLoader.gif' />" );
											},
											data: { 'type':'province', 'state':sState },
											dataType: 'html',
											error: function( xhr, status, error )
											{
												oAlert.failure( 'Error:', 'Failed to update provinces.' );
											},
											success: function( result, status, xhr )
											{
												$( "#geoProvinceHolder" ).html( result );
												$( "#geoProvince" ).val( $( "#geoProvince option:first").val() );
												$( '#geoProvince' ).change( function(){ oLst.getCity( $( "#geoState option:selected" ).val(), $( "#geoProvince option:selected" ).val() ); } )
											},
											type: 'GET'
										}
									)
								}
							
	this.getCity			=	function( sState, sProvince )
								{
									$.ajax
									(
										{
											url: '/jx/geo.get.data.php',
											async: false,
											beforeSend: function()
											{
												$( '#geoCityHolder' ).html( "<img src='/thm/adm/assets/images/ajaxLoader.gif' />" );
											},
											data: { 'type':'city', 'state':sState, 'province':sProvince },
											dataType: 'html',
											error: function( xhr, status, error )
											{
												oAlert.failure( 'Error:', 'Failed to update cities.' );
											},
											success: function( result, status, xhr )
											{
												$( "#geoCityHolder" ).html( result );
												$( "#geoCity" ).val( $( "#geoCity option:first").val() );
											},
											type: 'GET'
										}
									)
								}
							
	this.getListingSubType	=	function( sListingType )
								{
									$.ajax
									(
										{
											url: '/jx/lst.get.data.php',
											async: false,
											beforeSend: function()
											{
												$( '#listingSubHolder' ).html( "<img src='/thm/adm/assets/images/ajaxLoader.gif' />" );
											},
											data: { 'type':'sub', 'listing':sListingType },
											dataType: 'html',
											error: function( xhr, status, error )
											{
												oAlert.failure( 'Error:', 'Failed to update property sub types.' );
											},
											success: function( result, status, xhr )
											{
												$( "#listingSubHolder" ).html( result );
												$( "#listingTypeSub" ).val( $( "#listingTypeSub option:first").val() );
											},
											type: 'GET'
										}
									)
								}
								
	this.similar			=	function()
								{
								}
								
	this.view				=	function( nID )
								{
									console.log( "listing::view - " + nID );
								}
}

function checkBoxSwitch( sID )
{
	if( $( sID ).is( 'checked' ) )
	{
		$( sID ).prop( 'checked', false );
		$( sID ).removeAttr('checked');
console.log( "off:" + sID );
	}
	else
	{
		$( sID ).prop( 'checked', true );
		$( sID ).attr('checked', 'checked');
console.log( "on:" + sID );
	}
}

(
	function( $ )
	{
		$.fn.extend
		(
			{
				limiter:	function( limit, elem )
							{
								$( this ).on( "keyup focus", function(){ setCount( this, elem ); } );
								
								function setCount( src, elem )
								{
									var chars	= src.value.length;
									
									if( chars > limit )
									{
										elem.css( { 'color': 'red' } );
									}
									else
									{
										elem.css( { 'color': '#858585' } );
									}
									
									elem.html( limit - chars );
								}
								
								setCount( $( this )[0], elem );
							}
			}
		);
	}
)( jQuery );