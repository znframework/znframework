<?php
class StaticCCalendar
{
	/***********************************************************************************/
	/* CALENDAR COMPONENT		     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CCalendar
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->ccalendar, zn::$use->ccalendar, uselib('ccalendar')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
	protected $monthNames = 'long';
	
	/* Day Names Değişkeni
	 *  
	 * Gün isimleri bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $dayNames = 'short';
	
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
		$this->config = Config::get('Calendar');
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
		if( ! isUrl($url) )
		{
			$url = siteUrl($url);	
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
	| Örnek Kullanım: ->nameType('short', 'short')  // Çar, Oca								  |
	|          																				  |
	******************************************************************************************/
	public function nameType($day = 'short', $month = 'long')
	{
		if( ! ( is_string($day) && is_string($month) ) )	
		{
			return $this;	
		}
		
		$this->dayNames   = $day;	

		$this->monthNames = $month;	
	
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
	| 3-monthName: Ayın ve Tarihin yer aldığı hücreler için         						  |
	| 4-dayName: Gün isimlerinin yer aldığı hücreler için  									  |
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
	| 3-monthName: Ayın ve Tarihin yer aldığı hücreler için         						  |
	| 4-dayName: Gün isimlerinin yer aldığı hücreler için  									  |
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
	| Örnek Kullanım: ->linkNames('Önceki', 'Sonraki') 									  |
	|          																				  |
	******************************************************************************************/
	public function linkNames($prev = '<<', $next = '>>')
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
	| Örnek Kullanım: ->create( Uri::get('date'), Uri::get('date', 2) ); 					  |
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
		if( $month === NULL && $year === NULL ) 
		{
			if( ! is_numeric(Uri::segment(-1)) )
			{ 
				$month = $today['mon']; 
			}
			else
			{ 
				$month = Uri::segment(-1);
			}
			
			if( ! is_numeric(Uri::segment(-2)) )
			{ 
				$year = $today['year']; 
			}
			else
			{ 
				$year = Uri::segment(-2);
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
		
		
		if( $this->monthNames === 'long' )
		{
			$monthNames = array_keys($this->config['monthNames'][getLang()]);
		}
		else
		{
			$monthNames = array_values($this->config['monthNames'][getLang()]);
		}
		
		$monthName = $monthNames[$month - 1];
		// Gün ismini sitenin aktif
		// diline göre ayarlar.
		$dayNames  = ( $this->dayNames === 'long' )
					 ? array_keys($this->config['dayNames'][getLang()])
					 : array_values($this->config['dayNames'][getLang()]);
		
		// Belirtilen ayarlamara göre tarih bilgisi elde ediliyor.
		$firstDay = getdate( mktime(0, 0, 0, $month, 1, $year) );
		$lastDay  = getdate( mktime(0, 0, 0, $month + 1, 0, $year));
		
		// TABLO İÇİN CSS
		$tableClass = ( isset($this->css['table']) )
					  ? ' class="'.$this->css['table'].'"'
					  : '';
		// TABLO İÇİN STYLE	
		$tableStyle = ( isset($this->style['table']) )
					  ? ' style="'.$this->style['table'].'"'
					  : '';
		// AY VE TARİH SÜTUNU İÇİN	CSS	   
		$monthRowClass = ( isset($this->css['monthName']) )
					     ? ' class="'.$this->css['monthName'].'"'
					     : '';
		// AY VE TARİH SÜTUNU İÇİN	STYLE			
		$monthRowStyle = ( isset($this->style['monthName']) )
					     ? ' style="'.$this->style['monthName'].'"'
					     : '';
		// GÜN SÜTUNU İÇİN	CSS	
		$dayRowClass = ( isset($this->css['dayName']) )
					   ? ' class="'.$this->css['dayName'].'"'
					   : '';
		// GÜN SÜTUNU İÇİN	STYLE			
		$dayRowStyle = ( isset($this->style['dayName']) )
					   ? ' style="'.$this->style['dayName'].'"'
					   : '';
		// GÜN SAYILARI SÜTUNLARI İÇİN	CSS	
		$rowsClass = ( isset($this->css['days']) )
					 ? ' class="'.$this->css['days'].'"'
					 : '';
		// GÜN SAYILARI SÜTUNLARI İÇİN	STYLE			
		$rowsStyle = ( isset($this->style['days']) )
					 ? ' style="'.$this->style['days'].'"'
					 : '';
		// ÖNCEKİ VE SONRAKİ LİNKLERİ İÇİN	CSS					 
		$buttonClass = ( isset($this->css['links']) )
					   ? ' class="'.$this->css['links'].'"'
					   : '';
		// ÖNCEKİ VE SONRAKİ LİNKLERİ İÇİN	STYLE		
		$buttonStyle = ( isset($this->style['links']) )
					   ? ' style="'.$this->style['links'].'"'
					   : '';
		
		// Önceki linki oluşturuluyor.
		$prev = "<a href='". suffix($this->url) . $year. "/". ( $month - 1 ) ."' {$buttonClass}{$buttonStyle}>$this->prev</a>";
		// Sonraki linki oluşturuluyor.
		$next = "<a href='". suffix($this->url) . $year. "/". ( $month + 1 ) ."' {$buttonClass}{$buttonStyle}>$this->next</a>";
		
		/************************************************************ CALENDAR *******************************************************************/			 
		$str  = "<table{$tableClass}{$tableStyle}>".eol();
		// Ay - Tarih Satırı
		$str .= "\t<tr>".eol()."\t\t<th{$monthRowClass}{$monthRowStyle} colspan=\"7\">{$prev} {$monthName} - {$year} {$next}</th></tr>".eol();
		$str .= "\t<tr>".eol();
		
		// Gün İsimleri Satırı
		foreach( $dayNames as $day )
		{
			$str .= "\t\t<td{$dayRowClass}{$dayRowStyle}>$day</td>".eol();
		}
		
		$str .= "\t<tr>".eol();
		
		if( $firstDay['wday'] == 0 ) 
		{
			$firstDay['wday'] = 7;
		}
		
		// Günler Satırı
		for( $i=1; $i<$firstDay['wday']; $i++ )
		{
			$str .= "\t\t<td{$rowsClass}{$rowsStyle}>&nbsp;</td>".eol();
		}
		
		$activeDay = 0;
		
		for( $i = $firstDay['wday']; $i<=7; $i++ )
		{
			$activeDay++;
			
			// Aktif gün için stil ve css kullanımı.
			if( $activeDay == $today['mday'] ) 
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
			
			$str .= "\t\t<td{$class}{$style}>$activeDay</td>".eol();
		}
		
		$str .= "\t</tr>".eol();
		
		$weekCount = floor(($lastDay ['mday'] - $activeDay) / 7);
		
		for( $i = 0; $i < $weekCount; $i++ )
		{
			$str .= "\t<tr>";
			
			for( $j = 0; $j < 7; $j++ )
			{
				$activeDay++;
				// Aktif gün için stil ve css kullanımı.
				if ( $activeDay == $today['mday'] ) 
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
				
				$str .= "\t\t<td{$class}{$style}>$activeDay</td>".eol();
			}
			
			$str .= "\t</tr>".eol();
		}
		
	
		if( $activeDay < $lastDay['mday'] )
		{
			$str .= "\t<tr>".eol();
			
			for( $i = 0; $i < 7; $i++ )
			{
				$activeDay++;
				// Aktif gün için stil ve css kullanımı.
				if( $activeDay == $today['mday'] ) 
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
				
				if( $activeDay <= $lastDay ['mday'] )
				{
					$str .= "\t\t<td{$class}{$style}>$activeDay</td>".eol();
				}
				else 
				{
					$str .= "\t\t<td{$class}{$style}>&nbsp;</td>".eol();
				}
			}			
			$str .= "\t</tr>".eol();
		}
		
		$str .= "</table>";
		
		$this->_defaultVariables();
		/************************************************************ CALENDAR *******************************************************************/	
		
		return $str;
	}
	
	// Değişkenler default ayarlarına getiriliyor.
	protected function _defaultVariables()
	{
		if( ! empty($this->css) ) 			$this->css = NULL;
		if( ! empty($this->style) ) 		$this->style = NULL;
		if( ! empty($this->monthNames) ) 	$this->monthNames = NULL;
		if( ! empty($this->dayNames) ) 		$this->dayNames = NULL;
		if( ! empty($this->url) ) 			$this->url = NULL;
		if( ! empty($this->config) ) 		$this->config = NULL;
		if( $this->prev !== '<<' ) 			$this->prev = '<<';
		if( $this->next !== '>>' ) 			$this->next = '>>';
		
	}
}