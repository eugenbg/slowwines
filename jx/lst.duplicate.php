<?php

try
{
	$nID	= ( isset( $_REQUEST[ "id" ] ) ) ? $_REQUEST[ "id" ] : 0;

	if( $nID > 0 )
	{
		require_once( '../inc/inc.configuration.php' );
		
		$oLst	= new q23listingController();
		
		$oLst->cloneListing( $nID );
	}
	else
	{
		throw new Exception( "Listing Unavailable." );
	}

	header( "location: " . $_SERVER[ 'HTTP_REFERER' ]  );	
}
catch( Exception $e )
{
	
}

?>