<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_UTL_NOTIFICATION );
$oCRUD->order_by( '_created' );
$oCRUD->table_name( 'Notification Editor' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );
$oCRUD->limit( '10' );

q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'sttng' ] );

$oCRUD->columns( 'message,unread' );

//  Field Label Names
$oCRUD->label
	(
		array
		(
			'status'=>$oTrn->word( 'setting.configuration.collection' ),
			'type'=>$oTrn->word( 'setting.configuration.key' ),
			'message'=>$oTrn->word( 'setting.configuration.value' ),
			'unread'=>'Read',

			'_isActive'=>$oTrn->word( 'general.active' ),
			'_created'=>$oTrn->word( 'general.created' ),
			'_updated'=>$oTrn->word( 'general.updated' ),
			'_deleted'=>$oTrn->word( 'general.deleted' ),
			'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
			'_editor'=>$oTrn->word( 'general.editor' )
		)
	);

$oCRUD->fields( 'status, type, message, unread', false, $oTrn->word( 'general.configuration.item' ) );

$oCRUD->change_type( '_isActive', 'select', 1, array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->change_type( 'unread', 'select', 1, array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->disabled( 'status,type' );

$oCRUD->fields( '_editor, _created, _updated, _deleted, _ipAddress', false, $oTrn->word( 'general.meta' ), 'view' );

if( $nID > 0 )
{
	$sContent	= $oCRUD->render( 'view', $nID );
}
else
{
	$sContent	= $oCRUD->render();
}
?>
