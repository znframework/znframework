<?php namespace ZN\ViewObjects;

use URI, URL, CLController;

class InternalPagination extends CLController implements InternalPaginationInterface, InternalPaginationPropertiesInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'ViewObjects:pagination';

    //--------------------------------------------------------------------------------------------------------
    // Pagination Properties
    //--------------------------------------------------------------------------------------------------------
    //
    // Properties
    //
    //--------------------------------------------------------------------------------------------------------
    use InternalPaginationPropertiesTrait;

    //--------------------------------------------------------------------------------------------------------
    // Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $settings = [];

    //--------------------------------------------------------------------------------------------------------
    // Lc
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $lc, $ls;

    //--------------------------------------------------------------------------------------------------------
    // Protected URI Get Control
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _uriGetControl($page)
    {
        if( strstr($this->url, '?') )
        {
            $urlEx = explode('?', $this->url);

            return suffix($urlEx[0]) . $page . '?' . rtrim($urlEx[1], '/');
        }

        return suffix($this->url) . $page;
    }

    //--------------------------------------------------------------------------------------------------------
    // get URI
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $config
    //
    //--------------------------------------------------------------------------------------------------------
    public function getURI(String $page = NULL) : String
    {
        return $this->_uriGetControl($page);
    }

    //--------------------------------------------------------------------------------------------------------
    // Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $config
    //
    //--------------------------------------------------------------------------------------------------------
    public function settings(Array $config = []) : InternalPagination
    {
        $configs = VIEWOBJECTS_PAGINATION_CONFIG;

        // ---------------------------------------------------------------------------------------
        // Sayfalama Ayarlarını İçeren Değişkenler
        // ---------------------------------------------------------------------------------------
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
        // ---------------------------------------------------------------------------------------

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $start
    // @param array $settings
    //
    //--------------------------------------------------------------------------------------------------------
    public function create($start = NULL, Array $settings = []) : String
    {
        $settings = array_merge(VIEWOBJECTS_PAGINATION_CONFIG, $this->settings, $settings);

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
            // LINKS -------------------------------------------------------------------
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
            // LINKS -------------------------------------------------------------------

            // PREV TAG ---------------------------------------------------------------
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
            // PREV TAG ---------------------------------------------------------------

            // NEXT TAG ---------------------------------------------------------------
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
            // NEXT TAG ---------------------------------------------------------------

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
            // -------------------------------------------------------------------------

            // -------------------------------------------------------------------------
            // LAST TAG
            // -------------------------------------------------------------------------
            $mod       = ( $this->totalRows % $this->limit );
            $outNumber = ( $mod == 0 ? $this->limit : 0 );

            $pageRowNumber     = ($this->totalRows - ($this->totalRows % $this->limit) ) - $outNumber;
            $lastTagStyleClass = $lastTagClass . $lastTagStyle;
            $lastTag           = $this->_link($pageRowNumber, $lastTagStyleClass, $this->lastTag);
            // -------------------------------------------------------------------------

            // -------------------------------------------------------------------------
            // FIRST TAG
            // -------------------------------------------------------------------------
            $firstTagStyleClass = $firstTagClass.$firstTagStyle;

            $firstTag = $this->_link(0, $firstTagStyleClass, $this->firstTag);
            // -------------------------------------------------------------------------

            if( $startPage > 0 )
            {
                // -------------------------------------------------------------------------
                // PREV TAG
                // -------------------------------------------------------------------------
                $pageRowNumber     = $startPage    - $this->limit;
                $prevTagStyleClass = $prevTagClass . $prevTagStyle;
                $first             = $this->_link($pageRowNumber, $prevTagStyleClass, $this->prevTag);
                // -------------------------------------------------------------------------
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
                // -------------------------------------------------------------------------
                // NEXT TAG
                // -------------------------------------------------------------------------
                $pageRowNumber     = $startPage    + $this->limit;
                $nextTagStyleClass = $nextTagClass . $nextTagStyle;
                $last              = $this->_link($pageRowNumber, $nextTagStyleClass, $this->nextTag);
                // -------------------------------------------------------------------------
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
                // -------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Proctected
    //--------------------------------------------------------------------------------------------------------
    protected function _link($var, $fix, $val)
    {
        return '<a href="'.$this->_uriGetControl($var).'"'.$this->_ajax($var).$fix.'>'.$val.'</a>';
    }

    //--------------------------------------------------------------------------------------------------------
    // Proctected
    //--------------------------------------------------------------------------------------------------------
    protected function _styleLink($var, $type = 'style')
    {
        $l = ( ! empty($this->{$type}[$var]) ) ? $this->{$type}[$var].' ' : '';

        if( $type === 'class' ) $this->lc = $l; else $this->ls = $l;
   
        return ! empty($l) ? ' '.$type.'="'.trim($l).'"' : '';
    }

    //--------------------------------------------------------------------------------------------------------
    // Proctected
    //--------------------------------------------------------------------------------------------------------
    protected function _classLink($var)
    {
        return $this->_styleLink($var, 'class');
    }

    //--------------------------------------------------------------------------------------------------------
    // Proctected
    //--------------------------------------------------------------------------------------------------------
    protected function _class($var, $type = 'class')
    {
        return ( $status = trim(( $type === 'class' ? $this->lc : $this->ls) . $this->{$type}[$var]) ) ? ' '.$type.'="'.$status.'" ' : '';
    }

    //--------------------------------------------------------------------------------------------------------
    // Proctected
    //--------------------------------------------------------------------------------------------------------
    protected function _style($var)
    {
        return $this->_class($var, 'style');
    }

    //--------------------------------------------------------------------------------------------------------
    // Proctected
    //--------------------------------------------------------------------------------------------------------
    protected function _ajax($value)
    {
        if( $this->type === 'ajax' )
        {
            return ' prow="'.$value.'" ptype="ajax"';
        }
    }
}
