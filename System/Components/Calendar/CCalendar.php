<?php
/************************************************************/
/*                    CALENDAR COMPONENT                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Calendar;

use Config;
use Uri;
/******************************************************************************************
* CALENDAR                                                                                *
*******************************************************************************************
| Dahil(Import) Edilirken : CCalendar           							     		  |
| Sınıfı Kullanırken      :	$this->ccalendar->     					   				      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class CCalendar
{
	/* Css Değişkeni
	 *  
	 * Css sınıf bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $css;
	
	/* Style Değişkeni
	 *  
	 * Stil bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $style;
	
	/* Month Names Değişkeni
	 *  
	 * Ay isimleri bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $month_names = 'long';
	
	/* Day Names Değişkeni
	 *  
	 * Gün isimleri bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $day_names = 'short';
	
	/* Prev Değişkeni
	 *  
	 * Önceki link bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $prev = '<<';
	
	/* Next Değişkeni
	 *  
	 * Sonraki link bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $next = '>>';
	
	/* Url Değişkeni
	 *  
	 * Bağlantı sağlanacak url bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $url;
	
	/* Config Değişkeni
	 *  
	 * Ayarlar bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $config;

	// CONSTRUCT yapıcısı çalıştırılırken
	// varsayılan olarak aşağıdaki ayarları kullan.
	public function __construct()
	{
		$this->config = config::get('Calendar');
	}
	
	/******************************************************************************************
	* URL                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Takvimin bağlantı kurucağı url adresi.					              |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @url => Url adresi.					          							  |
	|          																				  |
	| Örnek Kullanım: ->url('anasayfa/takvim')  // http://....../anasyfa/takvim/2015/01       |
	|          																				  |
	******************************************************************************************/
	public function url($url = '')
	{
		if( ! is_url($url) )
		{
			$url = site_url($url);	
		}
		
		$this->url = $url;
		
		return $this;
	}
	
	/******************************************************************************************
	* NAME TYPE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Ay ve günler için normal isimlerini mi yoksa kısaltılmış isimlerin mi	  |
	| kullanılacağını belirlemek için kullanılır.					                          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @day => Gün için kısaltılıp kısaltılmayacağını belirten parametredir.	  |
	| Varsayılan:short. Yani kısaltılmış günler kullanılsın.							      |
	| 2. string var @month => Ay için kısaltılıp kısaltılmayacağını belirten parametredir.	  |
	| Varsayılan:long. Yani normal ay ismi kullanılsın.							              |
	|          																				  |
	| Parametreler 2 değer alır: short, long         										  |
	|          																				  |
	| Örnek Kullanım: ->name_type('short', 'short')  // Çar, Oca							  |
	|          																				  |
	******************************************************************************************/
	public function name_type($day = 'short', $month = 'long')
	{
		if( ! ( is_string($day) && is_string($month) ) )	
		{
			return $this;	
		}
		
		$this->day_names   = $day;	

		$this->month_names = $month;	
	
		return $this;
	}
	
	/******************************************************************************************
	* CSS                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Takvime css sınıfları uygulamak için kullanılır.					      |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @css => Uygulanacak css sınıfları parametresidir.					      |
	|          																				  |
	| Örnek Kullanım: ->css( array('current' => 'red-color, bold') ) 						  |
	|          																				  |
	| Class Uygulanabilecek Eleman İsimleri 												  |
	| 1-current: Aktif gün için         													  |
	| 2-days: Günlerin sıralandığı hücreler için         									  |
	| 3-month_name: Ayın ve Tarihin yer aldığı hücreler için         						  |
	| 4-day_name: Gün isimlerinin yer aldığı hücreler için  								  |
	| 5-links: İleri ve geri butonu için         											  |
	|          																				  |
	******************************************************************************************/
	public function css($css = array())
	{
		if( ! is_array($css) )
		{
			return $this;	
		}
		
		$this->css = $css;
		
		return $this;
	}
	
	/******************************************************************************************
	* STYLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Takvime stiller uygulamak için kullanılır.					          |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @style => Uygulanacak css sınıfları parametresidir.					      |
	|          																				  |
	| Örnek Kullanım: ->style( array('current' => 'color:red') ) 						      |
	|          																				  |
	| Stil Uygulanabilecek Eleman İsimleri 												  	  |
	| 1-current: Aktif gün için         													  |
	| 2-days: Günlerin sıralandığı hücreler için         									  |
	| 3-month_name: Ayın ve Tarihin yer aldığı hücreler için         						  |
	| 4-day_name: Gün isimlerinin yer aldığı hücreler için  								  |
	| 5-links: İleri ve geri butonu için         											  |
	|          																				  |
	******************************************************************************************/
	public function style($style = array())
	{
		if( ! is_array($style) )
		{
			return $this;	
		}
		
		$this->style = $style;
		
		return $this;
	}
	
	/******************************************************************************************
	* LINK NAMES                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Takvimde yer alan iler ve geri butonu linklerinin isimlerini			  |
	| değiştirmek için kulanılır.					          								  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @prev => Önceki linkinin ismi. Varsayılan:<<						      |
	| 2. string var @next => Sonraki linkinin ismi. Varsayılan:>>						      |
	|          																				  |
	| Örnek Kullanım: ->link_names('Önceki', 'Sonraki') 									  |
	|          																				  |
	******************************************************************************************/
	public function link_names($prev = '<<', $next = '>>')
	{
		if( ! ( is_string($prev) && is_string($next) ) )	
		{
			return $this;	
		}
		
		if( ! empty($prev) )
		{
			$this->prev = $prev;
		}
		
		if( ! empty($next) )
		{
			$this->next = $next;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Takvimin oluşturulması için kullanılan son yöntemdir.					  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. numeric var @year => Yıl bilgisi:						     						  |
	| 2. numeric var @month => Ayın indeks bilgisi. 					      				  |
	|          																				  |
	| Örnek Kullanım: ->create( uri::get('date'), uri::get('date', 2) ); 					  |
	|          																				  |
	******************************************************************************************/
	public function create($year = NULL, $month = NULL)
	{	
		// Gün, ay ve yıl bilgilerini alınıyor.
		$today = getdate();
		
		// Eğer parametreler boş ise
		// Varsayılan olarak URL adresinin
		// Son iki segmentini kullan
		// Son segment ay bilgisini
		// Sondan bir önceki segmen 
		// yıl bilgisini tutmaktadır.
		if( $month === NULL && $year === NULL) 
		{
			if( ! is_numeric(uri::segment(-1)) )
			{ 
				$month = $today['mon']; 
			}
			else
			{ 
				$month = uri::segment(-1);
			}
			
			if( ! is_numeric(uri::segment(-2)) )
			{ 
				$year = $today['year']; 
			}
			else
			{ 
				$year = uri::segment(-2);
			}
		}
		else 
		{
			if( ! is_numeric($month) ) 
			{
				$month = $today['mon'];
			}			
			if( ! is_numeric($year) ) 
			{
				$year = $today['year'];
			}	
		}
		
		// Ay 0 değerine ulaştığında
		if( $month < 1 )
		{
			$month = 12;
			$year--;	
		}
		// Ay 13 değerine ulaştığında
		elseif( $month > 12 )
		{
			$month = 1;
			$year++;	
		}
		
		// Ay ismini sitenin aktif
		// diline göre ayarlar. 
		
		
		if( $this->month_names === 'long' )
		{
			$month_names = array_keys($this->config['month_names'][get_lang()]);
		}
		else
		{
			$month_names = array_values($this->config['month_names'][get_lang()]);
		}
		
		$monthname = $month_names[$month - 1];
		// Gün ismini sitenin aktif
		// diline göre ayarlar.
		$daynames  = ( $this->day_names === 'long' )
					 ? array_keys($this->config['day_names'][get_lang()])
					 : array_values($this->config['day_names'][get_lang()]);
		
		// Belirtilen ayarlamara göre tarih bilgisi elde ediliyor.
		$first_day = getdate( mktime(0, 0, 0, $month, 1, $year) );
		$last_day  = getdate( mktime(0, 0, 0, $month + 1, 0, $year));
		
		// TABLO İÇİN CSS
		$table_class = ( isset($this->css['table']) )
					   ? ' class="'.$this->css['table'].'"'
					   : '';
		// TABLO İÇİN STYLE	
		$table_style = ( isset($this->style['table']) )
					   ? ' style="'.$this->style['table'].'"'
					   : '';
		// AY VE TARİH SÜTUNU İÇİN	CSS	   
		$month_row_class =   ( isset($this->css['month_name']) )
					     ? ' class="'.$this->css['month_name'].'"'
					     : '';
		// AY VE TARİH SÜTUNU İÇİN	STYLE			
		$month_row_style =   ( isset($this->style['month_name']) )
					     ? ' style="'.$this->style['month_name'].'"'
					     : '';
		// GÜN SÜTUNU İÇİN	CSS	
		$day_row_class =   ( isset($this->css['day_name']) )
					     ? ' class="'.$this->css['day_name'].'"'
					     : '';
		// GÜN SÜTUNU İÇİN	STYLE			
		$day_row_style = ( isset($this->style['day_name']) )
					     ? ' style="'.$this->style['day_name'].'"'
					     : '';
		// GÜN SAYILARI SÜTUNLARI İÇİN	CSS	
		$rows_class =   ( isset($this->css['days']) )
					     ? ' class="'.$this->css['days'].'"'
					     : '';
		// GÜN SAYILARI SÜTUNLARI İÇİN	STYLE			
		$rows_style = ( isset($this->style['days']) )
					     ? ' style="'.$this->style['days'].'"'
					     : '';
		// ÖNCEKİ VE SONRAKİ LİNKLERİ İÇİN	CSS					 
		$button_class = ( isset($this->css['links']) )
					  ? ' class="'.$this->css['links'].'"'
					  : '';
		// ÖNCEKİ VE SONRAKİ LİNKLERİ İÇİN	STYLE		
		$button_style = ( isset($this->style['links']) )
					  ? ' style="'.$this->style['links'].'"'
					  : '';
		
		// Önceki linki oluşturuluyor.
		$prev = "<a href='". suffix($this->url) . $year. "/". ( $month - 1 ) ."' {$button_class}{$button_style}>$this->prev</a>";
		// Sonraki linki oluşturuluyor.
		$next = "<a href='". suffix($this->url) . $year. "/". ( $month + 1 ) ."' {$button_class}{$button_style}>$this->next</a>";
		
		/************************************************************ CALENDAR *******************************************************************/			 
		$str  = "<table{$table_class}{$table_style}>".ln();
		// Ay - Tarih Satırı
		$str .= "\t<tr>".ln()."\t\t<th{$month_row_class}{$month_row_style} colspan=\"7\">{$prev} {$monthname} - {$year} {$next}</th></tr>".ln();
		$str .= "\t<tr>".ln();
		
		// Gün İsimleri Satırı
		foreach($daynames as $day)
		{
			$str .= "\t\t<td{$day_row_class}{$day_row_style}>$day</td>".ln();
		}
		
		$str .= "\t<tr>".ln();
		
		if( $first_day['wday'] == 0 ) 
		{
			$first_day['wday'] = 7;
		}
		
		// Günler Satırı
		for($i=1; $i<$first_day['wday']; $i++)
		{
			$str .= "\t\t<td{$rows_class}{$rows_style}>&nbsp;</td>".ln();
		}
		
		$active_day = 0;
		
		for($i = $first_day['wday']; $i<=7; $i++)
		{
			$active_day++;
			
			// Aktif gün için stil ve css kullanımı.
			if( $active_day == $today['mday'] ) 
			{
				$class = ( isset($this->css['current']) )
						 ? ' class="'.$this->css['current'].'"'
						 : '';
				
				$style = ( isset($this->style['current']) )
						 ? ' style="'.$this->style['current'].'"'
						 : '';
			} 
			else 
			{
				$class = ( isset($this->css['days']) )
						 ? ' class="'.$this->css['days'].'"'
						 : '';
				
				$style = ( isset($this->style['days']) )
						 ? ' style="'.$this->style['days'].'"'
						 : '';
			}
			
			$str .= "\t\t<td{$class}{$style}>$active_day</td>".ln();
		}
		$str .= "\t</tr>".ln();
		

		$week_count = floor(($last_day ['mday'] - $active_day) / 7);
		
		for ($i=0; $i<$week_count; $i++)
		{
			$str .= "\t<tr>";
			
			for($j=0; $j<7; $j++)
			{
				$active_day++;
				// Aktif gün için stil ve css kullanımı.
				if ( $active_day == $today['mday'] ) 
				{
					$class = ( isset($this->css['current']) )
							 ? ' class="'.$this->css['current'].'"'
							 : '';
				
					$style = ( isset($this->style['current']) )
							 ? ' style="'.$this->style['current'].'"'
							 : '';
				} 
				else 
				{
					$class = ( isset($this->css['days']) )
							 ? ' class="'.$this->css['days'].'"'
							 : '';
				
					$style = ( isset($this->style['days']) )
							 ? ' style="'.$this->style['days'].'"'
							 : '';
				}
				$str .= "\t\t<td{$class}{$style}>$active_day</td>".ln();
			}
			$str .= "\t</tr>".ln();
		}
		
	
		if( $active_day < $last_day['mday'] )
		{
			$str .= "\t<tr>".ln();
			
			for ($i=0; $i<7; $i++)
			{
				$active_day++;
				// Aktif gün için stil ve css kullanımı.
				if( $active_day == $today['mday'] ) 
				{
					$class = ( isset($this->css['current']) )
							 ? ' class="'.$this->css['current'].'"'
							 : '';
				
					$style = ( isset($this->style['current']) )
							 ? ' style="'.$this->style['current'].'"'
							 : '';
				} 
				else 
				{
					$class = ( isset($this->css['days']) )
							 ? ' class="'.$this->css['days'].'"'
							 : '';
				
					$style = ( isset($this->style['days']) )
							 ? ' style="'.$this->style['days'].'"'
							 : '';
				}
				
				if( $active_day <= $last_day ['mday'] )
				{
					$str .= "\t\t<td{$class}{$style}>$active_day</td>".ln();
				}
				else 
				{
					$str .= "\t\t<td{$class}{$style}>&nbsp;</td>".ln();
				}
			}			
			$str .= "\t</tr>".ln();
		}
		
		$str .= "</table>";
		
		$this->_default_variables();
		/************************************************************ CALENDAR *******************************************************************/	
		
		return $str;
	}
	
	// Değişkenler default ayarlarına getiriliyor.
	protected function _default_variables()
	{
		if( ! empty($this->css) ) 			$this->css = NULL;
		if( ! empty($this->style) ) 		$this->style = NULL;
		if( ! empty($this->month_names) ) 	$this->month_names = NULL;
		if( ! empty($this->day_names) ) 	$this->day_names = NULL;
		if( $this->prev !== '<<' ) 			$this->prev = '<<';
		if( $this->next !== '>>' ) 			$this->next = '>>';
		if( ! empty($this->url) ) 			$this->url = NULL;
		if( ! empty($this->config) ) 		$this->config = NULL;
	}
}