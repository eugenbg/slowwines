<?php
function general_enquire( $aArg )
{
	$oTr	= new q23swTour();
	$sBody	= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.enquire.html" );
	$sBody	= str_replace( "{variable.tour}",	$oTr->getTourOption(), $sBody );
	
	return $sBody;
}

//	<span class="func" datasrc="cmd=q23_wp_posts&count=3&size=small"></span>
function q23_wp_posts( $aArg )
{
	require_once( '../news/wp-load.php' );;
	
	global $post;
	
	if( isset( $aArg[ "size" ] ) ) 
	{
		$sTpl= "snppt.blog.post." . $aArg[ "size" ] . ".html";
	}
	else
	{
		$sTpl= "snppt.blog.post.html";
	}
	
	$sOutput	= '';
	
	$sTpl		= file_get_contents( FS_FOLDER_USR_SNPPT . $sTpl );
	$args		= array( 'posts_per_page' => 3 );
	$aPost		= get_posts( $args );
	
	foreach( $aPost as $post )
	{
		$nThumbID			= get_post_thumbnail_id();
		$aThumb				= wp_get_attachment_image_src( $nThumbID, 'medium', true );
		
		$aData				= array();
		$aData[ "{link}" ]	= get_permalink( $post->id );
		$aData[ "{title}" ]	= $post->post_title;
		$aData[ "{image}" ]	= $aThumb[0];
		
		$sOutput .=  str_replace( array_keys( $aData ), $aData, $sTpl );
	}
	
	return $sOutput;
}

function contactform( $aArg )
{
	return file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.contact.html" );
}

function forecast( $aArg )
{
	global $g_aCfg;

	if( $g_aCfg[ 'plugin' ][ 'weather' ] )
	{
		$nDay		= ( isset( $aArg[ "day" ] ) ) ? $aArg[ "day" ] : 3;
		$oForecast	= new q23weather( $g_aCfg[ "weather" ][ "api.key" ] );
		$aWeek		= $oForecast->getForecastWeek( $g_aCfg[ "weather" ][ "latitude" ], $g_aCfg[ "weather" ][ "longitude" ] );
		$sTplFirst	= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.weather.first.html" );
		$sTplSecond	= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.weather.second.html" );
		$sTplJS		= 'skycons.add( "icon{variable.index}", Skycons.{variable.icon} );' . PHP_EOL;;
		$nIndex		= 1;
		$sJS		= "";
		$sOutput	= "";

		foreach( $aWeek as $oDay )
		{
			$aData	= array(	"{variable.index}"						=> $nIndex,
								"{variable.temperature}"				=> (integer)$oDay->getTemperature(),
								"{variable.temperature.minimum}"		=> (integer)$oDay->getMinTemperature(),
								"{variable.temperature.maximum}"		=> (integer)$oDay->getMaxTemperature(),
								"{variable.summary}"					=> $oDay->getSummary(),
								"{variable.icon}"						=> strtoupper( str_replace( "-", "_", $oDay->getIcon() ) ),
								"{variable.time}"						=> $oDay->getTime(),
								"{variable.pressure}"					=> $oDay->getPressure(),
								"{variable.dew.point}"					=> $oDay->getDewPoint(),
								"{variable.humidity}"					=> $oDay->getHumidity(),
								"{variable.wind.speed}"					=> $oDay->getWindSpeed(),
								"{variable.wind.bearing}"				=> $oDay->getWindBearing(),
								"{variable.precipitation.type}"			=> $oDay->getPrecipitationType(),
								"{variable.precipitation.probability}"	=> $oDay->getPrecipitationProbability(),
								"{variable.cloud.cover}"				=> $oDay->getCloudCover(),
								"{variable.sunrise}"					=> $oDay->getSunrise(),
								"{variable.sunset}"						=> $oDay->getSunset(),
								"{variable.date}"						=> $oDay->getTime( 'Y.m.d' ),
								"{variable.day}"						=> "{translate.day." . strtolower( date( "N", strtotime( $oDay->getTime( 'd-m-Y' ) ) ) ) . "}"
							);
			
			if( $nIndex == 1)
			{
				$sOutput	.= $sTplFirst;
			}
			else
			{
				$sOutput	.= $sTplSecond;
			}
			
			$sOutput	 = str_replace( array_keys( $aData ), $aData, $sOutput );
			$sJS 		.= $sTplJS;
			$sJS		 = str_replace( array_keys( $aData ), $aData, $sJS );
			
			$nIndex++;
			
			if( $nIndex > $nDay )
			{
				break;
			}
		}
		
		$sOutput	.= PHP_EOL . '<script>$( document ).ready( function(){ var skycons = new Skycons( { "color":  "' . $g_aCfg[ "weather" ][ "colour" ] . '" } );' . $sJS . '; skycons.play(); } );</script>';
	}
	else
	{
		$sOutput	= "{translate.error.call.support}";
	}
	
	return $sOutput;
}

function recent( $aArg )
{
	global $g_aCfg;
	
	if( $g_aCfg[ 'plugin' ][ 'recent' ] )
	{
		$nCount		= ( isset( $aArg[ "count" ] ) )		? $aArg[ "count" ]		: $g_aCfg[ "system" ][ "recently" ];
		$aRecent	= ( q23helper::sessionAvailable( SESSION_USR_RCNT ) ) ? unserialize( q23helper::sessionRead( SESSION_USR_RCNT ) ) : array();
		
		if( count( $aRecent ) > 0 )
		{
			$oLst		= new q23listing();
			$sRecent	= $oLst->buildRecent( $aRecent, $nCount );
		}
		else
		{
			$sRecent	= '';
		}
	}
	else
	{
		$sRecent	= '';
	}
	
	return $sRecent;
}

function similar( $aArg )
{
	global $g_aCfg;
	
	$sOutput	= "";

	if( $g_aCfg[ 'plugin' ][ 'similar' ] )
	{
		$nCount		= ( isset( $aArg[ "count" ] ) )		? $aArg[ "count" ]		: 1;
		$nPrice		= ( isset( $aArg[ "price" ] ) )		? $aArg[ "price" ]		: 0;
		$vID		= ( isset( $aArg[ "id" ] ) )		? $aArg[ "id" ]			: "";
		$sType		= ( isset( $aArg[ "type" ] ) )		? $aArg[ "type" ]		: "";

		$oLst		= new q23Listing();
		$sOutput	= $oLst->similar( $nCount, $nPrice, $vID, $sType );
	}
	else
	{
		$sOutput	= "{translate.error.call.support}";
	}
	
	return $sOutput;
}

function testimonial( $aArg )
{
	global $g_aCfg;
	
	if( $g_aCfg[ 'plugin' ][ 'testimonial' ] )
	{
		$nCount		= ( isset( $aArg[ "count" ] ) )		? $aArg[ "count" ]		: 1;
		$sTemplate	= ( isset( $aArg[ "template" ] ) )	? $aArg[ "template" ]	: 'short';
		$sRandom	= ( isset( $aArg[ "random" ] ) )	? $aArg[ "random" ]		: true;
		$oTstmnl	= new q23testimonial();
		
		$sOutput	= $oTstmnl->endorsement( $nCount, $sTemplate, $sRandom );
	
	}
	else
	{
		$sOutput	= "{translate.error.call.support}";
	}
	
	return $sOutput;
}
?>