<?php
	//====================================================================================
	//	File:		inc.constant.php
	//	Copyright:	(c) 2014 Quantum 23, all rights reserved.
	//====================================================================================
	define( "SITE_NAME_FULL",							$sDomain );
	define( 'PROTOCOL',									"https://" );
	define( 'DOMAIN',									$sDomain );
	define( 'FS_DB_HOST',								$sHost );
	define( 'FS_DB_NAME',								$sName );
	define( 'FS_DB_USR',								$sUsr );
	define( 'FS_DB_PWD',								$sPwd );
	define( 'FS_DB_CHAR_SET',							$sCharSet );
	define( "FS_DOMAIN_ROOT",							$sDomain );

	//	Folder locations.
	define( "FS_FOLDER_ROOT",							$_SERVER[ 'DOCUMENT_ROOT' ] . "/" );
	define( "FS_FOLDER_Q23_PTTRN",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/inc/q23/pttrn/" );
	define( "FS_FOLDER_Q23_APP",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/inc/q23/app/" );
	define( "FS_FOLDER_Q23_UTL",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/inc/q23/utl/" );
	define( "FS_FOLDER_VNDR",							$_SERVER[ 'DOCUMENT_ROOT' ] . "/inc/vndr/" );
	define( "FS_FOLDER_DT_BLCK",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/blck/" );
	define( "FS_FOLDER_DT_BFFR",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/bffr/" );
	define( "FS_FOLDER_DT_CSV",							$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/csv/" );
	define( "FS_FOLDER_DT_IMG_LST",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/img/lst/" );
	define( "FS_FOLDER_DT_LG",							$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/lg/" );
	define( "FS_FOLDER_DT_LNG",							$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/lng/" );
	define( "FS_FOLDER_DT_QR",							$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/qr/" );
	define( "FS_FOLDER_DT_UPLD",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/upld/" );
	define( "FS_FOLDER_DT_DWNLD",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/dwnld/" );
	define( "FS_FOLDER_DT_XML",							$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/xml/" );
	define( "FS_FOLDER_DT_XML_CHNKR",					$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/xml/chnkr/" );
	define( "FS_FOLDER_DT_XML_ARCHV",					$_SERVER[ 'DOCUMENT_ROOT' ] . "/dt/xml/archv/" );
	define( "FS_FOLDER_ADM",							$_SERVER[ 'DOCUMENT_ROOT' ] . "/thm/adm/" );
	define( "FS_FOLDER_ADM_SNPT",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/thm/adm/snpt/" );
	define( "FS_FOLDER_ADM_TPL",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/thm/adm/tpl/" );
	define( "FS_FOLDER_USR_SNPPT",						$_SERVER[ 'DOCUMENT_ROOT' ] . "/thm/usr/" );
	
	//	Log files.
	define( "LOG_FILE_CRON",							"crn" );
	define( "LOG_FILE_ERROR",							"err" );
	define( "LOG_FILE_ADMIN",							"adm" );
	define( "LOG_FILE_EMAIL",							"eml" );
	define( "LOG_FILE_FEED",							"fd" );

	//	Log item status codes.
	define( "LOG_WRITER_INFORMATION",					0 );
	define( "LOG_WRITER_WARNING",						1 );
	define( "LOG_WRITER_ERROR",							2 );
	
	define( "SESSION_ADM",								"adm" );
	define( "SESSION_USR",								"clnt" );
	define( "SESSION_USR_RCNT",							"rc" );
	define( "SESSION_USR_PRTFL",						"ptfl" );

	define( "SESSION_USER_ID",							"qres_uid" );
	define( "SESSION_USER_NAME",						"qres_usr" );
	define( "SESSION_USER_ACL",							"qres_acl" );
	define( "SESSION_USER_LNG",							"qres_lng" );
	define( "SESSION_USER_DATA",						"qres_dat" );
	define( "SESSION_ADMIN_DATA",						"qres_dat_admin" );
	define( "SESSION_USER_WTFAI",						"qres_wtfai" );
	define( "SESSION_USER_ROLE",						"qres_role" );
	
	define( "TBL_APP_CNTNT",							"qres_app_cms_page" );
	define( "TBL_APP_CNTNT_GUIDE",						"qres_app_cms_guide" );
	define( "TBL_APP_CNTNT_REGION",						"qres_app_cms_region" );
	define( "TBL_APP_CNTNT_TOUR",						"qres_app_cms_tour" );
	
	define( "TBL_APP_NOTATION",							"qres_app_notation" );
	
	define( "TBL_APP_SLM_CONTACT",						"qres_app_slm_contact" );
	define( "TBL_APP_SLM_CAMPAIGN",						"qres_app_slm_campaign" );
	define( "TBL_APP_TSTMNL",							"qres_app_tstmnl" );
	
	define( "TBL_APP_TOUR_DATE",						"qres_app_tour" );
	
	define( "TBL_UTL_CONFIGURATION",					"qres_utl_configuration" );
	define( "TBL_UTL_CURRENCY",							"qres_utl_currency" );
	define( "TBL_UTL_GEO_IP",							"qres_utl_geo_ip" );
	define( "TBL_UTL_GEO_LOCATION",						"qres_utl_geo_location" );
	define( "TBL_UTL_NOTIFICATION",						"qres_utl_notification" );
	define( "TBL_UTL_TRANSLATION",						"qres_utl_translation" );
	define( "TBL_UTL_USER",								"qres_utl_user" );

	define( "CONST_PG_LISTING_PER_PAGE",				8 );
//	define( "CONST_PG_LISTING_PER_PAGE_ADMIN",			10 );
//	define( "CONST_PG_STAGES",							2 );
	
	define( "SEO_TYPE_FACEBOOK_OG_TYPE_WEBSITE",		"website" );
	define( "SEO_TYPE_FACEBOOK_OG_TYPE_ARTICLE",		"article" );
	define( "SEO_TYPE_TWITTER_CARD_TYPE",				"summary_large_image" );
?>