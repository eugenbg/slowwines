<?php
/**
 * Groups configuration for default Minify implementation
 * @package Minify
 */

/** 
 * You may wish to use the Minify URI Builder app to suggest
 * changes. http://yourdomain/min/builder/
 *
 * See http://code.google.com/p/minify/wiki/CustomSource for other ideas
 **/

return array(
	'js'	=> array(	'//thm/adm/assets/plugins/bootstrap/js/bootstrap.min.js',
						'//thm/adm/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
						'//thm/adm/assets/plugins/blockUI/jquery.blockUI.js',
						'//thm/adm/assets/plugins/iCheck/jquery.icheck.min.js',
						'//thm/adm/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js',
						'//thm/adm/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js',
						'//thm/adm/assets/plugins/less/less-1.5.0.min.js',
						'//thm/adm/assets/plugins/jquery-cookie/jquery.cookie.js',
						'//thm/adm/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js',
						'//thm/adm/assets/js/main.js',
						'//thm/adm/assets/plugins/jquery.sparkline/jquery.sparkline.js',
						'//thm/adm/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js',
						'//thm/adm/assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js',
						'//thm/adm/assets/plugins/fullcalendar/fullcalendar/fullcalendar.js',
						'//thm/adm/assets/js/frame.werx.basic.js',
						'//thm/adm/assets/plugins/jquery-validation/dist/jquery.validate.min.js' ), 
					
	'up'	=> array(	'//thm/adm/assets/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js',
						'//http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js',
						'//http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js',
						'//http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js',
						'//http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/jquery.iframe-transport.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/jquery.fileupload.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/jquery.fileupload-process.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/jquery.fileupload-image.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/jquery.fileupload-audio.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/jquery.fileupload-video.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/jquery.fileupload-validate.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/jquery.fileupload-ui.js',
						'//thm/adm/assets/plugins/jQuery-File-Upload/js/main.js',
						),
					
	'css'	=> array(	'//thm/adm/assets/plugins/bootstrap/css/bootstrap.min.css',
						'//thm/adm/assets/fonts/style.css',
						'//thm/adm/assets/css/main.css',
						'//thm/adm/assets/css/main-responsive.css',
						'//thm/adm/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css',
						'//thm/adm/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css',
						'//thm/adm/assets/css/theme_light.css' ),
	//-----
	//	Website CSS & JS
	//-----
	'ndxCSS'	=> array(	'' ),
	'ndxJS'		=> array(	'' ),
	
	'srchCSS'	=> array(	'' ),
	'srchJS'	=> array(	'' ),
	
	'cntCSS'	=> array(	'//inc/vndr/multiSelect/css/bootstrap-multiselect.css',
							'//inc/vndr/flexslider/flexslider.css',
							'//inc/vndr/share/share.css',
							'//thm/usr/css/site.css' ),
	'cntJS'		=> array(	'//inc/vndr/multiSelect/js/bootstrap-multiselect.js',
							'//inc/vndr/jQuery/jq.form.js',
							'//inc/vndr/validate/jquery.validate.js',
							'//inc/vndr/cookiesDirective/jquery.cookiesdirective.js',
							'//js/usr.search.js',
							'//js/vndr/share/build/share.min.js',
							'//js/usr.main.js' )
	);