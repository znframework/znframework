<?php namespace ZN\ViewObjects;

use URI, CLController;

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

        $this->class = array_merge($configs['class'], ( isset($config['class']) ? $config['class'] : []) );
        $this->style = array_merge($configs['style'], ( isset($config['style']) ? $config['style'] : []) );

        if( isset($config['url']) && $this->type !== 'ajax' )
        {
            $this->url = suffix(siteUrl($config['url']));
        }
        elseif( $this->type === 'ajax' )
        {
            $this->url = '#prow=';
        }
        else
        {
            $this->url = suffix(CURRENT_CFURL);
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

        $page  = '';
        $links = '';

        // Sayfalama başlangıç parametresi boş ise
        // Uri bilgisindeki son segmenti
        // başlangıç değeri olarak ayarla
        if( empty($start) && ! is_numeric($start) )
        {
            // Eğer son segmen sayısal bir veri değilse
            // Başlangıç değerini 0 olarak ayarla.
            if( ! is_numeric(URI::segment(-1)) )
            {
                $startPage = 0;
            }
            else
            {
                // Son segment sayısal veri ise
                // başlangıç değeri olarak ayarla
                $startPage = URI::segment(-1);
            }
        }
        else
        {
            // @start parametresi boş değilse

            // @start parametresi sayılsal bir veri değilse
            // başlangıç değeri olarak 0 ayarla
            if( ! is_numeric($start) )
            {
                $start = 0;
            }

            // @start prametresi sayılsal bir değerse
            // bu değeri başlangıç değeri olarak ayarla.
            $startPage = $start;
        }

        // Kaç adet sayfa oluşacağı belirleniyor
        // Sayfa Sayısı = Toplam Satır / Limit
        $this->limit = $this->limit === 0 ? 1 : $this->limit;

        $perPage = ceil($this->totalRows / $this->limit);

        $lc = ( ! empty($this->class['links']) ) ? $this->class['links'].' ' : '';
        $ls = ( ! empty($this->style['links']) ) ? $this->style['links'].' ' : '';

        $linksClass = ! empty($lc) ? ' class="'.trim($lc).'"' : '';
        $linksStyle = ! empty($ls) ? ' style="'.trim($ls).'"' : '';

        $linksStyleClass = $linksClass.$linksStyle;

        // Toplam link sayısı sayfa sayısından büyükse
        if( $this->countLinks > $perPage )
        {
            // LINKS -------------------------------------------------------------------
            for( $i = 1; $i <= $perPage; $i++ )
            {
                $page = ($i - 1) * $this->limit;

                // Kontrolere göre varsa stil veya sınıf verileri ekleniyor.

                if( $i - 1 == floor($startPage / $this->limit) )
                {
                    $currentLinkClass = ( $classC = trim($lc.$this->class['current']) ) ? ' class="'.$classC.'"' : "";

                    $currentLinkStyle = ( $styleC = trim($ls.$this->style['current']) ) ? ' style="'.$styleC.'"' : "";

                    $currentLink = $currentLinkClass.$currentLinkStyle;
                }
                else
                {
                    $currentLink = $linksStyleClass;
                }

                $links .= '<a href="'.$this->url.$page.'"'.$this->_ajax($page).$currentLink.'>'.$i.'</a>';
            }
            // LINKS -------------------------------------------------------------------

            // PREV Sonraki butonu ile ilgili kontrol yapılıyor.
            // PREV TAG ---------------------------------------------------------------
            if( $startPage != 0 )
            {
                $classPrev  = ( $classP = trim($lc.$this->class['prev']) ) ? ' class="'.$classP.'"' : "";
                $stylePrev  = ( $styleP = trim($ls.$this->style['prev']) ) ? ' style="'.$styleP.'"' : "";
                $firstStcl  = $classPrev.$stylePrev;

                $pageRowNumber = $startPage - $this->limit;
                $first = '<a href="'.$this->url.$pageRowNumber.'"'.$this->_ajax($pageRowNumber).$firstStcl.'>'.$this->prevTag.'</a>';
            }
            else
            {
                $first = '';
            }
            // PREV TAG ---------------------------------------------------------------

            // NEXT Sonraki butonu ile ilgili kontrol yapılıyor.
            // NEXT TAG ---------------------------------------------------------------
            if( $startPage != $page )
            {
                $classNext = ( $classN = trim($lc.$this->class['next']) ) ? ' class="'.$classN.'"' : "";
                $styleNext = ( $styleN = trim($ls.$this->style['next']) ) ? ' style="'.$styleN.'"' : "";

                $pageRowNumber = $startPage + $this->limit;

                $lastUrl   = $this->url.($pageRowNumber);
                $lastStcl  = $classNext.$styleNext;

                $last = '<a href="'.$lastUrl.'"'.$this->_ajax($pageRowNumber).$lastStcl.'>'.$this->nextTag.'</a>';
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

            // Linkler için class kontrolleri sağlanıyor. ------------------------------

            // LAST LINK
            $lastTagClass     = ( $classLast = trim($lc.$this->class['last']) ) ? ' class="'.$classLast.'" ' : '';

            // FIRST LINK
            $firstTagClass    = ( $classFirst = trim($lc.$this->class['first']) ) ? ' class="'.$classFirst.'" ' : '';

            // NEXT LINK
            $nextTagClass     = ( $classNext = trim($lc.$this->class['next']) ) ? ' class="'.$classNext.'" ' : '';

            // CURRENT LINK
            $currentLinkClass = ( $classCurrent = trim($lc.$this->class['current']) ) ? ' class="'.$classCurrent.'" ' : '';

            // PREV
            $prevTagClass     = ( $classPrev = trim($lc.$this->class['prev']) ) ? ' class="'.$classPrev.'" ' : '';
            // -------------------------------------------------------------------------

            // Linkler için style kontrolleri sağlanıyor. ------------------------------

            // LAST LINK
            $lastTagStyle     = ( $styleLast = trim($ls.$this->style['last']) ) ? ' style="'.$styleLast.'" ' : '';

            // FIRST LINK
            $firstTagStyle    = ( $styleFirst = trim($ls.$this->style['first']) ) ? ' style="'.$styleFirst.'" ' : '';

            // NEXT LINK
            $nextTagStyle     = ( $styleNext = trim($ls.$this->style['next']) ) ? ' style="'.$styleNext.'" ' : '';

            // CURRENT LINK
            $currentLinkStyle = ( $styleCurrent = trim($ls.$this->style['current']) ) ? ' style="'.$styleCurrent.'" ' : '';
            // PREV
            $prevTagStyle     = ( $stylePrev = trim($ls.$this->style['prev']) ) ? ' style="'.$stylePrev.'" ' : '';
            // -------------------------------------------------------------------------

            // -------------------------------------------------------------------------
            // LAST TAG
            // -------------------------------------------------------------------------
            $mod       = ( $this->totalRows % $this->limit );
            $outNumber = ( $mod == 0 ? $this->limit : 0 );

            $pageRowNumber     = ($this->totalRows - ($this->totalRows % $this->limit) ) - $outNumber;
            $lastTagNum        = $this->url.$pageRowNumber;
            $lastTagStyleClass = $lastTagClass.$lastTagStyle;



            $lastTag = '<a href="'.$lastTagNum.'"'.$this->_ajax($pageRowNumber).$lastTagStyleClass.'>'.$this->lastTag.'</a>';
            // -------------------------------------------------------------------------

            // -------------------------------------------------------------------------
            // FIRST TAG
            // -------------------------------------------------------------------------
            $firstTagStyleClass = $firstTagClass.$firstTagStyle;

            $firstTag = '<a href="'.$this->url.'0"'.$this->_ajax(0).$firstTagStyleClass.'>'.$this->firstTag.'</a>';
            // -------------------------------------------------------------------------

            if( $startPage > 0 )
            {
                // -------------------------------------------------------------------------
                // PREV TAG
                // -------------------------------------------------------------------------
                $pageRowNumber = $startPage - $this->limit;
                $firstNum = $this->url.$pageRowNumber;
                $prevTagStyleClass = $prevTagClass.$prevTagStyle;

                $first = '<a href="'.$firstNum.'"'.$this->_ajax($pageRowNumber).$prevTagStyleClass.'>'.$this->prevTag.'</a>';
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
                $pageRowNumber = $startPage + $this->limit;
                $lastNum = $this->url.($pageRowNumber);
                $nextTagStyleClass = $nextTagClass.$nextTagStyle;

                $last = '<a href="'.$lastNum.'"'.$this->_ajax($pageRowNumber).$nextTagStyleClass.'>'.$this->nextTag.'</a>';
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

                // Aktif sayfa linki kontrol ediliyor.
                if( $i - 1 == floor((int)$startPage / $this->limit) )
                {
                    $currentLink = $currentLinkClass.$currentLinkStyle;
                }
                else
                {
                    $currentLink = $linksStyleClass;
                }

                $links .= '<a href="'.$this->url.$page.'"'.$this->_ajax($page).$currentLink.'>'.$i.'</a>';
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
    protected function _ajax($value)
    {
        if( $this->type === 'ajax' )
        {
            return ' prow="'.$value.'" ptype="ajax"';
        }
    }
}
