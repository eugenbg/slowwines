<?php
//================================================================================
//	Objective:	Administration 'controller'.
//================================================================================
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/inc/inc.configuration.php' );

try
{
	$sTpl			= file_get_contents( FS_FOLDER_ADM . 'frame.werx.basic.html' );
	$aData			= array();
	$sLanguage		= 'en';
	$sAction		= ( isset( $_REQUEST[ 'act' ] ) )	? $_REQUEST[ 'act' ]	: '';
	$sOption		= ( isset( $_REQUEST[ 'opt' ] ) )	? $_REQUEST[ 'opt' ]	: '';
	$nID			= ( isset( $_REQUEST[ 'id' ] ) )	? $_REQUEST[ 'id' ]		: 0;
	$sContent		= '';

	$oBase			= new q23base();
	$oUsr			= new q23user();
	$oTpl			= new q23template();
	$oSLM			= new q23saleManager();
	$oNtfc			= new q23notification();
	$oTrn			= new q23translate( $sLanguage );
	$oTrn->key		= 'reword';
	$oTrn->language	= $sLanguage;

	$oTrn->load( $sLanguage );

	if( !isset( $_SESSION[ SESSION_ADM ] ) )
	{
		$sTpl	= file_get_contents( FS_FOLDER_ADM . 'frame.werx.login.html' );
	}
	else
	{
		$aUsr	= unserialize( $_SESSION[ SESSION_ADM ] );

		switch( $sAction )
		{
			case 'guide':
				$aData[ 'page.header' ]		= '{reword.guide.editor}';
				$aData[ 'page.tagline' ]	= '{reword.guide.data}';
				$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.guide}'=>'' ) );
				$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'guide', 'settingRegion' ) );
				
				$sCollection				= $sOption;

				include_once( FS_FOLDER_ADM_SNPT . 'app.guide.php' );
				
				$aData[ 'content' ]			= $sContent;
				break;
				
			case 'region':
				$oRegion	= new q23swRegion();
					
				switch( $sOption )
				{
					case 'edit':
						$aData[ 'page.header' ]		= '{reword.region.editor}';
						$aData[ 'page.tagline' ]	= '{reword.region.data}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.region}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'region', 'settingRegion' ) );
						$oTpl						= new q23template();
						
						$oTpl->setMember( $oRegion->edit( $nID ) );
						$oTpl->renderInMemory( file_get_contents( FS_FOLDER_ADM_TPL . 'form.region.html' ) );
						
						$aData[ 'content' ]			= $oTpl->content;
						
						break;
						
					case 'new':
						$aData[ 'page.header' ]		= '{reword.region.editor}';
						$aData[ 'page.tagline' ]	= '{reword.region.data}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.region}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'region', 'settingRegion' ) );
						$oTpl						= new q23template();
						
						$oTpl->setMember( $oRegion->edit( 0 ) );
						$oTpl->renderInMemory( file_get_contents( FS_FOLDER_ADM_TPL . 'form.region.html' ) );
						
						$aData[ 'content' ]			= $oTpl->content;
						
						break;
						
					case 'view':
						$aData[ 'page.header' ]		= '{reword.region.editor}';
						$aData[ 'page.tagline' ]	= '{reword.region.data}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.region}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'region', 'settingRegion' ) );
						
						$sCollection				= $sOption;

						include_once( FS_FOLDER_ADM_SNPT . 'app.region.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					default:
						break;
				}
				
				if( isset( $oRegion ) )
				{
					unset( $oRegion );
				}
				
				break;
				
			case 'tour':
				$oTour	= new q23swTour();
					
				switch( $sOption )
				{
					case 'edit':
						$aData[ 'page.header' ]		= '{reword.tour.editor}';
						$aData[ 'page.tagline' ]	= '{reword.tour.data}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.tour}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'tour', 'settingTour' ) );
						
						$oTpl->setMember( $oTour->edit( $nID ) );
						$oTpl->renderInMemory( file_get_contents( FS_FOLDER_ADM_TPL . 'form.tour.html' ) );
						
						$aData[ 'content' ]			= $oTpl->content;
						
						break;
						
					case 'view':
						$aData[ 'page.header' ]		= '{reword.tour.editor}';
						$aData[ 'page.tagline' ]	= '{reword.tour.data}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.tour}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'tour', 'settingTour' ) );
						
						$sCollection				= $sOption;

						include_once( FS_FOLDER_ADM_SNPT . 'app.tour.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'new':
						$aData[ 'page.header' ]		= '{reword.tour.editor}';
						$aData[ 'page.tagline' ]	= '{reword.tour.data}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.tour}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'tour', 'settingTour' ) );
						$oTpl						= new q23template();
						
						$oTpl->setMember( $oTour->edit( 0 ) );
						$oTpl->renderInMemory( file_get_contents( FS_FOLDER_ADM_TPL . 'form.tour.html' ) );
						
						$aData[ 'content' ]			= $oTpl->content;
						
						break;
				}
				
				if( isset( $oRegion ) )
				{
					unset( $oRegion );
				}
				
				break;
				
			case 'date':
				$aData[ 'page.header' ]		= '{reword.date.editor}';
				$aData[ 'page.tagline' ]	= '{reword.date.data}';
				$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.date}'=>'' ) );
				$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'date' ) );
				
				$oBase->oDB->query( "SELECT ourID, en_title FROM qres_app_cms_tour" );
				
				$aResult	= $oBase->oDB->result();
				
				foreach( $aResult as $aRow )
				{
					$aTour[ $aRow[ "ourID" ] ]	= $aRow[ "en_title" ];
				}
				
				$sCollection				= $sOption;

				include_once( FS_FOLDER_ADM_SNPT . 'app.date.php' );
				
				$aData[ 'content' ]			= $sContent;
				break;
				
			//--------------------------------------------------------------------------------
			
			case 'lead':
				switch( $sOption )
				{
					case 'campaign':
						$aData[ 'page.header' ]		= '{reword.lead.editor}';
						$aData[ 'page.tagline' ]	= '{reword.lead.campaign}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.lead.campaign}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'lead', 'leadCampaign' ) );
						
						$nLatest					= 1;
						
						include_once( FS_FOLDER_ADM_SNPT . 'app.campaign.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'latest':
						$aData[ 'page.header' ]		= '{reword.lead.editor}';
						$aData[ 'page.tagline' ]	= '{reword.lead.latest}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.lead.latest}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'lead', 'leadLatest' ) );
						
						$nLatest					= 1;
						
						include_once( FS_FOLDER_ADM_SNPT . 'app.contact.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'all':
						$aData[ 'page.header' ]		= '{reword.lead.editor}';
						$aData[ 'page.tagline' ]	= '{reword.lead.latest}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.lead.latest}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'lead', 'leadAll' ) );
						
						$nLatest					= 0;
						
						include_once( FS_FOLDER_ADM_SNPT . 'app.contact.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					default:
						if( $nID > 0 )
						{
							$aData[ 'page.header' ]		= '{reword.lead.editor}';
							$aData[ 'page.tagline' ]	= '{reword.lead.latest}';
							$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.lead.latest}'=>'' ) );
							$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'lead', 'leadAll' ) );
							
							$nLatest					= 0;
							
							include_once( FS_FOLDER_ADM_SNPT . 'app.contact.php' );
							
							$aData[ 'content' ]			= $sContent;
						}
						break;
				}
				break;
				
			case 'listing':
				switch( $sOption)
				{
					case 'edit':
						$aData[ 'page.header' ]		= '{reword.listing}';
						$aData[ 'page.tagline' ]	= '{reword.listing.edit}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.listing}'=>'', '{reword.listing.edit}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'listing' ) );
						$oTpl						= new q23template();
						
						$oTpl->setMember( $oLst->edit( $nID ) );
						$oTpl->renderInMemory( file_get_contents( FS_FOLDER_ADM_TPL . 'form.lisitng.html' ) );
						
						$aData[ 'content' ]			= $oTpl->content;
						
						unset( $oLst );
						
						break;
						
					case 'view':
						$aData[ 'page.header' ]		= '{reword.listing}';
						$aData[ 'page.tagline' ]	= '{reword.listing.edit}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.listing}'=>'', '{reword.listing.edit}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'listing' ) );
						$oTpl						= new q23template();
						
						$oTpl->setMember( $oLst->edit( $nID ) );
						$oTpl->renderInMemory( file_get_contents( FS_FOLDER_ADM_TPL . 'form.lisitng.html' ) );
						
						$sScript	= "<script>
						$( document ).ready
						(
							function()
							{
								$( '#btnSaveNew' ).remove();
								$( '#btnSaveEdit' ).remove();
								$( '#btnSaveClose' ).remove();
								$( 'input,select,textarea,checkbox' ).attr( 'readonly', 'readonly' );
							}
						);
						</script>";
						
						$aData[ 'content' ]			= $oTpl->content . $sScript;
						
						unset( $oLst );
						
						break;
						
					case 'new':
						$aData[ 'page.header' ]		= '{reword.listing}';
						$aData[ 'page.tagline' ]	= '{reword.listing.new}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.listing}'=>'', '{reword.listing.new}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'listing', 'listingNew' ) );
						$oTpl						= new q23template();
						
						$oTpl->setMember( $oLst->edit( 0 ) );
						$oTpl->renderInMemory( file_get_contents( FS_FOLDER_ADM_TPL . 'form.lisitng.html' ) );
						
						$aData[ 'content' ]			= $oTpl->content;
						
						unset( $oLst );
						
						break;
						
					case 'saleall':
						$aData[ 'page.header' ]		= '{reword.listing.sale.all}';
						$aData[ 'page.tagline' ]	= '{reword.listing.all}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.listing}'=>'', '{reword.listing.sale.all}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'listing', 'listingResale', 'listingResaleAll' ) );
						$sType						= "sale";
						
						include_once( FS_FOLDER_ADM_SNPT . 'app.listing.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'longall':
						$aData[ 'page.header' ]		= '{reword.listing.long.all}';
						$aData[ 'page.tagline' ]	= '{reword.listing.all}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.listing}'=>'', '{reword.listing.long.all}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'listing', 'listingRental', 'listingRentalAll' ) );
						$sType						= "long";
						
						include_once( FS_FOLDER_ADM_SNPT . 'app.listing.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'shortall':
						$aData[ 'page.header' ]		= '{reword.listing.long.all}';
						$aData[ 'page.tagline' ]	= '{reword.listing.all}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.listing}'=>'', '{reword.listing.short.all}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'listing', 'listingRental', 'listingRentalAll' ) );
						$sType						= "short";
						
						include_once( FS_FOLDER_ADM_SNPT . 'app.listing.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					default:
						break;
				}
				break;
				
			case 'content':
				switch( $sOption)
				{
					case 'website':
						$aData[ 'page.header' ]		= '{reword.content}';
						$aData[ 'page.tagline' ]	= '{reword.content.website}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.content}'=>'', '{reword.content.website}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'content', 'contentWebSite' ) );
					
						include_once( FS_FOLDER_ADM_SNPT . 'app.content.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'testimonial':
						$aData[ 'page.header' ]		= '{reword.content}';
						$aData[ 'page.tagline' ]	= '{reword.content.testimonial}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.content}'=>'', '{reword.content.testimonial}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'content', 'contentTestimonial' ) );
					
						include_once( FS_FOLDER_ADM_SNPT . 'app.testimonial.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
					
					case 'promotion':
						$aData[ 'page.header' ]		= '{reword.content}';
						$aData[ 'page.tagline' ]	= '{reword.content.promotion}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.content}'=>'', '{reword.content.promotion}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'content', 'contentPromotion' ) );
					
						include_once( FS_FOLDER_ADM_SNPT . 'app.promotion.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						break;
					
					default:
						break;
				}
				break;
				
			case 'marshall':
				switch( $sOption )
				{
					case 'block.builder':
						$aData[ 'page.header' ]		 = '{reword.action}';
						$aData[ 'page.tagline' ]	 = '{reword.action.block.builder}';
						$aData[ 'breadcrumb' ]		 = q23helper::buildBreadCrumb( array( '{reword.action}'=>'', '{reword.action.block.builder}'=>'' ) );
						$aData[ 'js' ]				 = q23helper::jsMenuBuilder( array( 'action', 'actionBlockBuilder' ) );
						
						$aData[ 'content' ]			 = "Block processing initialised.<br />";
						
						q23helper::remoteResponse( PROTOCOL . DOMAIN . "/jb/03.block.builder.php" );
						
						$aData[ 'content' ]			 .= "Block processing completed.<br />";
						
						break;
						
					case 'exchange':
						$aData[ 'page.header' ]		 = '{reword.action}';
						$aData[ 'page.tagline' ]	 = '{reword.action.exchange.rates}';
						$aData[ 'breadcrumb' ]		 = q23helper::buildBreadCrumb( array( '{reword.action}'=>'', '{reword.action.exchange.rates}'=>'' ) );
						$aData[ 'js' ]				 = q23helper::jsMenuBuilder( array( 'action', 'actionExchange' ) );
						$aData[ 'content' ]			 = "ECB Exchange Rate processing initialised.<br />";
						
						q23helper::remoteResponse( PROTOCOL . DOMAIN . "/jb/02.exchange.rate.update.php" );

						$aData[ 'content' ]			.= "ECB Exchange Rate processing complete.<br />";

						break;
						
					case 'ip.updater':
						$aData[ 'page.header' ]		 = '{reword.action}';
						$aData[ 'page.tagline' ]	 = '{reword.action.ip.updater}';
						$aData[ 'breadcrumb' ]		 = q23helper::buildBreadCrumb( array( '{reword.action}'=>'', '{reword.action.ip.updater}'=>'' ) );
						$aData[ 'js' ]				 = q23helper::jsMenuBuilder( array( 'action', 'actionIpUpdater' ) );
						$aData[ 'content' ]			 = "IP Address import processing initialised.<br />";
						
						q23helper::remoteResponse( PROTOCOL . DOMAIN . "/jb/01.maxmind.update.php" );

						$aData[ 'content' ]			.= "IP Address import processing complete.<br />";
						
						break;
						
					case "metric":
						$aData[ 'page.header' ]		 = '{reword.action}';
						$aData[ 'page.tagline' ]	 = '{reword.action.metric}';
						$aData[ 'breadcrumb' ]		 = q23helper::buildBreadCrumb( array( '{reword.action}'=>'', '{reword.action.metric}'=>'' ) );
						$aData[ 'js' ]				 = q23helper::jsMenuBuilder( array( 'action', 'actionMetric' ) );
						$aData[ 'content' ]			 = "Metric processing initialised.<br />";
						
						q23helper::remoteResponse( PROTOCOL . DOMAIN . "/jb/04.count.builder.php" );

						$aData[ 'content' ]			.= "Metric processing complete.<br />";
						
						break;
						
					case 'mls.retriever':
						break;
						
					case "optimise":
						$aData[ 'page.header' ]		 = '{reword.action}';
						$aData[ 'page.tagline' ]	 = '{reword.action.optimise}';
						$aData[ 'breadcrumb' ]		 = q23helper::buildBreadCrumb( array( '{reword.action}'=>'', '{reword.action.optimise}'=>'' ) );
						$aData[ 'js' ]				 = q23helper::jsMenuBuilder( array( 'action', 'actionOptimise' ) );
						$aData[ 'content' ]			 = "Optimisation initialised.<br />";
						
						q23helper::remoteResponse( PROTOCOL . DOMAIN . "/jb/90.optimise.table.php" );

						$aData[ 'content' ]			.= "Optimisation complete.<br />";
						
						break;
						
					case "rso.location":
						$aData[ 'page.header' ]		 = '{reword.action}';
						$aData[ 'page.tagline' ]	 = '{reword.action.rso.location}';
						$aData[ 'breadcrumb' ]		 = q23helper::buildBreadCrumb( array( '{reword.action}'=>'', '{reword.action.rso.location}'=>'' ) );
						$aData[ 'js' ]				 = q23helper::jsMenuBuilder( array( 'action', 'actionRsoLocation' ) );
						$aData[ 'content' ]			 = "RSO Location initialised.<br />";
						
						q23helper::remoteResponse( PROTOCOL . DOMAIN . "/jb/20.rso.location.update.php" );

						$aData[ 'content' ]			.= "RSO Location complete.<br />";
						
						break;
						
					case "rso.property":
						$aData[ 'page.header' ]		 = '{reword.action}';
						$aData[ 'page.tagline' ]	 = '{reword.action.rso.property}';
						$aData[ 'breadcrumb' ]		 = q23helper::buildBreadCrumb( array( '{reword.action}'=>'', '{reword.action.rso.property}'=>'' ) );
						$aData[ 'js' ]				 = q23helper::jsMenuBuilder( array( 'action', 'actionRsoProperty' ) );
						$aData[ 'content' ]			 = "RSO Property initialised.<br />";
						
						q23helper::remoteResponse( PROTOCOL . DOMAIN . "/jb/21.rso.property.type.update.php" );

						$aData[ 'content' ]			.= "RSO Property complete.<br />";
						
						break;
						
					default:
						break;
				}
				break;
				
			case 'configuration':
				switch( $sOption )
				{
					case 'company':
						$aData[ 'page.header' ]		= '{reword.setting.configuration.editor}';
						$aData[ 'page.tagline' ]	= '{reword.setting.company.data}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.setting.company}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'setting', 'settingCompany' ) );
						
						$sCollection				= $sOption;

						include_once( FS_FOLDER_ADM_SNPT . 'utl.configuration.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'display':
						$aData[ 'page.header' ]		= '{reword.setting.configuration.editor}';
						$aData[ 'page.tagline' ]	= '{reword.setting.category}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.setting.category}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'setting', 'settingCategory' ) );
						
						$sCollection				= $sOption;
						
						include_once( FS_FOLDER_ADM_SNPT . 'utl.configuration.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'social':
						$aData[ 'page.header' ]		= '{reword.setting.configuration.editor}';
						$aData[ 'page.tagline' ]	= '{reword.setting.social.media.account}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.setting.social.media.account}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'setting', 'settingSocial' ) );
						
						$sCollection				= $sOption;
						
						include_once( FS_FOLDER_ADM_SNPT . 'utl.configuration.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'search':
						$aData[ 'page.header' ]		= '{reword.setting.configuration.editor}';
						$aData[ 'page.tagline' ]	= '{reword.setting.search}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.setting.search}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'setting', 'settingSearch' ) );
						
						$sCollection				= "search";
						
						include_once( FS_FOLDER_ADM_SNPT . 'utl.configuration.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'system':
						$aData[ 'page.header' ]		= '{reword.setting.configuration.editor}';
						$aData[ 'page.tagline' ]	= '{reword.setting.status}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.setting.status}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'setting', 'settingStatus' ) );
						
						$sCollection				= "update";
						
						include_once( FS_FOLDER_ADM_SNPT . 'utl.configuration.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					case 'notification':
						$aData[ 'page.header' ]		= '{reword.setting.configuration.editor}';
						$aData[ 'page.tagline' ]	= '{reword.setting.notification}';
						$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( '{reword.setting.notification}'=>'' ) );
						$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'setting', 'settingNotification' ) );
						
						include_once( FS_FOLDER_ADM_SNPT . 'utl.notification.php' );
						
						$aData[ 'content' ]			= $sContent;
						break;
						
					default:
						break;			
				}
			
				break;
				
			case 'user':
				$aData[ 'page.header' ]		= '{reword.setting.user}';
				$aData[ 'page.tagline' ]	= '{reword.setting.user.tagline}';
				$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( 'User Management'=>'' ) );
				$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'setting', 'settingUser' ) );
				
				include_once( FS_FOLDER_ADM_SNPT . 'utl.user.php' );
				
				$aData[ 'content' ]			= $sContent;
				
				break;
				
			default:
				$aData[ 'page.header' ]		= '{reword.dashboard}';
				$aData[ 'page.tagline' ]	= '';
				$aData[ 'breadcrumb' ]		= q23helper::buildBreadCrumb( array( 'Dashboard'=>'' ) );
				$aData[ 'content' ]			= file_get_contents( FS_ROOT . '/thm/adm/tpl/widget.dashboard.html' );
				$aData[ 'js' ]				= q23helper::jsMenuBuilder( array( 'dashboard' ) );

				foreach( array( "sale", "short", "long" ) as $sType )
				{
					$aTmpCount				= explode( ",", (string)$g_aCfg[ "count" ][ "count." . $sType ] );
					$aTmpCount[0]			= ( $aTmpCount[0] == 0 ) ? end( $aTmpCount ) : $aTmpCount[0];
					
					if( $aTmpCount[0] != 0 )
					{
						$nTmpDifference			= (integer)( ( end( $aTmpCount ) / $aTmpCount[0] ) * 100 ) - 100;
					}
					else
					{
						$nTmpDifference			= 0;
					}
					
					if( $nTmpDifference > 0 )
					{
						$sTmpClass= "good";
					}
					elseif( $nTmpDifference < 0 )
					{
						$sTmpClass= "bad";
					}
					else
					{
						$sTmpClass= "neutral";
					}
					
					$aTmp[ "{variable.listing.featured." . $sType . "}" ]		= count( explode( ",", $g_aCfg[ "display" ][ "featured." . $sType ] ) );
					$aTmp[ "{variable.sparkline." . $sType . "}" ]				= $g_aCfg[ "count" ][ "count." . $sType ];
					$aTmp[ "{variable.sparkline." . $sType . ".value}" ]		= q23helper::formatNumber( end( $aTmpCount ) );
					$aTmp[ "{variable.sparkline." . $sType . ".difference}" ]	= (integer)$nTmpDifference;
					$aTmp[ "{variable.sparkline." . $sType . ".class}" ]		= $sTmpClass;
				}
	 			

	 			$aTmp[ "{variable.system.health}" ]				= $g_aCfg[ "system" ][ "health" ];
	 			$aTmp[ "{variable.language}" ]					= $sLanguage;
	 			
				$aData[ 'content' ]			= str_replace( array_keys( $aTmp ), $aTmp, $aData[ 'content' ] );
				break;
		}
		
		$aData[ 'current.user' ]	= $oUsr->display( $aUsr[ 'usrID' ] );
		$aData[ 'navigation' ]		= q23helper::assembleMenu( $aUsr );
		$aData[ 'message' ]			= $oSLM->getBlock();
		$aData[ 'notification' ]	= $oNtfc->getBlock();
	}

	$aData[ "meta.human" ]				= '<link rel="author" href="humans.txt" />';
	$aData[ "meta.designer" ]			= '<meta name="designer" content="Alison Makin" />';
	$aData[ "meta.application" ]		= '<meta name="application-name" content="' . $g_aCfg[ 'product' ][ 'name' ] . '" />';
	$aData[ "meta.generator" ]			= '<meta name="generator" content="' . $g_aCfg[ 'product' ][ 'generator' ] . '" />';
	$aData[ 'company.name' ]			= $g_aCfg[ 'company' ][ 'site.name' ];
	$aData[ 'language' ]				= $sLanguage;
	$aData[ 'language.upper' ]			= strtoupper( $sLanguage );
	$aData[ 'year' ]					= date( "Y" );

	$oTpl	= new q23template();
	$oTpl->setMember( $aData );
	$oTpl->renderInMemory( $sTpl );

	$oTrn->render( $oTpl->content, $sLanguage );

	echo $oTrn->content;	
}
catch( Exception $e )
{
	q23helper::showVariable( $e->getMessage() );
}
?>