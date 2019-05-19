<?php
$sImage	= $_SERVER[ 'DOCUMENT_ROOT' ] . $_POST[ "src" ];

if( file_exists( $sImage ) )
{
	unlink( $sImage );
}
?>