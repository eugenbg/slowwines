<?php
try
{
	include_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

	$oSEO	= new q23seo();
	$oTrn	= new q23translate();
	$oTr	= new q23swTour();
	$oRgn	= new q23swRegion();
	$oFnctn	= new q23functionProcessor();
	$oSrch	= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
	$sType	= ( isset( $_REQUEST[ "type" ] ) ) ? $_REQUEST[ "type" ] : "";

	switch( $sType )
	{
		case "head":
			$sOutput	= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.blog.header.html" );
			break;
			
		case "foot":
			$sOutput	= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.blog.footer.html" );
			break;
			
		default:
			break;
	}
	
	//	Search Engine Information
	$aSEO			= array(	"{variable.seo.author}"					=> $g_aCfg[ "social" ][ "facebook:author" ],
								"{variable.seo.publisher}"				=> $g_aCfg[ "social" ][ "facebook:publisher" ],
								"{variable.seo.og.app.id}"				=> $g_aCfg[ "social" ][ "facebook:app_id" ],
								"{variable.seo.og.site.name}"			=> $g_aCfg[ "company" ][ "site.name" ],
								"{variable.seo.og.author}"				=> $g_aCfg[ "social" ][ "facebook:author" ],
								"{variable.seo.og.publisher}"			=> $g_aCfg[ "social" ][ "facebook:publisher" ],
								
								"{variable.twitter.site}"				=> $g_aCfg[ "social" ][ "twitter:site" ],
								"{variable.twitter.creator}"			=> $g_aCfg[ "social" ][ "twitter:creator" ],
								"{variable.bing.verification}"			=> $g_aCfg[ "search" ][ "bing.verification" ],
								"{variable.google.verification}"		=> $g_aCfg[ "search" ][ "google.verification" ],
								"{variable.pinterest.verification}"		=> $g_aCfg[ "search" ][ "pinterest.verification" ],
								"{variable.google.analytic}"			=> $g_aCfg[ "search" ][ "google.analytic" ],
								"{variable.google.tracking}"			=> $g_aCfg[ "search" ][ "google.tracking" ],
								"{variable.social.facebook}"			=> $g_aCfg[ "social" ][ "facebook" ],
								"{variable.social.flickr}"				=> $g_aCfg[ "social" ][ "flickr" ],
								"{variable.social.google}"				=> $g_aCfg[ "social" ][ "google" ],
								"{variable.social.linkedin}"			=> $g_aCfg[ "social" ][ "linkedin" ],
								"{variable.social.pinterest}"			=> $g_aCfg[ "social" ][ "pinterest" ],
								"{variable.social.twitter}"				=> $g_aCfg[ "social" ][ "twitter" ],
								"{variable.social.youtube}"				=> $g_aCfg[ "social" ][ "youtube" ],
								"{variable.social.instagram}"			=> $g_aCfg[ "social" ][ "instagram" ],
								
								"{variable.seo.twitter.type}"			=> SEO_TYPE_TWITTER_CARD_TYPE,
								"{variable.meta.human}"					=> '<link rel="author" href="humans.txt" />',
								"{variable.meta.designer}"				=> '<meta name="designer" content="Alison Makin" />',
								"{variable.meta.application}"			=> '<meta name="application-name" content="' . $g_aCfg[ 'product' ][ 'name' ] . '" />',
								"{variable.meta.generator}"				=> '<meta name="generator" content="' . $g_aCfg[ 'product' ][ 'generator' ] . '" />' );
	$sOutput		= str_replace( array_keys( $aSEO ), $aSEO, $sOutput );


	//	Company Data
	$aStdStuff		= array(	"{variable.twitter.site}"				=> $g_aCfg[ "social" ][ "twitter:site" ],
								"{variable.twitter.creator}"			=> $g_aCfg[ "social" ][ "twitter:creator" ],
								"{variable.bing.verification}"			=> $g_aCfg[ "search" ][ "bing.verification" ],
								"{variable.google.verification}"		=> $g_aCfg[ "search" ][ "google.verification" ],
								"{variable.pinterest.verification}"		=> $g_aCfg[ "search" ][ "pinterest.verification" ],
								"{variable.google.analytic}"			=> $g_aCfg[ "search" ][ "google.analytic" ],
								"{variable.google.tracking}"			=> $g_aCfg[ "search" ][ "google.tracking" ],
								"{variable.social.facebook}"			=> $g_aCfg[ "social" ][ "facebook" ],
								"{variable.social.flickr}"				=> $g_aCfg[ "social" ][ "flickr" ],
								"{variable.social.google}"				=> $g_aCfg[ "social" ][ "google" ],
								"{variable.social.linkedin}"			=> $g_aCfg[ "social" ][ "linkedin" ],
								"{variable.social.pinterest}"			=> $g_aCfg[ "social" ][ "pinterest" ],
								"{variable.social.twitter}"				=> $g_aCfg[ "social" ][ "twitter" ],
								"{variable.social.youtube}"				=> $g_aCfg[ "social" ][ "youtube" ],
								"{variable.social.instagram}"			=> $g_aCfg[ "social" ][ "instagram" ],
								"{variable.address.1}"					=> $g_aCfg[ "company" ][ "address.1" ],
								"{variable.address.2}"					=> $g_aCfg[ "company" ][ "address.2" ],
								"{variable.address.country}"			=> $g_aCfg[ "company" ][ "address.country" ],
								"{variable.address.post.code}"			=> $g_aCfg[ "company" ][ "address.post.code" ],
								"{variable.address.post.town}"			=> $g_aCfg[ "company" ][ "address.post.town" ],
								"{variable.address.province}"			=> $g_aCfg[ "company" ][ "address.province" ],
								"{variable.logo}"						=> $g_aCfg[ "company" ][ "logo" ],
								"{variable.site.email.address}"			=> $g_aCfg[ "company" ][ "site.email.address" ],
								"{variable.site.email.name}"			=> $g_aCfg[ "company" ][ "site.email.name" ],
								"{variable.site.tag.line}"				=> $g_aCfg[ "company" ][ "site.tag.line" ],
								"{variable.site.title}"					=> $g_aCfg[ "company" ][ "site.name" ],
								"{variable.site.name}"					=> $g_aCfg[ "company" ][ "site.name" ],
								"{variable.site.name.trading}"			=> $g_aCfg[ "company" ][ "site.name.trading" ],
								"{variable.telephone.1}"				=> $g_aCfg[ "company" ][ "telephone.1" ],
								"{variable.telephone.2}"				=> $g_aCfg[ "company" ][ "telephone.2" ],
								"{variable.telephone.3}"				=> $g_aCfg[ "company" ][ "telephone.3" ],
								"{variable.telephone.4}"				=> $g_aCfg[ "company" ][ "telephone.4" ],
								"{variable.telephone.facsimile}"		=> $g_aCfg[ "company" ][ "telephone.facsimile" ],
								"{variable.telephone.mobile.1}"			=> $g_aCfg[ "company" ][ "telephone.mobile.1" ],
								"{variable.telephone.mobile.2}"			=> $g_aCfg[ "company" ][ "telephone.mobile.2" ],
								"{variable.trading.name}"				=> $g_aCfg[ "company" ][ "site.name.trading" ],
								"{variable.url.privacy}"				=> $g_aCfg[ "company" ][ "url.privacy" ],
								"{widget.expert.modal}"					=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.expert.html" ),
								"{variable.url.terms}"					=> $g_aCfg[ "company" ][ "url.terms" ],
								"{variable.language}"					=> $oSrch->language,
								"{variable.domain}"						=> PROTOCOL . DOMAIN,
								"{widget.contact.modal}"				=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.contact.html" ),
								"{widget.newsletter}"					=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.newsletter.html" ),
								"{variable.date}"						=> date( "Y" ),
								"{variable.select.region}"				=> $oRgn->getRegionOption(),
								"{variable.select.duration}"			=> file_get_contents( FS_FOLDER_DT_BLCK . "tour.days.code" ),
								"{widget.navigation}"					=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
								"{widget.search.horizontal}"			=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
								"{variable.frm.contact}"				=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.contact.html" ),
								"{widget.form.newsletter}"				=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.newsletter.html" ),
								"{variable.language}"					=> $oSrch->language,
								"{variable.menu.tour}"					=> file_get_contents( FS_FOLDER_DT_BLCK . "mn.tour.code" ),
								"{widget.form.search}"					=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.html" ) );
	$sOutput		= str_replace( array_keys( $aStdStuff ), $aStdStuff, $sOutput );
			
	$oTrn->render( $sOutput, $oSrch->language );

	$sOutput		= str_replace( array_keys( $aStdStuff ), $aStdStuff, $oTrn->content );

	$oTrn->render( $sOutput, $oSrch->language );

	echo $oTrn->content;
}
catch( Exception $e )
{
	q23helper::showVariable( $e->getMessage() );
}
?>