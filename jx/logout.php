<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

$_SESSION	= array();
$aParams	= session_get_cookie_params();

setcookie( session_name(), '', time() - 42000, $aParams[ "path" ], $aParams[ "domain" ], $aParams[ "secure" ], $aParams[ "httponly" ] );

session_destroy();

header( 'Location: /en/adm/' );
?>