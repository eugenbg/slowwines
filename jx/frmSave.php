<?php
include_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

unset( $_REQUEST[ '_ga' ] );
unset( $_REQUEST[ '_gat' ] );
unset( $_REQUEST[ '__utmt' ] );
unset( $_REQUEST[ '__utma' ] );
unset( $_REQUEST[ '__utmb' ] );
unset( $_REQUEST[ '__utmc' ] );
unset( $_REQUEST[ '__utmz' ] );
unset( $_REQUEST[ 'files' ] );
unset( $_REQUEST[ "cookiesDirective" ] );
unset( $_REQUEST[ "PHPSESSID" ] );

switch( strtolower( $_REQUEST[ 'frm' ] ) )
{
	case 'rgn':
		unset( $_REQUEST[ 'frm' ] );
	
		$oRgn						= new q23swRegion();
		$oTr						= new q23swTour();
		$oRgn->member				= $_REQUEST;
		$oRgn->member[ "whenToGo" ]	= ( isset( $oRgn->member[ "whenToGo" ] ) ) ? implode( "::", $oRgn->member[ "whenToGo" ] ) : "";
		$aData[ 'id' ]				= $oRgn->write();
		
		$oRgn->updatePrimaryImage( $aData[ 'id' ] );
		$oTr->menu();
		
		break;
		
	case 'tr':
		unset( $_REQUEST[ 'frm' ] );
	
		$oTr							= new q23swTour();
		$oTr->member					= $_REQUEST;
		$oTr->member[ "whenToGo" ]		= ( isset( $oTr->member[ "whenToGo" ] ) )	? implode( "::", $oTr->member[ "whenToGo" ] )	: "";
		$oTr->member[ "related" ]		= ( isset( $oTr->member[ "related" ] ) )	? implode( "::", $oTr->member[ "related" ] )	: "";
		$oTr->member[ "isFeatured" ]	= ( isset( $oTr->member[ "isFeatured" ] ) )	? $oTr->member[ "isFeatured" ]					: "0";
		$aData[ 'id' ]					= $oTr->write();
		
		$oTr->updatePrimaryImage( $aData[ 'id' ] );
		$oTr->menu();
		
		break;
		
	default:
		echo 'Nothing.';
		break;
}

echo json_encode( $aData );
?>