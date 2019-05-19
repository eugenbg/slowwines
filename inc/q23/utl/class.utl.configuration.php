<?php
//====================================================================================
//	Class:		q23configuration
//	Objective:	CRUD for the configuration.
//	Copyright:	2014 (c) Quantum 23
//	License		http://quantum23.com/license/
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	09-Oct-14	Andrew Makin	ICR.
//====================================================================================

class q23configuration extends q23base
{
	public function __construct()
	{
		parent::__construct();
		
		$this->table	= TBL_UTL_CONFIGURATION;
	}
	
	public function language( $aLanguage )
	{
		$aTmp	= array();
		$aLng	= array();
		
		foreach( $aLanguage as $sCode=>$aData )
		{
			if( $aData[ "active" ] == true )
			{
				$aLng[ $sCode ]	= $aData;
			}
			
			if( $aData[ "default" ] == true )
			{
				$sTmp	= $sCode;
			}
		}
		
		$aTmp[ 'language' ][ 'supported' ]	= $aLng;
		$aTmp[ 'language' ][ 'default' ]	= $sTmp;
		
		return $aTmp;
	}
	
	public function buildLanguageSwitch()
	{
		$sOutput	= "";
		
		foreach( $this->cfg[ 'language' ][ 'supported' ] as $sCode=>$aData )
		{
			if( $aData[ "active" ] == true )
			{
				$sOutput	.= '<li><a href="/jx/language/' . $sCode . '/" title="' . $aData[ "name" ] . '"><img title="' . $aData[ "name" ] . '" src="/thm/usr/img/flag/' . $sCode . '.png" class="flag"></a></li>' . PHP_EOL;
			}
		}
		
		q23helper::writeFile( FS_FOLDER_DT_BLCK . "lng.switcher.code", $sOutput );
	}
	
	public function buildListingType()
	{
		$sOutput	= "";
		
		if( $this->cfg[ 'plugin' ][ 'sale' ] == true )
		{
			$sOutput	.= "	<option value='sale'>{translate.search.listing.type.sale}</option>" . PHP_EOL;
		}
		
		if( $this->cfg[ 'plugin' ][ 'long' ] == true )
		{
			$sOutput	.= "	<option value='long'>{translate.search.listing.type.long}</option>" . PHP_EOL;
		}
		
		if( $this->cfg[ 'plugin' ][ 'short' ] == true )
		{
			$sOutput	.= "	<option value='short'>{translate.search.listing.type.short}</option>" . PHP_EOL;
		}
		
		q23helper::writeFile( FS_FOLDER_DT_BLCK . "lst.listing.type.option.code", $sOutput );
	}
	
	public function buildPropertyType()
	{
		$bOptGroup	= false;
		$sOutput	= "";
		$sSQL		= "SELECT * FROM " . TBL_APP_LST_PROPERTY_TYPE . " WHERE _active=1 ORDER BY type, subType";
		
		$this->oDB->query( $sSQL );
		
//		$sOutput	.= "	<option value=''>All</option>" . PHP_EOL;
		
		foreach( $this->oDB->result() as $aRow )
		{
			if( strtolower( $aRow[ "subType" ] ) == 'all' )
			{
				if( $bOptGroup )
				{
					$sOutput	.= "</optgroup>" . PHP_EOL;
				}
				
				$sOutput	.= "<optgroup label=\"{translate." . strtolower( $aRow[ "type" ] ) . "}\">" . PHP_EOL;
				$bOptGroup	 = true;
			}
			else
			{
				$sOutput	.= "	<option value='" . $aRow[ "code" ] . "'>{translate." . strtolower( $aRow[ "type" ] . "." . str_replace( " ", ".", $aRow[ "subType" ] ) ) . "}</option>" . PHP_EOL;
			}
		}
		
		if( $bOptGroup )
		{
			$sOutput	.= "</optgroup>" . PHP_EOL;
		}
		
		q23helper::writeFile( FS_FOLDER_DT_BLCK . "lst.property.type.option.code", $sOutput );
		
		return true;
	}

	public function buildRegion()
	{
		$sOutput	= "";
		$sSQL		= "SELECT region2 as regionName FROM " . TBL_UTL_GEO_LOCATION . " WHERE _active=1 GROUP BY region2 ORDER BY region4 ASC";
		
		$this->oDB->query( $sSQL );
		
		foreach( $this->oDB->result() as $aRow )
		{
			$sOutput	.= "<option value='" . strtolower( q23helper::normalise( $aRow[ "regionName" ] ) ) . "'>" . $aRow[ "regionName" ] . "</option>" . PHP_EOL;
		}
		
		q23helper::writeFile( FS_FOLDER_DT_BLCK . "lst.location.region.option.code", $sOutput );
		
		return true;
	}
		
	public function buildArea()
	{
		$sSQL		= "SELECT region2 as regionName FROM " . TBL_UTL_GEO_LOCATION . " WHERE _active=1 GROUP BY region2 ORDER BY region4 ASC";
		
		$this->oDB->query( $sSQL );
		
		foreach( $this->oDB->result() as $aRegion )
		{
//			$sOutput	= "<option value=''>All</option>" . PHP_EOL;
			$sOutput	= "";
			$sSQL		= "SELECT region4 as areaName FROM " . TBL_UTL_GEO_LOCATION . " WHERE _active=1 AND region2='" . $aRegion[ 'regionName' ] . "'GROUP BY region4 ORDER BY region4 ASC";
			
			$this->oDB->query( $sSQL );
			
			foreach( $this->oDB->result() as $aRow )
			{
				$sOutput	.= "<option value='" . strtolower( q23helper::normalise( $aRow[ "areaName" ] ) ) . "'>" . $aRow[ "areaName" ] . "</option>" . PHP_EOL;
			}
			
			q23helper::writeFile( FS_FOLDER_DT_BLCK . "lst.location.area.option." . str_replace( " ", ".", strtolower( q23helper::normalise( $aRegion[ 'regionName' ] ) ) ). ".code", $sOutput );
		}
		
		return true;
	}
	
	public function buildLocation()
	{
		$sSQL		= "SELECT region4 as areaName FROM " . TBL_UTL_GEO_LOCATION . " WHERE _active=1 GROUP BY region4 ORDER BY region4 ASC";
		
		$this->oDB->query( $sSQL );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $aArea )
		{
//			$sOutput	= "<option value=''>All</option>" . PHP_EOL;
			$sOutput	= "";
			$sSQL		= "SELECT locality as locality FROM " . TBL_UTL_GEO_LOCATION . " WHERE _active=1 AND region4='" . $aArea[ 'areaName' ] . "' ORDER BY locality ASC";
			
			$this->oDB->query( $sSQL );
			
			foreach( $this->oDB->result() as $aLocation )
			{
				$sOutput	.= "<option value='" . strtolower( q23helper::normalise( $aLocation[ "locality" ] ) ) . "'>" . $aLocation[ "locality" ] . "</option>" . PHP_EOL;
			}
			
			q23helper::writeFile( FS_FOLDER_DT_BLCK . "lst.locality.option." . str_replace( " ", ".", strtolower( q23helper::normalise( $aArea[ 'areaName' ] ) ) ) . ".code", $sOutput );
		}
		
		return true;
	}
	
	public function buildLocationStandalone( $sArea )
	{
		$sOutput	= "";
		$sSQL		= "SELECT geoCity FROM " . TBL_APP_LST . " WHERE _activeSale=1 OR _activeRentShort=1 OR _activeRentLong=1 GROUP BY geoCity ORDER BY geoCity ASC";

		$this->oDB->query( $sSQL );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $aRow )
		{
			$sOutput	.= "<option value='" . strtolower( q23helper::normalise( $aRow[ "geoCity" ] ) ) . "'>" . $aRow[ "geoCity" ] . "</option>" . PHP_EOL;
			
			q23helper::writeFile( FS_FOLDER_DT_BLCK . "lst.locality.option." . str_replace( " ", ".", strtolower( q23helper::normalise( $sArea ) ) ) . ".code", $sOutput );
		}
		
		return true;
	}
	
	public function buildListingMetaData()
	{
		//	Truncate existing data.
		$this->oDB->query( "TRUNCATE table `" . TBL_APP_LST_META . "`" );

		//	Insert new locatin list.
		$sSQL	= "INSERT INTO qres_app_lst_meta
					(
						locality,
						latitude,
						longitude,
						sale,
						`long`,
						`short`,
						_active,
						_editor
					)
					SELECT	lst.geoCity AS locality,
								loc.latitude AS latitude,
								loc.longitude AS longitude,
								( SELECT count(id) FROM qres_app_lst_listing WHERE _activeSale=1 AND geoCity=lst.geoCity ) AS sale,
								( SELECT count(id) FROM qres_app_lst_listing WHERE _activeRentShort=1 AND geoCity=lst.geoCity ) AS shortTerm,
								( SELECT count(id) FROM qres_app_lst_listing WHERE _activeRentLong=1 AND geoCity=lst.geoCity ) AS longTerm,
								0 AS _active,
								'cron'
						FROM qres_app_lst_listing AS lst
							JOIN qres_utl_geo_location AS loc ON lst.geoCity=loc.locality
						WHERE lst._activeSale=1 OR lst._activeRentLong=1 OR lst._activeRentShort=1
						GROUP BY lst.geoCity
							";
							
		$this->oDB->query( $sSQL );
		
		//	Get a list of locations
		$sTPL	= "UPDATE qres_app_lst_meta
					SET	{type}					= ( SELECT COUNT(id) FROM qres_app_lst_listing WHERE listingType='{code}' AND geoCity='{city}' ),
							{type}SalePriceMin	= ( SELECT MIN(priceResaleCurrent) FROM qres_app_lst_listing WHERE _activeSale=1 AND listingType='{code}' AND geoCity='{city}' AND priceResaleCurrent>0 ),
							{type}SalePriceMax	= ( SELECT MAX(priceResaleCurrent) FROM qres_app_lst_listing WHERE _activeSale=1 AND listingType='{code}' AND geoCity='{city}' AND priceResaleCurrent>0 ),
							{type}SalePriceAvg	= ( SELECT floor( avg(priceResaleCurrent) ) FROM qres_app_lst_listing WHERE _activeSale=1 AND listingType='{code}' AND geoCity='{city}' AND priceResaleCurrent>0 ),
							{type}ShortPriceMin	= ( SELECT MIN(priceRentalShortTermLow) FROM qres_app_lst_listing WHERE _activeRentShort=1 AND listingType='{code}' AND geoCity='{city}' AND priceRentalShortTermLow>0 ),
							{type}ShortPriceMax	= ( SELECT MAX(priceRentalShortTermLow) FROM qres_app_lst_listing WHERE _activeRentShort=1 AND listingType='{code}' AND geoCity='{city}' AND priceRentalShortTermLow>0 ),
							{type}ShortPriceAvg	= ( SELECT floor( avg(priceRentalShortTermLow) ) FROM qres_app_lst_listing WHERE _activeRentShort=1 AND listingType='{code}' AND geoCity='{city}' AND priceRentalShortTermLow>0 ),
							{type}LongPriceMin	= ( SELECT MIN(priceRentalLongTerm) FROM qres_app_lst_listing WHERE _activeRentLong=1 AND listingType='{code}' AND geoCity='{city}' AND priceRentalLongTerm>0 ),
							{type}LongPriceMax	= ( SELECT MAX(priceRentalLongTerm) FROM qres_app_lst_listing WHERE _activeRentLong=1 AND listingType='{code}' AND geoCity='{city}' AND priceRentalLongTerm>0 ),
							{type}LongPriceAvg	= ( SELECT floor( avg(priceRentalLongTerm) ) FROM qres_app_lst_listing WHERE _activeRentLong=1 AND listingType='{code}' AND geoCity='{city}' AND priceRentalLongTerm>0 ),
							_active				= 1
					WHERE locality = '{city}'";
		
		$this->oDB->query( "SELECT locality FROM " . TBL_APP_LST_META . "" );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $aRow )
		{
			foreach( $this->cfg[ "propertyCategory" ] as $sKey=>$sValue )
			{
				$aData	= array( "{city}"=>$aRow[ "locality" ], "{type}"=>$sKey, "{code}"=>$sValue );
				$sSQL	= str_replace( array_keys( $aData ), $aData, $sTPL );
				
				$this->oDB->query( $sSQL );
			}
		}
	}
	
	public function buildGoogleMapData()
	{
		$nIndex		= 2;
		$sOutput	= "[ 'Airport', 36.668983, -4.482317, 'Málaga Airport', 1 ]," . PHP_EOL;
		$sSQL		= "SELECT	locality, latitude, longitude, sale, 'long', short FROM " . TBL_APP_LST_META . "";

		$this->oDB->query( $sSQL );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $aRow )
		{
			$sTmp	= "<h1>" . $aRow[ "locality" ] . "</h1><br/>";
			
			if( $aRow[ "sale" ] > 0 )
			{
				$sTmp	.= "<a href='/{variable.language}/search/type-sale/" . strtolower( $aRow[ "locality" ] ) . "'>{translate.search.listing.type.sale} (" . $aRow[ "sale" ] . ")</a><br/>";
			}
			
			if( $aRow[ "short" ] > 0 )
			{
				$sTmp	.= "<a href='/{variable.language}/search/type-short/" . strtolower( $aRow[ "locality" ] ) . "/'>{translate.search.listing.type.short} (" . $aRow[ "short" ] . ")</a><br/>";
			}
			
			if( $aRow[ "long" ] > 0 )
			{
				$sTmp	.= "<a href='/{variable.language}/search/type-long/" . strtolower( $aRow[ "locality" ] ) . "/'>{translate.search.listing.type.long} (" . $aRow[ "long" ] . ")</a><br/>";
			}
			
			$sOutput	.= "[ '" . $aRow[ "locality" ] . "', " . $aRow[ "latitude" ] . ", " . $aRow[ "longitude" ] . ", \"" . $sTmp . "\", " . $nIndex . " ]," . PHP_EOL;
			
			$nIndex++;
		}

		$sOutput	= "var aLocation	= [" . $sOutput . "]";

		q23helper::writeFile( FS_FOLDER_DT_CSV . "location.js", $sOutput );
	}
	
	public function updateLocationTable()
	{
		$aFeedLocation	= array( TBL_UTL_GEO_LOCATION_IC, TBL_UTL_GEO_LOCATION_KYERO, TBL_UTL_GEO_LOCATION_RSO );
		$sSQL			= "TRUNCATE TABLE `" . TBL_UTL_GEO_LOCATION . "`";
			
		$this->oDB->query( $sSQL );
		
		foreach( $aFeedLocation as $sTable )
		{
			$sSQL	= "SELECT * FROM " . $sTable . " WHERE _active=1 AND locationID != 'xxx' ORDER BY region4";
			
			$this->oDB->query( $sSQL );
			
			foreach( $this->oDB->result() as $aRow )
			{
				$this->table			= TBL_UTL_GEO_LOCATION;
				$this->member			= $aRow;
				$this->member[ "id" ]	= 0;
				
				unset( $this->member[ 'suburb' ] );
				unset( $this->member[ 'street' ] );
				unset( $this->member[ 'range' ] );
				unset( $this->member[ 'elevation' ] );
				unset( $this->member[ 'iso2' ] );
				unset( $this->member[ 'fips' ] );
				unset( $this->member[ 'nuts' ] );
				unset( $this->member[ 'hasc' ] );
				unset( $this->member[ 'stat' ] );
				unset( $this->member[ 'timezone' ] );
				unset( $this->member[ 'utc' ] );
				unset( $this->member[ 'dst' ] );
				unset( $this->member[ 'synonym' ] );
				unset( $this->member[ '_active' ] );
				unset( $this->member[ '_created' ] );
				unset( $this->member[ '_updated' ] );
				unset( $this->member[ '_deleted' ] );
				unset( $this->member[ '_editor' ] );
				unset( $this->member[ '_ipAddress' ] );
				unset( $this->member[ '_tmp' ] );
				
				self::write();
			}
		}
	}
	
	public function health()
	{
		$sSQL	= "SELECT COUNT(id) as num FROM " . $this->table . " WHERE collection='update' AND _active=1";
		
		$this->oDB->query( $sSQL );
		
		$aRow	= $this->oDB->row();
		
		$nTotal	= $aRow[ "num" ];

		$sSQL	= "SELECT COUNT(id) as num FROM " . $this->table . " WHERE collection='update' AND _active=1 AND STR_TO_DATE( value, '%Y-%m-%d %H:%i:%s' ) >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";
		
		$this->oDB->query( $sSQL );
		
		$aRow	= $this->oDB->row();
		
		$nGood	= $aRow[ "num" ];
		
		return (integer)( ( $nGood / $nTotal ) * 100 );
	}
	
	public function update( $sKey, $vValue )
	{
		if( strlen( $vValue ) == 0 )
		{
			$vValue	= date( "Y-m-d H:i:s" );
		}
		elseif( is_array( $vValue ) )
		{
			$vValue	= serialize( $vValue );
		}
		
		$sSQL	= "UPDATE " . $this->table . " SET value='" . $vValue . "' WHERE name='" . $sKey . "'";
		
		$this->oDB->query( $sSQL );
	}
	
	public function read( $sKey )
	{
		$sSQL	= "SELECT name, value FROM " . $this->table . " WHERE name='" . $sKey . "' LIMIT 1";

		$this->oDB->query( $sSQL );
		
		$aTmp	= $this->oDB->row();

		return $aTmp[ "value" ];
	}
	
	//	Get the data as an associative data.
	public function associative()
	{
		$sSQL		= "SELECT collection, name, value FROM " . $this->table . " WHERE _active=1 ORDER BY collection, name";
		
		$this->oDB->query( $sSQL );
		
		$aResult	= $this->oDB->result();

		foreach( $aResult as $sKey => $vValue )
		{
			$aTmp[ $vValue[ "collection" ] ][ $vValue[ "name" ] ]	= $vValue[ "value" ];
		}
		
		return $aTmp;
	}
}
?>