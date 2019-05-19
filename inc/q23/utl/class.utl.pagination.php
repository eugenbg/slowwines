<?php
//====================================================================================
//	Class:		q23pagination
//	Objective:	Creates the pagination links.
//	Copyright:	2014 (c) Quantum 23
//	License		http://quantum23.com/license/
//------------------------------------------------------------------------------------
//	Rel.	Date		Developer		Comments.
//------------------------------------------------------------------------------------
//	0.0.1	13-Oct-14	Andrew Makin	ICR.
//====================================================================================
class q23pagination extends q23base
{
	//	Build pagination.
	public function paginate( $nTotalPages=0, $nCurrentPage=1, $sURL="/en/search/results/#/", $nPageLinks=6 )
	{
		$nTotalPages	= round( ( $nTotalPages / $this->cfg[ "pagination" ][ "result.per.page.usr" ] ) + 0.49 );
		$sOutput	 	= "";
		
		if( $nTotalPages <= 1 )
		{
			return $sOutput;
		}
		
		$sOutput	 = '<ul class="pagination pagination-sm">';
		$sOutput	.= '	<li><a href="' . str_replace( "#", 1, $sURL ) . '" class="fsPgLnk" fsLnk="' . str_replace( "#", 1, $sURL ) . '"><i class="fa fa-step-backward"></i></a></li>';
		$nLeeway	 = floor( $nPageLinks / 2 );
		$nFirstPage	 = $nCurrentPage - $nLeeway;
		$nLastPage	 = $nCurrentPage + $nLeeway;
		
		if( $nFirstPage < 1 )
		{
			$nLastPage	+= 1 - $nFirstPage;
			$nFirstPage	= 1;
		}
		
		if( $nLastPage > $nTotalPages )
		{
			$nFirstPage	-= $nLastPage - $nTotalPages;
			$nLastPage	 = $nTotalPages;
		}
		
		if( $nFirstPage < 1 )
		{
			$nFirstPage = 1;
		}
		
		if( $nFirstPage != 1 )
		{
			$sOutput	 .= '	<li><a href="' . str_replace( "#", ( $nCurrentPage - 1 ), $sURL ) . '" class="fsPgLnk" fsLnk="' . str_replace( "#", ( $nCurrentPage - 1 ), $sURL ) . '"><i class="fa fa-backward"></i></a></li>';
		}
		
		for( $nIndex = $nFirstPage; $nIndex <= $nLastPage; $nIndex++ )
		{
			if( $nIndex == $nCurrentPage )
			{
				$sOutput	.= '	<li class="active"><a href="">' . $nIndex . '</a></li>';
			}
			else
			{
				$sOutput	.= '	<li><a href="' . str_replace( "#", $nIndex, $sURL ) . '" class="fsPgLnk" fsLnk="' . str_replace( "#", $nIndex, $sURL ) . '">' . $nIndex . '</a></li>';
			}
		}
		
		if( $nLastPage != $nTotalPages )
		{
			$sOutput	 .= '	<li><a href="' . str_replace( "#", ( $nCurrentPage + 1 ), $sURL ) . '" class="fsPgLnk" fsLnk="' . str_replace( "#", ( $nCurrentPage + 1 ), $sURL ) . '"><i class="fa fa-forward"></i></a></li>';
		}
		
		$sOutput	 .= '	<li><a href="' . str_replace( "#", $nTotalPages, $sURL ) . '" class="fsPgLnk" fsLnk="' . str_replace( "#", $nTotalPages, $sURL ) . '"><i class="fa fa-step-forward"></i></a></li>';
		$sOutput	 .= '</ul>';
		
		return $sOutput;
	}
}
?>