<?php
namespace ZN\Components;

class InternalPagination implements PaginationInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Const CONFIG_NAME
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const CONFIG_NAME  = 'Components:pagination';
	
	protected $settings     = [];
	
	/* Total Rows Değişkeni
	 *  
	 * Toplam satır sayısı bilgisini
	 * tutması için oluşturulmuştur.
	 * Varsayılan:0
	 */
	protected $totalRows 	= 50;

	/* Start Değişkeni
	 *  
	 * Başlangıç bilgisini
	 * tutması için oluşturulmuştur.
	 * Varsayılan:0
	 */
	protected $start 		= 0;
	
	/* Type Değişkeni
	 *  
	 * Sayfalama türü bilgisini
	 * tutması için oluşturulmuştur.
	 * Varsayılan:'classic' -> ajax, classic
	 */
	protected $type 		= 'classic';
	
	/* Limit Değişkeni
	 *  
	 * Bir sayfada görüntülenmesi istenilen kayıt limit
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:0
	 */
	protected $limit 		= 10;
	
	/* Count Links Değişkeni
	 *  
	 * Sayfalama nesnesinde olması gereken link sayısı
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:10
	 */
	protected $countLinks 	= 10;
	
	/* Class Dizi Değişkeni
	 *  
	 * Sayfalama nesnesine eklenecek css sınıf
	 * bilgisini tutması için oluşturulmuştur.
	 * 
	 */
	protected $class		= [];
	
	/* Style Dizi Değişkeni
	 *  
	 * Sayfalama nesnesine eklenecek stil
	 * bilgisini tutması için oluşturulmuştur.
	 * 
	 */
	protected $style		= [];
	
	/* First Tag Değişkeni
	 *  
	 * Bir önceki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[prev]
	 */
	protected $prevTag 		= '[prev]';
	
	/* Last Tag Değişkeni
	 *  
	 * Bir sonraki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[next]
	 */
	protected $nextTag 		= '[next]';
	
	/* Firstest Tag Değişkeni
	 *  
	 * En baştaki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[first]
	 */
	protected $firstTag 	= '[first]';
	
	/* Lastest Tag Değişkeni
	 *  
	 * En sondaki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[last]
	 */
	protected $lastTag 		= '[last]';
	
	/* Url Tag Değişkeni
	 *  
	 * Sayfalama nesnesinin çalıştırılacağı url
	 * bilgisini tutması için oluşturulmuştur.
	 */
	protected $url  		= CURRENT_CFPATH;
	
	//----------------------------------------------------------------------------------------------------
	// Config Method
	//----------------------------------------------------------------------------------------------------
	// 
	// config()
	//
	//----------------------------------------------------------------------------------------------------
	use \ConfigMethodTrait;
	
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
	// Designer Methods Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	public function __construct()
	{
		$this->config();	
	}

	public function url($url = '')
	{
		if( is_string($url) )
		{
			$this->settings['url'] = $url;
		}
		else
		{
			\Errors::set('Error', 'stringParameter', 'url');	
		}
		
		return $this;
	}
	
	public function start($start = 0)
	{
		if( ! is_numeric($start) )
		{
			\Errors::set('Error', 'numericParameter', 'start');
			return $this;
		}
		
		$this->settings['start'] = $start;
		
		return $this;
	}
	
	public function limit($limit = 10)
	{
		if( ! is_numeric($limit) )
		{
			\Errors::set('Error', 'numericParameter', 'limit');
			return $this;
		}
		
		$this->settings['limit'] = $limit;
		
		return $this;
	}
	
	public function type($type = 'ajax')
	{
		if( ! is_string($type) )
		{
			\Errors::set('Error', 'stringParameter', '1.(type)');
			return $this;
		}
		
		$this->settings['type'] = $type;
		
		return $this;
	}
	
	public function totalRows($totalRows = 0)
	{
		if( ! is_numeric($totalRows) )
		{
			\Errors::set('Error', 'numericParameter', 'totalRows');
			return $this;
		}
		
		$this->settings['totalRows'] = $totalRows;
		
		return $this;
	}
	
	public function countLinks($countLinks = 10)
	{
		if( ! is_numeric($countLinks) )
		{
			\Errors::set('Error', 'numericParameter', 'countLinks');
			return $this;
		}
		
		$this->settings['countLinks'] = $countLinks;
		
		return $this;
	}
	
	public function linkNames($prev = '[prev]', $next = '[next]', $first = '[first]', $last = '[last]')
	{	
		// ÖNCEKİ BUTONU
		if( ! empty($prev) )
		{
			$this->settings['prevName']    = $prev;
		}
		
		// SONRAKİ BUTONU
		if( ! empty($next) )
		{
			$this->settings['nextName']     = $next;
		}
		
		// EN BAŞTAKİ BUTON
		if( ! empty($first) )
		{
			$this->settings['firstName'] = $first;
		}
			
		// EN SONDAKİ BUTON
		if( ! empty($last) )
		{
			$this->settings['lastName']  = $last;
		}
		
		return $this;
	}
	
	public function css($css = [])
	{
		if( ! is_array($css) )
		{
			\Errors::set('Error', 'arrayParameter', 'css');
			return $this;	
		}
		
		$this->settings['class'] = $css;
		
		return $this;
	}
	
	public function style($style = [])
	{
		if( ! is_array($style) )
		{
			\Errors::set('Error', 'arrayParameter', 'style');
			return $this;	
		}
		
		$this->settings['style'] = $style;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Designer Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Settings Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// SETTINGS                                                                               
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Sayfalama ayarlarını yapmak için kullanılmaktadır.                      
	//															                              
	// Parametreler: Tek dizi parametresi vardır.                                              
	// 1. array var @config => Sayfalama ayarlarını içerecek dizi parametresidir.       	  	  
	//          																				  
	// Örnek Kullanım: setting(array(Sayfalama Ayarları));        	  					      
	//          																				  
	// Parametrenin Alabileceği Değerler         											  
	//          																				  
	// 1.totalRows 	=> Toplam kayıt sayısı.          										  
	// 2.limit      	=> Bir sayfada yer alabilecek maximum kayıt sayısı.        			      
	// 3.url         => Sayfalama nesnesi sayfa numarası verisinin ekleneceği url adresi.  	  
	// 4.countLinks => Sayfalama nesnesinde yer alacak maximum link sayısı.         		  
	// 5.prevName   => Önceki butonunun ismi.         										  
	// 6.nextName   => Sonraki butonunun ismi.         										  
	// 7.firstName  => 1. Sayfa butonunun ismi.         									  
	// 8.lastName   => En son sayfa butonunun ismi.         								  
	// 9.class       => Css sınıfları eklenecek dizi bilgisi tutar.         					  
	// 10.style       => Stil eklenecek dizi bilgisi tutar.         						      
	//          																				  
	// Stil veya Sınıf Eklemede Kullanılabilir Parametreler         							  
	//          																				  
	// 1.links    => Sayfalama oluşturulan linklere stil veya sınıf eklenmesi için kullanılır. 
	// 2.current  => Aktif sayfayı görteren linke stil veya sınıf eklenmesi için kullanılır.   
	// 3.prev     => Önceki butonunu görteren linke stil veya sınıf eklenmesi için kullanılır. 
	// 4.next     => Sonraki butonunu görteren linke stil veya sınıf eklenmesi için kullanılır.
	// 5.first    => İlk butonunu görteren linke stil veya sınıf eklenmesi için kullanılır.    
	// 6.last     => Son butonunu görteren linke stil veya sınıf eklenmesi için kullanılır.   
	//          																				  
	//----------------------------------------------------------------------------------------------------
	public function settings($config = [])
	{
		// Parametre kontrolü yapılıyor. ---------------------------------------------------------
		if( ! is_array($config) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'config');	
		}
		
		$configs = $this->config; 
		
		// ---------------------------------------------------------------------------------------
		// Sayfalama Ayarlarını İçeren Değişkenler
		// ---------------------------------------------------------------------------------------
		if( ! empty($config['totalRows']) )  $this->totalRows 	= $config['totalRows'];
		if( ! empty($config['start']) ) 	 $this->start 	    = $config['start'];
		if( ! empty($config['limit']) ) 	 $this->limit 		= $config['limit'];
		if( ! empty($config['countLinks']) ) $this->countLinks 	= $config['countLinks'];	
		if( ! empty($config['prevName']) ) 	 $this->prevTag 	= $config['prevName'];
		if( ! empty($config['nextName']) ) 	 $this->nextTag 	= $config['nextName'];
		if( ! empty($config['firstName']) )  $this->firstTag  	= $config['firstName'];
		if( ! empty($config['lastName']) ) 	 $this->lastTag 	= $config['lastName'];
		if( ! empty($config['type']) ) 	 	 $this->type 	    = $config['type'];
		
		$this->class = array_merge($configs['class'], ( ! empty($config['class']) ? $config['class'] : []) );
		$this->style = array_merge($configs['style'], ( ! empty($config['style']) ? $config['style'] : []) );
		
		if( isset($config['url']) && $this->type !== 'ajax' )			
		{
			$this->url = suffix(siteUrl($config['url']));	
		}
		elseif( $this->type === 'ajax' )    
		{
			$this->url = '#prow=';
		}
		else
		{
			$this->url = suffix(CURRENT_CFURL);	
		}
		// ---------------------------------------------------------------------------------------	
	
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Settings Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	protected function _ajax($value)
	{
		if( $this->type === 'ajax' )
		{
			return ' prow="'.$value.'" ptype="ajax"';	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Create Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	public function create($start = NULL, $settings = [])
	{
		$settings = array_merge($this->config, $this->settings, $settings);
		
		if( ! empty($settings) )
		{
			$this->settings($settings);	
		}
		
		if( $this->start !== NULL )
		{
			$start = (int)$this->start;
		}
		
		$page  = '';
		$links = '';
		
		// Sayfalama başlangıç parametresi boş ise
		// Uri bilgisindeki son segmenti
		// başlangıç değeri olarak ayarla
		if( empty($start) && ! is_numeric($start) ) 
		{	
			// Eğer son segmen sayısal bir veri değilse
			// Başlangıç değerini 0 olarak ayarla.
			if( ! is_numeric(\Uri::segment(-1)) )
			{ 
				$startPage = 0; 
			}
			else
			{ 
				// Son segment sayısal veri ise
				// başlangıç değeri olarak ayarla
				$startPage = \Uri::segment(-1);
			}
		}
		else 
		{
			// @start parametresi boş değilse
			
			// @start parametresi sayılsal bir veri değilse
			// başlangıç değeri olarak 0 ayarla
			if( ! is_numeric($start) ) 
			{
				$start = 0;
			}
			
			// @start prametresi sayılsal bir değerse
			// bu değeri başlangıç değeri olarak ayarla.
			$startPage = $start;
		}
		
		// Kaç adet sayfa oluşacağı belirleniyor
		// Sayfa Sayısı = Toplam Satır / Limit
		$this->limit = $this->limit === 0 ? 1 : $this->limit;
					 
		$perPage = ceil($this->totalRows / $this->limit);
		
		$lc = ( ! empty($this->class['links']) ) ? $this->class['links'].' ' : ''; 
		$ls = ( ! empty($this->style['links']) ) ? $this->style['links'].' ' : '';
		
		$linksClass = ! empty($lc) ? ' class="'.trim($lc).'"' : '';
		$linksStyle = ! empty($ls) ? ' style="'.trim($ls).'"' : '';
		
		$linksStyleClass = $linksClass.$linksStyle;
		
		// Toplam link sayısı sayfa sayısından büyükse
		if( $this->countLinks > $perPage )
		{	
			// LINKS -------------------------------------------------------------------	
			for( $i = 1; $i <= $perPage; $i++ )
			{
				$page = ($i - 1) * $this->limit;
				
				// Kontrolere göre varsa stil veya sınıf verileri ekleniyor.
				
				if( $i - 1 == floor($startPage / $this->limit) )
				{
					$currentLinkClass = ( $classC = trim($lc.$this->class['current']) ) ? ' class="'.$classC.'"' : "";
					
					$currentLinkStyle = ( $styleC = trim($ls.$this->style['current']) ) ? ' style="'.$styleC.'"' : "";
					
					$currentLink = $currentLinkClass.$currentLinkStyle;
				}
				else
				{
					$currentLink = $linksStyleClass;	
				}
							   
				$links .= '<a href="'.$this->url.$page.'"'.$this->_ajax($page).$currentLink.'>'.$i.'</a>';
			}
			// LINKS -------------------------------------------------------------------
			
			// PREV Sonraki butonu ile ilgili kontrol yapılıyor.
			// PREV TAG ---------------------------------------------------------------	
			if( $startPage != 0 )
			{
				$classPrev  = ( $classP = trim($lc.$this->class['prev']) ) ? ' class="'.$classP.'"' : "";	
				$stylePrev  = ( $styleP = trim($ls.$this->style['prev']) ) ? ' style="'.$styleP.'"' : "";	
				$firstStcl  = $classPrev.$stylePrev;
					
				$pageRowNumber = $startPage - $this->limit;	  
				$first = '<a href="'.$this->url.$pageRowNumber.'"'.$this->_ajax($pageRowNumber).$firstStcl.'>'.$this->prevTag.'</a>';
			}
			else
			{
				$first = '';	
			}
			// PREV TAG ---------------------------------------------------------------	
			
			// NEXT Sonraki butonu ile ilgili kontrol yapılıyor.
			// NEXT TAG ---------------------------------------------------------------			
			if( $startPage != $page )
			{				  
				$classNext = ( $classN = trim($lc.$this->class['next']) ) ? ' class="'.$classN.'"' : "";
				$styleNext = ( $styleN = trim($ls.$this->style['next']) ) ? ' style="'.$styleN.'"' : "";	
				
				$pageRowNumber = $startPage + $this->limit;
				
				$lastUrl   = $this->url.($pageRowNumber);
				$lastStcl  = $classNext.$styleNext;
							  
				$last = '<a href="'.$lastUrl.'"'.$this->_ajax($pageRowNumber).$lastStcl.'>'.$this->nextTag.'</a>';
			}
			else
			{
				$last = '';	
			}
			// NEXT TAG ---------------------------------------------------------------	
			
			if( $this->totalRows > $this->limit ) 
			{
				return $first.' '.$links.' '.$last;
			}
		}
		else
		{
			$perPage = $this->countLinks;
			
			// Linkler için class kontrolleri sağlanıyor. ------------------------------
			
			// LAST LINK
			$lastTagClass     = ( $classLast = trim($lc.$this->class['last']) ) ? ' class="'.$classLast.'" ' : '';
			
			// FIRST LINK
			$firstTagClass    = ( $classFirst = trim($lc.$this->class['first']) ) ? ' class="'.$classFirst.'" ' : '';
			
			// NEXT LINK
			$nextTagClass     = ( $classNext = trim($lc.$this->class['next']) ) ? ' class="'.$classNext.'" ' : '';
			
			// CURRENT LINK 
			$currentLinkClass = ( $classCurrent = trim($lc.$this->class['current']) ) ? ' class="'.$classCurrent.'" ' : '';
			
			// PREV 					  
			$prevTagClass     = ( $classPrev = trim($lc.$this->class['prev']) ) ? ' class="'.$classPrev.'" ' : '';					 
			// -------------------------------------------------------------------------
			
			// Linkler için style kontrolleri sağlanıyor. ------------------------------
			
			// LAST LINK
			$lastTagStyle     = ( $styleLast = trim($ls.$this->style['last']) ) ? ' style="'.$styleLast.'" ' : '';
			
			// FIRST LINK
			$firstTagStyle    = ( $styleFirst = trim($ls.$this->style['first']) ) ? ' style="'.$styleFirst.'" ' : '';	
			
			// NEXT LINK
			$nextTagStyle     = ( $styleNext = trim($ls.$this->style['next']) ) ? ' style="'.$styleNext.'" ' : '';				   
			
			// CURRENT LINK 
			$currentLinkStyle = ( $styleCurrent = trim($ls.$this->style['current']) ) ? ' style="'.$styleCurrent.'" ' : '';
			// PREV
			$prevTagStyle     = ( $stylePrev = trim($ls.$this->style['prev']) ) ? ' style="'.$stylePrev.'" ' : '';				   
			// -------------------------------------------------------------------------
			
			// -------------------------------------------------------------------------
			// LAST TAG 
			// -------------------------------------------------------------------------
			$mod 	   = ( $this->totalRows % $this->limit ); 
			$outNumber = ( $mod == 0 ? $this->limit : 0 );
			
			$pageRowNumber     = ($this->totalRows - ($this->totalRows % $this->limit) ) - $outNumber;
			$lastTagNum        = $this->url.$pageRowNumber;
			$lastTagStyleClass = $lastTagClass.$lastTagStyle;
			
			
			
			$lastTag = '<a href="'.$lastTagNum.'"'.$this->_ajax($pageRowNumber).$lastTagStyleClass.'>'.$this->lastTag.'</a>';
			// -------------------------------------------------------------------------
						
			// -------------------------------------------------------------------------
			// FIRST TAG 
			// -------------------------------------------------------------------------
			$firstTagStyleClass = $firstTagClass.$firstTagStyle;
			
			$firstTag = '<a href="'.$this->url.'0"'.$this->_ajax(0).$firstTagStyleClass.'>'.$this->firstTag.'</a>';
			// -------------------------------------------------------------------------
			
			if( $startPage > 0 )
			{
				// -------------------------------------------------------------------------
				// PREV TAG 
				// -------------------------------------------------------------------------
				$pageRowNumber = $startPage - $this->limit;
				$firstNum = $this->url.$pageRowNumber;
				$prevTagStyleClass = $prevTagClass.$prevTagStyle;
				
				$first = '<a href="'.$firstNum.'"'.$this->_ajax($pageRowNumber).$prevTagStyleClass.'>'.$this->prevTag.'</a>';				
				// -------------------------------------------------------------------------
			}
			else
			{
				$first = '';	
			}
			
			if( ($startPage / $this->limit) == 0 ) 
			{
				$pagIndex = 1; 
			}
			else 
			{
				$pagIndex = floor( $startPage / $this->limit + 1);
			}
			
			if( $startPage < $this->totalRows - $this->limit )
			{
				// -------------------------------------------------------------------------
				// NEXT TAG 
				// -------------------------------------------------------------------------
				$pageRowNumber = $startPage + $this->limit;
				$lastNum = $this->url.($pageRowNumber);
				$nextTagStyleClass = $nextTagClass.$nextTagStyle;
				
				$last = '<a href="'.$lastNum.'"'.$this->_ajax($pageRowNumber).$nextTagStyleClass.'>'.$this->nextTag.'</a>';	
				// -------------------------------------------------------------------------				
			}
			else
			{
				$last       = '';
				$lastTag 	= '';
				$pagIndex   = ceil($this->totalRows / $this->limit) - $this->countLinks + 1;
			}
			
			if( $pagIndex < 1 || $startPage == 0 ) 
			{
				$firstTag = '';
			}
			
			$nPerPage = $perPage + $pagIndex - 1;
			
			if( $nPerPage >= ceil($this->totalRows / $this->limit) ) 
			{
				$nPerPage  = ceil($this->totalRows / $this->limit);
				$lastTag   = '';
				$last      = '';
			}
			
			$links = '';
			
			for( $i = $pagIndex; $i <= $nPerPage; $i++ )
			{
				$page = ($i - 1) * $this->limit;
			
				// Aktif sayfa linki kontrol ediliyor.
				if( $i - 1 == floor((int)$startPage / $this->limit) )
				{
					$currentLink = $currentLinkClass.$currentLinkStyle;
				}
				else
				{
					$currentLink = $linksStyleClass;	
				}
		
				$links .= '<a href="'.$this->url.$page.'"'.$this->_ajax($page).$currentLink.'>'.$i.'</a>';
				// -------------------------------------------------------------------------
			}
	
			if( $this->totalRows > $this->limit ) 
			{
	
				return $firstTag.' '.$first.' '.$links.' '.$last.' '.$lastTag;
			}
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Create Method Bitiş
	//----------------------------------------------------------------------------------------------------
}