<?php
class q23user extends q23base
{
	//================================================================================
	//
	//================================================================================
	//
	public function __construct()
	{
		parent::__construct();

		$this->table	= TBL_UTL_USER;
	}

	//================================================================================
	//	Public Properties.
	//================================================================================
	public function getData( $sID )
	{
		$sSQL	= "SELECT * FROM " . $this->table . " WHERE usr='" . $sID . "' LIMIT 1";
		
		$this->oDB->query( $sSQL );
		
		return $this->member   = $this->oDB->row();
	}

	//================================================================================
	//  Public Methods.
	//================================================================================
	public function display( $nID )
	{
		parent::read( $nID );
		
		$sTpl					= file_get_contents( FS_ROOT . '/thm/adm/tpl/widget.current.user.html' );
		$aData[ 'user.image' ]	= '/dt/upld/' . $this->member[ 'image' ];
		$aData[ 'user.name' ]	= $this->member[ 'nameFirst' ] . " " . $this->member[ 'nameLast' ];
		$aData[ 'user.id' ]		= $this->member[ 'id' ];

		$oTpl	= new q23template();
		$oTpl->setMember( $aData );
		$oTpl->renderInMemory( $sTpl );

		return $oTpl->content;
	}
	
	public function login( $email, $password )
	{
		$sSQL	= "SELECT * FROM " . $this->table . " WHERE LOWER( usr )='" . strtolower( $email ) . "' AND pwd='" . md5( $password ) . "' AND _active=1 LIMIT 1";

		$this->oDB->query( $sSQL );

		$this->member   = $this->oDB->row();

		if( !empty( $this->member ) )
		{
			$this->member[ "usrAgent" ]			= $_SERVER[ 'HTTP_USER_AGENT' ];
			$this->member[ "lastLogin" ]		= date( "Y-m-d H:i:s" );
			$this->member[ "lastLoginAddress" ]	= q23helper::getIpAddress();
			$this->member[ "sessionKey" ]		= md5( $this->member[ "usrAgent" ] . $this->member[ "lastLogin" ] . $this->member[ "lastLoginAddress" ] );
			$this->member[ "id" ]				= self::write();

			$oGazetteer					= new q23gazetteer();
			$aCountry					= $oGazetteer->countryByIP( $this->member[ "lastLoginAddress" ] );

			$aData[ 'usrID' ]			= $this->member[ "id" ];
			$aData[ 'usrName' ]			= $this->member[ "usr" ];
			$aData[ 'usrACL' ]			= $this->member[ "usrACL" ];
			$aData[ 'usrLL' ]			= $this->member[ "lastLogin" ];
			$aData[ 'usrIP' ]			= $this->member[ "lastLoginAddress" ];
			$aData[ 'usrCC' ]			= $aCountry[ "name" ];
			$aData[ 'usrSK' ]			= $this->member[ "sessionKey" ];
			$aData[ 'usrImg' ]			= $this->member[ "image" ];
			$aData[ 'lng' ]				= $this->member[ "usrLng" ];
			$aData[ 'usrZone' ]			= array( 'lst'=>$this->member[ 'zoneLst' ], 'slm'=>$this->member[ 'zoneSLM' ], 'cntnt'=>$this->member[ 'zoneCntnt' ], 'sttst'=>$this->member[ 'zoneSttst' ], 'actn'=>$this->member[ 'zoneActn' ], 'sttng'=>$this->member[ 'zoneSttng' ] );
			
			$_SESSION[ SESSION_ADM ]	= serialize( $aData );

			return true;
		}
		else
		{
			return false;
		}
	}

	//  Check that all the session variables are set correctly.
	public function loginCheck()
	{
	}
}
?>