<?php
//====================================================================================
//	Class:		funkyFunctionProcessor
//	Objective:	
//	Copyright	2012 (c) Funky::Software
//	License		http://www.funky-software.net/license/1_0.txt
//	Link		http://dev.zend.com/package/PackageName
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	05-Jul-12	Andrew Makin	ICR.
//====================================================================================
class q23functionProcessor
{
	//--------------------------------------------------------------------------------
	//	Class Members.
	//--------------------------------------------------------------------------------
	protected	$_skeleton			= "[+function.{value}+]";
	protected	$_folder			= "";
	protected	$_member			= array();
	
	public		$content			= "";
	
	
	//--------------------------------------------------------------------------------
	//	Magic Methods.
	//--------------------------------------------------------------------------------
	public function __construct() 
	{
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
	//	Render the template with the output from the called functions.
	public function render( $sText )
	{
		preg_match_all("/\[func([^\]]*)\]/", $sText, $aShortCode);

		$nPointer	= 0;
	
		foreach( $aShortCode[1] as $sValue )
		{
			preg_match_all( "/([^,= ]+)=([^,= ]+)/", $sValue, $aPair );

			$aFunction	= array();

			for( $nIndex=0; $nIndex<count( $aPair[0] ); $nIndex++ )
			{
				$aFunction[ $aPair[1][ $nIndex ] ] = $aPair[2][ $nIndex ];
			}

			if( function_exists( $aFunction[ "cmd" ] ) ) 
			{
				$aShortCode[2][ $nPointer ]	= $aFunction[ "cmd" ]( $aFunction );
			
			}
			else
			{
				$aShortCode[2][ $nPointer ]	=  "<strong><i>Función no disponible - " . $aFunction[ "cmd" ] . "</i></strong>";
			}
		
			$sText	= str_replace( $aShortCode[0][ $nPointer ], $aShortCode[2][ $nPointer ], $sText );
			
			$nPointer++;
		}
	
		$this->content	= $sText;
		
		return true;
	}
}
	