<?php	
namespace ZN\VariableTypes;

interface ClassesInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* IS RELATION		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Nesne ile sınıf arasında ebeveyn/çocuk ilişkisi var mı diye bakar.      |
		
	  @param  string $className
	  @param  object $object
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function isRelation($className, $object, $prefix);
	
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
	public function isParent($className, $object, $prefix);
	
	/******************************************************************************************
	* METHOD EXISTS  		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir sınıf yöntemi mevcut mu diye bakar.								  |																      
		
	  @param  string $className
	  @param  string $object
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function methodExists($className, $method, $prefix);
	
	/******************************************************************************************
	* PROPERTY EXISTS  		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir nesne veya sınıfın belirtilen özelliğe sahip olup olmadığına bakar. |																      
		
	  @param  string $className
	  @param  string $object
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function propertyExists($className, $property, $prefix);
	
	/******************************************************************************************
	* METHODS			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sınıf yöntemlerinin isimlerini döndürür.							      |
	 
	  @param  mixed  $className
	  @param  string $prefix
	  @return array
	|          																				  |
	******************************************************************************************/
	public function methods($className, $prefix);
	
	/******************************************************************************************
	* VARS		  		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sınıfın öntanımlı özelliklerini döndürür.							      |
	 
	  @param  mixed  $className
	  @param  string $prefix
	  @return array
	|          																				  |
	******************************************************************************************/
	public function vars($className, $prefix);
	
	/******************************************************************************************
	* NAME		  		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir nesnenin ait olduğu sınıfın ismini döndürür.					      |
	 
	  @param  object $var
	  @param  string $prefix
	  @return string
	|          																				  |
	******************************************************************************************/
	public function name($var, $prefix);
	
	/******************************************************************************************
	* DECLARED		 	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Tanımlı sınıfların isimlerini bir dizi olarak döndürür.  			      |
	
	  @return array
	|          																				  |
	******************************************************************************************/
	public function declared();
	
	/******************************************************************************************
	* DECLARED INTERFACES 	                                                                  *
	*******************************************************************************************
	| Genel Kullanım:  Bildirilmiş tüm arayüzleri bir dizi olarak döndürür.  			      |
	
	  @return array
	|          																				  |
	******************************************************************************************/
	public function declaredInterfaces();
	
	/******************************************************************************************
	* DECLARED TRAITS  	                                                                      *
	*******************************************************************************************
	| Genel Kullanım:  Tüm bildirilen özellikleri bir dizi olarak döndürür.  			      |
	
	  @return array
	|          																				  |
	******************************************************************************************/
	public function declaredTraits();
}