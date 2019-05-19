<?php
//====================================================================================================
//	Class:		class.utl.seo.php
//	Objective:	Generate keywords and description from a given data feed.
//	Developer:	Andrew Makin, Funky Software (http://funky-software.net),
//	Copyright:	Funky Software (c) 2010
//----------------------------------------------------------------------------------------------------
// Version	Date		Developer		Comment.
//----------------------------------------------------------------------------------------------------
//	0.0.01	2010-12-26	Andrew Makin	Initial Concept Release, (ICR).
//====================================================================================================

class q23seo extends q23base
{
	//================================================================================
	//	Class Members.
	//================================================================================
	public		$member						= array();
	
	protected	$_aConfig					= NULL;
	
    private		$text						= "";									//	text to work with  
    private		$maxDescriptionLength		= 220;									//	max len for the meta description 
    private		$maxKeywords				= 25;									//	mix number of keywords to return 
    private		$minWordLength				= 4;									//	min len for a word 
    private		$charset					= 'UTF-8';								//default charset to use
    private		$bannedWords				= array( 'able', 'about', 'above', 'act', 'add', 'afraid', 'after', 'again', 'against', 'age', 'ago', 'agree', 'all', 'almost', 'alone', 'along', 'already', 'also', 'although', 'always', 'am', 'amount', 'an', 'and', 'anger', 'angry', 'animal', 'another', 'answer', 'any', 'appear', 'apple', 'are', 'arrive', 'arm', 'arms', 'around', 'arrive', 'as', 'ask', 'at', 'attempt', 'aunt', 'away', 'back', 'bad', 'bag', 'bay', 'be', 'became', 'because', 'become', 'been', 'before', 'began', 'begin', 'behind', 'being', 'bell', 'belong', 'below', 'beside', 'best', 'better', 'between', 'beyond', 'big', 'body', 'bone', 'born', 'borrow', 'both', 'bottom', 'box', 'boy', 'break', 'bring', 'brought', 'bug', 'built', 'busy', 'but', 'buy', 'by', 'call', 'came', 'can', 'cause', 'choose', 'close', 'close', 'consider', 'come', 'consider', 'considerable', 'contain', 'continue', 'could', 'cry', 'cut', 'dare', 'dark', 'deal', 'dear', 'decide', 'deep', 'did', 'die', 'do', 'does', 'dog', 'done', 'doubt', 'down', 'during', 'each', 'ear', 'early', 'eat', 'effort', 'either', 'else', 'end', 'enjoy', 'enough', 'enter', 'even', 'ever', 'every', 'except', 'expect', 'explain', 'fail', 'fall', 'far', 'fat', 'favor', 'fear', 'feel', 'feet', 'fell', 'felt', 'few', 'fill', 'find', 'fit', 'fly', 'follow', 'for', 'forever', 'forget', 'from', 'front', 'gave', 'get', 'gives', 'goes', 'gone', 'good', 'got', 'gray', 'great', 'green', 'grew', 'grow', 'guess', 'had', 'half', 'hang', 'happen', 'has', 'hat', 'have', 'he', 'hear', 'heard', 'held', 'hello', 'help', 'her', 'here', 'hers', 'high', 'hill', 'him', 'his', 'hit', 'hold', 'hot', 'how', 'however', 'I', 'if', 'ill', 'in', 'indeed', 'instead', 'into', 'iron', 'is', 'it', 'its', 'just', 'keep', 'kept', 'knew', 'know', 'known', 'late', 'least', 'led', 'left', 'lend', 'less', 'let', 'like', 'likely', 'likr', 'lone', 'long', 'look', 'lot', 'make', 'many', 'may', 'me', 'mean', 'met', 'might', 'mile', 'mine', 'moon', 'more', 'most', 'move', 'much', 'must', 'my', 'near', 'nearly', 'necessary', 'neither', 'never', 'next', 'no', 'none', 'nor', 'not', 'note', 'nothing', 'now', 'number', 'of', 'off', 'often', 'oh', 'on', 'once', 'only', 'or', 'other', 'ought', 'our', 'out', 'please', 'prepare', 'probable', 'pull', 'pure', 'push', 'put', 'raise', 'ran', 'rather', 'reach', 'realize', 'reply', 'require', 'rest', 'run', 'said', 'same', 'sat', 'saw', 'say', 'see', 'seem', 'seen', 'self', 'sell', 'sent', 'separate', 'set', 'shall', 'she', 'should', 'side', 'sign', 'since', 'so', 'sold', 'some', 'soon', 'sorry', 'stay', 'step', 'stick', 'still', 'stood', 'such', 'sudden', 'suppose', 'take', 'taken', 'talk', 'tall', 'tell', 'ten', 'than', 'thank', 'that', 'the', 'their', 'them', 'then', 'there', 'therefore', 'these', 'they', 'this', 'those', 'though', 'through', 'till', 'to', 'today', 'told', 'tomorrow', 'too', 'took', 'tore', 'tought', 'toward', 'tried', 'tries', 'trust', 'try', 'turn', 'two', 'under', 'until', 'up', 'upon', 'us', 'use', 'usual', 'various', 'verb', 'very', 'visit', 'want', 'was', 'we', 'well', 'went', 'were', 'what', 'when', 'where', 'whether', 'which', 'while', 'white', 'who', 'whom', 'whose', 'why', 'will', 'with', 'within', 'without', 'would', 'yes', 'yet', 'you', 'young', 'your', 'br', 'img', 'p','lt', 'gt', 'quot', 'copy' );

	
	//================================================================================
	//	Magic Methods				Iii|:)´
	//================================================================================
	//	Constructor.
	public function __construct( $sText='', $charset='UTF-8' )
	{
        $this->setText( $sText ); 
		
        $this->charset	= $charset;
		
		self::_instanciate();
	}
	
	//	Destructor.
	public function __destruct() 
	{
	}


	//================================================================================
	//	Public Properties.
	//================================================================================
	//	Get Parameters
	public function getParameter()
	{
		$aSEO						= array();
		$aSEO[ "description" ]		= "";
		$aSEO[ "keyword" ]			= "";
		$aSEO[ "url" ]				= "";
		$aSEO[ "author" ]			= "";
		$aSEO[ "locale" ]			= "";
		$aSEO[ "locale.alternate" ]	= "";
		$aSEO[ "type" ]				= "";
		$aSEO[ "title" ]			= "";
		$aSEO[ "site.name" ]		= "";
		$aSEO[ "image" ]			= "";
		$aSEO[ "modified" ]			= "";
		$aSEO[ "type" ]				= "";
		$aSEO[ "published" ]		= "";
		$aSEO[ "modified" ]			= "";
		$aSEO[ "link.alternate" ]	= "";
		
		return $aSEO;
	}
	
	
	//	Text to be processed.
	public function setText( $sText )
	{ 
		$sText	= html_entity_decode( $sText, ENT_QUOTES, $this->charset );
		$sText	= strip_tags( $sText );												//	remove any html markup
		$sText	= preg_replace( '/\s\s+/', ' ', $sText );							//	remove possible duplicated white spaces
		$sText	= str_replace( array( '\r\n', '\n', '+' ), ',', $sText );			//	remove possible returns 
		$sText	= trim( $sText ); 
//		$sText	= mb_strtolower( $sText, $this->charset );							//	everything to lower case 
		
		$this->text = $sText;
	} 
	
	public function getText()
	{ 
		return $this->text; 
	} 
	
	//	Description Maximum Lenght.
	public function setDescriptionLength( $nLength )
	{ 
		if( is_numeric( $nLength ) )
		{
			$this->maxDescriptionLength	= $nLength;
		}
	
		if( strlen( $this->getText() ) > $this->maxDescriptionLength )
		{
			$sText	= mb_substr( $this->getText(), 0, $this->maxDescriptionLength );

			while( mb_substr( $sText, $this->maxDescriptionLength, 1, $this->charset ) != ' ')
			{
				$this->maxDescriptionLength--;
			}
		}
	} 
	
	public function getDescriptionLength()
	{ 
		return $this->maxDescriptionLength; 
	}
	
	//	Maximum Keywords 
	public function setMaximumKeywords( $nLenght )
	{ 
		if( is_numeric( $nLenght ) )
		{
			$this->maxKeywords	= $nLenght; 
		}
	} 
	
	public function getMaximumKeywords()
	{ 
		return $this->maxKeywords; 
	} 
	
	//	Minimu Word Length 
	public function setMinimumWordLength( $nLength )
	{ 
		if( is_numeric( $nLength ) )
		{
			$this->minWordLength	= $nLength; 
		}
	}
	
	public function getMinimumWordLength()
	{
		return $this->minWordLength; 
	} 
	
	//	Banned Words 
	public function setBannedWords( $sWords )
	{ 
		if( isset( $sWords ) )
		{ 
			$arrText	= explode( ',', $sWords );
			
			if( is_array( $arrText ) )
			{
				$this->bannedWords	= $arrText;
			}
		} 
	}
	
	public function getBannedWords()
	{
		return $this->bannedWords; 
	}     


	//================================================================================
	//	Public Methods.
	//================================================================================
    //	SEO for meta description 
	public function getMetaDescription( $nLength=null )
	{
		$this->setDescriptionLength( $nLength );
		
		return str_replace( "\n", " ", mb_substr( $this->getText(), 0, $this->getDescriptionLength(), $this->charset ) );
//		return str_replace( "\r", " ", substr( $this->getText(), 0, $this->getDescriptionLength() ) );
	}
 
 	//	Get keywords from the text.
	public function getKeyWords( $nMaximumKeywords=25 )
	{
		$this->setMaximumKeywords( $nMaximumKeywords );
		
		$sText			= $this->getText(); 
		$sText			= str_replace( array( '–', '(', ')', '+', ':', '.', '?', '!', '_', '*', '-' ), '', $sText );
		$sText			= str_replace( array( ' ', '.' ), ',', $sText );
		$aWordCounter	= array();
		$aText			= explode( ',',$sText ); 

		unset( $sText ); 
		
		foreach( $aText as $vValue )  
		{ 
			$vValue	= trim( $vValue );
		
			if( strlen( $vValue ) >= $this->getMinimumWordLength() && !in_array( $vValue, $this->getBannedWords() ) )
			{
				if( array_key_exists( $vValue, $aWordCounter ) )
				{
					$aWordCounter[ $vValue ]	= $aWordCounter[ $vValue ] + 1; 
				} 
				else
				{
					$aWordCounter[ $vValue ] = 1;
				} 
			} 
		}
		
		unset( $aText ); 
	
		uasort( $aWordCounter, array( $this, 'cmp' ) );
	
		$nIndex		= 1;
		$sKeywords	= '';
		
		foreach( $aWordCounter as $sKey=>$vValue )
		{ 
			$sKeywords	.=	$sKey . ', ';
			
			if( $nIndex < $this->getMaximumKeywords() )
			{
				$nIndex++;
			}
			else
			{
				break;
			}
		} 
		
		unset( $aWordCounter ); 
	
		$sKeywords	= rtrim( $sKeywords, ', ' );
	
		return str_replace( "\n", " ", str_replace( array( '"', "'" ), "", $sKeywords ) );
	} 
 

	//================================================================================
	//	Private Methods.
	//================================================================================
	//	
	private function _instanciate()
	{
	}
	
	//	Count the $search word in the given array.
	private function countWordArray( $search, $array )
	{
		if (is_array($array) && $search!='')
		{ 
			$count	= 0;
			
			foreach( $array as $e )
			{
				if( $e == $search )
				{
					$count++; 
				}
			}
			
			return $count; 
		} 
		else
		{
			return false; 
		}
	} 
	
	//	Sort for uasort descendent numbers 
	private function cmp( $a, $b )
	{
		if( $a == $b )
		{
			return 0; 
		}
		
		return ( $a < $b ? 1 : -1 ); 
	} 
}