<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_UTL_USER );
$oCRUD->order_by( 'usr' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );
$oCRUD->limit( '10' );

q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'sttng' ] );

//  Field Label Names
$oCRUD->set_var( 'tmp', 'Joe Blow' );

$oCRUD->label
(
	array
	(
		'usr'=>$oTrn->word( 'usr.username' ),
		'pwd'=>$oTrn->word( 'usr.password' ),
		'nameFirst'=>$oTrn->word( 'usr.first.name' ),
		'nameLast'=>$oTrn->word( 'usr.last.name' ),
		'email'=>$oTrn->word( 'usr.email' ),
		'usrAgent'=>$oTrn->word( 'usr.user.agent' ),
		'usrACL'=>$oTrn->word( 'usr.acl' ),
		'lastLogin'=>$oTrn->word( 'usr.last.login' ),
		'lastLoginAddress'=>$oTrn->word( 'usr.last.login.address' ),
		'sessionKey'=>$oTrn->word( 'usr.session.key' ),
		'image'=>$oTrn->word( 'usr.image' ),
		'zoneLst'=>$oTrn->word( 'usr.zone.listing' ),
		'zoneSLM'=>$oTrn->word( 'usr.zone.slm' ),
		'zoneCntnt'=>$oTrn->word( 'usr.zone.content' ),
		'zoneSttst'=>$oTrn->word( 'usr.zone.statistic' ),
		'zoneActn'=>$oTrn->word( 'usr.zone.action' ),
		'zoneSttng'=>$oTrn->word( 'usr.zone.setting' ),
		
		'_active'=>$oTrn->word( 'general.active' ),
		'_created'=>$oTrn->word( 'general.created' ),
		'_updated'=>$oTrn->word( 'general.updated' ),
		'_deleted'=>$oTrn->word( 'general.deleted' ),
		'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
		'_editor'=>$oTrn->word( 'general.editor' )
	)
);

$aACL	= array(	'0'=>$oTrn->word( 'acl.no.access' ), 
					'1'=>$oTrn->word( 'acl.subscriber' ), 
					'2'=>$oTrn->word( 'acl.contributor' ), 
					'3'=>$oTrn->word( 'acl.author' ), 
					'4'=>$oTrn->word( 'acl.editor' ), 
					'8'=>$oTrn->word( 'acl.administrator' ), 
					'9'=>$oTrn->word( 'acl.super.administrator' ) );

//  View.
$oCRUD->columns( 'nameFirst, nameLast, usr, email, lastLogin' );

//  Overview Tab.
$oCRUD->fields( 'usr, pwd, nameFirst, nameLast, email, image, lastLogin, lastLoginAddress, _active', false, $oTrn->word( 'general.overview' ) );
$oCRUD->change_type( '_active', 'bool', '', array( '0'=>'No', '1'=>'Yes') );
$oCRUD->change_type( 'usrACL', 'select', 'usrACL', array( '0'=>$oTrn->word( 'acl.no.access' ), '1'=>$oTrn->word( 'acl.subscriber' ), '2'=>$oTrn->word( 'acl.contributor' ), '3'=>$oTrn->word( 'acl.author' ), '4'=>$oTrn->word( 'acl.editor' ), '8'=>$oTrn->word( 'acl.administrator' ), '9'=>$oTrn->word( 'acl.super.administrator' ) ) );
$oCRUD->change_type( 'image', 'image', '', array( 'ratio' => 1, 'manual_crop' => true ) );
$oCRUD->disabled( 'usrAgent, lastLogin, lastLoginAddress, sessionKey' );

//	Zone Tab.
$oCRUD->fields( 'zoneLst, zoneSLM, zoneCntnt, zoneSttst, zoneActn, zoneSttng', false, $oTrn->word( 'usr.zone' ) );
$oCRUD->change_type( 'zoneLst', 'select', 'zoneLst', $aACL );
$oCRUD->change_type( 'zoneSLM', 'select', 'zoneSLM', $aACL );
$oCRUD->change_type( 'zoneCntnt', 'select', 'zoneCntnt', $aACL );
$oCRUD->change_type( 'zoneSttst', 'select', 'zoneSttst', $aACL );
$oCRUD->change_type( 'zoneActn', 'select', 'zoneActn', $aACL );
$oCRUD->change_type( 'zoneSttng', 'select', 'zoneSttng', $aACL );

//  Meta Tab.
$oCRUD->fields( 'usrAgent, sessionKey, _editor, _created, _updated, _deleted, _ipAddress', false, $oTrn->word( 'general.meta' ), 'view' );

if( $nID > 0 )
{
	$sContent	= $oCRUD->render( 'view', $nID );
}
else
{
	$sContent	= $oCRUD->render();
}
?>