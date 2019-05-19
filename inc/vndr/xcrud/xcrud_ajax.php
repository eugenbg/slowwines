<?php
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );
//include ('xcrud.php');
header('Content-Type: text/html; charset=' . Xcrud_config::$mbencoding);
echo Xcrud::get_requested_instance();
?>
