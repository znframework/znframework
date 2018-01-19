<?php namespace ZN\DataTypes\Arrays;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class RemoveElement
{
    /**
     * Remove Key
     * 
     * @param array $array
     * @param mixed $keys
     * 
     * @return array
     */
    public static function key(Array $array, $keys) : Array
    {
        if( ! is_array($keys) )
        {
            unset($array[$keys]);
        }
        else
        {
            foreach( $keys as $key )
            {
                unset($array[$key]);
            }
        }

        return $array;
    }

    /**
     * Remove Value
     * 
     * @param array $array
     * @param mixed $values
     * 
     * @return array
     */
    public static function value(Array $array, $values) : Array
    {
        return self::element($array, $values);
    }

    /**
     * Remove
     * 
     * @param array $array
     * @param mixed $keys
     * @param mixed $values
     * 
     * @return array
     */
    public static function use(Array $array, $keys, $values) : Array
    {
        if( ! empty($keys) )
        {
            $array = self::key($array, $keys);
        }

        if( ! empty($values) )
        {
            $array = self::value($array, $values);
        }

        return $array;
    }

    /**
     * Remove Last Element
     * 
     * @param array $array
     * @param int   $count = 1
     * 
     * @return array
     */
    public static function last(Array $array, Int $count = 1, $type = 'array_pop') : Array
    {
        if( $count <= 1 )
        {
            $type($array);
        }
        else
        {
            $arrayCount = count($array);

            for( $i = 1; $i <= $count; $i++ )
            {
                $type($array);

                if( $i === $arrayCount )
                {
                    break;
                }
            }
        }

        return $array;
    }

    /**
     * Remove First Element
     * 
     * @param array $array
     * @param int   $count = 1
     * 
     * @return array
     */
    public static function first(Array $array, Int $count = 1) : Array
    {
        return self::last($array, $count, 'array_shift');
    }

    /**
     * Delete Element
     * 
     * @param array $array
     * @param mixed $object
     * 
     * @return array
     */
    public static function element(Array $array, $object) : Array
    {
        if( ! is_array($object) )
        {
            $object = [$object];
        }

        return array_diff($array, $object);
    }
}
