<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

$aExtension		= array( "gif", "jpeg", "jpg", "png" );
$sName			= explode( ".", $_FILES[ "file" ][ "name" ] );
$sExtension		= strtolower( end( $sName ) );
$sNameNew		= $_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/img/" . $_REQUEST[ 'frm' ] . "/" . $_REQUEST[ 'id' ] . "/";

switch( $_REQUEST[ 'frm' ] )
{
	case "rgn":
		$oObj	= new q23swRegion();
		break;
		
	case "tr":
		$oObj	= new q23swTour();
		break;
}

if( in_array( $sExtension, $aExtension ) )
{
	if( !file_exists( $sNameNew ) )
	{
		mkdir( $sNameNew, 0755, true );
	}
	
	move_uploaded_file( $_FILES[ "file" ][ "tmp_name" ], $sNameNew . $_FILES[ "file" ][ "name" ] );

	q23helper::imageResize( $sNameNew . $_FILES[ "file" ][ "name" ], 1000, 1000 );

	$oResponse			= new StdClass;
	$oResponse->link	= $sNameNew;
	
	$oObj->updatePrimaryImage( (integer)$_REQUEST[ 'id' ] );
	
	echo stripslashes( json_encode( $oResponse ) );
}
?>