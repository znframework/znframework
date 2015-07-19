<?php 
class __USE_STATIC_ACCESS__Pagination
{
	/***********************************************************************************/
	/* PAGINATION LIBRARY	     			                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Pagination
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: pagination::, $this->pagnation, zn::$use->pagination, uselib('pagnation')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
	protected $url;
	
	/******************************************************************************************
	* SETTINGS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sayfalama ayarlarını yapmak için kullanılmaktadır.                      |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @config => Sayfalama ayarlarını içerecek dizi parametresidir.       	  	  |
	|          																				  |
	| Örnek Kullanım: setting(array(Sayfalama Ayarları));        	  					      |
	|          																				  |
	| Parametrenin Alabileceği Değerler         											  |
	|          																				  |
	| 1.total_rows 	=> Toplam kayıt sayısı.          										  |
	| 2.limit      	=> Bir sayfada yer alabilecek maximum kayıt sayısı.        			      |
	| 3.url         => Sayfalama nesnesi sayfa numarası verisinin ekleneceği url adresi.  	  |
	| 4.count_links => Sayfalama nesnesinde yer alacak maximum link sayısı.         		  |
	| 5.prev_name   => Önceki butonunun ismi.         										  |
	| 6.next_name   => Sonraki butonunun ismi.         										  |
	| 7.first_name  => 1. Sayfa butonunun ismi.         									  |
	| 8.last_name   => En son sayfa butonunun ismi.         								  |
	| 9.class       => Css sınıfları eklenecek dizi bilgisi tutar.         					  |
	| 10.style       => Stil eklenecek dizi bilgisi tutar.         						      |
	|          																				  |
	| Stil veya Sınıf Eklemede Kullanılabilir Parametreler         							  |
	|          																				  |
	| 1.links    => Sayfalama oluşturulan linklere stil veya sınıf eklenmesi için kullanılır. |
	| 2.current  => Aktif sayfayı görteren linke stil veya sınıf eklenmesi için kullanılır.   |
	| 3.prev     => Önceki butonunu görteren linke stil veya sınıf eklenmesi için kullanılır. |
	| 4.next     => Sonraki butonunu görteren linke stil veya sınıf eklenmesi için kullanılır.|
	| 5.first    => İlk butonunu görteren linke stil veya sınıf eklenmesi için kullanılır.    |
	| 6.last     => Son butonunu görteren linke stil veya sınıf eklenmesi için kullanılır.    |
	|          																				  |
	******************************************************************************************/	
	public function settings($config = array())
	{
		// Parametre kontrolü yapılıyor. ---------------------------------------------------------
		if( ! is_array($config) ) 
		{
			return false;
		}
		// ---------------------------------------------------------------------------------------
		// Sayfalama Ayarlarını İçeren Değişkenler
		// ---------------------------------------------------------------------------------------
		if( isset($config['totalRows']) )	$this->totalRows 	= $config['totalRows'];
		if( isset($config['limit']) )		$this->limit 		= $config['limit'];
		if( isset($config['url']) )			$this->url 			= suffix(siteUrl($config['url']));	
		if( isset($config['countLinks']) )	$this->countLinks 	= $config['countLinks'];
		if( isset($config['class']) )		$this->class 		= $config['class'];
		if( isset($config['style']) )		$this->style 		= $config['style'];
		if( isset($config['prevName']) )	$this->prevTag 		= $config['prevName'];
		if( isset($config['nextName']) )	$this->nextTag 		= $config['nextName'];
		if( isset($config['firstName']) )	$this->firstTag 	= $config['firstName'];
		if( isset($config['lastName']) )	$this->lastTag 		= $config['lastName'];
		// ---------------------------------------------------------------------------------------	
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sayfalama ayarlarını yapmak için kullanılmaktadır.                      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @start => Sayfalamaya başlanacak kayıt numarası bilgisi girilir.          |
	| Genel olarak uri'den alınan veri bu parametreye veri olarak gönderilir. Bu gelene       |
	| veriye göre kaçıncı kayıtta ise verileri o kayıttan itibaren yeniden sayfalar.      	  |
	|          																				  |
	| @start parametresiin boş olması durumunda kayıt başlangıç numarası olarak urideki son   |
	| segmenti parametre olarak kullanmaya çalışır. Çünkü sayfalamada belirtilen url bilgisine|
	| göre sayfa numarası uri'ye ekleniyor. Bu ekleme işide uri'nin son segmenti olduğu için  |
	| son segmentten yararlanılmaya çalışılıyor.         									  |
	|          																				  |
	| Örnek Kullanım: create();        	  					                                  |
	|          																				  |
	******************************************************************************************/	
	public function create($start = '', $settings = array())
	{
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
		
		// Toplam link sayısı sayfa sayısından büyükse
		if( $this->countLinks > $perPage )
		{	
			// lINKS Sayfalamada yer alacak linkler oluşturuluyor.
			// LINKS -------------------------------------------------------------------	
			for($i = 1; $i <= $perPage; $i++)
			{
				$page = ($i - 1) * $this->limit;
				
				// Kontrolere göre varsa stil veya sınıf verileri ekleniyor.
				
				if( $i - 1 == $startPage / $this->limit )
				{
					$currentLink = ( isset($this->class['current']) ) 
								 ? 'class="'.$this->class['current'].'"' 
								 : "";
					
					$currentLinkStyle = ( isset($this->style['current']) ) 
					                  ? 'style="'.$this->style['current'].'"' 
								      : "";
				}
				else
				{
					$currentLink = '';	
					$currentLinkStyle = '';	
				}
				
				$classLinks = ( isset($this->class['links']) ) 
							  ? 'class="'.$this->class['links'].'"' 
							  : "";
							   
				$styleLinks = ( isset($this->style['links']) ) 
							  ? 'style="'.$this->style['links'].'"' 
							  : "";
							   
				$links .= '<a href="'.$this->url.$page.'" '.$classLinks.' '.$styleLinks.'><span '.$currentLink.' '.$currentLinkStyle.'> '.$i.'</span></a>';
			}
			// LINKS -------------------------------------------------------------------
			
			// PREV Sonraki butonu ile ilgili kontrol yapılıyor.
			// PREV TAG ---------------------------------------------------------------	
			if( $startPage != 0 )
			{
				$classPrev = ( isset($this->class['prev']) ) 
							 ? 'class="'.$this->class['prev'].'"' 
							 : "";
				
				$stylePrev = ( isset($this->style['prev']) ) 
							 ? 'style="'.$this->style['prev'].'"' 
							 : "";
							  
				$first = '<a href="'.$this->url.($startPage - $this->limit ).'" '.$classPrev .' '.$stylePrev.'>'.$this->prevTag.'</a>';
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
				$classNext = ( isset($this->class['next']) ) 
							 ? 'class="'.$this->class['next'].'"' 
							 : "";

				$styleNext = ( isset($this->style['next']) ) 
							 ? 'style="'.$this->style['next'].'"' 
							 : "";
				
				$lastUrl   = $this->url.($startPage + $this->limit);
				$lastStcl  = $classNext.' '.$styleNext;
							  
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
			$lastTagClass = ( isset($this->class['last']) ) 
							? ' class="'.$this->class['last'].'" ' 
							: '';
			
			// FIRST LINK
			$firstTagClass = ( isset($this->class['first']) ) 
						     ? ' class="'.$this->class['first'].'" ' 
							 : '';
			
			// NEXT LINK
			$nextTagClass = ( isset($this->class['next']) ) 
							? ' class="'.$this->class['next'].'" ' 
							: '';
			
			// CURRENT LINK 
			$currentLinkClass = ( isset($this->class['current']) ) 
								? ' class="'.$this->class['current'].'" ' 
								: '';
			
			// LINKS 					  
			$linksClass = ( isset($this->class['links']) ) 
						  ? ' class="'.$this->class['links'].'" ' 
						  : '';
			
			// PREV 					  
			$prevTagClass = ( isset($this->class['prev']) ) 
							? ' class="'.$this->class['prev'].'" ' 
							: '';					 
			// -------------------------------------------------------------------------
			
			// Linkler için style kontrolleri sağlanıyor. ------------------------------
			
			// LAST LINK
			$lastTagStyle = ( isset($this->style['last']) ) 
							? ' style="'.$this->style['last'].'" ' 
							: '';
			
			// FIRST LINK
			$firstTagStyle = ( isset($this->style['first']) ) 
							 ? ' style="'.$this->style['first'].'" ' 
							 : '';	
			
			// NEXT LINK
			$nextTagStyle = ( isset($this->style['next']) ) 
							? ' style="'.$this->style['next'].'" ' 
							: '';				   
			
			// CURRENT LINK 
			$currentLinkStyle = ( isset($this->style['current']) ) 
							    ? ' style="'.$this->style['current'].'" ' 
							    : '';
			
			// LINKS 
			$linksStyle = ( isset($this->style['links']) ) 
						  ? ' style="'.$this->style['links'].'" ' 
						  : '';
			
			// PREV
			$prevTagStyle = ( isset($this->style['prev']) ) 
							? ' style="'.$this->style['prev'].'" ' 
							: '';				   
			// -------------------------------------------------------------------------
			
			// -------------------------------------------------------------------------
			// LAST TAG 
			// -------------------------------------------------------------------------
			$lastTagNum        = $this->url.($this->totalRows - ($this->totalRows % $this->limit) - 1);
			$lastTagStyleClass = $lastTagClass.$lastTagStyle;
			
			$lastTag = '<a href="'.$lastTagNum.'"'.$lastTagStyleClass.'>'.$this->lastTag.'</a>';
			// -------------------------------------------------------------------------
						
			// -------------------------------------------------------------------------
			// FIRST TAG 
			// -------------------------------------------------------------------------
			$firstTagStyleClass = $firstTagClass.$firstTagStyle;
			
			$firstTag = '<a href="'.$this->url.'0"'.$firstTagStyleClass.'>'.$this->firstTag.'</a>';
			// -------------------------------------------------------------------------
			
			if( $startPage > 0 )
			{
				// -------------------------------------------------------------------------
				// PREV TAG 
				// -------------------------------------------------------------------------
				$firstNum = $this->url.($startPage - $this->limit );
				$fisrtStyleClass = $prevTagClass.$prevTagStyle;
				
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
				$pagIndex = @ceil( $startPage / $this->limit + 1);
			}
			
			if( $startPage < $this->totalRows - $this->limit )
			{
				// -------------------------------------------------------------------------
				// NEXT TAG 
				// -------------------------------------------------------------------------
				$lastNum = $this->url.($startPage + $this->limit);
				$lastStyleClass = $nextTagClass.$nextTagStyle;
				
				$last = '<a href="'.$lastNum.'"'.$lastStyleClass.'>'.$this->nextTag.'</a>';	
				// -------------------------------------------------------------------------				
			}
			else
			{
				$last        = '';
				$lastTag = '';
				$pagIndex   = @ceil($this->totalRows / $this->limit) - $this->countLinks + 1;
			}
			
			if( $pagIndex < 1 || $startPage == 0 ) 
			{
				$firstTag = '';
			}
			
			$nPerPage = $perPage + $pagIndex - 1;
			
			if( $nPerPage >= @ceil($this->totalRows / $this->limit) ) 
			{
				$nPerPage  = @ceil($this->totalRows / $this->limit);
				$lastTag = '';
				$last        = '';
			}
			
			$links = '';
			
			for( $i = $pagIndex; $i <= $nPerPage; $i++ )
			{
				$page = ($i - 1) * $this->limit;
				
				// Aktif sayfa linki kontrol ediliyor.		
				if( $i - 1 == $startPage / $this->limit )
				{
					$currentLink = $currentLinkClass.$currentLinkStyle;
				}
				else
				{
					$currentLink = '';	
				}
				
				// -------------------------------------------------------------------------
				// LINKS 
				// -------------------------------------------------------------------------
				$linksStyleClass = $linksClass.$linksStyle;
				
				$links .= '<a href="'.$this->url.$page.'"'.$linksStyleClass.'><span '.$currentLink.'> '.$i.'</span></a>';
				// -------------------------------------------------------------------------
			}
	
			if( $this->totalRows > $this->limit ) 
			{
				return $firstTag.' '.$first.' '.$links.' '.$last.' '.$lastTag;
			}
		}
	}
}