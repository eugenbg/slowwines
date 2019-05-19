<?php

class q23swRegion extends q23base
{
	public	$language				= array( "en"=>1, "es"=>2, "de"=>3, "fr"=>4, "nl"=>5, "dk"=>6, "ru"=>7, "sv"=>8, "pl"=>9, "no"=>10 );
	public	$srch					= NULL;
	public	$shortRecord			= array();
	public	$notationKey			= "rgn";
	
	const	OPTION_PATTERN			= '<option value="{value}"{selected}>{name}</option>';
	const	CHECKBOX_PATTERN		= '<input type="checkbox" name="{field}" id="{value}" value="{value}" class="css-checkbox"{checked}><label class="css-label" for="{value}">{name}</label>';
	
	
	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		$this->table	= TBL_APP_CNTNT_REGION;
		$this->srch		= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
	}
	
	public function getRegion( $nID )
	{
		$aTmp	= array();
		
		$this->oDB->query( "SELECT * FROM " . $this->table . " WHERE id=" . $nID . " LIMIT 1" );
		
		$aRow	= $this->oDB->row();
		
		return $aRow;
	}
	
	public function getRegionByName( $sName )
	{
		
	}
	
	public function getRegionOption()
	{
		$sOutput	= "";
		$sTpl		= "<option value=\"{value}\">{name}</option>" . PHP_EOL;
		
		$this->oDB->query( "SELECT id, en_title FROM " . $this->table . " WHERE _active=1" );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $nIndex=>$aData )
		{
			$aPayload[ "{value}" ]		= $aData[ "id" ];
			$aPayload[ "{name}" ]		= $aData[ "en_title" ];
			
			$sOutput	.= str_replace( array_keys( $aPayload ), $aPayload, $sTpl );
		}

		return $sOutput;
	}
	
	public function getAllRegion()
	{
		$aTmp	= array();
		
		$this->oDB->query( "SELECT * FROM " . $this->table . " WHERE _active=1" );
		
		$aResult	= $this->oDB->result();
		
		foreach( $aResult as $nID=>$aData )
		{
			$aTmp[ $aData[ "id" ] ]	= $aData[ "en_title" ];
		}
		
		return $aTmp;
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
			$this->member	= array();
			$aGuide			= array_merge( array( 0=>'None Selected' ), $oGuide->getAllGuide() );
			$aWhenToGo		= array( 'jan'=>'{reword.general.month.jan}', 'feb'=>'{reword.general.month.feb}', 'mar'=>'{reword.general.month.mar}', 'apr'=>'{reword.general.month.apr}', 'may'=>'{reword.general.month.may}', 'jun'=>'{reword.general.month.jun}', 'jul'=>'{reword.general.month.jul}', 'aug'=>'{reword.general.month.aug}', 'sept'=>'{reword.general.month.sept}', 'oct'=>'{reword.general.month.oct}', 'nov'=>'{reword.general.month.nov}', 'dec'=>'{reword.general.month.dec}' );

			if( $nID == 0 )
			{
				$this->member[ "id" ]			= 0;
				$this->member[ "ourID" ]		= "";
				$this->member[ 'whenToGo' ]		= "";
				$this->member[ 'guide' ]		= "";
				$this->member[ 'position' ]		= "";
				$this->member[ 'permalink' ]	= "";
				
				foreach( $this->cfg[ "language" ][ "supported" ] as $sCode=>$aData )
				{
					$this->member[ strtolower( $sCode ) . "_title" ]	= "";
					$this->member[ strtolower( $sCode ) . "_keyword" ]	= "";
					$this->member[ strtolower( $sCode ) . "_abstract" ]	= "";
					$this->member[ strtolower( $sCode ) . "_like" ]		= "";
					$this->member[ strtolower( $sCode ) . "_body" ]		= "";
					$this->member[ strtolower( $sCode ) . "_poi" ]		= "";
				}
			}
			else
			{
				self::read( $nID );
			}
			
			$this->member[ "referrer" ]		= $_SERVER[ 'HTTP_REFERER' ];
			$this->member[ 'guide' ]		= q23helper::select( 'guide',	$aGuide,	$this->member[ 'guide' ],	"form-control" );
			
			$sTmp	= "";
			
			foreach( $aWhenToGo as $sName=>$sValue )
			{
				$aTmp					 = array();
				$aTmp[ "{checked}" ]	 = ( in_array( $sName, explode( "::", $this->member[ "whenToGo" ] ) ) ) ? ' checked="checked"' : "";
				$aTmp[ "{field}" ]		 = "whenToGo[]";
				$aTmp[ "{name}" ]		 = $sValue;
				$aTmp[ "{value}" ]		 = $sName;
				$sTmp					.= str_replace( array_keys( $aTmp ), $aTmp, self::CHECKBOX_PATTERN );
			}
			
			$this->member[ 'whenToGo' ]		= $sTmp;
			
			//	Build form
			$bFirst			= true;
			$sTmpTabHeader	= '';
			$sTmpTabBody	= '';
			$sTplTabHeader	= file_get_contents( FS_FOLDER_ADM_TPL . 'form.generic.tab.header.html' );
			$sTplTabBody	= file_get_contents( FS_FOLDER_ADM_TPL . 'form.region.tab.body.html' );

			foreach( $this->cfg[ "language" ][ "supported" ] as $sCode=>$aData )
			{
				$aLanguage[]	 = strtoupper( $sCode );

				$sTmpTabHeader	.= str_replace( '{variable.class}',					( $bFirst ? 'active' : '' ),								$sTplTabHeader );
				$sTmpTabHeader	 = str_replace( '{variable.language.code}',			strtolower( $sCode ),										$sTmpTabHeader );
				$sTmpTabHeader	 = str_replace( '{variable.language.name}',			str_replace( "translate", "reword", $aData[ 'name' ] ),		$sTmpTabHeader );

				$sTmpTabBody	.= str_replace( '{variable.class}',					( $bFirst ? 'active' : '' ),								$sTplTabBody );
				$sTmpTabBody	 = str_replace( '{variable.language.code}',			strtolower( $sCode ),										$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.title}',		$this->member[ strtolower( $sCode ) . "_title" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.keyword}',	$this->member[ strtolower( $sCode ) . "_keyword" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.abstract}',	$this->member[ strtolower( $sCode ) . "_abstract" ],		$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.body}',		$this->member[ strtolower( $sCode ) . "_body" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.like}',		$this->member[ strtolower( $sCode ) . "_like" ],			$sTmpTabBody );
				$sTmpTabBody	 = str_replace( '{variable.translation.poi}',		$this->member[ strtolower( $sCode ) . "_poi" ],				$sTmpTabBody );

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
				
				$oTour		= new q23swTour();
				$oTstmnl	= new q23testimonial();
				$sTpl		= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.region.body.html" );
				$sTplImg	= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.region.slider.item.html" );
				
				$aData								= array();
				$aData[ "{variable.id}" ]			= $this->member[ "id" ];
				$aData[ "{variable.ourID}" ]		= $this->member[ "ourID" ];
				$aData[ "{variable.title}" ]		= $this->member[ "title" ];
				$aData[ "{variable.image}" ]		= "/dt/img/" . $this->notationKey . "/" . $nID . "/" . implode( "::/dt/img/" . $this->notationKey . "/" . $nID . "/", explode( "::", $this->member[ "image" ] ) );
				$aData[ "{variable.imagePrimary}" ]	= $this->member[ "imagePrimary" ];
//				$aData[ "{variable.expert}" ]		= "/{variable.language}/show/guide/" . $this->member[ "guide" ] . "/";
				$aData[ "{variable.expert}" ]		= $this->member[ "guide" ];
				$aData[ "{variable.whenToGo}" ]		= "{translate.general.month." . implode( "}, {translate.general.month.", explode( "::", $this->member[ "whenToGo" ] ) ) . "}";
				$aData[ "{variable.title}" ]		= $this->member[ $this->srch->language . "_title" ];
				$aData[ "{variable.keyword}" ]		= $this->member[ $this->srch->language . "_keyword" ];
				$aData[ "{variable.abstract}" ]		= $this->member[ $this->srch->language . "_abstract" ];
				$aData[ "{variable.body}" ]			= $this->member[ $this->srch->language . "_body" ];
				$aData[ "{variable.like}" ]			= $this->member[ $this->srch->language . "_like" ];
				$aData[ "{variable.poi}" ]			= self::_createList( $this->member[ $this->srch->language . "_poi" ], "caret-r" );
				$aData[ "{variable.isotope}" ]		= $oTour->getTourByRegion( $this->member[ "id" ], "snppt.region.isotope.item.html" );
				$aData[ "{variable.testimonial}" ]	= $oTstmnl->endorsement( 3, "wide", true );
				
				//	Slider
				$nIndex								= 1;
				$aImage								= explode( "::", $aData[ "{variable.image}" ] );
				$aData[ "{variable.image}" ]		= "";
				
				foreach( $aImage as $sImage )
				{
					$aTmp								 = array();
					$aTmp[ "{variable.link.image}" ]	 = $sImage;
					$aTmp[ "{variable.id}" ]			 = $nIndex;
					$aData[ "{variable.image}" ]		.= str_replace( array_keys( $aTmp ), $aTmp, $sTplImg );
					
					$nIndex++;
				}
				
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
	
	public function write()
	{
		$aUsr						= unserialize( $_SESSION[ SESSION_ADM ] );
		$this->member[ "_editor" ]	= ucwords( $aUsr[ 'usrName' ] );
		
		return parent::write();
	}
	
	//--------------------------------------------------------------------------------
	//	Private Methods
	//--------------------------------------------------------------------------------
	private function _createList( $sData, $sClass )
	{
		$aTmp	= explode( "\n", $sData );
		$sTmp	= '<li class="' . $sClass . '">' . implode( '</li><li class="' . $sClass . '">', $aTmp ) . "</li>";

		return $sTmp;
	}
}
?>