<?php namespace ZN\ViewObjects\Bootstrap;

use CallController, Support, Json;

class InternalJQ extends CallController implements InternalJQInterface
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
    // Jquery Trait
    //--------------------------------------------------------------------------------------------------------
    //
    // @methods
    //
    //--------------------------------------------------------------------------------------------------------
    use JqueryTrait;

    //--------------------------------------------------------------------------------------------------------
    // Combines
    //--------------------------------------------------------------------------------------------------------
    //
    // @return array
    //
    // p1: selector
    // p2: param
    // p3: comma
    //
    //--------------------------------------------------------------------------------------------------------
    protected $combines =
    [
        'serialize'  , 'seralizearray', 'text'      , 'val'        , 'html'    ,
        'attr'       , 'prop'         , 'removeattr', 'append'     , 'prepend' ,
        'after'      , 'before'       , 'remove'    , 'empty'      , 'addclass',
        'removeclass', 'toggleclass'  , 'css'       , 'width'      , 'height'  ,
        'innerwidth' , 'innerheight'  , 'outerwidth', 'outerheight', 'parent'  ,
        'parents'    , 'parentsuntil' , 'children'  , 'find'       , 'siblings',
        'next'       , 'nextall'      , 'nextuntil' , 'prev'       , 'prevall' ,
        'prevuntil'  , 'first'        , 'last'      , 'eq'         , 'filter'  ,
        'not'        , 'load'         , 'data'      , 'each'       , 'index'   ,
        'removedata' , 'size'         , 'toarray'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Properties
    //--------------------------------------------------------------------------------------------------------
    //
    // @return array
    //
    // p1: param
    // p2: comma
    //
    //--------------------------------------------------------------------------------------------------------
    protected $properties =
    [
        'tojson', 'getjson', 'getscript', 'param', 'noconflict'
    ];

    //--------------------------------------------------------------------------------------------------------
    // toArray
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $selector
    // @param mixed  $params
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $params)
    {
        $lowerMethod = strtolower($method);

        if( in_array($lowerMethod, $this->combines) )
        {
            return $this->combine
            (
                $params[0] ?? 'this',
                $method,
                $params[1] ?? [],
                '',
                $params[2] ?? false
            );
        }
        elseif( in_array($lowerMethod, $this->properties) )
        {
            return '$'.$this->property
            (
                $method,
                $params[0] ?? [],
                $params[1] ?? false
            );
        }
        else
        {
            Support::classMethod(__CLASS__, $method);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // String Control
    //--------------------------------------------------------------------------------------------------------
    //
    // Metnin string olup olmadığı ayırt etmek için kullanılır. Parametre başında : nokta ile belirtilirse
    // verinin string olmadığı hiç bir şey belirtilmezse string veri olduğu anlaşılır. Bu durumda
    // metin için başına ve sonuna tırnak işaretleri kullanmanız gerekmez.
    //
    // @param  string $code
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function stringControl(String $code = '') : String
    {
        if( $code[0] === '+' )
        {
            $return = substr($code, 1);
        }
        elseif( $code[0] === '"' || $code[0] === "'" )
        {
            $return = $code;
        }
        elseif
        (
            $this->_isKeySelector($code) ||
            $this->_isFunc($code)        ||
            $this->_isJquery($code)      ||
            Json::check($code)           ||
            is_numeric($code)
        )
        {
            $return = $code;
        }
        else
        {
            $return = "\"".$this->_nailConvert($code)."\"";
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Selector
    //--------------------------------------------------------------------------------------------------------
    //
    // Seçici belirtmek için kullanılır.
    //
    // @param  string $selector
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function selector(String $selector = NULL) : String
    {
        if( empty($selector) )
        {
            $selector = 'this';
        }

        $code = $this->stringControl($selector);

        return "$($code)";
    }

    //--------------------------------------------------------------------------------------------------------
    // Property
    //--------------------------------------------------------------------------------------------------------
    //
    // Jquery propertisi oluşturmak için kullanılır.
    //
    // @param string $property
    // @param array  $params
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function property(String $property, $params = [], Bool $comma = false) : String
    {
        return ".$property(". $this->_params($params).")".($comma === true ? ";" : "");
    }

    //--------------------------------------------------------------------------------------------------------
    // Func
    //--------------------------------------------------------------------------------------------------------
    //
    // Jquery fonksiyonu oluşturmak için kullanılır.
    //
    // @param string $params
    // @param mixed  $code
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function function(String $params = NULL, $code = NULL, Bool $comma = false) : String
    {
        if( empty($code) )
        {
            return false;
        }

        if( is_callable($code) )
        {
            $code = \Buffer::callback($code);
        }

        return "function($params){".$code."}".($comma === true ? ";" : "");
    }

    //--------------------------------------------------------------------------------------------------------
    // Callback / Func
    //--------------------------------------------------------------------------------------------------------
    //
    // Jquery fonksiyonu oluşturmak için kullanılır.
    //
    // @param string $params
    // @param mixed  $code
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function callback(String $params = NULL, $code = NULL, Bool $comma = false) : String
    {
        return $this->function($params, $code, $comma);
    }

    //--------------------------------------------------------------------------------------------------------
    // Combine
    //--------------------------------------------------------------------------------------------------------
    //
    // Genel jquery komutu oluşturmak için kullanılır.
    //
    // @param string $selector
    // @param string $property
    // @param array  $params
    // @param string $callback
    // @param bool   $comma false
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function combine(String $selector = NULL, String $property = NULL, $params = NULL, $callback = NULL, Bool $comma = false) : String
    {
        if( ! empty($callback) )
        {
            $params = [$params, $this->function('e', $callback)];
        }

        $select = '';

        if( ! empty($selector) )
        {
            $select = $this->selector($selector);
        }

        return $select.$this->property($property, $params, $comma);
    }

    //--------------------------------------------------------------------------------------------------------
    // get
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $params
    // @param  boole  $comma
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function get(String $url = NULL, $callback = NULL, Bool $comma = true) : String
    {
        $params[] = $url;
        $params[] = $callback;

        return '$'.$this->property('get', $params, $comma);
    }

    //--------------------------------------------------------------------------------------------------------
    // post
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed  $params
    // @param  boole  $comma
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function post(String $url = NULL, String $data = NULL, $callback = NULL, Bool $comma = true) : String
    {
        $params[] = $url;
        $params[] = $data;
        $params[] = $callback;

        return '$'.$this->property('post', $params, $comma);
    }
}
