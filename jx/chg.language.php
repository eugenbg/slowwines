<?php
require_once( '../inc/inc.configuration.php' );

if( isset( $_REQUEST[ "lng" ] ) )
{
	$aURL				= explode( "/", $_SERVER[ "HTTP_REFERER" ] );
	$aURL[ 3 ]			= $_REQUEST[ "lng" ];	
	$sURL				= implode( "/", $aURL );
	
	$oSrch				= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
	$oSrch->language	= $_REQUEST[ "lng" ];

	q23helper::sessionWrite( SESSION_USR, serialize( $oSrch ) );
	
	if( isset( $aURL[ 4 ] ) && $aURL[ 4 ] == 'show' && $g_aCfg[ 'plugin' ][ 'type' ] == 'rso::webkit' )
	{
		$oRSOWK	= new q23listing();
		$oRSOWK->dumb();
	}
}
else
{
	$sURL				= $_SERVER[ "HTTP_REFERER" ];
}

header( "location:" . $sURL );
?>