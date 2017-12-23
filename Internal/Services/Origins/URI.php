<?php namespace ZN\Services;

use ZN\In;
use ZN\DataTypes\Strings;
use ZN\DataTypes\Arrays;
use ZN\IndividualStructures\IS;
use ZN\IndividualStructures\Lang;
use ZN\IndividualStructures\Security;

class URI implements URIInterface
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
    // Magic Call -> 5.4.5
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        if( preg_match('/^(e|s)[0-9]+$/', $method) )
        {
            $typ = $method[0];
            $num = substr($method, 1);
            $val = $typ === 's' ? $num : -($num);
        
            return self::segment($val, ...$parameters);
        }

        return self::get($method, ...$parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Manipulation -> 5.3.9
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $rules
    // @param string $type = 'none', optional: left, right, both
    //
    //--------------------------------------------------------------------------------------------------------
    public static function manipulation(Array $rules, String $type = 'none') : String
    {
        $query = NULL;

        foreach( $rules as $key => $value )
        {
            if( is_numeric($key) )
            {
                if( ! empty($val = self::get($value)) )
                {
                    $query .= $value . '/' . $val . '/';
                }
            }
            else
            {
                $query .= $key . '/' . $value . '/';
            }
        }

        return self::_addFix($query, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Build Query -> 5.3.9
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data
    // @param string $seperator
    //
    //--------------------------------------------------------------------------------------------------------
    public static function buildQuery(Array $data, String $separator = '/', String $type = 'none') : String
    {
        $query = NULL;

        foreach( $data as $key => $value )
        {
            if( is_numeric($key) )
            {
                $query .= $value . '/';
            }
            else
            {
                $query .= $key . '/' . $value . '/';
            }
        }

        return self::_addFix($query, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Get
    //--------------------------------------------------------------------------------------------------------
    //
    // @param scalar $get
    // @param scalar $index
    // @param bool   $while
    //
    //--------------------------------------------------------------------------------------------------------
    public static function get($get = 1, $index = 1, Bool $while = false) : String
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

        $segArr = self::segmentArray();
        $segVal = '';

        if( is_numeric($get) )
        {
            return self::getByIndex($get, $index);
        }

        if( in_array($get, $segArr) )
        {
            $segVal = array_search($get, $segArr);

            // 3. parametrenin boş olmama durumu ve
            // 2. parametrenin sayısal olmama durumu
            if( ! empty($while) && ! is_numeric($index) )
            {
                return self::getByName($get, $index);
            }

            // 2. parametrenin all olma durumu
            // 1. parametreden itibaren bütün
            // segmentleri verir.
            if( $index === 'all' )
            {
                return self::getNameAll($get);
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
                return self::getNameCount($get);
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
    public static function getNameCount(String $get) : Int
    {
        $segArr = self::segmentArray();

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
    public static function getNameAll(String $get) : String
    {
        $segArr = self::segmentArray();

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
    public static function getByIndex(Int $get = 1, Int $index = 1) : String
    {
        $segArr = self::segmentArray();

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
    public static function getByName(String $get, $index = NULL) : String
    {
        $segArr   = self::segmentArray();

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
    public static function segmentArray() : Array
    {
        $segmentEx = Arrays\RemoveElement::element(explode('/', self::_cleanPath()), '');

        return $segmentEx;
    }

    //--------------------------------------------------------------------------------------------------------
    // Total Segments
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function totalSegments() : Int
    {
        $segmentEx     = array_diff(self::segmentArray(), ["", " "]);
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
    public static function segmentCount() : Int
    {
        return self::totalSegments();
    }

    //--------------------------------------------------------------------------------------------------------
    // Segment -> 5.3.34[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $seg
    //
    //--------------------------------------------------------------------------------------------------------
    public static function segment(Int $seg = 1) : String
    {
        $segments = self::segmentArray();

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
    public static function currentSegment() : String
    {
        return self::current(false);
    }

    //--------------------------------------------------------------------------------------------------------
    // Current
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool   $isPath: true
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function current(Bool $isPath = true) : String
    {
        $currentPagePath = str_replace(Lang::get().'/', '', server('currentPath'));

        if( ($currentPagePath[0] ?? NULL) === '/' )
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
    public static function active(Bool $fullPath = false) : String
    {
        // 5.3.22[edited]
        $requestUri = suffix(server('requestUri'));
       
        $currentUri = ! empty(BASE_DIR)
                      ? str_replace(prefix(BASE_DIR, '/'), '', $requestUri)
                      : substr($requestUri, 1);
        
        if( $fullPath === false )
        {
            $currentUri = In::cleanURIPrefix($currentUri, In::getCurrentProject());

            if( $currentLang = Lang::current() )
            {
                $isLang = Strings\Split::divide($currentUri, '/');

                if( strlen($isLang) === 2 )
                {
                    $currentLang = $isLang;
                }

                $currentUri  = In::cleanURIPrefix($currentUri, $currentLang);
            }
        }

        return ! empty($currentUri) ? $currentUri : \Config::get('Services', 'route')['openController'];
    }

    //--------------------------------------------------------------------------------------------------------
    // Base
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool   $isPath: true
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function base(String $uri = NULL, Int $index = 0) : String
    {
        return In::cleanInjection(BASE_DIR . $uri);
    }

    //--------------------------------------------------------------------------------------------------------
    // Prev
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool   $isPath: true
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public static function prev(Bool $isPath = true) : String
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
            return Strings\Split::divide($str, '/', -1);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Clean Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //--------------------------------------------------------------------------------------------------------
    protected static function _cleanPath()
    {
        $pathInfo = Security\Html::encode(self::active());

        return $pathInfo;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Add Fix -> 5.3.9
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string @query
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _addFix($query, $type)
    {
        $query = rtrim($query, '/');
        
        switch( $type )
        {
            case 'left'  : return prefix($query);
            case 'right' : return suffix($query);
            case 'both'  : return presuffix($query);
            default      : return $query;
        }
    }
}
