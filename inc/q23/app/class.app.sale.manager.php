<?php
//====================================================================================
//	Class:		q23saleManager
//	Objective:	
//	Copyright	2012 (c) Funky::Software
//	License		http://www.funky-software.net/license/1_0.txt
//	Link		http://dev.zend.com/package/PackageName
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	02-aug-10	Andrew Makin	ICR.
//====================================================================================
class q23saleManager extends q23base
{
	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		$this->table	= TBL_APP_SLM_CONTACT;
	}
	
	
	//--------------------------------------------------------------------------------
	//	Public Methods
	//--------------------------------------------------------------------------------
	public function createMessage( $aArg )
	{
		$oTrn	= new q23translate();
		$oTrn->load( $aArg[ "language" ] );
		
		switch( $aArg[ "campaign" ] )
		{
			case "generalenquiry":
				$this->member			= array();
				$aData					= array();
				$this->member[ "id" ]				=	0;
				$this->member[ "campaign" ]			=	$aData[ '{variable.campaign}' ]		= ( isset( $aArg[ "campaign" ] ) )			? $aArg[ "campaign" ]					: "";
				$this->member[ "subject" ]			=	$aData[ '{variable.subject}' ]		= ( isset( $aArg[ "subject" ] ) )			? $aArg[ "subject" ]					: "";
				$this->member[ "language" ]			=	$aData[ '{variable.language}' ]		= ( isset( $aArg[ "language" ] ) )			? $aArg[ "language" ]					: "en";
				$this->member[ "name" ]				=	$aArg[ "firstName" ] . " " . $aArg[ "lastName" ];
				$this->member[ "email" ]			=	$aData[ '{variable.email}' ]		= ( isset( $aArg[ "email" ] ) )				? $aArg[ "email" ]						: "Unknown";
				$this->member[ "telephone" ]		=	$aData[ '{variable.telephone}' ]	= ( isset( $aArg[ "telephone" ] ) )			? $aArg[ "telephone" ]					: "";
				$this->member[ "message" ]			=	$aData[ '{variable.message}' ]		= ( isset( $aArg[ "message" ] ) )			? $aArg[ "message" ]					: "";
				$this->member[ "dt1" ]				=	$aData[ '{variable.dt1}' ]			= ( isset( $aArg[ "dt1" ] ) )				? self::_dateConvert( $aArg[ "dt1" ] )	: "";
				$this->member[ "party" ]			=	$aData[ '{variable.party}' ]			= ( isset( $aArg[ "party" ] ) )			? $aArg[ "party" ]						: "";
				$this->member[ "payload" ]			=	serialize( $aArg );
				$this->member[ "unread" ]			=	0;
														$aData[ "{variable.first}" ]		= ( isset( $aArg[ "firstName" ] ) )			? $aArg[ "firstName" ]					: "";
														$aData[ "{variable.last}" ]			= ( isset( $aArg[ "lastName" ] ) )			? $aArg[ "lastName" ]					: "";
														$aData[ "{variable.tour}" ]			= ( isset( $aArg[ "destination" ] ) )		? ( ( is_array( $aArg[ "destination" ] ) ) ? implode( ", ", $aArg[ "destination" ] ) : $aArg[ "destination" ] )	: "";
														$aData[ "{variable.travelFrom}" ]	= ( isset( $aArg[ "travelFrom" ] ) )		? $aArg[ "travelFrom" ]					: "";
														$aData[ "{variable.heraAbout}" ]	= ( isset( $aArg[ "hereAboutUs" ] ) )		? $aArg[ "hereAboutUs" ]				: "";
				$aData[ '{variable.body}' ]			= $oTrn->word( "responder." . $aArg[ "campaign" ] . ".body" );
				$sBodyInner							= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.client.email.body." . $aArg[ "campaign" ] . ".html" );
				$sBodyInner							= str_replace( array_keys( $aData ), $aData, $sBodyInner );
				$this->member[ "message" ]			= $sBodyInner;
				
				self::write();
				
				//	Send client mail
				$aData										= array();
				$aData[ '{variable.company.name}' ]			= $this->cfg[ "company" ][ "site.name.trading" ];
				$aData[ '{variable.company.telephone}' ]	= $this->cfg[ "company" ][ "telephone.1" ];
				$aData[ '{variable.company.email}' ]		= $this->cfg[ "company" ][ "site.email.address" ];
				$aData[ '{variable.body}' ]					= $sBodyInner;
				$aData[ '{variable.privacy.url}' ]			= PROTOCOL . DOMAIN . $aArg[ "language" ] . "/" . $this->cfg[ "company" ][ "url.privacy" ];
				$aData[ '{variable.terms.conditions.url}' ]	= PROTOCOL . DOMAIN . $aArg[ "language" ] . "/" . $this->cfg[ "company" ][ "url.terms" ];
				$aData[ '{variable.domain}' ]				= PROTOCOL . DOMAIN;

				$sSubject	= $oTrn->word( "responder." . $aArg[ "campaign" ] . ".subject" );
				$sBody		= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.client.email.body.html" );
				$sBody		= str_replace( array_keys( $aData ), $aData, $sBody );
				
				$oTrn->render( $sBody, $aArg[ "language" ], $aArg[ "language" ] );;
				
				$sBody		= $oTrn->content;
				
				self::send( $this->member[ "email" ], $this->member[ "name" ], $sSubject, $sBody );
				
				//	Send admin mail.
				$sSubject	= $oTrn->word( "responder." . $aArg[ "campaign" ] . ".subject" );
				$sBody		= file_get_contents( FS_FOLDER_ADM . "snppt.adm.email.body.html" );
				$sBody		= str_replace( array_keys( $aData ), $aData, $sBody );
				
				$oTrn->render( $sBody, $aArg[ "language" ], $aArg[ "language" ] );;
				
				$sBody		= $oTrn->content;
				
				self::send( $this->cfg[ "company" ][ "site.email.address" ], $this->cfg[ "company" ][ "site.email.name" ], $sSubject, $sBody );
				
				break;
				
			default:
				//	Save Data
				$this->member						= array();
				$this->member[ "id" ]				= 0;
				$this->member[ "campaign" ]			= $aData[ '{variable.campaign}' ]		= ( isset( $aArg[ "campaign" ] ) )			? $aArg[ "campaign" ]					: "";
				$this->member[ "language" ]			= $aData[ '{variable.language}' ]		= ( isset( $aArg[ "language" ] ) )			? $aArg[ "language" ]					: "en";
				$this->member[ "subject" ]			= $aData[ '{variable.subject}' ]		= ( isset( $aArg[ "subject" ] ) )			? $aArg[ "subject" ]					: "";
				$this->member[ "name" ]				= $aData[ '{variable.name}' ]			= ( isset( $aArg[ "name" ] ) )				? $aArg[ "name" ]						: "Unknown";
				$this->member[ "email" ]			= $aData[ '{variable.email}' ]			= ( isset( $aArg[ "email" ] ) )				? $aArg[ "email" ]						: "Unknown";
				$this->member[ "telephone" ]		= $aData[ '{variable.telephone}' ]		= ( isset( $aArg[ "telephone" ] ) )			? $aArg[ "telephone" ]					: "";
				$this->member[ "message" ]			= $aData[ '{variable.message}' ]		= ( isset( $aArg[ "message" ] ) )			? $aArg[ "message" ]					: "";
				$this->member[ "dt1" ]				= $aData[ '{variable.dt1}' ]			= ( isset( $aArg[ "dt1" ] ) )				? self::_dateConvert( $aArg[ "dt1" ] )	: "";
				$this->member[ "dt2" ]				= $aData[ '{variable.dt2}' ]			= ( isset( $aArg[ "dt2" ] ) )				? self::_dateConvert( $aArg[ "dt2" ] )	: "";
				$this->member[ "perferredDate" ]	= $aData[ '{variable.perferredDate}' ]	= ( isset( $aArg[ "perferredDate" ] ) )		? $aArg[ "perferredDate" ]				: "";
				$this->member[ "party" ]			= $aData[ '{variable.party}' ]			= ( isset( $aArg[ "party" ] ) )				? $aArg[ "party" ]						: "";
				$this->member[ "payload" ]			= serialize( $aArg );
				$this->member[ "unread" ]			= 0;
				
				$aData[ '{variable.body}' ]			= $oTrn->word( "responder." . $aArg[ "campaign" ] . ".body" );
				
				self::write();
				
				//	Build the inner body text.
				switch( $this->member[ "campaign" ] )
				{
					case "availability":
						$sBodyInner					= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.client.email.body.availability.html" );
						break;
						
					case "contact":
					case "enquiry":
					case "expert":
						$sBodyInner					= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.client.email.body.general.html" );
						break;
						
					case "eaf":
						$sBodyInner					= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.client.email.body.eaf.html" );
						break;
						
					case "newsletter":
						$sBodyInner					= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.client.email.body.newsletter.html" );
						break;
						
					case "quote":
						$sBodyInner					= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.client.email.body.quote.html" );
						$aData[ '{variable.dt1}' ]	= self::_dateConvertMySQL( $aData[ '{variable.dt1}' ] );
						$aData[ '{variable.dt2}' ]	= self::_dateConvertMySQL( $aData[ '{variable.dt2}' ] );
						break;
						
					default:
						$sBodyInner					= "";
						break;
				}
									
				$sBodyInner	= str_replace( array_keys( $aData ), $aData, $sBodyInner );
				
				//	Send client mail
				$aData										= array();
				$aData[ '{variable.company.name}' ]			= $this->cfg[ "company" ][ "site.name.trading" ];
				$aData[ '{variable.company.telephone}' ]	= $this->cfg[ "company" ][ "telephone.1" ];
				$aData[ '{variable.company.email}' ]		= $this->cfg[ "company" ][ "site.email.address" ];
				$aData[ '{variable.body}' ]					= $sBodyInner;
				$aData[ '{variable.privacy.url}' ]			= PROTOCOL . DOMAIN . $aArg[ "language" ] . "/" . $this->cfg[ "company" ][ "url.privacy" ];
				$aData[ '{variable.terms.conditions.url}' ]	= PROTOCOL . DOMAIN . $aArg[ "language" ] . "/" . $this->cfg[ "company" ][ "url.terms" ];
				$aData[ '{variable.domain}' ]				= PROTOCOL . DOMAIN;
				
				$sSubject	= $oTrn->word( "responder." . $aArg[ "campaign" ] . ".subject" );
				$sBody		= file_get_contents( FS_FOLDER_USR_SNPPT . "snppt.client.email.body.html" );
				$sBody		= str_replace( array_keys( $aData ), $aData, $sBody );
				
				$oTrn->render( $sBody, $aArg[ "language" ], $aArg[ "language" ] );;
				
				$sBody		= $oTrn->content;
				
				self::send( $this->member[ "email" ], $this->member[ "name" ], $sSubject, $sBody );
				
				//	Send admin mail.
				$sSubject	= $oTrn->word( "responder." . $aArg[ "campaign" ] . ".subject" );
				$sBody		= file_get_contents( FS_FOLDER_ADM . "snppt.adm.email.body.html" );
				$sBody		= str_replace( array_keys( $aData ), $aData, $sBody );
				
				$oTrn->render( $sBody, $aArg[ "language" ], $aArg[ "language" ] );;
				
				$sBody		= $oTrn->content;
				
				self::send( $this->cfg[ "company" ][ "site.email.address" ], $this->cfg[ "company" ][ "site.email.name" ], $sSubject, $sBody );
				
				break;
		}
		
		return $oTrn->word( "responder." . $aArg[ "campaign" ] . ".thank.you" );
	}
	
	public function getBlock()
	{
		$aMessage						= array();
		$aMessage[ 'message.number' ]	= self::getNumberOfMessages();
		$aMessage[ 'messages' ]			= self::getMessages();
		
		$oTpl	= new q23template();
		$oTpl->setMember( $aMessage );
		$oTpl->renderInMemory( file_get_contents( FS_ROOT . '/thm/adm/tpl/widget.message.html' ) );
		
		return $oTpl->content;
	}

	public function getMessages( $nCount=10 )	
	{
		$sOutput	= '';
		$sTpl		= file_get_contents( FS_ROOT . '/thm/adm/tpl/tpl.message.item.html' );
		$sSQL		= "SELECT * FROM " . $this->table . " WHERE unread=0 ORDER BY _created DESC LIMIT " . $nCount;
		
		$this->oDB->query( $sSQL );
		
		$aResult	= $this->oDB->result();

		foreach( $aResult as $aRow )
		{
			$sLink		 = str_replace( '{id}',						$aRow[ 'id' ],							'/{variable.language}/adm/lead/edit/{id}/' );
			$sOutput	.= str_replace( '{variable.name}',			$aRow[ 'name' ],						$sTpl );
			$sOutput	 = str_replace( '{variable.preview}',		$aRow[ 'message' ],						$sOutput );
			$sOutput	 = str_replace( '{variable.message.link}',	$sLink,									$sOutput );
			$sOutput	 = str_replace( '{variable.when}',			q23helper::when( $aRow[ '_created' ] ),	$sOutput );
		}
		
		return $sOutput;
	}
	
	public function getNumberOfMessages()
	{
		$sSQL	= "SELECT count( unread ) AS unread FROM " . $this->table . " WHERE unread=0";
		
		$this->oDB->query( $sSQL );

		$aRow	= $this->oDB->row();

		return $aRow[ 'unread' ];
	}
	
	public function confirm( $sKey )
	{
		try
		{
			
		}
		catch( Exception $e )
		{
			
		}
	}
	
	public function send( $sEmail, $sName, $sSubject, $sBody )
	{
		try
		{
			return q23helper::send( $sEmail, $sName, $sSubject, $sBody, 0 );
		}
		catch( Exception $e )
		{
			
		}
	}
	
	private function _dateConvert( $sDT )
	{
		return preg_replace( '#(\d{2})-(\d{2})-(\d{4})#', '$3-$2-$1', $sDT );
	}
	
	private function _dateConvertMySQL( $sDT )
	{
		$aTmp	= explode( '-', $sDT );
		
		return $aTmp[2] . "-" . $aTmp[1] . "-" . $aTmp[0];
	}
}
?>