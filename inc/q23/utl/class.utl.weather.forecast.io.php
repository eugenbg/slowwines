<?php
class q23weatherForecastIO
{
	//	Class Members
	private $raw_data;

	//	Magic Methods
	public function __construct( $raw_data )
	{
		$this->raw_data	= $raw_data;
	}

	//	Public Methods
	public function getTemperature()
	{
		return ( isset( $this->raw_data->temperature ) ) ? $this->raw_data->temperature : 0;
	}

	public function getMinTemperature()
	{
		return $this->raw_data->temperatureMin;
	}

	public function getMaxTemperature()
	{
		return $this->raw_data->temperatureMax;
	}

	public function getApparentTemperature()
	{
		return $this->raw_data->apparentTemperature;
	}

	public function getSummary()
	{
		return $this->raw_data->summary;
	}

	public function getIcon()
	{
		return $this->raw_data->icon;
	}

	public function getTime( $format = null )
	{
		if( !isset( $format ) )
		{
			return $this->raw_data->time;
		}
		else
		{
			return date( $format, $this->raw_data->time );
		}
	}

	public function getPressure()
	{
		return $this->raw_data->pressure;
	}

	public function getDewPoint()
	{
		return $this->raw_data->dewPoint;
	}

	public function getHumidity()
	{
		return $this->raw_data->humidity;
	}

	public function getWindSpeed()
	{
		return $this->raw_data->windSpeed;
	}

	public function getWindBearing()
	{
		return $this->raw_data->windBearing;
	}

	public function getPrecipitationType()
	{
		return ( isset( $this->raw_data->precipType ) ) ? $this->raw_data->precipType : "";
	}

	public function getPrecipitationProbability()
	{
		return $this->raw_data->precipProbability;
	}

	public function getCloudCover()
	{
		return $this->raw_data->cloudCover;
	}

	public function getSunrise( $format=null )
	{
		if( !isset( $format ) )
		{
			return $this->raw_data->sunriseTime;
		}
		else
		{
			return date( $format, $this->raw_data->sunriseTime );
		}
	}

	public function getSunset( $format=null )
	{
		if( !isset( $format ) )
		{
			return $this->raw_data->sunsetTime;
		}
		else
		{
			return date( $format, $this->raw_data->sunsetTime );
		}
	}
}
?>