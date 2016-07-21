<?php
namespace ZN\Importation;

use ZN\ViewObjects\TemplateWizard;

class InternalImport implements ImportInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Is Import Değişkeni
	 *  
	 * Bir sınıfın daha önce dahil edilip edilmediği
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	protected $isImport = [];
	
	/* Parameters Değişkeni
	 *  
	 * Parametre bilgilerini tutması içindir.
	 *
	 */
	protected $parameters = array
	(
		'data'   => [],
		'usable' => false 
	);
	
	/* Template Wizard Değişkeni
	 *  
	 * Template uzantısı bilgisini
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	protected $templateWizardExtension = '.wizard';
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Setting Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// usable()
	//----------------------------------------------------------------------------------------------------
	//
	// @var bool $usable
	//
	//----------------------------------------------------------------------------------------------------
	public function usable($usable = true)
	{
		$this->parameters['usable'] = $usable;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// recursive()
	//----------------------------------------------------------------------------------------------------
	//
	// @var bool $recursive
	//
	//----------------------------------------------------------------------------------------------------
	public function recursive($recursive = true)
	{
		$this->parameters['recursive'] = $recursive;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// data()
	//----------------------------------------------------------------------------------------------------
	//
	// @var array $data
	//
	//----------------------------------------------------------------------------------------------------
	public function data($data = [])
	{
		$this->parameters['data'] = $data;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// headData()
	//----------------------------------------------------------------------------------------------------
	//
	// @var string $headData
	//
	//----------------------------------------------------------------------------------------------------
	public function headData($headData = true)
	{
		$this->parameters['headData'] = $headData;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// body()
	//----------------------------------------------------------------------------------------------------
	//
	// @var string $body
	//
	//----------------------------------------------------------------------------------------------------
	public function body($body = '')
	{
		\Config::set('Masterpage', 'bodyPage', $body);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// head()
	//----------------------------------------------------------------------------------------------------
	//
	// @var mixed $head
	//
	//----------------------------------------------------------------------------------------------------
	public function head($head = '')
	{
		\Config::set('Masterpage', 'headPage', $head);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// title()
	//----------------------------------------------------------------------------------------------------
	//
	// @var string $title
	//
	//----------------------------------------------------------------------------------------------------
	public function title($title = '')
	{
		\Config::set('Masterpage', 'title', $title);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// title()
	//----------------------------------------------------------------------------------------------------
	//
	// @var string $title
	//
	//----------------------------------------------------------------------------------------------------
	public function meta($meta = [])
	{
		\Config::set('Masterpage', 'meta', $meta);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// attributes()
	//----------------------------------------------------------------------------------------------------
	//
	// @var array $attributes
	//
	//----------------------------------------------------------------------------------------------------
	public function attributes($attributes = [])
	{
		\Config::set('Masterpage', 'attributes', $attributes);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// content()
	//----------------------------------------------------------------------------------------------------
	//
	// @var array $content
	//
	//----------------------------------------------------------------------------------------------------
	public function content($content = [])
	{
		\Config::set('Masterpage', 'content', $content);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Setting Methods Bitiş
	//----------------------------------------------------------------------------------------------------
		
	//----------------------------------------------------------------------------------------------------
	// View Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	public function page($page = '', $data = '', $obGetContents = false, $randomPageDir = PAGES_DIR)
	{
		if( stristr($page, $this->templateWizardExtension) )
		{
			return $this->_templateWizard($page, $data, $obGetContents, $randomPageDir);
		}
		
		return $this->_page($page, $data, $obGetContents, $randomPageDir);
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
	public function view($page = '', $data = '', $obGetContents = false, $randomPageDir = PAGES_DIR)
	{
		return $this->page($page, $data, $obGetContents, $randomPageDir);
	}
	
	/******************************************************************************************
	* HANDLOAD                                                                                *
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
	public function handload(...$args)
	{
		if( ! empty($args) ) foreach( $args as $file )
		{
			$suffix     = suffix($file, '.php');
			$commonFile = EXTERNAL_HANDLOAD_DIR.$suffix ;
			$file 		= restorationPath(HANDLOAD_DIR.$suffix);
			
			if( is_file($file) )
			{
				require_once $file; // Yerel Dosya
			}
			elseif( is_file($commonFile) )
			{
				require_once($commonFile); // Ortak Dosya
			}
		}
	}
	
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
	protected function _page($randomPageVariable = '', $randomDataVariable = '', $randomObGetContentsVariable = false, $randomPageDir = PAGES_DIR)
	{
		if( ! empty($this->parameters['usable']) )
		{
			$randomObGetContentsVariable = $this->parameters['usable'];
		}
		
		if( ! empty($this->parameters['data']) )
		{
			$randomDataVariable = $this->parameters['data'];
		}

		$this->parameters = [];
		
		if( ! is_string($randomPageVariable) )
		{
			return \Errors::set('Error', 'stringParameter', 'randomPageVariable');
		}
		
		if( ! extension($randomPageVariable) || stristr($randomPageVariable, $this->templateWizardExtension) )
		{
			$randomPageVariable = suffix($randomPageVariable, '.php');
		}
		
		$randomPagePath = restorationPath($randomPageDir.$randomPageVariable);

		if( is_file($randomPagePath) ) 
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
			return \Errors::set('Error', 'fileNotFound', $randomPageVariable);	
		}
	}
	
	/******************************************************************************************
	* TEMPLATE WIZARD                                                                         *
	*******************************************************************************************
	| Genel Kullanım: view.template.php dosyalarını yüklemek ve ayrıştırmak için kullanılır.  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: Import::page('OrnekSayfa.template');        	  						  |
	|          																				  |
	******************************************************************************************/
	protected function _templateWizard($page, $data, $obGetContents, $randomPageDir = PAGES_DIR)
	{
		$return = TemplateWizard::data($this->_page($page, $data, true, $randomPageDir), $data);
			
		if( $obGetContents === true )
		{
			return $return;
		}
		
		echo $return;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// View Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Template Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* TEMPLATE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: .template uzantılı dosyaları yüklemek için kullanılır.				  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Dahil edilecek dosyanın yolu.								      |
	| 2. array var @data => Dahil edilecen sayfaya gönderilecek veriler.				      |
	| 3. boolean var @ob_get_contents => İçeriğin kullanımıyla ilgilidir..		              |
	|          																				  |
	| Örnek Kullanım: Import::page('OrnekSayfa');        	  								  |
	|          																				  |
	******************************************************************************************/
	public function template($page = '', $data = '', $obGetContents = false)
	{
		if( $return = $this->page($page, $data, $obGetContents, INTERNAL_TEMPLATES_DIR) ) 
		{
			return $return;
		}
		elseif( $return = $this->page($page, $data, $obGetContents, TEMPLATES_DIR) ) 
		{
			return $return;
		}
		elseif( $return = $this->page($page, $data, $obGetContents, EXTERNAL_TEMPLATES_DIR) ) 
		{
			return $return;
		}
		else
		{
			return \Errors::set('Error', 'fileNotFound', $page);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Template Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Master Page Method Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Protected Set Page
	//----------------------------------------------------------------------------------------------------
	//
	// @param mixed $page
	//
	//----------------------------------------------------------------------------------------------------
	protected function _setpage($page)
	{
		if( ! empty($page) )
		{
			$eol    = EOL;
			$return = '';
			
			// Tek bir üst sayfa kullanımı için.
			if( ! is_array($page) )
			{
				$return .= $this->page($page, '', true).$eol;
			}
			else
			{
				// Birden fazla üst sayfa kullanımı için.
				foreach( $page as $p )
				{
					$return .= $this->page($p, '', true).$eol;
				}
			}	
			
			return $return;
		}
		
		return false;
	}
	
	protected function _links($masterPageSet, $head, $type)
	{
		$header = '';
		
		if( empty($masterPageSet[$type]) && empty($head[$type]) )
		{
			return false;	
		}
	
		$params = $masterPageSet[$type];
		
		if( ! is_array($params) )
		{
			$params = [$params, true];
		}
		else
		{
			$params[] = true;	
		}
		
		$header .= $this->$type(...$params);
		
		if( isset($head[$type]) )
		{	
			if( is_string($head[$type]) )
			{
				$headLinks = [$head[$type], true];	
			}
			else
			{
				$head[$type][] = true;
				
				$headLinks = $head[$type];
			}
						
			$header .= $this->$type(...$headLinks);
		}
		
		return $header;
	}
	
	/******************************************************************************************
	* MASTERPAGE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Views/ dizini içinde yer alan herhangi bir sayfayı masterpage           |
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
	public function masterPage($randomDataVariable = [], $head = [])
	{	
		if( ! empty($this->parameters['headData']) )
		{
			$head = $this->parameters['headData'];
		}
		
		if( ! empty($this->parameters['data']) )
		{
			$randomDataVariable = $this->parameters['data'];
		}
	
		$this->parameters = [];
		
		$eol = EOL;
		
		//-----------------------------------------------------------------------------------------------------
		// Config/Masterpage.php dosyasından ayarlar alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$masterPageSet = \Config::get('Masterpage');
		
		//-----------------------------------------------------------------------------------------------------
		// Başlık ve vücud sayfaları alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$randomPageVariable = isset($head['bodyPage']) ? $head['bodyPage'] : $masterPageSet['bodyPage'];	
		$headPage 			= isset($head['headPage']) ? $head['headPage'] : $masterPageSet['headPage'];
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
	
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HTML START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/		
		$docType = isset($head['docType']) ? $head['docType'] : $masterPageSet["docType"];
		
		$header  = \Config::get('ViewObjects', 'doctype')[$docType].$eol;
		
		$htmlAttributes = isset($head['attributes']['html']) ? $head['attributes']['html'] : $masterPageSet['attributes']['html'];
		
		$header	.= '<html xmlns="http://www.w3.org/1999/xhtml"'.\Html::attributes($htmlAttributes).'>'.$eol;
		
		$headAttributes = isset($head['attributes']['head']) ? $head['attributes']['head'] : $masterPageSet['attributes']['head'];
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HEAD START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		$header .= '<head'.\Html::attributes($headAttributes).'>'.$eol;
		
		$contentCharset = isset($head['content']['charset']) ? $head['content']['charset'] : $masterPageSet['content']['charset'];
					  
		if( is_array($contentCharset) )
		{
			foreach( $contentCharset as $v )
			{
				$header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$v\">".$eol;	
			}
		}
		else
		{
			$header .= '<meta http-equiv="Content-Type" content="text/html; charset='.$contentCharset.'">'.$eol;	
		}
		
		$contentLanguage = isset($head['content']['language']) ? $head['content']['language'] : $masterPageSet['content']['language'];
		
		$header .= '<meta http-equiv="Content-Language" content="'.$contentLanguage .'">'.$eol;
			
		//-----------------------------------------------------------------------------------------------------
		// Data ve Meta verileri alınıyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------					
		$datas = $masterPageSet['data'];
						
		$metas = $masterPageSet['meta'];
						
		$title = isset($head['title']) ? $head['title'] : $masterPageSet["title"];
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		if( ! empty($title) ) 			
		{
			$header .= '<title>'.$title.'</title>'.$eol;	
		}
		
		//-----------------------------------------------------------------------------------------------------
		// Meta tagları dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		if( isset($head['meta']) )
		{
			$metas = array_merge($metas, $head['meta']);
		}
		
		if( ! empty($metas) ) foreach( $metas as $name => $content )
		{
			if( isset($head['meta'][$name]) )
			{
				$content = $head['meta'][$name];
			}
			
			if( ! stristr($name, 'http:') && ! stristr($name, 'name:') )
			{
				$name = 'name:'.$name;
			}
			
			if( ! empty($content) )
			{
				$nameEx 	= explode(":", $name);
				$httpOrName = ( $nameEx[0] === 'http' ) ? 'http-equiv' : 'name';
				$name 		= ( isset($nameEx[1]) ) ? $nameEx[1] : $nameEx[0];
							  
				if( ! is_array($content) )
				{			  
					$header .= "<meta $httpOrName=\"$name\" content=\"$content\">".$eol;
				}
				else
				{
					foreach( $content as $key => $val )
					{
						$header .= "<meta $httpOrName=\"$name\" content=\"$val\">".$eol;	
					}	
				}
			}
		}
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------
		// Fontlar dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$header .= $this->_links($masterPageSet, $head, 'font');
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------
		// Javascript kodları dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$header .= $this->_links($masterPageSet, $head, 'script');
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------
		// Stiller dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$header .= $this->_links($masterPageSet, $head, 'style');
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------
		// Browser Icon dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$browserIcon  = isset($head['browserIcon']) ? $head['browserIcon'] : $masterPageSet["browserIcon"];
					  
		if( ! empty($browserIcon) && is_file($browserIcon) ) 
		{
			$header .= '<link rel="shortcut icon" href="'.baseUrl($browserIcon).'" />'.$eol;
		}
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------
		// Tema dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$theme          = isset($head['theme']['name']) ? $head['theme']['name'] : $masterPageSet['theme']['name']; 
		$themeRecursive = isset($head['theme']['recursive']) ? $head['theme']['recursive'] : $masterPageSet['theme']['recursive'];
			   
		if( ! empty($theme) ) 			
		{
			$header .= $this->theme($theme, $themeRecursive, true);	
		}
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------
		// Eklenti dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$plugin 		 = isset($head['plugin']['name']) ? $head['plugin']['name'] : $masterPageSet['plugin']['name']; 
		$pluginRecursive = isset($head['plugin']['recursive']) ? $head['plugin']['recursive'] : $masterPageSet['plugin']['recursive'];
			   
		if( ! empty($plugin) ) 			
		{
			$header .= $this->plugin($plugin, $pluginRecursive, true);	
		}
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------
		// Farklı veriler dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		if( isset($head['data']) )
		{
			$datas = array_merge($datas, $head['data']);
		}
		
		if( ! empty($datas) )
		{ 
			if( ! is_array($datas) )
			{ 
				$header .= $datas.$eol; 
			}
			else
			{
				foreach( $datas as $v )
				{
					$header .= $v.$eol;	
				}	
			}
		}
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------
		// Başlık sayfası dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		
		$header .= $this->_setpage($headPage);
		
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		$header .= '</head>'.$eol;
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HEAD END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>BODY START<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		//-----------------------------------------------------------------------------------------------------
		// Arkaplan resmi dahil ediliyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		$backgroundImage  = isset($head['backgroundImage']) ? $head['backgroundImage'] : $masterPageSet["backgroundImage"];			  
		$bgImage 	 	  = ( ! empty($backgroundImage) && is_file($backgroundImage) ) ? ' background="'.baseUrl($backgroundImage).'" bgproperties="fixed"' : '';
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
		
		$bodyAttributes = isset($head['attributes']['body']) ? $head['attributes']['body'] : $masterPageSet['attributes']['body'];
		
		$header .= '<body'.\Html::attributes($bodyAttributes).$bgImage.'>'.$eol;
	
		echo $header;
		
		if( ! empty($randomPageVariable) ) 
		{
			$this->page($randomPageVariable, $randomDataVariable);
		}
		
		$randomFooterVariable  = $eol.'</body>'.$eol;
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>BODY END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		$randomFooterVariable .= '</html>';
		/*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>HTML END<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
		
		//-----------------------------------------------------------------------------------------------------
		// Masterpage oluşturuluyor. <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
		//-----------------------------------------------------------------------------------------------------
		echo $randomFooterVariable;	
		//-----------------------------------------------------------------------------------------------------
		// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//-----------------------------------------------------------------------------------------------------
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Master Page Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Font Method Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	protected function _parameters($arguments, $cdn)
	{
		if( ! empty($this->parameters['usable']) )
		{
			$lastParam = $this->parameters['usable'];
			
			$this->parameters = [];
		}
		else
		{
			$argumentCount = count($arguments) - 1;
			
			$lastParam = isset($arguments[$argumentCount]) ? $arguments[$argumentCount] : false;	
		}

		$arguments = array_unique($arguments);
		
		return (object)array
		(
			'arguments' => $arguments,
			'lastParam' => $lastParam,
			'cdnLinks'  => array_change_key_case(\Config::get('ViewObjects', 'cdn')[$cdn])
		);
	}
	
	/******************************************************************************************
	* FONT                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Harici font yüklemek için kullanılır. Yüklenmek istenen fontlar		  |
	| Resources/Fonts/ dizinine atılır.										  				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @fonts => Parametre olarak sıralı font dosyalarını veya dizi içinde   |
	| eleman olarak kullanılan font dosyalarını dahil etmek için kullanılır.			      |
	|          																				  |
	| Örnek Kullanım: Import::font('f1', 'f2' ... 'fN');        						      |
	| Örnek Kullanım: Import::font(array('f1', 'f2' ... 'fN'));        				          |
	|          																				  |
	******************************************************************************************/
	public function font(...$fonts)
	{	
		$eol	   = EOL;
		$str       = "<style type='text/css'>".$eol;
		$args      = $this->_parameters($fonts, 'fonts');		
		$lastParam = $args->lastParam;
		$arguments = $args->arguments;	
		$links     = $args->cdnLinks;
		
		foreach( $arguments as $font )
		{	
			if( is_array($font) ) 
			{
				$font = '';
			}
			
			$f = divide($font, "/", -1);
			// SVG IE VE MOZILLA DESTEKLEMIYOR
			
			$fontFile = restorationPath(FONTS_DIR.$font);		
			$baseUrl  = baseUrl($fontFile);
			
			if( ! is_file($fontFile) )
			{
				$fontFile = EXTERNAL_FONTS_DIR.$font;
			}
			
			if( extension($fontFile) )
			{
				if( is_file($fontFile) )
				{
					$strEx = $this->something($fontFile, '', true);
					
					break;
				}
			}
			
			if( is_file($fontFile.".svg") )
			{			
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.svg") format("truetype")}'.$eol;				
			}
			if( is_file($fontFile.".woff") )
			{			
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.woff") format("truetype")}'.$eol;		
			}
			// OTF IE VE CHROME DESTEKLEMIYOR
			if( is_file($fontFile.".otf") )
			{
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.otf") format("truetype")}'.$eol;			
			}
			
			// TTF IE DESTEKLEMIYOR
			if( is_file($fontFile.".ttf") )
			{		
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.ttf") format("truetype")}'.$eol;			
			}
			
			// CND ENTEGRASYON
			
			$cndFont = isset($links[strtolower($font)]) ? $links[strtolower($font)] : NULL;
			
			if( ! empty($cndFont) )
			{		
				$str .= '@font-face{font-family:"'.divide(removeExtension($cndFont), "/", -1).'"; src:url("'.$cndFont.'") format("truetype")}'.$eol;			
			}
			
			// FARKLI FONTLAR
			$differentSet = \Config::get('ViewObjects', 'font')['differentFontExtensions'];
			
			if( ! empty($differentSet) )
			{			
				foreach( $differentSet as $of )
				{
					if( is_file($fontFile.prefix($of, '.')) )
					{		
						$str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.prefix($of, '.').'") format("truetype")}'.$eol;			
					}
				}	
			}
			
			// EOT IE DESTEKLIYOR
			if( is_file($fontFile.".eot") )
			{
				$str .= '<!--[if IE]>';
				$str .= '@font-face{font-family:"'.$f.'"; src:url("'.$baseUrl.'.eot") format("truetype")}';
				$str .= '<![endif]-->';
				$str .= $eol;
			}		
		}
		
		$str .= '</style>'.$eol;
		
		if( isset($strEx) )
		{
			$str = $strEx;
		}
		
		if( ! empty($str) ) 
		{
			if( $lastParam === true )
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
	
	//----------------------------------------------------------------------------------------------------
	// Font Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Style Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* STYLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Harici stil yüklemek için kullanılır. Yüklenmek istenen stiller		  |
	| Resources/Styles/ dizinine atılır.			     				  				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @styles => Parametre olarak sıralı stil dosyalarını veya dizi içinde  |
	| eleman olarak kullanılan stil dosyalarını dahil etmek için kullanılır.			      |
	|          																				  |
	| Örnek Kullanım: Import::style('s1', 's2' ... 'sN');        						      |
	| Örnek Kullanım: Import::style(array('s1', 's2' ... 'sN'));        				      |
	|          																				  |
	******************************************************************************************/
	public function style(...$styles)
	{
		$str       = '';	
		$eol	   = EOL;	
		$args      = $this->_parameters($styles, 'styles');	
		$lastParam = $args->lastParam;
		$arguments = $args->arguments;	
		$links     = $args->cdnLinks;

		foreach( $arguments as $style )
		{
			if( is_array($style) ) 
			{
				$style = '';
			}	
			
			$styleFile = restorationPath(STYLES_DIR.suffix($style,".css"));
			
			if( ! is_file($styleFile) )
			{
				$styleFile = EXTERNAL_STYLES_DIR.suffix($style, ".css");
			}
		
			if( ! in_array("style_".$style, $this->isImport) )
			{					
				if( is_file($styleFile) )
				{
					$str .= '<link href="'.baseUrl($styleFile).'" rel="stylesheet" type="text/css" />'.$eol;
				}
				elseif( isUrl($style) && extension($style) === 'css' )
				{
					$str .= '<link href="'.$style.'" rel="stylesheet" type="text/css" />'.$eol;
				}
				elseif( isset($links[strtolower($style)]) )
				{
					$str .= '<link href="'.$links[strtolower($style)].'" rel="stylesheet" type="text/css" />'.$eol;	
				}
				
				$this->isImport[] = "style_".$style;
			}
		}
		
		if( ! empty($str) ) 
		{
			if( $lastParam === true )
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
	
	//----------------------------------------------------------------------------------------------------
	// Style Method Bitiş
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Script Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* SCRIPT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Harici js dosyası yüklemek için kullanılır. Yüklenmek istenen stiller	  |
	| Resources/Scripts/ dizinine atılır.		    						  				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array/args var @scripts => Parametre olarak sıralı js dosyalarını veya dizi içinde   |
	| eleman olarak kullanılan js dosyalarını dahil etmek için kullanılır.			     	  |
	|          																				  |
	| Örnek Kullanım: Import::script('s1', 's2' ... 'sN');        						      |
	| Örnek Kullanım: Import::script(script('s1', 's2' ... 'sN'));        				      |
	|          																				  |
	******************************************************************************************/
	public function script(...$scripts)
	{
		$str 	   = '';	
		$eol	   = EOL;	
		$args      = $this->_parameters($scripts, 'scripts');	
		$lastParam = $args->lastParam;
		$arguments = $args->arguments;	
		$links     = $args->cdnLinks;

		foreach( $arguments as $script )
		{
			if( is_array($script) ) 
			{
				$script = '';
			}
			
			$scriptFile = restorationPath(SCRIPTS_DIR.suffix($script, ".js"));
			
			if( ! is_file($scriptFile) )
			{
				$scriptFile = EXTERNAL_SCRIPTS_DIR.suffix($script, ".js");
			}
			
			if( ! in_array("script_".$script, $this->isImport) )
			{
				if( is_file($scriptFile) )
				{
					$str .= '<script type="text/javascript" src="'.baseUrl($scriptFile).'"></script>'.$eol;
				}
				elseif( isUrl($script) && extension($script) === 'js' )
				{
					$str .= '<script type="text/javascript" src="'.$script.'"></script>'.$eol;
				}
				elseif( isset($links[strtolower($script)]) )
				{
					$str .= '<script type="text/javascript" src="'.$links[strtolower($script)].'"></script>'.$eol;	
				}
				
				$this->isImport[] = "script_".$script;
			}
		}
		
		if( ! empty($str) ) 
		{
			if( $lastParam === true )
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
	
	//----------------------------------------------------------------------------------------------------
	// Script Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Something Method Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	| Örnek Kullanım: Import::something('Application/Views/OrnekSayfa.php');             	  |
	| Örnek Kullanım: Import::something('Application/Resources/Styles/Stil.js');  	          |
	|          																				  |
	******************************************************************************************/
	public function something($randomPageVariable = '', $randomDataVariable = '', $randomObGetContentsVariable = false)
	{
		if( ! empty($this->parameters['usable']) )
		{
			$randomObGetContentsVariable = $this->parameters['usable'];
		}
		
		if( ! empty($this->parameters['data']) )
		{
			$randomDataVariable = $this->parameters['data'];
		}

		$this->parameters = [];
		
		$eol = EOL;
		
		$randomPageVariableExtension = extension($randomPageVariable);
		$randomPageVariableBaseUrl   = baseUrl($randomPageVariable);
		
		$return = '';
		
		if( ! is_file($randomPageVariable) ) 
		{
			return \Errors::set('Error', 'fileParameter', '1.(randomPageVariable)');
		}
		
		$randomPageVariable = restorationPath($randomPageVariable);

		if( $randomPageVariableExtension === 'js' )
		{
			$return = '<script type="text/javascript" src="'.$randomPageVariableBaseUrl.'"></script>'.$eol;
		}
		elseif( $randomPageVariableExtension === 'css' )	
		{	
			$return = '<link href="'.$randomPageVariableBaseUrl.'" rel="stylesheet" type="text/css" />'.$eol;
		}
		elseif( stristr('svg|woff|otf|ttf|'.implode('|', \Config::get('ViewObjects', 'font')['differentFontExtensions']), $randomPageVariableExtension) )
		{			
			$return = '<style type="text/css">@font-face{font-family:"'.divide(removeExtension($randomPageVariable), "/", -1).'"; src:url("'.$randomPageVariableBaseUrl.'") format("truetype")}</style>'.$eol;				
		}
		elseif( $randomPageVariableExtension === 'eot' )
		{		
			$return = '<style type="text/css"><!--[if IE]>@font-face{font-family:"'.divide(removeExtension($randomPageVariable), "/", -1).'"; src:url("'.$randomPageVariableBaseUrl.'") format("truetype")}<![endif]--></style>'.$eol;				
		}
		else
		{
			$randomPageVariable = suffix($randomPageVariable, '.php');
			
			if( is_file($randomPageVariable) )
			{
				if( is_array($randomDataVariable) )
				{
					extract($randomDataVariable, EXTR_OVERWRITE, 'zn');
				}
					
				if( $randomObGetContentsVariable === false )
				{
					require($randomPageVariable); 
				}
				else
				{
					ob_start(); 
					require($randomPageVariable); 
					$randomContentVariable = ob_get_contents(); 
					ob_end_clean();
					
					return $randomContentVariable; 
				}
			}
		}
		
		if( $randomObGetContentsVariable === false )
		{
			echo $return;
		}
		else
		{
			return $return;	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Something Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Package Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Package
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $package
	// @param bool   $recursive  
	// @param bool   $getContents   	              
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function package($packages = "", $recursive = false, $getContents = false, $dir = '')
	{
		if( ! is_array($packages) )
		{
			return $this->_package($dir.$packages, $recursive, $getContents);
		}
		else
		{
			$return = '';
			
			if( ! empty($packages) ) foreach( $packages as $package )
			{
				$return .= $this->_package($dir.$package, $recursive, true);
			}	
			
			if( $getContents === false )
			{
				echo $return;	
			}
			else
			{
				return $return;	
			}
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Package
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $package
	// @param bool   $recursive  
	// @param bool   $getContents      	              
	//       
	//----------------------------------------------------------------------------------------------------   																				  
	protected function _package($packages = "", $recursive = false, $getContents = false)
	{
		if( ! is_string($packages)  ) 
		{
			\Errors::set('Error', 'stringParameter', 'packages');
			
			return false;
		}
		
		if( ! empty($this->parameters['usable']) )
		{
			$getContents = $this->parameters['usable'];
		}
		
		if( ! empty($this->parameters['recursive']) )
		{
			$recursive = $this->parameters['recursive'];
		}
		
		$this->parameters = [];
	
		$eol = EOL;
		
		$return = '';
		
		// Common Directory
		if( ! is_dir($packages) && ! is_file($packages) )
		{
			$packages = str_replace(RESOURCES_DIR, EXTERNAL_RESOURCES_DIR, $packages);	
		}
		
		if( is_dir($packages) )
		{
			$packageFiles = \Folder::allFiles(suffix($packages), $recursive);
			
			if( ! empty($packageFiles) ) 
			{
				foreach( $packageFiles as $val )
				{	
					$val = restorationPath($val);		
						
					if( $getContents === true )
					{
						$return .= $this->something($val, '', true);
					}
					else
					{
						$this->something($val);
					}
				}
				
				return $return;			
			}
			else 
			{
				return false;
			}
		}
		elseif( is_file($packages) )
		{
			// Local Directory
			return $this->something($packages, '', $getContents);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Theme
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $theme
	// @param bool   $recursive  
	// @param bool   $getContents    	              
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function theme($theme = 'Default', $recursive = false, $getContents = false)
	{
		return $this->package($theme, $recursive, $getContents, THEMES_DIR);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Plugin
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $plugin
	// @param bool   $recursive  
	// @param bool   $getContents     	              
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function plugin($plugin = 'Default', $recursive = false, $getContents = false)
	{
		return $this->package($plugin, $recursive, $getContents, PLUGINS_DIR);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Package Method Bitiş
	//----------------------------------------------------------------------------------------------------
}