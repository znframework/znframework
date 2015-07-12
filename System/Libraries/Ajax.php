<?php 	
class Ajax
{
	/***********************************************************************************/
	/* AJAX LIBRARY						                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Ajax
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: ajax::, $this->ajax, zn::$use->ajax, uselib('ajax')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/

	/* Functions Dizi Değişkeni
	 *  
	 * Fonksiyon içerikli veri tutacak özellikler
	 * için oluşturulmuştur.
	 *
	 */
	protected static $functions = array
	(
		'error', 
		'success', 
		'complete', 
		'beforeSend', 
		'dataFilter'
	);
	
	/* Callback Functions Dizi Değişkeni
	 *  
	 * Dönüş Fonksiyon içerikli veri tutacak özellikler
	 * için oluşturulmuştur.
	 *
	 */
	protected static $callbackFunctions = array
	(
		'done', 
		'always', 
		'then', 
		'fail'
    );
	
	/******************************************************************************************
	* SEND                                                                               	  *
	*******************************************************************************************
	| Genel Kullanım: Ajax ile veri gönderimi için kullanılır.								  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @methods => Ajax işlemleri için gerekli veriler.							  |
	|          																				  |
	| @methods parametresinin alabileceği değerler:											  |
	| type, url, dataType, error, success, complete, beforeSend, done ve diğer özellikler	  |
	******************************************************************************************/	
	public static function send($methods = array())
	{
		if( ! is_array($methods) ) 
		{
			return false;
		}
	
		$methods['type'] = ''; $method = '';		
		
		// type: parametresinin değeri varsayılan olarak post belirlenmiştir.
		$methods['type'] = ( ! $methods['type']) 
						   ? 'post' 
						   : $methods['type'];
		
		if( isset($methods['url']) )
		{
			// url kontrolü yapıldı. 
			$methods['url']  = ( ! isUrl($methods['url'])) 
			                   ? siteUrl($methods['url']) 
							   : $methods['url']; 
		}
		
		foreach($methods as $key => $val)
		{
			// Anahtar olarak gönderilen verilerden herhangi biri aşağıdaki koşulu sağlarsa
			// bu değer fonksiyon olarak değerlendirilecektir.
			// Yöntemler
			// 1-success
			// 2-complete
			// 3-beforeSend
			// 4-dataFilter
			// 5-error
			
			if( in_array($key, self::$functions) )
			{
				$value = "function(data){".$val."}"; 	
			}
			else
			{
				$value = self::_value_control($val);
			}
			
			// Anahtar olarak gönderilen verilerden herhangi biri aşağıdaki koşulu sağlarsa
			// bu değer dönüş fonksiyonu olarak değerlendirilecektir.
			if( ! in_array($key, self::$callbackFunctions) )
			{
				$method .= "\t\t".$key.':'.$value.','.eol();
			}
		}
		
		$method = substr($method,0,-2);
		
		$ajax = "\t".'$.ajax'.eol()."\t".'({'.eol().$method.eol()."\t".'})';
		
		
		// Dönüş Yöntemleri
		// 1-done
		// 2-then
		// fail
		// always
		
		$isCallback = false;
		
		foreach(self::$callbackFunctions as $callfunc)
		{
			if( isset($methods[$callfunc]) )
			{
				$ajax .= '.'.$callfunc.'(function(data){'.eol()."\t\t".$methods[$callfunc].eol()."\t".'});'.eol();
				$isCallback = true;
			}
		}
	
		if($isCallback === false)
		{
			$ajax .= ";".eol();
		}
		
		return $ajax;
	}
	
	// Özelliklerin değerlerinin kontrolü sağlanıyor..
	// Eğer anahtar içerikli kelimeler içermiyorsa
	// Veri tırnak içerisine alınıyor.
	protected static function _value_control($val)
	{
		if( strtolower($val) === "true")
		{
			return "true";	
		}
		elseif( strtolower($val) === "false")
		{
			return "false";	
		}
	    elseif(preg_match('/\{.+\:.+\}/', $val))
		{
			return $val;
		}
		elseif(preg_match('/function.*\(.*\)/', $val))
		{
			return $val;	
		}
		else
		{
			return "\"$val\"";	
		}
		
	}
	
	/******************************************************************************************
	* JSON SEND BACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Ajax işlemleri sırasında verinin json tipinde veri olarak gönderilmesi  |
	| için kullanılır.														                  |
	|																						  |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @data => Gönderilecek olan dizi.							  				  |
	|          																				  |
	******************************************************************************************/	
	public static function jsonSendBack($data = array())
	{
		if( empty($data) || ! is_array($data) ) 
		{
			return false;
		}
		
		exit(json_encode($data));	
	}
	
	/******************************************************************************************
	* SEND BACK                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Ajax işlemleri sırasında veri döndürmek için kullanılır.				  |
	|																						  |
	| Parametreler: Tek parametreden oluşur.                                                  |
	| 1. mixed var @data => Çıktı oluşturulacak veri.							  		      |
	|          																				  |
	******************************************************************************************/	
	public static function sendBack($data = '')
	{
		if( is_array($data) )
		{ 
			return false;
		}
		
		echo $data; exit;	
	}
	
	/******************************************************************************************
	* PR                                                                                      *
	*******************************************************************************************
	| Genel Kullanım: print_r() yöntemine ilave olarak exit kodu eklenmiştir.				  |
	|																						  |
	| Parametreler: Tek parametreden oluşur.                                                  |
	| 1. array var @data => Çıktı oluşturulacak veri.							  		      |
	|          																				  |
	******************************************************************************************/	
	public static function pr($data = array())
	{
		if( empty($data) || ! is_array($data) ) 
		{
			return false;
		}
		
		print_r($data); exit;
	}
	
	/******************************************************************************************
	* DUMP                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: var_dump() yöntemine ilave olarak exit kodu eklenmiştir.				  |
	|																						  |
	| Parametreler: Tek parametreden oluşur.                                                  |
	| 1. array var @data => Çıktı oluşturulacak veri.							  		      |
	|          																				  |
	******************************************************************************************/	
	public static function dump($data)
	{
		if( empty($data) || ! is_array($data) ) 
		{
			return false;
		}
		
		var_dump($data); exit;
	}
	
	/******************************************************************************************
	* PAGINATION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Post edilmeyen bir sayfalama yapmak için kullanılır. Ancak sayfalama    |
	|  butonları oluşturulduktan sonra kodlanması size bağlıdır.							  |
	|															                              |
	| Parametreler: 4 Parametresi vardır.                                                     |
	| 1. numeric var @start => Sayfalamaya kaçıncı kayıttan başlanacağıdır.					  |
	| 2. numeric var @limit => Her sayfada en fazla kaç kayıt olacağıdır.					  |
	| 3. numeric var @total_rows => Toplam kayıt sayısıdır.					  				  |
	| 4. array var @settings => Sayfalamaya style ya da css kodları eklemek için kullanılır.  |
	|          																				  |
	| Settings parametresinin alabileceği değerler        									  |
	|          																				  |
	| $set['prev_name'] => Önceki Butonunun İsmi         									  |
	| $set['next_name'] => Sonraki Butonunun İsmi        									  |
	|          																				  |
	| $set['style']['next'] => Sonraki butonuna eklenecek stil.        						  |
	| $set['style']['prev'] => Önceki butonuna eklenecek stil.      					      |
	| $set['style']['current'] => Aktif sayfaya ait butona eklenecek stil.      			  |
	|          																				  |
	| $set['class']['next'] => Sonraki butonuna eklenecek css sınıfı.        				  |
	| $set['class']['prev'] => Önceki butonuna eklenecek css sınıfı.      					  |
	| $set['class']['current'] => Aktif sayfaya ait butona eklenecek css sınıfı.      		  |
	|          																				  |
	| @methods parametresinin alabileceği değerler:											  |
	| type, url, dataType, error, success, complete, beforeSend, done ve diğer özellikler	  |
	******************************************************************************************/
	public static function pagination($start = 0, $limit = 5, $totalRows = 20, $set = array())
	{
		// Parametrelerin kontrolleri yapılıyor. -----------------------------------------------
		if( ! is_numeric($start) ) 
		{
			$start = 0;
		}
		if( ! is_numeric($limit) ) 
		{
			$limit = 5;
		}
		if( ! is_numeric($totalRows) ) 
		{
			$totalRows = 20;
		}
		if( ! is_array($set) ) 
		{
			$set = array();
		}
		// --------------------------------------------------------------------------------------
		
		// Önceki ve sonraki butonunun isimlendirmeleri
		$nextTag = ( isset($set['nextName']) ) 
				   ? $set['nextName'] 
				   : 'Sonraki';
					
		$prevTag = ( isset($set['prevName']) ) 
		           ? $set['prevName'] 
				   : 'Önceki';
		// --------------------------------------------------------------------------------------
		
		// Önceki ve sonraki butonununa ait css ve stil kullanımı -------------------------------
		$nextClass = ( isset($set['class']['next']) ) 
		             ? ' class="'.$set['class']['next'].'"' 
					 : '';
		
		$nextStyle = ( isset($set['style']['next']) ) 
		             ? ' style="'.$set['style']['next'].'"' 
					 : '';
		
		$prevClass = ( isset($set['class']['prev']) ) 
		             ? ' class="'.$set['class']['prev'].'"' 
					 : '';
		
		$prevStyle = ( isset($set['style']['prev']) ) 
		             ? ' style="'.$set['style']['prev'].'"' 
					 : '';
		// --------------------------------------------------------------------------------------
		
		$attr = "";
		$linkCount = ceil(($totalRows) / $limit);
		
		// Başlangıç ve limit farkının negatif değer alma durumunun kontrolü yapılmaktadır.------
		if( $start - $limit < 0 )
		{ 
			$prev = 0; 
		}
		else 
		{
			$prev = $start - $limit;
		}
		// --------------------------------------------------------------------------------------
		
		$next = $start + $limit;
		
		$links  = eol()."<div ajax='pagination'>".eol();
		
		// Başlangıç değerinin pozitif olma durumuna göre gerekli kontrol sağlanıyor.------------
		if($start > 0) 
		{
			$links .= "\t<input$prevClass$prevStyle type='button' page='".$prev."' value='".$prevTag."'>";
		}
		// --------------------------------------------------------------------------------------
		
		// Sayfalama Linkleri Oluşturuluyor...---------------------------------------------------
		for($i = 1; $i <= $linkCount; $i++)
		{
			$current = (($i * $limit) - 1) - $limit;
			if( $current < 0 ) $current = 0;
			
			// Aktif sayfa butonununa ait css ve stil kullanımı ---------------------------------
			if( $start == $current )
			{ 
				if( isset($set["class"]["current"]) ) 
				{
					$attr = ' class="'.$set["class"]["current"].'" '; 
				}
				if( isset($set["style"]["current"]) )
				{
					$attr = ' style="'.$set["style"]["current"].'" '; 
				}
			}
			else
			{
				$attr = "";	
			}
			$links .= "\t<input$attr type='button' page='".$current."' value='".$i."'>".eol();
			// ----------------------------------------------------------------------------------
		}
		// --------------------------------------------------------------------------------------
		
		// Sonraki butonunun durumu kontrol ediliyor...------------------------------------------
		if( $next < $totalRows ) 
		{
			$links .= "\t<input$nextClass$nextStyle type='button' page='".$next."' value='".$nextTag."'>".eol();
		}
		// --------------------------------------------------------------------------------------
		
		$links .= "</div>".eol();
		
		// Toplam satırın limit miktarına göre durumu kontrol ediliyor...------------------------
		if( $totalRows > $limit )
		{ 
			return $links; 
		}
		else 
		{
			return false;
		}
		// --------------------------------------------------------------------------------------
	}
}