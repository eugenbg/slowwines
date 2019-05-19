<?php
//====================================================================================
//	File:		51.build.menu.php
//	Objective:	
//	Copyright:	(c) 2010 Funky::Software, All Rights Reserved.
//------------------------------------------------------------------------------------
//	Version	Date			Developer		Comment.
//------------------------------------------------------------------------------------
//	0.1		23-Oct-2010		Andrew Makin	Concept Release.
//====================================================================================

include_once( __DIR__ . "/../inc/inc.configuration.php" );

try
{
	$oBs		= new q23base();

	$oBs->oDB->query( "SELECT t1.id, t1.tour AS ourID, t2.en_title AS tour, t1.url, t1.dateStart, t1.dateEnd, t1.availability, t1.class FROM qres_app_tour as t1 JOIN qres_app_cms_tour AS t2 ON t1.tour=t2.ourID WHERE t1.dateStart >= NOW() AND t1.tour='" . $_REQUEST[ "x" ] . "'" );
	
	$aResult	= $oBs->oDB->result();
	$aOutput	= array();
	
	foreach( $aResult as $aRow )
	{
		$aOutput[]	= array(	'id'=>$aRow[ "id" ], 
								'title'=>$aRow[ "tour" ], 
								'url'=>"", 
								'class'=>$aRow[ "class" ],
								'start'=>strtotime( $aRow[ "dateStart" ] ) . '000', 
								'end'=>strtotime( $aRow[ "dateEnd" ] ) . '000' );
	}
	
	echo json_encode( array( 'success' => 1, 'result' => $aOutput ) );
}
catch( Exception $e )
{
//	$oNtfc	= new funkyNotification();
//	$oNtfc->notify( 'danger', 'table', 'Local Pricing Statistics Updated.' );
}
?>


