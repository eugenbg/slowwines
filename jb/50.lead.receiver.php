<?php
//====================================================================================
//	File:		50.lead.receiver.php
//	Objective:	Sends the leads into the database and emails to the user/admin.
//	Copyright:	(c) 2010 Funky::Software, All Rights Reserved.
//------------------------------------------------------------------------------------
//	Version	Date			Developer		Comment.
//------------------------------------------------------------------------------------
//	0.1		23-Oct-2010		Andrew Makin	Concept Release.
//====================================================================================

include_once( __DIR__ . "/../inc/inc.configuration.php" );

$a = 0;
try
{
	q23helper::writeLog( LOG_FILE_CRON, "RSO Lead Reciever: Initialised.", LOG_WRITER_INFORMATION );
				
	$oSLM	= new q23saleManager;
	echo $oSLM->createMessage( $_REQUEST );

	q23helper::writeLog( LOG_FILE_CRON, "RSO Lead Reciever: Terminated.", LOG_WRITER_INFORMATION );
}
catch( Exception $e )
{
//	$oNtfc	= new funkyNotification();
//	$oNtfc->notify( 'danger', 'table', 'Local Pricing Statistics Updated.' );
}



?>