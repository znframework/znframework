<?php
/************************************************************/
/*                        CLASS URI                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Uri
{
	// Uri işlemleri için oluşturulmuştur.
	private static function clean_path()
	{
		$path_info = clean_injection(request_uri());
		
		// ----------------------------------------------------------------------
		
		// URL YÖNLENDİRİLİYOR...
		
		$path_info = route_uri($path_info);
		
		
		if( current_lang() )
		{
			$path_info = str_replace(current_lang().'/', '', $path_info);
		}
		
		return $path_info;
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
	public static function get($get = '', $index = 1, $while = false)
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
		if( ! is_char($index) ) 
		{
			$index = 1;		
		}
		if( ! is_value($while) ) 
		{
			$while = false;
		}
		// ------------------------------------------------------------------------------------
		
		$seg_ind = '';
		$seg_arr = self::segment_array();
		$seg_val = '';
		
		if( in_array($get, $seg_arr) )
		{ 
			$seg_val = array_search($get, $seg_arr); 
			
			// 3. parametrenin boş olmama durumu ve
			// 2. parametrenin sayısal olmama durumu
			if( ! empty($while) && ! is_numeric($index) )
			{
				$get_val   = array_search($get, $seg_arr);
				$index_val = array_search($index, $seg_arr);
				$return    = '';
		
				for($i = $get_val; $i <= $index_val; $i++)
				{
					$return .= htmlentities($seg_arr[$i])."/";
				}
				
				return substr($return,0,-1);
			}
			
			// 2. parametrenin all olma durumu
			// 1. parametreden itibaren bütün 
			// segmentleri verir.
			if( $index === 'all' )
			{
				$return = '';
				
				for($i=1; $i < count($seg_arr) - $seg_val; $i++)
				{
					$return .= htmlentities($seg_arr[$seg_val + $i])."/";
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
					$return .= htmlentities($seg_arr[$seg_val + $i])."/";
				}
				
				$return = substr($return,0,-1);
				
				return $return;
			}
			
			// 2. parametrenin count olma durumu
			// 1. parametrede belirtilen segmentten
			// itibaren kalan bölüm sayısını verir.
			if( $index === "count" )
			{
				return count($seg_arr) - 1 - $seg_val;
			}
			
			if( isset($seg_arr[$seg_val + $index]) ) 
			{
				return htmlentities($seg_arr[$seg_val + $index]); 
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
	| Örnek Kullanım: segment_array(); // array('test', 'zntr', 'yerli', 'framework')         |
	|          																				  |
	******************************************************************************************/
	public static function segment_array()
	{
		$segment_ex = explode("/", self::clean_path());
		return $segment_ex;	
	}
	
	/******************************************************************************************
	* TOTAL SEGMENTS                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Uride yer alan toplam segment sayısı.                                   |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|    																					  |
	| Örnek URL: http://www.example.com/test/zntr/yerli/framework      						  |
	| Örnek Kullanım: total_segments(); // 4                                                  |
	|          																				  |
	******************************************************************************************/
	public static function total_segments()
	{
		$segment_ex     = explode("/", self::clean_path());	
		$segment_ex     = array_diff($segment_ex, array(""," "));
		$total_segments = count($segment_ex);
		
		return $total_segments;
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
	public static function segment($seg = 1)
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
		
		$request_uri = server('request_uri');
		
		$base_dir    = substr(BASE_DIR,1,-1);
		
		if( isset($base_dir) ) 
		{
			$base_dir_ex = explode("/",$base_dir);
			
			$seg  += count($base_dir);
			
			$negative += count($base_dir);
		}
		if( index_status() ) 
		{ 
			$seg      += 1; 
			$negative += 1; 
		}
		if( current_lang() ) 
		{ 
			$seg      += 1; 
			$negative += 1; 
		}
	
		$part = explode('/', $request_uri);
		
		$count_part = count($part);
		
		if( $segment < 0 )
		{
			$seg = $count_part + ($segment);
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
			return clean_injection($part[$seg]); 
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
	| Örnek Kullanım: current_segment(); // framework                                         |
	|          																				  |
	******************************************************************************************/
	public static function current_segment()
	{	
		$str = substr(server('current_path'), 1, strlen(server('current_path')) - 1);
		
		$str = explode("/", $str);
	
		if( count($str) > 1 ) 
		{
			return clean_injection($str[count($str) - 1]);	
		}
		
		return clean_injection($str[0]);	
	}
}
