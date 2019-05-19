<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_UTL_CONFIGURATION );
$oCRUD->where( '_active=', 1 );
$oCRUD->order_by( 'collection, name' );
$oCRUD->table_name( 'Configuration Editor' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );
$oCRUD->limit( '20' );

q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'sttng' ] );

if( strlen( $sCollection ) > 0 )
{
	$oCRUD->where( "collection=", $sCollection );
	$oCRUD->columns( 'name, value' );

	switch( $sCollection )
	{
		case "update":
			$oCRUD->unset_add( true );
			$oCRUD->unset_edit( true );
			$oCRUD->unset_remove( true );
			$oCRUD->limit( '20' );
			$oCRUD->unset_limitlist();
			break;
		
		default:
			break;
	}
}
else
{
	$oCRUD->columns( 'collection, name, value' );
}

//  Field Label Names
$oCRUD->label
	(
		array
		(
			'collection'=>$oTrn->word( 'setting.configuration.collection' ),
			'name'=>$oTrn->word( 'setting.configuration.key' ),
			'value'=>$oTrn->word( 'setting.configuration.value' ),

			'_active'=>$oTrn->word( 'general.active' ),
			'_created'=>$oTrn->word( 'general.created' ),
			'_updated'=>$oTrn->word( 'general.updated' ),
			'_deleted'=>$oTrn->word( 'general.deleted' ),
			'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
			'_editor'=>$oTrn->word( 'general.editor' )
		)
	);

//  Detail.
$oCRUD->fields( 'collection, name, value', false, $oTrn->word( 'general.configuration.item' ) );
$oCRUD->no_editor( 'value' );
$oCRUD->change_type( '_active', 'select', 1, array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->change_type( 'value', 'textarea' );

//  Meta
$oCRUD->fields( '_editor, _created, _updated, _deleted, _ipAddress', false, $oTrn->word( 'general.meta' ), 'view' );

$sContent	= $oCRUD->render();
?>
