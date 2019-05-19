<?php

class q23weather extends q23base
{
	//--------------------------------------------------------------------------------
	//	Class Members
	//--------------------------------------------------------------------------------
  	const	API_ENDPOINT		= 'https://api.forecast.io/forecast/';

	private	$api_key;
	
	
	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct( $api_key )
	{
		parent::__construct();
		
		$this->api_key = $api_key;
	}
	
	
	//--------------------------------------------------------------------------------
	//	Public Methods
	//--------------------------------------------------------------------------------
	public function getCurrentConditions( $latitude, $longitude, $units = 'auto', $language )
	{
		$data	= $this->_requestData( $latitude, $longitude, $units, $language );

		if( $data !== false )
		{
			return new q23weatherForecastIO( $data->currently );
		}
		else
		{
			return false;
		}
	}
	
	public function getHistoricalConditions( $latitude, $longitude, $units = 'auto', $language, $timestamp )
	{
		$exclusions	= 'currently,minutely,hourly,alerts,flags';
		$data		= $this->_requestData( $latitude, $longitude, $units, $language, $timestamp, $exclusions );
		
		if( $data !== false )
		{
			return new q23weatherForecastIO( $data->daily->data[0] );
		}
		else
		{
			return false;
		}
	}
	
	function getForecastToday( $latitude, $longitude, $units = 'auto', $language )
	{
		$data	= $this->requestData( $latitude, $longitude, $units, $language );

		if( $data !== false )
		{
			$conditions	= array();
			$today		= date( 'Y-m-d' );

			foreach( $data->hourly->data as $raw_data )
			{
				if( date( 'Y-m-d', $raw_data->time ) == $today )
				{
					$conditions[] = new q23weatherForecastIO( $raw_data );
				}
			}

			return $conditions;
		}
		else
		{
			return false;
		}
	}
	
	function getForecastWeek( $latitude, $longitude, $units='auto', $language='en' )
	{
		$data	= $this->_requestData( $latitude, $longitude, $units, $language );

		if( $data !== false )
		{
			$conditions	= array();

			foreach( $data->daily->data as $raw_data )
			{
				$conditions[]	= new q23weatherForecastIO( $raw_data );
			}

			return $conditions;
		}
		else
		{
			return false;
		}
	}
	
	
	//--------------------------------------------------------------------------------
	//	Private Methods
	//--------------------------------------------------------------------------------
	private function _requestData( $latitude, $longitude, $units, $language = 'en', $timestamp = false, $exclusions = false )
	{
		$validUnits = array( 'auto', 'us', 'si', 'ca', 'uk' );

		if( in_array( $units, $validUnits ) )
		{
			$request_url = self::API_ENDPOINT . $this->api_key . '/' . $latitude . ',' . $longitude . '?units=' . $units . '&lang=' . $language . ( $timestamp ? ',' . $timestamp : '' ) . ( $exclusions ? '&exclude=' . $exclusions : '' );

			if( class_exists( 'buffer' ) )
			{
				$cache		= new Buffer();
				$content	= $cache->data( $request_url, 300, FS_FOLDER_DT_BFFR );
			}
			else
			{
				$content	= q23helper::getRemoteResponse( $request_url );
			}
		}
		else
		{
			return false;
		}

		if( !empty( $content ) )
		{
			return json_decode( $content );
		}
		else
		{
			return false;
		}
	}
	
	
	
}
?>