<?php namespace ZN\Services\Request;

use Security, CallController, ZN\In, Lang, URL, Config, IS, Arrays;

class InternalURI extends CallController implements InternalURIInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Get
    //--------------------------------------------------------------------------------------------------------
    //
    // @param scalar $get
    // @param scalar $index
    // @param bool   $while
    //
    //--------------------------------------------------------------------------------------------------------
    public function get($get = 1, $index = 1, Bool $while = false) : String
    {
        // Parametre kontrolleri yapılıyor. ---------------------------------------------------
        if( ! IS::char($index) )
        {
            $index = 1;
        }

        if( ! is_scalar($while) )
        {
            $while = false;
        }
        // ------------------------------------------------------------------------------------

        $segArr = $this->segmentArray();
        $segVal = '';

        if( is_numeric($get) )
        {
            return $this->getByIndex($get, $index);
        }

        if( in_array($get, $segArr) )
        {
            $segVal = array_search($get, $segArr);

            // 3. parametrenin boş olmama durumu ve
            // 2. parametrenin sayısal olmama durumu
            if( ! empty($while) && ! is_numeric($index) )
            {
                return $this->getByName($get, $index);
            }

            // 2. parametrenin all olma durumu
            // 1. parametreden itibaren bütün
            // segmentleri verir.
            if( $index === 'all' )
            {
                return $this->getNameAll($get);
            }

            // 3. parametrenin boş olmaması durumu
            if( ! empty($while) )
            {
                $return = '';

                $countSegArr = count($segArr) - 1;

                if( $index > $countSegArr )
                {
                    $index = $countSegArr;
                }

                if( $index < 0 )
                {
                    $index = $countSegArr + $index + 1;
                }

                for( $i = 1; $i <= $index; $i++ )
                {
                    $return .= $segArr[$segVal + $i]."/";
                }

                $return = substr($return,0,-1);

                return $return;
            }

            // 2. parametrenin count olma durumu
            // 1. parametrede belirtilen segmentten
            // itibaren kalan bölüm sayısını verir.
            if( $index === "count" )
            {
                return $this->getNameCount($get);
            }

            if( isset($segArr[$segVal + $index]) )
            {
                return $segArr[$segVal + $index];
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // getNameCount
    //--------------------------------------------------------------------------------------------------------
    //
    // Belirtilen segmentten sonra kaç adet segmentin olduğunu verir.
    //
    // @param string $get
    //
    //--------------------------------------------------------------------------------------------------------
    public function getNameCount(String $get) : Int
    {
        $segArr = $this->segmentArray();

        if( in_array($get, $segArr) )
        {
            $segVal = array_search($get, $segArr);

            return count($segArr) - 1 - $segVal;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // getNameAll
    //--------------------------------------------------------------------------------------------------------
    //
    // Belirtilen segmentten sonra tüm segmentleri verir.
    //
    // @param string $get
    //
    //--------------------------------------------------------------------------------------------------------
    public function getNameAll(String $get) : String
    {
        $segArr = $this->segmentArray();

        if( in_array($get, $segArr) )
        {
            $return = '';

            $segVal = array_search($get, $segArr);

            for( $i = 1; $i < count($segArr) - $segVal; $i++ )
            {
                $return .= $segArr[$segVal + $i]."/";
            }

            $return = substr($return, 0, -1);

            return $return;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // getByIndex
    //--------------------------------------------------------------------------------------------------------
    //
    // Belirtilen segment indekslerine göre aralık almak için kullanılır.
    //
    // @param numeric $get
    // @param numeric $get
    //
    //--------------------------------------------------------------------------------------------------------
    public function getByIndex(Int $get = 1, Int $index = 1) : String
    {
        $segArr = $this->segmentArray();

        if( $get == 0 )
        {
            $get = 1;
        }

        $get -= 1;

        $uri = '';

        $countSegArr = count($segArr);

        if( $index < 0 )
        {
            $index = $countSegArr + $index + 1;
        }

        if( $index > 0 )
        {
            $index = $get + $index;
        }

        if( abs($index) > $countSegArr )
        {
            $index = $countSegArr;
        }

        for( $i = $get; $i < $index; $i++ )
        {
            $uri .= $segArr[$i].'/';
        }

        return rtrim($uri, '/');
    }

    //--------------------------------------------------------------------------------------------------------
    // Get Name
    //--------------------------------------------------------------------------------------------------------
    //
    // Belirtilen segment isimlerine göre aralık almak için kullanılır.
    //
    // @param string $get
    // @param string $get
    //
    //--------------------------------------------------------------------------------------------------------
    public function getByName(String $get, $index = NULL) : String
    {
        $segArr   = $this->segmentArray();

        $getVal   = array_search($get, $segArr);

        if( $index === 'all' )
        {
            $indexVal = count($segArr) - 1;
        }
        else
        {
            $indexVal = array_search($index, $segArr);
        }

        $return   = '';

        for( $i = $getVal; $i <= $indexVal; $i++ )
        {
            $return .= $segArr[$i]."/";
        }

        return substr($return, 0, -1);
    }

    //--------------------------------------------------------------------------------------------------------
    // Segment Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function segmentArray() : Array
    {
        $segmentEx = Arrays::deleteElement(explode('/', $this->_cleanPath()), '');

        return $segmentEx;
    }

    //--------------------------------------------------------------------------------------------------------
    // Total Segments
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalSegments() : Int
    {
        $segmentEx     = array_diff($this->segmentArray(), ["", " "]);
        $totalSegments = count($segmentEx);

        return $totalSegments;
    }

    //--------------------------------------------------------------------------------------------------------
    // Segment Count
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function segmentCount() : Int
    {
        return $this->totalSegments();
    }

    //--------------------------------------------------------------------------------------------------------
    // Segment -> 5.3.34[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $seg
    //
    //--------------------------------------------------------------------------------------------------------
    public function segment(Int $seg = 1) : String
    {
        $segments = $this->segmentArray();

        if( $seg > 0 )
        {
            $seg -= 1;
        }
        elseif( $seg < 0 )
        {
            $count = count($segments);
            $seg   = $count + $seg;
        }

        $select = $segments[$seg] ?? false;

        if( ! empty($select) )
        {
            return $segments[$seg];
        }
        elseif( $select === '0' ) // 5.3.34[added]
        {
            return (int) $select;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Current Segment
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function currentSegment() : String
    {
        return $this->current(false);
    }

    //--------------------------------------------------------------------------------------------------------
    // Current
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool   $isPath: true
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function current(Bool $isPath = true) : String
    {
        $currentPagePath = str_replace(Lang::get().'/', '', server('currentPath'));

        if( isset($currentPagePath[0]) && $currentPagePath[0] === '/' )
        {
            $currentPagePath = substr($currentPagePath, 1, strlen($currentPagePath) - 1);
        }

        if( $isPath === true )
        {
            return $currentPagePath;
        }
        else
        {
            $str = explode('/', $currentPagePath);

            if( count($str) > 1 )
            {
                return $str[count($str) - 1];
            }

            return $str[0];
        }
    }

    //--------------------------------------------------------------------------------------------------
    // active()
    //--------------------------------------------------------------------------------------------------
    //
    // @param bool $fullPath = false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------
    public function active(Bool $fullPath = false) : String
    {
        // 5.3.22[edited]
        $requestUri = suffix(server('requestUri'));

        $currentUri = BASE_DIR !== '/'
                    ? str_replace(BASE_DIR, '', $requestUri)
                    : substr($requestUri, 1);

        if( $fullPath === false )
        {
            $currentUri = In::cleanURIPrefix($currentUri, INDEX_STATUS);
            $currentUri = In::cleanURIPrefix($currentUri, In::getCurrentProject());

            if( $currentLang = Lang::current() )
            {
                $isLang = \Strings::divide($currentUri, '/');

                if( strlen($isLang) === 2 )
                {
                    $currentLang = $isLang;
                }

                $currentUri  = In::cleanURIPrefix($currentUri, $currentLang);
            }
        }

        return ! empty($currentUri) ? $currentUri : Config::get('Services', 'route')['openController'];
    }

    //--------------------------------------------------------------------------------------------------------
    // Base
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool   $isPath: true
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function base(String $uri = NULL, Int $index = 0) : String
    {
        $newBaseDir = substr(BASE_DIR, 1);

        if( BASE_DIR !== '/' )
        {
            if( $index < 0 )
            {
                $baseDir    = substr(BASE_DIR, 1, -1);
                $baseDir    = explode('/', $baseDir);
                $newBaseDir = '';

                for( $i = 0; $i < count($baseDir) + $index; $i++ )
                {
                    $newBaseDir .= suffix($baseDir[$i]);
                }
            }
        }

        return In::cleanInjection($newBaseDir . $uri);
    }

    //--------------------------------------------------------------------------------------------------------
    // Prev
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool   $isPath: true
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function prev(Bool $isPath = true) : String
    {
        if( ! isset($_SERVER['HTTP_REFERER']) )
        {
            return false;
        }

        $str = str_replace(URL::site(), '', $_SERVER['HTTP_REFERER']);

        if( $isPath === true )
        {
            return $str;
        }
        else
        {
            return \Strings::divide($str, '/', -1);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Clean Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //--------------------------------------------------------------------------------------------------------
    protected function _cleanPath()
    {
        $pathInfo = Security::htmlEncode($this->active());

        return $pathInfo;
    }
}
