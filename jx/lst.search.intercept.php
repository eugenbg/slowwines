<?php
//====================================================================================
//	File:		lst.search.intercept.php
//	Copyright:	(c) 2014 Quantum 23, all rights reserved.
//====================================================================================
require_once( '../inc/inc.configuration.php' );

$oSrch	= new q23dataSearch();

$sLng	= $oSrch->language;

$oSrch->resetSearch();

$oSrch->language	= $sLng;

$oSrch->update( $_REQUEST );

$sURL	= str_replace( array( "{variable.language}", "{variable.page}" ), array( $oSrch->language, $oSrch->pageNo ), "/{variable.language}/search/result/{variable.page}/" );

//var_dump( $_REQUEST );

q23helper::sessionWrite( SESSION_USR, serialize( $oSrch ) );

header( "location: " . $sURL );
?>