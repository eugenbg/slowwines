<?php

//echo 'test'; die();

try
{
	require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

	$oSEO				= new q23seo();
	$oTrn				= new q23translate();
	$oTr				= new q23swTour();
	$oRgn				= new q23swRegion();
	$oFnctn				= new q23functionProcessor();
	$oSrch				= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
	$oSrch->language	= ( empty( $oSrch->language ) )		? $g_aCfg[ 'language' ][ 'default' ]	: $oSrch->language;
	$oSrch->pageNo		= ( isset( $_REQUEST[ "pg" ] ) )	? $_REQUEST[ "pg" ]						: 1;
	$sCmd				= ( isset( $_REQUEST[ "cmd" ] ) )	? $_REQUEST[ "cmd" ]					: "";
	$sAction			= ( isset( $_REQUEST[ "act" ] ) )	? $_REQUEST[ "act" ]					: "";
	$sID				= ( isset( $_REQUEST[ "id" ] ) )	? $_REQUEST[ "id" ]						: 0;
	$sStub				= ( isset( $_REQUEST[ "stub" ] ) )	? $_REQUEST[ "stub" ]					: "";
	$aSEO				= $oSEO->getParameter();

	q23helper::sessionWrite( SESSION_USR, serialize( $oSrch ) );

	switch( $sCmd )
	{
		case "cms":
			$oCntnt						= new q23content();
			$aData						= array(	"{widget.navigation}"			=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
													"{widget.search.horizontal}"	=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
													"{widget.content}"				=> $oCntnt->show( $sStub ),
													"{variable.title}"				=> $oCntnt->seo[ "title" ],
													"{variable.image}"				=> $oCntnt->image );
			$sTemplate					= file_get_contents( FS_FOLDER_USR_SNPPT . "tpl.content." . $oCntnt->template . ".html" );
			$sOutput					= str_replace( array_keys( $aData ), $aData, $sTemplate );
			$aSEO						= $oCntnt->seo;
			
			$oFnctn->render( $sOutput );
			
			$sOutput					= $oFnctn->content;
			break;
				
		case "result":
			$sTemplate					= file_get_contents( FS_FOLDER_USR_SNPPT . "tpl.search.html" );
			$aKey						= array(	"{widget.navigation}",
													"{widget.search.horizontal}", 
													"{widget.search.result}", 
													"{widget.pagination}",
													"{variable.property}" );
			$aData						= array(	file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
													file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
													$oLst->search(),
													$oLst->pagination,
													q23helper::formatNumber( $oLst->propertyCount ) );
			$sOutput					= str_replace( $aKey, $aData, $sTemplate );
			$sURL						= str_replace( "/" . $oSrch->language . "/", "/{variable.language}/", $_SERVER[ 'REQUEST_URI' ] );
			$aSEO[ "title" ]			= "{translate.search." . $sCmd . ".title}";
			$aSEO[ "description" ]		= "{translate.search." . $sCmd . ".description}";
			$aSEO[ "keyword" ]			= "{translate.search." . $sCmd . ".keyword}";
			$aSEO[ "url" ]				= "http://" . DOMAIN . $_SERVER[ 'REQUEST_URI' ];
			$aSEO[ "author" ]			= $g_aCfg[ "seo" ][ "author" ];
			$aSEO[ "locale" ]			= $g_aCfg[ "language" ][ "supported" ][ $oSrch->language ][ "locale" ];
			$aSEO[ "locale.alternate" ]	= q23helper::ogAlternativeLanguages( $oSrch->language, $g_aCfg );
			$aSEO[ "type" ]				= SEO_TYPE_FACEBOOK_OG_TYPE_ARTICLE;
			$aSEO[ "site.name" ]		= $g_aCfg[ "seo" ][ "site_name" ];
			$aSEO[ "image" ]			= "http://" . DOMAIN . "/thm/usr/img/logo.png";
			$aSEO[ "published" ]		= date( "c" );
			$aSEO[ "modified" ]			= date( "c" );
			$aSEO[ "link.alternate" ]	= q23helper::alternativeLanguages( $oSrch->language, $g_aCfg, $sURL );
			
			$oFnctn->render( $sOutput );
			
			$sOutput					= $oFnctn->content;
			break;
			
		case "search":
			$sTemplate	= file_get_contents( FS_FOLDER_USR_SNPPT . "tpl.search.html" );
			$aData		= array(	"{widget.navigation}"			=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
									"{widget.search.horizontal}"	=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
									"{widget.search.result}"		=> $oTr->search( $_REQUEST ),
									"{variable.title}"				=> "Search Results" );
			$sOutput	= str_replace( array_keys( $aData ), $aData, $sTemplate );
			$aSEO		= $oTr->seo();
			
			$oFnctn->render( $sOutput );
			
			$sOutput	= $oFnctn->content;
			break;
			
		case "show":
			if( !is_numeric( $sID ) )
			{
				$aTmp	= explode( "-", $sID );
				$sID	= end( $aTmp );
			}

			q23helper::sessionWrite( SESSION_USR, serialize( $oSrch ) );
				
			$sObj		= "q23sw" .ucwords( $sAction );
			$sTemplate	= file_get_contents( FS_FOLDER_USR_SNPPT . "tpl." . $sAction . ".html" );
			$oObj		= new $sObj();
			$aData		= array(	"{widget.navigation}"			=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
									"{widget.search.horizontal}"	=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
									"{widget.content}"				=> $oObj->show( (integer)$sID ),
									"{variable.title}"				=> "" );
			$sOutput	= str_replace( array_keys( $aData ), $aData, $sTemplate );
			$aSEO		= $oObj->seo();
			
			$oFnctn->render( $sOutput );
			
			$sOutput	= $oFnctn->content;
			break;
			
		case "view":
			switch( $sAction )
			{
				case "testimonial":
					$oObj	= new q23testimonial();
					break;
					
				default:
					$sObj	= "q23sw" .ucwords( $sAction );
					$oObj	= new $sObj();
					break;
			}
			
			q23helper::sessionWrite( SESSION_USR, serialize( $oSrch ) );
			
			$sTemplate	= file_get_contents( FS_FOLDER_USR_SNPPT . "tpl.view.html" );
			$aData		= array(	"{widget.navigation}"			=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
									"{widget.search.horizontal}"	=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
									"{widget.content}"				=> $oObj->view(),
									"{variable.title}"				=> "" );
			$sOutput	= str_replace( array_keys( $aData ), $aData, $sTemplate );
			break;
			
		case "tyc":
			$oCntnt						= new q23content();
			$aData						= array(	"{widget.navigation}"			=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
													"{widget.search.horizontal}"	=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
													"{widget.content}"				=> $oCntnt->show( "thank-you-contact" ),
													"{variable.title}"				=> $oCntnt->seo[ "title" ],
													"{variable.image}"				=> $oCntnt->image,
													"{widget.featured}"				=> $oTr->getTourFeatured() );
			$sTemplate					= file_get_contents( FS_FOLDER_USR_SNPPT . "tpl.content.thank.you.contact.html" );
			$sOutput					= str_replace( array_keys( $aData ), $aData, $sTemplate );
			$aSEO						= $oCntnt->seo;

			$oFnctn->render( $sOutput );
			
			$sOutput					= $oFnctn->content;
			break;
			
		case "tybn":
			$oCntnt						= new q23content();
			$aData						= array(	"{widget.navigation}"			=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
													"{widget.search.horizontal}"	=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
													"{widget.content}"				=> $oCntnt->show( "thank-you-booking" ),
													"{variable.title}"				=> $oCntnt->seo[ "title" ],
													"{variable.image}"				=> $oCntnt->image,
													"{widget.featured}"				=> $oTr->getTourFeatured() );
			$sTemplate					= file_get_contents( FS_FOLDER_USR_SNPPT . "tpl.content.thank.you.booking.html" );
			$sOutput					= str_replace( array_keys( $aData ), $aData, $sTemplate );
			$aSEO						= $oCntnt->seo;

			$oFnctn->render( $sOutput );
			
			$sOutput					= $oFnctn->content;
			break;
			
		default:
			$oCntnt						= new q23content();
			$aData						= array(	"{widget.navigation}"			=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.navigation.html" ),
													"{widget.search.horizontal}"	=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.horizontal.compact.html" ),
													"{widget.content}"				=> $oCntnt->show( "home" ),
													"{variable.title}"				=> $oCntnt->seo[ "title" ],
													"{variable.image}"				=> $oCntnt->image,
													"{widget.featured}"				=> $oTr->getTourFeatured() );
			$sTemplate					= file_get_contents( FS_FOLDER_USR_SNPPT . "tpl.content." . $oCntnt->template . ".html" );
			$sOutput					= str_replace( array_keys( $aData ), $aData, $sTemplate );
			$aSEO						= $oCntnt->seo;

			$oFnctn->render( $sOutput );
			
			$sOutput					= $oFnctn->content;
			break;
	}

	//	Code Blocks

	//	Search Box Information
	$aStdStuff		= array(	//"{variable.language.switcher}"			=> file_get_contents( FS_FOLDER_DT_BLCK . "lng.switcher.code" ),
								"{variable.frm.contact}"				=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.contact.html" ),
								"{widget.form.newsletter}"				=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.newsletter.html" ),
								"{variable.language}"					=> $oSrch->language,
								"{variable.menu.tour}"					=> file_get_contents( FS_FOLDER_DT_BLCK . "mn.tour.code" ),
								"{widget.form.search}"					=> file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.frm.search.html" ),
								//"{variable.genus}"					=> $oSrch->listingType,
								//"{variable.country}"					=> $g_aCfg[ 'rso' ][ 'country' ],
								//"{variable.select.area}"				=> file_get_contents( FS_FOLDER_DT_BLCK . "lst.location.region.option.code" ),
								//"{variable.select.location}"			=> file_get_contents( FS_FOLDER_DT_BLCK . "lst.location.area.option.costa.del.sol.code" ),
								//"{variable.select.location}"			=> file_get_contents( FS_FOLDER_DT_BLCK . "lst.locality.option.nerja.code" ),
								//"{variable.select.listing.type}"		=> file_get_contents( FS_FOLDER_DT_BLCK . "lst.listing.type.option.code" ),
								//"{variable.select.property.type}"		=> file_get_contents( FS_FOLDER_DT_BLCK . "lst.property.type.option.code" ),
								//"{variable.select.bed}"					=> file_get_contents( FS_FOLDER_DT_BLCK . "lst.bed.code" ),
								//"{variable.select.price.min}"			=> file_get_contents( FS_FOLDER_DT_BLCK . "lst.price.sale.min.code" ),
								//"{variable.select.price.max}"			=> file_get_contents( FS_FOLDER_DT_BLCK . "lst.price.sale.max.code" ),
								//"{variable.search.option}"				=> $oSrch->parameters(),
								"{variable.referer}"					=> ( isset( $_SERVER[ "HTTP_REFRRER" ] ) ? $_SERVER[ "HTTP_REFRRER" ] : "" ) );
	$sOutput		= str_replace( array_keys( $aStdStuff ), $aStdStuff, $sOutput );

	//	Search Engine Information
	$oTrn->render( $sOutput, $oSrch->language );
	$sOutput		= $oTrn->content;
	$aSEO			= array(	"{variable.seo.title}"					=> $aSEO[ "title" ],
								"{variable.seo.description}"			=> $aSEO[ "description" ],
								"{variable.seo.keyword}"				=> $aSEO[ "keyword" ],
								"{variable.seo.canonical}"				=> $aSEO[ "url" ],
								"{variable.seo.url}"					=> $aSEO[ "url" ],
								"{variable.seo.image}"					=> $aSEO[ "image" ],
								"{variable.seo.author}"					=> $g_aCfg[ "social" ][ "facebook:author" ],
								"{variable.seo.publisher}"				=> $g_aCfg[ "social" ][ "facebook:publisher" ],
								"{variable.seo.og.title}"				=> $aSEO[ "title" ],
								"{variable.seo.og.locale}"				=> $aSEO[ "locale" ],
								"{variable.seo.og.locale.alternate}"	=> $aSEO[ "locale.alternate" ],
								"{variable.seo.og.url}"					=> $aSEO[ "url" ],
								"{variable.seo.og.app.id}"				=> $g_aCfg[ "social" ][ "facebook:app_id" ],
								"{variable.seo.og.type}"				=> $aSEO[ "type" ],
								"{variable.seo.og.description}"			=> $aSEO[ "description" ],
								"{variable.seo.og.image}"				=> $aSEO[ "image" ],
								"{variable.seo.og.site.name}"			=> $g_aCfg[ "company" ][ "site.name" ],
								"{variable.seo.og.author}"				=> $g_aCfg[ "social" ][ "facebook:author" ],
								"{variable.seo.og.publisher}"			=> $g_aCfg[ "social" ][ "facebook:publisher" ],
								"{variable.seo.og.updated_time}"		=> $aSEO[ "modified" ],
								"{variable.seo.article.section}"		=> $aSEO[ "type" ],
								"{variable.seo.article.published.time}"	=> $aSEO[ "published" ],
								"{variable.seo.article.modified.time}"	=> $aSEO[ "modified" ],
								"{variable.seo.link.alternate}"			=> $aSEO[ "link.alternate" ],
								"{variable.seo.twitter.type}"			=> SEO_TYPE_TWITTER_CARD_TYPE,
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
								"{variable.meta.human}"					=> '<link rel="author" href="humans.txt" />',
								"{variable.meta.designer}"				=> '<meta name="designer" content="Alison Makin" />',
								"{variable.meta.application}"			=> '<meta name="application-name" content="' . $g_aCfg[ 'product' ][ 'name' ] . '" />',
								"{variable.meta.generator}"				=> '<meta name="generator" content="' . $g_aCfg[ 'product' ][ 'generator' ] . '" />' );
	$sOutput		= str_replace( array_keys( $aSEO ), $aSEO, $sOutput );

	//	Company Data
	$aStdStuff		= array(	"{variable.address.1}"					=> $g_aCfg[ "company" ][ "address.1" ],
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
								);
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
