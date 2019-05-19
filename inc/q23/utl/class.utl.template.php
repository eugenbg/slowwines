<?php
//====================================================================================
//	Class:		q23template
//	Objective:	Template engine
//	Copyright	2012 (c) Funky::Software
//	License		http://www.funky-software.net/license/1_0.txt
//	Link		http://dev.zend.com/package/PackageName
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	05-Jul-12	Andrew Makin	ICR.
//====================================================================================
class q23template
{
	//--------------------------------------------------------------------------------
	//	Class Members.
	//--------------------------------------------------------------------------------
	protected	$_skeleton			= "[+variable.{value}+]";
	protected	$_folder			= "";
	protected	$_member			= array();
	
	public		$content			= "";
	
	
	//--------------------------------------------------------------------------------
	//	Magic Methods.
	//--------------------------------------------------------------------------------
	public function __construct( $folder="" ) 
	{
		$this->_folder		= ( ( substr( $folder, -1 ) == "/" ) ? $folder : $folder . "/" );
		
//		funkyWebHelper::writeLog( LOG_FILE_ADMIN, __METHOD__, LOG_WRITER_INFORMATION );
	}
	
	public function __get( $sVariable ) 
	{
		return $this->_member[ $sVariable ];
	}
	
	public function __set( $variable, $value ) 
	{
		$this->_member[ $variable ]	= $value;
	}
	
	public function __isset( $sVariable ) 
	{
		return isset( $this->_member[ $sVariable ] );
	}
	
	
	//--------------------------------------------------------------------------------
	//	Public Methods.
	//--------------------------------------------------------------------------------
	//	Set the data items.
	public function set()
	{
		$args	= func_get_args();
		
		if( func_num_args() == 2 ) 
		{
			$this->__set( $args[0], $args[1] );
		}
		else
		{
			foreach( $args[0] as $var => $value ) 
			{
				$this->__set( $var, $value );
			}
		}
	}
	
	//	Set the member array.
	public function setMember( $aTmp )
	{
		$this->_member	= $aTmp;
	}
	
	//	Render the template with data.
	public function render( $sTemplate, $bSubsitute=true, $bAsString=true )
	{
		$this->content	= "";

		ob_start();

		if( $bSubsitute )
		{
			if( file_exists( $_SERVER[ 'DOCUMENT_ROOT' ] . $sTemplate ) )
			{
				$sContent	= file_get_contents( $_SERVER[ 'DOCUMENT_ROOT' ] . $sTemplate );
				$aResult	= array();
	
				preg_match_all( "/({variable.)(\w.*)(})/ismU", $sContent, $aPatterns );
				
				array_push( $aResult, $aPatterns[ 2 ] );
				array_push( $aResult, count( $aPatterns[ 2 ] ) );

				for( $nIndex=0; $nIndex<=sizeOf( $aResult[0] ) - 1; $nIndex++ )
				{
					if( isset( $this->_member[ $aResult[0][ $nIndex ] ] ) )
					{
						$sContent	= str_replace( "{variable." . $aResult[0][ $nIndex ] . "}", $this->_member[ $aResult[0][ $nIndex ] ], $sContent );
					}
					else
					{
						funkyHelper::writeLog( LOG_FILE_ADMIN, __METHOD__ . ": Variable not found [" .  $aResult[0][ $nIndex ] . "]", LOG_WRITER_WARNING );
					}
				}
			}
			else
			{
				funkyHelper::writeLog( LOG_FILE_ADMIN, __METHOD__ . ": Template not found [" . $_SERVER[ 'DOCUMENT_ROOT' ] . $sTemplate . "]", LOG_WRITER_WARNING );
				
				$sContent	= "";
			}
			
			$this->content	= $sContent;
		}
		else
		{
			require $this->_folder . $sTemplate . ".php";
			
			$sContent	= ob_get_clean();
		}
		
		//	Output as a string or a direct echo.
		$this->content= $sContent;
		
		if( $bAsString )
		{
			return $sContent;
		}
		else
		{
			echo $sContent;
		}
	}
	
	//	Render the variables in memory.
	public function renderInMemory( $sTemplate )
	{
		$this->content	= "";
		$sContent   	= $sTemplate;
		$aResult    	= array();

		preg_match_all( "/({variable.)(\w.*)(})/ismU", $sContent, $aPatterns );
				
		array_push( $aResult, $aPatterns[ 2 ] );
		array_push( $aResult, count( $aPatterns[ 2 ] ) );
				
		for( $nIndex=0; $nIndex<=sizeOf( $aResult[0] ) - 1; $nIndex++ )
		{
			if( isset( $this->_member[ $aResult[0][ $nIndex ] ] ) )
			{
				$sContent	= str_replace( "{variable." . $aResult[0][ $nIndex ] . "}", $this->_member[ $aResult[0][ $nIndex ] ], $sContent );
			}
		}
			
		$this->content	= $sContent;
		
		return $sContent;
	} 
}
	