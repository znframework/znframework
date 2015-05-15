<?php 
/************************************************************/
/*                     CLASS  AJAX                   	    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Ajax
{
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
			$methods['url']  = ( ! is_url($methods['url'])) 
			                   ? site_url($methods['url']) 
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
			if( $key === "error" || $key === "success" || $key === "complete" || $key === "beforeSend"  || $key === "dataFilter" )
			{
				$value = "function(data){".$val."}"; 	
			}
			else
			{
				$value = '"'.$val.'"';
			}
			
			// Anahtar olarak gönderilen verilerden herhangi biri aşağıdaki koşulu sağlarsa
			// bu değer dönüş fonksiyonu olarak değerlendirilecektir.
			if( $key !== 'done' && $key !== 'then' && $key !== 'fail' && $key !== 'always' )
			{
				$method .= "\t\t".$key.':'.$value.','."\n";
			}
		}
		
		$method = substr($method,0,-2);
		
		$ajax = "\t".'$.ajax'."\n\t".'({'."\n".$method."\n\t".'})';
		
		// Dönüş Yöntemleri
		// 1-done
		// 2-then
		// fail
		// always
		if( isset($methods['done']) )  	  
		{
			$ajax .= '.done(function(data){'."\n\t\t".$methods['done']."\n\t".'});'."\n";
		}
		elseif( isset($methods['then']) )   
		{
			$ajax .= '.then(function(data){'."\n\t\t".$methods['then']."\n\t".'});'."\n";
		}
		elseif( isset($methods['fail']) )   
		{
			$ajax .= '.fail(function(data){'."\n\t\t".$methods['fail']."\n\t".'});'."\n";
		}
		elseif( isset($methods['always']) ) 
		{
			$ajax .= '.always(function(data){'."\n\t\t".$methods['always']."\n\t".'});'."\n";
		}
		else
		{
			$ajax .= ";\n";
		}
		
		return $ajax;
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
	public static function json_send_back($data = array())
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
	public static function send_back($data = '')
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
	public static function pagination($start = 0, $limit = 5, $total_rows = 20, $set = array())
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
		if( ! is_numeric($total_rows) ) 
		{
			$total_rows = 20;
		}
		if( ! is_array($set) ) 
		{
			$set = array();
		}
		// --------------------------------------------------------------------------------------
		
		// Önceki ve sonraki butonunun isimlendirmeleri
		$next_tag = ( isset($set['next_name']) ) 
				    ? $set['next_name'] 
					: 'Sonraki';
					
		$prev_tag = ( isset($set['prev_name']) ) 
		            ? $set['prev_name'] 
					: 'Önceki';
		// --------------------------------------------------------------------------------------
		
		// Önceki ve sonraki butonununa ait css ve stil kullanımı -------------------------------
		$next_class = ( isset($set['class']['next']) ) 
		              ? ' class="'.$set['class']['next'].'"' 
					  : '';
		
		$next_style = ( isset($set['style']['next']) ) 
		              ? ' style="'.$set['style']['next'].'"' 
					  : '';
		
		$prev_class = ( isset($set['class']['prev']) ) 
		              ? ' class="'.$set['class']['prev'].'"' 
					  : '';
		
		$prev_style = ( isset($set['style']['prev']) ) 
		              ? ' style="'.$set['style']['prev'].'"' 
					  : '';
		// --------------------------------------------------------------------------------------
		
		$attr = "";
		$link_count = ceil(($total_rows ) / $limit);
		
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
		
		$links  = "\n<div ajax='pagination'>\n";
		
		// Başlangıç değerinin pozitif olma durumuna göre gerekli kontrol sağlanıyor.------------
		if($start > 0) 
		{
			$links .= "\t<input$prev_class$prev_style type='button' page='".$prev."' value='".$prev_tag."'>";
		}
		// --------------------------------------------------------------------------------------
		
		// Sayfalama Linkleri Oluşturuluyor...---------------------------------------------------
		for($i = 1; $i <= $link_count; $i++)
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
			$links .= "\t<input$attr type='button' page='".$current."' value='".$i."'>\n";
			// ----------------------------------------------------------------------------------
		}
		// --------------------------------------------------------------------------------------
		
		// Sonraki butonunun durumu kontrol ediliyor...------------------------------------------
		if( $next < $total_rows ) 
		{
			$links .= "\t<input$next_class$next_style type='button' page='".$next."' value='".$next_tag."'>\n";
		}
		// --------------------------------------------------------------------------------------
		
		$links .= "</div>\n";
		
		// Toplam satırın limit miktarına göre durumu kontrol ediliyor...------------------------
		if( $total_rows > $limit )
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