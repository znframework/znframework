<?php 
namespace ZN\Services;

class InternalNet implements NetInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
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
	
	/******************************************************************************************
	* PROTECTED CLEAN HTTP                                                                    *
	*******************************************************************************************
	| Genel Kullanım: http ve https ön eklerini temizlemek için kullanılır.         		  | 
	
	|														                                  |
	******************************************************************************************/
	protected function cleanHttp($host)
	{
		return str_ireplace(['http://', 'https://'], '', $host);	
	}
	
	/******************************************************************************************
	* CHECK DNS                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen bir konak adı veya IP adresi için DNS sorgusu yapar.		  | 
	
	  @param string $host
	  @param string $type MX, A, NS, SOA, PTR, CNAME, AAAA, A6, SRV, NAPTR, TXT veya ANY
	  
	  @return bool
	|														                                  |
	******************************************************************************************/
	public function checkDns($host = '', $type = 'MX')
	{
		if( ! is_string($host) || ! is_string($type) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(host) & 2.(type)');	
		}
		
		return checkdnsrr($this->cleanHttp($host), $type);
	}
	
	/******************************************************************************************
	* DNS RECORDS                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen konak adı ile ilgili DNS Özkaynak Kayıtlarını getirir.		  | 
	
	  @param string $host
	  @param mixed  $type any
	  
	  Types = a, cname, hinfo, mx, ns, ptr, soa, txt, aaaa, srv, naptr, ag, all veya any
	  
	  @return object records, authns, addtl
	|														                                  |
	******************************************************************************************/
	public function dnsRecords($host = '', $type = 'any', $raw = false)
	{
		if( ! is_string($host) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(host)');	
		}

		$dns = dns_get_record($this->cleanHttp($host), \Convert::toConstant($type, 'DNS_'), $auth, $add, $raw);
		
		return (object)array
		(
			'records' => $dns,
			'authns'  => $auth,
			'addtl'   => $add
		);
	}
	
	/******************************************************************************************
	* MX RECORDS                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen konak adı ile ilgili MX kaydını döndürür.					  | 
	 
	  @param string $host
	  
	  @return object records, weight
	|														                                  |
	******************************************************************************************/
	public function mxRecords($host = '')
	{
		if( ! is_string($host) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(host)');	
		}
	
		$mx = getmxrr($this->cleanHttp($host), $mxhosts, $weight);
		
		return (object)array
		(
			'records' => $mxhosts,
			'weight'  => $weight
		);
	}
	
	/******************************************************************************************
	* SOCKET    		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Bir internet veya Unix alan soketi bağlantısı açar.					  | 
	
	  @param string  $host
	  @param numeric $port -1
	  @param numeric $timeout 60
	  
	  @return resource
	|														                                  |
	******************************************************************************************/
	public function socket($host = '', $port = -1, $timeout = 60)
	{
		if( ! is_string($host) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(host)');	
		}
		
		if( ! is_numeric($port) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(port)');	
		}
		
		$socket = fsockopen($this->cleanHttp($host), $port, $errno, $errstr, $timeout);
		
		\Errors::set($errno);
		\Errors::set($errstr);
		
		return $socket;
	}
	
	/******************************************************************************************
	* PSOCKET           			                                                          *
	*******************************************************************************************
	| Genel Kullanım: pfsockopen().						      								  | 
	|														                                  |
	******************************************************************************************/
	public function psocket($host = '', $port = -1, $timeout = 60)
	{
		if( ! is_string($host) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(host)');	
		}
		
		if( ! is_numeric($port) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(port)');	
		}
		
		$socket = pfsockopen($this->cleanHttp($host), $port, $errno, $errstr, $timeout);
		
		\Errors::set($errno);
		\Errors::set($errstr);
		
		return $socket;
	}
	
	/******************************************************************************************
	* IP V4 TO HOST                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen IP adresine çözümlenen konak ismini döndürür.				  | 
	|														                                  |
	******************************************************************************************/
	public function ipv4ToHost($ip = '')
	{
		if( ! is_string($ip) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(ip)');	
		}
		
		return gethostbyaddr($ip);
	}
	
	/******************************************************************************************
	* HOST TO IP V4		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: gethostbyname().					      								  | 
	|														                                  |
	******************************************************************************************/
	public function hostToIpv4($host = '')
	{
		if( ! is_string($host) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(host)');	
		}
		
		return gethostbyname($this->cleanHttp($host));
	}
	
	/******************************************************************************************
	* HOST TO IPV4 LIST                                                                       *
	*******************************************************************************************
	| Genel Kullanım: gethostbynamel().					      								  | 
	|														                                  |
	******************************************************************************************/
	public function hostToIpv4List($host = '')
	{
		if( ! is_string($host) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(host)');	
		}
		
		return gethostbynamel($this->cleanHttp($host));
	}
	
	/******************************************************************************************
	* PROTOCOL NAME TO NUMBER                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Protokol ismine karşılık düşen protokol numarasını verir.				  | 
	|														                                  |
	******************************************************************************************/
	public function protocolNumber($name = '')
	{
		if( ! is_string($name) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(name)');	
		}
		
		return getprotobyname($name);
	}
	
	/******************************************************************************************
	* PROTOCOL NUMBER TO NAME                                                                 *
	*******************************************************************************************
	| Genel Kullanım: getprotobynumber().						      						  | 
	|														                                  |
	******************************************************************************************/
	public function protocolName($number = 0)
	{
		if( ! is_numeric($number) )
		{
			return \Errors::set('Error', 'numericParameter', '1.(number)');	
		}
		
		return getprotobynumber($number);
	}
	
	/******************************************************************************************
	* SERVICE PORT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: getservbyname().							      						  | 
	|														                                  |
	******************************************************************************************/
	public function servicePort($service = '', $protocol = '')
	{
		if( ! is_string($service) || ! is_string($protocol) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(service) & 2.(protocol)');	
		}
		
		return getservbyname($service, $protocol);
	}
	
	/******************************************************************************************
	* GET SERVICE NAME                                                                        *
	*******************************************************************************************
	| Genel Kullanım: getservbyport().							      						  | 
	|														                                  |
	******************************************************************************************/
	public function serviceName($port = 0, $protocol = '')
	{
		if( ! is_numeric($port) )
		{
			return \Errors::set('Error', 'numericParameter', '1.(port)');	
		}
		
		if( ! is_string($protocol) )
		{
			return \Errors::set('Error', 'stringParameter', '2.(protocol)');	
		}
		
		return getservbyport($port, $protocol);
	}
	
	/******************************************************************************************
	* LOCAL         		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: gethostname().							      						  | 
	|														                                  |
	******************************************************************************************/
	public function local()
	{
		return gethostname();
	}
	
	/******************************************************************************************
	* RESPONSE CODE    		                                                                  *
	*******************************************************************************************
	| Genel Kullanım: http_response_code().							      					  | 
	|														                                  |
	******************************************************************************************/
	public function rcode($code = NULL)
	{
		return http_response_code($code);
	}

	/******************************************************************************************
	* INET CHR TO ADDR                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Bir IP adresinin gösterimini insan okuyabilir gösterime dönüştürür.	  | 
	|														                                  |
	******************************************************************************************/
	public function chrToIpv4($chr = '')
	{
		if( ! is_string($chr) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(chr)');	
		}
		
		return inet_ntop($chr);
	}
	
	/******************************************************************************************
	* INET ADDR TO CHR                                                                        *
	*******************************************************************************************
	| Genel Kullanım:  İnsan okuyabilir bir IP adresini okunamaz gösterimine dönüştürür.	  | 
	|														                                  |
	******************************************************************************************/
	public function ipv4ToChr($addr = '')
	{
		if( ! is_string($addr) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(addr)');	
		}
		
		return inet_pton($addr);
	}
	
	/******************************************************************************************
	* IP V4 TO NUMBER                                                                         *
	*******************************************************************************************
	| Genel Kullanım: ip2long().								      					 	  | 
	|														                                  |
	******************************************************************************************/
	public function ipv4ToNumber($ip = '')
	{
		if( ! is_string($ip) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(ip)');	
		}
		
		return ip2long($ip);
	}
	
	/******************************************************************************************
	* NUMBER TO IP V4                                                                         *
	*******************************************************************************************
	| Genel Kullanım: long2ip().								      					 	  | 
	|														                                  |
	******************************************************************************************/
	public function numberToIpv4($numberAddress = 0)
	{
		if( ! is_numeric($numberAddress) )
		{
			return \Errors::set('Error', 'numericParameter', '1.(numberAddress)');	
		}
		
		return long2ip($numberAddress);
	}
}