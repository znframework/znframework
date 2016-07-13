<?php 
namespace ZN\Services;

class InternalCURL implements CURLInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/*
	 * Tanıtıcı bilgisini tutar.
	 *
	 * @var resource 
  	 */
	 protected $init;
	 
	 /*
	 * Seçenekler bilgisini tutar.
	 *
	 * @var array 
  	 */
	 protected $options = [];

	
	public function __construct()
	{
		if( ! function_exists('curl_exec') )
		{
			die(getErrorMessage('Error', 'undefinedFunction', 'curl_xxx'));	
		}	
	}
	
	use \CallUndefinedMethodTrait;
	
	/******************************************************************************************
	* INIT		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bir CURL oturumunu ilklendirir.										  |
	
	  @param string $url NULL
	  
	  @return resource
	|														                                  |
	******************************************************************************************/
	public function init($url = CURLOPT_URL)
	{	
		$this->init = curl_init($url);
		
		return $this;
	}
	
	/******************************************************************************************
	* EXEC	                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir CURL oturumunu işleme sokar.										  |
	
	  @param resource $ch;
	  
	  @return mixed
	|														                                  |
	******************************************************************************************/
	public function exec()
	{
		if( ! is_resource($this->init) )
		{
			return false;
		}
		
		curl_setopt_array($this->init, $this->options);

		$this->options = [];
		
		if( is_resource($this->init) )
		{
			return curl_exec($this->init);
		}
		
		return false;
	}
	
	/******************************************************************************************
	* ESCAPE	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Verilen dizgenin URL'sini kodlar.										  |
	
	  @param string   $str
	  
	  @return string
	|														                                  |
	******************************************************************************************/
	public function escape($str = '')
	{
		if( ! isPhpVersion('5.5.0') )
		{
			die(getErrorMessage('Error', 'invalidVersion', ['%' => 'curl_escape', '#' => '5.5.0']));	
		}
		
		if( ! is_resource($this->init) )
		{
			return \Errors::set('Error', 'resourceParameter', '1.(ch)');
		}
		
		return curl_escape($this->init, $str);
	}
	
	/******************************************************************************************
	* UNESCAPE	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Şifrelenmiş URL verisini çözer.										  |
		
	  @param string   $str
	  
	  @return string
	|														                                  |
	******************************************************************************************/
	public function unescape($str = '')
	{
		if( ! isPhpVersion('5.5.0') )
		{
			die(getErrorMessage('Error', 'invalidVersion', ['%' => 'curl_unescape', '#' => '5.5.0']));	
		}
		
		if( ! is_resource($this->init) )
		{
			return \Errors::set('Error', 'resourceParameter', '1.(ch)');
		}
		
		return curl_unescape($this->init, $str);
	}
	
	/******************************************************************************************
	* INFO		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen tanıtıcı ile ilgili son aktarım hakkında bilgi verir.		  |
	
	  @param mixed    $opt -> CURLINFO_ ön ekinin kullanılmasına gerek yoktur.
	  
	  CURLINFO_EFFECTIVE_URL yerine 'effective_url' gibi bir kullanım mümkündür.
	|														                                  |
	******************************************************************************************/
	public function info($opt = 0)
	{
		if( ! is_resource($this->init) )
		{
			return \Errors::set('Error', 'resourceParameter', '1.(ch)');
		}
		
		return curl_getinfo($this->init, \Convert::toConstant($opt, 'CURLINFO_'));
	}
	
	/******************************************************************************************
	* ERROR		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: CURL işlemleri esnasına oluşan hatalar hakkında bilgi almak için.		  |
	
	  @param resource $ch
	|														                                  |
	******************************************************************************************/
	public function error()
	{
		if( ! is_resource($this->init) )
		{
			return \Errors::set('Error', 'resourceParameter', '1.(ch)');
		}
		
		return curl_error($this->init);
	}
	
	/******************************************************************************************
	* ERRNO		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen oturumdaki son hatanın kodunu döndürür.					  |
	  
	  @param resource $ch
	  
	  @return int
	|														                                  |
	******************************************************************************************/
	public function errno()
	{
		if( ! is_resource($this->init) )
		{
			return \Errors::set('Error', 'resourceParameter', '1.(ch)');
		}
		
		return curl_errno($this->init);
	}

	/******************************************************************************************
	* PAUSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Bir bağlantıyı dururur.												  |
	
	  @param int      $bitmask 0
	  
	  @return int											 
	|														                                  |
	******************************************************************************************/
	public function pause($bitmask = 0)
	{
		if( ! isPhpVersion('5.5.0') )
		{
			die(\Errors::message('Error', 'invalidVersion', ['%' => 'curl_pause', '#' => '5.5.0']));	
		}
		
		if( ! empty($this->init) )
		{
			return curl_pause($this->init, $bitmask);
		}
	}
	
	/******************************************************************************************
	* RESET                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Bir CURL tanıcısını yeniden başlatır.									  |
	
	  @param resource $ch
	  
	  @return void
	|														                                  |
	******************************************************************************************/
	public function reset()
	{
		if( ! isPhpVersion('5.5.0') )
		{
			die(\Errors::message('Error', 'invalidVersion', ['%' => 'curl_reset', '#' => '5.5.0']));	
		}
		
		if( ! empty($this->init) )
		{
			return curl_reset($this->init);
		}
	}
	
	/******************************************************************************************
	* OPTION                     		                                                      *
	*******************************************************************************************
	| Genel Kullanım:  Bir CURL aktarım seçeneği tanımlar.									  |	

	  @param mixed    $options
	  @param mixed	  $value
	  
	  @return bool								
	|														                                  |
	******************************************************************************************/
	public function option($options = 0, $value = '')
	{		
		$this->options[\Convert::toConstant($options, 'CURLOPT_')] = $value;
		
		return $this;
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: CURL oturumunu sonlandırır.											  |
	
	  @param resource $ch
	  
	  @return void
	|														                                  |
	******************************************************************************************/
	public function close()
	{
		$init = $this->init;
		
		if( is_resource($init) )
		{
			$this->init = NULL;
			
			return curl_close($init);
		}
		
		return false;
	}

	/******************************************************************************************
	* ERROR VAL                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Dönen hata numarasına göre hatanın içeriğini döndürür.				  |
	
	  @param numeric $errno
	  
	  @return string
	|														                                  |
	******************************************************************************************/
	public function errval($errno = 0)
	{
		if( ! isPhpVersion('5.5.0') )
		{
			die(\Errors::message('Error', 'invalidVersion', ['%' => 'curl_version', '#' => '5.5.0']));	
		}
		
		if( ! is_numeric($errno) )
		{
			return \Errors::set('Error', 'numericParameter', '1.(errno)');
		}
		
		return curl_strerror($errno);
	}
	
	/******************************************************************************************
	* VERSION                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Geçerli CURL versiyonu hakkında bir dizi döndürür.					  |
	
	  @param mixed $age now
	  
	  @return array
	|														                                  |
	******************************************************************************************/
	public function version($data = NULL)
	{
		$version = curl_version();
		
		if( $data === NULL )
		{
			return $version;	
		}
		else
		{
			if( isset($version[$data]) )
			{
				return $version[$data];
			}	
			else
			{
				return false;	
			}
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// __destruct()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function __destruct()
	{
		$this->close();	
	}
}