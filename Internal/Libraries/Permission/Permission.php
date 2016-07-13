<?php 
namespace ZN\Permission;

class InternalPermission implements PermissionInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------

	/* Permission Değişkeni
	 *  
	 * Config/Permission.php dosyasındaki ayar
	 * bilgilerini tutması için oluşturulmuştur.
	 */
	protected $permission = [];
	
	/* Result Değişkeni
	 *  
	 * Yetki sonucu durum
	 * bilgisini tutması için oluşturulmuştur.
	 */
	protected $result;
	
	//----------------------------------------------------------------------------------------------------
	// protected $content
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $content;
	
	public function __construct()
	{
		$this->config();	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Config Method
	//----------------------------------------------------------------------------------------------------
	// 
	// config()
	//
	//----------------------------------------------------------------------------------------------------
	use \ConfigMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
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
	
	//----------------------------------------------------------------------------------------------------
	// start()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param numeric $roleId : 0
	// @param string  $process: empty 
	//
	//----------------------------------------------------------------------------------------------------
	public function start($roleId = 0, $process = '')
	{
		$this->content = $this->process($roleId, $process, 'object');
	
		ob_start();
	}
	
	//----------------------------------------------------------------------------------------------------
	// end()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function end()
	{
		if( ! empty($this->content) )
		{
			$content = ob_get_contents();
		}
		else
		{
			$content = '';	
		}
		
		ob_end_clean();
		
		$this->content = NULL;
		
		echo $content;
	}
	
	//----------------------------------------------------------------------------------------------------
	// process()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param numeric $roleId : 0
	// @param string  $process: empty 
	// @param string  $object : empty
	//
	//----------------------------------------------------------------------------------------------------
	public function process($roleId = '', $process = '', $object = '')
	{
		// Parametrelerin kontrolleri yapılıyor.
		if( ! is_numeric($roleId) ) 
		{
			return \Errors::set('Error', 'numericParameter', 'roleId');	
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
	
	//----------------------------------------------------------------------------------------------------
	// page()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param numeric $roleId : 0
	//
	//----------------------------------------------------------------------------------------------------
	public function page($roleId = '6')
	{
		if( ! is_numeric($roleId) ) 
		{
			return \Errors::set('Error', 'numericParameter', 'roleId');	
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