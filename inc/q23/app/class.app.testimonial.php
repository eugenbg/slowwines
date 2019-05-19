<?php
//====================================================================================
//	Class:		class.app.testimonial.php
//	Objective:	
//	Copyright	2012 (c) Funky::Software
//	License		http://www.funky-software.net/license/1_0.txt
//	Link		http://dev.zend.com/package/PackageName
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	30-Oct-14	Andrew Makin	ICR.
//====================================================================================
class q23testimonial extends q23base
{
	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		$this->table	= TBL_APP_TSTMNL;
	}
	
	
	//--------------------------------------------------------------------------------
	//	Public Methods
	//--------------------------------------------------------------------------------
	public function endorsement( $nCount, $sTemplate="full", $bRandom=true )
	{
		try
		{
			$sOutput	= "";
			$nIndex		= 0;
			$sTpl		= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.testimonial." . $sTemplate . ".html" );
			$oSrch		= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
			
			if( $bRandom )
			{
				$sSQL		= "SELECT * FROM " . $this->table . " WHERE _active=1 ORDER BY RAND() LIMIT " . $nCount;
			}
			else
			{
				$sSQL		= "SELECT * FROM " . $this->table . " WHERE _active=1 ORDER BY _created DESC LIMIT " . $nCount;
			}
			
			$this->oDB->query( $sSQL );
			
			$aResult	= $this->oDB->result();
			
			foreach( $aResult as $aRow )
			{
				$aData										= array();
				$aData[ "{variable.active}" ]				= ( $nIndex == 0 ) ? " active" : "";
				$aData[ "{variable.testmonial.title}" ]		= $aRow[ $oSrch->language . "_title" ];
				$aData[ "{variable.testmonial.abstract}" ]	= $aRow[ $oSrch->language . "_abstract" ];
				$aData[ "{variable.testmonial.body}" ]		= $aRow[ $oSrch->language . "_body" ];
				$aData[ "{variable.testmonial.name}" ]		= $aRow[ "name" ];
				$aData[ "{variable.testmonial.city}" ]		= $aRow[ "city" ];
				$aData[ "{variable.testmonial.province}" ]	= $aRow[ "province" ];
				$aData[ "{variable.testmonial.country}" ]	= $aRow[ "country" ];
				$aData[ "{variable.testmonial.image}" ]		= ( strlen( $aRow[ "image" ] ) > 0 ) ? '<img src="/dt/upld/' . $aRow[ "image" ] . '" width=100 align="left">' : '';
				
				$sOutput	.= str_replace( array_keys( $aData ), $aData, $sTpl );
				
				$nIndex++;
			}
			
			return $sOutput;
		}
		catch( Exception $e )
		{
			q23helper::showVariable( $e->getMessage() );
		}
	}
	
	public function view( $sTemplate="full" )
	{
		try
		{
			$sOutput	= "";
			$nIndex		= 0;
			$sTpl		= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.testimonial." . $sTemplate . ".html" );
			$oSrch		= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
			$sSQL		= "SELECT * FROM " . $this->table . " ORDER BY RAND()";
			
			$this->oDB->query( $sSQL );
			
			$aResult	= $this->oDB->result();
			
			foreach( $aResult as $aRow )
			{
				$aData										= array();
				$aData[ "{variable.active}" ]				= ( $nIndex == 0 ) ? " active" : "";
				$aData[ "{variable.testmonial.title}" ]		= $aRow[ $oSrch->language . "_title" ];
				$aData[ "{variable.testmonial.abstract}" ]	= $aRow[ $oSrch->language . "_abstract" ];
				$aData[ "{variable.testmonial.body}" ]		= $aRow[ $oSrch->language . "_body" ];
				$aData[ "{variable.testmonial.name}" ]		= $aRow[ "name" ];
				$aData[ "{variable.testmonial.city}" ]		= $aRow[ "city" ];
				$aData[ "{variable.testmonial.province}" ]	= $aRow[ "province" ];
				$aData[ "{variable.testmonial.country}" ]	= $aRow[ "country" ];
				$aData[ "{variable.testmonial.image}" ]		= ( strlen( $aRow[ "image" ] ) > 0 ) ? '<img src="/dt/upld/' . $aRow[ "image" ] . '" width=100 align="left">' : '';
				
				$sOutput	.= str_replace( array_keys( $aData ), $aData, $sTpl );
				
				$nIndex++;
			}
			
			return $sOutput;
		}
		catch( Exception $e )
		{
			q23helper::showVariable( $e->getMessage() );
		}
	}
}
?>