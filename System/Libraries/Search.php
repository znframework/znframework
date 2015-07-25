<?php
class __USE_STATIC_ACCESS__Search
{
	/***********************************************************************************/
	/* SEARCH LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Search
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: search::, $this->search, zn::$use->search, uselib('search')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Result Değişkeni
	 *  
	 * Arama sonucu verilerini tutaması
	 * için tanımlanmış dizi değişken
	 */
	private $result;
	
	/* Filter Değişkeni
	 *  
	 * Aramayı başlatmadan önce filtre uygulamak için
	 * tanımlanmış dizi değişken
	 */
	private $filter = array();
	
	// filter ve or_filter için.
	protected function _filter($column = '', $value = '', $type)
	{
		// sütun adı veya operatör metinsel ifade içermiyorsa false değeri döndür.
		if( ! is_string($column) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'column'));
		}
		
		// değer, metinsel veya sayısal değer içermiyorsa false değeri döndür.
		if( ! isValue($value) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'value'));
		}
		
		// $filtre dizi değişkenine parametre olarak gönderilen değerleri string olarak ekle.
		$this->filter[] = "$column|$value|$type";
	}
	
	/******************************************************************************************
	* FILTER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Aramaya filtre uygulamak için kullanılır.                               |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @column => Filtre uygulanacak sütun ve operatör bilgisi.                  |
	| 2. string var @value  => Belirlenen sütunda filtrelenecek veri.                   	  |
	|          																				  |
	| Örnek Kullanım: filter('yas >', 15);        	  			  							  |
	| // where yas > 15         														      |
	|          																				  |
	| ÇOKLU FİLTRELEME         																  |
	| [VE] bağlacı ile yapılmak isteniyorsa filter() yöntemini kullanılır.        			  |
	| [VEYA] bağlacı ile yapılmak isteniyorsa orFilter() yöntemini kullanılır.        		  |
	|          																				  |
	******************************************************************************************/	
	public function filter($column = '', $value = '')
	{
		$this->_filter($column, $value, 'and');
		
		return $this;
	}
	
	/******************************************************************************************
	* OR FILTER                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Aramaya birden fazla filtre uygulanacağı zamana ve kullanımda veya      |
	| bağlacı tercih edileceği zaman kullanılır.                                              |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @column => Filtre uygulanacak sütun ve operatör bilgisi.                  |
	| 2. string var @value  => Belirlenen sütunda filtrelenecek veri.                   	  |
	|          																				  |
	| Örnek Kullanım: orFilter('yas >', 15);        	  			  						  |
	| // or where yas > 15         														      |
	|          																				  |
	******************************************************************************************/	
	public function orFilter($column = '', $value = '')
	{
		$this->_filter($column, $value, 'or');
		
		return $this;
	}
	
	/******************************************************************************************
	* GET                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Arama işlemini başlatır ve sonucu çıktılar.                             |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. array var @conditions => Arama yapılacak tablo adı ve tabloya ait sütun dizisidir.   |
	| 2. string var @word  => Belirtilen tablo ve sütunlarda aranacak veri.                   |
	| 3. string var @type  => Aranan kelimenin içinde geçen, ile başlayan ve ile biten durumu.|
	|          																				  |
	| Örnek Kullanım: 																		  |
	| get(																					  |	
	|	  array																				  |
	|	  (																					  |
	|		   'table1' => array('column1','column2') , 									  |
	|		   'table2' => array('column1','column2')										  |	
	|     ) 																			      |
	| );        	  			  							  						          |
	|          																				  |
	| 3. TYPE Parametresi 3 farklı değer alabilir        									  |
	| inside, starting, ending         														  |
	|          																				  |
	******************************************************************************************/	
	public function get($conditions = array(), $word = '', $type = 'inside')
	{
		// Parametreler kontrol ediliyor. -----------------------------------------
		if( ! is_array($conditions) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'conditions'));
		}
		
		if( ! isValue($word) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'word'));
		}
		
		if( ! is_string($type) ) 
		{
			$type = "inside";
		}
		// ------------------------------------------------------------------------

		$word = addslashes($word);
		
		$str = "";
		
		// Aramanın neye göre yapılacağı belirtiliyor. ----------------------------
		
		// İçerisinde Geçen
		if( $type === "inside" ) 
		{
			$str = '%'.$word.'%';
		}
		
		// İle Başlayan
		if( $type === "starting" ) 
		{
			$str = $word.'%';
		}
		
		// İle Biten
		if( $type === "ending" ) 
		{
			$str = '%'.$word;
		}
		// ------------------------------------------------------------------------
		
		$db = uselib('DB');
		
		foreach($conditions as $key => $values)
		{
			// Tekrarlayan verileri engelle.
			$db->distinct();
			
			foreach($values as $keys)
			{	
				$db->where($keys.' like', $str);
				
				// Filter dizisi boş değilse
				// Filtrelere göre verileri çek
				if( ! empty($this->filter) )
				{
					foreach($this->filter as $val)
					{		
						$exval = explode("|", $val);
						
						// Ve bağlaçlı filter kullanılmışsa
						if( $exval[2] === "and" )
						{
							$db->where("and $exval[0] ", $exval[1]);	
						}
						
						// Veya bağlaçlı or_filter kullanılmışsa
						if( $exval[2] === "or" )
						{
							$db->where("or $exval[0] ", $exval[1]);
						}
					}	
				}
			}
			
			// Sonuçları getir.
			$db->get($key);
			
			// Sonuçları result dizisine yazdır.
			$this->result[$key] = $db->result();
		}
		
		$result = $this->result;
		
		$db->close();
		// Değişkenleri sıfırla
		$this->result = '';
		$this->filter = array();
		
		// Sonuçları object veri türünde döndür.
		return (object)$result;	
	}
	
	// Function: data()
	// İşlev: Dizilerde ve metinsel ifadeler arama yapmak için kullanılır.
	// Parametreler
	// @search_data = Aranacak olan metin veya dizi.
	// @search_word = Aranacak olan karakter veya karakterler
	// @output = Arama sonucu türü. Parametrenin alabileceği değerler: bool, boolean, pos, position
	// 1- bool/boolean sonucun bulunuduğunu yada bulunmadığını gösteren true veya false değeri döndürür.
	// 2- pos/position sonuc bulunmuş ise bulunan bilginin başlangıç indeks numarasını bulunmamış ise -1 değerini döndürür.
	// Dönen Değer: Arama sonucu.
	public function data($searchData = '', $searchWord = '', $output = 'bool')
	{
		if( ! is_string($output) ) 
		{
			$output = 'bool';
		}
		
		if( ! is_array($searchData) )
		{	
			if( ! isValue($searchWord) ) 
			{
				return Error::set(lang('Error', 'valueParameter', 'searchWord'));
			}
			
			if( $output === 'str' || $output === 'string' ) 
			{
				return strstr($searchData, $searchWord);
			}
			elseif( $output === 'pos' || $output === 'position' ) 
			{
				return strpos($searchData, $searchWord);
			}
			elseif( $output === 'bool' || $output === 'boolean' ) 
			{
				$result = strpos($searchData, $searchWord);
				
				if( $result > -1 )
				{ 
					return true;
				}
				else
				{
					return false;
				}
			}
			else 
			{
				return false;
			}
		}
		else
		{			
			$result = array_search($searchWord, $searchData);	
			
			if( $output === 'pos' || $output === 'position' )
			{
				if( ! empty($result) )
				{
					return $result;
				}
				else
				{
					return -1;
				}
			}
			elseif( $output === 'bool' || $output === 'boolean' )
			{
				if( ! empty($result) )
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			elseif( $output === 'str' || $output === 'string' )
			{
				if( ! empty($result) )
				{
					return $searchWord;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}
}