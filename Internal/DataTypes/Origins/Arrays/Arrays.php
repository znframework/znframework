<?php namespace ZN\DataTypes;

use FactoryController;

class Arrays extends FactoryController
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
    // Factory Constant
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    const factory =
    [
        'methods' =>
        [
            'casing'                => 'Arrays\Casing::use',
            'lowercase'             => 'Arrays\Casing::lower',
            'uppercase'             => 'Arrays\Casing::upper',
            'titlecase'             => 'Arrays\Casing::title',
            'lowerkeys'             => 'Arrays\Casing::lowerKeys',
            'upperkeys'             => 'Arrays\Casing::upperKeys',
            'titlekeys'             => 'Arrays\Casing::titleKeys',
            'lowervalues'           => 'Arrays\Casing::lowerValues',
            'uppervalues'           => 'Arrays\Casing::upperValues',
            'titlevalues'           => 'Arrays\Casing::titleValues',
            'getfirst'              => 'Arrays\GetElement::first',
            'getlast'               => 'Arrays\GetElement::last',
            'addfirst'              => 'Arrays\AddElement::first',
            'addlast'               => 'Arrays\AddElement::last',
            'removekey'             => 'Arrays\RemoveElement::key',
            'removevalue'           => 'Arrays\RemoveElement::value',
            'remove'                => 'Arrays\RemoveElement::use',
            'removelast'            => 'Arrays\RemoveElement::last',
            'removefirst'           => 'Arrays\RemoveElement::first',
            'deleteelement'         => 'Arrays\RemoveElement::element',
            'order'                 => 'Arrays\Sort::order',
            'sort'                  => 'Arrays\Sort::normal',
            'descending'            => 'Arrays\Sort::descending',
            'ascending'             => 'Arrays\Sort::ascending',
            'ascendingkey'          => 'Arrays\Sort::ascendingKey',
            'descendingkey'         => 'Arrays\Sort::descendingKey',
            'userassocsort'         => 'Arrays\Sort::userAssoc',
            'userkeysort'           => 'Arrays\Sort::userKey',
            'usersort'              => 'Arrays\Sort::user',
            'insensitivesort'       => 'Arrays\Sort::insensitive',
            'naturalsort'           => 'Arrays\Sort::natural',
            'shuffle'               => 'Arrays\Sort::shuffle',
            'reverse'               => 'Arrays\Sort::reverse',
            'including'             => 'Arrays\Including::use',
            'include'               => 'Arrays\Including::use',
            'excluding'             => 'Arrays\Excluding::use',
            'exclude'               => 'Arrays\Excluding::use',
            'each'                  => 'Arrays\Each::use',
            'force'                 => 'Arrays\Force::do',
            'forcevalues'           => 'Arrays\Force::values',
            'forcekeys'             => 'Arrays\Force::keys',
            'keyval'                => 'Arrays\Element::use',
            'element'               => 'Arrays\Element::use',
            'unidimensional'        => 'Arrays\Unidimensional::do',
            'flatten'               => 'Arrays\Unidimensional::do'
        ]
    ];

    //--------------------------------------------------------------------------------------------------------
    // Methods
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $methods = 
    [
        'standart' => 
        [
            'merge', 
            'recursivemerge' => 'merge_recursive',
            'flip', 
            'transform' => 'flip', 
            'unique',
            'deleterecurrent' => 'unique',
            'range' => ':',
            'series' => ':range',
            'slice',
            'section' => 'slice',
            'splice',
            'resection' => 'splice',
            'reverse',
            'rand',
            'random' => 'rand',
            'map',
            'implementcallback' => 'map',
            'count' => ':',
            'length' => ':count',
            'column',
            'product',
            'sum',
            'intersect',
            'intersectkey' => 'intersect_key',
            'combine',
            'chunk',
            'apportion' => 'chunk',
            'key' => ':',
            'current' => ':',
            'value'   => ':current',
            'values',
            'keys'
        ]
    ];

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {   
        $lower  = strtolower($method);
      
        $select = in_array($lower, $this->methods['standart']) 
                ? $lower 
                : (($standart = ($this->methods['standart'][$lower] ?? NULL)) ? $standart : NULL);            
                    
        if( $select !== NULL )
        {
            if( $select[0] === ':' )
            {
                $call = ltrim($select, ':') ?: $lower;
            }
            else
            {
                $call = 'array_' . $select;
            }
            
            return $call(...$parameters);
        }
        
        return parent::__call($method, $parameters);       
    }

    //--------------------------------------------------------------------------------------------------------
    // Multikey
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $keySplit:|
    //
    //--------------------------------------------------------------------------------------------------------
    public static function multikey(Array $array, String $keySplit = '|') : Array
    {
        $newArray = [];

        foreach( $array as $k => $v )
        {
            $keys = explode($keySplit, $k);

            foreach( $keys as $val )
            {
                $newArray[$val] = $v;
            }
        }

        return $newArray;
    }


    //--------------------------------------------------------------------------------------------------------
    // Value Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $strict
    //
    //--------------------------------------------------------------------------------------------------------
    public static function valueExists(Array $array, $element, Bool $strict = false) : Bool
    {
        return in_array($element, $array, $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Value Exists Insensitive
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $insenstive
    //
    //--------------------------------------------------------------------------------------------------------
    public static function valueExistsInsensitive(Array $array, $element, Bool $strict = false) : Bool
    {
        return self::valueExists(array_map('strtolower', $array), strtolower($element), $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Key Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $key
    //
    //--------------------------------------------------------------------------------------------------------
    public static function keyExists(Array $array, $key) : Bool
    {
        return array_key_exists($key, $array);
    }

     //--------------------------------------------------------------------------------------------------------
    // Key Exists Insensitive
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $key
    //
    //--------------------------------------------------------------------------------------------------------
    public static function keyEsistsInsensitive(Array $array, $key) : Bool
    {
        return self::keyExists(array_change_key_case($array), strtolower($key));
    }

    //--------------------------------------------------------------------------------------------------------
    // Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    // @param bool  $strict
    //
    //--------------------------------------------------------------------------------------------------------
    public static function search(Array $array, $element, Bool $strict = false)
    {
        return array_search($element, $array, $strict);
    }

    //--------------------------------------------------------------------------------------------------------
    // Count Same Values
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $key
    //
    //--------------------------------------------------------------------------------------------------------
    public static function countSameValues(Array $array, String $key = NULL)
    {
        $return = array_count_values($array);

        if( ! empty($key) )
        {
            return $return[$key] ?? false;
        }

        return $return;
    }
}
