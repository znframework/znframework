<?php 
class Permission
{
	/***********************************************************************************/
	/* PERMISSON LIBRARY					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Perfmission
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: permission::, $this->permission, zn::$use->permission, uselib('permission')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Permission Değişkeni
	 *  
	 * Config/Permission.php dosyasındaki ayar
	 * bilgilerini tutması için oluşturulmuştur.
	 */
	private static $permission = array();
	
	/* Result Değişkeni
	 *  
	 * Yetki sonucu durum
	 * bilgisini tutması için oluşturulmuştur.
	 */
	private static $result;
	
	/******************************************************************************************
	* PROCESS                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Nesnelere yetki vermek için oluşturulmuştur.                            |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. numeric var @role_id => Yetkilerin uygulanacağı rol numarası.                        |
	| 2. string var @process => Yetkinin uygulanacağı nesnenin yetki ismi.                    |
	| 3. string var @process => Yetkinin uygulanacağı nesne.                   				  |
	|          																				  |
	| NOT: Yetkiler Config/Permission.php dosyasından ayarlanmaktadır.         				  |
	|          																				  |
	| Örnek Kullanım: process(4, 'guncelle', '<input type="button">');        	  			  |
	|          																				  |
	| Yukarıda yapılan işlem rol id'si 4 olan kullanıcı için yetki ismi guncelle olan		  |
	| nesneni bu kullanıcıya görüntülenip görüntülenmeyeceğidir. Eğer yetkisi rol id'si		  |
	| için izin verilmişse bu nesneyi görecektir. Aksi halde bu nesne yine bu kullanıcı için  |
	| görüntülenmeyecektir.         														  |
	|          																				  |
	******************************************************************************************/	
	public static function process($roleId = '', $process = '', $object = '')
	{
		// Parametrelerin kontrolleri yapılıyor.
		if( ! is_numeric($roleId) ) 
		{
			return false;
		}
		if( ! isValue($process) ) 
		{
			$process = '';
		}
		if( ! isValue($object) ) 
		{
			$object = '';
		}
		
		self::$permission = Config::get('Permission','process');
		
		if( isset(self::$permission[$roleId]) ) 
		{
			$rules = self::$permission[$roleId]; 
		}
		else
		{
			return false;
		}
		
		$currentUrl = $process;
		
		switch( $rules )
		{
			case 'all' : 
				return $object;  
			break;
			
			case 'any' : 
				return false; 
			break;	
		}
		
		if( strpos($rules,"|") > -1 ) // Birden fazla yetki var ise..........
		{		
			$pages = explode("|", $rules);
		
			foreach($pages as $page)
			{
				$page = trim($page);
			
				if( $page[0] === "!" ) 
				{
					$rule = substr(trim($page), 1); 
				}
				else 
				{
					$rule = trim($page);
				}
				
				if( $pages[0] === "perm->" )
				{
					if( strpos($currentUrl, $rule) > -1 )
					{
						 return $object;
					}
					else
					{
						 self::$result = false;
					}
				}
				else
				{
					
					if( strpos($currentUrl, $rule) > -1 )
					{					
						 return false;
					}
					else
					{
						 self::$result = $object;
					}
				}
			}
			
			return self::$result;
		}
		else
		{	
			// tek bir yetki varsa
				
			if( $rules[0] === "!" ) 
			{
				$page = substr(trim($rules),1); 
			}
			else 
			{
				$page = trim($rules);
			}
			
			if( strpos($currentUrl, $page) > -1 )
			{
				if( $rules[0] !== "!" ) 
				{
					return $object; 
				}
				else 
				{
					return false;			
				}
			}
			else
			{
				return $object;	
			}
		}

	}
	
	/******************************************************************************************
	* PAGE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Sayfalara yetki vermek için oluşturulmuştur.                            |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. numeric var @role_id => Yetkilerin uygulanacağı rol numarası.                        |
	|          																				  |
	| NOT: Yetkiler Config/Permission.php dosyasından ayarlanmaktadır.         				  |
	|          																				  |
	| Örnek Kullanım: page(4);        	  			  									      |
	|          																				  |
	******************************************************************************************/
	public static function page($roleId = '6')
	{
		if( ! is_numeric($roleId) ) 
		{
			return false;
		}
		
		self::$permission = Config::get('Permission','page');
		
		if( isset(self::$permission[$roleId]) )
		{ 
			$rules = self::$permission[$roleId]; 
		}
		else
		{
			return false;
		}
		
		$currentUrl = server('currentPath');
		
		switch( $rules )
		{
			case 'all' : 
				return true;  
			break;
			
			case 'any' : 
				return false; 
			break;	
		}
		
		if( strpos($rules,"|") ) // Birden fazla sayfa var ise..........
		{
			$pages = explode("|", $rules);
		
			foreach($pages as $page)
			{
				$page = trim($page);
			
				if( @$page[0] === "!" ) 
				{
					$rule = substr(trim($page), 1); 
				}
				else 
				{
					$rule = trim($page);
				}
				
				if( $pages[0] === "perm->" )
				{
					if( strpos($currentUrl, $rule) > -1 )
					{
						 return true;
					}
					else
					{
						 self::$result = false;
					}
				}
				else
				{
					
					if( @strpos($currentUrl, $rule) > -1 )
					{					
						 return false;
					}
					else
					{
						 self::$result = true;
					}
				}
			}
			
			return self::$result;
		}
		else
		{		
			if( $rules[0] === "!" ) 
			{
				$page = substr(trim($rules),1); 
			}
			else 
			{
				$page = trim($rules);
			}
			
			if( strpos($currentUrl, $page) > -1 )
			{
				if( $rules[0] !== "!" ) 
				{
					return true; 
				}
				else 
				{
					return false;			
				}
			}
			else
			{
				return true;	
			}
		}
	}	
}