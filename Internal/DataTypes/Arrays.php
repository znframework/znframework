<?php namespace ZN\DataTypes;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Datatype;
use ZN\Controller\Factory;
use ZN\Ability\Functionalization;

class Arrays extends Factory
{
    use Functionalization;

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

    /**
     * Functionalization
     * 
     * @var array
     */
    const functionalization = 
    [
        'merge'             => 'array_merge',
        'recursivemerge'    => 'array_merge_recursive',
        'flip'              => 'array_flip',
        'transform'         => 'array_flip',
        'unique'            => 'array_unique',
        'deleterecurrent'   => 'array_unique',
        'range'             => 'range',
        'series'            => 'range',
        'slice'             => 'array_slice',
        'section'           => 'array_slice',
        'splice'            => 'array_splice',
        'resection'         => 'array_splice',
        'reverse'           => 'array_reverse',
        'rand'              => 'array_rand',
        'random'            => 'array_rand',
        'map'               => 'array_map',
        'implementcallback' => 'array_map',
        'count'             => 'count',
        'length'            => 'count',
        'column'            => 'array_column',
        'product'           => 'array_product',
        'sum'               => 'array_sum',
        'intersect'         => 'array_intersect',
        'intersectkey'      => 'array_intersect_key',
        'combine'           => 'array_combine',
        'chunk'             => 'array_chunk',
        'apportion'         => 'array_chunk',
        'key'               => 'key',
        'current'           => 'current',
        'value'             => 'current',
        'values'            => 'array_values',
        'keys'              => 'array_keys'
    ];

    /**
     * Multiple Key
     * 
     * @param array  $array
     * @param string $keySplit = '|'
     * 
     * @return array
     */
    public static function multikey(Array $array, String $keySplit = '|') : Array
    {
        return Datatype::multikey($array, $keySplit);
    }


    /**
     * Value Exists
     * 
     * @param array $array
     * @param mixed $element
     * @param bool  $strict = false
     * 
     * @return bool
     */
    public static function valueExists(Array $array, $element, Bool $strict = false) : Bool
    {
        return in_array($element, $array, $strict);
    }

    /**
     * Value Exists Insensitive
     * 
     * @param array $array
     * @param mixed $element
     * @param bool  $strict = false
     * 
     * @return bool
     */
    public static function valueExistsInsensitive(Array $array, $element, Bool $strict = false) : Bool
    {
        return self::valueExists(array_map('strtolower', $array), strtolower($element), $strict);
    }

    /**
     * Key Exists
     * 
     * @param array $array
     * @param mixed $key
     * 
     * @return bool
     */
    public static function keyExists(Array $array, $key) : Bool
    {
        return array_key_exists($key, $array);
    }

    /**
     * Key Exists Insensitive
     * 
     * @param array $array
     * @param mixed $key
     * 
     * @return bool
     */
    public static function keyEsistsInsensitive(Array $array, $key) : Bool
    {
        return self::keyExists(array_change_key_case($array), strtolower($key));
    }

    /**
     * Search
     * 
     * @param array $array
     * @param mixed $element
     * @param bool  $strict = false
     * 
     * @return bool
     */
    public static function search(Array $array, $element, Bool $strict = false)
    {
        return array_search($element, $array, $strict);
    }

    /**
     * Count Same Values
     * 
     * @param array $array
     * @param mixed $key = NULL
     * 
     * @return int|false
     */
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
