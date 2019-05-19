<?php
//====================================================================================
//	File:		inc.environment.php
//	Copyright:	(c) 2014 Quantum 23, all rights reserved.
//====================================================================================
$a = 0;
	define( "SITE_NAME_SHORT",				"sw" );
	//define( "ENV_PRODUCTION",				"slowwines.net" );
	define( "ENV_PRODUCTION",				"slow-wines.local" );
	define( "ENV_STAGING",					SITE_NAME_SHORT . ".hudson-07.info" );
	define( "ENV_DEVELOPMENT",				SITE_NAME_SHORT . ".hudson-03.info" );
	define( "ENV_LOCAL",					SITE_NAME_SHORT . ".localhost.com" );
	define( "FS_ROOT",						dirname( dirname( __FILE__ ) ) );
	
	//--------------------------------------------------------------------------------
	//	Don edit below this line.
	//--------------------------------------------------------------------------------
	if( PHP_SAPI == 'cli' )
	{
		$_SERVER[ 'DOCUMENT_ROOT' ]	= dirname( dirname( __FILE__ ) );
	}
	
	if( !isset( $_SERVER[ 'HTTP_HOST' ] ) )
	{
		$_SERVER[ 'DOCUMENT_ROOT' ]	= dirname( dirname( __FILE__ ) );
		$aTmp						=  explode( '/', str_replace( "\\", "/", $_SERVER[ 'DOCUMENT_ROOT' ] ) );
		
		switch( $aTmp[1] )
		{
			case "wamp":
				$_SERVER[ 'HTTP_HOST' ]	= ENV_LOCAL;
				break;
				
			case "hudson03":
				$_SERVER[ 'HTTP_HOST' ]	= ENV_DEVELOPMENT;
				break;
				
			case "hudson07":
				$_SERVER[ 'HTTP_HOST' ]	= ENV_STAGING;
				break;
				
			default:
				$_SERVER[ 'HTTP_HOST' ]	= ENV_PRODUCTION;
				break;
		}
	}

	switch( $_SERVER[ 'HTTP_HOST' ] )
	{
		case ENV_LOCAL:
			$sDomain	= ENV_LOCAL;
			$sHost		= 'localhost';
			$sName		= SITE_NAME_SHORT;
			$sUsr		= 'root';
			$sPwd		= '';
			$sCharSet	= 'utf8';
			$bSanitize	= false;
			break;
			
		case ENV_DEVELOPMENT:
			$sDomain	= ENV_DEVELOPMENT;
			$sHost		= 'localhost';
			$sName		= 'hudson03_' . SITE_NAME_SHORT;
			$sUsr		= 'hudson03_' . SITE_NAME_SHORT;
			$sPwd		= 'x8c!9AKUp8$r';
			$sCharSet	= 'utf8';
			$bSanitize	= false;
			break;
			
		case ENV_STAGING:
			$sDomain	= ENV_STAGING;
			$sHost		= 'localhost';
			$sName		= 'hudson07_' . SITE_NAME_SHORT;
			$sUsr		= 'hudson07_' . SITE_NAME_SHORT;
			$sPwd		= 'x8c!9AKUp8$r';
			$sCharSet	= 'utf8';
			$bSanitize	= false;
			break;
			
		case ENV_PRODUCTION:
			$sDomain	= ENV_PRODUCTION;
			$sHost		= 'localhost';
/*			$sName		= 'slowwine_' . SITE_NAME_SHORT;
			$sUsr		= 'slowwine_' . SITE_NAME_SHORT;
			$sPwd		= '9f1qUTeTXn2iSt9T56';*/
            $sName		= 'slowwine_' . SITE_NAME_SHORT;
            $sUsr		= 'eugen';
            $sPwd		= 'password';

			$sCharSet	= 'utf8';
			$bSanitize	= false;
			break;
			
		default:
			die( "Unknown Environment." );
			break;
	}
?>