<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

$sUpload	= $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'dt' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $_REQUEST[ 'frm' ];
$sFolder	= $_REQUEST[ 'id' ];
$sTarget	=  $sUpload . DIRECTORY_SEPARATOR . $sFolder;

if( file_exists( $sTarget ) )
{
	$result	= array();
	$aFile	= scandir( $sTarget );

	if( false !== $aFile )
	{
		foreach( $aFile as $sFile ) 
		{
			if( '.' != $sFile && '..' != $sFile )
			{
				$obj[ 'name' ]	= $sFile;
				$obj[ 'file' ]	= "";
				$obj[ 'size' ]	= filesize( $sTarget . DIRECTORY_SEPARATOR . $sFile );
				$aResult[]		= $obj;
				$aTmp[ $sFile ]	= $obj;
			}
		}
	}
//q23helper::showVariable($aTmp);
	switch( $_REQUEST[ 'frm' ] )
	{
		case "rgn":
			$oObj	= new q23swRegion();
			break;
			
		case "tr":
			$oObj	= new q23swTour();
			break;
	}

	$oObj->read( (integer)$_REQUEST[ 'id' ] );
	
	$aData		= $oObj->member;
	$aSequence	= explode( '::', $aData[ 'image' ] );
	$aReturn	= array();

	foreach( $aSequence as $sFile )
	{
		if( strpos( $sFile, 'http' ) === FALSE )
		{
			$aReturn[]		= $aTmp[ $sFile ];
		}
		else
		{
			$a				= array();
			$a[ 'name' ]	= $sFile;
			$a[ 'file' ]	= $sFile;
			$a[ 'size' ]	= 0;
			
			$aReturn[]		= $a;
		}
		
	}
}
else
{
	$aReturn	= array();
}

header( 'Content-type: text/json' );              //3
header( 'Content-type: application/json' );

echo json_encode( $aReturn );	
?>