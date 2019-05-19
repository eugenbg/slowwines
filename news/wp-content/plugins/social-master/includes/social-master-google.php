<?php
get_post_custom();
$socialspacer = "'";
//Display Google Plus
if ( $show_display == 'on' ){
	echo '<div id="___plusone_0" style="width:36px !important; margin-left: 4px; z-index:10;">' .
		'<div class="g-plusone" id="___plusone_0" style="width: 36px; !important" data-size="medium"></div>' .
		'<script type="text/javascript">' .
		'(function() {' .
		'var po = document.createElement('.$socialspacer.'script'.$socialspacer.'); po.type = '.$socialspacer.'text/javascript'.$socialspacer.'; po.async = true;' .
		'po.src = '.$socialspacer.'https://apis.google.com/js/plusone.js'.$socialspacer.';' .
		'var s = document.getElementsByTagName('.$socialspacer.'script'.$socialspacer.')[0]; s.parentNode.insertBefore(po, s);' .
		'})();' .
		'</script>' .
		'</div>';
}
else{
	echo '<div style="margin: 4px auto; display:table;">' .
		'<div class="g-plusone" data-size="tall"></div>' .
		'<script type="text/javascript">' .
		'(function() {' .
		'var po = document.createElement('.$socialspacer.'script'.$socialspacer.'); po.type = '.$socialspacer.'text/javascript'.$socialspacer.'; po.async = true;' .
		'po.src = '.$socialspacer.'https://apis.google.com/js/plusone.js'.$socialspacer.';' .
		'var s = document.getElementsByTagName('.$socialspacer.'script'.$socialspacer.')[0]; s.parentNode.insertBefore(po, s);' .
		'})();' .
		'</script>' .
		'</div>';
}
?>
