<?php
class Import
{
	/***********************************************************************************/
	/* IMPORT LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Import
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: import::, $this->import, zn::$use->import, uselib('import')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Is Import Değişkeni
	 *  
	 * Bir sınıfın daha önce dahil edilip edilmediği
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	private static $isImport = array();
	
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
	public static function page($randomPageVariable = '', $randomDataVariable = '', $randomObGetContentsVariable = false , $randomPageDir = PAGES_DIR)
	{
		if( ! is_string($randomPageVariable) )
		{
			return Error::set(lang('Error', 'stringParameter', 'randomPageVariable'));
		}
		
		if( ! extension($randomPageVariable) )
		{
			$randomPageVariable = suffix($randomPageVariable, '.php');
		}
		
		$randomPagePath = $randomPageDir.$randomPageVariable;
		
		if( isFileExists($randomPagePath) ) 
		{
			if( is_array($randomDataVariable) )
			{
				extract($randomDataVariable, EXTR_OVERWRITE, 'zn');
			}
		
			if( $randomObGetContentsVariable === false )
			{	
				require($randomPagePath); 
			}
			else
			{
				ob_start(); 
				require($randomPagePath); 
				$randomContentVariable = ob_get_contents(); 
				ob_end_clean(); 
				
				return $randomContentVariable ; 
			}
		}
		else
		{
			return Error::set(lang('Error', 'fileNotFound', $randomPageVariable));	
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
	public static function view($page = '', $data = '', $obGetContents = false)
	{
		return self::page($page, $data, $obGetContents);
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
	public static function bladePage($page = '', $data = '', $obGetContents = false)
	{
		return uselib('CBlade')->view($page, $data, $obGetContents);
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
	public static function parserPage($page = '', $data = '', $obGetContents = false)
	{
		return uselib('CParser')->view($page, $data, $obGetContents);
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
	public static function template($page = '', $data = '', $obGetContents = false)
	{
		if( $return = self::page($page, $data, $obGetContents, SYSTEM_TEMPLATES_DIR) ) 
		{
			return $return;
		}
		elseif( $return = self::page($page, $data, $obGetContents, TEMPLATES_DIR) ) 
		{
			return $return;
		}
		else
		{
			return Error::set(lang('Error', 'fileNotFound', $page));	
		}
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
	public static function masterPage($randomDataVariable = array(), $head = array())
	{	
		//------------------------------------------------------------------------------------
		// Config/Masterpage.php dosyasından ayarlar alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		$masterPageSet = Config::get('Masterpage');
		
		//------------------------------------------------------------------------------------
		// Başlık ve vücud sayfaları alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------
		$randomPageVariable = ( isset($head['bodyPage']) ) 
					          ? $head['bodyPage'] 
						      : $masterPageSet['bodyPage'];
		
		$headPage = 	( isset($head['headPage']) ) 
					    ? $head['headPage'] 
						: $masterPageSet['headPage'];
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
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HTML START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		$header  = Config::get('Doctype', $masterPageSet['docType']).eol();
		$header	.= '<html xmlns="http://www.w3.org/1999/xhtml">'.eol();
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HEAD START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		$header .= '<head>'.eol();
		
		if( is_array($masterPageSet['contentCharset']) )
		{
			foreach($masterPageSet['contentCharset'] as $v)
			{
				$header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$v\">".eol();	
			}
		}
		else
		{
			$header .= '<meta http-equiv="Content-Type" content="text/html; charset='.$masterPageSet['contentCharset'].'">'.eol();	
		}
		
		$header .= '<meta http-equiv="Content-Language" content="'.$masterPageSet['contentLanguage'].'">'.eol();
			
		//------------------------------------------------------------------------------------
		// Data ve Meta verileri alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//------------------------------------------------------------------------------------					
		$datas 		= $masterPageSet['data'];
						
		$metas 		= $masterPageSet['meta'];
						
		$title 		= ( isset($head['title']) ) 			
					  ? $head['title'] 		
					  : $masterPageSet["title"];
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
				$nameEx = explode("->", $name);
				
				$httpOrName = ( $nameEx[0] === 'http' )
							  ? 'http-equiv'
							  : 'name';
				
				$name 		= ( isset($nameEx[1]) )
							  ? $nameEx[1]
							  : $nameEx[0];
							  
				if( ! is_array($content) )
				{			  
					$header .= "<meta $httpOrName=\"$name\" content=\"$content\">".eol();
				}
				else
				{
					foreach($content as $key => $val)
					{
						$header .= "<meta $httpOrName=\"$name\" content=\"$val\">".eol();	
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
		if( ! empty($masterPageSet["font"]) )
		{					
			$header .= self::font($masterPageSet["font"], true);
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
		if( is_array($masterPageSet['script']) )
		{
			$header .= self::script($masterPageSet['script'], true);
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
		if( is_array($masterPageSet['style']) )
		{
			$header .= self::style($masterPageSet['style'], true);
		}
		
		if( isset($head['style']) )
		{
			$header .= self::style($head['style'], true);
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		if( ! empty($masterPageSet['browserIcon']) ) 
		{
			$header .= '<link rel="shortcut icon" href="'.baseUrl($masterPageSet['browserIcon']).'" />'.eol();
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
		if( ! empty($headPage) )
		{
			ob_start();
			
			// Tek bir üst sayfa kullanımı için.
			if( ! is_array($headPage) )
			{
				if( is_file(PAGES_DIR.suffix($headPage,".php")) ) 
				{
					if( ! extension($headPage) )
					{
						$headPage = $headPage.'.php';
					}
					
					require_once(PAGES_DIR.$headPage); 
				}
			}
			else
			{
				// Birden fazla üst sayfa kullanımı için.
				foreach( $headPage as $hpage )
				{
					if( is_file(PAGES_DIR.suffix($hpage,".php")) ) 
					{
						if( ! extension($hpage) )
						{
							$hpage = $hpage.'.php';
						}
						
						require_once(PAGES_DIR.$hpage);
					}
				}
			}
			
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
		if( $masterPageSet['backgroundImage'] ) 
		{
			$bgImage = " background='".baseUrl($masterPageSet['backgroundImage'])."' bgproperties='fixed'"; 
		}
		else 
		{
			$bgImage = "";
		}
		//------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//------------------------------------------------------------------------------------
		
		$header .= '<body'.$bgImage.'>'.eol();
	
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
			$differentSet = Config::get('Font', 'differentFontExtensions');
			
			if( ! empty($differentSet) )
			{			
				foreach($differentSet as $of)
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
			return Error::set(lang('Error', 'emptyVariable', '@str'));
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
		
		$links = array_change_key_case(Config::get('Links', 'style'));
		
		foreach(array_unique($arguments) as $style)
		{
			if( is_array($style) ) 
			{
				$style = '';
			}	
		
			if( ! in_array("style_".$style, self::$isImport) )
			{					
				if( isFileExists(STYLES_DIR.suffix($style,".css")) )
				{
					$str .= '<link href="'.baseUrl().STYLES_DIR.suffix($style,".css").'" rel="stylesheet" type="text/css" />'.eol();
				}
				elseif( isUrl($style) && extension($style) === 'css' )
				{
					$str .= '<link href="'.$style.'" rel="stylesheet" type="text/css" />'.eol();
				}
				elseif( isset($links[strtolower($style)]) )
				{
					$str .= '<link href="'.$links[strtolower($style)].'" rel="stylesheet" type="text/css" />'.eol();	
				}
				
				self::$isImport[] = "style_".$style;
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
			return Error::set(lang('Error', 'emptyVariable', '@str'));
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
		
		$links = array_change_key_case(Config::get('Links', 'script'));
		
		foreach(array_unique($arguments) as $script)
		{
			if( is_array($script) ) 
			{
				$script = '';
			}
			
			if( ! in_array("script_".$script, self::$isImport) )
			{
				if( isFileExists(SCRIPTS_DIR.suffix($script,".js")) )
				{
					$str .= '<script type="text/javascript" src="'.baseUrl().SCRIPTS_DIR.suffix($script,".js").'"></script>'.eol();
				}
				elseif( isUrl($script) && extension($script) === 'js' )
				{
					$str .= '<script type="text/javascript" src="'.$script.'"></script>'.eol();
				}
				elseif( isset($links[strtolower($script)]) )
				{
					$str .= '<script type="text/javascript" src="'.$links[strtolower($script)].'"></script>'.eol();	
				}
				
				self::$isImport[] = "script_".$script;
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
			return Error::set(lang('Error', 'emptyVariable', '@str'));
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
			return Error::set(lang('Error', 'stringParameter', 'randomPageVariable'));
		}

		if( extension($randomPageVariable) === 'js' )
		{
			if( ! isFileExists($randomPageVariable) ) 
			{
				return Error::set(lang('Error', 'fileParameter', 'randomPageVariable'));
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
				return Error::set(lang('Error', 'fileParameter', 'randomPageVariable'));
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
					return Error::set(lang('Error', 'fileParameter', 'randomPageVariable'));
				}
				
				require($randomPageVariable); 
			}
			
			if( $randomObGetContentsVariable === true )
			{
				if( ! isFileExists($randomPageVariable) ) 
				{
					return Error::set(lang('Error', 'fileParameter', 'randomPageVariable'));
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
	public static function package($packages = "", $differentExtension = array() )
	{
		if( ! is_string($packages) || ! isDirExists($packages) || ! is_array($differentExtension) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'packages'));
			Error::set(lang('Error', 'dirParameter', 'packages'));
			Error::set(lang('Error', 'arrayParameter', 'differentExtension'));
			
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
					if( ! empty($differentExtension) )
					{
						if( in_array(extension($val), $differentExtension) )
						{
							require_once(suffix($packages).$val);	
						}
					}
				}
			}
		}
		else 
		{
			return Error::set(lang('Error', 'emptyParameter', '@packages'));
		}
	}
}