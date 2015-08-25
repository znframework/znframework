<?php 
class Repair
{
	/***********************************************************************************/
	/* REPAIR LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Repair
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Sistem tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
		$repairConfig = Config::get('Repair');
		$repairPages  = $repairConfig['pages'];
		$routePate	  = strtolower($repairConfig['routePage']);
		$currentPath  = strtolower(currentPath()); 
		
		// Eğer Config/Repair.php dosyasında pages = "all" olarrak alınmış ise 
		// tüm sayfalar için tadilat modu uygulanıyor demektir.
		if( is_string($repairPages) )
		{
			if( $repairPages === "all" )
			{
				if( $currentPath !== $routePate ) 
				{
					redirect($repairConfig['routePage']);
				}
			}
		}
		
		
		// Sayfalar tek tek çağrılıyor..
		if( is_array($repairPages) && ! empty($repairPages) )
		{		
			// Eğer Config/Repair.php dosyasında pages = array("all") olarrak alınmış ise 
			// tüm sayfalar için tadilat modu uygulanıyor demektir.
			if( $repairPages[0] === "all" )
			{
				if( $currentPath !== $routePate ) 
				{
					redirect($repairConfig['routePage']);
				}
			}
		
			foreach( $repairPages as $k => $rp )
			{
				// Yönlendirme sayfası bir anahtar-değer çifti içeriyorsa bu sayfaya yönlenmesi sağlanır
				if( strstr($currentPath, strtolower($k)) )
				{
					redirect($rp);	
				}
				else
				{
					// Eğer gelen sayfa o anki url içinde geçiyorsa yani sonuc -1 den büyükse 
					// yönlendirme sayfası olarak belirlene sayfaya yönlendir.
					if( strstr($currentPath, strtolower($rp)) )
					{
						if( $currentPath !== $routePate )
						{
							redirect($repairConfig['routePage']);
						}
					}	
				}
			}
		}	
	}	
}