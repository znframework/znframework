<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ReflectionClass;
use ZN\Singleton;
use ZN\DataTypes\Strings;

class Classes
{
    //--------------------------------------------------------------------------------------------------------
    // Reflection -> 5.4.5[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    //
    //--------------------------------------------------------------------------------------------------------
    public static function reflection(String $className) : ReflectionClass
    {
        return new ReflectionClass(self::_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Relation
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    // @param object $object
    //
    //--------------------------------------------------------------------------------------------------------
    public static function isRelation(String $className, $object) : Bool
    {
        if( ! is_object($object) )
        {
            throw new InvalidArgumentException('Error', 'objectParameter', '2.($object)');
        }

        return is_a($object, self::_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Parent
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    // @param object $object
    //
    //--------------------------------------------------------------------------------------------------------
    public static function isParent(String $className, $object) : Bool
    {
        return is_subclass_of($object, self::_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Method Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    // @param object $method
    //
    //--------------------------------------------------------------------------------------------------------
    public static function methodExists(String $className, String $method) : Bool
    {
        return method_exists(Singleton::class(self::_class($className)), $method);
    }

    //--------------------------------------------------------------------------------------------------------
    // Property Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    // @param object $property
    //
    //--------------------------------------------------------------------------------------------------------
    public static function propertyExists(String $className, String $property) : Bool
    {
        return  property_exists(Singleton::class(self::_class($className)), $property);
    }

    //--------------------------------------------------------------------------------------------------------
    // Methods
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    //
    //--------------------------------------------------------------------------------------------------------
    public static function methods(String $className)
    {
        return get_class_methods(self::_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Vars
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $className
    //
    //--------------------------------------------------------------------------------------------------------
    public static function vars(String $className)
    {
        return get_class_vars(self::_class($className));
    }

    //--------------------------------------------------------------------------------------------------------
    // Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param object $var
    //
    //--------------------------------------------------------------------------------------------------------
    public static function name($var) : String
    {
        if( ! is_object($var) )
        {
            return false;
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
    public static function declared() : Array
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
    public static function declaredInterfaces() : Array
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
    public static function declaredTraits() : Array
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
    public static function onlyName(String $class) : String
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
    public static function class(String $className) : String
    {
        return self::_class($className);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Class
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _class($name)
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

class_alias('ZN\Classes', 'Classes');