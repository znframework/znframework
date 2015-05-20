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
		$config_library = array_unique(config::get('Autoload','library'));
		
		$arguments = func_get_args();
		
		if(isset($arguments[0]) && is_array($arguments[0]))
		{
			$arguments = $arguments[0];
		}
		
		if( ! empty($arguments))foreach(array_unique($arguments) as $class)
		{
			if(is_array($class)) $class = '';
			
			if( ! in_array($class, $config_library))
			{	
				$class_path = suffix($class,".php"); 
				$path = LIBRARIES_DIR.$class_path;		
						
				if(is_file_exists($path) && ! class_exists($class))
				{	
					require_once($path);	
				}
				else if(is_file_exists(SYSTEM_LIBRARIES_DIR.$class_path) && ! class_exists($class))
				{	
					require_once(SYSTEM_LIBRARIES_DIR.$class_path);	
				}
				else
				{
					$different_directory = config::get('Libraries', 'different_directory');
					
					if( ! empty($different_directory))foreach($different_directory as $dir)
					{
						$path = suffix($dir, '/').suffix($class,".php");	
						if(is_file($path) && ! class_exists($class))
						{
							require_once($path);					
						}
					}	
				}
				is_imported($class);
			}	
		}	
	}
	
	
	public static function component()
	{
		$config_component = array_unique(config::get('Autoload','component'));
		
		$arguments = func_get_args();
		
		if(isset($arguments[0]) && is_array($arguments[0]))
		{
			$arguments = $arguments[0];
		}
		
		if( ! empty($arguments))foreach(array_unique($arguments) as $class)
		{
			if( is_array($class) ) $class = '';
			
			if( ! in_array($class, $config_component))
			{		
				if( ! strstr($class, '/'))
				{
					 $class = $class.'/'.$class;
				}
					
				$path = SYSTEM_COMPONENTS_DIR.suffix($class,".php");
						
				if(is_file_exists($path) && ! class_exists($class))
				{
					require_once($path);	
				}
				else
				{
					return false;
				}
				is_imported($class, 'Component');
			}	
		}	
	}
	
	
	/* IMPORT TOOL */
	public static function tool()
	{
		$config_tool = array_unique(config::get('Autoload','tool'));
		
		$arguments = func_get_args();
		
		if(isset($arguments[0]) && is_array($arguments[0]))
		{
			$arguments = $arguments[0];
		}
		
		if( ! empty($arguments))foreach(array_unique($arguments) as $tool)
		{
			if(is_array($tool)) $tool = '';
			
			if( ! in_array($tool, $config_tool))
			{
				$tool_path = suffix($tool,".php");
				$path = TOOLS_DIR.$tool_path;
				if(is_file_exists($path ) && ! is_import($path)) 
				{
					require_once($path);				
				}
				elseif(is_file_exists(SYSTEM_TOOLS_DIR.$tool_path) && ! is_import(SYSTEM_TOOLS_DIR.$tool_path)) 
				{			
					require_once(SYSTEM_TOOLS_DIR.$tool_path);				
				}
				else
				{
					return false;
				}
			}
		}
	}
	
	/* IMPORT LANGUAGE */
	
	public static function language()
	{
		$config_language = array_unique(config::get('Autoload','language'));
		
		global $lang;

		$current_lang = config::get('Language',get_lang());

		$arguments = func_get_args();
		
		if( isset($arguments[0]) && is_array($arguments[0]) )
		{
			$arguments = $arguments[0];
		}
		
		if( ! empty($arguments))foreach(array_unique($arguments) as $language)
		{	
			if( is_array($language) ) $language = '';
		
			if( ! in_array($language, $config_language) )
			{
				$lang_path = $current_lang.'/'.suffix($language,".php");
				
				$path = LANGUAGES_DIR.$lang_path;
							
				if( is_file_exists($path) && ! is_import($path) ) 
				{
					require_once($path);	
				}
				else if(is_file_exists(SYSTEM_LANGUAGES_DIR.$lang_path)  && ! is_import(SYSTEM_LANGUAGES_DIR.$lang_path))
				{
					require_once(SYSTEM_LANGUAGES_DIR.$lang_path);	
				}
			}		
		}
		require_once CORE_DIR.'Lang.php';
	
	}
	
	/* IMPORT MASTERPAGE */
	
	public static function masterpage($data = array(), $head = array())
	{	
		$masterpageset = config::get('Masterpage');
		
		$page = 		( isset($head['body_page']) ) 
					    ? $head['body_page'] 
						: $masterpageset['body_page'];
		
		$head_page = 	( isset($head['head_page']) ) 
					    ? $head['head_page'] 
						: $masterpageset['head_page'];
	
		if( ! is_file(PAGES_DIR.suffix($page,".php")) )
		{ 
			$page = ''; 
		}
		else
		{ 
			$page = PAGES_DIR.suffix($page,".php");
		}
		
		if( ! is_file(PAGES_DIR.suffix($head_page,".php")) ) 
		{
			$head_page = ''; 
		}
		else
		{ 
			$head_page = PAGES_DIR.suffix($head_page,".php");
		}
		
		$header  = config::get('Doctype', $masterpageset['doctype'])."\n";
		$header	.= '<html xmlns="http://www.w3.org/1999/xhtml">'."\n";
		$header .= '<head>'."\n";
		
		if( is_array($masterpageset["content_charset"]) )
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
		
		$title = 		( isset($head['title']) ) 		
						? $head['title'] 		
						: $masterpageset['title'];
						
		$cache = 		( isset($head['cache']) ) 		
		 				? $head['cache'] 		
						: $masterpageset['cache'];
						
		$refresh = 		( isset($head['refresh']) ) 		
						? $head['refresh'] 		
						: $masterpageset['refresh'];
						
		$abstract = 	( isset($head['abstract']) ) 		
						? $head['abstract'] 	
						: $masterpageset['abstract'];
						
		$description = 	( isset($head['description']) ) 	
						? $head['description'] 	
						: $masterpageset['description'];
						
		$copyright = 	( isset($head['copyright']) ) 	
						? $head['copyright'] 	
						: $masterpageset['copyright'];
						
		$expires = 		( isset($head['expires']) ) 		
						? $head['expires'] 		
						: $masterpageset['expires'];
						
		$pragma = 		( isset($head['pragma']) ) 		
						? $head['pragma'] 		
						: $masterpageset['pragma'];
								
		$keywords = 	( isset($head['keywords']) ) 		
						? $head['keywords'] 	
						: $masterpageset['keywords'];
						
		$author = 		( isset($head['author']) ) 		
						? $head['author'] 		
						: $masterpageset['author'];
						
		$designer = 	( isset($head['designer']) ) 		
						? $head['designer'] 	
						: $masterpageset['designer'];
						
		$distribution = ( isset($head['distribution']) ) 	
						? $head['distribution'] 
						: $masterpageset['distribution'];
						
		$revisit = 		( isset($head['revisit']) ) 		
						? $head['revisit'] 		
						: $masterpageset['revisit'];
						
		$robots = 		( isset($head['robots']) ) 		
						? $head['robots'] 		
						: $masterpageset['robots'];
						
		$datas = 		( isset($head['data']) ) 			
						? $head['data'] 		
						: $masterpageset['data'];
						
		$meta = 		( isset($head['meta']) ) 			
						? $head['meta'] 		
						: $masterpageset['meta'];
						
		$font_arr = 	( isset($head['font']) ) 			
						? $head['font'] 		
						: $masterpageset["font"];
		
		if( ! empty($title) ) 			
		{
			$header .= '<title>'.$title.'</title>'."\n";	
		}
		
		if( ! empty($cache) ) 			
		{
			$header .= '<meta http-equiv="cache-control" content="'.$cache.'" />'."\n";
		}
		
		if( ! empty($refresh) ) 		
		{
			$header .= '<meta http-equiv="refresh" content="'.$refresh.'" />'."\n";		
		}
		
		if( ! empty($abstract) ) 		
		{
			$header .= '<meta name="abstract" content="'.$abstract.'" />'."\n";
		}
		
		if( ! empty($description) ) 	
		{
			$header .= '<meta name="description" content="'.$description.'" />'."\n";
		}
		
		if( ! empty($copyright) ) 		
		{
			$header .= '<meta name="copyright" content="'.$copyright.'" />'."\n";
		}
		
		if( ! empty($expires) ) 		
		{
			$header .= '<meta name="expires" content="'.$expires.'" />'."\n";
		}
		
		if( ! empty($robots) && ! is_array($robots)) 
		{
			$header .= '<meta name="robots" content="'.$robots.'" />'."\n";
		}
		else
		{
			if( is_array($robots) )foreach($robots as $rob)
			{
				$header .= '<meta name="robots" content="'.$rob.'" />'."\n";
			}
		}	
		
		if( ! empty($meta['name'] ) && is_array($meta['name']) )foreach($meta['name'] as $k => $v)
		{
			$header .= '<meta name="'.$k.'" content="'.$v.'" />'."\n";
		}
		
		if( ! empty($meta['http']) && is_array($meta['http']) )foreach($meta['http'] as $k => $v)
		{
			$header .= '<meta http-equiv="'.$k.'" content="'.$v.'" />'."\n";
		}
			
		if( ! empty($pragma) ) 		
		{
			$header .= '<meta name="pragma" content="'.$pragma.'" />'."\n";	
		}
		
		if( ! empty($keywords) ) 		
		{
			$header .= '<meta name="keywords" content="'.$keywords.'" />'."\n";	
		}
		
		if( ! empty($author) ) 		
		{
			$header .= '<meta name="author" content="'.$author.'" />'."\n";
		}
		
		if( ! empty($designer) ) 		
		{
			$header .= '<meta name="designer" content="'.$designer.'" />'."\n";
		}
		
		if( ! empty($distribution) ) 	
		{
			$header .= '<meta name="distribution" content="'.$distribution.'" />'."\n";
		}
		
		if( ! empty($revisit) ) 		
		{
			$header .= '<meta name="revisit-after" content="'.$revisit.'" />'."\n";	
		}
		
		if( ! empty($font_arr) )
		{					
			$header .= self::font($font_arr, true);
		}
		
		if( is_array($masterpageset['script']) )
		{
			$header .= self::script($masterpageset['script'], true);
		}
		
		if( isset($head['script']) )
		{
			$header .= self::script($head['script'], true);
		}
		
		if( is_array($masterpageset['style']) )
		{
			$header .= self::style($masterpageset['style'], true);
		}
		
		if( isset($head['style']) )
		{
			$header .= self::style($head['style'], true);
		}
		
		if( $masterpageset['logo'] ) 
		{
			$header .= '<link rel="shortcut icon" href="'.base_url($masterpageset['logo']).'" />'."\n";
		}
		
		if( isset($head['page_image']) ) 
		{
			$header .= '<link rel="image_src" href="'.$head['page_image'].'" />'."\n";	
		}
		
		if( $datas && ! is_array($head['data']) )
		{ 
			$header .= $datas."\n"; 
		}
		else
		{
			if( is_array($datas) )foreach($datas as $v)
			{
				$header .= $v."\n";	
			}	
		}
		
		if( ! empty($head_page) )
		{
			ob_start(); 
			require_once($head_page); 
			$content = ob_get_contents(); 
			ob_end_clean(); 
			$header .= $content."\n" ; 	
		}
		
		$header .= '</head>'."\n";
		
		if( $masterpageset["bg_image"] ) 
		{
			$bg_image = " background='".base_url($masterpageset["bg_image"])."' bgproperties='fixed'"; 
		}
		else 
		{
			$bg_image = "";
		}
		
		$header .= '<body'.$bg_image.'>'."\n";
	
		echo $header;
		
		if( is_array($data) ) 
		{
			extract($data, EXTR_OVERWRITE, 'extract');
		}
		
		if( ! empty($page) ) 
		{
			require($page);	
		}
		
		$footer  = "\n".'</body>'."\n";
		$footer .= '</html>';
		
		echo $footer;	
	}	
	
	public static function font()
	{
		
		$str = "<style type='text/css'>";
		
		$arguments = func_get_args();
		$args      = $arguments;
		
		if(isset($arguments[0]) && is_array($arguments[0]))
		{
			$arguments = $arguments[0];
		}
		
		foreach(array_unique($arguments) as $font)
		{	
			if(is_array($font)) $font = '';
			
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
			$differentset = config::get('Font', 'different_font_extensions');
			
			if( ! empty($differentset))
			{			
				foreach($differentset as $of)
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
		
		if( ! empty($str) ) 
		{
			if($args[count($args) - 1] === true)
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
		$config_style = array_unique(config::get('Masterpage','style'));
		
		$str = '';
		
		$arguments = func_get_args();
		$args      = $arguments;
		
		if( isset($arguments[0]) && is_array($arguments[0]) )
		{
			$arguments = $arguments[0];
		}
		
		foreach(array_unique($arguments) as $style)
		{
			if( is_array($style) ) $style = '';
			
			if( ! in_array($style, $config_style) && ! in_array("style_".$style, self::$is_import))
			{
				if(is_file_exists(STYLES_DIR.suffix($style,".css")))
				{
					$str .= '<link href="'.base_url().STYLES_DIR.suffix($style,".css").'" rel="stylesheet" type="text/css" />'."\n";
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


	public static function script()
	{
		$config_script = array_unique(config::get('Masterpage','script'));
		
		$str = '';
		
		$arguments = func_get_args();
		$args      = $arguments;
		
		if( isset($arguments[0]) && is_array($arguments[0]) )
		{
			$arguments = $arguments[0];
		}
		
		foreach(array_unique($arguments) as $script)
		{
			if( is_array($script) ) $script = '';
			
			if( ! in_array($script, $config_script) && ! in_array("script_".$script, self::$is_import) )
			{
				if(is_file_exists(SCRIPTS_DIR.suffix($script,".js")))
				{
					$str .= '<script type="text/javascript" src="'.base_url().SCRIPTS_DIR.suffix($script,".js").'"></script>'."\n";
				}
				
				if($script === 'Jquery' || $script === 'JqueryUi')
				{
					$str .= '<script type="text/javascript" src="'.base_url().REFERENCES_DIR.'Jquery/'.suffix($script,".js").'"></script>'."\n";
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
	
	
	public static function something($page = '', $data = '', $ob_get_contents = false)
	{
		if( ! is_string($page) ) 
		{
			return false;
		}
		
		if( is_array($data) )
		{
			extract($data, EXTR_OVERWRITE, 'extract');
		}
		
		$other = 0;
		
		switch(extension($page))
		{
			case 'js':
				if( ! is_file_exists($page) ) return false;
				echo '<script type="text/javascript" src="'.base_url().$page.'"></script>'."\n";
			break;	
			
			case 'css':
				if( ! is_file_exists($page) ) return false;
				echo '<link href="'.base_url().$page.'" rel="stylesheet" type="text/css" />'."\n";
			break;
			
			default;
				$other = 1;
		}
		if( $other === 1 )
		{
			if( $ob_get_contents === false )
			{
				if( ! is_file_exists(suffix($page,".php")) ) 
				{
					return false;
				}
				require(suffix($page,".php")); 
			}
			
			if( $ob_get_contents === true )
			{
				if( ! is_file_exists(suffix($page,".php")) ) 
				{
					return false;
				}
				
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
		if( ! is_string($packages) ) 
		{
			return false;
		}
		
		if( ! is_dir_exists($packages) ) 
		{
			return false;
		}
		
		import::library("Folder");	
		
		if( folder::files($packages) ) 
		{
			foreach(folder::files($packages) as $val)
			{				
				if( extension($val) === "php" )
				{
					require_once (suffix($packages).$val);
				}
				if( extension($val) === "htm" )
				{
					require_once (suffix($packages).$val);
				}
				if( extension($val) === "html" )
				{
					require_once (suffix($packages).$val);
				}
				if( extension($val) === "js" )
				{
					echo '<script type="text/javascript" src="'.base_url().suffix($packages).$val.'"></script>'."\n";
				}
				if( extension($val) === "css" )
				{
					echo '<link href="'.base_url().suffix($packages).$val.'" rel="stylesheet" type="text/css" />'."\n";
				}
			}
		}
		else 
		{
			return false;
		}
	}
	
	
	public static function page($page = '', $data = '', $ob_get_contents = false)
	{
		if( ! is_string($page) )
		{
			return false;
		}
		
		if( is_array($data) )
		{
			extract($data, EXTR_OVERWRITE, 'extract');
		}
		
		if( $ob_get_contents === false )
		{
			if( ! is_file_exists(PAGES_DIR.suffix($page,".php")) ) 
			{
				return false;
			}
			require(PAGES_DIR.suffix($page,".php")); 
		}
		
		if( $ob_get_contents === true )
		{
			if( ! is_file_exists(PAGES_DIR.suffix($page,".php")) ) 
			{
				return false;
			}
			ob_start(); 
			require(PAGES_DIR.suffix($page,".php")); 
			$content = ob_get_contents(); 
			ob_end_clean(); 
			return $content ; 
		}
	
	}
	
	public static function view($page = '', $data = '', $ob_get_contents = false)
	{
		return self::page($page, $data, $ob_get_contents);
	}
	
	
	public static function model()
	{
		
		$config_coder = array_unique(config::get('Autoload','model'));
		
		$arguments = func_get_args();
		
		if( isset($arguments[0]) && is_array($arguments[0]) )
		{
			$arguments = $arguments[0];
		}
		
		foreach(array_unique($arguments) as $class)
		{
			if( is_array($class) ) 
			{
				$class = '';
			}
			
			if( ! in_array($class, $config_coder) )
			{
				$path = MODELS_DIR.suffix($class,".php");
			
				if( is_file_exists($path) && ! class_exists($class) ) 
				{
					require_once($path);
				}
			}
			is_imported($class, 'Model');
		}	
	}
}