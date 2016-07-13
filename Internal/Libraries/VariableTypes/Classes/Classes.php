<?php	
namespace ZN\VariableTypes;

class InternalClasses implements ClassesInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Undefined Method                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// __call()
	//																						  
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	/******************************************************************************************
	* IS RELATION		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Nesne ile sınıf arasında ebeveyn/çocuk ilişkisi var mı diye bakar.      |
		
	  @param  string $className
	  @param  object $object
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function isRelation($className = '', $object = '', $prefix = STATIC_ACCESS)
	{
		if( ! is_string($className) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(className)');	
		}
		
		if( ! is_object($object) )
		{
			return \Errors::set('Error', 'objectParameter', '2.(object)');	
		}
	
		return is_a($object, $prefix.$className);
	}
	
	/******************************************************************************************
	* IS PARENT  		                                                                      *
	*******************************************************************************************
	| Genel Kullanım:  Belirtilen sınıfın belirtilen nesnenin ebeveynlerinden biri olup 	  |
	  olmadığına bakar.																	      
		
	  @param  string $className
	  @param  object $object
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function isParent($className = '', $object = '', $prefix = STATIC_ACCESS)
	{
		if( ! is_string($className) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(className)');	
		}
	
		return is_subclass_of($object, $prefix.$className);
	}
	
	/******************************************************************************************
	* METHOD EXISTS  		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir sınıf yöntemi mevcut mu diye bakar.								  |																      
		
	  @param  string $className
	  @param  string $object
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function methodExists($className = '', $method = '', $prefix = STATIC_ACCESS)
	{
		if( ! is_string($className) || ! is_string($method) )
		{
			return \Errors::set('Error', 'stringParameter', '1.($className) & 2.(method)');	
		}
	
		return method_exists(uselib($prefix.$className), $method);
	}
	
	/******************************************************************************************
	* PROPERTY EXISTS  		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir nesne veya sınıfın belirtilen özelliğe sahip olup olmadığına bakar. |																      
		
	  @param  string $className
	  @param  string $object
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function propertyExists($className = '', $property = '', $prefix = STATIC_ACCESS)
	{
		if( ! is_string($className) || ! is_string($property) )
		{
			return \Errors::set('Error', 'stringParameter', '1.($className) & 2.(property)');	
		}
	
		return  property_exists(uselib($prefix.$className), $property);
	}
	
	/******************************************************************************************
	* METHODS			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sınıf yöntemlerinin isimlerini döndürür.							      |
	 
	  @param  mixed  $className
	  @param  string $prefix
	  @return array
	|          																				  |
	******************************************************************************************/
	public function methods($className = '' , $prefix = STATIC_ACCESS)
	{
		if( ! is_string($className) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(className)');	
		}
		
		return get_class_methods($prefix.$className);
	}
	
	/******************************************************************************************
	* VARS		  		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sınıfın öntanımlı özelliklerini döndürür.							      |
	 
	  @param  mixed  $className
	  @param  string $prefix
	  @return array
	|          																				  |
	******************************************************************************************/
	public function vars($className = '' , $prefix = STATIC_ACCESS)
	{
		if( ! is_string($className) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(className)');	
		}
		
		return get_class_vars($prefix.$className);
	}
	
	/******************************************************************************************
	* NAME		  		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir nesnenin ait olduğu sınıfın ismini döndürür.					      |
	 
	  @param  object $var
	  @param  string $prefix
	  @return string
	|          																				  |
	******************************************************************************************/
	public function name($var = '', $prefix = STATIC_ACCESS)
	{
		if( ! is_object($var) )
		{
			return \Errors::set('Error', 'objectParameter', '1.(var)');	
		}
		
		return str_replace($prefix, '', get_class($var));
	}	
	
	/******************************************************************************************
	* DECLARED		 	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Tanımlı sınıfların isimlerini bir dizi olarak döndürür.  			      |
	
	  @return array
	|          																				  |
	******************************************************************************************/
	public function declared()
	{
		return get_declared_classes();
	}	
	
	/******************************************************************************************
	* DECLARED INTERFACES 	                                                                  *
	*******************************************************************************************
	| Genel Kullanım:  Bildirilmiş tüm arayüzleri bir dizi olarak döndürür.  			      |
	
	  @return array
	|          																				  |
	******************************************************************************************/
	public function declaredInterfaces()
	{
		return get_declared_interfaces();
	}	
	
	/******************************************************************************************
	* DECLARED TRAITS  	                                                                      *
	*******************************************************************************************
	| Genel Kullanım:  Tüm bildirilen özellikleri bir dizi olarak döndürür.  			      |
	
	  @return array
	|          																				  |
	******************************************************************************************/
	public function declaredTraits()
	{
		return get_declared_traits();
	}	
}