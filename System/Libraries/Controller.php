<?php
/************************************************************/
/*                   CODER CONTROLLERS                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* CONTROLLER CLASS                                                                        *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil edilmeye ihtiyaç duymaz.     							  |
| Sınıfı Kullanırken      :	Direk erişim sağlamak istediğiniz sınıflara extends edilir.   |
| 																						  |
| Genel Kullanım:																          |
| Kütüphane, araç ve bileşenlere $this nesnesi ile erişim sağlayabilmek için 			  |
| oluşturulmuştur. Çalışılan sayfaya extends edilerek kullanabilirsiniz.				  |
|																						  |
******************************************************************************************/	
class Controller
{
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Nesnelere $this nesnesi ile erişmek için kullanılmaktadır.							  |
	| 																						  |
	******************************************************************************************/	
	public function __construct()
	{
		// ---------------------------------------------------------------------
		// Eğer çalışılan sayfada __construct yapıcısı kullanılırsa 
		// Conroller sınıfının sağlıklı çalışması için bu yöntemin için
		// parent::__construct() kodu ilave edilerek Conroller->__construct()
		// yönteminin çalışması sağlanır.
		// ---------------------------------------------------------------------
		zn::$use =& $this;
		// ---------------------------------------------------------------------
	}
		
	/******************************************************************************************
	* GET                                                                                     *
	*******************************************************************************************
	| Nesnelere $this nesnesi ile sınıflara erişmek için kullanılmaktadır.					  |
	| 																						  |
	******************************************************************************************/	
	public function __get($class)
	{
		// ---------------------------------------------------------------------
		// Nesnenin tanımlanmamış ise tanımlanmasını sağla.
		// ---------------------------------------------------------------------
		if( ! isset($this->$class) )
		{
			// Sınıf Tanımlaması Yapılıyor.
			$this->$class = uselib($class);	
			return $this->$class ;
		}
		// ---------------------------------------------------------------------
	}
}