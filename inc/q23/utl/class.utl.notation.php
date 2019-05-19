<?php
//====================================================================================
//	Class:		funkyNotation
//	Objective:	
//	Copyright	2012 (c) Funky::Software
//	License		http://www.funky-software.net/license/1_0.txt
//	Link		http://dev.zend.com/package/PackageName
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	05-jul-10	Andrew Makin	ICR.
//====================================================================================
class q23notation extends q23base
{
	//--------------------------------------------------------------------------------
	//	Class Members.
	//--------------------------------------------------------------------------------
	private	$_sKey					= 'lst';
	
	//--------------------------------------------------------------------------------
	//	Constructor/Destructor.
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		global	$g_oSearch;
		
		$this->about	= array( "version"=>"1.0.2", "date"=>"20-jul-2012", "name"=>get_class( $this ) );
		$this->table	= TBL_APP_NOTATION;
		$this->_oSearch	= $g_oSearch;
	}
	
	public function __destruct()
	{
		parent::__destruct();
	}
	
	//--------------------------------------------------------------------------------
	//	Public Properties.
	//--------------------------------------------------------------------------------
	public function write()
	{
		return parent::write();
	}
	
	public function read( $nRmtID )
	{
		
	}
	
	public function readNote( $nRmtID, $sType )
	{
		$oUsr		= new q23user();
		$sTpl		= '<img width="40px" alt="" class="circle-img" src="/dt/upld/{image}">&nbsp;<strong>{name}</strong> {created}<br />{comment}<hr />';
		$sOutput	= '';
		
		$this->oDB->query( "SELECT * FROM " . $this->table . " WHERE rmtID=" . $nRmtID . " AND source='" . $sType . "' ORDER BY _updated DESC" );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $aData )
		{
			$aUsr		 = $oUsr->getData( $aData[ '_editor' ] );
						
			$sDate		 = date( 'D, d M Y @ H:i', strtotime( $aData[ '_updated' ] ) );
			$sUsr		 = $aUsr[ 'nameFirst' ] . ' ' . $aUsr[ 'nameLast' ];
			$sImg		 = $aUsr[ 'image' ];
			$sBody		 = str_replace( PHP_EOL, "<br />", $aData[ 'body' ] );
			
			$sOutput	.= str_replace( '{created}',	$sDate,	$sTpl );
			$sOutput	 = str_replace( '{image}',		$sImg,	$sOutput );
			$sOutput	 = str_replace( '{name}',		$sUsr,	$sOutput );
			$sOutput	 = str_replace( '{comment}',	$sBody,	$sOutput );
		}
		
		return $sOutput;
	}
	
}