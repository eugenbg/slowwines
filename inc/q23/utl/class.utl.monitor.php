<?php
//====================================================================================
//	Class:		q23base
//	Objective:	A collection of methods and properties for superclasses.
//	Copyright:	2014 (c) Quantum 23
//	License		http://quantum23.com/license/
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	27-Dec-14	Andrew Makin	ICR.
//====================================================================================
class q23monitor extends q23base
{
	//--------------------------------------------------------------------------------
	//	Public Methods
	//--------------------------------------------------------------------------------
	public function database()
	{
		$nLink	= mysqli_connect( FS_DB_HOST, FS_DB_USR, FS_DB_PWD, FS_DB_NAME );

		if( !$nLink )
		{
			$sTmp	= "Error: " . mysqli_connect_error();
		}
		elseif( $oResult = mysqli_query( $nLink, "SELECT 1" ) )
		{
		    if( mysqli_num_rows( $oResult ) )
		    {
				$sTmp	= "OK";
		   	}
		   	else
		   	{
				$sTmp	= "Error: DB101";
			}
		   	
		    mysqli_free_result( $oResult );
		}
		else
		{
			$sTmp	= "Error: DB102";
		}
		
		return $sTmp;
	}
	
	public function feed( $nID )
	{
		$nLink	= mysqli_connect( FS_DB_HOST, FS_DB_USR, FS_DB_PWD, FS_DB_NAME );

		if( !$nLink )
		{
			$sTmp	= "Connection Failed: " . mysqli_connect_error();
		}
		elseif( $oResult = mysqli_query( $nLink, "SELECT 1" ) )
		{
		    if( mysqli_num_rows( $oResult ) )
		    {
		    	$sSQL		= "SELECT feedUpdate FROM " . TBL_APP_LST_AGENT . " WHERE id=" . $nID;
		    	$oResult	= mysqli_query( $nLink, $sSQL );
		    	
		    	if( isset( $oResult ) )
		    	{
					$aRow			= $oResult->fetch_row();
			    	$nDifference	= abs( strtotime( date( "Y-m-d H:i:s" ) ) - strtotime( $aRow[0] ) );

					if( ( $nDifference / ( 60 * 60 ) ) > 24 )
					{
						$sTmp	= "Error: FD101";
					}
					else
					{
						$sTmp	= "OK";
					}
				}
				else
				{
					$sTmp	= "Error: FD102";
				}
		   	}
		   	else
		   	{
				$sTmp	= "Error: FD103";
			}
		   	
		    mysqli_free_result( $oResult );
		}
		else
		{
			$sTmp	= "Error: FD104";
		}
		
		return $sTmp;
	}
	
	public function site()
	{
		return "OK";
	}
}
?>