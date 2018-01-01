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

use Config, ReflectionClass;
use ZN\DataTypes\Exception\InvalidArgumentException;
use ZN\DataTypes\Strings;

class Classes implements ClassesInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Reflection -> 5.4.5[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    //
    //--------------------------------------------------------------------------------------------------------
    public function reflection(String $className) : ReflectionClass
    {
        return new ReflectionClass($this->_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Relation
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    // @param object $object
    //
    //--------------------------------------------------------------------------------------------------------
    public function isRelation(String $className, $object) : Bool
    {
        if( ! is_object($object) )
        {
            throw new InvalidArgumentException('Error', 'objectParameter', '2.($object)');
        }

        return is_a($object, $this->_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Parent
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    // @param object $object
    //
    //--------------------------------------------------------------------------------------------------------
    public function isParent(String $className, $object) : Bool
    {
        return is_subclass_of($object, $this->_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Method Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    // @param object $method
    //
    //--------------------------------------------------------------------------------------------------------
    public function methodExists(String $className, String $method) : Bool
    {
        return method_exists(uselib($this->_class($className)), $method);
    }

    //--------------------------------------------------------------------------------------------------------
    // Property Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    // @param object $property
    //
    //--------------------------------------------------------------------------------------------------------
    public function propertyExists(String $className, String $property) : Bool
    {
        return  property_exists(uselib($this->_class($className)), $property);
    }

    //--------------------------------------------------------------------------------------------------------
    // Methods
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    //
    //--------------------------------------------------------------------------------------------------------
    public function methods(String $className)
    {
        return get_class_methods($this->_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Vars
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    //
    //--------------------------------------------------------------------------------------------------------
    public function vars(String $className)
    {
        return get_class_vars($this->_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param object $var
    //
    //--------------------------------------------------------------------------------------------------------
    public function name($var) : String
    {
        if( ! is_object($var) )
        {
            throw new InvalidArgumentException('Error', 'objectParameter', '1.($var)');
        }

        return get_class($var);
    }

    //--------------------------------------------------------------------------------------------------------
    // Declared
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function declared() : Array
    {
        return get_declared_classes();
    }

    //--------------------------------------------------------------------------------------------------------
    // Declared Interfaces
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function declaredInterfaces() : Array
    {
        return get_declared_interfaces();
    }

    //--------------------------------------------------------------------------------------------------------
    // Declared Traits
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function declaredTraits() : Array
    {
        return get_declared_traits();
    }

    //--------------------------------------------------------------------------------------------------------
    // Only Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $class
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function onlyName(String $class) : String
    {
        return Strings\Split::divide(str_replace(INTERNAL_ACCESS, '', $class), '\\', -1);
    }

    //--------------------------------------------------------------------------------------------------------
    // Public Class -> 5.4.5[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    //
    //--------------------------------------------------------------------------------------------------------
    public function class(String $className) : String
    {
        return $this->_class($className);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Class
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _class($name)
    {
        global $classMap;

        Config::get('ClassMap');

        $lowerName           = strtolower($name);
        $lowerInternalAccess = strtolower(INTERNAL_ACCESS);
        $flipClassMap        = array_flip($classMap['namespaces']);
        $lowerClass          = $lowerInternalAccess.$lowerName;

        if( ! empty($flipClassMap[$lowerName]) )
        {
            return $flipClassMap[$lowerName];
        }
        elseif( ! empty($flipClassMap[$lowerClass]) )
        {
            return $flipClassMap[$lowerClass];
        }
        elseif( ! empty($classMap['classes'][$lowerClass]) )
        {
            return $classMap['classes'][$lowerClass];
        }
        else
        {
            return $name;
        }
    }
}
