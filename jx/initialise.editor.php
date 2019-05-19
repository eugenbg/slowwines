<?php	
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

$aUsr	= unserialize( $_SESSION[ SESSION_ADM ] );

echo 'tinyMCE.init
(
	{
		menubar:false,
		statusbar:false,
		theme: "modern",
		skin: "light",
		mode: "textareas",
		editor_selector: "editor-instance",
		height: "250",
		language : "' . $aUsr[ 'lng' ] . '",
		plugins: [ "code link lists jbimages wordcount" ],
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | outdent indent blockquote | link image jbimages | code",
        relative_urls: false
	}
);'
?>