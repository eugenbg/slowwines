<?php
require_once( '../inc/inc.configuration.php' );

$oTrn	= new q23translate();
$oSrch	= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
	
if( function_exists( $_REQUEST[ "cmd" ] ) ) 
{
	$sOutput	= $_REQUEST[ "cmd" ]( $_REQUEST );

}
else
{
	$sOutput	=  "<strong><i>Función no disponible - " . $_REQUEST[ "cmd" ] . "</i></strong>";
}

$oTrn->render( $sOutput, $oSrch->language );

echo $oTrn->content;
?>