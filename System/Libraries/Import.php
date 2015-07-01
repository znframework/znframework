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
| Sınıfı Kullanırken      :	Import::, $this->import, zn::$use->import, uselib('import')   |
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
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
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
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
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
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public static function bladepage($page = '', $data = '', $ob_get_contents = false)
	{
		return uselib('CBlade')->view($page, $data, $ob_get_contents);
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
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public static function parserpage($page = '', $data = '', $ob_get_contents = false)
	{
		return uselib('CParser')->view($page, $data, $ob_get_contents);
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
	| Örnek Kullanım: Import::masterpage();        						  					  |
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
		$masterpageset = Config::get('Masterpage');
		
		//------------------------------------------------------------------------------------
		// Başlık ve vücud sayfaları alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		$randomPageVariable = ( isset($head['bodyPage']) ) 
					          ? $head['bodyPage'] 
						      : $masterpageset['bodyPage'];
		
		$head_page = 	( isset($head['headPage']) ) 
					    ? $head['headPage'] 
						: $masterpageset['headPage'];
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
		
		$header  = Config::get('Doctype', $masterpageset['docType']).eol();
		$header	.= '<html xmlns="http://www.w3.org/1999/xhtml">'.eol();
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HEAD START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		$header .= '<head>'.eol();
		
		if( is_array($masterpageset['contentCharset']) )
		{
			foreach($masterpageset['contentCharset'] as $v)
			{
				$header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$v\">".eol();	
			}
		}
		else
		{
			$header .= '<meta http-equiv="Content-Type" content="text/html; charset='.$masterpageset['contentCharset'].'">'.eol();	
		}
		
		$header .= '<meta http-equiv="Content-Language" content="'.$masterpageset['contentLanguage'].'">'.eol();
			
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
			$header .= '<title>'.$title.'</title>'.eol();	
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
					$header .= "<meta $httporname=\"$name\" content=\"$content\">".eol();
				}
				else
				{
					foreach($content as $key => $val)
					{
						$header .= "<meta $httporname=\"$name\" content=\"$val\">".eol();	
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
		
		if( ! empty($masterpageset['browserIcon']) ) 
		{
			$header .= '<link rel="shortcut icon" href="'.baseUrl($masterpageset['browserIcon']).'" />'.eol();
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
				$header .= $datas.eol(); 
			}
			else
			{
				foreach($datas as $v)
				{
					$header .= $v.eol();	
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
			
			$header .= $content.eol() ; 	
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		$header .= '</head>'.eol();
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HEAD END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>BODY START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		//------------------------------------------------------------------------------------
		// Arkaplan resmi dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		if( $masterpageset['backgroundImage'] ) 
		{
			$bg_image = " background='".baseUrl($masterpageset['backgroundImage'])."' bgproperties='fixed'"; 
		}
		else 
		{
			$bg_image = "";
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		$header .= '<body'.$bg_image.'>'.eol();
	
		echo $header;
		
		if( is_array($randomDataVariable) ) 
		{
			extract($randomDataVariable, EXTR_OVERWRITE, 'zn');
		}
		
		if( ! empty($randomPageVariable) ) 
		{
			require($randomPageVariable);	
		}
		
		$randomFooterVariable  = eol().'</body>'.eol();
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
	| Örnek Kullanım: Import::font('f1', 'f2' ... 'fN');        						      |
	| Örnek Kullanım: Import::font(array('f1', 'f2' ... 'fN'));        				          |
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
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".svg").'") format("truetype")}'.eol();				
			}
			if( isFileExists(FONTS_DIR.$font.".woff") )
			{			
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".woff").'") format("truetype")}'.eol();		
			}
			// OTF IE VE CHROME DESTEKLEMIYOR
			if( isFileExists(FONTS_DIR.$font.".otf") )
			{
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".otf").'") format("truetype")}'.eol();			
			}
			
			// TTF IE DESTEKLEMIYOR
			if( isFileExists(FONTS_DIR.$font.".ttf") )
			{		
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".ttf").'") format("truetype")}'.eol();			
			}
			
			// FARKLI FONTLAR
			$differentset = Config::get('Font', 'differentFontExtensions');
			
			if( ! empty($differentset) )
			{			
				foreach($differentset as $of)
				{
					if( isFileExists(FONTS_DIR.$font.prefix($of, '.')) )
					{		
						$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.prefix($of, '.')).'") format("truetype")}'.eol();			
					}
				}	
			}
			
			// EOT IE DESTEKLIYOR
			if( isFileExists(FONTS_DIR.$font.".eot") )
			{
				$str .= '<!--[if IE]>';
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.baseUrl(FONTS_DIR.$font.".eot").'") format("truetype")}';
				$str .= '<![endif]-->';
				$str .= eol();
			}		
		}
		
		$str .= '</style>'.eol();
		
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
	| Örnek Kullanım: Import::style('s1', 's2' ... 'sN');        						      |
	| Örnek Kullanım: Import::style(array('s1', 's2' ... 'sN'));        				      |
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
					$str .= '<link href="'.baseUrl().STYLES_DIR.suffix($style,".css").'" rel="stylesheet" type="text/css" />'.eol();
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
	| Örnek Kullanım: Import::script('s1', 's2' ... 'sN');        						      |
	| Örnek Kullanım: Import::script(script('s1', 's2' ... 'sN'));        				      |
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
					$str .= '<script type="text/javascript" src="'.baseUrl().SCRIPTS_DIR.suffix($script,".js").'"></script>'.eol();
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
	| Örnek Kullanım: Import::something('Application/Views/Pages/OrnekSayfa.php');        	  |
	| Örnek Kullanım: Import::something('Application/Views/Style/Stil.js');        	          |
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
			
			$return = '<script type="text/javascript" src="'.baseUrl().$randomPageVariable.'"></script>'.eol();
			
			if($randomObGetContentsVariable === false)
			{
				echo $return;
			}
			else
			{
				return $return;	
			}
		}
		elseif( extension($randomPageVariable) === 'css' )	
		{
			if( ! isFileExists($randomPageVariable) ) 
			{
				return false;
			}
			
			$return = '<link href="'.baseUrl().$randomPageVariable.'" rel="stylesheet" type="text/css" />'.eol();
			
			if($randomObGetContentsVariable === false)
			{
				echo $return;
			}
			else
			{
				return $return;	
			}
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
	| Örnek Kullanım: Import::something('Application/Views/Pages/');        	              |
	|          																				  |
	******************************************************************************************/
	public static function package($packages = "", $different_extension = array() )
	{
		if( ! ( is_string($packages) || isDirExists($packages) || is_array($different_extension) ) ) 
		{
			return false;
		}
	
		if( Folder::files($packages) ) 
		{
			foreach(Folder::files($packages) as $val)
			{				
				if( extension($val) === "php" )
				{
					require_once (suffix($packages).$val);
				}
				elseif( extension($val) === "js" )
				{
					echo '<script type="text/javascript" src="'.baseUrl().suffix($packages).$val.'"></script>'.eol();
				}
				elseif( extension($val) === "css" )
				{
					echo '<link href="'.baseUrl().suffix($packages).$val.'" rel="stylesheet" type="text/css" />'.eol();
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