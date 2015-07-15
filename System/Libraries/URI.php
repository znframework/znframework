<?php
class StaticURI
{
	/***********************************************************************************/
	/* URI LIBRARY	    					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: URI
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: uri::, $this->uri, zn::$use->uri, uselib('uri')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	// Uri işlemleri için oluşturulmuştur.
	protected function cleanPath()
	{
		$pathInfo = cleanInjection(requestUri());
		
		// ----------------------------------------------------------------------
		
		// URL YÖNLENDİRİLİYOR...
		
		$pathInfo = routeUri($pathInfo);
		
		
		if(  strstr($pathInfo, getLang()) )
		{
			$pathInfo = str_replace(getLang().'/', '', $pathInfo);
		}
		
		return $pathInfo;
	}
	
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
		if( empty($get) ) 
		{
			return false;
		}
		if( ! is_string($get) ) 
		{
			return false;
		}
		if( ! isChar($index) ) 
		{
			$index = 1;		
		}
		if( ! isValue($while) ) 
		{
			$while = false;
		}
		// ------------------------------------------------------------------------------------
		
		$segArr = $this->segmentArray();
		$segVal = '';
		
		if( in_array($get, $segArr) )
		{ 
			$segVal = array_search($get, $segArr); 
			
			// 3. parametrenin boş olmama durumu ve
			// 2. parametrenin sayısal olmama durumu
			if( ! empty($while) && ! is_numeric($index) )
			{
				$getVal   = array_search($get, $segArr);
				$indexVal = array_search($index, $segArr);
				$return   = '';
		
				for($i = $getVal; $i <= $indexVal; $i++)
				{
					$return .= htmlentities($segArr[$i])."/";
				}
				
				return substr($return, 0, -1);
			}
			
			// 2. parametrenin all olma durumu
			// 1. parametreden itibaren bütün 
			// segmentleri verir.
			if( $index === 'all' )
			{
				$return = '';
				
				for($i=1; $i < count($segArr) - $segVal; $i++)
				{
					$return .= htmlentities($segArr[$segVal + $i])."/";
				}
				$return = substr($return,0,-1);
				
				return $return;
			}
			
			// 3. parametrenin boş olmaması durumu
			if( ! empty($while) )
			{
				$return = '';
				
				for($i= 1; $i <= $index; $i++)
				{
					$return .= htmlentities($segArr[$segVal + $i])."/";
				}
				
				$return = substr($return,0,-1);
				
				return $return;
			}
			
			// 2. parametrenin count olma durumu
			// 1. parametrede belirtilen segmentten
			// itibaren kalan bölüm sayısını verir.
			if( $index === "count" )
			{
				return count($segArr) - 1 - $segVal;
			}
			
			if( isset($segArr[$segVal + $index]) ) 
			{
				return htmlentities($segArr[$segVal + $index]); 
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
		$segmentEx = explode("/", $this->cleanPath());
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
		$segmentEx     = explode("/", $this->cleanPath());	
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
			return false;
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
		
		$requestUri = server('requestUri');
		
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
			return cleanInjection($part[$seg]); 
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
			return cleanInjection($str[count($str) - 1]);	
		}
		
		return cleanInjection($str[0]);	
	}
}