<?php
//====================================================================================
//	Class:		q23base
//	Objective:	A collection of methods and properties for superclasses.
//	Copyright:	2014 (c) Quantum 23
//	License		http://quantum23.com/license/
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	09-Oct-14	Andrew Makin	ICR.
//====================================================================================
class q23base
{
	//--------------------------------------------------------------------------------
	//	Class Members
	//--------------------------------------------------------------------------------
	public	$oDB		= NULL;
	
	public	$cfg		= array();
	public	$member		= array();
	
	public	$table		= "";
	public	$where		= "";
	public	$orderBy	= "";

	
	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		global	$g_aCfg;
		
		$this->oDB	= Xcrud_db::get_instance();
		$this->cfg	= $g_aCfg;
	}
	
	public function __destruct()
	{
	}
	
	public function __set( $sName, $vValue )
	{
		$this->$sName	= $vValue;
	}
	
	public function __get( $sName )
	{
		return $this->$sName;
	}

	
	//--------------------------------------------------------------------------------
	//	Public Methods
	//--------------------------------------------------------------------------------
	//	Get the data as an associative data.
	public function getAssociative( $sKey, $sData, $bDistinct=true )
	{
		$aTmp		= array();
		$sDistinct	= ( $bDistinct ) ? "DISTINCT " : "";
		$sSQL		= "SELECT " . $sDistinct . $sKey . ", " . $sData . " FROM " . $this->table . $this->where . $this->orderBy;
		
		$this->oDB->query( $sSQL );
		
		$aResult	= $this->oDB->result();

		foreach( $aResult as $sKey => $vValue )
		{
			$aTmp[ $vValue[ "name" ] ]	= $vValue[ "value" ];
		}
		
		return $aTmp;
	}
	
	//	Edit a record.
	public function edit( $nID )
	{
		self::read( $nID );
		
		$this->_oTpl->setMember( $this->member );
		$this->_oTpl->render( $this->group . "edit" . GEN_TEMPLATE_EXTENSION );
		$this->_oLng->render( $this->oTpl->content );
		
		return $this->oLng->content;
	}
	
	//	Delete functionality.
	public function delete( $nID )
	{
		$bResult	= false;
		
		if( (int)$nID > 0 )
		{
			if( $this->oDB->query( "DELETE FROM " . $this->table . " WHERE id=" . $nID ) )
			{
				$bResult	= true;
			}
		}
		else
		{
			trigger_error( __METHOD__ . " - id must be greater than zero (0)." , E_USER_ERROR );
		}
		
		return $bResult;
	}

	//	Read a record.
	public function read( $nID )
	{
		$bResult	= false;
		
		if( (int)$nID > 0 )
		{
			$sSQL			= "SELECT * FROM " . $this->table . " WHERE id=" . $nID;

			$this->oDB->query( $sSQL );

			$this->member	= $this->oDB->row();

			$bResult	= true;
		}
		else
		{
			trigger_error( __METHOD__ . " - id must be greater than zero (0)." , LOG_WRITER_INFORMATION );
			
			self::_memberDefault();
		}
		
		return $bResult;
	}
	
	//	Write a record (update or insert),
	public function write()
	{
		$aTmp   = array();
		$aField = array();
		$aValue = array();
		$nID	= ( isset( $this->member[ "id" ] ) ) ? $this->member[ "id" ] : 0;

		unset( $this->member[ "id" ] );

		if( $nID > 0 )
		{
			foreach( $this->member as $sKey=>$sValue )
			{
			    if(in_array($sKey, ['_gid', '_ga', '_gat'])) continue;

				if( is_array( $sValue ) )
				{
					$sValue	= implode( ",", $sValue );
				}
				
				$aTmp[] = $sKey . "='" . str_replace( array( "'", '"' ), array( "\'", "\'" ), trim( $sValue ) ) . "'";
			}

			$sSQL    = "UPDATE " . $this->table . " SET " . implode( ',', $aTmp ) . " WHERE id=" . $nID;

			$this->oDB->query( $sSQL );
		}
		else
		{
			$this->member[ "_created" ]	= date( "Y-m-d H:i:s" );
			
			foreach( $this->member as $sKey=>$sValue )
			{
                if(in_array($sKey, ['_gid', '_ga', '_gat'])) continue;

                $aField[]   = $sKey;
				$aValue[]   = $this->oDB->escape( trim( $sValue ) );
			}
			
			$sSQL   = "INSERT INTO " . $this->table . " ( " . implode( ',', $aField ) . " ) VALUES ( " . implode( ',', $aValue ) . " )";

			$this->oDB->query( $sSQL );

			$nID    = $this->oDB->insert_id();
		}

		return $nID;
	}
}
?>