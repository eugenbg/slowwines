<?php
//====================================================================================
//	Class:		q23currency
//	Objective:	Get currency exchange rates from European Central Bank's currency 
//				conversion service.
//	Copyright:	2014 (c) Quantum 23
//	License		http://quantum23.com/license/
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	09-Oct-14	Andrew Makin	ICR.
//====================================================================================
class q23currency extends q23base
{
	//--------------------------------------------------------------------------------
	//	Class Members.
	//--------------------------------------------------------------------------------
	private		$_base						= '';
	private		$_convertService			= '';
	private		$_currency					= array();
	

	//--------------------------------------------------------------------------------
	//	Magic Methods.
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();

		$this->table			= TBL_UTL_CURRENCY;
		$this->_base			= $this->cfg[ "currency" ][ "base" ];
		$this->_convertService	= $this->cfg[ "currency" ][ "uri" ];
		$this->_currency		= array();

		$this->oDB->query( "SELECT code, rate, symbol, rank FROM " . $this->table . " ORDER BY code" );

		$aResult    = $this->oDB->result();
		
		foreach( $aResult as $aRow )
		{
			$this->_currency[ $aRow[ "code" ] ][ "rate" ]	= $aRow[ "rate" ];
			$this->_currency[ $aRow[ "code" ] ][ "symbol" ]	= $aRow[ "symbol" ];
			$this->_currency[ $aRow[ "code" ] ][ "rank" ]	= $aRow[ "rank" ];
		}
	}

	//--------------------------------------------------------------------------------
	//	Public Methods.
	//--------------------------------------------------------------------------------
	//-----
	//	Update the currency table.
	//-----
	public function run()
	{
		try
		{
			$sXML	= q23helper::remoteResponse( (string)$this->cfg[ "currency" ][ "uri" ] );
			$oXML	= simplexml_load_string( $sXML[ "text" ] );
			
			foreach( $oXML->Cube->Cube->Cube as $aData )
			{
				$sSQL			= "SELECT id FROM " . $this->table . " WHERE code='" . $aData[ "currency" ] . "' LIMIT 1";
				
				$this->oDB->query( $sSQL );
				
				$aRow			= $this->oDB->row();
				$this->member	= array();
				
				if( isset( $aRow[ "id" ] ) )
				{
					$this->member[ "id" ]	= $aRow[ "id" ];
					$this->member[ "rate" ]	= $aData[ "rate" ];
				}
				else
				{
					$this->member[ "id" ]	= 0;
					$this->member[ "code" ]	= $aData[ "currency" ];
					$this->member[ "rate" ]	= $aData[ "rate" ];
				}
				
				self::write();
			}
			
			return true;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;	
		}
	}
	
	//-----
	//	Convert from one currency to another.
	//-----
	public function convert( $source, $destination, $amount, $format=false, $decimal=0 )
	{
		if( array_key_exists( $source, $this->_currency ) && array_key_exists( $destination, $this->_currency ) )
		{
			$dAmount	= $amount / (float)$this->_currency[ $source ][ "rate" ];
			$dAmount	= (float)$this->_currency[ $destination ][ "rate" ] * $dAmount;

			if( $format )
			{
				if( isset( $this->cfg[ "currency" ][ $destination ] ) )
				{
					$aFormat	= explode( "|", $this->cfg[ "currency" ][ $destination ] );
				}
				
				$sTmp	= number_format( $dAmount, (integer)$aFormat[2], $aFormat[1], $aFormat[0] ); 
				
				if( $aFormat[3] == 'before' )
				{
					$sTmp	= $this->_currency[ $destination ][ "symbol" ] . $sTmp;
				}
				else
				{
					$sTmp	= $sTmp . $this->_currency[ $destination ][ "symbol" ];
				}
				
				return $sTmp;
			}
			else
			{
				return $dAmount;
			}
		}
		else
		{
			return "Error";
		}
	}
}
?>