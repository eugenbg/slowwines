<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_APP_SLM_CAMPAIGN );
$oCRUD->order_by( '_created, _updated' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );
$oCRUD->limit( 10 );

q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'slm' ] );

//  Field Label Names
$oCRUD->label
(
	array
	(
		'code'=>$oTrn->word( 'lead.campaign.code' ),
		'name'=>$oTrn->word( 'lead.campaign.description' ),

		'_isActive'=>$oTrn->word( 'general.active' ),
		'_created'=>$oTrn->word( 'general.created' ),
		'_updated'=>$oTrn->word( 'general.updated' ),
		'_deleted'=>$oTrn->word( 'general.deleted' ),
		'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
		'_editor'=>$oTrn->word( 'general.editor' )
	)
);

//  View.
$oCRUD->columns( 'code, name' );

//  Detail.
$oCRUD->fields( 'code, name, _isActive', false, $oTrn->word( 'lead.campaign.title' ) );
$oCRUD->change_type( '_isActive', 'select', 1, array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );

//  Meta
$oCRUD->fields( '_editor,_created, _updated, _deleted, _ipAddress', false, $oTrn->word( 'general.meta' ), 'view' );

$sContent	= $oCRUD->render();
?>