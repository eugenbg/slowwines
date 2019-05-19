<?php
//====================================================================================
//	Class:		q23notifications
//	Objective:	
//	Copyright	2014 (c) Funky::Software
//	License		http://www.funky-software.net/license/1_0.txt
//	Link		http://dev.zend.com/package/PackageName
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	25-jan2014	Andrew Makin	ICR.
//====================================================================================
class q23notification extends q23base
{
	public function __construct()
	{
		parent::__construct();
		
		$this->table	= TBL_UTL_NOTIFICATION;
	}
	
	public function getBlock()
	{
		$aNotification							= array();
		$aNotification[ 'notification.number' ]	= self::getNumberOoNotifications();
		$aNotification[ 'notification' ]		= self::getNotifications();
		
		$oTpl	= new q23template();
		$oTpl->setMember( $aNotification );
		$oTpl->renderInMemory( file_get_contents( FS_ROOT . '/thm/adm/tpl/widget.notification.html' ) );
		
		return $oTpl->content;
	}

	public function getNotifications( $nCount=10 )	
	{
		$sOutput	= '';
		$sTpl		= file_get_contents( FS_ROOT . '/thm/adm/tpl/tpl.notification.item.html' );
		$sSQL		= "SELECT * FROM " . $this->table . " WHERE unread=0 ORDER BY _created DESC LIMIT " . $nCount;
		
		$this->oDB->query( $sSQL );
		
		$aResult	= $this->oDB->result();

		foreach( $aResult as $aRow )
		{
			$sLink		 = str_replace( '{id}',						$aRow[ 'id' ],								'/{variable.language}/adm/configuration/notification/{id}/' );
			$sOutput	.= str_replace( '{variable.type}',			$aRow[ 'type' ],							$sTpl );
			$sOutput	 = str_replace( '{variable.status}',		$aRow[ 'status' ],							$sOutput );
			$sOutput	 = str_replace( '{variable.preview}',		$aRow[ 'message' ],							$sOutput );
			$sOutput	 = str_replace( '{variable.message.link}',	$sLink,										$sOutput );
			$sOutput	 = str_replace( '{variable.when}',			q23helper::when( $aRow[ '_created' ] ),		$sOutput );
		}
		
		return $sOutput;
	}
	
	public function getNumberOoNotifications()
	{
		$sSQL	= "SELECT count( unread ) AS unread FROM " . $this->table . " WHERE unread=0";
		
		$this->oDB->query( $sSQL );

		$aRow	= $this->oDB->row();

		return $aRow[ 'unread' ];
	}
	
	public function notify( $sStatus, $sType, $sMessage )
	{
		$this->member	= array();
		$this->member[ 'id' ]		= 0;
		$this->member[ 'status' ]	= $sStatus;
		$this->member[ 'type' ]		= $sType;
		$this->member[ 'message' ]	= $sMessage;
		$this->member[ '_created' ]	= date( 'Y-m-d H:i:s' );
		$this->member[ 'unread' ]	= 0;
		
		self::write();
	}
}
?>