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
| Sınıfı Kullanırken      :	Sistem tarafından kullanılır.							      |
|																						  |
******************************************************************************************/	
class Repair
{
	public static function mode()
	{
		// Eğer ip tadilat ipsi olarak ayarlanmış ise 
		// bu ip'li bilgisayar tamir modundan etkilenmez.
		if( isRepmac() ) 
		{
			return false;
		}
		
		// Tamir moduna geçildiği durumnda tadilat makinesi olarak belirlenmeyen
		// diğer kullanıcı bilgisayarlarında herhangi bir hata ile karşı karşıya
		// kalmamaları için hata raporlama kapatılıyor.
		error_reporting(0); 
		
		// Config/Repair.php dosyasında tadilata alınacak sayfalar belirtilir.
		// Burada ayarlarda belirtilen sayfa isimleri bilgisi alınıyor.
		$repair_config = Config::get('Repair');
		$repair_pages = $repair_config['pages'];
		
		// Eğer Config/Repair.php dosyasında pages = "all" olarrak alınmış ise 
		// tüm sayfalar için tadilat modu uygulanıyor demektir.
		if( is_string($repair_pages) )
		{
			if( $repair_pages === "all" )
			{
				if( currentPath() !== $repair_config['route_page'] ) 
				{
					redirect($repair_config['route_page']);
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
				if( currentPath() !== $repair_config['route_page'] ) 
				{
					redirect($repair_config['route_page']);
				}
			}
			
			foreach($repair_pages as $rp)
			{
				// Gelen sayfa o anki url içinde geçip geçmediğini kontrol ediliyor.
				$page_pos = strstr(currentPath(), $rp);	
				
				// Eğer gelen sayfa o anki url içinde geçiyorsa yani sonuc -1 den büyükse 
				// yönlendirme sayfası olarak belirlene sayfaya yönlendir.
				if( ! empty($page_pos) )
				{
					if( currentPath() !== $repair_config['route_page'] )
					{
						redirect($repair_config['route_page']);
					}
				}	
			}
		}	
	}	
}