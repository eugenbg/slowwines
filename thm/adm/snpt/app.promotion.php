<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_APP_PROMOTION );
$oCRUD->order_by( '_created, _updated' );
$oCRUD->table_name( 'promotion Editor' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );

funkyHelper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'cntnt' ] );

//  Field Label Names
$oCRUD->label
(
	array
	(
		'name'=>$oTrn->word( 'content.name' ),
		'businessName'=>$oTrn->word( 'content.business.name' ),
		'city'=>$oTrn->word( 'content.city' ),
		'province'=>$oTrn->word( 'content.province' ),
		'country'=>$oTrn->word( 'content.country' ),
		'url'=>$oTrn->word( 'content.url' ),
		'comment'=>$oTrn->word( 'content.comment' ),
		'date'=>$oTrn->word( 'content.date' ),
		'seoTitle_de'=>$oTrn->word( 'content.title' ),
		'seoKeyword_de'=>$oTrn->word( 'content.seo.keyword' ),
		'seoDescription_de'=>$oTrn->word( 'content.seo.description' ),
		'description_de'=>$oTrn->word( 'content.abstract' ),
		'seoTitle_dk'=>$oTrn->word( 'content.title' ),
		'seoKeyword_dk'=>$oTrn->word( 'content.seo.keyword' ),
		'seoDescription_dk'=>$oTrn->word( 'content.seo.description' ),
		'description_dk'=>$oTrn->word( 'content.abstract' ),
		'seoTitle_en'=>$oTrn->word( 'content.title' ),
		'seoKeyword_en'=>$oTrn->word( 'content.seo.keyword' ),
		'seoDescription_en'=>$oTrn->word( 'content.seo.description' ),
		'description_en'=>$oTrn->word( 'content.abstract' ),
		'seoTitle_es'=>$oTrn->word( 'content.title' ),
		'seoKeyword_es'=>$oTrn->word( 'content.seo.keyword' ),
		'seoDescription_es'=>$oTrn->word( 'content.seo.description' ),
		'description_es'=>$oTrn->word( 'content.abstract' ),
		'seoTitle_fr'=>$oTrn->word( 'content.title' ),
		'seoKeyword_fr'=>$oTrn->word( 'content.seo.keyword' ),
		'seoDescription_fr'=>$oTrn->word( 'content.seo.description' ),
		'description_fr'=>$oTrn->word( 'content.abstract' ),
		'seoTitle_nl'=>$oTrn->word( 'content.title' ),
		'seoKeyword_nl'=>$oTrn->word( 'content.seo.keyword' ),
		'seoDescription_nl'=>$oTrn->word( 'content.seo.description' ),
		'description_nl'=>$oTrn->word( 'content.abstract' ),
		'seoTitle_ru'=>$oTrn->word( 'content.title' ),
		'seoKeyword_ru'=>$oTrn->word( 'content.seo.keyword' ),
		'seoDescription_ru'=>$oTrn->word( 'content.seo.description' ),
		'description_ru'=>$oTrn->word( 'content.abstract' ),
		'image'=>$oTrn->word( 'usr.image' ),

		'_isActive'=>$oTrn->word( 'general.active' ),
		'_created'=>$oTrn->word( 'general.created' ),
		'_updated'=>$oTrn->word( 'general.updated' ),
		'_deleted'=>$oTrn->word( 'general.deleted' ),
		'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
		'_editor'=>$oTrn->word( 'general.editor' )
	)
);

//  View.
$oCRUD->columns( 'name, city, comment' );

//  Detail.
$oCRUD->fields( 'name, businessName, city, province, country, url, image, date, _isActive', false, $oTrn->word( 'general.promotion.detail' ) );
$oCRUD->fields( 'image', false, "Image" );
$oCRUD->change_type( 'date', 'date', date( "Y-m-d" ) );
$oCRUD->change_type( '_isActive', 'select', 1, array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->change_type( 'image', 'image', '', array( 'ratio' => 1, 'manual_crop' => true ) );

//  Description.
foreach( $g_aConfiguration[ "language.supported" ] as $sCC=>$sCN )
{
	$oCRUD->fields( 'seoTitle_' . $sCC . ',seoKeyword_' . $sCC . ',seoDescription_' . $sCC . ',description_' . $sCC, false, '<img src="/dt/img/flag/' . $sCC . '.png" />&nbsp;' . $oTrn->word( 'general.language.' . strtolower( $sCC ) ) );
}

//  Meta
$oCRUD->fields( '_editor, _created, _updated, _deleted, _ipAddress', false, $oTrn->word( 'general.meta' ), 'view' );

$sContent	= $oCRUD->render();
