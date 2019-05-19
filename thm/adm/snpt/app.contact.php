<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_APP_SLM_CONTACT );
$oCRUD->order_by( '_created, _updated' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );
$oCRUD->limit( 10 );

if( $nLatest > 0 )
{
	$oCRUD->where( "_created > DATE_SUB( CURDATE(), INTERVAL " . $nLatest . " DAY )" );
}

q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'slm' ] );

//  Field Label Names
$oCRUD->label
(
	array
	(
		'campaign'=>$oTrn->word( 'contact.campaign.name' ),
		'subject'=>$oTrn->word( 'contact.subject' ),
		'name'=>$oTrn->word( 'contact.name' ),
		'email'=>$oTrn->word( 'contact.email' ),
		'telephone'=>$oTrn->word( 'contact.telephone' ),
		'message'=>$oTrn->word( 'contact.message' ),
		'language'=>$oTrn->word( 'contact.language' ),
		'payload'=>$oTrn->word( 'contact.payload' ),

		'_active'=>$oTrn->word( 'general.active' ),
		'_created'=>$oTrn->word( 'general.created' ),
		'_updated'=>$oTrn->word( 'general.updated' ),
		'_deleted'=>$oTrn->word( 'general.deleted' ),
		'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
		'_editor'=>$oTrn->word( 'general.editor' )
	)
);

//  View.
$oCRUD->columns( 'campaign,subject,name,email,telephone,language' );

//  Detail.
$oCRUD->fields( 'campaign,subject,name,email,telephone,message,language,_active', false, $oTrn->word( 'contact.detail' ) );
$oCRUD->change_type( '_active', 'bool', '', array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->relation( 'campaign', TBL_APP_SLM_CAMPAIGN, 'code', 'name' );
$oCRUD->readonly( 'campaign' );

//  Meta
$oCRUD->fields( '_editor, _created, _updated, _deleted, _ipAddress, payload', false, $oTrn->word( 'general.meta' ), 'view' );
$oCRUD->no_editor( 'payload' );

if( $nID > 0 )
{
	$sContent	= $oCRUD->render( 'view', $nID );
}
else
{
	$sContent	= $oCRUD->render();
}

