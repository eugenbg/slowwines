<?php
try
{
	$oCRUD = Xcrud::get_instance();
	$oCRUD->table( TBL_APP_CNTNT_TOUR );
	$oCRUD->order_by( 'ourID' );
	$oCRUD->table_name( 'Tour Editor' );
	$oCRUD->before_insert( 'beforeInsert', 'q23.plugin.php' );
	$oCRUD->before_update( 'beforeUpdate', 'q23.plugin.php' );
	$oCRUD->unset_title( true );
	$oCRUD->language( $sLanguage );
	$oCRUD->limit_list( '10,20,50,all' );
	$oCRUD->limit( 10 );
	$oCRUD->unset_edit();
	$oCRUD->unset_view( true );
	$oCRUD->unset_add( true );
	$oCRUD->unset_numbers( true );
	$oCRUD->duplicate_button( false );
	$oCRUD->button( '/' . $sLanguage . '/adm/tour/edit/{id}/', 'Edit', 'glyphicon glyphicon-edit', 'btn-warning' );

	q23helper::xcrud( $oCRUD, $aUsr[ 'usrZone' ][ 'cntnt' ] );

	//  Field Label Names
	$oCRUD->label
	(
		array
		(
			'imagePrimary'=>'',
			'ourID'=>'Reference',
			'isFeatured'=>'Featured',
			'en_title'=>$oTrn->word( 'content.title' ),
			'_active'=>$oTrn->word( 'general.active' ),
			'_created'=>$oTrn->word( 'general.created' ),
			'_updated'=>$oTrn->word( 'general.updated' ),
			'_deleted'=>$oTrn->word( 'general.deleted' ),
			'_ipAddress'=>$oTrn->word( 'general.ip.address' ),
			'_editor'=>$oTrn->word( 'general.editor' )
		)
	);

	//  View.
	$oCRUD->columns( 'imagePrimary, en_title, ourID, isFeatured, _active, _editor, _updated' );
	$oCRUD->column_width( '_active, isFeatured, imagePrimary', '75px' ); 
	$oCRUD->column_width( 'ourID, _editor', '100px' ); 
	$oCRUD->column_width( '_created, _updated', '150px' ); 
	$oCRUD->column_class( 'isFeatured, _active, _editor, _created, _updated', 'align-center' );
	$oCRUD->change_type( 'isFeatured', 'bool', '', array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
	$oCRUD->change_type( '_active', 'bool', '', array( '0'=>$oTrn->word( 'general.no' ), '1'=>$oTrn->word( 'general.yes' ) ) );
	$oCRUD->change_type( 'imagePrimary', 'remote_image', '' );

	$sContent	= $oCRUD->render();	
}
catch( Exception $e )
{
	q23helper::exceptionHandler( $e );
	return false;	
}
?>
<script src="/inc/vndr/xcrud/plugins/jquery.min.js"></script>
<script>
	$( document ).ready
	(
		function()
		{
			$( ".qres-action" ).on
			(
				"click",
				function()
				{
					window.location.assign( "/en/adm/tour/new/" );
				}
			)
		}
	)
</script>