<?php
//====================================================================================
//	Class:		funkyMaxMind
//	Objective:	Provides the functionality to load the Maxmind IP database and use it
//              as a IP to country locator.
//	Copyright	2014 (c) Quantum 23
//	License		http://www.quantum23.com/license/1_0/
//  Source:     http://dev.maxmind.com/geoip/geolite
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	10-oct-14	Andrew Makin	ICR.
//====================================================================================
class q23maxMind extends q23base
{
	//--------------------------------------------------------------------------------
	//	Constructor/Destructor.
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		
		$this->table			= TBL_UTL_GEO_IP;
	}
	
	
	//--------------------------------------------------------------------------------
	//	Public Methods.
	//--------------------------------------------------------------------------------

	public function run( $v='' )
	{
		try
		{
			$sURL	    = $this->cfg[ "maxmind" ][ "uri" ];
			$sFolder	= FS_FOLDER_DT_CSV;
			$sFile  	= 'file.zip';

			q23helper::writeLog( LOG_FILE_CRON, " -> Downloading: " . $sURL, LOG_WRITER_INFORMATION );

			q23helper::getRemoteFile( $sURL, $sFolder . $sFile );

			q23helper::writeLog( LOG_FILE_CRON, " -> Download Complete.", LOG_WRITER_INFORMATION );
			
			if( filesize( FS_FOLDER_DT_CSV . $sFile ) > 0 )
			{
				q23helper::writeLog( LOG_FILE_CRON, " -> Unzipping IP list.", LOG_WRITER_INFORMATION );

				q23helper::unzip( FS_FOLDER_DT_CSV, $sFile );

				q23helper::writeLog( LOG_FILE_CRON, " -> Unzipping Completed.", LOG_WRITER_INFORMATION );

				unlink( FS_FOLDER_DT_CSV . $sFile );

				q23helper::writeLog( LOG_FILE_CRON, " -> Removed original file.", LOG_WRITER_INFORMATION );

				return self::load();
			}
			else
			{
				throw new Exception( "Maxmind file zero bytes in length." );
			}
			
			return true;
		}
		catch( Exception $e )
		{
			q23helper::exceptionHandler( $e );
			return false;	
		}
	}

	//	Load a new GeoIP table-
	public function load( $sFileCSV="GeoIPCountryWhois.csv" )
	{
		$sTable		= $this->table;
		$sFile		= FS_FOLDER_DT_CSV . $sFileCSV;
		$sRenamed	= FS_FOLDER_DT_CSV . date( "YmdHis" ) . "-" . $sFileCSV;
		
		q23helper::writeLog( LOG_FILE_CRON, " -> Remove tables.", LOG_WRITER_INFORMATION );
		
		self::_dropTable( $this->table . "_new" );
		self::_dropTable( $this->table . "_old" );
		
		if( file_exists( $sFile ) && filesize( $sFile ) > 0 )
		{
			q23helper::writeLog( LOG_FILE_CRON, " -> File: " . $sFile, LOG_WRITER_INFORMATION );
			q23helper::writeLog( LOG_FILE_CRON, " -> Create 'tmp' table.", LOG_WRITER_INFORMATION );
			
			$this->oDB->query( "CREATE TABLE `" . $this->table . "_new` LIKE `" . $this->table . "`;" );
			
			$this->table	= $this->table . "_new";
			$nCount			= 0;
			$hFile			= fopen( $sFile, "r" );
			
			q23helper::writeLog( LOG_FILE_CRON, " -> Loading data.", LOG_WRITER_INFORMATION );
			
			while( ( $aData = fgetcsv( $hFile, 1024, "," ) ) !== FALSE )
			{
				$this->member					= array();
				$this->member[ "id" ]			= 0;
				$this->member[ "ipStart" ]		= $aData[ 0 ];
				$this->member[ "ipEnd" ]		= $aData[ 1 ];
				$this->member[ "numStart" ]		= $aData[ 2 ];
				$this->member[ "numEnd" ]		= $aData[ 3 ];
				$this->member[ "countryCode" ]	= $aData[ 4 ];
				$this->member[ "countryName" ]	= $this->oDB->escape( $aData[ 5 ], true );
				
				$this->write();
				
				$nCount++;
			}
			
			fclose( $hFile );

			q23helper::writeLog( LOG_FILE_CRON, " -> Imported: " . $nCount, LOG_WRITER_INFORMATION );
			q23helper::writeLog( LOG_FILE_CRON, " -> Tables renamed.", LOG_WRITER_INFORMATION );

			$this->oDB->query( "ALTER TABLE `" . $sTable . "` RENAME `" . $sTable . "_old`" );
			$this->oDB->query( "ALTER TABLE `" . $this->table . "` RENAME `" . $sTable . "`" );
			$this->oDB->query( "OPTIMIZE TABLE `" . $sTable . "`" );
			
			$aTmp	= $this->oDB->result();
			
			q23helper::writeLog( LOG_FILE_CRON, " -> Import file renamed.", LOG_WRITER_INFORMATION );
			
			rename( $sFile, $sRenamed );
			
			$this->table	= $sTable;
			
			return true;
		}
		else
		{
			q23helper::writeLog( LOG_FILE_ERROR, "No file found: " . $sFile, LOG_WRITER_INFORMATION );
			
			return false;
		}
	}
	
	//	Get the country code and name from an IP address.
	public function getCountry( $sIP )
	{
		$sSQL	= "SELECT countryCode, countryName FROM " . $this->table . " WHERE INET_ATON( '" . $sIP . "' ) BETWEEN numStart AND numEnd LIMIT 1";

		$this->_oDB->query( $sSQL );

		$aRow	= $this->_oDB->row();

		return $aRow;
	}
	
	private function _dropTable( $sTable )
	{
		$nTmp	= $this->oDB->query( "SHOW TABLES LIKE '" . $sTable . "'" );
		$aTmp	= $this->oDB->result();
			
		if( sizeof( $aTmp ) == 1 ) 
		{
			$this->oDB->query( "DROP TABLE `" . $sTable . "`" );
		}
	}
}
?>