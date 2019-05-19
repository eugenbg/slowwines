function getLocation( sArea )
{
	$( "select[name='area']" ).each
	(
		function()
		{
			$( this ).val( sArea );
			$( this ).multiselect( 'rebuild' );
		}
	);
	
	$.ajax
	(
		{
			url: "/jx/lst.search.change.area.php",
			data: { 'ar':sArea },
			dataType: "html",
			async: false,
			cache: false,
			beforeSend: function( jqXHR, settings ){},
			success: function( data, status, xhr )
			{
				$( "select[name='location[]']" ).each
				(
					function()
					{
						$( this ).html( data );
						$( this ).multiselect( 'rebuild' );
					}
				);
			},
			complete: function( jqXHR, textStatus ){}
		}
	)
}

function setPriceOption( id, sType )
{
	$.ajax
	(
		{
			url: "/jx/lst.search.change.price.php",
			data: { 'key':sType },
			dataType: "html",
			async: false,
			cache: false,
			beforeSend: function( jqXHR, settings )
			{
//				$( '#search' ).block( { message:'<i class="fa fa-refresh fa-spin"></i>AAA', css:{ backgroundColor:'transparent', border:'none' }, overlayCSS:{ opacity:'0.3' } } );
			},
			success: function( data, status, xhr )
			{
				$( id ).html( data );
//				$( id ).multiselect( 'rebuild' );
			},
			complete: function( jqXHR, textStatus )
			{
//				$( '#search' ).unblock();
			}
		}
	)
}

function changeSort( nSort )
{
	window.location.assign( '/jx/chg.sort.php?srt=' + nSort );
}

function changeListing( o, sListing )
{
	switch( sListing )
	{
		case "sale":
		case "long":
		case "short":
			setPriceOption( "#pricemin", 'lst.price.' + sListing + '.min' );
			setPriceOption( "#pricemax", 'lst.price.' + sListing + '.max' );
			break;
			
		default:
			return;
	}
	
	$( "#pricemin" ).val( o.pricemin );
	
	if( o.pricemax == 0 )
	{
		$( "#pricemax" ).val( $('#pricemax option:last-child').val() );
	}
	else
	{
		$( "#pricemax" ).val( o.pricemax );
	}
	
	$( "select[name='pricemin']" ).multiselect( 'rebuild' );
	$( "select[name='pricemax']" ).multiselect( 'rebuild' );
}

function setPropertyType( o )
{
	$( "#property" ).val( o.property );
	$( "select[name='property[]']" ).multiselect( 'rebuild' );
}

function setListingType( o )
{
	$( "select[name='listing']" ).val( o.listing );
	$( "select[name='listing']" ).multiselect( 'rebuild' );
}

function setBedroom( o )
{
	$( "select[name='bed']" ).val( o.bed );
	$( "select[name='bed']" ).multiselect( 'rebuild' );
}

function setArea( o )
{
	$( "select[name='area']" ).val( o.area );
	$( "select[name='area']" ).multiselect( 'rebuild' );
	
	getLocation( o.area );
}

function setLocation( o )
{
	$( "select[name='location[]']" ).val( o.location );
	$( "select[name='location[]']" ).multiselect( 'rebuild' );
}

function setSort( o )
{
	$( "select[name='sort']" ).val( o.sortType );
	$( "select[name='sort']" ).multiselect( 'rebuild' );
}

$( document ).ready
(
	function()
	{
		var o	= $.parseJSON( $( ".searchData" ).html() );

//		$( "select[name='area']" ).multiselect( { nSelectedText:sSelected, nonSelectedText:sSelectedNone, maxHeight:200 } );
		$( "#listing" ).multiselect( { nSelectedText:sSelected, nonSelectedText:sSelectedNone, maxHeight:200 } );
		$( "#pricemin" ).multiselect( { nSelectedText:sSelected, nonSelectedText:sSelectedNone, maxHeight:200 } );
		$( "#pricemax" ).multiselect( { nSelectedText:sSelected, nonSelectedText:sSelectedNone, maxHeight:200 } );
		$( "#bed" ).multiselect( { nSelectedText:sSelected, nonSelectedText:sSelectedNone, maxHeight:200 } );
		$( "select[name='location[]']" ).multiselect( { includeSelectAllOption:true, selectAllText:sAll, nSelectedText:sSelected, nonSelectedText:sSelectedNone, allSelectedText:sAllSelectedText, maxHeight:200, nSelectedText:sSelectedText, numberDisplayed: 1 } );
		$( "select[name='property[]']" ).multiselect( { enableClickableOptGroups:true, nSelectedText:sSelectedText, nonSelectedText:sSelectedNone, numberDisplayed: 1, allSelectedText:sAllSelectedText, maxHeight:200 } );
		
		$( "select[name='area']" ).on( 'change', function(){ getLocation( $( this ).val() ); } );
		$( "select[name='listing']" ).on( 'change', function(){ changeListing( o, $( this ).val() ); } );
		$( "select[name='sort']" ).on( 'change', function(){ changeSort( $( this ).val() ); } );

		$( "#sort" ).multiselect();

//		setArea( o );
		setLocation( o );
		setListingType( o );
		changeListing( o, $( "select[name='listing']" ).val() );
		setPropertyType( o );
		setBedroom( o );
		setSort( o );
	}
)