<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Services\URL;
use ZN\Services\URI;

class Pagination implements PaginationInterface
{
    /**
     * Keep settings
     * 
     * @var array
     */
    protected $settings = [];

    /**
     * Keep style & css.
     * 
     * @var string
     */
    protected $lc, $ls;

    /**
     * Default total rows
     * 
     * @var int
     */
    protected $totalRows = 50;
    
    /**
     * Default start value
     * 
     * @var int
     */
    protected $start = 0;

    /**
     * Default pagination type
     * 
     * @var string
     */
    protected $type = 'classic';

    /**
     * Default limit value
     * 
     * @var int
     */
    protected $limit = 10;

    /**
     * Default count links
     * 
     * @var int
     */
    protected $countLinks = 10;

    /**
     * Keep class value
     * 
     * @var array
     */
    protected $class = [];

    /**
     * Keep style value
     * 
     * @var array
     */
    protected $style = [];

    /**
     * Default prev tag name
     * 
     * @var string
     */
    protected $prevTag = '[prev]';

     /**
     * Default next tag name
     * 
     * @var string
     */
    protected $nextTag = '[next]';

     /**
     * Default first tag name
     * 
     * @var string
     */
    protected $firstTag = '[first]';

     /**
     * Default last tag name
     * 
     * @var string
     */
    protected $lastTag = '[last]';

     /**
     * Default url
     * 
     * @var string
     */
    protected $url = CURRENT_CFPATH;

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->config = \Config::viewObjects('pagination');
    }

    /**
     * Specifies the URL.
     * 
     * @param string $url
     * 
     * @return Pagination
     */
    public function url(String $url) : Pagination
    {
        $this->settings['url'] = $url;

        return $this;
    }

    /**
     * Sets the paging initial value.
     * 
     * @param mixed $start
     * 
     * @return Pagination
     */
    public function start($start) : Pagination
    {
        $this->settings['start'] = $start;

        return $this;
    }

    /**
     * Sets the amount of data to be displayed at one time.
     * 
     * @param int $limit
     * 
     * @return Pagination
     */
    public function limit(Int $limit) : Pagination
    {
        $this->settings['limit'] = $limit;

        return $this;
    }

    /**
     * Pagination usage type.
     * If you select Ajax, ajax needs to be written. 
     * Several data are defined for this.
     * 
     * @param string $type - options[ajax|classic]
     */
    public function type(String $type) : Pagination
    {
        $this->settings['type'] = $type;

        return $this;
    }

    /**
     * Sets the total number of records.
     * 
     * @param int $totalRows
     * 
     * @return Pagination
     */
    public function totalRows(Int $totalRows) : Pagination
    {
        $this->settings['totalRows'] = $totalRows;

        return $this;
    }

    /**
     * Sets the number of page links to be displayed at one time.
     * 
     * @param int $countLinks
     * 
     * @return Pagination
     */
    public function countLinks(Int $countLinks) : Pagination
    {
        $this->settings['countLinks'] = $countLinks;

        return $this;
    }

    /**
     * Change the names of links.
     * 
     * @param string $prev
     * @param string $next
     * @param string $first
     * @param string $last
     * 
     * @return Pagination
     */
    public function linkNames(String $prev, String $next, String $first, String $last) : Pagination
    {
        $this->settings['prevName']  = $prev;
        $this->settings['nextName']  = $next;
        $this->settings['firstName'] = $first;
        $this->settings['lastName']  = $last;

        return $this;
    }

    /**
     * Sets paging's css values.
     * 
     * @param array $css
     * 
     * @return Pagination
     */
    public function css(Array $css) : Pagination
    {
        $this->settings['class'] = $css;

        return $this;
    }

    /**
     * Sets paging's style values.
     * 
     * @param array $style
     * 
     * @return Pagination
     */
    public function style(Array $style) : Pagination
    {
        $this->settings['style'] = $style;

        return $this;
    }

    /**
     * protected uri get control
     * 
     * @param string $page
     * 
     * @return string
     */
    protected function _uriGetControl($page)
    {
        if( strstr($this->url, '?') )
        {
            $urlEx = explode('?', $this->url);

            return suffix($urlEx[0]) . $page . '?' . rtrim($urlEx[1], '/');
        }

        return suffix($this->url) . $page;
    }

    /**
     * Returns the current URL for paging.
     * 
     * @param string $page = NULL
     * 
     * @return string
     */
    public function getURI(String $page = NULL) : String
    {
        return $this->_uriGetControl($page);
    }

    /**
     * Configures all settings of the page.
     * 
     * @param array $cofig = []
     * 
     * @return Pagination
     */
    public function settings(Array $config = []) : Pagination
    {
        $configs = $this->config;

        if( isset($config['totalRows']) )   $this->totalRows    = $config['totalRows'];
        if( isset($config['start']) )       $this->start        = $config['start'];
        if( isset($config['limit']) )       $this->limit        = $config['limit'];
        if( isset($config['countLinks']) )  $this->countLinks   = $config['countLinks'];
        if( isset($config['prevName']) )    $this->prevTag      = $config['prevName'];
        if( isset($config['nextName']) )    $this->nextTag      = $config['nextName'];
        if( isset($config['firstName']) )   $this->firstTag     = $config['firstName'];
        if( isset($config['lastName']) )    $this->lastTag      = $config['lastName'];
        if( isset($config['type']) )        $this->type         = $config['type'];

        $this->class = array_merge($configs['class'], ( $config['class'] ?? []) );
        $this->style = array_merge($configs['style'], ( $config['style'] ?? []) );

        if( isset($config['url']) && $this->type !== 'ajax' )
        {
            $this->url = suffix(URL::site($config['url']));
        }
        elseif( $this->type === 'ajax' )
        {
            $this->url = '#prow=';
        }
        else
        {
            $this->url = CURRENT_CFURL;
        }

        return $this;
    }

    /**
     * Creates the pagination.
     * 
     * @param mixed $start
     * @param array $settings = []
     * 
     * @return string
     */
    public function create($start = NULL, Array $settings = []) : String
    {
        $settings = array_merge($this->config, $this->settings, $settings);

        if( ! empty($settings) )
        {
            $this->settings($settings);
        }

        if( $this->start !== NULL )
        {
            $start = (int) $this->start;
        }

        $page = ''; $links = '';

         if( empty($start) && ! is_numeric($start) )
        {
            $startPage = ! is_numeric($segment = URI::segment(-1)) ? 0 : $segment;
        }
        else
        {
            $startPage = ! is_numeric($start) ? 0 : $start;
        }

        $this->limit     = $this->limit === 0 ? 1 : $this->limit;
        $perPage         = ceil($this->totalRows / $this->limit);

        $linksClass      = $this->_classLink('links');
        $linksStyle      = $this->_styleLink('links');

        $linksStyleClass = $linksClass . $linksStyle;

        if( $this->countLinks > $perPage )
        {
            # Links 
            for( $i = 1; $i <= $perPage; $i++ )
            {
                $page = ($i - 1) * $this->limit;

                if( $i - 1 == floor($startPage / $this->limit) )
                {
                    $currentLinkClass = $this->_class('current');
                    $currentLinkStyle = $this->_style('current');
                    $currentLink      = $currentLinkClass . $currentLinkStyle;
                }
                else
                {
                    $currentLink = $linksStyleClass;
                }

                $links .= $this->_link($page, $currentLink, $i);
            }
            # Links

            # Prev tag
            if( $startPage != 0 )
            {
                $classPrev  = $this->_class('prev');
                $stylePrev  = $this->_style('prev');

                $pageRowNumber = $startPage - $this->limit;
                $firstStcl     = $classPrev . $stylePrev;
                $first         = $this->_link($pageRowNumber, $firstStcl, $this->prevTag);
            }
            else
            {
                $first = '';
            }
            # Prev tag

            # Next tag
            if( $startPage != $page )
            {
                $classNext = $this->_class('next');
                $styleNext = $this->_style('next');

                $pageRowNumber = $startPage + $this->limit;
                $lastStcl      = $classNext . $styleNext;
                $last          = $this->_link($pageRowNumber, $lastStcl, $this->nextTag);
            }
            else
            {
                $last = '';
            }
            # Next tag

            if( $this->totalRows > $this->limit )
            {
                return $first.' '.$links.' '.$last;
            }
            else
            {
                return false;
            }
        }
        else
        {
            $perPage = $this->countLinks;

            $lastTagClass     = $this->_class('last');
            $firstTagClass    = $this->_class('first');
            $nextTagClass     = $this->_class('next');
            $currentLinkClass = $this->_class('current');
            $prevTagClass     = $this->_class('prev');

            $lastTagStyle     = $this->_style('last');
            $firstTagStyle    = $this->_style('first');
            $nextTagStyle     = $this->_style('next');
            $currentLinkStyle = $this->_style('current');
            $prevTagStyle     = $this->_style('prev');
        
            # Last tag
            $mod       = ( $this->totalRows % $this->limit );
            $outNumber = ( $mod == 0 ? $this->limit : 0 );

            $pageRowNumber     = ($this->totalRows - ($this->totalRows % $this->limit) ) - $outNumber;
            $lastTagStyleClass = $lastTagClass . $lastTagStyle;
            $lastTag           = $this->_link($pageRowNumber, $lastTagStyleClass, $this->lastTag);
            # Last tag

            # First tag
            $firstTagStyleClass = $firstTagClass.$firstTagStyle;
            $firstTag = $this->_link(0, $firstTagStyleClass, $this->firstTag);
            # First tag

            if( $startPage > 0 )
            {
                # Prev tag
                $pageRowNumber     = $startPage    - $this->limit;
                $prevTagStyleClass = $prevTagClass . $prevTagStyle;
                $first             = $this->_link($pageRowNumber, $prevTagStyleClass, $this->prevTag);
                # Prev tag
            }
            else
            {
                $first = '';
            }

            if( ($startPage / $this->limit) == 0 )
            {
                $pagIndex = 1;
            }
            else
            {
                $pagIndex = floor( $startPage / $this->limit + 1);
            }

            if( $startPage < $this->totalRows - $this->limit )
            {
                # Next tag
                $pageRowNumber     = $startPage    + $this->limit;
                $nextTagStyleClass = $nextTagClass . $nextTagStyle;
                $last              = $this->_link($pageRowNumber, $nextTagStyleClass, $this->nextTag);
                # Next tag
            }
            else
            {
                $last       = '';
                $lastTag    = '';
                $pagIndex   = ceil($this->totalRows / $this->limit) - $this->countLinks + 1;
            }

            if( $pagIndex < 1 || $startPage == 0 )
            {
                $firstTag = '';
            }

            $nPerPage = $perPage + $pagIndex - 1;

            if( $nPerPage >= ceil($this->totalRows / $this->limit) )
            {
                $nPerPage  = ceil($this->totalRows / $this->limit);
                $lastTag   = '';
                $last      = '';
            }

            $links = '';

            for( $i = $pagIndex; $i <= $nPerPage; $i++ )
            {
                $page = ($i - 1) * $this->limit;

                if( $i - 1 == floor((int)$startPage / $this->limit) )
                {
                    $currentLink = $currentLinkClass.$currentLinkStyle;
                }
                else
                {
                    $currentLink = $linksStyleClass;
                }

                $links .= $this->_link($page, $currentLink, $i);
            }

            if( $this->totalRows > $this->limit )
            {
                return $firstTag.' '.$first.' '.$links.' '.$last.' '.$lastTag;
            }
            else
            {
                return false;
            }
        }
    }

    /**
     * protected link
     * 
     * @param string $var
     * @param string $fix
     * @param string $val
     * 
     * @return string
     */
    protected function _link($var, $fix, $val)
    {
        return '<a href="'.$this->_uriGetControl($var).'"'.$this->_ajax($var).$fix.'>'.$val.'</a>';
    }

    /**
     * protected style link
     * 
     * @param string $var
     * @param string $type = 'style'
     * 
     * @return string
     */
    protected function _styleLink($var, $type = 'style')
    {
        $l = ( ! empty($this->{$type}[$var]) ) ? $this->{$type}[$var].' ' : '';

        if( $type === 'class' ) $this->lc = $l; else $this->ls = $l;
   
        return ! empty($l) ? ' '.$type.'="'.trim($l).'"' : '';
    }

    /**
     * protected class  link
     * 
     * @param string $var
     * 
     * @return string
     */
    protected function _classLink($var)
    {
        return $this->_styleLink($var, 'class');
    }

    /**
     * protected class
     * 
     * @param string $var
     * @param string $type = 'class'
     * 
     * @return string
     */
    protected function _class($var, $type = 'class')
    {
        return ( $status = trim(( $type === 'class' ? $this->lc : $this->ls) . $this->{$type}[$var]) ) 
               ? ' '.$type.'="'.$status.'" ' 
               : '';
    }

   /**
     * protected style
     * 
     * @param string $var
     * 
     * @return string
     */
    protected function _style($var)
    {
        return $this->_class($var, 'style');
    }

    /**
     * protected ajax
     * 
     * @param string $value
     * 
     * @return mixed
     */
    protected function _ajax($value)
    {
        if( $this->type === 'ajax' )
        {
            return ' prow="'.$value.'" ptype="ajax"';
        }
    }
}
