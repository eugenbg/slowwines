<?php

class q23swGuide extends q23base
{
	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		$this->table	= TBL_APP_CNTNT_GUIDE;
		$this->srch		= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
	}
	
	public function getAllGuide()
	{
		try
		{
			$this->oDB->query( "SELECT * FROM " . $this->table . " WHERE _active=1" );
			
			$aResult	= $this->oDB->result();
			
			foreach( $aResult as $nID=>$aData )
			{
//				$aTmp[ $aData[ "id" ] ]	= $aData[ "title" ];
				$aTmp[ "/en/show/guide/" . str_replace( " ", "-", strtolower( $aData[ "title" ] ) ) . "-" . $aData[ "id" ] . "/" ]	= $aData[ "title" ];
			}
			
			return $aTmp;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function getGuide( $nID )
	{
		try
		{
			if( $nID > 0 )
			{
				$this->oDB->query( "SELECT * FROM " . $this->table . " WHERE id=" . $nID . " LIMIT 1" );
				
				$this->member	= $this->oDB->row();
			}
			else
			{
				$this->member				= array();
				$this->member[ "image" ]	= "";
				$this->member[ "en_title" ]	= "";
				$this->member[ "en_body" ]	= "";
			}
			
			return true;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function seo()
	{
		$aSEO						= array();
		$aSEO[ "title" ]			= $this->member[ $this->srch->language . "_title" ];
		$aSEO[ "description" ]		= $this->member[ $this->srch->language . "_abstract" ];
		$aSEO[ "keyword" ]			= $this->member[ $this->srch->language . "_keyword" ];
		$aSEO[ "url" ]				= "";
		$aSEO[ "image" ]			= $this->member[ "image" ];
		$aSEO[ "locale" ]			= $this->srch->language;
		$aSEO[ "locale.alternate" ]	= "";
		$aSEO[ "type" ]				= "";
		$aSEO[ "published" ]		= $this->member[ "_created" ];;
		$aSEO[ "modified" ]			= $this->member[ "_updated" ];
		$aSEO[ "link.alternate" ]	= "";
		
		return $aSEO;
	}
	
	public function show( $nID )
	{
		try
		{
			if( $nID > 0 )
			{
				self::read( $nID );
				
				$sTpl							= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.guide.body.html" );
				$aData							= array();
				$aData[ "{variable.id}" ]		= $this->member[ "id" ];
				$aData[ "{variable.image}" ]	= "/dt/upld/" . $this->member[ "image" ];
				$aData[ "{variable.title}" ]	= $this->member[ $this->srch->language . "_title" ];
				$aData[ "{variable.keyword}" ]	= $this->member[ $this->srch->language . "_keyword" ];
				$aData[ "{variable.abstract}" ]	= $this->member[ $this->srch->language . "_abstract" ];
				$aData[ "{variable.body}" ]		= $this->member[ $this->srch->language . "_body" ];
				
				return str_replace( array_keys( $aData ), $aData, $sTpl );
			}
			else
			{
				throw new Exception( "Unknown Guide." );
			}
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
}
?>