<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_APP_LST );
$oCRUD->order_by( 'ourID' );
$oCRUD->table_name( 'Content Editor' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );
$oCRUD->limit( 10 );
$oCRUD->where( 'is' . ucwords( $sType ) . '=1' );
$oCRUD->unset_edit();
$oCRUD->unset_view( true );
$oCRUD->unset_add( true );
$oCRUD->unset_numbers( true );
$oCRUD->duplicate_button( false );

$oCRUD->column_class( 'priceResaleCurrent,priceRentalShortTermLow,priceRentalLongTerm,bed,bath', 'align-right' );

$oCRUD->button( '/jx/lst.duplicate.php?id={id}', 'Duplicate', 'glyphicon glyphicon-plus', 'btn-default' );
$oCRUD->button( '/' . $sLanguage . '/adm/listing/view/{id}/', 'View', 'glyphicon glyphicon-search', 'btn-info' );
$oCRUD->button( '/' . $sLanguage . '/adm/listing/edit/{id}/', 'Edit', 'glyphicon glyphicon-edit', 'btn-warning' );

q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'lst' ] );

//  Field Label Names
$oCRUD->label
(
	array
	(
		'id'=>$oTrn->word( 'listing.id' ),
		'ourID'=>$oTrn->word( 'listing.reference' ),
		'mlsID'=>$oTrn->word( 'listing.mls.id' ),
		'available'=>$oTrn->word( 'listing.available' ),
		'availableStatus'=>'',
		'dspStatus'=>'Status',
		'_dspListingType'=>$oTrn->word( 'listing.type' ),
		'_dspListingTypeSub'=>'Property Type',
		'bed'=>'Beds',
		'bath'=>'Baths',
		'imagePrimary'=>'',
		'geoCity'=>$oTrn->word( 'listing.geo.city' ),
		'priceCurrency'=>$oTrn->word( 'listing.price.currency' ),
		'priceResaleCurrent'=>$oTrn->word( 'listing.price.current' ),
		'priceResaleOriginal'=>$oTrn->word( 'listing.price.original' ),
		'priceResaleValuation'=>$oTrn->word( 'listing.price.valuation' ),
		'priceResaleValuationYear'=>$oTrn->word( 'listing.price.valuation.year' ),
		'priceRentalShortTermLow'=>'Price',
//		'priceRentalShortTermMid'=>$oTrn->word( 'listing.rental.short.term.mid' ),
//		'priceRentalShortTermHigh'=>$oTrn->word( 'listing.rental.short.term.high' ),
//		'priceRentalShortTermHoliday'=>$oTrn->word( 'listing.rental.short.term.peak' ),
		'priceRentalLongTerm'=>'Price',
		
		'vndrFirstName'=>$oTrn->word( 'listing.vendor.first.name' ),
		'vndrLastName'=>$oTrn->word( 'listing.vendor.last.name' ),
		'vndrTelephone1'=>'Telephone',
		'vndrMobile1'=>'Mobile',
		
		'usrField0'=>$oTrn->word( 'listing.usr.field.0' ),
		'usrField2'=>$oTrn->word( 'listing.usr.field.1' ) , 
		'usrField3'=>$oTrn->word( 'listing.usr.field.2' ),

		'_activeSale'=>$oTrn->word( 'general.active' ),
		'_activeRentLong'=>$oTrn->word( 'general.active' ),
		'_activeRentShort'=>$oTrn->word( 'general.active' )
	)
);

//	Formatting
$oCRUD->change_type( '_activeSale', 'bool', '', array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->change_type( '_activeRentLong', 'bool', '', array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->change_type( '_activeRentShort', 'bool', '', array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->change_type( 'priceResaleCurrent', 'price', '0', array( 'decimals'=>0, 'prefix'=>'€' ) );
$oCRUD->change_type( 'priceResaleOriginal,', 'price', '0', array( 'decimals'=>0, 'prefix'=>'€' ) );
$oCRUD->change_type( 'priceResaleValuation', 'price', '0', array( 'decimals'=>0, 'prefix'=>'€' ) );
$oCRUD->change_type( 'priceRentalLongTerm', 'price', '5', array( 'decimals'=>0, 'prefix'=>'€' ) );

$oCRUD->change_type( 'imagePrimary', 'remote_image' );
$oCRUD->change_type( 'availableStatus', 'select', '', array( ''=>'', 'available now'=>"*" ) );

//	View
switch( strtolower( $sType ) )
{
	case 'sale':
		$oCRUD->columns( 'imagePrimary, ourID, _dspListingTypeSub, geoCity, priceResaleCurrent, bed, bath, vndrFirstName, vndrLastName, vndrTelephone1, vndrMobile1, dspStatus, _activeSale' );
		$oCRUD->column_width( 'ourID,bed,bath,_activeSale', '50px' );
		$oCRUD->search_columns( 'ourID, _dspListingTypeSub, geoCity, priceResaleCurrent, bed, bath, vndrFirstName, vndrLastName, vndrTelephone1, vndrMobile1, usrField0, usrField2, usrField3, vndrAddress1', '' );
		break;
		
	case 'long':
		$oCRUD->columns( 'imagePrimary, ourID, _dspListingTypeSub, geoCity, priceRentalLongTerm, bed, bath, vndrFirstName, vndrLastName, vndrTelephone1, vndrMobile1, dspStatus, available, availableStatus' );
		$oCRUD->column_width( 'ourID,bed,bath,_activeRentLong,available', '60px' );
		$oCRUD->column_width( 'priceRentalLongTerm', '100px' );
		$oCRUD->search_columns( 'ourID, _dspListingTypeSub, geoCity, priceRentalLongTerm, bed, bath, available, availableStatus, vndrFirstName, vndrLastName, vndrTelephone1, vndrMobile1, usrField0, usrField2, usrField3, vndrAddress1', '' );
		$oCRUD->highlight_row( 'availableStatus','=','Available Now', '#CCFFCC' );
		$oCRUD->highlight_row( 'availableStatus','=','Pre Book', '#FFCC99' );
		break;
		
	case 'short':
		$oCRUD->columns( 'imagePrimary, ourID, _dspListingTypeSub, geoCity, priceRentalShortTermLow, bed, bath, vndrFirstName, vndrLastName, vndrTelephone1, vndrMobile1, dspStatus, available, availableStatus' );
		$oCRUD->column_width( 'ourID,bed,bath,_activeRentShort,available', '60px' );
		$oCRUD->column_width( 'priceRentalShortTermLow', '100px' );
		$oCRUD->column_width( 'availableStatus', '110px' );
		$oCRUD->change_type( 'priceRentalShortTermLow', 'price', '5', array( 'prefix'=>'€', 'decimals'=>0 ) );
		$oCRUD->search_columns( 'ourID, _dspListingTypeSub, geoCity, priceRentalShortTermLow, bed, bath, available, availableStatus, vndrFirstName, vndrLastName, vndrTelephone1, vndrMobile1, usrField0, usrField2, usrField3, vndrAddress1', '' );
		$oCRUD->highlight_row( 'availableStatus','=','Available Now', '#CCFFCC' );
		$oCRUD->highlight_row( 'availableStatus','=','Pre Book', '#FFCC99' );
		break;
		
	default:
		break;
}

//	Edit
//		Overview
//$oCRUD->fields( 'listingType,listingTypeSub,bed,bath,reception', false, 'Overview' );

//		Pricing
//$oCRUD->fields( 'priceResaleCurrent,priceResaleOriginal,priceResaleValuation,priceResaleValuationYear,priceRentalShortTermLow,priceRentalShortTermMid,priceRentalShortTermHigh,priceRentalShortTermHoliday,priceRentalLongTerm', false, 'Pricing' );

//		Description
//foreach( $g_aCfg[ "language" ][ "supported" ] as $sCC=>$sCN )
//{
//	$oCRUD->fields( 'abstract_' . $sCC . ',seoTitle_' . $sCC . ',seoKeyword_' . $sCC . ',seoDescription_' . $sCC . ',abstract_' . $sCC . ',description_' . $sCC, false, '<img src="/thm/usr/img/flag/' . $sCC . '.png" />&nbsp;' . $oTrn->word( 'language.' . strtolower( $sCC ) ) );
//}

//		MLS
//$oCRUD->fields( 'mlsID,mlsProvider,mlsReference,mlsOwnListing', false, 'MLS Meta' );
//$oCRUD->fields( 'mlsResaleStatus,mlsResaleDateStatus,mlsResaleDateCreated,mlsResaleDateUpdated', false, 'MLS Sale' );
//$oCRUD->fields( 'mlsRentalStatus,mlsRentalDateStatus,mlsRentalDateCreated,mlsRentalDateUpdated', false, 'MLS Rental' );
//$oCRUD->disabled( 'mlsID,mlsProvider,mlsReference,mlsResaleStatus,mlsRentalStatus,mlsOwnListing,mlsResaleDateStatus,mlsRentalDateStatus,mlsResaleDateCreated,mlsResaleDateUpdated,mlsRentalDateCreated,mlsRentalDateUpdated' );

//  	Meta
//$oCRUD->fields( '_editor, _created, _updated, _deleted, _ipAddress', false, $oTrn->word( 'general.meta' ), 'view' );

$sContent	= $oCRUD->render();
?>
