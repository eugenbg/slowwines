<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

$sUpload	= $_SERVER['DOCUMENT_ROOT'] . '/dt/img/' . $_REQUEST[ 'frm' ];
$sFolder	= $_REQUEST[ 'id' ];
$sFileName	= $_REQUEST[ 'file' ];
$sTarget	= $sUpload . DIRECTORY_SEPARATOR . $sFolder . DIRECTORY_SEPARATOR . $sFileName;

switch( $_REQUEST[ 'frm' ] )
{
	case "rgn":
		$oObj	= new q23swRegion();
		break;
}

if( file_exists( $sTarget ) )
{
	unlink( $sTarget );
}

$oObj->updatePrimaryImage( (integer)$_REQUEST[ 'id' ] );
?>