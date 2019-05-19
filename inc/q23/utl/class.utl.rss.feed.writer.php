<?php
//--------------------------------------------------------------------------------
//	Abstract: 		feed
//	Objective:		Universal Feed Writer class
//	Description:	Generate RSS 1.0, RSS2.0 and ATOM Feeds
//--------------------------------------------------------------------------------
abstract class feed
{
    const RSS1 = 'RSS 1.0';
    const RSS2 = 'RSS 2.0';
    const ATOM = 'ATOM';

    /**
    * Collection of all channel elements
    */
    private $channels      = array();

    /**
    * Collection of items as object of \FeedWriter\Item class.
    */
    private $items         = array();

    /**
    * Store some other version wise data
    */
    private $data          = array();

    /**
    * The tag names which have to encoded as CDATA
    */
    private $CDATAEncoding = array();

    /**
    * Collection of XML namespaces
    */
    private $namespaces    = array();

    /**
    * Contains the format of this feed.
    */
    private $version   = null;
    
    /**
    * Constructor
    *
    * If no version is given, a feed in RSS 2.0 format will be generated.
    *
    * @param    constant  the version constant (RSS1/RSS2/ATOM).
    */
    protected function __construct($version = Feed::RSS2)
    {
        $this->version = $version;

        // Setting default encoding
        $this->encoding = 'utf-8';

        // Setting default value for essential channel elements
        $this->channels['title'] = $version . ' Feed';
        $this->channels['link']  = 'http://www.ajaxray.com/blog';

        // Add some default XML namespaces
        $this->namespaces['content'] = 'http://purl.org/rss/1.0/modules/content/';
        $this->namespaces['wfw'] = 'http://wellformedweb.org/CommentAPI/';
        $this->namespaces['atom'] = 'http://www.w3.org/2005/Atom';
        $this->namespaces['rdf'] = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
        $this->namespaces['rss1'] = 'http://purl.org/rss/1.0/';
        $this->namespaces['dc'] = 'http://purl.org/dc/elements/1.1/';
        $this->namespaces['sy'] = 'http://purl.org/rss/1.0/modules/syndication/';

        // Tag names to encode in CDATA
        $this->addCDATAEncoding(array('description', 'content:encoded', 'summary'));
    }

    // Start # public functions ---------------------------------------------
    
    /**
    * Set the URLs for feed pagination.
    *
    * See RFC 5005, chapter 3. At least one page URL must be specified.
    *
    * @param   string  The URL to the next page of this feed. Optional.
    * @param   string  The URL to the previous page of this feed. Optional.
    * @param   string  The URL to the first page of this feed. Optional.
    * @param   string  The URL to the last page of this feed. Optional.
    * @link    http://tools.ietf.org/html/rfc5005#section-3
    * @return  self
     */
    public function setPagination($nextURL = null, $previousURL = null, $firstURL = null, $lastURL = null)
    {
        if (empty($nextURL) && empty($previousURL) && empty($firstURL) && empty($lastURL))
            die('At least one URL must be specified for pagination to work.');

        if (!empty($nextURL))
            $this->setAtomLink($nextURL, 'next');

        if (!empty($previousURL))
            $this->setAtomLink($previousURL, 'previous');

        if (!empty($firstURL))
            $this->setAtomLink($firstURL, 'first');

        if (!empty($lastURL))
            $this->setAtomLink($lastURL, 'last');

        return $this;
    }

    /**
    * Add a channel element indicating the program used to generate the feed.
    *
    * @return   self
    */
    public function addGenerator()
    {
        if ($this->version == Feed::ATOM)
            $this->setChannelElement('atom:generator', 'FeedWriter', array('uri' => 'https://github.com/mibe/FeedWriter'));
        else if ($this->version == Feed::RSS2)
            $this->setChannelElement('generator', 'FeedWriter');
        else
            die('The generator element is not supported in RSS1 feeds.');

        return $this;
    }

    /**
    * Add a XML namespace to the internal list of namespaces. After that,
    * custom channel elements can be used properly to generate a valid feed.
    *
    * @access   public
    * @param    string  namespace prefix
    * @param    string  namespace name (URI)
    * @return   self
    * @link     http://www.w3.org/TR/REC-xml-names/
    */
    public function addNamespace($prefix, $uri)
    {
        $this->namespaces[$prefix] = $uri;

        return $this;
    }

    /**
    * Add a channel element to the feed.
    *
    * @access   public
    * @param    string  name of the channel tag
    * @param    string  content of the channel tag
    * @param    array   array of element attributes with attribute name as array key
    * @param    bool    TRUE if this element can appear multiple times
    * @return   self
    */
    public function setChannelElement($elementName, $content, $attributes = null, $multiple = false)
    {
        $entity['content'] = $content;
        $entity['attributes'] = $attributes;

        if ($multiple === TRUE)
            $this->channels[$elementName][] = $entity;
        else
            $this->channels[$elementName] = $entity;

        return $this;
    }

    /**
    * Set multiple channel elements from an array. Array elements
    * should be 'channelName' => 'channelContent' format.
    *
    * @access   public
    * @param    array   array of channels
    * @return   self
    */
    public function setChannelElementsFromArray($elementArray)
    {
        if (!is_array($elementArray))
            return;

        foreach ($elementArray as $elementName => $content) {
            $this->setChannelElement($elementName, $content);
        }

        return $this;
    }

    /**
    * Get the appropriate MIME type string for the current feed.
    *
    * @access   public
    * @return   string  The MIME type string.
    */
    public function getMIMEType()
    {
        switch ($this->version) {
            case Feed::RSS2 : $mimeType = "application/rss+xml";
                break;
            case Feed::RSS1 : $mimeType = "application/rdf+xml";
                break;
            case Feed::ATOM : $mimeType = "application/atom+xml";
                break;
            default : $mimeType = "text/xml";
        }

        return $mimeType;
    }

    /**
    * Print the actual RSS/ATOM file
    *
    * Sets a Content-Type header and echoes the contents of the feed.
    * Should only be used in situations where direct output is desired;
    * if you need to pass a string around, use generateFeed() instead.
    *
    * @access   public
    * @param    bool    FALSE if the specific feed media type should be sent.
    * @return   void
    */
    public function printFeed($useGenericContentType = false)
    {
        $contentType = "text/xml";

        if (!$useGenericContentType) {
            $contentType = $this->getMIMEType();
        }

        header("Content-Type: " . $contentType);
        echo $this->generateFeed();
    }

    /**
    * Generate the feed.
    *
    * @access   public
    * @return   string  The complete feed XML.
    */
    public function generateFeed()
    {
        return $this->makeHeader()
            . $this->makeChannels()
            . $this->makeItems()
            . $this->makeFooter();
    }

    /**
    * Create a new Item.
    *
    * @access   public
    * @return   object  instance of Item class
    */
    public function createNewItem()
    {
        $Item = new Item($this->version);

        return $Item;
    }

    /**
     * Add a properties to be CDATA encoded
     *
     * @access  public
     * @param   array   An array of properties that are merged into the list of properties should be encoded as CDATA
     * @return  self
     */
    public function addCDATAEncoding(Array $property_list)
    {
        $this->CDATAEncoding = array_merge($this->CDATAEncoding, $property_list);

        return $this;
    }

    /**
     * Get list of CDATA encoded properties
     *
     * @access  public
     * @return  array   Return an array of CDATA properties that are to be encoded as CDATA
     */
    public function getCDATAEncoding()
    {
        return $this->CDATAEncoding;
    }

    /**
    * Add a FeedItem to the main class
    *
    * @access   public
    * @param    Item    instance of Item class
    * @return   self
    */
    public function addItem(Item $feedItem)
    {
        if ($feedItem->getVersion() != $this->version)
            die('Feed type mismatch: This instance can handle ' . $this->version . ' feeds only, but item with type ' . $feedItem->getVersion() . ' given.');

        $this->items[] = $feedItem;

        return $this;
    }

    // Wrapper functions -------------------------------------------------------------------

    /**
    * Set the 'encoding' attribute in the XML prolog.
    *
    * @access   public
    * @param    string  value of 'encoding' attribute
    * @return   self
    */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
    * Set the 'title' channel element
    *
    * @access   public
    * @param    string  value of 'title' channel tag
    * @return   self
    */
    public function setTitle($title)
    {
        return $this->setChannelElement('title', $title);
    }

    /**
    * Set the date when the ATOM feed was lastly updated.
    *
    * This adds the 'updated' element to the feed. The value of the date parameter
    * can be either an instance of the DateTime class, an integer containing a UNIX
    * timestamp or a string which is parseable by PHP's 'strtotime' function.
    *
    * Not supported in RSS1 feeds.
    *
    * @access   public
    * @param    DateTime|int|string  Date which should be used.
    * @return   self
    */
    public function setDate($date)
    {
        if ($this->version == Feed::RSS1)
            die('The publication date is not supported in RSS1 feeds.');

        // The feeds have different date formats.
        $format = $this->version == Feed::ATOM ? \DATE_ATOM : \DATE_RSS;

        if ($date instanceof DateTime)
            $date = $date->format($format);
        else if(is_numeric($date) && $date >= 0)
            $date = date($format, $date);
        else if (is_string($date))
            $date = date($format, strtotime($date));
        else
            die('The given date was not an instance of DateTime, a UNIX timestamp or a date string.');

        if ($this->version == Feed::ATOM)
            $this->setChannelElement('updated', $date);
        else
            $this->setChannelElement('lastBuildDate', $date);

        return $this;
    }

    /**
    * Set the 'description' channel element
    *
    * @access   public
    * @param    string  value of 'description' channel tag
    * @return   self
    */
    public function setDescription($description)
    {
        if ($this->version != Feed::ATOM)
            $this->setChannelElement('description', $description);

        return $this;
    }

    /**
    * Set the 'link' channel element
    *
    * @access   public
    * @param    string  value of 'link' channel tag
    * @return   self
    */
    public function setLink($link)
    {
        if ($this->version == Feed::ATOM)
            $this->setChannelElement('link', '', array('href' => $link));
        else
            $this->setChannelElement('link', $link);

        return $this;
    }

    /**
    * Set custom 'link' channel elements.
    *
    * In ATOM feeds, only one link with alternate relation and the same combination of
    * type and hreflang values.
    *
    * @access   public
    * @param    string  URI of this link
    * @param    string  relation type of the resource
    * @param    string  MIME type of the target resource
    * @param    string  language of the resource
    * @param    string  human-readable information about the resource
    * @param    int     length of the resource in bytes
    * @link     https://www.iana.org/assignments/link-relations/link-relations.xml
    * @link     https://tools.ietf.org/html/rfc4287#section-4.2.7
    * @return   self
    */
    public function setAtomLink($href, $rel = null, $type = null, $hreflang = null, $title = null, $length = null)
    {
        $data = array('href' => $href);

        if ($rel != null) {
            if (!is_string($rel) || empty($rel))
                die('rel parameter must be a string and a valid relation identifier.');

            $data['rel'] = $rel;
        }
        if ($type != null) {
            // Regex used from RFC 4287, page 41
            if (!is_string($type) || preg_match('/.+\/.+/', $type) != 1)
                die('type parameter must be a string and a MIME type.');

            $data['type'] = $type;
        }
        if ($hreflang != null) {
            // Regex used from RFC 4287, page 41
            if (!is_string($hreflang) || preg_match('/[A-Za-z]{1,8}(-[A-Za-z0-9]{1,8})*/', $hreflang) != 1)
                die('hreflang parameter must be a string and a valid language code.');

            $data['hreflang'] = $hreflang;
        }
        if ($title != null) {
            if (!is_string($title) || empty($title))
                die('title parameter must be a string and not empty.');

            $data['title'] = $title;
        }
        if ($length != null) {
            if (!is_int($length) || $length < 0)
                die('length parameter must be a positive integer.');

            $data['length'] = (string) $length;
        }

        // ATOM spec. has some restrictions on atom:link usage
        // See RFC 4287, page 12 (4.1.1)
        if ($this->version == Feed::ATOM) {
            foreach ($this->channels as $key => $value) {
                if ($key != 'atom:link')
                    continue;

                // $value is an array , so check every element
                foreach ($value as $linkItem) {
                    // Only one link with relation alternate and same hreflang & type is allowed.
                    if (@$linkItem['rel'] == 'alternate' && @$linkItem['hreflang'] == $hreflang && @$linkItem['type'] == $type)
                        die('The feed must not contain more than one link element with a relation of "alternate"'
                        . ' that has the same combination of type and hreflang attribute values.');
                }
            }
        }

        return $this->setChannelElement('atom:link', '', $data, true);
    }

    /**
    * Set an 'atom:link' channel element with relation=self attribute.
    * Needs the full URL to this feed.
    *
    * @link     http://www.rssboard.org/rss-profile#namespace-elements-atom-link
    * @access   public
    * @param    string  URL to this feed
    * @return   self
    */
    public function setSelfLink($url)
    {
        return $this->setAtomLink( $url, 'self', $this->getMIMEType());
    }

    /**
    * Set the 'image' channel element
    *
    * @access   public
    * @param    string  title of image
    * @param    string  link url of the image
    * @param    string  path url of the image
    * @return   self
    */
    public function setImage($title, $link, $url)
    {
        return $this->setChannelElement('image', array('title'=>$title, 'link'=>$link, 'url'=>$url));
    }

    /**
    * Set the 'about' channel element. Only for RSS 1.0
    *
    * @access   public
    * @param    string  value of 'about' channel tag
    * @return   self
    */
    public function setChannelAbout($url)
    {
        $this->data['ChannelAbout'] = $url;

        return $this;
    }

    /**
    * Generate an UUID.
    *
    * The UUID is based on an MD5 hash. If no key is given, a unique ID as the input
    * for the MD5 hash is generated.
    *
    * @author   Anis uddin Ahmad <admin@ajaxray.com>
    * @param    string  optional key on which the UUID is generated
    * @param    string  an optional prefix
    * @return   string  the formated UUID
    */
    public static function uuid($key = null, $prefix = '')
    {
        $key = ($key == null) ? uniqid(rand()) : $key;
        $chars = md5($key);
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);

        return $prefix . $uuid;
    }

    /**
    * Replace invalid xml utf-8 chars.
    *
    * See utf8_for_xml() function at
    * http://www.phpwact.org/php/i18n/charsets#xml and
    * http://www.w3.org/TR/REC-xml/#charsets
    *
    * @param    string
    * @return   string
    */
    public static function utf8_for_xml($string)
    {
        return preg_replace('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $string);
    }
    // End # public functions ----------------------------------------------

    // Start # private functions ----------------------------------------------

    /**
    * Returns all used XML namespace prefixes in this instance.
    * This includes all channel elements and feed items.
    * Unfortunately some namespace prefixes are not included,
    * because they are hardcoded, e.g. rdf.
    *
    * @access   private
    * @return   array   Array with namespace prefix as value.
    */
    private function getNamespacePrefixes()
    {
        $prefixes = array();

        // Get all tag names from channel elements...
        $tags = array_keys($this->channels);

        // ... and now all names from feed items
        foreach ($this->items as $item)
            $tags = array_merge($tags, array_keys($item->getElements()));

        // Look for prefixes in those tag names
        foreach ($tags as $tag) {
            $elements = explode(':', $tag);

            if (count($elements) != 2)
                continue;

            $prefixes[] = $elements[0];
        }

        return array_unique($prefixes);
    }

    /**
    * Returns the XML header and root element, depending on the feed type.
    *
    * @access   private
    * @return   string  The XML header of the feed.
    */
    private function makeHeader()
    {
        $out = '<?xml version="1.0" encoding="'.$this->encoding.'" ?>' . PHP_EOL;

        $prefixes = $this->getNamespacePrefixes();
        $attributes = array();
        $tagName = '';
        $defaultNamespace = '';

        if ($this->version == Feed::RSS2) {
            $tagName = 'rss';
            $attributes['version'] = '2.0';
        } elseif ($this->version == Feed::RSS1) {
            $tagName = 'rdf:RDF';
            $prefixes[] = 'rdf';
            $defaultNamespace = $this->namespaces['rss1'];
        } elseif ($this->version == Feed::ATOM) {
            $tagName = 'feed';
            $defaultNamespace = $this->namespaces['atom'];

            // Ugly hack to remove the 'atom' value from the prefixes array.
            $prefixes = array_flip($prefixes);
            unset($prefixes['atom']);
            $prefixes = array_flip($prefixes);
        }

        // Iterate through every namespace prefix and add it to the element attributes.
        foreach ($prefixes as $prefix) {
            if (!isset($this->namespaces[$prefix]))
                die('Unknown XML namespace prefix: \'' . $prefix . '\'. Use the addNamespace method to add support for this prefix.');
            else
                $attributes['xmlns:' . $prefix] = $this->namespaces[$prefix];
        }

        // Include default namepsace, if required
        if (!empty($defaultNamespace))
            $attributes['xmlns'] = $defaultNamespace;

        $out .= $this->makeNode($tagName, '', $attributes, true);

        return $out;
    }
    
    /**
    * Closes the open tags at the end of file
    *
    * @access   private
    * @return   string  The XML footer of the feed.
    */
    private function makeFooter()
    {
        if ($this->version == Feed::RSS2) {
            return '</channel>' . PHP_EOL . '</rss>';
        } elseif ($this->version == Feed::RSS1) {
            return '</rdf:RDF>';
        } elseif ($this->version == Feed::ATOM) {
            return '</feed>';
        }
    }

    /**
    * Creates a single node in XML format
    *
    * @access   private
    * @param    string  name of the tag
    * @param    mixed   tag value as string or array of nested tags in 'tagName' => 'tagValue' format
    * @param    array   Attributes (if any) in 'attrName' => 'attrValue' format
    * @param    string  True if the end tag should be omitted. Defaults to false.
    * @return   string  formatted xml tag
    */
    private function makeNode($tagName, $tagContent, $attributes = null, $omitEndTag = false)
    {
        $nodeText = '';
        $attrText = '';

        if (is_array($attributes) && count($attributes) > 0) {
            foreach ($attributes as $key => $value) {
                $value = self::utf8_for_xml($value);
                $value = htmlspecialchars($value);
                $attrText .= " $key=\"$value\"";
            }
        }

        if (is_array($tagContent) && $this->version == Feed::RSS1) {
            $attrText = ' rdf:parseType="Resource"';
        }

        $attrText .= (in_array($tagName, $this->CDATAEncoding) && $this->version == Feed::ATOM) ? ' type="html"' : '';
        $nodeText .= "<{$tagName}{$attrText}>";
        $nodeText .= (in_array($tagName, $this->CDATAEncoding)) ? '<![CDATA[' : '';

        if (is_array($tagContent)) {
            foreach ($tagContent as $key => $value) {
                $nodeText .= $this->makeNode($key, $value);
            }
        } else {
            $tagContent = self::utf8_for_xml($tagContent);
            $nodeText .= (in_array($tagName, $this->CDATAEncoding)) ? $this->sanitizeCDATA($tagContent) : htmlspecialchars($tagContent);
        }

        $nodeText .= (in_array($tagName, $this->CDATAEncoding)) ? ']]>' : '';

        if (!$omitEndTag)
            $nodeText .= "</$tagName>";

        $nodeText .= PHP_EOL;

        return $nodeText;
    }

    /**
    * Make the channels.
    *
    * @access   private
    * @return   string  The feed header as XML containing all the feed metadata.
    */
    private function makeChannels()
    {
        $out = '';

        //Start channel tag
        switch ($this->version) {
            case Feed::RSS2:
                $out .= '<channel>' . PHP_EOL;
                break;
            case Feed::RSS1:
                $out .= (isset($this->data['ChannelAbout']))? "<channel rdf:about=\"{$this->data['ChannelAbout']}\">" : "<channel rdf:about=\"{$this->channels['link']}\">";
                break;
        }

        //Print Items of channel
        foreach ($this->channels as $key => $value) {
            // In ATOM feeds, strip all ATOM namespace prefixes from the tag name. They are not needed here,
            // because the ATOM namespace name is set as default namespace.
            if ($this->version == Feed::ATOM && strncmp($key, 'atom', 4) == 0) {
                $key = substr($key, 5);
            }
            
            // The channel element can occur multiple times, when the key 'content' is not in the array.
            if (!isset($value['content'])) {
                // If this is the case, iterate through the array with the multiple elements.
                foreach ($value as $singleElement) {
                    $out .= $this->makeNode($key, $singleElement['content'], $singleElement['attributes']);
                }
            } else {
                $out .= $this->makeNode($key, $value['content'], $value['attributes']);
            }
        }

        if ($this->version == Feed::RSS1) {
            //RSS 1.0 have special tag <rdf:Seq> with channel
            $out .= "<items>" . PHP_EOL . "<rdf:Seq>" . PHP_EOL;
            foreach ($this->items as $item) {
                $thisItems = $item->getElements();
                $out .= "<rdf:li resource=\"{$thisItems['link']['content']}\"/>" . PHP_EOL;
            }
            $out .= "</rdf:Seq>" . PHP_EOL . "</items>" . PHP_EOL . "</channel>" . PHP_EOL;
        } else if ($this->version == Feed::ATOM) {
            // ATOM feeds have a unique feed ID. This is generated from the 'link' channel element.
            $out .= $this->makeNode('id', Feed::uuid($this->channels['link']['attributes']['href'], 'urn:uuid:'));
        }

        return $out;
    }

    /**
    * Prints formatted feed items
    *
    * @access   private
    * @return   string  The XML of every feed item.
    */
    private function makeItems()
    {
        $out = '';

        foreach ($this->items as $item) {
            $thisItems = $item->getElements();

            // the argument is printed as rdf:about attribute of item in rss 1.0
            $out .= $this->startItem($thisItems['link']['content']);

            foreach ($thisItems as $feedItem) {
                $name = $feedItem['name'];

                // Strip all ATOM namespace prefixes from tags when feed is an ATOM feed.
                // Not needed here, because the ATOM namespace name is used as default namespace.
                if ($this->version == Feed::ATOM && strncmp($name, 'atom', 4) == 0)
                    $name = substr($name, 5);

                $out .= $this->makeNode($name, $feedItem['content'], $feedItem['attributes']);
            }
            $out .= $this->endItem();
        }

        return $out;
    }

    /**
    * Make the starting tag of channels
    *
    * @access   private
    * @param    string  The vale of about tag which is used for RSS 1.0 only.
    * @return   string  The starting XML tag of an feed item.
    */
    private function startItem($about = false)
    {
        $out = '';

        if ($this->version == Feed::RSS2) {
            $out .= '<item>' . PHP_EOL;
        } elseif ($this->version == Feed::RSS1) {
            if ($about) {
                $out .= "<item rdf:about=\"$about\">" . PHP_EOL;
            } else {
                throw new \Exception("link element is not set - It's required for RSS 1.0 to be used as the about attribute of the item tag.");
            }
        } elseif ($this->version == Feed::ATOM) {
            $out .= "<entry>" . PHP_EOL;
        }

        return $out;
    }

    /**
    * Closes feed item tag
    *
    * @access   private
    * @return   string  The ending XML tag of an feed item.
    */
    private function endItem()
    {
        if ($this->version == Feed::RSS2 || $this->version == Feed::RSS1) {
            return '</item>' . PHP_EOL;
        } elseif ($this->version == Feed::ATOM) {
            return '</entry>' . PHP_EOL;
        }
    }

    /**
    * Sanitizes data which will be later on returned as CDATA in the feed.
    *
    * A "]]>" respectively "<![CDATA" in the data would break the CDATA in the
    * XML, so the brackets are converted to a HTML entity.
    *
    * @access   private
    * @param    string  Data to be sanitized
    * @return   string  Sanitized data
    */
    private function sanitizeCDATA($text)
    {
        $text = str_replace("]]>", "]]&gt;", $text);
        $text = str_replace("<![CDATA[", "&lt;![CDATA[", $text);

        return $text;
    }
}


//--------------------------------------------------------------------------------
//	Class:		rss1
//	Objective:	Wrapper for creating RSS1 feeds
//--------------------------------------------------------------------------------
class rss1 extends feed
{
    /**
    * {@inheritdoc}
    */
    public function __construct()
    {
        parent::__construct(Feed::RSS1);
    }
}


//--------------------------------------------------------------------------------
//	Class:		rss2
//	Objective:	Wrapper for creating RSS2 feeds
//--------------------------------------------------------------------------------
class rss2 extends feed
{
    /**
    * {@inheritdoc}
    */
    public function __construct()
    {
        parent::__construct(Feed::RSS2);
    }
}


//--------------------------------------------------------------------------------
//	Class:		atom
//	Objective:	Wrapper for creating ATOM feeds
//--------------------------------------------------------------------------------
class atom extends feed
{
    /**
    * {@inheritdoc}
    */
    public function __construct()
    {
        parent::__construct(Feed::ATOM);
    }

}

//--------------------------------------------------------------------------------
//	Class:		item
//	Objective:	Item class - Used as feed element in Feed class
//--------------------------------------------------------------------------------
class item
{
    /**
    * Collection of feed item elements
    */
    private $elements = array();

    /**
    * Contains the format of this feed.
    */
    private $version;

    /**
    * Is used as a suffix when multiple elements have the same name.
    **/
    private $_cpt = 0;

    /**
    * Constructor
    *
    * @param    constant  (RSS1/RSS2/ATOM) RSS2 is default.
    */
    public function __construct($version = Feed::RSS2)
    {
        $this->version = $version;
    }

    /**
    * Return an unique number
    *
    * @access   private
    * @return   int
    **/
    private function cpt()
    {
        return $this->_cpt++;
    }

    /**
    * Add an element to elements array
    *
    * @access   public
    * @param    string  The tag name of an element
    * @param    string  The content of tag
    * @param    array   Attributes (if any) in 'attrName' => 'attrValue' format
    * @param    boolean Specifies if an already existing element is overwritten.
    * @param    boolean Specifies if multiple elements of the same name are allowed.
    * @return   self
    */
    public function addElement($elementName, $content, $attributes = null, $overwrite = FALSE, $allowMultiple = FALSE)
    {
        $key = $elementName;

        // return if element already exists & if overwriting is disabled
        // & if multiple elements are not allowed.
        if (isset($this->elements[$elementName]) && !$overwrite) {
            if (!$allowMultiple)
                return;

            $key .= '-' . $this->cpt();
        }

        $this->elements[$key]['name']       = $elementName;
        $this->elements[$key]['content']    = $content;
        $this->elements[$key]['attributes'] = $attributes;

        return $this;
    }

    /**
    * Set multiple feed elements from an array.
    * Elements which have attributes cannot be added by this method
    *
    * @access   public
    * @param    array   array of elements in 'tagName' => 'tagContent' format.
    * @return   self
    */
    public function addElementArray($elementArray)
    {
        if (!is_array($elementArray))
            return;

        foreach ($elementArray as $elementName => $content) {
            $this->addElement($elementName, $content);
        }

        return $this;
    }

    /**
    * Return the collection of elements in this feed item
    *
    * @access   public
    * @return   array   All elements of this item.
    */
    public function getElements()
    {
        return $this->elements;
    }

    /**
    * Return the type of this feed item
    *
    * @access   public
    * @return   string  The feed type, as defined in Feed.php
    */
    public function getVersion()
    {
        return $this->version;
    }

    // Wrapper functions ------------------------------------------------------

    /**
    * Set the 'description' element of feed item
    *
    * @access   public
    * @param    string  The content of 'description' or 'summary' element
    * @return   self
    */
    public function setDescription($description)
    {
        $tag = ($this->version == Feed::ATOM) ? 'summary' : 'description';

        return $this->addElement($tag, $description);
    }

    /**
     * Set the 'content' element of the feed item
     * For ATOM feeds only
     *
     * @access  public
     * @param   string  Content for the item (i.e., the body of a blog post).
     * @return  self
     */
    public function setContent($content)
    {
        if ($this->version != Feed::ATOM)
            die('The content element is supported in ATOM feeds only.');

        return $this->addElement('content', $content, array('type' => 'html'));
    }

    /**
    * Set the 'title' element of feed item
    *
    * @access   public
    * @param    string  The content of 'title' element
    * @return   self
    */
    public function setTitle($title)
    {
        return $this->addElement('title', $title);
    }

    /**
    * Set the 'date' element of the feed item.
    *
    * The value of the date parameter can be either an instance of the
    * DateTime class, an integer containing a UNIX timestamp or a string
    * which is parseable by PHP's 'strtotime' function.
    *
    * @access   public
    * @param    DateTime|int|string  Date which should be used.
    * @return   self
    */
    public function setDate($date)
    {
        if (!is_numeric($date)) {
            if ($date instanceof DateTime)
                $date = $date->getTimestamp();
            else {
                $date = strtotime($date);

                if ($date === FALSE)
                    die('The given date string was not parseable.');
            }
        } elseif ($date < 0)
            die('The given date is not an UNIX timestamp.');

        if ($this->version == Feed::ATOM) {
            $tag    = 'updated';
            $value  = date(\DATE_ATOM, $date);
        } elseif ($this->version == Feed::RSS2) {
            $tag    = 'pubDate';
            $value  = date(\DATE_RSS, $date);
        } else {
            $tag    = 'dc:date';
            $value  = date("Y-m-d", $date);
        }

        return $this->addElement($tag, $value);
    }

    /**
    * Set the 'link' element of feed item
    *
    * @access   public
    * @param    string  The content of 'link' element
    * @return   void
    */
    public function setLink($link)
    {
        if ($this->version == Feed::RSS2 || $this->version == Feed::RSS1) {
            $this->addElement('link', $link);
        } else {
            $this->addElement('link','',array('href'=>$link));
            $this->addElement('id', Feed::uuid($link,'urn:uuid:'));
        }

        return $this;
    }

    /**
    * Attach a external media to the feed item.
    * Not supported in RSS 1.0 feeds.
    *
    * See RFC 4288 for syntactical correct MIME types.
    *
    * Note that you should avoid the use of more than one enclosure in one item,
    * since some RSS aggregators don't support it.
    *
    * @access   public
    * @param    string  The URL of the media.
    * @param    integer The length of the media.
    * @param    string  The MIME type attribute of the media.
    * @param    boolean Specifies, if multiple enclosures are allowed
    * @return   self
    * @link     https://tools.ietf.org/html/rfc4288
    */
    public function addEnclosure($url, $length, $type, $multiple = TRUE)
    {
        if ($this->version == Feed::RSS1)
            die('Media attachment is not supported in RSS1 feeds.');

        // the length parameter should be set to 0 if it can't be determined
        // see http://www.rssboard.org/rss-profile#element-channel-item-enclosure
        if (!is_numeric($length) || $length < 0)
            die('The length parameter must be an integer and greater or equals to zero.');

        // Regex used from RFC 4287, page 41
        if (!is_string($type) || preg_match('/.+\/.+/', $type) != 1)
            die('type parameter must be a string and a MIME type.');

        $attributes = array('length' => $length, 'type' => $type);

        if ($this->version == Feed::RSS2) {
            $attributes['url'] = $url;
            $this->addElement('enclosure', '', $attributes, FALSE, $multiple);
        } else {
            $attributes['href'] = $url;
            $attributes['rel'] = 'enclosure';
            $this->addElement('atom:link', '', $attributes, FALSE, $multiple);
        }

        return $this;
    }

    /**
    * Alias of addEnclosure, for backward compatibility. Using only this
    * method ensures that the 'enclosure' element will be present only once.
    *
    * @access   public
    * @param    string  The URL of the media.
    * @param    integer The length of the media.
    * @param    string  The MIME type attribute of the media.
    * @return   self
    * @link     https://tools.ietf.org/html/rfc4288
    * @deprecated Use the addEnclosure method instead.
    *
    **/
    public function setEnclosure($url, $length, $type)
    {
        return $this->addEnclosure($url, $length, $type, false);
    }

    /**
    * Set the 'author' element of feed item.
    * Not supported in RSS 1.0 feeds.
    *
    * @access   public
    * @param    string  The author of this item
    * @param    string  Optional email address of the author
    * @param    string  Optional URI related to the author
    * @return   self
    */
    public function setAuthor($author, $email = null, $uri = null)
    {
        switch ($this->version) {
            case Feed::RSS1: die('The author element is not supported in RSS1 feeds.');
                break;
            case Feed::RSS2:
                if ($email != null)
                    $author = $email . ' (' . $author . ')';

                $this->addElement('author', $author);
                break;
            case Feed::ATOM:
                $elements = array('name' => $author);

                // Regex from RFC 4287 page 41
                if ($email != null && preg_match('/.+@.+/', $email) == 1)
                    $elements['email'] = $email;

                if ($uri != null)
                    $elements['uri'] = $uri;

                $this->addElement('author', $elements);
                break;
        }

        return $this;
    }

    /**
    * Set the unique identifier of the feed item
    *
    * @access   public
    * @param    string  The unique identifier of this item
    * @param    boolean The value of the 'isPermaLink' attribute in RSS 2 feeds.
    * @return   self
    */
    public function setId($id, $permaLink = false)
    {
        if ($this->version == Feed::RSS2) {
            if (!is_bool($permaLink))
                die('The permaLink parameter must be boolean.');

            $permaLink = $permaLink ? 'true' : 'false';

            $this->addElement('guid', $id, array('isPermaLink' => $permaLink));
        } elseif ($this->version == Feed::ATOM) {
            $this->addElement('id', Feed::uuid($id,'urn:uuid:'), NULL, TRUE);
        } else
            die('A unique ID is not supported in RSS1 feeds.');

        return $this;
    }

 } // end of class Item
?>