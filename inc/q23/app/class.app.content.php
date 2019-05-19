<?php
//====================================================================================
//	Class:		q23content
//	Objective:	
//	Copyright:	2014 (c) Quantum 23
//	License		http://quantum23.com/license/
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	23-Oct-14	Andrew Makin	ICR.
//====================================================================================
class q23content extends q23base
{
	//--------------------------------------------------------------------------------
	//	Class Members
	//--------------------------------------------------------------------------------
	public	$seo				= array();
	public	$image				= "";
	public	$template			= "";
	
	
	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		$this->oSrch	= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
		$this->table	= TBL_APP_CNTNT;
	}
	
	
	//--------------------------------------------------------------------------------
	//	Public Methods
	//--------------------------------------------------------------------------------
	public function show( $sStub='', $sLanguage='en' )
	{
		try
		{
			$sURL	= "/{variable.language}/" . $sStub . "/";
			$sSQL	= "SELECT * FROM " . $this->table . " WHERE stub='".  $sStub . "' LIMIT 1";
			
			$this->oDB->query( $sSQL );

			$aRow	= $this->oDB->row();

			if( empty( $aRow[ $sLanguage . "_body" ] ) )
			{
				if( empty( $aRow[ $this->cfg[ "language" ][ "default" ] . "_body" ] ) )
				{
					foreach( $this->cfg[ "language" ][ "supported" ] as $sKey=>$aData )
					{
						if( !empty( $aRow[ $sKey . "_body" ]  ) )
						{
							$sLanguage	= $sKey;
							
							break;
						}
					}

					if( empty( $aRow[ $sLanguage . "_body" ] ) )
					{
						header( "HTTP/1.0 404 Not Found" );
						header( "location: /" . $sLanguage . "/error/" );
						exit();
					}
				}
				else
				{
					$sLanguage	= $this->cfg[ "language" ][ "default" ];
				}
			}
			
			$oSEO	= new q23seo( $aRow[ $sLanguage . "_body" ] );
			$oSEO->setDescriptionLength( $this->cfg[ "seo" ][ "length.description" ] );
			$oSEO->setMaximumKeywords( $this->cfg[ "seo" ][ "length.keyword" ] );
			
			$sBody	= $aRow[ $sLanguage . "_body" ];
			
			$aSEO[ "title" ]			= ( strlen( $aRow[ $sLanguage . "_title" ] > 0 ) )		? $aRow[ $sLanguage . "_title" ]	: $aRow[ "title" ];
			$aSEO[ "description" ]		= ( strlen( $aRow[ $sLanguage . "_abstract" ] ) > 0 )	? $aRow[ $sLanguage . "_abstract" ]	: $oSEO->getMetaDescription( $this->cfg[ "seo" ][ "length.description" ] );
			$aSEO[ "keyword" ]			= ( strlen( $aRow[ $sLanguage . "_keyword" ] ) > 0 )	? $aRow[ $sLanguage . "_keyword" ]	: $oSEO->getKeyWords();
			$aSEO[ "url" ]				= "http://" . DOMAIN . $sURL;
			$aSEO[ "author" ]			= $this->cfg[ "seo" ][ "author" ];
			$aSEO[ "locale" ]			= $this->cfg[ "language" ][ "supported" ][ $this->oSrch->language ][ "locale" ];
			$aSEO[ "locale.alternate" ]	= q23helper::ogAlternativeLanguages( $sLanguage, $this->cfg );
			$aSEO[ "type" ]				= SEO_TYPE_FACEBOOK_OG_TYPE_ARTICLE;
			$aSEO[ "site.name" ]		= $this->cfg[ "seo" ][ "site_name" ];
			$aSEO[ "image" ]			= ( strlen(  $aRow[ "image" ] ) > 0 )					? '/dt/upld/' . $aRow[ "image" ]	: "";
			$aSEO[ "published" ]		= date( "c", strtotime( $aRow[ "_created" ] ) );
			$aSEO[ "modified" ]			= date( "c", strtotime( $aRow[ "_updated" ] ) );
			$aSEO[ "link.alternate" ]	= q23helper::alternativeLanguages( $sLanguage, $this->cfg, $sURL );
			
			$this->image	= ( strlen( $aRow[ "image" ] ) > 0 ) ? '<img src="/dt/upld/' . $aRow[ "image" ] . '" class="img-responsive int" />' : "";
			$this->template	= $aRow[ "template" ];
			$this->seo		= $aSEO;
			
			return $sBody;
		}
		catch( Exception $e )
		{
			q23helper::showVariable( $e->getMessage() );
		}
	}
//	
//	public function seo()
//	{
//		$sURL	 = str_replace( array_keys( $aTmp ), $aTmp, self::LNK_URL );
//				
//		$oSEO	= new q23seo( $this->_result[ "description" ] );
//		$oSEO->setDescriptionLength( SEO_LENGTH_DEDSCRIPTION );
//		$oSEO->setMaximumKeywords( SEO_LENGTH_KEYWORD );
//
//		$aSEO[ "description" ]		= $oSEO->getMetaDescription( SEO_LENGTH_DEDSCRIPTION );
//		$aSEO[ "keyword" ]			= $oSEO->getKeyWords();
//		$aSEO[ "url" ]				= "http://" . DOMAIN . $this->_result[ "url" ];
//		$aSEO[ "locale" ]			= $this->cfg[ "language" ][ "supported" ][ $this->oSrch->language ][ "locale" ];
//		$aSEO[ "locale.alternate" ]	= q23helper::ogAlternativeLanguages( $this->oSrch->language, $this->cfg );
//		$aSEO[ "type" ]				= SEO_TYPE_FACEBOOK_OG_TYPE_ARTICLE;
//		$aSEO[ "image" ]			= $this->_result[ "primary" ];
//		$aSEO[ "modified" ]			= str_replace( " ", "T", date( "Y-m-d H:i:s+00:00" ) );
//		$aSEO[ "published" ]		= str_replace( " ", "T", date( "Y-m-d H:i:s+00:00" ) );
//		$aSEO[ "link.alternate" ]	= q23helper::alternativeLanguages( $this->oSrch->language, $this->cfg, $sURL );
//		$aSEO[ "title" ]			= $this->_result[ "propertyType" ] . " | " . $this->_result[ "location" ] . " | " . $this->_result[ "salePrice" ];
//		
//		return $aSEO;
//	}
}
?>