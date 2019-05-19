<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_APP_CNTNT );
$oCRUD->order_by( '_created, _updated' );
$oCRUD->table_name( 'Content Editor' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );

q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'cntnt' ] );

//  Field Label Names
$oCRUD->label
(
	array
	(
		'title'=>$oTrn->word( 'content.title' ),
		'stub'=>$oTrn->word( 'content.stub' ),
		'template'=>$oTrn->word( 'content.template' ),
		'de_title'=>$oTrn->word( 'content.seo.title' ),
		'de_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'de_abstract'=>$oTrn->word( 'content.abstract' ),
		'de_body'=>$oTrn->word( 'content.description' ),
		'dk_title'=>$oTrn->word( 'content.seo.title' ),
		'dk_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'dk_abstract'=>$oTrn->word( 'content.abstract' ),
		'dk_body'=>$oTrn->word( 'content.description' ),
		'en_title'=>$oTrn->word( 'content.seo.title' ),
		'en_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'en_abstract'=>$oTrn->word( 'content.abstract' ),
		'en_body'=>$oTrn->word( 'content.description' ),
		'es_title'=>$oTrn->word( 'content.seo.title' ),
		'es_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'es_abstract'=>$oTrn->word( 'content.abstract' ),
		'es_body'=>$oTrn->word( 'content.description' ),
		'fr_title'=>$oTrn->word( 'content.seo.title' ),
		'fr_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'fr_abstract'=>$oTrn->word( 'content.abstract' ),
		'fr_body'=>$oTrn->word( 'content.description' ),
		'nl_title'=>$oTrn->word( 'content.seo.title' ),
		'nl_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'nl_abstract'=>$oTrn->word( 'content.abstract' ),
		'nl_body'=>$oTrn->word( 'content.description' ),
		'no_title'=>$oTrn->word( 'content.seo.title' ),
		'no_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'no_abstract'=>$oTrn->word( 'content.abstract' ),
		'no_body'=>$oTrn->word( 'content.description' ),
		'pl_title'=>$oTrn->word( 'content.seo.title' ),
		'pl_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'pl_abstract'=>$oTrn->word( 'content.abstract' ),
		'pl_body'=>$oTrn->word( 'content.description' ),
		'ru_title'=>$oTrn->word( 'content.seo.title' ),
		'ru_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'ru_abstract'=>$oTrn->word( 'content.abstract' ),
		'ru_body'=>$oTrn->word( 'content.description' ),
		'sv_title'=>$oTrn->word( 'content.seo.title' ),
		'sv_keyword'=>$oTrn->word( 'content.seo.keyword' ),
		'sv_abstract'=>$oTrn->word( 'content.abstract' ),
		'sv_body'=>$oTrn->word( 'content.description' ),
		'image'=>$oTrn->word( 'usr.image' ),

		'_active'=>$oTrn->word( 'general.active' ),
		'_created'=>$oTrn->word( 'general.created' ),
		'_updated'=>$oTrn->word( 'general.updated' ),
		'_deleted'=>$oTrn->word( 'general.deleted' ),
		'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
		'_editor'=>$oTrn->word( 'general.editor' )
	)
);

//  View.
$oCRUD->columns( 'title, stub, template, _active, _editor, _updated' );

//  Overview Tab.
$oCRUD->fields( 'title, stub, image, template, _active', false, $oTrn->word( 'general.overview' ) );
$oCRUD->change_type( '_active', 'bool', '', array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->change_type( 'image', 'image', '', array( 'manual_crop' => true ) );
$oCRUD->change_type( 'template', 'select', '', array( 'full'=>'Full Width', 'right'=>'Right Sidebar', 'index'=>'Index' ) );
	
//  Description.
$oCRUD->fields( $g_aCfg[ 'language' ][ 'default' ] . "_title," . $g_aCfg[ 'language' ][ 'default' ] . "_keyword," . $g_aCfg[ 'language' ][ 'default' ] . "_abstract," . $g_aCfg[ 'language' ][ 'default' ] . "_body", false, '<img src="/thm/usr/img/flag/' . $g_aCfg[ 'language' ][ 'default' ] . '.png" />&nbsp;' . $oTrn->word( 'language.' . strtolower( $g_aCfg[ 'language' ][ 'default' ] ) ) );

foreach( $g_aCfg[ 'language' ][ 'supported' ] as $sCC=>$sCN )
{
	if( $sCC != $g_aCfg[ 'language' ][ 'supported' ] )
	{
		$oCRUD->fields( $sCC . "_title," . $sCC . "_keyword," . $sCC . "_abstract," . $sCC . "_body", false, '<img src="/thm/usr/img/flag/' . $sCC . '.png" />&nbsp;' . $oTrn->word( 'language.' . strtolower( $sCC ) ) );
	}
}

//  Meta
$oCRUD->fields( '_editor, _created, _updated, _deleted, _ipAddress', false, $oTrn->word( 'general.meta' ), 'view' );

$sContent	= $oCRUD->render();
?>
