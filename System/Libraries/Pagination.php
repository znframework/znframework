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
	private static $total_rows 		= 0;
	
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
	private static $count_links 	= 10;
	
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
	private static $first_tag 		= '[prev]';
	
	/* Last Tag Değişkeni
	 *  
	 * Bir sonraki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[next]
	 */
	private static $last_tag 		= '[next]';
	
	/* Firstest Tag Değişkeni
	 *  
	 * En baştaki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[first]
	 */
	private static $firstest_tag 	= '[first]';
	
	/* Lastest Tag Değişkeni
	 *  
	 * En sondaki butonunun isim 
	 * bilgisini tutması için oluşturulmuştur.
	 * Varsayılan:[last]
	 */
	private static $lastest_tag 	= '[last]';
	
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
		if( isset($config['total_rows']) )	self::$total_rows 	= $config['total_rows'];
		if( isset($config['limit']) )		self::$limit 		= $config['limit'];
		if( isset($config['url']) )			self::$url 			= suffix(siteUrl($config['url']));	
		if( isset($config['count_links']) )	self::$count_links 	= $config['count_links'];
		if( isset($config['class']) )		self::$class 		= $config['class'];
		if( isset($config['style']) )		self::$style 		= $config['style'];
		if( isset($config['prev_name']) )	self::$first_tag 	= $config['prev_name'];
		if( isset($config['next_name']) )	self::$last_tag 	= $config['next_name'];
		if( isset($config['first_name']) )	self::$firstest_tag = $config['first_name'];
		if( isset($config['last_name']) )	self::$lastest_tag 	= $config['last_name'];
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
	public static function create($start = '')
	{
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
				$start_page = 0; 
			}
			else
			{ 
				// Son segment sayısal veri ise
				// başlangıç değeri olarak ayarla
				$start_page = Uri::segment(-1);
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
			$start_page = $start;
		}
		
		// Kaç adet sayfa oluşacağı belirleniyor
		// Sayfa Sayısı = Toplam Satır / Limit
		$per_page = @ceil(self::$total_rows / self::$limit);
		
		// Toplam link sayısı sayfa sayısından büyükse
		if( self::$count_links > $per_page )
		{	
			// lINKS Sayfalamada yer alacak linkler oluşturuluyor.
			// LINKS -------------------------------------------------------------------	
			for($i = 1; $i <= $per_page; $i++)
			{
				$page = ($i - 1) * self::$limit;
				
				// Kontrolere göre varsa stil veya sınıf verileri ekleniyor.
				
				if( $i - 1 == $start_page / self::$limit )
				{
					$current_link = ( isset(self::$class['current']) ) 
									? 'class="'.self::$class['current'].'"' 
									: "";
					
					$current_link_style = ( isset(self::$style['current']) ) 
					                      ? 'style="'.self::$style['current'].'"' 
										  : "";
				}
				else
				{
					$current_link = '';	
					$current_link_style = '';	
				}
				
				$class_links = ( isset(self::$class['links']) ) 
							   ? 'class="'.self::$class['links'].'"' 
							   : "";
							   
				$style_links = ( isset(self::$style['links']) ) 
							   ? 'style="'.self::$style['links'].'"' 
							   : "";
							   
				$links .= '<a href="'.self::$url.$page.'" '.$class_links.' '.$style_links.'><span '.$current_link.' '.$current_link_style.'> '.$i.'</span></a>';
			}
			// LINKS -------------------------------------------------------------------
			
			// PREV Sonraki butonu ile ilgili kontrol yapılıyor.
			// PREV TAG ---------------------------------------------------------------	
			if( $start_page != 0 )
			{
				$class_prev = ( isset(self::$class['prev']) ) 
							  ? 'class="'.self::$class['prev'].'"' 
							  : "";
				
				$style_prev = ( isset(self::$style['prev']) ) 
							  ? 'style="'.self::$style['prev'].'"' 
							  : "";
							  
				$first = '<a href="'.self::$url.($start_page - self::$limit ).'" '.$class_prev .' '.$style_prev.'>'.self::$first_tag.'</a>';
			}
			else
			{
				$first = '';	
			}
			// PREV TAG ---------------------------------------------------------------	
			
			// NEXT Sonraki butonu ile ilgili kontrol yapılıyor.
			// NEXT TAG ---------------------------------------------------------------			
			if( $start_page != $page )
			{
				$class_next = ( isset(self::$class['next']) ) 
							  ? 'class="'.self::$class['next'].'"' 
							  : "";

				$style_next = ( isset(self::$style['next']) ) 
							  ? 'style="'.self::$style['next'].'"' 
							  : "";
				
				$last_url   = self::$url.($start_page + self::$limit);
				$last_stcl  = $class_next.' '.$style_next;
							  
				$last = '<a href="'.$last_url.'" '.$last_stcl.'>'.self::$last_tag.'</a>';
			}
			else
			{
				$last = '';	
			}
			// NEXT TAG ---------------------------------------------------------------	
			
			if( self::$total_rows > self::$limit ) 
			{
				return $first.' '.$links.' '.$last;
			}
		}
		else
		{
			
			$per_page = self::$count_links;
			
			// Linkler için class kontrolleri sağlanıyor. ------------------------------
			
			// LAST LINK
			$lastest_tag_class = ( isset(self::$class['last']) ) 
								 ? ' class="'.self::$class['last'].'" ' 
								 : '';
			
			// FIRST LINK
			$firstest_tag_class = ( isset(self::$class['first']) ) 
								  ? ' class="'.self::$class['first'].'" ' 
								  : '';
			
			// NEXT LINK
			$last_tag_class = ( isset(self::$class['next']) ) 
							  ? ' class="'.self::$class['next'].'" ' 
							  : '';
			
			// CURRENT LINK 
			$current_link_class = ( isset(self::$class['current']) ) 
								  ? ' class="'.self::$class['current'].'" ' 
								  : '';
			
			// LINKS 					  
			$links_class = ( isset(self::$class['links']) ) 
						   ? ' class="'.self::$class['links'].'" ' 
						   : '';
			
			// PREV 					  
			$first_tag_class = ( isset(self::$class['prev']) ) 
							   ? ' class="'.self::$class['prev'].'" ' 
							   : '';					 
			// -------------------------------------------------------------------------
			
			// Linkler için style kontrolleri sağlanıyor. ------------------------------
			
			// LAST LINK
			$lastest_tag_style = ( isset(self::$style['last']) ) 
							   ? ' style="'.self::$style['last'].'" ' 
							   : '';
			
			// FIRST LINK
			$firstest_tag_style = ( isset(self::$style['first']) ) 
							   ? ' style="'.self::$style['first'].'" ' 
							   : '';	
			
			// NEXT LINK
			$last_tag_style = ( isset(self::$style['next']) ) 
							   ? ' style="'.self::$style['next'].'" ' 
							   : '';				   
			
			// CURRENT LINK 
			$current_link_style = ( isset(self::$style['current']) ) 
							   ? ' style="'.self::$style['current'].'" ' 
							   : '';
			
			// LINKS 
			$links_style = ( isset(self::$style['links']) ) 
							   ? ' style="'.self::$style['links'].'" ' 
							   : '';
			
			// PREV
			$first_tag_style = ( isset(self::$style['prev']) ) 
							   ? ' style="'.self::$style['prev'].'" ' 
							   : '';				   
			// -------------------------------------------------------------------------
			
			// -------------------------------------------------------------------------
			// LAST TAG 
			// -------------------------------------------------------------------------
			$lastest_tag_num         = self::$url.(self::$total_rows - (self::$total_rows % self::$limit) - 1);
			$lastest_tag_style_class = $lastest_tag_class.$lastest_tag_style;
			
			$lastest_tag = '<a href="'.$lastest_tag_num.'"'.$lastest_tag_style_class.'>'.self::$lastest_tag.'</a>';
			// -------------------------------------------------------------------------
						
			// -------------------------------------------------------------------------
			// FIRST TAG 
			// -------------------------------------------------------------------------
			$firstest_tag_style_class = $firstest_tag_class.$firstest_tag_style;
			
			$firstest_tag = '<a href="'.self::$url.'0"'.$firstest_tag_style_class.'>'.self::$firstest_tag.'</a>';
			// -------------------------------------------------------------------------
			
			if( $start_page > 0 )
			{
				// -------------------------------------------------------------------------
				// PREV TAG 
				// -------------------------------------------------------------------------
				$first_num = self::$url.($start_page - self::$limit );
				$fisrt_style_class = $first_tag_class.$first_tag_style;
				
				$first = '<a href="'.$first_num.'"'.$fisrt_style_class.'>'.self::$first_tag.'</a>';				
				// -------------------------------------------------------------------------
			}
			else
			{
				$first = '';	
			}
			
			if( ($start_page / self::$limit) == 0 ) 
			{
				$pag_index = 1; 
			}
			else 
			{
				$pag_index = @ceil( $start_page / self::$limit + 1);
			}
			
			if( $start_page < self::$total_rows - self::$limit )
			{
				// -------------------------------------------------------------------------
				// NEXT TAG 
				// -------------------------------------------------------------------------
				$last_num = self::$url.($start_page + self::$limit);
				$last_style_class = $last_tag_class.$last_tag_style;
				
				$last = '<a href="'.$last_num.'"'.$last_style_class.'>'.self::$last_tag.'</a>';	
				// -------------------------------------------------------------------------				
			}
			else
			{
				$last        = '';
				$lastest_tag = '';
				$pag_index   = @ceil(self::$total_rows / self::$limit) - self::$count_links + 1;
			}
			
			if( $pag_index < 1 || $start_page == 0 ) 
			{
				$firstest_tag = '';
			}
			
			$n_per_page = $per_page + $pag_index - 1;
			
			if( $n_per_page >= @ceil(self::$total_rows / self::$limit) ) 
			{
				$n_per_page  = @ceil(self::$total_rows / self::$limit);
				$lastest_tag = '';
				$last        = '';
			}
			
			$links = '';
			
			for($i = $pag_index; $i <= $n_per_page; $i++)
			{
				$page = ($i - 1) * self::$limit;
				
				// Aktif sayfa linki kontrol ediliyor.		
				if( $i - 1 == $start_page / self::$limit )
				{
					$current_link = $current_link_class.$current_link_style;
				}
				else
				{
					$current_link = '';	
				}
				
				// -------------------------------------------------------------------------
				// LINKS 
				// -------------------------------------------------------------------------
				$links_style_class = $links_class.$links_style;
				
				$links .= '<a href="'.self::$url.$page.'"'.$links_style_class.'><span '.$current_link.'> '.$i.'</span></a>';
				// -------------------------------------------------------------------------
			}
	
			if( self::$total_rows > self::$limit ) 
			{
				return $firstest_tag.' '.$first.' '.$links.' '.$last.' '.$lastest_tag;
			}
		}
	}
}