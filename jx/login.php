<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

if( isset( $_REQUEST[ "username" ] ) && isset( $_REQUEST[ "password" ] ) )
{
	$oUM	= new q23user();

	if( $oUM->login( $_REQUEST[ "username" ], $_REQUEST[ "password" ] ) )
	{
		$aUsr	= ( q23helper::sessionAvailable( SESSION_ADM ) ) ? unserialize( q23helper::sessionRead( SESSION_ADM ) ) : NULL;

		header( "location: /" . $aUsr[ 'lng' ] . "/adm/" );
	}
	else
	{
		header( "location: /en/adm/" );
	}
}
else
{

}
?>