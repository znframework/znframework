<?php namespace ZN\DataTypes\Arrays;

class RemoveElement
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Remove Key
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $keys
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeKey(Array $array, $keys) : Array
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

    //--------------------------------------------------------------------------------------------------------
    // Remove Value
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $values
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeValue(Array $array, $values) : Array
    {
        return $this->deleteElement($array, $values);
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $keys
    // @param mixed $values
    //
    //--------------------------------------------------------------------------------------------------------
    public function remove(Array $array, $keys, $values) : Array
    {
        if( ! empty($keys) )
        {
            $array = $this->removeKey($array, $keys);
        }

        if( ! empty($values) )
        {
            $array = $this->removeValue($array, $values);
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove Last
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeLast(Array $array, Int $count = 1, $type = 'array_pop') : Array
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

    //--------------------------------------------------------------------------------------------------------
    // Remove First
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param numeric $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function removeFirst(Array $array, Int $count = 1) : Array
    {
        return $this->removeLast($array, $count, 'array_shift');
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $object
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteElement(Array $array, $object) : Array
    {
        if( ! is_array($object) )
        {
            $object = [$object];
        }

        return array_diff($array, $object);
    }
}
