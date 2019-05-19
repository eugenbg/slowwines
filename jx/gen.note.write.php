<?php
include_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

$sOutput	= '';
$oNttn		= new q23notation();

switch( $_REQUEST[ 'type' ] )
{
	case 'lst':
		$oNttn->member[ 'id' ]		= 0;
		$oNttn->member[ 'rmtID' ]	= $_REQUEST[ 'id' ];
		$oNttn->member[ 'source' ]	= $_REQUEST[ 'type' ];
		$oNttn->member[ 'body' ]	= $_REQUEST[ 'text' ];
		$oNttn->member[ '_editor' ]	= $_REQUEST[ 'usr' ];

		$oNttn->write();
		
		$sOutput	= $oNttn->readNote( $_REQUEST[ 'id' ], $_REQUEST[ 'type' ] );
		
		break;
		
	default:
		$sOutput	= '';
		break;
}

echo $sOutput;
?>