<?php
//====================================================================================
//	Class:		funkyCurrency
//	Objective:	Get currency exchange rates from Yahoo's currency conversion service.
//	Copyright:	2012 (c) Funky::Software
//				Adam Pierce <adam@doctort.org> 22-Oct-2008.
//	License		http://www.funky-software.net/license/1_0.txt
//	Link		http://dev.zend.com/package/PackageName
//	
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	05-Jul-12	Andrew Makin	ICR.
//====================================================================================
class funkyCurrency extends funkyGeneric
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
		$this->_base			= $this->_aConfiguration[ "ecb" ][ "base" ];
		$this->_convertService	= $this->_aConfiguration[ "ecb" ][ "uri" ];
		$this->_currency			= array();

		$this->_oDB->query( "SELECT code, rate, symbol, rank FROM " . TBL_UTL_CURRENCY . " ORDER BY code" );

		$aResult    = $this->_oDB->result();
		
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
	public function update()
	{
		try
		{
			$this->_oDB->query( "SELECT * FROM " . TBL_UTL_CURRENCY . " WHERE _isActive=1 ORDER BY code" );

			$aResult    = $this->_oDB->result();
			
			foreach( $aResult as $this->_currency )
			{
				$sURL					= str_replace( array( "{BASE}", "{FOREIGN}" ), array( $this->_base, $this->_currency[ "code" ] ), $this->_convertService );
				$vRate					= funkyHelper::remoteResponse( $sURL );
				$this->member			= array();
				$this->member[ "id" ]	= $this->_currency[ "id" ];
				$this->member[ "rate" ]	= $vRate;

				self::write();
				
				funkyHelper::writeLog( LOG_FILE_CRON, " --> " . $this->_currency[ "code" ] . " Updated.", LOG_WRITER_INFORMATION );
			}
			
			return true;
		}
		catch( Exception $e )
		{
			funkyHelper::exceptionHandler( $e );
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
				$sTmp	= number_format( $dAmount, $decimal, ".", "," ); 
			
				if( !$this->_currency[ $destination ][ "rank" ] == 1 )
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