<?php
//====================================================================================
//	File:		01.maxmind.update.php
//	Objective:	Download and import the IP address information.
//	Copyright:	(c) 2010 Funky::Software, All Rights Reserved.
//------------------------------------------------------------------------------------
//	Version	Date			Developer		Comment.
//------------------------------------------------------------------------------------
//	0.1		20-Apr-2010		Andrew Makin	Concept Release.
//====================================================================================

include_once( __DIR__ . "/../inc/inc.configuration.php" );

try
{
	q23helper::writeLog( LOG_FILE_CRON, "Maxmind Update: Initialised.", LOG_WRITER_INFORMATION );
				
	$oMM		= new q23maxMind();
	$oMM->cfg	= $g_aCfg;
	$oMM->run();
	
	unset( $oMM->oDB );
	
	$oCfg		= new q23configuration();
	$oCfg->update( "ip.address", date( "Y-m-d H:i:s" ) );

	q23helper::writeLog( LOG_FILE_CRON, "Maxmind Update: Terminated.", LOG_WRITER_INFORMATION );
}
catch( Exception $e )
{
	$oNtfc	= new q23notification();
	$oNtfc->notify( 'danger', 'table', 'Local Pricing Statistics Updated.' );
}
?>
