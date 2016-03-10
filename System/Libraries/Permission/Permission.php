<?php 
class __USE_STATIC_ACCESS__Permission implements PermissionInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Config Değişkeni
	 *  
	 * FTP ayar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	/* Permission Değişkeni
	 *  
	 * Config/Permission.php dosyasındaki ayar
	 * bilgilerini tutması için oluşturulmuştur.
	 */
	protected $permission = array();
	
	/* Result Değişkeni
	 *  
	 * Yetki sonucu durum
	 * bilgisini tutması için oluşturulmuştur.
	 */
	protected $result;
	
	public function __construct()
	{
		$this->config = Config::get('Permission');	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use CallUndefinedMethodTrait;
	
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
	use ErrorControlTrait;
	
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
	public function process($roleId = '', $process = '', $object = '')
	{
		// Parametrelerin kontrolleri yapılıyor.
		if( ! is_numeric($roleId) ) 
		{
			return Errors::set('Error', 'numericParameter', 'roleId');	
		}
		if( ! is_scalar($process) ) 
		{
			$process = '';
		}
		if( ! is_scalar($object) ) 
		{
			$object = '';
		}
		
		$this->permission = $this->config['process'];
		
		if( isset($this->permission[$roleId]) ) 
		{
			$rules = $this->permission[$roleId]; 
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
		
		if( is_array($rules) ) // Birden fazla yetki var ise..........
		{		
			$pages = current($rules);
			$type  = key($rules);
		
			foreach( $pages as $page )
			{
				$page = trim($page);
				
				if( stripos($page[0], '!') === 0 ) 
				{
					$rule = substr(trim($page), 1); 
				}
				else 
				{
					$rule = trim($page);
				}
				
				if( $type === "perm" )
				{
					if( strpos($currentUrl, $rule) > -1 )
					{
						 return $object;
					}
					else
					{
						 $this->result = false;
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
						 $this->result = $object;
					}
				}
			}
			
			return $this->result;
		}
		else
		{	
			// tek bir yetki varsa
				
			if( $rules[0] === "!" ) 
			{
				$page = substr(trim($rules), 1); 
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
	public function page($roleId = '6')
	{
		if( ! is_numeric($roleId) ) 
		{
			return Errors::set('Error', 'numericParameter', 'roleId');	
		}
		
		$this->permission = $this->config['page'];
		
		if( isset($this->permission[$roleId]) )
		{ 
			$rules = $this->permission[$roleId]; 
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
		
		if( is_array($rules) ) // Birden fazla sayfa var ise..........
		{
			$pages = current($rules);
			$type  = key($rules);
		
			foreach($pages as $page)
			{
				$page = trim($page);
			
				if( stripos($page[0], '!') === 0 ) 
				{
					$rule = substr(trim($page), 1); 
				}
				else 
				{
					$rule = trim($page);
				}
				
				if( $type === "perm" )
				{
					if( strpos($currentUrl, $rule) > -1 )
					{
						 return true;
					}
					else
					{
						 $this->result = false;
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
						 $this->result = true;
					}
				}
			}
			
			return $this->result;
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