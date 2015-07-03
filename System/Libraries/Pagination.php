<?php 
/************************************************************/
/*                       CLASS PAGINATION                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* PAGINATION                                                                           	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	pagination:: , $this->pagination , uselib('pagination')->     |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Pagination
{
	/* Total Rows Değişkeni
	 *  
	 * Toplam satır sayısı bilgisini
	 * tutması için oluşturulmuştur.
	 * Varsayılan:0
	 */
	private static $totalRows 		= 0;
	
	/* Limit Değişkeni
	 *  
	 * Bir sayfada görüntülenmesi istenilen kayıt limit
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:0
	 */
	private static $limit 			= 0;
	
	/* Count Links Değişkeni
	 *  
	 * Sayfalama nesnesinde olması gereken link sayısı
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:10
	 */
	private static $countLinks 	= 10;
	
	/* Class Dizi Değişkeni
	 *  
	 * Sayfalama nesnesine eklenecek css sınıf
	 * bilgisini tutması için oluşturulmuştur.
	 * 
	 */
	private static $class			= array();
	
	/* Style Dizi Değişkeni
	 *  
	 * Sayfalama nesnesine eklenecek stil
	 * bilgisini tutması için oluşturulmuştur.
	 * 
	 */
	private static $style			= array();
	
	/* First Tag Değişkeni
	 *  
	 * Bir önceki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[prev]
	 */
	private static $prevTag 		= '[prev]';
	
	/* Last Tag Değişkeni
	 *  
	 * Bir sonraki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[next]
	 */
	private static $nextTag 		= '[next]';
	
	/* Firstest Tag Değişkeni
	 *  
	 * En baştaki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[first]
	 */
	private static $firstTag 	= '[first]';
	
	/* Lastest Tag Değişkeni
	 *  
	 * En sondaki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[last]
	 */
	private static $lastTag 	= '[last]';
	
	/* Url Tag Değişkeni
	 *  
	 * Sayfalama nesnesinin çalıştırılacağı url
	 * bilgisini tutması için oluşturulmuştur.
	 */
	private static $url;
	
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
	public static function settings($config = array())
	{
		// Parametre kontrolü yapılıyor. ---------------------------------------------------------
		if( ! is_array($config) ) 
		{
			return false;
		}
		// ---------------------------------------------------------------------------------------
		// Sayfalama Ayarlarını İçeren Değişkenler
		// ---------------------------------------------------------------------------------------
		if( isset($config['totalRows']) )	self::$totalRows 	= $config['totalRows'];
		if( isset($config['limit']) )		self::$limit 		= $config['limit'];
		if( isset($config['url']) )			self::$url 			= suffix(siteUrl($config['url']));	
		if( isset($config['countLinks']) )	self::$countLinks 	= $config['countLinks'];
		if( isset($config['class']) )		self::$class 		= $config['class'];
		if( isset($config['style']) )		self::$style 		= $config['style'];
		if( isset($config['prevName']) )	self::$prevTag 		= $config['prevName'];
		if( isset($config['nextName']) )	self::$nextTag 		= $config['nextName'];
		if( isset($config['firstName']) )	self::$firstTag 	= $config['firstName'];
		if( isset($config['lastName']) )	self::$lastTag 		= $config['lastName'];
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
	public static function create($start = '', $settings = array())
	{
		if( ! empty($settings) )
		{
			self::settings($settings);	
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
		$perPage = @ceil(self::$totalRows / self::$limit);
		
		// Toplam link sayısı sayfa sayısından büyükse
		if( self::$countLinks > $perPage )
		{	
			// lINKS Sayfalamada yer alacak linkler oluşturuluyor.
			// LINKS -------------------------------------------------------------------	
			for($i = 1; $i <= $perPage; $i++)
			{
				$page = ($i - 1) * self::$limit;
				
				// Kontrolere göre varsa stil veya sınıf verileri ekleniyor.
				
				if( $i - 1 == $startPage / self::$limit )
				{
					$currentLink = ( isset(self::$class['current']) ) 
								 ? 'class="'.self::$class['current'].'"' 
								 : "";
					
					$currentLinkStyle = ( isset(self::$style['current']) ) 
					                  ? 'style="'.self::$style['current'].'"' 
								      : "";
				}
				else
				{
					$currentLink = '';	
					$currentLinkStyle = '';	
				}
				
				$classLinks = ( isset(self::$class['links']) ) 
							  ? 'class="'.self::$class['links'].'"' 
							  : "";
							   
				$styleLinks = ( isset(self::$style['links']) ) 
							  ? 'style="'.self::$style['links'].'"' 
							  : "";
							   
				$links .= '<a href="'.self::$url.$page.'" '.$classLinks.' '.$styleLinks.'><span '.$currentLink.' '.$currentLinkStyle.'> '.$i.'</span></a>';
			}
			// LINKS -------------------------------------------------------------------
			
			// PREV Sonraki butonu ile ilgili kontrol yapılıyor.
			// PREV TAG ---------------------------------------------------------------	
			if( $startPage != 0 )
			{
				$classPrev = ( isset(self::$class['prev']) ) 
							 ? 'class="'.self::$class['prev'].'"' 
							 : "";
				
				$stylePrev = ( isset(self::$style['prev']) ) 
							 ? 'style="'.self::$style['prev'].'"' 
							 : "";
							  
				$first = '<a href="'.self::$url.($startPage - self::$limit ).'" '.$classPrev .' '.$stylePrev.'>'.self::$prevTag.'</a>';
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
				$classNext = ( isset(self::$class['next']) ) 
							 ? 'class="'.self::$class['next'].'"' 
							 : "";

				$styleNext = ( isset(self::$style['next']) ) 
							 ? 'style="'.self::$style['next'].'"' 
							 : "";
				
				$lastUrl   = self::$url.($startPage + self::$limit);
				$lastStcl  = $classNext.' '.$styleNext;
							  
				$last = '<a href="'.$lastUrl.'" '.$lastStcl.'>'.self::$nextTag.'</a>';
			}
			else
			{
				$last = '';	
			}
			// NEXT TAG ---------------------------------------------------------------	
			
			if( self::$totalRows > self::$limit ) 
			{
				return $first.' '.$links.' '.$last;
			}
		}
		else
		{
			
			$perPage = self::$countLinks;
			
			// Linkler için class kontrolleri sağlanıyor. ------------------------------
			
			// LAST LINK
			$lastTagClass = ( isset(self::$class['last']) ) 
							? ' class="'.self::$class['last'].'" ' 
							: '';
			
			// FIRST LINK
			$firstTagClass = ( isset(self::$class['first']) ) 
						     ? ' class="'.self::$class['first'].'" ' 
							 : '';
			
			// NEXT LINK
			$nextTagClass = ( isset(self::$class['next']) ) 
							? ' class="'.self::$class['next'].'" ' 
							: '';
			
			// CURRENT LINK 
			$currentLinkClass = ( isset(self::$class['current']) ) 
								? ' class="'.self::$class['current'].'" ' 
								: '';
			
			// LINKS 					  
			$linksClass = ( isset(self::$class['links']) ) 
						  ? ' class="'.self::$class['links'].'" ' 
						  : '';
			
			// PREV 					  
			$prevTagClass = ( isset(self::$class['prev']) ) 
							? ' class="'.self::$class['prev'].'" ' 
							: '';					 
			// -------------------------------------------------------------------------
			
			// Linkler için style kontrolleri sağlanıyor. ------------------------------
			
			// LAST LINK
			$lastTagStyle = ( isset(self::$style['last']) ) 
							? ' style="'.self::$style['last'].'" ' 
							: '';
			
			// FIRST LINK
			$firstTagStyle = ( isset(self::$style['first']) ) 
							 ? ' style="'.self::$style['first'].'" ' 
							 : '';	
			
			// NEXT LINK
			$nextTagStyle = ( isset(self::$style['next']) ) 
							? ' style="'.self::$style['next'].'" ' 
							: '';				   
			
			// CURRENT LINK 
			$currentLinkStyle = ( isset(self::$style['current']) ) 
							    ? ' style="'.self::$style['current'].'" ' 
							    : '';
			
			// LINKS 
			$linksStyle = ( isset(self::$style['links']) ) 
						  ? ' style="'.self::$style['links'].'" ' 
						  : '';
			
			// PREV
			$prevTagStyle = ( isset(self::$style['prev']) ) 
							? ' style="'.self::$style['prev'].'" ' 
							: '';				   
			// -------------------------------------------------------------------------
			
			// -------------------------------------------------------------------------
			// LAST TAG 
			// -------------------------------------------------------------------------
			$lastTagNum        = self::$url.(self::$totalRows - (self::$totalRows % self::$limit) - 1);
			$lastTagStyleClass = $lastTagClass.$lastTagStyle;
			
			$lastTag = '<a href="'.$lastTagNum.'"'.$lastTagStyleClass.'>'.self::$lastTag.'</a>';
			// -------------------------------------------------------------------------
						
			// -------------------------------------------------------------------------
			// FIRST TAG 
			// -------------------------------------------------------------------------
			$firstTagStyle_class = $firstTagClass.$firstTagStyle;
			
			$firstTag = '<a href="'.self::$url.'0"'.$firstTagStyle_class.'>'.self::$firstTag.'</a>';
			// -------------------------------------------------------------------------
			
			if( $startPage > 0 )
			{
				// -------------------------------------------------------------------------
				// PREV TAG 
				// -------------------------------------------------------------------------
				$firstNum = self::$url.($startPage - self::$limit );
				$fisrtStyleClass = $prevTagClass.$prevTagStyle;
				
				$first = '<a href="'.$firstNum.'"'.$fisrtStyleClass.'>'.self::$prevTag.'</a>';				
				// -------------------------------------------------------------------------
			}
			else
			{
				$first = '';	
			}
			
			if( ($startPage / self::$limit) == 0 ) 
			{
				$pagIndex = 1; 
			}
			else 
			{
				$pagIndex = @ceil( $startPage / self::$limit + 1);
			}
			
			if( $startPage < self::$totalRows - self::$limit )
			{
				// -------------------------------------------------------------------------
				// NEXT TAG 
				// -------------------------------------------------------------------------
				$lastNum = self::$url.($startPage + self::$limit);
				$lastStyleClass = $nextTagClass.$nextTagStyle;
				
				$last = '<a href="'.$lastNum.'"'.$lastStyleClass.'>'.self::$nextTag.'</a>';	
				// -------------------------------------------------------------------------				
			}
			else
			{
				$last        = '';
				$lastTag = '';
				$pagIndex   = @ceil(self::$totalRows / self::$limit) - self::$countLinks + 1;
			}
			
			if( $pagIndex < 1 || $startPage == 0 ) 
			{
				$firstTag = '';
			}
			
			$nPerPage = $perPage + $pagIndex - 1;
			
			if( $nPerPage >= @ceil(self::$totalRows / self::$limit) ) 
			{
				$nPerPage  = @ceil(self::$totalRows / self::$limit);
				$lastTag = '';
				$last        = '';
			}
			
			$links = '';
			
			for($i = $pagIndex; $i <= $nPerPage; $i++)
			{
				$page = ($i - 1) * self::$limit;
				
				// Aktif sayfa linki kontrol ediliyor.		
				if( $i - 1 == $startPage / self::$limit )
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
				
				$links .= '<a href="'.self::$url.$page.'"'.$linksStyleClass.'><span '.$currentLink.'> '.$i.'</span></a>';
				// -------------------------------------------------------------------------
			}
	
			if( self::$totalRows > self::$limit ) 
			{
				return $firstTag.' '.$first.' '.$links.' '.$last.' '.$lastTag;
			}
		}
	}
}