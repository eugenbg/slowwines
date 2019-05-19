<?php

class q23swTour extends q23base
{
	public	$language				= array( "en"=>1, "es"=>2, "de"=>3, "fr"=>4, "nl"=>5, "dk"=>6, "ru"=>7, "sv"=>8, "pl"=>9, "no"=>10 );
	public	$srch					= NULL;
	public	$shortRecord			= array();
	public	$notationKey			= "tr";
	
	const	OPTION_PATTERN			= '<option value="{value}"{selected}>{name}</option>';
	const	CHECKBOX_PATTERN		= '<input type="checkbox" name="{field}" id="{value}" value="{value}" class="css-checkbox"{checked}><label class="css-label" for="{value}">{name}</label>';
	
	
	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		$this->table	= TBL_APP_CNTNT_TOUR;
		$this->srch		= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
	}
	
	public function edit( $nID=0 )
	{
		try
		{
			$aUsr			= unserialize( $_SESSION[ SESSION_ADM ] );
			$aLanguage		= array();
			$oGzt			= new q23gazetteer();
			$oNttn			= new q23notation();
			$oGuide			= new q23swGuide();
			$oRegion		= new q23swRegion();
			$this->member	= array();
			$aGuide			= $oGuide->getAllGuide();
			$aRegion		= $oRegion->getAllRegion();
			$aType			= $this->cfg[ 'default' ][ 'type' ];
			$aWhenToGo		= array( 'jan'=>'{reword.general.month.jan}', 'feb'=>'{reword.general.month.feb}', 'mar'=>'{reword.general.month.mar}', 'apr'=>'{reword.general.month.apr}', 'may'=>'{reword.general.month.may}', 'jun'=>'{reword.general.month.jun}', 'jul'=>'{reword.general.month.jul}', 'aug'=>'{reword.general.month.aug}', 'sept'=>'{reword.general.month.sept}', 'oct'=>'{reword.general.month.oct}', 'nov'=>'{reword.general.month.nov}', 'dec'=>'{reword.general.month.dec}', 'all'=>'All year round' );
			$aRelated		= self::_getTours();
			
			$aRegion[0]		= 'None Selected';
			$aGuide[0]		= 'None Selected';
//			$aType[0]		= 'None Selected';
			
			ksort( $aRegion );
			ksort( $aGuide );
			ksort( $aType );
			
			if( $nID == 0 )
			{
				$this->member[ "id" ]			= 0;
				$this->member[ "ourID" ]		= "";
				$this->member[ 'guide' ]		= "";
				$this->member[ 'type' ]			= "";
				$this->member[ 'region' ]		= 0;
				$this->member[ 'whenToGo' ]		= "";
				$this->member[ 'price' ]		= 0;
				$this->member[ 'duration' ]		= 0;
				$this->member[ "related" ]		= "";
				$this->member[ "isFeatured" ]	= 0;
				
				foreach( $this->cfg[ "language" ][ "supported" ] as $sCode=>$aData )
				{
					$this->member[ strtolower( $sCode ) . "_title" ]			= "";
					$this->member[ strtolower( $sCode ) . "_keyword" ]			= "";
					$this->member[ strtolower( $sCode ) . "_abstract" ]			= "";
					$this->member[ strtolower( $sCode ) . "_body" ]				= "";
					$this->member[ strtolower( $sCode ) . "_itinerary" ]		= "";
					$this->member[ strtolower( $sCode ) . "_accommodation" ]	= "";
					$this->member[ strtolower( $sCode ) . "_price" ]			= "";
					$this->member[ strtolower( $sCode ) . "_useful" ]			= "";
					$this->member[ strtolower( $sCode ) . "_expect" ]			= "";
					$this->member[ strtolower( $sCode ) . "_availability" ]		= "";
					$this->member[ strtolower( $sCode ) . "_glance" ]			= "";
					$this->member[ strtolower( $sCode ) . "_poi" ]				= "";
				}
			}
			else
			{
				self::read( $nID );
			}
			
			$this->member[ "referrer" ]		= $_SERVER[ 'HTTP_REFERER' ];
			$this->member[ 'guide' ]		= q23helper::select( 'guide',	$aGuide,							$this->member[ 'guide' ],	"form-control" );
			$this->member[ 'type' ]			= q23helper::select( 'type',	$aType,								$this->member[ 'type' ],	"form-control" );
			$this->member[ 'region' ]		= q23helper::select( 'region',	$aRegion,							$this->member[ 'region' ],	"form-control" );
			$this->member[ "whenToGo" ]		= explode( "::", $this->member[ "whenToGo" ] );
			$this->member[ "related" ]		= explode( "::", $this->member[ "related" ] );
			$this->member[ "isFeatured" ]	= q23helper::button( "isFeatured",		"{reword.listing.featured}",		"isFeatured",		1,	( $this->member[ "isFeatured" ] == 1		? true : false ) );
			
			$sTmp	= "";
			
			foreach( $aWhenToGo as $sName=>$sValue )
			{
				$aTmp					 = array();
				$aTmp[ "{checked}" ]	 = ( in_array( $sName, $this->member[ "whenToGo" ] ) ) ? ' checked="checked"' : "";
				$aTmp[ "{field}" ]		 = "whenToGo[]";
				$aTmp[ "{name}" ]		 = $sValue;
				$aTmp[ "{value}" ]		 = $sName;
				$sTmp					.= str_replace( array_keys( $aTmp ), $aTmp, self::CHECKBOX_PATTERN );
			}
			
			$this->member[ 'whenToGo' ]		= $sTmp;
			
			$sTmp	= "";
			
			foreach( $aRelated as $sName=>$sValue )
			{
				$aTmp					 = array();
				$aTmp[ "{checked}" ]	 = ( in_array( $sName, $this->member[ "related" ] ) ) ? ' checked="checked"' : "";
				$aTmp[ "{field}" ]		 = "related[]";
				$aTmp[ "{name}" ]		 = $sValue;
				$aTmp[ "{value}" ]		 = $sName;
				$sTmp					.= str_replace( array_keys( $aTmp ), $aTmp, self::CHECKBOX_PATTERN );
			}
			
			$this->member[ 'related' ]		= $sTmp;
			
			//	Build form
			$bFirst			= true;
			$sTmpTabHeader	= '';
			$sTmpTabBody	= '';
			$sTplTabHeader	= file_get_contents( FS_FOLDER_ADM_TPL . 'form.generic.tab.header.html' );
			$sTplTabBody	= file_get_contents( FS_FOLDER_ADM_TPL . 'form.tour.tab.body.html' );

			foreach( $this->cfg[ "language" ][ "supported" ] as $sCode=>$aData )
			{
				$aLanguage[]	 = strtoupper( $sCode );

				$sTmpTabHeader	.= str_replace( '{variable.class}',						( $bFirst ? 'active' : '' ),								$sTplTabHeader );
				$sTmpTabHeader	 = str_replace( '{variable.language.code}',				strtolower( $sCode ),										$sTmpTabHeader );
				$sTmpTabHeader	 = str_replace( '{variable.language.name}',				str_replace( "translate", "reword", $aData[ 'name' ] ),		$sTmpTabHeader );
				
				$sTmpTabBody	.= str_replace( '{variable.class}',						( $bFirst ? 'active' : '' ),								$sTplTabBody );
				$sTmpTabBody	 = str_replace( '{variable.language.code}',				strtolower( $sCode ),										$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.title}',			$this->member[ strtolower( $sCode ) . "_title" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.keyword}',		$this->member[ strtolower( $sCode ) . "_keyword" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.abstract}',		$this->member[ strtolower( $sCode ) . "_abstract" ],		$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.body}',			$this->member[ strtolower( $sCode ) . "_body" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.itinerary}',		$this->member[ strtolower( $sCode ) . "_itinerary" ],		$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.accommodation}',	$this->member[ strtolower( $sCode ) . "_accommodation" ],	$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.price}',			$this->member[ strtolower( $sCode ) . "_price" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.useful}',		$this->member[ strtolower( $sCode ) . "_useful" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.expect}',		$this->member[ strtolower( $sCode ) . "_expect" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.availability}',	$this->member[ strtolower( $sCode ) . "_availability" ],	$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.glance}',		$this->member[ strtolower( $sCode ) . "_glance" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.poi}',			$this->member[ strtolower( $sCode ) . "_poi" ],				$sTmpTabBody );
				
				$bFirst			 = false;
			}

			$this->member[ 'description.tab' ]		= $sTmpTabHeader;
			$this->member[ 'description.body' ]		= $sTmpTabBody;
			$this->member[ 'supported.language' ]	= strtolower( "'" . implode( "','", $aLanguage ) . "'" );
			$this->member[ 'language' ]				= "'" . $this->srch->language . "'";
			$this->member[ 'notation' ]				= $oNttn->readNote( $this->member[ 'id' ], $this->notationKey );
			
			unset( $sTmpTabHeader );
			unset( $sTmpTabBody );
			
			return $this->member;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function getTourOption()
	{
		$sOutput	= "";
		$sTpl		= "<option value=\"{value}\">{name}</option>" . PHP_EOL;
		
		$this->oDB->query( "SELECT en_title FROM " . $this->table . " WHERE _active=1" );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $nIndex=>$aData )
		{
			$aPayload[ "{value}" ]		= $aData[ "en_title" ];
			$aPayload[ "{name}" ]		= $aData[ "en_title" ];
			
			$sOutput	.= str_replace( array_keys( $aPayload ), $aPayload, $sTpl );
		}

		return $sOutput;
	}
	
	public function getTourByRegion( $nRegion=0, $sTpl="snppt.isotope.item.html" )
	{
		try
		{
			$sTpl		= file_get_contents( FS_FOLDER_USR_SNPPT . $sTpl );
			$sOutput	= "";
			$sWhere		= ( $nRegion > 0 ) ? " WHERE region=" . $nRegion : "";
			
			
			$this->oDB->query( "SELECT * FROM " . $this->table . $sWhere );
			
			$aResult	= $this->oDB->result();
			
			foreach( $aResult as $nIndex=>$aData )
			{
				$aPayload[ "{variable.type}" ]		= ( $aData[ "type" ] == 1 ) ? "self" : "guided";
//				$aPayload[ "{variable.link}" ]		= "/" . $this->srch->language . "/show/tour/" . $aData[ "id" ] . "/";
				$aPayload[ "{variable.link}" ]		= $aData[ "permalink" ];
				$aPayload[ "{variable.image}" ]		= $aData[ "imagePrimary" ];
				$aPayload[ "{variable.title}" ]		= $aData[ $this->srch->language . "_title" ];
				$aPayload[ "{variable.duration}" ]	= $aData[ "duration" ];
				$aPayload[ "{variable.price}" ]		= q23helper::formatMoney( $aData[ "price" ] );
				
				$sOutput	.= str_replace( array_keys( $aPayload ), $aPayload, $sTpl );
			}

			return $sOutput;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function getTourFeatured()
	{
		try
		{
			$sTpl		= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.featured.item.html" );
			$sOutput	= "";
			
			$this->oDB->query( "SELECT * FROM " . $this->table . " WHERE isFeatured=1" );
			
			$aResult	= $this->oDB->result();

			foreach( $aResult as $nIndex=>$aData )
			{
//				$aPayload[ "{variable.link}" ]		= "/" . $this->srch->language . "/show/tour/" . $aData[ "id" ] . "/";
				$aPayload[ "{variable.link}" ]		= $aData[ "permalink" ];
				$aPayload[ "{variable.image}" ]		= $aData[ "imagePrimary" ];
				$aPayload[ "{variable.title}" ]		= $aData[ $this->srch->language . "_title" ];
				$aPayload[ "{variable.abstract}" ]	= $aData[ $this->srch->language . "_abstract" ];
				
				$sOutput	.= str_replace( array_keys( $aPayload ), $aPayload, $sTpl );
			}

			return $sOutput;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function menu()
	{
		$sTplRegion	= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.menu.region.holder.html" );
		$sTplTour	= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.menu.region.tour.html" );
		
		//	Get regions.
		$this->oDB->query( "SELECT id, en_title FROM " . TBL_APP_CNTNT_REGION . " WHERE _active=1 ORDER BY position" );

		$aRegion	= $this->oDB->result();
		$sRegion	= "";
		
		foreach( $aRegion as $vRegion )
		{
			//	Get tours.
			$this->oDB->query( "SELECT id, en_title, permalink FROM " . TBL_APP_CNTNT_TOUR . " WHERE region=" . $vRegion[ "id" ] . " AND _active=1" );
			
			$aTour	= $this->oDB->result();
			$sTour	= "";
			
			foreach( $aTour as $vTour )
			{
				$sTour	.= str_replace( array( "{link}", "{title}" ), array( $vTour[ "permalink" ], $vTour[ "en_title" ] ), $sTplTour ) . PHP_EOL;
			}
			
			$sRegion	.= str_replace( array( "{tour}", "{title}" ), array( $sTour, $vRegion[ "en_title" ] ), $sTplRegion ) . PHP_EOL;
		}
		
		q23helper::writeFile( FS_FOLDER_DT_BLCK . "mn.tour.code", $sRegion );
	}
	
	public function search( $aArg )
	{
//q23helper::showVariable($aArg);
		$oRgn		= new q23swRegion();
		$aWhere		= array();
		$nRegion	= ( isset( $aArg[ "region" ] ) )	? $aArg[ "region" ]				: 0;
		$nDuration	= ( isset( $aArg[ "duration" ] ) )	? (integer)$aArg[ "duration" ]	: 0;
		
		$aWhere[]	= "_active=1";	
		$aWhere[]	= ( $nRegion > 0 ) ? "region=" . $nRegion : "";
		
		switch( $nDuration )
		{
			case "3":
				$aWhere[]	= "duration <= 3";
				break;
				
			case "4":
				$aWhere[]	= "duration <= 4";
				break;
				
			default:
				$aWhere[]	= "duration > 4";
				break;
		}
		
		$sSQL	= "SELECT id, imagePrimary, permalink, price, duration, en_title FROM " . $this->table . " WHERE " . implode( " AND ", $aWhere ) . " ORDER BY price ASC";
//q23helper::showVariable($sSQL);
		
		$this->oDB->query( $sSQL );
		
		$aResult	= $this->oDB->result();
//q23helper::showVariable($aResult);

		if( empty( $aResult ) )
		{
			$sOutput	= "No tours matching your research parameters.";
		}
		else
		{
			$sOutput	= "";
			$sTpl		= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.search.item.html" );
			
			foreach( $aResult as $aRow )
			{
				$aData							 = array();
				$aData[ "{variable.link}" ]		 = $aRow[ "permalink" ];
				$aData[ "{variable.image}" ]	 = $aRow[ "imagePrimary" ];
				$aData[ "{variable.title}" ]	 = $aRow[ "en_title" ];
				$aData[ "{variable.duration}" ]	 = $aRow[ "duration" ];
				$aData[ "{variable.price}" ]	 = q23helper::formatMoney( $aRow[ "price" ] );
				
				$sOutput						.= str_replace( array_keys( $aData ), $aData, $sTpl );
			}
		}
		
		$this->member[ $this->srch->language . "_title" ]		= "";
		$this->member[ $this->srch->language . "_abstract" ]	= "";
		$this->member[ $this->srch->language . "_keyword" ]		= "";
		$this->member[ "imagePrimary" ]							= "";
		$this->member[ "_created" ]								= date( "Y-m-d H:i:s" );
		$this->member[ "_updated" ]								= date( "Y-m-d H:i:s" );
		
		return $sOutput;
	}
	
	public function seo()
	{
		$aSEO						= array();
		$aSEO[ "title" ]			= $this->member[ $this->srch->language . "_title" ];
		$aSEO[ "description" ]		= $this->member[ $this->srch->language . "_abstract" ];
		$aSEO[ "keyword" ]			= $this->member[ $this->srch->language . "_keyword" ];
		$aSEO[ "url" ]				= "";
		$aSEO[ "image" ]			= $this->member[ "imagePrimary" ];
		$aSEO[ "locale" ]			= $this->srch->language;
		$aSEO[ "locale.alternate" ]	= "";
		$aSEO[ "type" ]				= "";
		$aSEO[ "published" ]		= $this->member[ "_created" ];;
		$aSEO[ "modified" ]			= $this->member[ "_updated" ];
		$aSEO[ "link.alternate" ]	= "";
		
		return $aSEO;
	}
	
	public function show( $nID )
	{
		try
		{
			if( $nID > 0 )
			{
				self::read( $nID );
				
				$aTmp		= array_filter( explode( "/", $this->member[ "guide" ] ) );
				$aTmp		= explode( "-", end( $aTmp ) );
				$nGuide		= end( $aTmp );
				$sTpl		= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.tour.body.html" );
				
				$oTstmnl	= new q23testimonial();
				$oGuide		= new q23swGuide();
				$oGuide->getGuide( $nGuide );
				
				$oRegion	= new q23swRegion();
				$aRegion	= $oRegion->getRegion( $this->member[ "region" ] );
				
				$aTmp						= array();
//				$aRelated					= self::_getTours();
				$aRelated					= self::_getTourURL();
				$this->member[ "related" ]	= explode( "::", $this->member[ "related" ] );

				foreach( $aRelated as $nKey=>$vValue )
				{
					if( in_array( $nKey, $this->member[ "related" ] ) )
					{
//						$aTmp[]	= '<li class="caret-r"><a href="/' . $this->srch->language . '/show/tour/' . $nKey . '/">' . $vValue . "</a></li>";
						$aTmp[]	= '<li class="caret-r"><a href="' . $vValue[ "link" ] . '">' . $vValue[ "title" ] . "</a></li>";
					}
				}
				
				$this->member[ "related" ]	= implode( PHP_EOL, $aTmp );
				
				$aCrumb															= array();
				$aCrumb[ "Home" ]												= "/";
				$aCrumb[ $this->member[ $this->srch->language . "_title" ] ]	= "";
				
				$aData									= array();
				$aData[ "{variable.breadcrumb}" ]		= q23helper::buildWebsiteBreadCrumb( $aCrumb );
				$aData[ "{variable.id}" ]				= $this->member[ "id" ];
				$aData[ "{variable.ourID}" ]			= $this->member[ "ourID" ];
				$aData[ "{variable.title}" ]			= $this->member[ "title" ];
				$aData[ "{variable.image}" ]			= self::_slider( "/dt/img/" . $this->notationKey . "/" . $nID . "/" . implode( "::/dt/img/" . $this->notationKey . "/" . $nID . "/", explode( "::", $this->member[ "image" ] ) ) );
				$aData[ "{variable.imagePrimary}" ]		= $this->member[ "imagePrimary" ];
				$aData[ "{variable.whenToGo}" ]			= "{translate.general.month." . implode( "}, {translate.general.month.", explode( "::", $this->member[ "whenToGo" ] ) ) . "}";
				$aData[ "{variable.guide.image}" ]		= "/dt/upld/" . $oGuide->member[ "image" ];
				$aData[ "{variable.guide.name}" ]		= $oGuide->member[ $this->srch->language . "_title" ];
				$aData[ "{variable.guide.text}" ]		= $oGuide->member[ $this->srch->language . "_body" ];
				$aData[ "{variable.type}" ]				= $this->member[ "type" ];
				$aData[ "{variable.region}" ]			= $this->member[ "region" ];
				$aData[ "{variable.fee}" ]				= q23helper::formatMoney( $this->member[ "price" ] );
				$aData[ "{variable.duration}" ]			= $this->member[ "duration" ];

				$aData[ "{variable.title}" ]			= $this->member[ $this->srch->language . "_title" ];
				$aData[ "{variable.keyword}" ]			= $this->member[ $this->srch->language . "_keyword" ];
				$aData[ "{variable.abstract}" ]			= $this->member[ $this->srch->language . "_abstract" ];
				$aData[ "{variable.body}" ]				= $this->member[ $this->srch->language . "_body" ];
				$aData[ "{variable.itinerary}" ]		= $this->member[ $this->srch->language . "_itinerary" ];
				$aData[ "{variable.accommodation}" ]	= $this->member[ $this->srch->language . "_accommodation" ];
				$aData[ "{variable.price}" ]			= $this->member[ $this->srch->language . "_price" ];
				$aData[ "{variable.useful}" ]			= $this->member[ $this->srch->language . "_useful" ];
				$aData[ "{variable.expect}" ]			= self::_createListFA( $this->member[ $this->srch->language . "_expect" ], "fa fa-check" );
				$aData[ "{variable.availability}" ]		= $this->member[ $this->srch->language . "_availability" ];
				$aData[ "{variable.glance}" ]			= self::_createList( $this->member[ $this->srch->language . "_glance" ], "caret-r" );
				$aData[ "{variable.poi}" ]				= self::_createList( $this->member[ $this->srch->language . "_poi" ], "caret-r" );
				$aData[ "{variable.like}" ]				= $aRegion[ $this->srch->language . "_like" ];
//				$aData[ "{variable.region.expert}" ]	= "/" . $this->srch->language . "/show/guide/" . $aRegion[ "guide" ] . "/";
				$aData[ "{variable.region.expert}" ]	= $aRegion[ "guide" ];
				$aData[ "{variable.related}" ]			= $this->member[ "related" ];
				$aData[ "{variable.testimonial}" ]		= $oTstmnl->endorsement( 3, "wide", true );
				
				$sOutput	= str_replace( array_keys( $aData ), $aData, $sTpl );
				
				return $sOutput;
			}
			else
			{
				throw new Exception( "Unknown Tour" );
			}
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function updatePrimaryImage( $nID )
	{
		try
		{
			self::read( $nID );
			
			if( isset( $this->member[ "image" ] ) && strlen( $this->member[ "image" ] ) > 0 )
			{
				$aTmp	= explode( "::", $this->member[ "image" ] );
				
				if( substr( $aTmp[0], 0, 4 ) == "http" )
				{
					$this->member[ "imagePrimary" ]	= $aTmp[0];
				}
				else
				{
					$this->member[ "imagePrimary" ]	= PROTOCOL . DOMAIN . "/dt/img/" . $this->notationKey . "/" . $nID. "/" . $aTmp[0];
				}

				$this->write();
			}
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function view()
	{
		try
		{
			return str_replace( "{variable.isotope}", self::getTourByRegion(), file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.tour.view.html" ) );
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public function write()
	{
		$aUsr						= unserialize( $_SESSION[ SESSION_ADM ] );
		$this->member[ "_editor" ]	= ucwords( $aUsr[ 'usrName' ] );
		
		return parent::write();
	}
	
	//--------------------------------------------------------------------------------
	//	Private Methods
	//--------------------------------------------------------------------------------
	private function _slider( $vImage )
	{
		$sOutput	 = '';
		$nIndex		 = 1;
		$aImage		 = explode( "::", $vImage );
		$sTpl		 = '							    <div class="ms-slide slide-{index}" data-delay="4">';
		$sTpl		.= '									<img src="/js/package/masterslider/blank.gif" data-src="{image}" alt="">';  
		$sTpl		.= '								</div>';

		foreach( $aImage as $nKey=>$sImage )
		{
			$aData				 = array();
			$aData[ "{index}" ]	 = $nIndex;
			$aData[ "{image}" ]	 = $sImage;
			$sOutput			.= str_replace( array_keys( $aData ), $aData, $sTpl );
			
			$nIndex++;
		}

		return $sOutput;
	}
	
	private function _createList( $sData, $sClass )
	{
		$aTmp	= explode( "\n", $sData );
		$sTmp	= '<li class="' . $sClass . '">' . implode( '</li><li class="' . $sClass . '">', $aTmp ) . "</li>";

		return $sTmp;
	}
	
	private function _createListFA( $sData, $sClass )
	{
		$aTmp	= explode( "\n", $sData );
		$sTmp	= '<li><i class="' . $sClass . '"></i>' . implode( '</li><li><i class="' . $sClass . '"></i>', $aTmp ) . "</li>";

		return $sTmp;
	}
	
	private function _getTours()
	{
		$this->oDB->query( "SELECT id, en_title FROM " . $this->table . " WHERE _active=1" );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $aRow )
		{
			$aTmp[ $aRow[ "id" ] ]	= $aRow[ "en_title" ];
		}
		
		return $aTmp;
	}
	
	private function _getTourURL()
	{
		$this->oDB->query( "SELECT id, en_title, permalink FROM " . $this->table . " WHERE _active=1" );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $aRow )
		{
			$aTmp[ $aRow[ "id" ] ][ "title" ]	= $aRow[ "en_title" ];
			$aTmp[ $aRow[ "id" ] ][ "link" ]	= $aRow[ "permalink" ];
		}
		
		return $aTmp;
	}
}
?>