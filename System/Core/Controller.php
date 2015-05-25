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
	// Controller sınıfı yapıcısı
	public function __construct()
	{
		// $this nesnesi zn::$dynamic nesnesi
		// aracılığı ile referans alınmaktadır.
		zn::$dynamic =& $this;
		
		// Dahil edilen kütüphaneler tanımlanıyor...
		zndynamic_autoloaded();
	}
}