<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

//  Standard function pre process data prior to an insert or update.
function beforeInsert( $oData, $oXcrud )
{
	$oData->set( '_created', date('Y-m-d H:i:s' ) );
	$oData->set( '_updated', date('Y-m-d H:i:s' ) );
	$oData->set( '_editor', 'admin' );
	$oData->set( '_ipAddress', q23helper::getIpAddress() );
}

//  Standard function pre process data prior to an insert or update.
function beforeUpdate( $aData, $oXcrud )
{
	$aData->set( '_updated', date('Y-m-d H:i:s' ) );
	$aData->set( '_editor', 'admin' );
	$aData->set( '_ipAddress', q23helper::getIpAddress() );

	return $aData;
}


//  Generic pre update functionality.
//function update( $aData, $sPrimary='' )
//{
//	$aData  = updateBefore( $aData, $sPrimary );
//	$aData  = updateSEO( $aData, $sPrimary );
//	$aData  = updateUsr( $aData, $sPrimary );
//
//	return $aData;
//}

//  Update the 'SEO' fields as required.
//function updateSEO( $aData, $sPrimary='' )
//{
//	$sTable             = _getTableName( $aData );
//
//	$oCfg				= new funkyConfiguration();
//	$oCfg->table		= TBL_UTL_CONFIGURATION;
////	todo: standard rso languages
//	$g_aConfiguration	= $oCfg->getAsArray();
//	$g_aConfiguration[ "language.supported" ]   = array( 'de'=>'German', 'dk'=>'Danish', 'en'=>'English', 'es'=>'Español', 'fr'=>'French', 'nl'=>'Dutch', 'ru'=>'Russian' );
//
//	if( isset( $aData[ $sTable . '.stub' ] ) )
//	{
//		$aData[ $sTable . '.stub' ] = str_replace( array( " ", "_", "." ), "_", $aData[ $sTable . '.stub' ] );
//	}
////	todo: standard rso languages
//	foreach( $g_aConfiguration[ "language.supported" ] as $sCC=>$sCN )
//	{
//		if( isset( $aData[ $sTable . '.description_' . $sCC ] ) )
//		{
//			if( !empty( $aData[ $sTable . '.description_' . $sCC ] ) )
//			{
//				$oSEO	= new funkySeo( $aData[ $sTable . '.description_' . $sCC ] );
//
//				if( empty( $aData[ $sTable . '.abstract_' . $sCC ] ) )
//				{
//					$aData[ $sTable . '.abstract_' . $sCC ] = $oSEO->getMetaDescription();
//				}
//
//				if( empty( $aData[ $sTable . '.seoKeyword_' . $sCC ] ) )
//				{
//					$aData[ $sTable . '.seoKeyword_' . $sCC ] = $oSEO->getKeywords();
//				}
//
//				if( empty( $aData[ $sTable . '.seoDescription_' . $sCC ] ) )
//				{
//					$aData[ $sTable . '.seoDescription_' . $sCC ] = $oSEO->getMetaDescription();
//				}
//			}
//		}
//	}
//
//	return $aData;
//}

//	Encrypt the password if available.
//function updateUsr( $aData, $sPrimary='' )
//{
//	$sTable             = _getTableName( $aData );
//
//	if( isset( $aData[ $sTable . '.pwd' ] ) )
//	{
//		$aData[ $sTable . '.pwd' ]	= md5( $aData[ $sTable . '.pwd' ] );
//	}
//
//	return $aData;
//}

//================================================================================
//  Private Methods.
//================================================================================
//  Get the table name from the CRUD data.
function _getTableName( $aData )
{
	reset( $aData );

	$sKey   = key( $aData );
	$aKey   = explode( '.', $sKey );

	return $aKey[0];
}

//	Get value.
function _getValue( $aData, $sName )
{
	$sTable = _getTableName( $aData );

	return ( isset( $aData[ $sTable . '.' . $sName ] ) ) ? $aData[ $sTable . '.' . $sName ] : "ajm";
}

//	Set value.
function _setValue( $aData, $sName, $vValue )
{
	$sTable = _getTableName( $aData );

	$aData[ $sTable . '.' . $sName ]	= $vValue;

	return $aData;
}
?>
