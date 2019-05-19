<?php
class buffer
{
	function data( $url, $death, $dir ) 
	{
		//	check if the error-function has already been initialized
		if( !function_exists( 'error' ) )
		{
			//	if an error occurres, stop the script and tell why
			function error( $id )
			{
				$error['url']	= 'http://github.com/leo/buffer/wiki/errors#'. $id;
				$error['info']	= 'More info <a href="'. $error['url'] .'">here</a>.';

				exit( '<b>Buffer</b>: Error #'. $id .' occurred. '. $error['info'] );
			}
		}

		//	check if all parameters are used in the right way
		if( !isset( $url ) )
		{
			error( 100 );
		}
		
		if( filter_var( $url, FILTER_VALIDATE_URL ) === FALSE)
		{
			error( 101 );
		}

		if( !isset( $death ) )
		{
			$death	= 300;
		}
		
		if( !isset( $dir ) )
		{
			$dir	= 'cache';
		}

		//	define the index
		$index_file		= $dir . 'cache.json';
		$index_content	= json_decode( file_get_contents( $index_file ), true );

		if( file_exists( $index_file ) && array_key_exists( $url, $index_content ) )
		{
			$cache_file	= $dir . '/' . $index_content[ $url ] . '.buffer';

			//	check if the chached file is younger than the max. age
			if( time()-filemtime( $cache_file ) < $death )
			{
				//	load the cached file and uncompress it
				$content	= gzuncompress( file_get_contents( $cache_file ) );
			}
			else
			{
				//	retrieve the latest data
				$content	= file_get_contents( $url );

				//	if it's older, override it with the latest data
				if( file_put_contents( $cache_file, gzcompress( $content, 9 ) ) === FALSE )
				{
					error( 102 );
				}
			}
		}
		else
		{
			//	set the content for the new cache file and save it
			$cache_id	= uniqid();
			$content	= file_get_contents( $url );

			if( file_put_contents( $dir .'/'. $cache_id . '.buffer', gzcompress( $content, 9 ) ) === FALSE )
			{
				error( 102 );
			}

			//	add the new cache-file to the index
			$index_content[ $url ] = $cache_id;

			//	save the new index as json-file
			if( file_put_contents( $index_file, json_encode( $index_content, JSON_PRETTY_PRINT ) ) === FALSE )
			{
				error( 102 );
			}
		}

		//	hand over the content of the file-request (either cached or not)
		return $content;
	}
}
?>