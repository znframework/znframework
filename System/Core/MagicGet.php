<?php
/************************************************************/
/*                   MAGICGET CONTROLLERS                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* MAGIC GET CLASS                                                                         *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil edilmeye ihtiyaç duymaz.     							  |
| Sınıfı Kullanırken      :	Dahil edilecek dosyalarda nesnelere direk erişim sağlamak	  |
| için oluşturulmuş sınıftır.   														  |
| 																						  |
| Genel Kullanım:																          |
| Kütüphane, araç ve bileşenlere $this nesnesi ile erişim sağlayabilmek için 			  |
| oluşturulmuştur. Dahil edilecek harici sınıflara extends edilerek kullanabilirsiniz.	  |
|																						  |
******************************************************************************************/	
class MagicGet
{
	// MagicGet sınıfı yapıcısı
	public function __construct()
	{
		// parent::__construct() yöntemini kullanabilmek
		// için içi boş olarak çalıştırılmaktadır.
	}
	
	// Nesneye erişmeye zorla
	public function __get($key)
	{
		return zn::$dynamic->$key;
	}
}