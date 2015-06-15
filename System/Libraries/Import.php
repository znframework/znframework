<?php

/************************************************************/
/*                       CLASS IMPORT                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* CONTROLLER CLASS                                                                        *
*******************************************************************************************
| Sınıfı Kullanırken      :	import::, $this->import, zn::$use->import, uselib('import')   |
|																						  |
******************************************************************************************/	
class Import
{
	/* Is Import Değişkeni
	 *  
	 * Bir sınıfın daha önce dahil edilip edilmediği
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	private static $is_import = array();
	
	/******************************************************************************************
	* PAGE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Views dosyası dahil etmek için kullanılır.						      |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public static function page($randomPageVariable = '', $randomDataVariable = '', $randomObGetContentsVariable = false)
	{
		if( ! is_string($randomPageVariable) )
		{
			return false;
		}
		
		if( is_array($randomDataVariable) )
		{
			extract($randomDataVariable, EXTR_OVERWRITE, 'zn');
		}
		
		if( $randomObGetContentsVariable === false )
		{
			if( ! isFileExists(PAGES_DIR.suffix($randomPageVariable,".php")) ) 
			{
				return false;
			}
			require(PAGES_DIR.suffix($randomPageVariable,".php")); 
		}
		elseif( $randomObGetContentsVariable === true )
		{
			if( ! isFileExists(PAGES_DIR.suffix($randomPageVariable,".php")) ) 
			{
				return false;
			}
			
			ob_start(); 
			require(PAGES_DIR.suffix($randomPageVariable,".php")); 
			$randomContentVariable = ob_get_contents(); 
			ob_end_clean(); 
			
			return $randomContentVariable ; 
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* VIEW                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Views dosyası dahil etmek için kullanılır.						      |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public static function view($page = '', $data = '', $ob_get_contents = false)
	{
		return self::page($page, $data, $ob_get_contents);
	}
	
	/******************************************************************************************
	* BLADEPAGE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Views dosyasında manipüle edilmiş blade dosyasını dahil etmek için 	  |
	| kullanılır.						      												  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public static function bladepage($page = '', $data = '', $ob_get_contents = false)
	{
		return uselib('Template\CBlade')->view($page, $data, $ob_get_contents);
	}
	
	/******************************************************************************************
	* PARSERPAGE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Views dosyasında manipüle edilmiş PARSER dosyasını dahil etmek için 	  |
	| kullanılır.						      												  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public static function parserpage($page = '', $data = '', $ob_get_contents = false)
	{
		return uselib('Template\CParser')->view($page, $data, $ob_get_contents);
	}
	
	/******************************************************************************************
	* MASTERPAGE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Views/Pages/ dizini içinde yer alan herhangi bir sayfayı masterpage     |
	| olarak ayarlamak için kullanılır.										  				  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. array var @data => Sayfanın body bölümüne veri göndermek için kullanılır. 		      |
	| 2. array var @head => Sayfanın head bölümüne veri göndermek için kullanılır. 			  |
	|          																				  |
	| Örnek Kullanım: import::masterpage();        						  					  |
	|          																				  |
	| NOT: Bir sayfayı masterpage olarak ayarlamak için Config/Masterpage.php dosyası		  |
	| kullanılır.	        															      |
	|          																				  |
	******************************************************************************************/
	public static function masterpage($randomDataVariable = array(), $head = array())
	{	
		//------------------------------------------------------------------------------------
		// Config/Masterpage.php dosyasından ayarlar alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		$masterpageset = config::get('Masterpage');
		
		//------------------------------------------------------------------------------------
		// Başlık ve vücud sayfaları alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		$randomPageVariable = ( isset($head['body_page']) ) 
					          ? $head['body_page'] 
						      : $masterpageset['body_page'];
		
		$head_page = 	( isset($head['head_page']) ) 
					    ? $head['head_page'] 
						: $masterpageset['head_page'];
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
	
		if( ! is_file(PAGES_DIR.suffix($randomPageVariable,".php")) )
		{ 
			$randomPageVariable = ''; 
		}
		else
		{ 
			$randomPageVariable = PAGES_DIR.suffix($randomPageVariable,".php");
		}
		
		if( ! is_file(PAGES_DIR.suffix($head_page,".php")) ) 
		{
			$head_page = ''; 
		}
		else
		{ 
			$head_page = PAGES_DIR.suffix($head_page,".php");
		}
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HTML START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		$header  = config::get('Doctype', $masterpageset['doctype']).eof();
		$header	.= '<html xmlns="http://www.w3.org/1999/xhtml">'.eof();
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HEAD START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		$header .= '<head>'.eof();
		
		if( is_array($masterpageset["content_charset"]) )
		{
			foreach($masterpageset["content_charset"] as $v)
			{
				$header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$v\">".eof();	
			}
		}
		else
		{
			$header .= '<meta http-equiv="Content-Type" content="text/html; charset='.$masterpageset['content_charset'].'">'.eof();	
		}
		
		$header .= '<meta http-equiv="Content-Language" content="'.config::get('Masterpage','content_language').'">'.eof();
			
		//------------------------------------------------------------------------------------
		// Data ve Meta verileri alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------					
		$datas 		= $masterpageset['data'];
						
		$metas 		= $masterpageset['meta'];
						
		$title 		= ( isset($head['title']) ) 			
					  ? $head['title'] 		
					  : $masterpageset["title"];
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		if( ! empty($title) ) 			
		{
			$header .= '<title>'.$title.'</title>'.eof();	
		}
		
		//------------------------------------------------------------------------------------
		// Meta tagları dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		if( isset($head['meta']) )
		{
			$metas = array_merge($metas, $head['meta']);
		}
		
		if( ! empty($metas) ) foreach($metas as $name => $content)
		{
			if( isset($head['meta'][$name]) )
			{
				$content = $head['meta'][$name];
			}
			
			if( ! empty($content) )
			{
				$nameex = explode("->", $name);
				
				$httporname = ( $nameex[0] === 'http' )
							  ? 'http-equiv'
							  : 'name';
				
				$name 		= ( isset($nameex[1]) )
							  ? $nameex[1]
							  : $nameex[0];
							  
				if( ! is_array($content) )
				{			  
					$header .= "<meta $httporname=\"$name\" content=\"$content\">".eof();
				}
				else
				{
					foreach($content as $key => $val)
					{
						$header .= "<meta $httporname=\"$name\" content=\"$val\">".eof();	
					}	
				}
			}
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		//------------------------------------------------------------------------------------
		// Fontlar dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		if( ! empty($masterpageset["font"]) )
		{					
			$header .= self::font($masterpageset["font"], true);
		}
		
		if( isset($head['font']) )
		{					
			$header .= self::font($head['font'], true);
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		//------------------------------------------------------------------------------------
		// Javascript kodları dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		if( is_array($masterpageset['script']) )
		{
			$header .= self::script($masterpageset['script'], true);
		}
		
		if( isset($head['script']) )
		{
			$header .= self::script($head['script'], true);
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		//------------------------------------------------------------------------------------
		// Stiller dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		if( is_array($masterpageset['style']) )
		{
			$header .= self::style($masterpageset['style'], true);
		}
		
		if( isset($head['style']) )
		{
			$header .= self::style($head['style'], true);
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		if( ! empty($masterpageset['browser_icon']) ) 
		{
			$header .= '<link rel="shortcut icon" href="'.baseUrl($masterpageset['browser_icon']).'" />'.eof();
		}
		
		if( ! empty($head['page_image']) ) 
		{
			$header .= '<link rel="image_src" href="'.$head['page_image'].'" />'.eof();	
		}
		
		//------------------------------------------------------------------------------------
		// Farklı veriler dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		if( isset($head['data']) )
		{
			$datas = array_merge($datas, $head['data']);
		}
		
		if( ! empty($datas) )
		{ 
			if( ! is_array($datas) )
			{ 
				$header .= $datas.eof(); 
			}
			else
			{
				foreach($datas as $v)
				{
					$header .= $v.eof();	
				}	
			}
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		//------------------------------------------------------------------------------------
		// Başlık sayfası dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		if( ! empty($head_page) )
		{
			ob_start(); 
			
			require_once($head_page); 
			
			$content = ob_get_contents();
			 
			ob_end_clean(); 
			
			$header .= $content.eof() ; 	
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		$header .= '</head>'.eof();
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HEAD END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>BODY START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		//------------------------------------------------------------------------------------
		// Arkaplan resmi dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		if( $masterpageset["bg_image"] ) 
		{
			$bg_image = " background='".baseUrl($masterpageset["bg_image"])."' bgproperties='fixed'"; 
		}
		else 
		{
			$bg_image = "";
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		$header .= '<body'.$bg_image.'>'.eof();
	
		echo $header;
		
		if( is_array($randomDataVariable) ) 
		{
			extract($randomDataVariable, EXTR_OVERWRITE, 'zn');
		}
		
		if( ! empty($randomPageVariable) ) 
		{
			require($randomPageVariable);	
		}
		
		$randomFooterVariable  = eof().'</body>'.eof();
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>BODY END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		$randomFooterVariable .= '</html>';
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HTML END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		//------------------------------------------------------------------------------------
		// Masterpage oluşturuluyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		echo $randomFooterVariable;	
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
	}	
	
	/******************************************************************************************
	* FONT                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Harici font yüklemek için kullanılır. Yüklenmek istenen fontlar		  |
	| Views/Fonts/ dizinine atılır.										  				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @fonts => Parametre olarak sıralı font dosyalarını veya dizi içinde   |
	| eleman olarak kullanılan font dosyalarını dahil etmek için kullanılır.			      |
	|          																				  |
	| Örnek Kullanım: import::font('f1', 'f2' ... 'fN');        						      |
	| Örnek Kullanım: import::font(array('f1', 'f2' ... 'fN'));        				          |
	|          																				  |
	******************************************************************************************/
	public static function font()
	{	
		$str = "<style type='text/css'>";
		
		$arguments = func_get_args();
		$args      = $arguments;
		
		if( isset($arguments[0]) && is_array($arguments[0]) )
		{
			$arguments = $arguments[0];
		}
		
		foreach(array_unique($arguments) as $font)
		{	
			if( is_array($font) ) 
			{
				$font = '';
			}
			
			$f = divide($font, "/", -1);
			// SVG IE VE MOZILLA DESTEKLEMIYOR
			if( isFileExists(FONTS_DIR.$font.".svg") )
			{			
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".svg").'") format("truetype")}'.eof();				
			}
			if( isFileExists(FONTS_DIR.$font.".woff") )
			{			
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".woff").'") format("truetype")}'.eof();		
			}
			// OTF IE VE CHROME DESTEKLEMIYOR
			if( isFileExists(FONTS_DIR.$font.".otf") )
			{
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".otf").'") format("truetype")}'.eof();			
			}
			
			// TTF IE DESTEKLEMIYOR
			if( isFileExists(FONTS_DIR.$font.".ttf") )
			{		
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".ttf").'") format("truetype")}'.eof();			
			}
			
			// FARKLI FONTLAR
			$differentset = config::get('Font', 'different_font_extensions');
			
			if( ! empty($differentset) )
			{			
				foreach($differentset as $of)
				{
					if( isFileExists(FONTS_DIR.$font.prefix($of, '.')) )
					{		
						$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.prefix($of, '.')).'") format("truetype")}'.eof();			
					}
				}	
			}
			
			// EOT IE DESTEKLIYOR
			if( isFileExists(FONTS_DIR.$font.".eot") )
			{
				$str .= '<!--[if IE]>';
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".eot").'") format("truetype")}';
				$str .= '<![endif]-->';
				$str .= eof();
			}		
		}
		
		$str .= '</style>'.eof();
		
		if( ! empty($str) ) 
		{
			if( $args[count($args) - 1] === true )
			{
				return $str;
			}
			else
			{
				echo $str; 
			}
		}
		else
		{ 
			return false;
		}
	}
	
	/******************************************************************************************
	* STYLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Harici stil yüklemek için kullanılır. Yüklenmek istenen stiller		  |
	| Views/Styles/ dizinine atılır.									  				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @styles => Parametre olarak sıralı stil dosyalarını veya dizi içinde  |
	| eleman olarak kullanılan stil dosyalarını dahil etmek için kullanılır.			      |
	|          																				  |
	| Örnek Kullanım: import::style('s1', 's2' ... 'sN');        						      |
	| Örnek Kullanım: import::style(array('s1', 's2' ... 'sN'));        				      |
	|          																				  |
	******************************************************************************************/
	public static function style()
	{
		$str = '';
		
		$arguments = func_get_args();
		$args      = $arguments;
		
		if( isset($arguments[0]) && is_array($arguments[0]) )
		{
			$arguments = $arguments[0];
		}
		
		foreach(array_unique($arguments) as $style)
		{
			if( is_array($style) ) 
			{
				$style = '';
			}	
		
			if( ! in_array("style_".$style, self::$is_import) )
			{
				if( isFileExists(STYLES_DIR.suffix($style,".css")) )
				{
					$str .= '<link href="'.baseUrl().STYLES_DIR.suffix($style,".css").'" rel="stylesheet" type="text/css" />'.eof();
				}
				self::$is_import[] = "style_".$style;
			}
		}
		
		if( ! empty($str) ) 
		{
			if( $args[count($args) - 1] === true )
			{
				return $str;
			}
			else
			{
				echo $str; 
			}
		}
		else
		{ 
			return false;
		}
		
	}	

	/******************************************************************************************
	* SCRIPT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Harici js dosyası yüklemek için kullanılır. Yüklenmek istenen stiller	  |
	| Views/Scripts/ dizinine atılır.										  				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @scripts => Parametre olarak sıralı js dosyalarını veya dizi içinde   |
	| eleman olarak kullanılan js dosyalarını dahil etmek için kullanılır.			     	  |
	|          																				  |
	| Örnek Kullanım: import::script('s1', 's2' ... 'sN');        						      |
	| Örnek Kullanım: import::script(script('s1', 's2' ... 'sN'));        				      |
	|          																				  |
	******************************************************************************************/
	public static function script()
	{
		$str = '';
		
		$arguments = func_get_args();
		$args      = $arguments;
		
		if( isset($arguments[0]) && is_array($arguments[0]) )
		{
			$arguments = $arguments[0];
		}
		
		foreach(array_unique($arguments) as $script)
		{
			if( is_array($script) ) 
			{
				$script = '';
			}
			
			if( ! in_array("script_".$script, self::$is_import) )
			{
				if( isFileExists(SCRIPTS_DIR.suffix($script,".js")) )
				{
					$str .= '<script type="text/javascript" src="'.baseUrl().SCRIPTS_DIR.suffix($script,".js").'"></script>'.eof();
				}
				
				if( $script === 'Jquery' || $script === 'JqueryUi' )
				{
					$str .= '<script type="text/javascript" src="'.baseUrl().REFERENCES_DIR.'Jquery/'.suffix($script,".js").'"></script>'.eof();
				}
				
				self::$is_import[] = "script_".$script;
			}
		}
		
		if( ! empty($str) ) 
		{
			if( $args[count($args) - 1] === true )
			{
				return $str;
			}
			else
			{
				echo $str; 
			}
		}
		else
		{ 
			return false;
		}
		
	}
	
	/******************************************************************************************
	* SOMETHING                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Herhangi bir dosya dahil etmek için kullanılır.						  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: import::something('Application/Views/Pages/OrnekSayfa.php');        	  |
	| Örnek Kullanım: import::something('Application/Views/Style/Stil.js');        	          |
	|          																				  |
	******************************************************************************************/
	public static function something($randomPageVariable = '', $randomDataVariable = '', $randomObGetContentsVariable = false)
	{
		if( ! is_string($randomPageVariable) ) 
		{
			return false;
		}

		if( extension($randomPageVariable) === 'js' )
		{
			if( ! isFileExists($randomPageVariable) ) 
			{
				return false;
			}
			echo '<script type="text/javascript" src="'.baseUrl().$randomPageVariable.'"></script>'.eof();
		}
		elseif( extension($randomPageVariable) === 'css' )	
		{
			if( ! isFileExists($randomPageVariable) ) 
			{
				return false;
			}
			echo '<link href="'.baseUrl().$randomPageVariable.'" rel="stylesheet" type="text/css" />'.eof();
		}
		else
		{
			$extension = ! extension($randomPageVariable)
						 ? '.php'
						 : '';
			
			$randomPageVariable .= $extension;
			
			if( is_array($randomDataVariable) )
			{
				extract($randomDataVariable, EXTR_OVERWRITE, 'zn');
			}
			
			if( $randomObGetContentsVariable === false )
			{
				if( ! isFileExists($randomPageVariable) ) 
				{
					return false;
				}
				
				require($randomPageVariable); 
			}
			
			if( $randomObGetContentsVariable === true )
			{
				if( ! isFileExists($randomPageVariable) ) 
				{
					return false;
				}
				
				ob_start(); 
				require($randomPageVariable); 
				$randomContentVariable = ob_get_contents(); 
				ob_end_clean();
				
				return $randomContentVariable; 
			}
		}
	}
	
	/******************************************************************************************
	* PACKAGE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bir dizin içindeki dosyaları aynı anda dahil etmek için kullanılır.	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @packages => Dahil edilecek dosyaların bulunduğu dizin.					  |
	|          																				  |
	| Örnek Kullanım: import::something('Application/Views/Pages/');        	              |
	|          																				  |
	******************************************************************************************/
	public static function package($packages = "", $different_extension = array() )
	{
		if( ! ( is_string($packages) || isDirExists($packages) || is_array($different_extension) ) ) 
		{
			return false;
		}
	
		if( folder::files($packages) ) 
		{
			foreach(folder::files($packages) as $val)
			{				
				if( extension($val) === "php" )
				{
					require_once (suffix($packages).$val);
				}
				elseif( extension($val) === "js" )
				{
					echo '<script type="text/javascript" src="'.baseUrl().suffix($packages).$val.'"></script>'.eof();
				}
				elseif( extension($val) === "css" )
				{
					echo '<link href="'.baseUrl().suffix($packages).$val.'" rel="stylesheet" type="text/css" />'.eof();
				}
				else
				{
					if( ! empty($different_extension) )
					{
						if( in_array(extension($val), $different_extension) )
						{
							require_once(suffix($packages).$val);	
						}
					}
				}
			}
		}
		else 
		{
			return false;
		}
	}
}