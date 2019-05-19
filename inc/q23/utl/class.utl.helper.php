<?php
//====================================================================================
//	Class:		q23helper
//	Objective:	Singleton class containing useful stuff.
//	Copyright:	2014 (c) Quantum 23
//	License		http://quantum23.com/license/
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	09-Oct-14	Andrew Makin	ICR.
//====================================================================================
class q23helper
{
	private static $_aConfiguration;
	private static $_oDB;
	private static $_oLanguage;
	
	//--------------------------------------------------------------------------------
	//	Contructor/Destructor
	//--------------------------------------------------------------------------------
	public function __construct()
	{
	}
	
	public function __destruct()
	{
	}
	
	//--------------------------------------------------------------------------------
	//	Generic SEO
	//--------------------------------------------------------------------------------
	public static function seo()
	{
		$aSEO[ "title" ]				= "";
		$aSEO[ "description" ]			= "";
		$aSEO[ "keyword" ]				= "";
		$aSEO[ "url" ]					= "";
		$aSEO[ "image" ]				= "";

		$aSEO[ "locale" ]				= "";
		$aSEO[ "locale.alternate" ]		= "";
		$aSEO[ "type" ]					= "";
		$aSEO[ "description" ]			= "";
		$aSEO[ "modified" ]				= "";

		$aSEO[ "type" ]					= "";
		$aSEO[ "published" ]			= "";
		$aSEO[ "modified" ]				= "";
		$aSEO[ "link.alternate" ]		= "";
		
		return $aSEO;
	}
	
	//--------------------------------------------------------------------------------
	//	Web Controls.
	//--------------------------------------------------------------------------------
	//	Checkbox tag.
	public static function checkbox( $sName, $aValue, $vDefault, $sClass="" )
	{
		$sOutput	 = "";
		$sSuffix	= ( sizeOf( $aValue ) > 0 ? "[]" : "" );
		
		foreach( $aValue as $sKey=>$sValue )
		{
			if( is_array( $vDefault ) )
			{
				$sSelected	= ( in_array( $sKey, $vDefault ) ? " checked='checked'" : "" );
			}
			else
			{
				$sSelected	= ( $sKey == $vDefault ? " checked='checked'" : "" );
			}
		
			$sOutput		.= "<p class='" . $sClass . "'><input type='checkbox' name='" . $sName . $sSuffix . "'" . " value='" . $sKey . "' class='" . $sClass . "'" . $sSelected . " />" . $sValue . "</p>\n";
		}
		
		return $sOutput;
	}
	
	//	Radio tag.
	public static function radio( $sName, $aValue, $vDefault, $sClass="" )
	{
		$sOutput	 = "";
		$sSuffix	= ( sizeOf( $aValue ) > 0 ? "[]" : "" );
		
		foreach( $aValue as $sKey=>$sValue )
		{
			if( is_array( $vDefault ) )
			{
				$sSelected	= ( in_array( $sKey, $vDefault ) ? " checked='checked'" : "" );
			}
			else
			{
				$sSelected	= ( $sKey == $vDefault ? " checked='checked'" : "" );
			}
		
			$sOutput		.= "<input type='radio' name='" . $sName . $sSuffix . "'" . " value='" . $sKey . "' class='" . $sClass . "'" . $sSelected . " />&nbsp;" . $sValue . "\n";
		}
		
		return $sOutput;
	}
	
	//	Select tag.
	public static function select( $sName, $aValue, $vDefault, $sClass="" )
	{
		$sOutput	 = "";
		$sOutput	.= "<select name='" . $sName . "' id='" . $sName . "' class='" . $sClass . "'>\n";
		
		foreach( $aValue as $sKey=>$sValue )
		{
			if( is_array( $vDefault ) )
			{
				$sSelected	= ( in_array( $sKey, $vDefault ) ? " selected='selected'" : "" );
			}
			else
			{
				$sSelected	= ( strtolower( trim( $sKey ) ) == strtolower( trim( $vDefault ) ) ? " selected='selected'" : "" );
			}

			$sOutput		.= "	<option value='" . $sKey . "'" . $sSelected . ">" . $sValue . "</option>\n";
		}
		
		$sOutput		.= "</select>\n";
		
		return $sOutput;
	}
	
	//	Button
	public static function button( $sID, $sLabel, $sName, $sValue, $bChecked=false )
	{
		$sTpl		= '<input id="{id}" class="css-checkbox" type="checkbox" value="{value}" name="{name}"{checked}><label class="css-label" for="{id}">{label}</label>';
		$sOutput	= str_replace( "{id}",		$sID,										$sTpl );
		$sOutput	= str_replace( "{ids}",		str_replace( '.', '', $sID),				$sOutput );
		$sOutput	= str_replace( "{label}",	$sLabel,									$sOutput );
		$sOutput	= str_replace( "{name}",	$sName,										$sOutput );
		$sOutput	= str_replace( "{value}",	$sValue,									$sOutput );
		$sOutput	= str_replace( "{checked}",	( $bChecked ? ' checked="checked"' : "" ),	$sOutput );
		
		return	$sOutput;
	}
	
	//	Check the checkboxes
	public static function makeCheckBoxButton( $sID, $sName, $bChecked, $sLabel )
	{
		$sChecked	= ( $bCheck )	? ' checked="checked"' : "";
		$sTmp		= '<input type="checkbox" id="' . $sID . '"' . $sName  . '[]" value="' . $sID . '" class="checkbox"' . $sChecked . ' /><label class="checkedLabel" for="' . $sID . '">' . $sLabel . '</label>' . PHP_EOL;
		
		return $sTmp;
	}
	
	
	//--------------------------------------------------------------------------------
	//	Session Manager.
	//--------------------------------------------------------------------------------
	public static function sessionAvailable( $sKey )
	{
		return ( isset( $_SESSION[ $sKey ] ) && !empty( $_SESSION[ $sKey ] ) );
	}
	
	public static function sessionRead( $sKey )
	{
		return $_SESSION[ $sKey ];
	}
	
	public static function sessionWrite( $sKey, $vValue )
	{
		$_SESSION[ $sKey ]	= $vValue;
	}
	
	
	//--------------------------------------------------------------------------------
	//	Formatting.
	//--------------------------------------------------------------------------------
	//	Format for money.
	public static function formatMoney( $vValue, $nDecimal="", $sDecimal=",", $sThousend=".", $sSymbol="", $bSymbolBefore=true )
	{
		self::_instanciate();
		
		if( isset( self::$_aConfiguration[ 'language' ][ 'supported' ] ) )
		{
			$aTmp				= explode( '|', self::$_aConfiguration[ 'currency' ][ self::$_aConfiguration[ "currency" ][ "base" ] ] );
			$nTmpDecimal		= $aTmp[2];
			$sTmpDecimal		= $aTmp[1];
			$sTmpThousend		= $aTmp[0];
			$sTmpSymbol			= $aTmp[4];
			$bTmpSymbolBefore	= ( $aTmp[3] == 'before' ) ? true : false;
		}
		else
		{
			$nTmpDecimal		= 0;
			$sTmpDecimal		= '.';
			$sTmpThousend		= ',';
			$sTmpSymbol			= '&euro;';
			$bTmpSymbolBefore	= true;
		}
		
		$nDecimal	= ( empty( $nDecimal ) )	? $nTmpDecimal	: $nDecimal;
		$sDecimal	= ( empty( $sDecimal ) )	? $nTmpDecimal	: $sDecimal;
		$sThousend	= ( empty( $sThousend ) )	? $sTmpThousend	: $sThousend;
		$sSymbol	= ( empty( $sSymbol ) )		? $sTmpSymbol	: $sSymbol;
		
		if( $bSymbolBefore )
		{
			return  $sSymbol . number_format( (float)$vValue, $nDecimal, $sDecimal, $sThousend );
		}
		else
		{
			return number_format( (float)$vValue, $nDecimal, $sDecimal, $sThousend ) .  $sSymbol;
		}
	}
	
	//	Format a number.
	public static function formatNumber( $vValue, $nDecimal="", $sDecimal=",", $sThousend="." )
	{
		self::_instanciate();

		if( isset( self::$_aConfiguration[ 'currency' ] ) )
		{
			$aTmp				= explode( '|', self::$_aConfiguration[ 'currency' ][ self::$_aConfiguration[ "currency" ][ "base" ] ] );
			$nTmpDecimal		= $aTmp[2];
			$sTmpDecimal		= $aTmp[1];
			$sTmpThousend		= $aTmp[0];
			$sTmpSymbol			= $aTmp[4];
			$bTmpSymbolBefore	= ( $aTmp[3] == 'before' ) ? true : false;
		}
		else
		{
			$nTmpDecimal		= 0;
			$sTmpDecimal		= '.';
			$sTmpThousend		= ',';
			$sTmpSymbol			= '&euro;';
			$bTmpSymbolBefore	= true;
		}
		
		$nDecimal	= ( empty( $nDecimal ) )	? $nTmpDecimal	: $nDecimal;
		$sDecimal	= ( empty( $sDecimal ) )	? $nTmpDecimal	: $sDecimal;
		$sThousend	= ( empty( $sThousend ) )	? $sTmpThousend	: $sThousend;
		$sSymbol	= ( empty( $sSymbol ) )		? $sTmpSymbol	: $sSymbol;
		
		return  number_format( (float)$vValue, $nDecimal, $sDecimal, $sThousend );
	}
	
	public static function formatYesNo( $vValue )
	{
		return ( $vValue == 1 ? '{translate.general.yes}' : '{translate.general.no}' );		
	}
	
	//--------------------------------------------------------------------------------
	//	Date Manipulation.
	//--------------------------------------------------------------------------------
	//	Add or subtract a number of days from either a given date/time or by default now.
	public static function dateAdjust( $sDate="", $sType="day", $nValue=-1 )
	{
		$sDate	= ( strlen( $sDate ) == 0 ? date( "Y:m:d H:i:s" ) : $sDate );
		$sType	= strtolower( $sType );
					
		if( in_array( $sType, array( "day", "week", "month", "year" ) ) )
		{
			return date( 'Y-m-d H:i:s', strtotime( $nValue . " " . $sType , strtotime ( $sDate ) ) );
		}
		else
		{
			return date( 'Y-m-d H:i:s', strtotime( $sDate ) );
		}
	}
	
	//--------------------------------------------------------------------------------
	//	String Manipulation.
	//--------------------------------------------------------------------------------
	//	Unicode Split.
	public static function substr_unicode( $str, $s, $l=null )
	{
    	return join( "", array_slice( preg_split( "//u", $str, -1, PREG_SPLIT_NO_EMPTY ), $s, $l ) );
	}
	
	//	String to associative array.
	public static function strAssociativeArray( $sText, $sDelimiter, $sSplit )
	{
		$aNew		= array();
		$aOriginal	= explode( $sDelimiter, $sText );
		
		foreach( $aOriginal as $sTmp )
		{
			$aTmp	= explode( $sSplit, $sTmp );
			$aNew[ $aTmp[ 0 ] ]	= $aTmp[ 1 ];
		}
		
		return $aNew;
	}
	
	//	Shink some text
	public static function shrink( $sText )
	{
		try
		{
			self::_instanciate();
			
			$nCount	= self::$_aConfiguration[ 'display' ][ 'abstract_maximum' ];

			return substr( $sText, 0, $nCount ) . ' ...';
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	//  Remove tabs, line breaks, and white space
	public static function compressHTML( $sCode )
	{
		$aSearch	= array( '�<!--.*?-->�s', '/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s' );
		$aReplace	= array( '', '>', '<', '\\1' );
		
		return preg_replace( $aSearch, $aReplace, $sCode );
	}
	
	//	Normalise the characters.
	public static function normalise( $sText )
	{
		$sReplace	= '';
		$sString	= @iconv( 'UTF-8', 'ASCII//TRANSLIT', $sText );
		$nCounter	= 0;
		
		for( $nIndex = 0; $nIndex < strlen( $sString ); $nIndex++ )
		{
			$sChr1	= $sString[ $nIndex ];
			$sChr2	= @mb_substr( $sText, $nCounter++, 1, 'UTF-8' );
			
			if( strstr('`^~\'"', $sChr1 ) !== false )
			{
				if( $sChr1 <> $sChr2 )
				{
					--$nCounter;
					continue;
				}
			}
			
			$sReplace	.= ( $sChr1 == '?' ? $sChr2 : $sChr1 );
		}
		
		return $sReplace;
	}
	
	public static function lineBreak( $sText )
	{
		$sText	= str_replace( "\r\n", "\n", $sText );
		$sText	= str_replace( "\r", "\n", $sText );
		$sText	= preg_replace( "/\n{2,}/", "\n\n", $sText );
		
		return $sText;
	}
	
	public static function unaccent( $sText )
	{
		return preg_replace( '~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities( $sText, ENT_QUOTES, 'UTF-8' ) );
	}
	
	public static function createMethodName( $sText, $sDelimiter='.' )
	{
		$aTmp	= array();
		
		foreach( explode( $sDelimiter, $sText ) as $sTmp )
		{
			$aTmp[]	= ucfirst( $sTmp );
		}
		
		return lcfirst( implode( '', $aTmp ) );
	}
	
	
	//--------------------------------------------------------------------------------
	//	Serialise, Unzip, etc.
	//--------------------------------------------------------------------------------
	public static function serialise( $aValue )
	{
		return serialize( $aValue );
	}
	
	public static function unserialise( $sValue )
	{
		return unserialize( $sValue );
	}
	
	public static function unzip( $sFolder, $sFile )
	{
		try
		{
			$sFolder	= $sFolder;
			
			if( class_exists( 'ZipArchive' ) )
			{
				$oZip		= new ZipArchive;
				$bResponse	= $oZip->open( $sFolder . $sFile );

				if( $bResponse === true )
				{
					$oZip->extractTo( $sFolder );
					$oZip->close();

					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				throw new Exception( "Error: Zip Archive is not installed" );
				return false;
			}
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	//--------------------------------------------------------------------------------
	//	Encryption.
	//--------------------------------------------------------------------------------
	//	Encrypt a string.
	public static function encrypt( $sString, $sKey='' ) 
	{
		$nIvSize	= mcrypt_get_iv_size( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC );
		$sIv		= mcrypt_create_iv( $nIvSize, MCRYPT_RAND );
		$sText		= utf8_encode( $sString );

		$sText		= mcrypt_encrypt( MCRYPT_RIJNDAEL_128, $sKey, $sText, MCRYPT_MODE_CBC, $sIv );
		$sText		= $sIv . $sText;

		return base64_encode( $sText );
	}
	
	//	Decrypt a string.
	public static function decrypt( $sString, $sKey='' ) 
	{
		try
		{
			$nIvSize	= mcrypt_get_iv_size( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC );
			$sIv		= mcrypt_create_iv( $nIvSize, MCRYPT_RAND );
			$sText		= base64_decode( $sString );
			$sIvDec 	= substr( $sText, 0, $nIvSize );
			$sText		= substr( $sText, $nIvSize );
			
			return mcrypt_decrypt( MCRYPT_RIJNDAEL_128, $sKey, $sText, MCRYPT_MODE_CBC, $sIvDec );
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
    }
	
	//--------------------------------------------------------------------------------
	//	File Handler.
	//--------------------------------------------------------------------------------
	public static function getBlock( $sName, $sExtension='code' )
	{
		try
		{
			self::_instanciate();

			if( strlen( $sName ) > 0 )
			{
				$sFile	= FS_ROOT . self::$_aConfiguration[ 'folder' ][ 'block' ] . $sName . "." . $sExtension;

				if( file_exists( $sFile ) )
				{
					return file_get_contents( $sFile );
				}
				else
				{
					return "";
				}
			}
			else
			{
				throw new Exception( "No block name." );
			}
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	public static function getFragment( $sName, $sExtension='html' )
	{
		return self::getBlock( $sName, $sExtension );
	}
	
	public static function widget( $sContent )
	{
		$aResult		= array();

		preg_match_all( "/({widget.)(\w.*)(})/ismU", $sContent, $aPatterns );
		array_push( $aResult, $aPatterns[ 2 ] );
		array_push( $aResult, count( $aPatterns[ 2 ] ) - 1 );

		for( $nIndex=0; $nIndex<=(int)$aResult[1]; $nIndex++ )
		{
			$sKey		= strtolower( trim( (string)$aResult[0][ $nIndex ] ) );
			$sContent	= str_replace( strtolower( "{widget." . $sKey . "}" ), q23helper::getBlock( $sKey ), $sContent );

			unset( $aResult[0][ $nIndex ] );
		}

		return $sContent;
	}
	
	public static function writeLog( $sLog, $sText )
	{
		try
		{
			self::_instanciate();
			
			$sFile	= FS_FOLDER_DT_LG . $sLog . ".log";
			$hFile	= q23helper::fileOpen( $sFile, 'a' );
			
			q23helper::fileWrite( $hFile, "[" . date( "Y-m-d H:i:s" ) . " " . self::getIpAddress() . "] " . $sText );
			q23helper::fileClose( $hFile );
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}

		return true;
	}
	
	public static function writeFile( $sFile, $sText )
	{
		try
		{
			$hFile	= q23helper::fileOpen( $sFile, 'w' );
			
			q23helper::fileWrite( $hFile, $sText );
			q23helper::fileClose( $hFile );
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}

		return true;
	}
	
	public static function fileMove( $sSource, $sDestination )
	{
		rename( $sSource, $sDestination );
	}
	
	public static function fileOpen( $sFile, $sMode )
	{
		try
		{
			$hFile	= fopen( $sFile, $sMode );
		}
		catch( Exception $e )
		{
			throw new Exception( "Unable to open file: " . $sFile );
		}
		
		return $hFile;
	}
	
	public static function fileRead( $sFile )
	{
		try
		{
			$sFile	= FS_ROOT . $sFile;
			$hFile	= q23helper::fileOpen( $sFile, 'r' );
			$sText	= fread( $hFile, filesize( $sFile ) );

			q23helper::fileClose( $hFile );
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}

		return $sText;
	}
	
	public static function fileWrite( $hFile, $sText )
	{
		fwrite( $hFile, $sText . "\n" );
	}
	
	public static function fileClose( $hFile )
	{
		fclose( $hFile );
	}
	
	public static function readIniFile( $sFileName )
	{
		return parse_ini_file( FS_ROOT . $sFileName, true );
	}
	
	public static function rCopy( $sSource, $sDestination )
	{ 
		$sFolder	= opendir( $sSource );
		
		@mkdir( $sDestination );
		
		while( false !== ( $sFile = readdir( $sFolder ) ) )
		{
			if( ( $sFile != '.' ) && ( $sFile != '..' ) )
			{
				if( is_dir( $sSource . '/' . $sFile ) )
				{
					rCopy( $sSource . '/' . $sFile, $sDestination . '/' . $sFile );
				} 
				else
				{
					copy( $sSource . '/' . $sFile, $sDestination . '/' . $sFile );
				}
			}
		}
		
		closedir( $sFolder );
	} 
	
	public static function tail( $sFile, $nLine=50 )
	{
		$sText		= "";
		$hFile		= fopen( FS_ROOT . $sFile, "r" );
		$nCounter	= $nLine;
		$nPosition	= -2;
		$bBeginning = false;
		$aText		= array();
		
		while( $nCounter > 0 ) 
		{
			$t	= " ";
			
			while( $t != "\n" ) 
			{
				if( fseek( $hFile, $nPosition, SEEK_END ) == -1 ) 
				{
					$bBeginning	= true;
					
					break;
				}
				
				$t	= fgetc( $hFile );
				
				$nPosition--;
			}
			
			$nCounter--;
			
			if( $bBeginning ) 
			{
				rewind( $hFile );
			}
			
			$aText[ $nLine - $nCounter - 1]	= fgets( $hFile );
			
			if( $bBeginning )
			{
				break;
			}
		}
		
		fclose( $hFile );
		
		array_reverse( $aText );
		
		foreach( $aText as $sLine ) 
		{
			$sText	.= $sLine . "<br />";
		}
		
		return $sText;
	}
	
	//--------------------------------------------------------------------------------
	//	Mailing.
	//--------------------------------------------------------------------------------
	public static function send( $sEmail, $sName, $sSubject, $sBody, $nDebug=1 )
	{
		try
		{
			self::_instanciate();
			
			$oMail	= new PHPMailer();
			
			$oMail->IsSMTP();
			$oMail->SMTPDebug	= $nDebug;
			$oMail->SMTPAuth	= true;
			
//			$oMail->SMTPSecure	= 'ssl';
			$oMail->Port		= 25;
			$oMail->Host		= self::$_aConfiguration[ 'mail' ][ 'host' ];
			$oMail->Username	= self::$_aConfiguration[ 'mail' ][ 'usr' ];
			$oMail->Password	= self::$_aConfiguration[ 'mail' ][ 'pwd' ];
			$oMail->CharSet		= self::$_aConfiguration[ 'mail' ][ 'chrctr' ];
			$oMail->AltBody		= "To view the message, please use an HTML compatible email application!";
			
			$oMail->IsHTML( true );
			$oMail->SetFrom( self::$_aConfiguration[ 'company' ][ 'site.email.address' ], self::$_aConfiguration[ 'company' ][ 'site.email.name' ] );
			$oMail->AddReplyTo( self::$_aConfiguration[ 'company' ][ 'site.email.address' ], self::$_aConfiguration[ 'company' ][ 'site.email.name' ] );
			$oMail->AddAddress( $sEmail, $sName );
			
			$oMail->Subject		= '=?UTF-8?B?' . base64_encode( $sSubject ) . '?=';
			
			$oMail->MsgHTML( $sBody );
			
			$bResult			= $oMail->send();

			if( $nDebug > 0 || $bResult == false )
			{
				$sTmp	 = "Message Send Failure:" . PHP_EOL;
				$sTmp	.= "-> Start Debug." . PHP_EOL;
				$sTmp	.= "--> SMTP Host: "		. self::$_aConfiguration[ 'mail' ][ 'host' ]					. PHP_EOL;
				$sTmp	.= "--> SMTP Usr: "			. self::$_aConfiguration[ 'mail' ][ 'usr' ]						. PHP_EOL;
				$sTmp	.= "--> SMTP Pwd: "			. self::$_aConfiguration[ 'mail' ][ 'pwd' ]						. PHP_EOL;
				$sTmp	.= "--> Company Email: "	. self::$_aConfiguration[ 'company' ][ 'site.email.address' ]	. PHP_EOL;
				$sTmp	.= "--> Company Name: "		. self::$_aConfiguration[ 'company' ][ 'site.email.name' ]		. PHP_EOL;
				$sTmp	.= "--> Recipient Email: "	. $sEmail														. PHP_EOL;
				$sTmp	.= "--> Recipient Name: "	. $sName														. PHP_EOL;
				$sTmp	.= "-> Terminate Debug." . PHP_EOL;
				
				q23helper::writeLog( LOG_FILE_EMAIL, $sTmp );
				q23helper::writeLog( LOG_FILE_EMAIL, $oMail->ErrorInfo );
			}
	
			return $bResult;
		}
		catch( phpmailerException $e )
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
		catch( Exception $e)
		{
			q23helper::exceptionHandler( $e );
			return false;
		}
	}
	
	
	//--------------------------------------------------------------------------------
	//	Product Licencing.
	//--------------------------------------------------------------------------------
	public static function samedi()
	{
		global	$g_aCfg;
		
		$nDifference	= (integer)( ( strtotime( date( "Y-m-d H:i:s" ) ) - strtotime( $g_aCfg[ "update" ][ "ip.address" ] ) ) / ( 60 * 60 ) );
		
		if( $nDifference > 24 )
		{
			q23helper::juju();
		}
	}
	
	//	Check Method.
	public static function juju( $method='' )
	{
		global	$g_aCfg;
//		global	$g_aToken;
		
		//  Test server domain.
		if( !isset( $_SERVER[ "HTTP_HOST" ] ) || !in_array( $_SERVER[ "HTTP_HOST" ], $g_aCfg[ 'juju' ][ 'domain' ] ) )
		{
			header( $_SERVER[ "SERVER_PROTOCOL"] . ' 400 Bad Request' );
			die( "<center><h1>This domain is not supported</h1><h2>Please contact you software provider</h2></center>" );
		}

		//  Test server IP address.
		//  TODO: expire if wrong IP address.

		//  Test the expiry data.
		$nSecond  = strtotime( $g_aCfg[ 'juju' ][ 'expiry' ] ) - strtotime( date( "Y-m-d H:i:s" ) );

		if( $nSecond <= 0 )
		{
			header( $_SERVER[ "SERVER_PROTOCOL"] . ' 400 Bad Request' );
			die( "<center><h1>This application has expired</h1><h2>Please contact you software provider</h2></center>" );
		}

		//  Test the method.
		if( strlen( $method ) > 0 )
		{
			if( !in_array( $method, $g_aCfg[ 'juju' ][ 'method' ] ) )
			{
				return $g_aCfg[ 'juju' ][ 'method' ];
			}
			else
			{
				die( "<center><h1>Not set: " . $method . "</h1><h2>Please contact you software provider</h2></center>" );
				return false;
			}
		}
	}
	
	
	//--------------------------------------------------------------------------------
	//	Image manipulation.
	//--------------------------------------------------------------------------------
	//	Compress Image
	public static function imageCompress( $sSource, $sDestination, $nQuality=80, $sOutput='png', $nCompression=5 )
	{
		try 
		{
			$sSource		= FS_ROOT . $sSource;
			$sDestination	= FS_ROOT . $sDestination;
			$aInformation	= getimagesize( $sSource );
		  
		    if( $aInformation[ 'mime' ] == 'image/jpeg' ) 
		    {
		        $oImage	= imagecreatefromjpeg( $sSource );
		    }
		    elseif( $aInformation[ 'mime' ] == 'image/gif' ) 
		    {
		        $oImage	= imagecreatefromgif( $sSource );
		    }
		    elseif( $aInformation[ 'mime' ] == 'image/png' )
		    {
		        $oImage	= imagecreatefrompng( $sSource );
		    }
		    else
		    {
				throw new fsException( 'Unknown image file format' );
		    }
		  
		    if( $sOutput == 'png' )
			{
				imagepng( $oImage, $sDestination, $nCompression );
			}
			else
			{
				imagejpeg( $oImage, $sDestination, $nQuality );
			}
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
		}
		
		return $sDestination;
	}
	
	public static function imageResize( $sFile, $nWidthTarget, $nHeightTarget, $bCrop=false )
	{
	    list( $nWidth, $nHeight )	= getimagesize( $sFile );
	    $aInformation				= getimagesize( $sFile );
	    $nRatio						= $nWidth / $nHeight;
	    $aFile						= pathinfo( $sFile );
	    
	    if( $bCrop )
	    {
	        if( $nWidth > $nHeight )
	        {
	            $nWidth		= ceil( $nWidth - ( $nWidth * abs( $nRatio - $nWidthTarget / $nHeightTarget ) ) );
	        }
	        else
	        {
	            $nHeight	= ceil( $nHeight - ( $nHeight * abs( $nRatio - $nWidthTarget / $nHeightTarget ) ) );
	        }
	        
	        $nWidthNew	= $nWidthTarget;
	        $nHeightNew	= $nHeightTarget;
	    }
	    else
	    {
	        if( $nWidthTarget / $nHeightTarget > $nRatio )
	        {
	            $nWidthNew	= $nHeightTarget * $nRatio;
	            $nHeightNew	= $nHeightTarget;
	        }
	        else
	        {
	            $nHeightNew	= $nWidthTarget / $nRatio;
	            $nWidthNew	= $nWidthTarget;
	        }
	    }
	    
	    $oTarget	= imagecreatetruecolor( $nWidthNew, $nHeightNew );
	    
	    switch( $aInformation[ 'mime' ] )
	    {
			case 'image/jpeg':
				$oImage		= imagecreatefromjpeg( $sFile );
				
				imagecopyresampled( $oTarget, $oImage, 0, 0, 0, 0, $nWidthNew, $nHeightNew, $nWidth, $nHeight );
				
				$bResult	= imagejpeg( $oTarget, $sFile );
				break;
				
			case 'image/gif':
				$oImage		= imagecreatefromgif( $sFile );
				
				imagecopyresampled( $oTarget, $oImage, 0, 0, 0, 0, $nWidthNew, $nHeightNew, $nWidth, $nHeight );
				
				$bResult	= imagegif( $oTarget, $sFile );
				break;
			
			case 'image/png':
				$oImage		= imagecreatefrompng( $sFile );
				
				imagecopyresampled( $oTarget, $oImage, 0, 0, 0, 0, $nWidthNew, $nHeightNew, $nWidth, $nHeight );
				
				$bResult	= imagepng( $oTarget, $sFile );
				break;
			
			default:
				throw new fsException( 'Unknown image file format' );
				break;
		}
	    
	    imagedestroy( $oTarget );
		
	    return $bResult;
	}
	
	
	//--------------------------------------------------------------------------------
	//	Idiomas
	//--------------------------------------------------------------------------------
	public static function alternativeLanguages( $sLanguageCurrent, $aCfg, $sURL )
	{
		$sTmp	= "";

		foreach( $aCfg[ "language" ][ "supported" ] as $sKey=>$aData )
		{
			if( $sKey != $sLanguageCurrent  )
			{
				$sTmp	.= '		<link rel="alternate" xhreflang="' . $sKey . '" href="http://' . DOMAIN . $sURL . '" />' . PHP_EOL;
				$sTmp	 = str_replace( "{variable.language}", $sKey, $sTmp );
			}
		}
		
		return rtrim( $sTmp, PHP_EOL );
	}
	
	public static function ogAlternativeLanguages( $sLanguageCurrent, $aCfg )
	{
		$sTmp	= "";

		foreach( $aCfg[ "language" ][ "supported" ] as $sKey=>$aData )
		{
			if( $sKey != $sLanguageCurrent  )
			{
				$sTmp	.= '		<meta property="og:locale:alternate" content="' . $aData[ "locale" ] . '" />' . PHP_EOL;
			}
		}
		
		return rtrim( $sTmp, PHP_EOL );
	}
	
	//--------------------------------------------------------------------------------
	//	Remote methods.
	//--------------------------------------------------------------------------------
	//	Retrieve a remote file.
	public static function getRemoteFile( $sURL, $sFile )
	{
		$hFile	= fopen( $sFile, 'w' );
		$hCurl	= curl_init( $sURL );

		curl_setopt( $hCurl, CURLOPT_FILE, $hFile );

		$data = curl_exec(  $hCurl );

		curl_close( $hCurl );
		fclose( $hFile );

	}
	
	//	Retrieve a remote file in memory.
	public static function remoteResponse( $sURL, $nTimeOut=10 )
	{
		//	Setup headers - I used the same headers from Firefox version 2.0.0.6
		$aHeader[0]	 = "Accept: text/xml,application/xml,application/xhtml+xml,";
		$aHeader[0]	.= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
		$aHeader[]	 = "Cache-Control: max-age=0";
		$aHeader[]	 = "Connection: keep-alive";
		$aHeader[]	 = "Keep-Alive: 300";
		$aHeader[]	 = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$aHeader[]	 = "Accept-Language: en-us,en;q=0.5";
		$aHeader[]	 = "Pragma: ";

		$hCurl		 = curl_init();

		curl_setopt( $hCurl, CURLOPT_URL,				$sURL );
		curl_setopt( $hCurl, CURLOPT_HTTPHEADER,		$aHeader );
		curl_setopt( $hCurl, CURLOPT_CONNECTTIMEOUT,	$nTimeOut );
		curl_setopt( $hCurl, CURLOPT_RETURNTRANSFER,	1 );
		
		$sBuffer	 = curl_exec(  $hCurl );
		$nHttpCode	 = curl_getinfo( $hCurl, CURLINFO_HTTP_CODE );
		
		curl_close( $hCurl);
		
		return array( "text"=>$sBuffer, "code"=>$nHttpCode );
	}
	
	public static function httpResponse( $url, $status = null, $wait = 3)
	{
		$time = microtime(true);
		$expire = $time + $wait;

		// we fork the process so we don't have to wait for a timeout
		$pid = pcntl_fork();
		
		if ($pid == -1) 
		{
			die('could not fork');
		}
		else if ($pid)
		{
			// we are the parent
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, TRUE);
			curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$head = curl_exec($ch);
			
			curl_close($ch);
			
			if(!$head)
			{
				return FALSE;
			}
			
			if($status === null)
			{
				if($httpCode < 400)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			elseif($status == $httpCode)
			{
				return TRUE;
			}
		
			return FALSE;
			
			pcntl_wait($status); //Protect against Zombie children
		}
		else
		{
			// we are the child
			while( microtime( true ) < $expire )
			{
				sleep(0.5);
			}
			
			return FALSE;
		}
	}
	
	//--------------------------------------------------------------------------------
	//	IP's, domains, uri's, etc.
	//--------------------------------------------------------------------------------
	public static function getIpAddress()
	{
		if( !empty( $_SERVER[ 'HTTP_CLIENT_IP' ] ) )
		{
			$sIP	= $_SERVER[ 'HTTP_CLIENT_IP' ];
		}
		elseif( !empty( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) )
		{
			$sIP	= $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
		}
		else
		{
			$sIP	= ( isset( $_SERVER[ 'REMOTE_ADDR' ] ) ) ? $_SERVER[ 'REMOTE_ADDR' ] : "000.000.000.000";
		}
		
		return $sIP;
	}
	
	public static function getDomain( $sURL="" )
	{
		$sURL		= ( strlen( $sURL ) > 0 ? $sURL : self::getCurrentPageURL() );
		$sTmp		= str_replace( 'www.', '', $sURL );
		$sDomain	= parse_url( $sTmp );
		
		return ( !empty( $sDomain[ "host" ] ) ? $sDomain[ "host" ] : $sDomain[ "path" ] );
	}
	
	public static function getCurrentPageURL() 
	{
		$sPageURL	= 'http';
		
		if( isset( $_SERVER[ "HTTPS" ] ) )
		{
			if( $_SERVER[ "HTTPS" ] == "on" )
			{
				$sPageURL	.= "s";
			}
		}
		
		$sPageURL	.= "://";
		
		if( $_SERVER[ "SERVER_PORT" ] != "80" )
		{
			$sPageURL	.= $_SERVER[ "SERVER_NAME" ] . ":" . $_SERVER[ "SERVER_PORT" ] . $_SERVER[ "REQUEST_URI" ];
		}
		else
		{
			$sPageURL	.= $_SERVER[ "SERVER_NAME" ] . $_SERVER[ "REQUEST_URI" ];
		}
		
		return $sPageURL;
	}
	
	//	Get the browser information.
	public static function getBrowser()
	{
		$sUserAgent		= $_SERVER[ 'HTTP_USER_AGENT' ];
		$sBrowserName	= 'Unknown';
		$sPlatform		= 'Unknown';
		$sVersion		= "";
	
		//	Get the platform?
		if( preg_match( '/linux/i', $sUserAgent ) )
		{
			$sPlatform	= 'linux';
		}
		elseif( preg_match( '/macintosh|mac os x/i', $sUserAgent ) )
		{
			$sPlatform	= 'mac';
		}
		elseif( preg_match( '/windows|win32/i', $sUserAgent ) )
		{
			$sPlatform	= 'windows';
		}
	
		//	Get the useragent.
		if( preg_match( '/MSIE/i', $sUserAgent ) && !preg_match( '/Opera/i', $sUserAgent ) )
		{
			$sBrowserName	= 'Internet Explorer';
			$sBrowserCode	= "MSIE";
		}
		elseif( preg_match( '/Firefox/i', $sUserAgent ) )
		{
			$sBrowserName	= 'Mozilla Firefox';
			$sBrowserCode	= "Firefox";
		}
		elseif( preg_match( '/Chrome/i', $sUserAgent ) )
		{
			$sBrowserName	= 'Google Chrome';
			$sBrowserCode	= "Chrome";
		}
		elseif( preg_match( '/Safari/i', $sUserAgent ) )
		{
			$sBrowserName	= 'Apple Safari';
			$sBrowserCode	= "Safari";
		}
		elseif( preg_match( '/Opera/i', $sUserAgent ) )
		{
			$sBrowserName	= 'Opera';
			$sBrowserCode	= "Opera";
		}
		elseif( preg_match( '/Netscape/i', $sUserAgent ) )
		{
			$sBrowserName	= 'Netscape';
			$sBrowserCode	= "Netscape";
		}
	
		//	Get the correct version number
		$aKnown		= array( 'Version', $sBrowserCode, 'other' );
		$vPattern	= '#(?<browser>' . join( '|', $aKnown ) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		
		if( !preg_match_all( $vPattern, $sUserAgent, $aMatches ) )
		{
			// we have no matching number just continue
		}
	
		//	See how many we have
		$nIndex	= count( $aMatches[ 'browser' ] );
		
		if( $nIndex != 1 )
		{
			//	we will have two since we are not using 'other' argument yet see if version is before or after the name
			if( strripos( $sUserAgent, "Version" ) < strripos( $sUserAgent, $sBrowserCode ) )
			{
				$sVersion	= $aMatches[ 'version' ][0];
			}
			else
			{
				$sVersion	= $aMatches[ 'version' ][1];
			}
		}
		else
		{
			$sVersion	= $aMatches[ 'version' ][0];
		}
	
		//	Check if we have a number.
		if( $sVersion == null || $sVersion == "" )
		{
			$sVersion	= "?";
		}
	
		return array(	'userAgent'	=> $sUserAgent,
						'name'		=> $sBrowserName,
						'version'	=> $sVersion,
						'platform'	=> ucwords( $sPlatform ),
						'pattern'	=> $vPattern );
	}
	
	
	//--------------------------------------------------------------------------------
	//	Worker Methods.
	//--------------------------------------------------------------------------------
	private static function _instanciate()
	{
		global	$g_aCfg;
		global	$g_oDB; 
		global	$g_oTranslate;
		
		self::$_aConfiguration	= $g_aCfg;
		self::$_oDB				= Xcrud::get_instance();
		self::$_oLanguage		= $g_oTranslate;
	}
	
	public static function writeMessage( $sText )
	{
		echo $sText . "<br />";
	}
	
	public static function showConstant()
	{
		$aConstant	= get_defined_constants( true );

		echo "<pre>"; 
		
		print_r( var_export( $aConstant[ 'user' ], true ) ); 
		
		echo "</pre>";
	}
	
	public static function showVariable( $vValue )
	{
		echo "<pre>";
		print_r( $vValue );
		echo "</pre>";
	}
	
	public static function errorHandler( $code, $message, $file, $line )
	{
		if( 0 == error_reporting() )
		{
			return;
		}
		
		throw new ErrorException( $message, 0, $code, $file, $line );
	}

	public static function exceptionHandler( $e )
	{
		$sOutput	= $e->getMessage() . " (" . $e->getLine() . ")<pre>" . $e->getTraceAsString() . "</pre>";

		while( $e = $e->getPrevious() )  
		{
			$sOutput	.= "Caused by: " . get_class( $e ) . " '" . $e->message . "' in " . $e->file . "(" . $e->line . ")\n" . $e->getTraceAsString();
		}
		
		q23helper::writeLog( LOG_FILE_ERROR, "\n" . $sOutput );
		
		echo $sOutput;
		
		return;
	}
	
	public static function buildWebsiteBreadCrumb( $aData, $sDelimiter="&nbsp;/&nbsp;" )
	{
		$aOutput	= array();
		$sOutput	= '';
		$sTpl		= '<li class="active"><a href="{url}">{title}</a></li>';
		$sTpl		= '<a href="{url}">{title}</a>';
		
		foreach( $aData as $sTitle=>$sURL )
		{
			if( strlen( $sURL ) > 0 )
			{
//				$sOutput	.= str_replace( array( '{title}', '{url}' ), array( $sTitle, $sURL ), $sTpl );
				$aOutput[]	 = str_replace( array( '{title}', '{url}' ), array( $sTitle, $sURL ), $sTpl );
			}
			else
			{
//				$sOutput	.= '<li class="active">' . $sTitle . "</li>";
				$aOutput[]	 = $sTitle;
			}
		}
		
		return implode( $sDelimiter, $aOutput );
	}
	
	public static function buildBreadCrumb( $aData )
	{
		$sOutput	= '';
		$sTpl		= '<li class="active"><a href="/{variable.language}/adm/{url}/">{title}</a></li>';
		
		foreach( $aData as $sTitle=>$sURL )
		{
			if( strlen( $sURL ) > 0 )
			{
				$sOutput	.= str_replace( array( '{title}', '{url}' ), array( $sTitle, $sURL ), $sTpl );
			}
			else
			{
				$sOutput	.= '<li class="active">' . $sTitle . "</li>";
			}
		}
		
		$sOutput	= str_replace( '//', '/', $sOutput );
		
		return $sOutput;
	}
	
	public static function jsMenuBuilder( $a )
	{
		$sTmp	= '';
		
		foreach( $a as $s )
		{
			$sTmp	.= '$( "#' . $s . '" ).addClass( "active" ).addClass( "open" );';
		}
		
		return $sTmp;
	}
	
	public static function assembleMenu( $aUsr )
	{
		global $g_aCfg;
		
		$sOutput	= file_get_contents( FS_ROOT . "/thm/adm/tpl/widget.navigation.dashboard.html" );
//		
//		if( $aUsr[ 'usrZone' ][ 'lst' ] > 0 )
//		{
//			$sOutput	.= file_get_contents( FS_ROOT . "/thm/adm/tpl/widget.navigation.listing.html" );
//		}
//		
		if( $aUsr[ 'usrZone' ][ 'slm' ] > 0 )
		{
			$sOutput	.= file_get_contents( FS_ROOT . "/thm/adm/tpl/widget.navigation.lead.html" );
		}
		
//		if( $aUsr[ 'usrZone' ][ 'cntnt' ] > 0 )
//		{
//			$sOutput	.= file_get_contents( FS_ROOT . "/thm/adm/tpl/widget.navigation.content.html" );
//		}
		
		if( $aUsr[ 'usrZone' ][ 'sttst' ] > 0 )
		{
			$sOutput	.= file_get_contents( FS_ROOT . "/thm/adm/tpl/widget.navigation.statistic.html" );
		}
		
		if( $aUsr[ 'usrZone' ][ 'actn' ] > 0 )
		{
			$sOutput	.= file_get_contents( FS_ROOT . "/thm/adm/tpl/widget.navigation.action.html" );
		}
		
		if( $aUsr[ 'usrZone' ][ 'sttng' ] > 0 )
		{
			$sOutput	.= file_get_contents( FS_ROOT . "/thm/adm/tpl/widget.navigation.setting.html" );
		}
		
		$sOutput	.= "					</ul>
				</div>";
		
		return $sOutput;
	}
	
	public static function xcrud( $oCRUD, $n=0 )
	{
		$oCRUD->unset_title( true );
		
		switch( $n )
		{
			case 0:		//	No Access 
				$oCRUD->unset_add( true );
				$oCRUD->unset_edit( true );
				$oCRUD->unset_view( true );
				$oCRUD->unset_remove( true );
				$oCRUD->unset_csv( true );
				$oCRUD->unset_search( true );
				$oCRUD->unset_print( true );
				$oCRUD->unset_sortable( true );
				break;
				
			case 1:		//	Subscriber
				$oCRUD->unset_add( true );
				$oCRUD->unset_edit( true );
				$oCRUD->unset_remove( true );
				$oCRUD->unset_csv( true );
				$oCRUD->unset_print( true );
				$oCRUD->unset_sortable( true );
				break;
				
			case 2:		//	Contributor
				$oCRUD->unset_edit( true );
				$oCRUD->unset_remove( true );
				$oCRUD->unset_csv( true );
				$oCRUD->unset_print( true );
				$oCRUD->unset_sortable( true );
				break;
				
			case 3:		//	Author
				$oCRUD->unset_remove( true );
				$oCRUD->unset_csv( true );
				$oCRUD->unset_print( true );
				break;
				
			case 4:		//	Editor
			case 5:
			case 6:
			case 7:
				$oCRUD->unset_csv( true );
				$oCRUD->unset_print( true );
				break;
				
			case 8:		//	Administrator
				break;
				
			case 9:		//	Super Administrator
				$oCRUD->benchmark ( true );
				break;
			
			default:
				$oCRUD->unset_add( true );
				$oCRUD->unset_edit( true );
				$oCRUD->unset_view( true );
				$oCRUD->unset_remove( true );
				$oCRUD->unset_csv( true );
				$oCRUD->unset_search( true );
				$oCRUD->unset_print( true );
				$oCRUD->unset_title( true );
				$oCRUD->unset_numbers( true );
				$oCRUD->unset_pagination( true );
				$oCRUD->unset_limitlist( true );
				$oCRUD->unset_sortable( true );
				break;
		}
	}
	
	public static function when( $sDateTime )
	{
		$dtNow	= strtotime( date( "Y:m:d H:i:s" ) );
		$dtThen	= strtotime( $sDateTime );
		
		$nSecond	= $dtNow - $dtThen;
		
		if( $nSecond < 60 )
		{
			$sOutput	= '{reword.time.just.now}';
		}
		elseif( $nSecond < ( 60 * 60 ) )
		{
			$sOutput	= (int)( $nSecond / 60 ) . ' {reword.time.minute}';
		}
		elseif( $nSecond < ( 60 * 60 * 24 ) )
		{
			$sOutput	= (int)( $nSecond / ( 60 * 60 ) ) . ' {reword.time.hour}';
		}
		else
		{
			$sOutput	= (int)( $nSecond / ( 60 * 60 * 24 ) ) . ' {reword.time.day}';
		}
		
		return $sOutput;
	}
	
	public static function getDistance( $fLatitudeFrom, $fLongitudeFrom, $fLatitudeTo, $fLongitudeTo, $nEarthRadius=6371000 )
	{
		$rLatitudeFrom	= deg2rad( $fLatitudeFrom );
		$rLongitudeFrom	= deg2rad( $fLongitudeFrom );
		$rLatitudeTo	= deg2rad( $fLatitudeTo );
		$rLongitudeTo	= deg2rad( $fLlongitudeTo );

		$rDelta			= $rLongitudeTo - $rLongitudeFrom;
		$nTmpA			= pow(cos($rLatitudeTo) * sin($rDelta), 2) + pow(cos($rLatitudeFrom) * sin($rLatitudeTo) - sin($rLatitudeFrom) * cos($rLatitudeTo) * cos($rDelta), 2);
		$nTmpB			= sin($rLatitudeFrom) * sin($rLatitudeTo) + cos($rLatitudeFrom) * cos($rLatitudeTo) * cos($rDelta);

		$fAngle			= atan2( sqrt( $nTmpA ), $nTmpB );
		
		return $fAngle * $nEarthRadius;
	}
	
	public static function snippit( $sFilename )
	{
		return file_get_contents( $sFilename );
	}
}
?>