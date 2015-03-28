<?php
/************************************************************/
/*                     CLASS HTML5                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Html5
{
	
	public static function attributes($attributes = '')
	{
		$attribute = '';
		
		if(is_array($attributes))
		{
			foreach($attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}
		
		return $attribute;	
	}
	
	
  // Yeni Form Özellikleri
  /*
  	“autofocus” ile sayfa yüklendiğinde ilgili text alanına otomatik olarak odaklanma yapılabilir.
  	
	“placeholder” sayesinde eskiden JavaScript ile yapılan, text alanının üstüne odaklanıldığında kaybolan tanımlar eklenebilir.
	
	“required” ile herhangi bir JavaScript kodu kullanmadan metin, sayı, e-posta gibi verilerin form kontrolü yapılabilir.
	
	“autocomplete” özelliği ile kullanıcının daha önce girdiği değerlere göre otomatik tamamlama özelliği aktif ya da pasif duruma alınabilir. “on” veya “off” değerlerini alır.
	
	“min” ve “max” değerleri ile sayı, tarih, aralık gibi veri tiplerinde minimum ve maximum alınabilecek değerler belirtilebilir.
	
	“step” değeri “min” ve “max” değerleri arasındaki eksiltme ya da arttırma aralığı belirtir.
		Aşağıdaki örnekte girilen sayı alt ve üst sınır içinde 10’ar 10’ar eksiltilir ya da arttırabilir.
	
	“pattern” ile kullanıcıdan belirlenen standartta veri alınabilmesi sağlanabilir.
		Örnekte, kullanıcıdan 0 ile 9 arasında 2 tane rakam – a ile z arasında 6 tane küçük harf yazması istenmiştir. A-Z olsaydı, büyük harf yazılması gerekecekti.
  */
	
	public static function form_open($name = '', $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		if(isset($_attributes['enctype']))
		{
			switch($_attributes['enctype'])
			{
				case "multipart" 	: $_attributes['enctype'] = 'multipart/form-data'; 					break;
				case "application" 	: $_attributes['enctype'] = 'application/x-www-form-urlencoded';	break;
				case "text" 		: $_attributes['enctype'] = 'text/plain'; 							break;
			}
		}
		if(!isset($_attributes['method'])) $_attributes['method'] = 'post';
		
		return '<form name="'.$name.'" '.$id_txt.' '.self::attributes($_attributes).'>'."\n";
	}


	public static function form_close()
	{
		return '</form>'."\n";
	}
	
	//email : E-Mailler için
	
	public static function email_object($name = '', $value = '', $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="email" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//url : url girebilmek için
	
	public static function url_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="url" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	//number : sadece rakam yazmak için. min, max, step ve value öznitelikleri tanımlanabilir.
	public static function number_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="number" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//search : arama inputları için
	
	public static function search_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="search" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//tel : telefon yazmak için
	
	public static function tel_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="tel" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//color : renkler için
	
	public static function color_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="color" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//date : doğumgünü, yıldönümü vs için.
	
	public static function date_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="date" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//datetime : date tipine ek olarak saati de kapsamaktadır.
	
	public static function datetime_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="datetime" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//datetime-local : datetime tipine ek olarak zaman dilimi tanımlar.
	
	public static function datetime_local_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="datetime-local" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//time : Saat için kullanılır.
	
	public static function time_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="time" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//week : hafta bilgisini yazmak için kullanılır.
	
	public static function week_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="week" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//month : Ay bilgisini yazmak için kullanılır.
	
	public static function month_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="month" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//range : Fiyat aralığı vb yazmak için kullanılır. min, max, step ve value öznitelikleri tanımlanabilir.
	
	public static function range_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
	
		return '<input type="range" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	public static function image_object($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="image" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	public static function input_object($type = "", $name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($type))  return false;
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="'.$type.'" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	//Üst Bölüm
	public static function header($html = "")
	{
		if( ! (is_string($html) || is_numeric($html)))  $html = '';
		$str = "<header>".$html."</header>";
		return $str;
	}
	
	//Alt Bölüm
	public static function footer($html = "")
	{
		if( ! (is_string($html) || is_numeric($html)))  $html = '';
		$str = "<footer>".$html."</footer>";
		return $str;
	}
	
	//Menü Bölümünü Oluşturuyour
	public static function nav($html = "")
	{
		if( ! (is_string($html) || is_numeric($html)))  $html = '';
		$str = "<nav>".$html."</nav>";
		return $str;
	}	
	
	//Makalelerin Listeleneceğil Alan olarak Düşünüşüyor
	public static function article($html = "")
	{
		if( ! (is_string($html) || is_numeric($html)))  $html = '';
		$str = "<article>".$html."</article>";
		return $str;
	}
	
	//Reklam Alanı Olarak Düşünülüyor
	public static function aside($html = "")
	{
		if( ! (is_string($html) || is_numeric($html)))  $html = '';
		$str = "<aside>".$html."</aside>";
		return $str;
	}
	
	//Bölümler oluşturmak için
	public static function section($html = "")
	{
		if( ! (is_string($html) || is_numeric($html)))  $html = '';
		$str = "<section>".$html."</section>";
		return $str;
	}
	
	//Başlık gurupları oluşturmak için kullanılması düşünülüyor
	public static function hgroup($html = "")
	{
		if( ! (is_string($html) || is_numeric($html)))  $html = '';
		$str = "<hgroup>".$html."</hgroup>";
		return $str;
	}

	
	public static function canvas($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<canvas'.self::attributes($_attributes).'>'.$content."</canvas>\n";
	}
	
	public static function datalist($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<datalist'.self::attributes($_attributes).'>'.$content."</datalist>\n";
	}
	
	public static function output($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<output'.self::attributes($_attributes).'>'.$content."</output>\n";
	}
		
	
	public static function details($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<details'.self::attributes($_attributes).'>'.$content."</details>\n";
	}
	
	public static function summary($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<summary'.self::attributes($_attributes).'>'.$content."</summary>\n";
	}
	
	public static function figure($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<figure'.self::attributes($_attributes).'>'.$content."</figure>\n";
	}
	
	
	public static function figcaption($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<figcaption'.self::attributes($_attributes).'>'.$content."</figcaption>\n";
	}
	
	public static function mark($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<mark'.self::attributes($_attributes).'>'.$content."</mark>\n";
	}
	

	public static function time($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<time'.self::attributes($_attributes).'>'.$content."</time>\n";
	}

	
	public static function dialog($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<dialog'.self::attributes($_attributes).'>'.$content."</dialog>\n";
	}

	public static function command($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<command'.self::attributes($_attributes).'>'.$content."</command>\n";
	}
	
	public static function meter($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<meter'.self::attributes($_attributes).'>'.$content."</meter>\n";
	}
	
	public static function progress($content = "", $_attributes = '')
	{
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		return '<progress'.self::attributes($_attributes).'>'.$content."</progress>\n";
	}

	
	public static function keygen($_attributes = '')
	{
		return '<keygen'.self::attributes($_attributes).'>'."\n";
	}
	
	
	public static function embed($src = "", $_attributes = '')
	{
		if( ! is_string($src)) $src = "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<embed src="'.$src.'"'.self::attributes($_attributes).'>'."\n";
	}
	
	public static function source($src = "", $attributes = array(""))
	{
		if( ! is_string($src)) $src = "";
		$str = "<source src='".$src."'".self::attributes($attributes)." />";
		return $str;
	}
	
	//PARAMETERS
	//src=url Gösterilmek istenen vidyonun URL'sini tanımlar
	//autoplay=autoplay videonun otomati olarak çalışmaya başlayacağını belirtir
	//controls=controls Oynatma ve durdurma gibi kontrol düğmeleri eklenir.
	//height=pixel Video gösterimi için yükseklik değeri belirtir.
	//width=pixel Video göstermi için genişlik değeri belirtir.
	//loop=loop Vidyonun bitince yeniden oynatılacağını belirtir.
	//preload=preload Belirtilen vidyo için ön yükleme yapar
	
	public static function video($src = "", $content = "", $attributes = array(""))
	{
		if( ! is_string($src)) $src = "";
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		$str = "<video src='".$src."'".self::attributes($attributes).">".$content."</video>";
		return $str;
	}
	
	//PARAMETERS
	//src=url Gösterilmek istenen vidyonun URL'sini tanımlar
	//autoplay=autoplay videonun otomati olarak çalışmaya başlayacağını belirtir
	//controls=controls Oynatma ve durdurma gibi kontrol düğmeleri eklenir.
	//height=pixel Video gösterimi için yükseklik değeri belirtir.
	//width=pixel Video göstermi için genişlik değeri belirtir.
	//loop=loop Vidyonun bitince yeniden oynatılacağını belirtir.
	//preload=preload Belirtilen vidyo için ön yükleme yapar
	public static function audio($src = "", $content = "", $attributes = array(""))
	{
		if( ! is_string($src)) $src = "";
		if( ! (is_string($content) || is_numeric($content)))  $content = '';
		$str = "<audio src=".$src." ".self::attributes($attributes).">".$content."</audio>";
		return $str;
	}
}