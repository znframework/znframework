<?php

/************************************************************/
/*                       CLASS IMPORT                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

class Import
{
	
	private static $is_import = array();
	
	/* IMPORT LIBRARY */
	
	/*
		Import kütüphanesi öncelikle import edeceği dosyayı uygulama içerisinde arar
		daha sonra sistemin içinde arar, eğer siz aynı isimle iki tane sınıf oluşturmuş iseniz
		bunlardan sizin oluşturduğunuz öncelikli olup onu çağıracaktır.
		
		bu sistem diğer import nesneleri içinde geçerlidir.
		
		NOT: bir nesne birkez import edildikten sonra bir daha aynı dosyayı aynı sayfada import edemezsiniz.
	*/
	
	public static function library()
	{
		$conLang = array_unique(config::get('Autoload','Library'));
		
		/* PLURAL LIBRARY */
	
		foreach(@array_unique(func_get_args()) as $class)
		{
			if(is_array($class)) $class = "";
			
			if( ! in_array($class,$conLang))
			{			
				$path = LIBRARIES_DIR.suffix($class,".php");
						
				if(is_file_exists($path) && ! class_exists($class))
					require_once($path);
				else if(is_file_exists(SYSTEM_DIR.$path) && ! class_exists($class))
					require_once(SYSTEM_DIR.$path);	
				else
				{
					$different_directory = config::get('Libraries', 'different_directory');
					
					if( ! empty($different_directory))foreach($different_directory as $dir)
					{
						$path = suffix($dir, '/').suffix($class,".php");	
						if(is_file($path) && ! class_exists($class))
							require_once($path);					
					}	
				}
				
				is_imported($class);
			}	
		}
	}
	
	
	/* IMPORT TOOL */
	public static function tool()
	{
		$conLang = array_unique(config::get('Autoload','Tool'));
		
		foreach(@array_unique(func_get_args()) as $tool)
		{
			if(is_array($tool)) $tool = "";
			if( ! in_array($tool,$conLang))
			{
				$path = TOOLS_DIR.suffix($tool,".php");
				
				if(is_file_exists($path) && !is_import($path)) require_once($path);
				
				else if(is_file_exists(SYSTEM_DIR.$path) && !is_import(SYSTEM_DIR.$path)) require_once(SYSTEM_DIR.$path);
				
			}
		}
	}
	
	/* IMPORT LANGUAGE */
	
	public static function language()
	{
		$conLang = array_unique(config::get('Autoload','Language'));
		
		global $lang;

		$current_lang = config::get('Language',get_lang());

		foreach(@array_unique(func_get_args()) as $language)
		{	
			if(is_array($language)) $language = "";
		
			$path = LANGUAGES_DIR.$current_lang.'/'.suffix($language,".php");
			
			if(is_file_exists($path) && ! is_import($path)) require_once($path);
		
			else if(is_file_exists(SYSTEM_DIR.$path)  && ! is_import(SYSTEM_DIR.$path)) require_once(SYSTEM_DIR.$path);	
				
		}
		require_once CORE_DIR.'Lang.php';
	
	}
	
	/* IMPORT MASTERPAGE */
	
	public static function masterpage($data = array(), $head = array())
	{	
		$masterpageset = config::get('Masterpage');
		
		$page = (isset($head['body_page'])) ? $head['body_page'] : $masterpageset['body_page'];
		
		$head_page = (isset($head['head_page'])) ? $head['head_page'] : $masterpageset['head_page'];
	
		if( ! is_file(PAGES_DIR.suffix($page,".php"))) 
			$page = ''; 
		else 
			$page = PAGES_DIR.suffix($page,".php");
			
		if( ! is_file(PAGES_DIR.suffix($head_page,".php"))) 
			$head_page = ''; 
		else 
			$head_page = PAGES_DIR.suffix($head_page,".php");
		
		$header  = config::get('Doctype', $masterpageset['doctype'])."\n";
		$header	.= '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
		$header .= '<head>'."\n";
		
		if(is_array ($masterpageset["content_charset"]))
		{
			foreach($masterpageset["content_charset"] as $v)
			{
				$header .= '<meta http-equiv="Content-Type" content="text/html; charset='.$v.'" />'."\n";	
			}
		}
		else
		{
			$header .= '<meta http-equiv="Content-Type" content="text/html; charset='.$masterpageset['content_charset'].'" />'."\n";	
		}
		$header .= '<meta http-equiv="Content-Language" content="'.config::get('Masterpage','content_language').'" />'."\n";
		
		$title = (isset($head['title'])) ? $head['title'] : $masterpageset['title'];
		$cache = (isset($head['cache'])) ? $head['cache'] : $masterpageset['cache'];
		$refresh = (isset($head['refresh'])) ? $head['refresh'] : $masterpageset['refresh'];
		$abstract = (isset($head['abstract'])) ? $head['abstract'] : $masterpageset['abstract'];
		$description = (isset($head['description'])) ? $head['description'] : $masterpageset['description'];
		$copyright = (isset($head['copyright'])) ? $head['copyright'] : $masterpageset['copyright'];
		$expires = (isset($head['expires'])) ? $head['expires'] : $masterpageset['expires'];
		$pragma = (isset($head['pragma'])) ? $head['pragma'] : $masterpageset['pragma'];		
		$keywords = (isset($head['keywords'])) ? $head['keywords'] : $masterpageset['keywords'];
		$author = (isset($head['author'])) ? $head['author'] : $masterpageset['author'];
		$designer = (isset($head['designer'])) ? $head['designer'] : $masterpageset['designer'];
		$distribution = (isset($head['distribution'])) ? $head['distribution'] : $masterpageset['distribution'];
		$revisit = (isset($head['revisit'])) ? $head['revisit'] : $masterpageset['revisit'];
		$robots = (isset($head['robots'])) ? $head['robots'] : $masterpageset['robots'];
		$datas = (isset($head['data'])) ? $head['data'] : $masterpageset['data'];
		$meta = (isset($head['meta'])) ? $head['meta'] : $masterpageset['meta'];
		$font_arr = (isset($head['font'])) ? $head['font'] : $masterpageset["font"];
		
		if($title) $header .= '<title>'.$title.'</title>'."\n";
		
		if($cache) $header .= '<meta http-equiv="cache-control" content="'.$cache.'" />'."\n";
		if($refresh) $header .= '<meta http-equiv="refresh" content="'.$refresh.'" />'."\n";		
		if($abstract) $header .= '<meta name="abstract" content="'.$abstract.'" />'."\n";
		if($description) $header .= '<meta name="description" content="'.$description.'" />'."\n";
		if($copyright) $header .= '<meta name="copyright" content="'.$copyright.'" />'."\n";
		if($expires) $header .= '<meta name="expires" content="'.$expires.'" />'."\n";
			
		if($robots && ! is_array($robots)) 
		{
			$header .= '<meta name="robots" content="'.$robots.'" />'."\n";
		}
		else
		{
			if(is_array($robots))foreach($robots as $rob)
			{
				$header .= '<meta name="robots" content="'.$rob.'" />'."\n";
			}
		}	
		
		if( ! empty($meta['name']) && is_array($meta['name']))foreach($meta['name'] as $k => $v)
		{
			$header .= '<meta name="'.$k.'" content="'.$v.'" />'."\n";
		}
		
		if( ! empty($meta['http']) && is_array($meta['http']))foreach($meta['http'] as $k => $v)
		{
			$header .= '<meta http-equiv="'.$k.'" content="'.$v.'" />'."\n";
		}
		
		
		if($pragma) $header .= '<meta name="pragma" content="'.$pragma.'" />'."\n";	
		if($keywords) $header    .= '<meta name="keywords" content="'.$keywords.'" />'."\n";	
		if($author) $header      .= '<meta name="author" content="'.$author.'" />'."\n";
		if($designer) $header      .= '<meta name="designer" content="'.$designer.'" />'."\n";
		if($distribution) $header      .= '<meta name="distribution" content="'.$distribution.'" />'."\n";
		if($revisit) $header .= '<meta name="revisit-after" content="'.$revisit.'" />'."\n";
			
		
		if( ! empty($font_arr) )
		{					
			if( ! is_array($font_arr)) 
				$fonts = array($font_arr); 
			else 
				$fonts = $font_arr;
			
			$str = "<style type='text/css'>\n";
			
			if(is_array($fonts))foreach($fonts as $font)
			{
				if(is_array($font)) $font = "";
				
				$f = divide($font, "/", -1);
	
				// SVG IE VE MOZILLA DESTEKLEMIYOR
				if(is_file_exists(FONTS_DIR.$font.".svg"))
				{				
					$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".svg").'") format("truetype")}'."\n";					
				}
				if(is_file_exists(FONTS_DIR.$font.".woff"))
				{
					
					$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".woff").'") format("truetype")}'."\n";
			
				}
				// OTF IE VE CHROME DESTEKLEMIYOR
				if(is_file_exists(FONTS_DIR.$font.".otf"))
				{
					$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".otf").'") format("truetype")}'."\n";
					
				}
				
				// TTF IE DESTEKLEMIYOR
				if(is_file_exists(FONTS_DIR.$font.".ttf"))
				{
				
					$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".ttf").'") format("truetype")}'."\n";
					
				}
				
				// FARKLI FONT UZANTILARI
				if( ! empty($masterpageset['different_font_extensions']))
				{
					$other_fonts = $masterpageset['different_font_extensions'];
					
					if(is_array($other_fonts))foreach($other_fonts as $of)
					{
						if(is_file_exists(FONTS_DIR.$font.prefix($of, '.')))
						{		
							$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.prefix($of, '.')).'") format("truetype")}'."\n";;			
						}
					}	
				}
							
				// EOT IE DESTEKLIYOR
				if(is_file_exists(FONTS_DIR.$font.".eot"))
				{
					$str .= '<!--[if IE]>';
					$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".eot").'") format("truetype")}';
					$str .= '<![endif]-->';
					$str .= "\n";
				}		
			}	
			
			$str .= '</style>'."\n"; 
			$header .= $str;
		}
		
		if(is_array($masterpageset['script']))foreach(array_unique($masterpageset['script']) as $row)
		{	
			if(isset($row) && is_file_exists(SCRIPTS_DIR.suffix($row,".js"))) 
			{
				$header .= '<script type="text/javascript" src="'.base_url().SCRIPTS_DIR.suffix($row,".js").'"></script>'."\n";
			}
		}
			
		if(isset($head['script']) && ! is_array($head['script']) && is_file_exists(SCRIPTS_DIR.suffix($head['script'],".js"))) 
			$header .= '<script type="text/javascript" src="'.base_url().SCRIPTS_DIR.suffix($head['script'],".js").'"></script>'."\n";
		
		
		if(isset($head['script']) && is_array($head['script']))foreach(@array_unique($head['script']) as $row)
		{
			if(file_exists(SCRIPTS_DIR.suffix($row,".js")))
			{
				$header .= '<script type="text/javascript" src="'.base_url().SCRIPTS_DIR.suffix($row,".js").'"></script>'."\n";
			}		
		}	
		
		if(is_array($masterpageset['style']))foreach(@array_unique($masterpageset['style']) as $row)
		{
			if(file_exists(STYLES_DIR.suffix($row,".css")))
			{
				$header .= '<link href="'.base_url().STYLES_DIR.suffix($row,".css").'" rel="stylesheet" type="text/css" />'."\n";
			}
		}
		
		if(isset($head['style']) && ! is_array($head['style']) && is_file_exists(STYLES_DIR.suffix($head['style'],".css"))) 
			$header .= '<link href="'.base_url().STYLES_DIR.suffix($head['style'],".css").'" rel="stylesheet" type="text/css" />'."\n";
		

		if(isset($head['style']) && is_array($head['style']))foreach(@array_unique($head['style']) as $row)
		{
			if(file_exists(STYLES_DIR.suffix($row,".css")))
			{
				$header .= '<link href="'.base_url().STYLES_DIR.suffix($row,".css").'" rel="stylesheet" type="text/css" />'."\n";
			}			
		}
		
		if($masterpageset['logo']) $header .= '<link rel="shortcut icon" href="'.base_url($masterpageset['logo']).'" />'."\n";
		
		if(isset($head['page_image'])) $header      .= '<link rel="image_src" href="'.$head['page_image'].'" />'."\n";	
		
		if($datas && ! is_array($head['data'])){ $header .= $datas."\n"; }
		else
		{
			if(is_array($datas))foreach($datas as $v)
			{
				$header .= $v."\n";	
			}	
		}
		
		if( ! empty($head_page))
		{
			ob_start(); 
			require_once($head_page); 
			$content = ob_get_contents(); 
			ob_end_clean(); 
			$header .= $content."\n" ; 	
		}
	
		
		$header .= '</head>'."\n";
		if($masterpageset["bg_image"]) $bg_image = " background='".base_url($masterpageset["bg_image"])."' bgproperties='fixed'"; else $bg_image = "";
		$header .= '<body'.$bg_image.'>'."\n";
	
		echo $header;
		
		if(is_array($data)) extract($data, EXTR_OVERWRITE, 'extract');
		
		if( ! empty($page)) require($page);	
		
		
		$footer  = "\n".'</body>'."\n";
		$footer .= '</html>';
		
		echo $footer;
		
	}
	
	
	public static function font()
	{
		
		$str = "<style type='text/css'>";
		$params = @array_unique(func_get_args());
		foreach($params as $font)
		{	
			if(is_array($font)) $font = "";
			
			$f = divide($font, "/", -1);
			// SVG IE VE MOZILLA DESTEKLEMIYOR
			if(is_file_exists(FONTS_DIR.$font.".svg"))
			{			
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".svg").'") format("truetype")}'."\n";;				
			}
			if(is_file_exists(FONTS_DIR.$font.".woff"))
			{			
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".woff").'") format("truetype")}'."\n";;		
			}
			// OTF IE VE CHROME DESTEKLEMIYOR
			if(is_file_exists(FONTS_DIR.$font.".otf"))
			{
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".otf").'") format("truetype")}'."\n";;			
			}
			
			// TTF IE DESTEKLEMIYOR
			if(is_file_exists(FONTS_DIR.$font.".ttf"))
			{		
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".ttf").'") format("truetype")}'."\n";;			
			}
			
			// FARKLI FONTLAR
			$differentset = config::get('Masterpage');
			
			if( ! empty($differentset['different_font_extensions']))
			{
				$other_fonts = $differentset['different_font_extensions'];
				
				foreach($other_fonts as $of)
				{
					if(is_file_exists(FONTS_DIR.$font.prefix($of, '.')))
					{		
						$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.prefix($of, '.')).'") format("truetype")}'."\n";;			
					}
				}	
			}
			
			// EOT IE DESTEKLIYOR
			if(is_file_exists(FONTS_DIR.$font.".eot"))
			{
				$str .= '<!--[if IE]>';
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.base_url(FONTS_DIR.$font.".eot").'") format("truetype")}';
				$str .= '<![endif]-->';
				$str .= "\n";
			}		
		}
		
		$str .= '</style>'."\n";
		if($str) 
		{
			if($params[count($params) - 1] === true)
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
	
	
	public static function style()
	{
		$conLang = array_unique(config::get('Masterpage','style'));
		$params = @array_unique(func_get_args());
		$str = '';
		foreach($params as $style)
		{
			if(is_array($style)) $style = "";
			
			if(!in_array($style, $conLang) && !in_array("style_".$style, self::$is_import))
			{
				if(is_file_exists(STYLES_DIR.suffix($style,".css")))
				{
					$str .= '<link href="'.base_url().STYLES_DIR.suffix($style,".css").'" rel="stylesheet" type="text/css" />'."\n";
				}
				self::$is_import[] = "style_".$style;
			}
		}
		
		if($str) 
		{
			if($params[count($params) - 1] === true)
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
	
	
	public static function script()
	{
		$conLang = array_unique(config::get('Masterpage','script'));
		$params = @array_unique(func_get_args());
		$str = '';
		foreach($params as $script)
		{
			if(is_array($script)) $script = "";
			
			if(!in_array($script, $conLang) && !in_array("script_".$script, self::$is_import))
			{
				if(is_file_exists(SCRIPTS_DIR.suffix($script,".js")))
				{
					$str .= '<script type="text/javascript" src="'.base_url().SCRIPTS_DIR.suffix($script,".js").'"></script>'."\n";
				}
				self::$is_import[] = "script_".$script;
			}
		}
		if($str) 
		{
			if($params[count($params) - 1] === true)
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
	
	
	public static function something($page = '', $data = '', $ob_get_contents = false)
	{
		if( ! is_string($page)) return false;
		
		if(is_array($data))extract($data, EXTR_OVERWRITE, 'extract');
		
		$other = 0;
		
		switch(extension($page))
		{
			case 'js':
				if( ! is_file_exists($page)) return false;
				echo '<script type="text/javascript" src="'.base_url().$page.'"></script>'."\n";
			break;	
			
			case 'css':
				if( ! is_file_exists($page)) return false;
				echo '<link href="'.base_url().$page.'" rel="stylesheet" type="text/css" />'."\n";
			break;
			
			default;
				$other = 1;
		}
		if($other)
		{
			if($ob_get_contents === false)
			{
				if( ! is_file_exists(suffix($page,".php"))) return false;
				
				require(suffix($page,".php")); 
			}
			
			if($ob_get_contents === true)
			{
				if( ! is_file_exists(suffix($page,".php"))) return false;
				
				ob_start(); 
				require(suffix($page,".php")); 
				$content = ob_get_contents(); 
				ob_end_clean();
				return $content ; 
			}
		}
	}
	
	
	public static function package($packages = "")
	{
		if( ! is_string($packages)) return false;
		
		if( ! is_dir_exists($packages)) return false;
		
		import::library("Folder");	
		
		if( folder::files($packages) ) 
		{
			foreach(folder::files($packages) as $val)
			{		
				
				if(extension($val) === "php")
				{
					require_once (suffix($packages).$val);
				}
				if(extension($val) === "htm")
				{
					require_once (suffix($packages).$val);
				}
				if(extension($val) === "html")
				{
					require_once (suffix($packages).$val);
				}
				if(extension($val) === "js")
				{
					echo '<script type="text/javascript" src="'.base_url().suffix($packages).$val.'"></script>'."\n";
				}
				if(extension($val) === "css")
				{
					echo '<link href="'.base_url().suffix($packages).$val.'" rel="stylesheet" type="text/css" />'."\n";
				}
			}
		}
		else return false;
		
	}
	
	
	public static function page($page = '', $data = '', $ob_get_contents = false)
	{
		if( ! is_string($page)) return false;
		
		if(is_array($data))extract($data, EXTR_OVERWRITE, 'extract');
	
		if($ob_get_contents === false)
		{
			if( ! is_file_exists(PAGES_DIR.suffix($page,".php"))) return false;
			require(PAGES_DIR.suffix($page,".php")); 
		}
		
		if($ob_get_contents === true)
		{
			if( ! is_file_exists(PAGES_DIR.suffix($page,".php"))) return false;
			ob_start(); 
			require(PAGES_DIR.suffix($page,".php")); 
			$content = ob_get_contents(); 
			ob_end_clean(); 
			return $content ; 
		}
	
	}
	
	
	public static function coder()
	{
		
		$conLang = array_unique(config::get('Autoload','Coder'));
		
		foreach(@array_unique(func_get_args()) as $class)
		{
			if(is_array($class)) $class = "";
			
			if(!in_array($class,$conLang))
			{
				$path = CODER_DIR.suffix($class,".php");
			
				if(is_file_exists($path) && !class_exists($class)) require_once($path);
				
	
			}
		}
	
	}

}