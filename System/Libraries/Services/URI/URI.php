<?php
class __USE_STATIC_ACCESS__URI implements URIInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use CallUndefinedMethodTrait;

	//----------------------------------------------------------------------------------------------------
	// Get Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* GET                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Uri üzerinde istenilen segmenti elde etmek için oluşturulmuş yötemdir.  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @get => İstenilen segmentin bir önceki segment ismi.			          |
	| 2. numeric var @index => Belirtilen segmentten kaç segment sonraki bölümün istendiği.   |
	| 3. mixed var @while => Belirlenen segment aralığı alınsın mı?.	                      |
	|    																					  |
	| Örnek URL: http://www.example.com/test/zntr/yerli/framework      						  |
	| Örnek Kullanım: get('test'); // zntr       		      								  |
	| Örnek Kullanım: get('test', 2); // yerli       		      							  |
	| Örnek Kullanım: get('test', 2, true); // zntr/yerli       		      				  |
	| Örnek Kullanım: get('test', "count"); // test bölümü sonrası segment sayısı:3           |
	| Örnek Kullanım: get('test', "all"); // zntr/yerli/framework    		                  |
	| Örnek Kullanım: get('test', "framework"); // test/zntr/yerli/framework     		      |
	|          																				  |
	******************************************************************************************/
	public function get($get = '', $index = 1, $while = false)
	{
		// Parametre kontrolleri yapılıyor. ---------------------------------------------------
		if( ! isChar($index) ) 
		{
			$index = 1;		
		}
		
		if( ! is_scalar($while) ) 
		{
			$while = false;
		}
		// ------------------------------------------------------------------------------------
		
		$segArr = $this->segmentArray();
		$segVal = '';
		
		if( is_numeric($get) )
		{
			return $this->getByIndex($get, $index);
		}
		
		if( in_array($get, $segArr) )
		{ 
			$segVal = array_search($get, $segArr); 
			
			// 3. parametrenin boş olmama durumu ve
			// 2. parametrenin sayısal olmama durumu
			if( ! empty($while) && ! is_numeric($index) )
			{
				return $this->getByName($get, $index);
			}
			
			// 2. parametrenin all olma durumu
			// 1. parametreden itibaren bütün 
			// segmentleri verir.
			if( $index === 'all' )
			{
				return $this->getNameAll($get);
			}
			
			// 3. parametrenin boş olmaması durumu
			if( ! empty($while) )
			{
				$return = '';
				
				$countSegArr = count($segArr) - 1;
				
				if( $index > $countSegArr )
				{
					$index = $countSegArr;
				}
				
				if( $index < 0 )
				{
					$index = $countSegArr + $index + 1;	
				}
				
				for( $i = 1; $i <= $index; $i++ )
				{
					$return .= htmlspecialchars($segArr[$segVal + $i], ENT_QUOTES, "utf-8")."/";
				}
				
				$return = substr($return,0,-1);
				
				return $return;
			}
			
			// 2. parametrenin count olma durumu
			// 1. parametrede belirtilen segmentten
			// itibaren kalan bölüm sayısını verir.
			if( $index === "count" )
			{
				return $this->getNameCount($get);
			}
			
			if( isset($segArr[$segVal + $index]) ) 
			{
				return htmlspecialchars($segArr[$segVal + $index], ENT_QUOTES, "utf-8"); 
			}		
			else 
			{
				return false;
			}	
		} 
		else
		{ 
			return false; 
		}
	}
	
	// Uri işlemleri için oluşturulmuştur.
	protected function _cleanPath()
	{
		$pathInfo = htmlspecialchars(requestUri(), ENT_QUOTES, "utf-8");
		
		// ----------------------------------------------------------------------
		
		// URL YÖNLENDİRİLİYOR...
		
		$pathInfo = routeUri($pathInfo);
		
		
		if(  strstr($pathInfo, getLang()) )
		{
			$pathInfo = str_replace(getLang().'/', '', $pathInfo);
		}
		
		return $pathInfo;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// getNameCount
	//----------------------------------------------------------------------------------------------------
	// 
	// Belirtilen segmentten sonra kaç adet segmentin olduğunu verir.
	//
	// @param string $get
	//
	//----------------------------------------------------------------------------------------------------
	public function getNameCount($get = '')
	{
		$segArr = $this->segmentArray();
		
		if( in_array($get, $segArr) )
		{ 
			$segVal = array_search($get, $segArr); 
		
			return count($segArr) - 1 - $segVal;
		}
		
		return false;
	}
	
	//----------------------------------------------------------------------------------------------------
	// getNameAll
	//----------------------------------------------------------------------------------------------------
	// 
	// Belirtilen segmentten sonra tüm segmentleri verir.
	//
	// @param string $get
	//
	//----------------------------------------------------------------------------------------------------
	public function getNameAll($get = '')
	{
		$segArr = $this->segmentArray();
		
		if( in_array($get, $segArr) )
		{ 
			$return = '';
			
			$segVal = array_search($get, $segArr); 
			
			for( $i = 1; $i < count($segArr) - $segVal; $i++ )
			{
				$return .= htmlspecialchars($segArr[$segVal + $i], ENT_QUOTES, "utf-8")."/";
			}
			
			$return = substr($return, 0, -1);
			
			return $return;
		}
		
		return false;
	}
	
	//----------------------------------------------------------------------------------------------------
	// getByIndex
	//----------------------------------------------------------------------------------------------------
	// 
	// Belirtilen segment indekslerine göre aralık almak için kullanılır.
	//
	// @param numeric $get
	// @param numeric $get
	//
	//----------------------------------------------------------------------------------------------------
	public function getByIndex($get = 1, $index = 1)
	{
		if( ! is_numeric($get) )
		{
			return false;	
		}
		
		$segArr = $this->segmentArray();
		
		if( $get == 0 )
		{
			$get = 1;	
		}
		
		$get -= 1;
		
		$uri = '';
		
		$countSegArr = count($segArr);
		
		if( $index < 0 )
		{
			$index = $countSegArr + $index + 1;	
		}
		
		if( $index > 0 )
		{
			$index = $get + $index;	
		}
		
		if( abs($index) > $countSegArr )
		{
			$index = $countSegArr;
		}
		
		for( $i = $get; $i < $index; $i++ )
		{
			$uri .= htmlspecialchars($segArr[$i], ENT_QUOTES, "utf-8").'/';
		}
		
		return rtrim($uri, '/');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get Name
	//----------------------------------------------------------------------------------------------------
	// 
	// Belirtilen segment isimlerine göre aralık almak için kullanılır.
	//
	// @param string $get
	// @param string $get
	//
	//----------------------------------------------------------------------------------------------------
	public function getByName($get = '', $index = '')
	{
		if( ! is_scalar($get) )
		{
			return false;	
		}
		
		$segArr   = $this->segmentArray();	
			
		$getVal   = array_search($get, $segArr);
		
		if( $index === 'all' )
		{
			$indexVal = count($segArr) - 1;	
		}
		else
		{
			$indexVal = array_search($index, $segArr);
		}
		
		$return   = '';

		for($i = $getVal; $i <= $indexVal; $i++)
		{
			$return .= htmlspecialchars($segArr[$i], ENT_QUOTES, "utf-8")."/";
		}
		
		return substr($return, 0, -1);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Segment Methods Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* SEGMENT ARRAY                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Uri bölümlerini bir dizi tipinde veri olarak almak için kullanılır.     |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|    																					  |
	| Örnek URL: http://www.example.com/test/zntr/yerli/framework      						  |
	| Örnek Kullanım: segmentArray(); // array('test', 'zntr', 'yerli', 'framework')         |
	|          																				  |
	******************************************************************************************/
	public function segmentArray()
	{
		$segmentEx = explode("/", $this->_cleanPath());
		return $segmentEx;	
	}
	
	/******************************************************************************************
	* TOTAL SEGMENTS                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Uride yer alan toplam segment sayısı.                                   |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|    																					  |
	| Örnek URL: http://www.example.com/test/zntr/yerli/framework      						  |
	| Örnek Kullanım: totalSegments(); // 4                                                  |
	|          																				  |
	******************************************************************************************/
	public function totalSegments()
	{
		$segmentEx     = explode("/", $this->_cleanPath());	
		$segmentEx     = array_diff($segmentEx, array(""," "));
		$totalSegments = count($segmentEx);
		
		return $totalSegments;
	}
	
	/******************************************************************************************
	* SEGMENT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Uride yer alan toplam segment sayısı.                                   |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @seg => İstenilen segmentin segment numarası.			                  |
	|    																					  |
	| Örnek URL: http://www.example.com/test/zntr/yerli/framework      						  |
	| Örnek Kullanım: segment(1); // test                                                     |
	| Örnek Kullanım: segment(2); // zntr                                                     |
	| Örnek Kullanım: segment(3); // yerli                                                    |
	|          																				  |
	******************************************************************************************/
	public function segment($seg = 1)
	{
		if( ! is_numeric($seg) ) 
		{
			return Error::set('Error', 'numericParameter', 'seg');
		}
		
		$ok = $seg;
		
		if( $seg == 0 ) 
		{
			return false;
		}
		
		$segment = 0;
		
		if( $seg < 1 )
		{
			$segment = $seg;	
		}
		
		$part = '';
		
		$negative = 0;
		
		$requestUri = $_SERVER['REQUEST_URI'];
		
		$baseDir    = substr(BASE_DIR,1,-1);
		
		if( ! empty($baseDir) ) 
		{
			$baseDirEx = explode("/", $baseDir);
			
			$seg  += count($baseDirEx) + 1;
			
			$negative += count($baseDirEx) + 1;
		}
		else
		{
			$seg      += 1; 
			$negative += 1; 
		}
		
		if( strstr($requestUri, 'index.php') ) 
		{ 
			$seg      += 1; 
			$negative += 1; 
		}
		
		if( strstr($requestUri, getLang()) ) 
		{ 
			$seg      += 1; 
			$negative += 1; 
		}
	
		$part = explode('/', $requestUri);
		
		$countPart = count($part);
		
		if( $segment < 0 )
		{
			$seg = $countPart + ($segment);
		}
		if( $negative == $seg ) 
		{
			return false;
		}
		
		if( $ok > 0 ) 
		{
			$seg -= 1;
		}
		
		if( isset( $part[$seg]) ) 
		{
			return htmlspecialchars($part[$seg], ENT_QUOTES, "utf-8"); 
		}
		else 
		{
			return false;
		}
	}	
	
	/******************************************************************************************
	* CURRENT SEGMENT                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Urideki son segmenti verir.                                             |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|    																					  |
	| Örnek URL: http://www.example.com/test/zntr/yerli/framework      						  |
	| Örnek Kullanım: currentSegment(); // framework                                         |
	|          																				  |
	******************************************************************************************/
	public function currentSegment()
	{	
		$str = substr(server('currentPath'), 1, strlen(server('currentPath')) - 1);
		
		$str = explode("/", $str);
	
		if( count($str) > 1 ) 
		{
			return htmlspecialchars($str[count($str) - 1], ENT_QUOTES, "utf-8");	
		}
		
		return htmlspecialchars($str[0], ENT_QUOTES, "utf-8");	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Segment Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}