<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );
q23helper::showVariable($_REQUEST);
$sUpload	= $_SERVER['DOCUMENT_ROOT'] . '/dt/img/' . $_REQUEST[ 'frm' ];
$aPayload	= json_decode( $_REQUEST[ 'image' ] );
$aPayload	= array_filter( $aPayload );

switch( $_REQUEST[ 'frm' ] )
{
	case "rgn":
		$oObj	= new q23swRegion();
		break;
		
	case "tr":
		$oObj	= new q23swTour();
		break;
}

$oObj->member[ 'id' ]		= (integer)$_REQUEST[ 'id' ];
$oObj->member[ 'image' ]	= implode( '::', $aPayload );

$oObj->write();
$oObj->updatePrimaryImage( (integer)$_REQUEST[ 'id' ] );
?>