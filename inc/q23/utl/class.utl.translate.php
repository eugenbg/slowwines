<?php
class q23translate extends q23base
{
	//--------------------------------------------------------------------------------
	//	Class Members.
	//--------------------------------------------------------------------------------
	public	$about				= array();
	public	$content			= "";
	public	$key				= "translate";
	public	$language			= "en";
	public	$missing			= array();
	public	$translation		= array();
	
	
	//--------------------------------------------------------------------------------
	//	Magic Methods.
	//--------------------------------------------------------------------------------
	public function __construct( $sLanguage='en' ) 
	{
		parent::__construct();
		
		$this->oSrch	= ( q23helper::sessionAvailable( SESSION_USR ) ) ? unserialize( q23helper::sessionRead( SESSION_USR ) ) : new q23dataSearch();
	}
	
	//--------------------------------------------------------------------------------
	//	Public Properties.
	//--------------------------------------------------------------------------------
	public function word( $sKey )
	{
		return $this->translation[ strtolower( $sKey ) ];
	}
	
	
	//--------------------------------------------------------------------------------
	//	Public Methods.
	//--------------------------------------------------------------------------------
	public function load( $sLanguage='en' )
	{
		include( FS_FOLDER_DT_LNG . $this->oSrch->language . ".adm.php" );
		include( FS_FOLDER_DT_LNG . $this->oSrch->language . ".db.php" );
		include( FS_FOLDER_DT_LNG . $sLanguage . ".sw.php" );
		
		$this->translation	= $aTranslation;
	}
	
	public function render( $sContent, $sLanguage="" )
	{
		try
		{
			if( !strlen( $this->oSrch->language ) == 2 )
			{
				$sTranslation	= $this->language;
			}
			
			include( FS_FOLDER_DT_LNG . $this->oSrch->language . ".adm.php" );
			include( FS_FOLDER_DT_LNG . $this->oSrch->language . ".db.php" );
			include( FS_FOLDER_DT_LNG . $this->oSrch->language . ".sw.php" );
			
			$this->content	= "";
			$aResult		= array();
	
			preg_match_all( "/({" . $this->key . ".)(\w.*)(})/ismU", $sContent, $aPatterns );
			array_push( $aResult, $aPatterns[ 2 ] );
			array_push( $aResult, count( $aPatterns[ 2 ] ) - 1 );

			for( $nIndex=0; $nIndex<=(int)$aResult[1]; $nIndex++ )
			{
				$sKey	= strtolower( trim( (string)$aResult[0][ $nIndex ] ) );

				if( isset( $aTranslation[ $sKey ] ) )
				{
					$sContent	= str_replace( strtolower( "{" . $this->key . "." . $sKey . "}" ), $aTranslation[ strtolower( $aResult[0][ $nIndex ] ) ], $sContent );

					unset( $aResult[0][ $nIndex ] );
				}
				else
				{
					q23helper::writeLog( LOG_FILE_ADMIN, __METHOD__ . ": Translation not found [" .  $sKey . "]", LOG_WRITER_WARNING );
					$this->missing[]	= $sKey;
				}
			}

			$this->content	= $sContent;
			$bResult		= true;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
		}
		
		return $bResult;
	}
	
	public function run( $v='' )
	{
		try
		{
			$this->member	= array( 'de'=>'', 'dk'=>'', 'en'=>'', 'es'=>'', 'fr'=>'', 'nl'=>'', 'no'=>'', 'ru'=>'' );
			
			$sSQL	= "SELECT * FROM fs_utl_translation WHERE _isActive=1 ORDER BY unit, code";
			$this->_oDB->query( $sSQL );
			
			$aTrn	= $this->_oDB->result();
			
			foreach( $aTrn as $aRow )
			{
				foreach( $this->member as $sLng=>$vValue )
				{
					$sTranslation	= ( strlen( $aRow[ $sLng ] ) > 0 )	? $aRow[ $sLng ]	: $sLng . "-" . $aRow[ "code" ];
					
					$this->member[ $sLng ]	.= "\$aTranslation[ '" . $aRow[ "code" ] . "' ] = '" . $sTranslation . "';" . PHP_EOL;
				}
			}

			foreach( $this->member as $sLng=>$vValue )
			{
				$sFile	= $this->_aConfiguration[ 'folder' ][ 'lng' ] . $sLng . '.php';
				q23helper::writeFile( $sFile, "<?php" . PHP_EOL . $vValue . "?>" );
				q23helper::writeLog( LOG_FILE_CRON, "	Translation Updated: " . $sLng, LOG_WRITER_INFORMATION );
			}
			
			return true;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
}
?>