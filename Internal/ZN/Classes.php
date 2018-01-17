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

class Classes
{
    /**
     * Reflection Class
     * 
     * @param string $className
     * 
     * @return ReflectionClass
     */
    public static function reflection(String $className) : ReflectionClass
    {
        return new ReflectionClass(self::_class($className));
    }

    /**
     * Is Relation 
     * 
     * @param string $className
     * @param mixed  $object
     * 
     * @return bool
     */
    public static function isRelation(String $className, $object) : Bool
    {
        if( ! is_object($object) )
        {
            throw new InvalidArgumentException('Error', 'objectParameter', '2.($object)');
        }

        return is_a($object, self::_class($className));
    }

    /**
     * Is Parent 
     * 
     * @param string $className
     * @param mixed  $object
     * 
     * @return bool
     */
    public static function isParent(String $className, $object) : Bool
    {
        return is_subclass_of($object, self::_class($className));
    }

    /**
     * Method Exists
     * 
     * @param string $className
     * @param string $method
     * 
     * @return bool
     */
    public static function methodExists(String $className, String $method) : Bool
    {
        return method_exists(Singleton::class(self::_class($className)), $method);
    }

    /**
     * Property Exists
     * 
     * @param string $className
     * @param string $property
     * 
     * @return bool
     */
    public static function propertyExists(String $className, String $property) : Bool
    {
        return  property_exists(Singleton::class(self::_class($className)), $property);
    }

    /**
     * Get Methods
     * 
     * @param string $className
     * 
     * @return bool
     */
    public static function methods(String $className) : Array
    {
        return get_class_methods(self::_class($className));
    }

    /**
     * Get Vars
     * 
     * @param string $className
     * 
     * @return bool
     */
    public static function vars(String $className) : Array
    {
        return get_class_vars(self::_class($className));
    }

    /**
     * Get Class Name
     * 
     * @param object $var
     * 
     * @return string
     */
    public static function name($var) : String
    {
        if( ! is_object($var) )
        {
            return false;
        }

        return get_class($var);
    }

    /**
     * Get Declared Classes
     * 
     * @return array
     */
    public static function declared() : Array
    {
        return get_declared_classes();
    }

    /**
     * Get Declared Interfaces
     * 
     * @return array
     */
    public static function declaredInterfaces() : Array
    {
        return get_declared_interfaces();
    }

    /**
     * Get Declared Traits
     * 
     * @return array
     */
    public static function declaredTraits() : Array
    {
        return get_declared_traits();
    }

/**
     * Get Only Class Name
     * 
     * @param string $class
     * 
     * @return string
     */
    public static function onlyName(String $class) : String
    {
        return Datatype::divide(str_replace(INTERNAL_ACCESS, '', $class), '\\', -1);
    }

    /**
     * Get Class Name
     * 
     * @param string $clasName
     * 
     * @return string
     */
    public static function class(String $className) : String
    {
        return self::_class($className);
    }

    /**
     * Protected Class
     */
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
