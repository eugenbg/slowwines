<?php
//====================================================================================
//	File:		02.exchange.rate.update.php
//	Objective:	Download and import the currency EXCHANGE RATE information.
//	Copyright:	(c) 2010 Funky::Software, All Rights Reserved.
//------------------------------------------------------------------------------------
//	Version	Date			Developer		Comment.
//------------------------------------------------------------------------------------
//	0.1		20-Apr-2010		Andrew Makin	Concept Release.
//====================================================================================

include_once( __DIR__ . "/../inc/inc.configuration.php" );

try
{
	q23helper::writeLog( LOG_FILE_CRON, "Exchanger Rate Update: Initialised.", LOG_WRITER_INFORMATION );
				
	$oECB		= new q23currency();
	$oECB->cfg	= $g_aCfg;
	$oECB->run();
	
	$oCfg		= new q23configuration();
	$oCfg->update( "exchange.rate", date( "Y-m-d H:i:s" ) );

	q23helper::writeLog( LOG_FILE_CRON, "Exchanger Rate Update: Terminated.", LOG_WRITER_INFORMATION );
}
catch( Exception $e )
{
	$oNtfc	= new q23notification();
	$oNtfc->notify( 'danger', 'table', 'Local Pricing Statistics Updated.' );
}
?>
