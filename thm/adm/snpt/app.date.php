<?php
$oCRUD = Xcrud::get_instance();
$oCRUD->table( TBL_APP_TOUR_DATE );
$oCRUD->order_by( 'tour, dateStart' );
$oCRUD->table_name( 'Tour Date Editor' );
$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
$oCRUD->unset_title( true );
$oCRUD->language( $sLanguage );
$oCRUD->limit_list( '10,20,50,all' );
$oCRUD->limit( '20' );
$oCRUD->unset_numbers( true );

q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'sttng' ] );

//  Field Label Names
$oCRUD->label
	(
		array
		(
			'ourID'=>"Code",
			'tour'=>"Tour Name",
			'url'=>"URL",
			'class'=>"Colour",
			'dateStart'=>"Start Date",
			'dateEnd'=>"End Date",
			'availability'=>"Quanity",

			'_active'=>$oTrn->word( 'general.active' ),
			'_created'=>$oTrn->word( 'general.created' ),
			'_updated'=>$oTrn->word( 'general.updated' ),
			'_deleted'=>$oTrn->word( 'general.deleted' ),
			'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
			'_editor'=>$oTrn->word( 'general.editor' )
		)
	);

//  View.
$oCRUD->columns( 'tour, dateStart, dateEnd, _active' );
$oCRUD->column_width( 'image', '75px' ); 
$oCRUD->column_width( 'dateStart, dateEnd, _active, _editor', '100px' ); 
$oCRUD->column_width( '_created, _updated', '150px' ); 
$oCRUD->column_class( '_active, _editor, _created, _updated', 'align-center' );

//  Overview Tab.
$oCRUD->fields( 'tour, dateStart, dateEnd, class, _active', false, $oTrn->word( 'general.overview' ) );
$oCRUD->change_type( '_active', 'bool', '', array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
$oCRUD->change_type( 'tour', 'select', 'tour', $aTour );
$oCRUD->change_type( 'class', 'select', 'class', array( "event-important"=>"Color 1", "event-warning"=>"Color 2", "event-info"=>"Color 3", "event-inverse"=>"Color 4", "event-success"=>"Color 5", "event-special"=>"Color 6" ) );


//  Meta
$oCRUD->fields( '_editor, _created, _updated, _deleted, _ipAddress', false, $oTrn->word( 'general.meta' ), 'view' );

$sContent	= $oCRUD->render();
?>
