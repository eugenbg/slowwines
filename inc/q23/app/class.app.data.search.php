<?php
//====================================================================================
//	Class:		q23dataSearch
//	Objective:	Holds search, portfolio and recently viewed.
//	Copyright:	2014 (c) Quantum 23
//	License		http://quantum23.com/license/
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	11-Oct-14	Andrew Makin	ICR.
//====================================================================================
class q23dataSearch extends q23base
{
	//--------------------------------------------------------------------------------
	//	Class Members
	//--------------------------------------------------------------------------------
	public	$country;
	public	$area;
	public	$location;
	public	$propertyType;
	public	$listingType;
	public	$priceMinimum;
	public	$priceMaximum;
	public	$currency;
	public	$bed;
	public	$bath;
	public	$pageSize;
	public	$own;
	public	$reference;
	public	$language;
	public	$sortType;
	public	$qid;
	public	$pageNo;
	public	$featuredSale;
	public	$featuredRentShort;
	public	$featuredRentLong;
	public	$category;
	
	public	$referenceSale;
	public	$referenceShort;
	public	$referenceLong;
	public	$referenceRecent;


	//--------------------------------------------------------------------------------
	//	Magic Methods
	//--------------------------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		self::resetSearch();
	}

	//--------------------------------------------------------------------------------
	//	Public Methods
	//--------------------------------------------------------------------------------
	public function parameters()
	{
//		$aTmp	= get_class_vars( get_class( $this ) );
		$aTmp	= array(	"country"=>$this->country,
							"area"=>$this->area,
							"location"=>$this->location,
							"listing"=>$this->listingType,
							"property"=>$this->propertyType,
							"pricemin"=>$this->priceMinimum,
							"pricemax"=>$this->priceMaximum,
							"currency"=>$this->currency,
							"bed"=>$this->bed,
							"bath"=>$this->bath,
							"pagesize"=>$this->pageSize,
							"own"=>$this->own,
							"reference"=>$this->reference,
							"lanaguage"=>$this->language,
							"sortType"=>$this->sortType,
							"qid"=>$this->qid,
							"pageno"=>$this->pageNo,
							"referencesale"=>$this->referenceSale,
							"referenceshort"=>$this->referenceShort,
							"referencelong"=>$this->referenceLong,
							"referencerecent"=>$this->referenceRecent );

		return json_encode( $aTmp );
	}
	
	public function update( $aPayload )
	{
		$this->country			= ( isset( $_REQUEST[ "country" ] ) )		? $_REQUEST[ "country" ]	: $this->country;
		$this->area				= ( isset( $_REQUEST[ "area" ] ) )			? $_REQUEST[ "area" ]		: $this->area;
		$this->location			= ( isset( $_REQUEST[ "location" ] ) )		? $_REQUEST[ "location" ]	: $this->location;
		$this->listingType		= ( isset( $_REQUEST[ "listing" ] ) )		? $_REQUEST[ "listing" ]	: $this->listingType;
		$this->priceMinimum		= ( isset( $_REQUEST[ "pricemin" ] ) )		? $_REQUEST[ "pricemin" ]	: $this->priceMinimum;
		$this->priceMaximum		= ( isset( $_REQUEST[ "pricemax" ] ) )		? $_REQUEST[ "pricemax" ]	: $this->priceMaximum;
		$this->propertyType		= ( isset( $_REQUEST[ "property" ] ) )		? $_REQUEST[ "property" ]	: $this->propertyType;
		$this->bed				= ( isset( $_REQUEST[ "bed" ] ) )			? $_REQUEST[ "bed" ]		: $this->bed;
		$this->bath				= ( isset( $_REQUEST[ "bath" ] ) )			? $_REQUEST[ "bath" ]		: $this->bath;
		$this->reference		= ( isset( $_REQUEST[ "reference" ] ) )		? $_REQUEST[ "reference" ]	: $this->reference;
		$this->currency			= ( isset( $_REQUEST[ "currency" ] ) )		? $_REQUEST[ "currency" ]	: $this->currency;
		$this->own				= ( isset( $_REQUEST[ "own" ] ) )			? $_REQUEST[ "own" ]		: $this->own;
		$this->language			= ( isset( $_REQUEST[ "language" ] ) )		? $_REQUEST[ "language" ]	: $this->language;
		$this->sortType			= ( isset( $_REQUEST[ "sortType" ] ) )		? $_REQUEST[ "sortType" ]	: $this->sortType;
	}
	
	public function sessionRead()
	{
//		$this = $_SESSION[ SESSION_CLIENT_SEARCH ];
	}
	
	public function sessionWrite()
	{
//		$_SESSION[ SESSION_CLIENT_SEARCH ]	= self::parameters();
	}
	
	public function resetSearch()
	{
		$this->country			= $this->cfg[ 'geo' ][ 'country' ];
		$this->area				= $this->cfg[ 'geo' ][ 'area' ];
		$this->location			= $this->cfg[ 'geo' ][ 'city' ];
		$this->propertyType		= "";
		$this->listingType		= "";
		$this->priceMinimum		= 0;
		$this->priceMaximum		= 0;
		$this->currency			= $this->cfg[ "currency" ][ "base" ];
		$this->bed				= "";
		$this->bath				= "";
		$this->pageSize			= $this->cfg[ "pagination" ][ "result.per.page.usr" ];
		$this->own				= 0;
		$this->reference		= "";
		$this->language			= $this->cfg[ 'language' ][ 'default' ];
		$this->sortType			= 0;
		$this->qid				= "";
		$this->pageNo			= 1;
	}
	
	private function resetPortfolio()
	{
		$this->referenceSale	= "";
		$this->referenceShort	= "";
		$this->referenceLong	= "";
		$this->referenceRecent	= "";
	}
}
?>