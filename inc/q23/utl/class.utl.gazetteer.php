<?php
//====================================================================================
//	Class:		q23gazetteer
//	Objective:	
//	Copyright	2012 (c) Funky::Software
//	License		http://www.funky-software.net/license/1_0.txt
//	Link		http://dev.zend.com/package/PackageName
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	29-Jul-12	Andrew Makin	ICR.
//====================================================================================
class q23gazetteer extends q23base
{
	//--------------------------------------------------------------------------------
	//	Constructor/Destructor.
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		$this->about	= array( "version"=>"1.2.0", "date"=>"29-jul-2012", "name"=>get_class( $this ) );
	}
	
	
	//--------------------------------------------------------------------------------
	//	Public Properties.
	//--------------------------------------------------------------------------------
	//	Get a country code/name from IP address.
	public function countryByIP( $sIpAddress="" )
	{
		if( strlen( $sIpAddress ) == 0 )
		{
			$sIpAddress	= funkyHelper::getIpAddress();
		}
		
		$sSQL	= "SELECT countryCode AS code, countryName AS name FROM " . TBL_UTL_GEO_IP . " WHERE INET_ATON( '" . $sIpAddress . "' ) >= numStart AND INET_ATON( '" . $sIpAddress . "' ) <= numEnd";

		$this->oDB->query( $sSQL );

		$aData	= $this->oDB->row();

		return array( "code"=>$aData[ "code" ], "name"=>$aData[ "name" ] );
	}
	
	public function getCountry( $vList='' )
	{
		try
		{
			$aOutput	= array();
			
			if( is_array( $vList ) )
			{
				$sTmp	= implode( '', $vList );
				$aList	= $vList;
			}
			else
			{
				$sTmp	= $vList;
				$aList	= explode( ',', $vList );
			}
			
			if( strlen( $sTmp ) > 0 )
			{
				$sList		= strtolower( "'" . implode( ',', $aList ) . "'" );
				$sSQL		= "SELECT country FROM " . TBL_UTL_GEO_POSTCODE_ES . " WHERE LOWER( country ) IN (" . $sList . ") AND county != '' GROUP BY country ORDER BY country ASC";
			}
			else
			{
				$sSQL		= "SELECT country FROM " . TBL_UTL_GEO_POSTCODE_ES . " WHERE county != '' GROUP BY country ORDER BY country ASC";
			}

			$this->oDB->query( $sSQL );

			foreach( $this->oDB->result() as $aData )
			{
				$aOutput[ strtolower( $aData[ 'country' ] ) ]	= "{reword.general.country." . strtolower( $aData[ 'country' ] ) . "}";
			}

			return $aOutput;
		}
		catch( Exception $e )
		{
			funkyHelper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function getState( $sCountry='' )
	{
		try
		{
			$aOutput	= array();
			
			if( strlen( $sCountry ) > 0 )
			{
				$sSQL	= "SELECT region2 FROM " . TBL_UTL_GEO_POSTCODE_ES . " WHERE LOWER( countryName ) = '" . $sCountry . "' AND region2 != '' GROUP BY region2 ORDER BY region2 ASC";
			}
			else
			{
				$sSQL	= "SELECT region2 FROM " . TBL_UTL_GEO_POSTCODE_ES . " WHERE region2 != '' GROUP BY region2 ORDER BY region2 ASC";
			}
			
			$this->oDB->query( $sSQL );

			foreach( $this->oDB->result() as $aData )
			{
				$aOutput[ strtolower( $aData[ 'region2' ] ) ]	= $aData[ 'region2' ];
			}

			return $aOutput;
		}
		catch( Exception $e )
		{
			funkyHelper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function getProvince( $sCountry='', $sState='' )
	{
		try
		{
			$aOutput	= array();
			
			if( strlen( $sCountry ) > 0 && strlen( $sState ) > 0  )
			{
				$sSQL		= "SELECT region3 FROM " . TBL_UTL_GEO_POSTCODE_ES . " WHERE LOWER( countryName ) IN ( '" . $sCountry . "' ) AND LOWER( region2 ) IN ( '" . $sState . "' ) GROUP BY region3 ORDER BY region3 ASC";
			}
			else
			{
				$sSQL		= "SELECT region3 FROM " . TBL_UTL_GEO_POSTCODE_ES . " GROUP BY region1 ORDER BY region1 ASC";
			}

			$this->oDB->query( $sSQL );

			foreach( $this->oDB->result() as $aData )
			{
				$aOutput[ strtolower( $aData[ 'region3' ] ) ]	= $aData[ 'region3' ];
			}
		
			return $aOutput;
		}
		catch( Exception $e )
		{
			funkyHelper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function getTown( $sCountry='', $sState='', $sProvince='' )
	{
		try
		{
			$aOutput	= array();
			
			if( strlen( $sCountry ) > 0 && strlen( $sState ) > 0 && strlen( $sProvince ) > 0  )
			{
				$sSQL		= "SELECT locality FROM " . TBL_UTL_GEO_POSTCODE_ES . " WHERE LOWER( countryName ) = '" . $sCountry . "' AND LOWER( region2 ) = '" . $sState . "'  AND LOWER( region3 ) = '" . $sProvince . "' AND region3 != '' GROUP BY locality ORDER BY locality ASC";
			}
			else
			{
				$sSQL		= "SELECT locality FROM " . TBL_UTL_GEO_POSTCODE_ES . " GROUP BY locality ORDER BY locality ASC";
			}
			
			$this->oDB->query( $sSQL );

			foreach( $this->oDB->result() as $aData )
			{
				$aOutput[ $aData[ 'locality' ] ]	= $aData[ 'locality' ];
			}
		
			return $aOutput;
		}
		catch( Exception $e )
		{
			funkyHelper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function getProvinceFromTown( $sState='', $sTown='' )
	{
		try
		{
			$sSQL	= "SELECT region3 FROM " . TBL_UTL_GEO_POSTCODE_ES . " WHERE region2='" . $sState . "' AND locality='" . $sTown . "' LIMIT 1";
			
			$this->oDB->query( $sSQL );
			
			$aRow	= $this->oDB->row();

			return $aRow[ "region3" ];
		}
		catch( Exception $e )
		{
			funkyHelper::exceptionHandler( $e );
			return false;
		}
	}
}
?>