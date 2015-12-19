<?php
class __USE_STATIC_ACCESS__Pagination implements PaginationInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	protected $settings = array();
	
	/* Total Rows Değişkeni
	 *  
	 * Toplam satır sayısı bilgisini
	 * tutması için oluşturulmuştur.
	 * Varsayılan:0
	 */
	protected $totalRows 		= 50;
	
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
	protected $class		= array();
	
	/* Style Dizi Değişkeni
	 *  
	 * Sayfalama nesnesine eklenecek stil
	 * bilgisini tutması için oluşturulmuştur.
	 * 
	 */
	protected $style		= array();
	
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
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use CallUndefinedMethodTrait;
	
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
	use ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Designer Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	public function url($url = '')
	{
		if( is_string($url) )
		{
			$this->settings['url'] = $url;
		}
		else
		{
			Error::set('Error', 'stringParameter', 'url');	
		}
		
		return $this;
	}
	
	public function start($start = 0)
	{
		if( ! is_numeric($start) )
		{
			Error::set('Error', 'numericParameter', 'start');
			return $this;
		}
		
		$this->settings['start'] = $start;
		
		return $this;
	}
	
	public function limit($limit = 10)
	{
		if( ! is_numeric($limit) )
		{
			Error::set('Error', 'numericParameter', 'limit');
			return $this;
		}
		
		$this->settings['limit'] = $limit;
		
		return $this;
	}
	
	public function type($type = 'ajax')
	{
		if( ! is_string($type) )
		{
			Error::set('Error', 'stringParameter', 'ajax');
			return $this;
		}
		
		$this->settings['type'] = $type;
		
		return $this;
	}
	
	public function totalRows($totalRows = 0)
	{
		if( ! is_numeric($totalRows) )
		{
			Error::set('Error', 'numericParameter', 'totalRows');
			return $this;
		}
		
		$this->settings['totalRows'] = $totalRows;
		
		return $this;
	}
	
	public function countLinks($countLinks = 10)
	{
		if( ! is_numeric($countLinks) )
		{
			Error::set('Error', 'numericParameter', 'countLinks');
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
	
	public function css($css = '')
	{
		if( ! is_array($css) )
		{
			Error::set('Error', 'arrayParameter', 'css');
			return $this;	
		}
		
		$this->settings['class'] = $css;
		
		return $this;
	}
	
	public function style($style = array())
	{
		if( ! is_array($style) )
		{
			Error::set('Error', 'arrayParameter', 'style');
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
	public function settings($config = array())
	{
		// Parametre kontrolü yapılıyor. ---------------------------------------------------------
		if( ! is_array($config) ) 
		{
			return Error::set('Error', 'arrayParameter', 'config');	
		}
		// ---------------------------------------------------------------------------------------
		// Sayfalama Ayarlarını İçeren Değişkenler
		// ---------------------------------------------------------------------------------------
		if( isset($config['totalRows']) )	$this->totalRows 	= $config['totalRows'];
		if( isset($config['limit']) )		$this->limit 		= $config['limit'];
		if( isset($config['countLinks']) )	$this->countLinks 	= $config['countLinks'];
		if( isset($config['class']) )		$this->class 		= $config['class'];
		if( isset($config['style']) )		$this->style 		= $config['style'];
		if( isset($config['prevName']) )	$this->prevTag 		= $config['prevName'];
		if( isset($config['nextName']) )	$this->nextTag 		= $config['nextName'];
		if( isset($config['firstName']) )	$this->firstTag 	= $config['firstName'];
		if( isset($config['lastName']) )	$this->lastTag 		= $config['lastName'];
		
		$type = isset($config['type']) ? $config['type'] : '';
		
		if( isset($config['url']) && $type !== 'ajax')			
		{
			$this->url = suffix(siteUrl($config['url']));	
		}
		elseif( $type === 'ajax' )    
		{
			$this->url = '#';
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
	
	//----------------------------------------------------------------------------------------------------
	// Create Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	public function create($start = NULL, $settings = array())
	{
		$settings = array_merge($this->settings, $settings);
		
		if( ! empty($settings) )
		{
			$this->settings($settings);	
		}
		
		$page  = '';
		$links = '';
		
		// Sayfalama başlangıç parametresi boş ise
		// Uri bilgisindeki son segmenti
		// başlangıç değeri olarak ayarla
		if( empty($start) ) 
		{	
			// Eğer son segmen sayısal bir veri değilse
			// Başlangıç değerini 0 olarak ayarla.
			if( ! is_numeric(Uri::segment(-1)) )
			{ 
				$startPage = 0; 
			}
			else
			{ 
				// Son segment sayısal veri ise
				// başlangıç değeri olarak ayarla
				$startPage = Uri::segment(-1);
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
		$this->limit = $this->limit === 0
					 ? 1
					 : $this->limit;
					 
		$perPage = ceil($this->totalRows / $this->limit);
		
		// LINKS 					  
		$linksClass = ( isset($this->class['links']) ) ? ' class="'.$this->class['links'].'" ' : '';
		
		// LINKS 
		$linksStyle = ( isset($this->style['links']) ) ? ' style="'.$this->style['links'].'" ' : '';
		
		$linksStyleClass = $linksClass.$linksStyle;
		
		// Toplam link sayısı sayfa sayısından büyükse
		if( $this->countLinks > $perPage )
		{	
			// lINKS Sayfalamada yer alacak linkler oluşturuluyor.
		
			
			// LINKS -------------------------------------------------------------------	
			for( $i = 1; $i <= $perPage; $i++ )
			{
				$page = ($i - 1) * $this->limit;
				
				// Kontrolere göre varsa stil veya sınıf verileri ekleniyor.
				
				if( $i - 1 == $startPage / $this->limit )
				{
					$currentLink = ( isset($this->class['current']) ) ? 'class="'.$this->class['current'].'"' : "";
					
					$currentLinkStyle = ( isset($this->style['current']) ) ? 'style="'.$this->style['current'].'"' : "";
				}
				else
				{
					$currentLink = '';	
					$currentLinkStyle = '';	
				}
				
				$classLinks = ( isset($this->class['links']) ) ? 'class="'.$this->class['links'].'"' : "";
							   
				$styleLinks = ( isset($this->style['links']) ) ? 'style="'.$this->style['links'].'"' : "";
							   
				$links .= '<a href="'.$this->url.$page.'" '.$classLinks.' '.$styleLinks.'><span '.$currentLink.' '.$currentLinkStyle.'> '.$i.'</span></a>';
			}
			// LINKS -------------------------------------------------------------------
			
			// PREV Sonraki butonu ile ilgili kontrol yapılıyor.
			// PREV TAG ---------------------------------------------------------------	
			if( $startPage != 0 )
			{
				$classPrev  = ( isset($this->class['prev']) ) ? 'class="'.$this->class['prev'].'"' : "";
				
				$stylePrev  = ( isset($this->style['prev']) ) ? 'style="'.$this->style['prev'].'"' : "";
				
				$firstStcl  = $classPrev.$linksStyleClass.$stylePrev;
							  
				$first = '<a href="'.$this->url.($startPage - $this->limit ).'" '.$firstStcl.'>'.$this->prevTag.'</a>';
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
				$classNext = ( isset($this->class['next']) ) ? 'class="'.$this->class['next'].'"' : "";

				$styleNext = ( isset($this->style['next']) ) ? 'style="'.$this->style['next'].'"' : "";
				
				$lastUrl   = $this->url.($startPage + $this->limit);
				$lastStcl  = $classNext.$linksStyleClass.$styleNext;
							  
				$last = '<a href="'.$lastUrl.'" '.$lastStcl.'>'.$this->nextTag.'</a>';
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
			$lastTagClass     = ( isset($this->class['last']) ) ? ' class="'.$this->class['last'].'" ' : '';
			
			// FIRST LINK
			$firstTagClass    = ( isset($this->class['first']) ) ? ' class="'.$this->class['first'].'" ' : '';
			
			// NEXT LINK
			$nextTagClass     = ( isset($this->class['next']) ) ? ' class="'.$this->class['next'].'" ' : '';
			
			// CURRENT LINK 
			$currentLinkClass = ( isset($this->class['current']) ) ? ' class="'.$this->class['current'].'" ' : '';
			
			// PREV 					  
			$prevTagClass     = ( isset($this->class['prev']) ) ? ' class="'.$this->class['prev'].'" ' : '';					 
			// -------------------------------------------------------------------------
			
			// Linkler için style kontrolleri sağlanıyor. ------------------------------
			
			// LAST LINK
			$lastTagStyle     = ( isset($this->style['last']) ) ? ' style="'.$this->style['last'].'" ' : '';
			
			// FIRST LINK
			$firstTagStyle    = ( isset($this->style['first']) ) ? ' style="'.$this->style['first'].'" ' : '';	
			
			// NEXT LINK
			$nextTagStyle     = ( isset($this->style['next']) ) ? ' style="'.$this->style['next'].'" ' : '';				   
			
			// CURRENT LINK 
			$currentLinkStyle = ( isset($this->style['current']) ) ? ' style="'.$this->style['current'].'" ' : '';
			// PREV
			$prevTagStyle     = ( isset($this->style['prev']) ) ? ' style="'.$this->style['prev'].'" ' : '';				   
			// -------------------------------------------------------------------------
			
			// -------------------------------------------------------------------------
			// LAST TAG 
			// -------------------------------------------------------------------------
			$lastTagNum        = $this->url.($this->totalRows - ($this->totalRows % $this->limit) - 1);
			$lastTagStyleClass = $lastTagClass.$linksStyleClass.$lastTagStyle;
			
			$lastTag = '<a href="'.$lastTagNum.'"'.$lastTagStyleClass.'>'.$this->lastTag.'</a>';
			// -------------------------------------------------------------------------
						
			// -------------------------------------------------------------------------
			// FIRST TAG 
			// -------------------------------------------------------------------------
			$firstTagStyleClass = $firstTagClass.$linksStyleClass.$firstTagStyle;
			
			$firstTag = '<a href="'.$this->url.'0"'.$firstTagStyleClass.'>'.$this->firstTag.'</a>';
			// -------------------------------------------------------------------------
			
			if( $startPage > 0 )
			{
				// -------------------------------------------------------------------------
				// PREV TAG 
				// -------------------------------------------------------------------------
				$firstNum = $this->url.($startPage - $this->limit );
				$fisrtStyleClass = $prevTagClass.$linksStyleClass.$prevTagStyle;
				
				$first = '<a href="'.$firstNum.'"'.$fisrtStyleClass.'>'.$this->prevTag.'</a>';				
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
				$pagIndex = ceil( $startPage / $this->limit + 1);
			}
			
			if( $startPage < $this->totalRows - $this->limit )
			{
				// -------------------------------------------------------------------------
				// NEXT TAG 
				// -------------------------------------------------------------------------
				$lastNum = $this->url.($startPage + $this->limit);
				$lastStyleClass = $nextTagClass.$linksStyleClass.$nextTagStyle;
				

				$last = '<a href="'.$lastNum.'"'.$lastStyleClass.'>'.$this->nextTag.'</a>';	
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
				if( $i - 1 == ceil($startPage / $this->limit) )
				{
					$currentLink = $currentLinkClass.$linksStyleClass.$currentLinkStyle;
				}
				else
				{
					$currentLink = '';	
				}
				
				$links .= '<a href="'.$this->url.$page.'"'.$linksStyleClass.'><span '.$currentLink.'> '.$i.'</span></a>';
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