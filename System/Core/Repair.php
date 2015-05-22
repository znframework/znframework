<?php 
/************************************************************/
/*                       REPAIR CLASS                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* REPAIR CLASS                                                                            *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil edilmeye ihtiyaç duymaz.     							  |
| Sınıfı Kullanırken      :	Sistem tarafından kullanılır.							      |
|																						  |
******************************************************************************************/	
class Repair
{
	public static function mode()
	{
		// Eğer ip tadilat ipsi olarak ayarlanmış ise 
		// bu ip'li bilgisayar tamir modundan etkilenmez.
		if( is_repmac() ) 
		{
			return false;
		}
		
		// Tamir moduna geçildiği durumnda tadilat makinesi olarak belirlenmeyen
		// diğer kullanıcı bilgisayarlarında herhangi bir hata ile karşı karşıya
		// kalmamaları için hata raporlama kapatılıyor.
		error_reporting(0); 
		
		// Config/Repair.php dosyasında tadilata alınacak sayfalar belirtilir.
		// Burada ayarlarda belirtilen sayfa isimleri bilgisi alınıyor.
		$repair_pages = config::get("Repair","pages");
		
		// Eğer Config/Repair.php dosyasında pages = "all" olarrak alınmış ise 
		// tüm sayfalar için tadilat modu uygulanıyor demektir.
		if( is_string($repair_pages) )
		{
			if( $repair_pages === "all" )
			{
				if( current_path() !== config::get("Repair","route_page") ) 
				{
					redirect(config::get("Repair","route_page"));
				}
			}
		}
		
		
		// Sayfalar tek tek çağrılıyor..
		if( is_array($repair_pages) )
		{
			// Eğer Config/Repair.php dosyasında pages = array("all") olarrak alınmış ise 
			// tüm sayfalar için tadilat modu uygulanıyor demektir.
			if( $repair_pages[0] === "all" )
			{
				if( current_path() !== config::get("Repair","route_page") ) 
				{
					redirect(config::get("Repair","route_page"));
				}
			}
			
			foreach($repair_pages as $rp)
			{
				// Gelen sayfa o anki url içinde geçip geçmediğini kontrol ediliyor.
				$page_pos = strstr(current_path(), $rp);	
				
				// Eğer gelen sayfa o anki url içinde geçiyorsa yani sonuc -1 den büyükse 
				// yönlendirme sayfası olarak belirlene sayfaya yönlendir.
				if( ! empty($page_pos) )
				{
					if( current_path() !== config::get("Repair","route_page") )
					{
						redirect(config::get("Repair","route_page"));
					}
				}	
			}
		}	
	}	
}
