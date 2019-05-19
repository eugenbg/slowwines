<?php
//====================================================================================
//	File:		inc.configuration.php
//	Copyright:	(c) 2014 Quantum 23, all rights reserved.
//====================================================================================
try
{
	error_reporting( E_ALL );
	ini_set( 'display_errors', '1' );
	date_default_timezone_set( "Europe/Madrid" );
	
	if( PHP_SAPI != 'cli' )
	{
		session_start();
	}

	include_once( dirname( dirname( __FILE__ ) ) . "/inc/inc.environment.php" );
	include_once( dirname( dirname( __FILE__ ) ) . "/inc/inc.constant.php" );
	
	//--------------------------------------------------------------------------------
	//	Global Constants Definitions.
	//--------------------------------------------------------------------------------
	$g_aParam												= array();
	$g_aParam[ 'product' ][ 'company' ]						= "Quantum 23";
	$g_aParam[ 'product' ][ 'name' ]						= "QRES";
	$g_aParam[ 'product' ][ 'release' ]						= "01";
	$g_aParam[ 'product' ][ 'generator' ]					= "SW-01";
	$g_aParam[ 'product' ][ 'release' ]						= "01";
	
	$g_aParam[ 'juju' ][ 'domain' ]							= array( ENV_PRODUCTION, ENV_STAGING, ENV_DEVELOPMENT, ENV_LOCAL );
	$g_aParam[ 'juju' ][ 'ip' ]								= array( "91.239.64.225", "91.239.64.225", "91.239.64.225", "127.0.0.1" );
	$g_aParam[ 'juju' ][ 'expiry' ]							= "2020-12-31 23:59:59";
	$g_aParam[ 'juju' ][ 'method' ]							= array( "q23listing::mortgage" );
	
	$g_aParam[ 'geo' ][ 'country' ]							= "spain";
	$g_aParam[ 'geo' ][ 'state' ]							= "Costa del Sol East";
	$g_aParam[ 'geo' ][ 'province' ]						= "málaga";
	$g_aParam[ 'geo' ][ 'area' ]							= "nerja";
	$g_aParam[ 'geo' ][ 'city' ]							= "nerja";
	
	$aLanguage[ "de" ]										= array( "name" => "{translate.language.de}", "active" => false,	"flag"=>"dk", "locale"=>"de_DE", "default" => false );
	$aLanguage[ "dk" ]										= array( "name" => "{translate.language.dk}", "active" => false,	"flag"=>"da", "locale"=>"da_DK", "default" => false );
	$aLanguage[ "en" ]										= array( "name" => "{translate.language.en}", "active" => true,		"flag"=>"en", "locale"=>"en_GB", "default" => true );
	$aLanguage[ "es" ]										= array( "name" => "{translate.language.es}", "active" => false,	"flag"=>"es", "locale"=>"es_ES", "default" => false );
	$aLanguage[ "fr" ]										= array( "name" => "{translate.language.fr}", "active" => false,	"flag"=>"fr", "locale"=>"fr_FR", "default" => false );
	$aLanguage[ "nl" ]										= array( "name" => "{translate.language.nl}", "active" => false,	"flag"=>"nl", "locale"=>"nl_NL", "default" => false );
	$aLanguage[ "no" ]										= array( "name" => "{translate.language.no}", "active" => false,	"flag"=>"no", "locale"=>"nn_NO", "default" => false );
	$aLanguage[ "pl" ]										= array( "name" => "{translate.language.pl}", "active" => false,	"flag"=>"pl", "locale"=>"pl_PL", "default" => false );
	$aLanguage[ "ru" ]										= array( "name" => "{translate.language.ru}", "active" => false,	"flag"=>"ru", "locale"=>"ru_RU", "default" => false );
	$aLanguage[ "sv" ]										= array( "name" => "{translate.language.sv}", "active" => false,	"flag"=>"sv", "locale"=>"sv_SE", "default" => false );

	$g_aParam[ "currency" ][ "base" ]						= "EUR";
	$g_aParam[ "currency" ][ "uri" ]						= "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
	$g_aParam[ "currency" ][ "live" ]						= array( "EUR"=>"EUR", "GBP"=>"GBP", "USD"=>"USD" );
	$g_aParam[ "currency" ][ "EUR" ]						= ".|,|0|before|&euro;";
	$g_aParam[ "currency" ][ "GBP" ]						= ",|.|0|before|&pound;";
	$g_aParam[ "currency" ][ "USD" ]						= ",|.|0|before|$";
	
	$g_aParam[ "maxmind" ][ "uri" ]							= "geolite.maxmind.com/download/geoip/database/GeoIPCountryCSV.zip";
	
	$g_aParam[ 'default' ][ 'yesno' ]						= array( 1=>"{reword.general.yes}", 0=>"{reword.general.no}" );
	$g_aParam[ 'default' ][ 'type' ]						= array( 1=>"{reword.general.self}", 0=>"{reword.general.escorted}" );
	
	$g_aParam[ "seo" ][ "type" ]							= "";
	$g_aParam[ "seo" ][ "site_name" ]						= "";
	$g_aParam[ "seo" ][ "section" ]							= "";
	$g_aParam[ "seo" ][ "author" ]							= "";
	$g_aParam[ "seo" ][ "length.title" ]					= 63;
	$g_aParam[ "seo" ][ "length.keyword" ]					= 25;
	$g_aParam[ "seo" ][ "length.description" ]				= 156;

	$g_aParam[ "pricing" ][ "" ]							= "";
	$g_aParam[ "pricing" ][ "from" ]						= "{reword.general.from}";
	$g_aParam[ "pricing" ][ "poa" ]							= "{reword.general.poa}";
	
	$g_aParam[ "pagination" ][ "result.similar" ]			= 3;
	$g_aParam[ "pagination" ][ "result.per.page.usr" ]		= 8;
	$g_aParam[ "pagination" ][ "result.per.page.adm" ]		= 10;
	$g_aParam[ "pagination" ][ "result.stage" ]				= 2;
	
	
	//--------------------------------------------------------------------------------
	//	Load the supporting classess and libraries.
	//--------------------------------------------------------------------------------
	//	Third party libraries.
	require_once( FS_FOLDER_VNDR	. "xcrud/xcrud.php" );
	require_once( FS_FOLDER_VNDR	. "phpMailer/class.phpmailer.php" );
	require_once( FS_FOLDER_VNDR	. "phpMailer/class.smtp.php" );
	require_once( FS_FOLDER_VNDR	. "phpQRCode/qrlib.php" );

	//	Utility Libraries.
	require_once( FS_FOLDER_Q23_UTL	. "lib.utl.general.php" );
	require_once( FS_FOLDER_Q23_UTL	. "lib.utl.short.code.processor.php" );

	//	Utility Classes.
	require_once( FS_FOLDER_Q23_UTL . "class.utl.base.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.buffer.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.configuration.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.currency.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.gazetteer.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.helper.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.maxmind.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.monitor.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.notation.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.notification.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.pagination.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.seo.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.template.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.translate.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.user.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.weather.php" );
	require_once( FS_FOLDER_Q23_UTL . "class.utl.weather.forecast.io.php" );

	//	Application Libraries.
	require_once( FS_FOLDER_Q23_APP . "class.app.sw.guide.php" );
	require_once( FS_FOLDER_Q23_APP . "class.app.sw.region.php" );
	require_once( FS_FOLDER_Q23_APP . "class.app.sw.tour.php" );

	//	Worker Libraries and Classes.
	require_once( FS_FOLDER_Q23_APP . "lib.app.process.php" );
	require_once( FS_FOLDER_Q23_APP . "class.app.content.php" );
	require_once( FS_FOLDER_Q23_APP . "class.app.sale.manager.php" );
	require_once( FS_FOLDER_Q23_APP . "class.app.testimonial.php" );
	
	//	Data Classes.
	require_once( FS_FOLDER_Q23_APP . "class.app.data.search.php" );
	require_once( FS_FOLDER_Q23_APP . "class.app.data.recent.php" );


	//--------------------------------------------------------------------------------
	//	Instanciate Global Objects.
	//--------------------------------------------------------------------------------
	$g_oCfg					= new q23configuration();
	$g_oCfg->table			= TBL_UTL_CONFIGURATION;
	$g_aConfig				= $g_oCfg->associative( "name", "value" );
	$aTmpLanguage			= $g_oCfg->language( $aLanguage );

	$g_oTranslate			= new q23translate();
	$g_oTranslate->table	= TBL_UTL_CONFIGURATION;
	
	$g_oUser				= new q23user();
	$g_oUser->table			= TBL_UTL_USER;
	
	$g_aCfg					= array_merge( $g_aConfig, $g_aParam, $aTmpLanguage );
	
	ksort( $g_aCfg );
	unset( $g_aConfig );
	unset( $g_oCfg );
	unset( $aTmpLanguage );
	unset( $g_aParam );

	q23helper::samedi();
}
catch( Exception $e )
{
	die( $e->getMessage() );
}
?>