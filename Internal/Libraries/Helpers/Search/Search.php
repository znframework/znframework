<?php
namespace ZN\Helpers;

class InternalSearch implements SearchInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Result Değişkeni
	 *  
	 * Arama sonucu verilerini tutaması
	 * için tanımlanmış dizi değişken
	 */
	private $result;
	
	/* Word Değişkeni
	 *  
	 * Aranacak kelime bilgisini tutaması
	 * için tanımlanmış dizi değişken
	 */
	private $word;
	
	/* Type Değişkeni
	 *  
	 * Arama türü bilgisini tutaması
	 * için tanımlanmış dizi değişken
	 */
	private $type;
	
	/* Filter Değişkeni
	 *  
	 * Aramayı başlatmadan önce filtre uygulamak için
	 * tanımlanmış dizi değişken
	 */
	private $filter = [];
	
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
	
	// filter ve or_filter için.
	protected function _filter($column = '', $value = '', $type)
	{
		// sütun adı veya operatör metinsel ifade içermiyorsa false değeri döndür.
		if( ! is_string($column) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'column');
		}
		
		// değer, metinsel veya sayısal değer içermiyorsa false değeri döndür.
		if( ! is_scalar($value) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'value');
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
	* WORD                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Aranacak kelime veya data.                                              |
	
	  @var string $word: aranacak kelime
	  
	  @return $this
	|          																				  |
	******************************************************************************************/	
	public function word($word = '')
	{
		$this->word = $word;
		
		return $this;
	}
	
	/******************************************************************************************
	* TYPE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Aranacak türü.          				                                  |
	
	  @var string $type: arama türü
	  
	  @return $this
	|          																				  |
	******************************************************************************************/	
	public function type($type = '')
	{
		$this->type = $type;
		
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
	| 3. TYPE Parametresi 5 farklı değer alabilir        									  |
	| inside, starting, ending, equal, auto 												  |
	|          																				  |
	******************************************************************************************/	
	public function get($conditions = [], $word = '', $type = 'auto')
	{
		// Parametreler kontrol ediliyor. -----------------------------------------
		if( ! is_array($conditions) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'conditions');
		}
		
		if( ! is_scalar($word) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'word');
		}
		
		if( ! empty($this->type) )
		{
			$type = $this->type	;
		}
		
		if( ! empty($this->word) )
		{
			$word = $this->word	;
		}
		
		if( ! is_string($type) ) 
		{
			$type = "inside";
		}
		// ------------------------------------------------------------------------

		$word = addslashes($word);
		
		$str = "";
		
		// Aramanın neye göre yapılacağı belirtiliyor. ----------------------------
		
		$operator = ' LIKE ';		
		$str      = $word;
		
		if( $type === "auto" )
		{
			if( is_numeric($word) )
			{
				$operator = ' = ';
			}
			else
			{
				$str = \DB::like($word, 'inside');
			}
		}
		
		// İçerisinde Geçen
		if( $type === "inside" ) 
		{
			$str = \DB::like($word, 'inside');
		}
		
		// İle Başlayan
		if( $type === "starting" ) 
		{
			$str = \DB::like($word, 'starting');
		}
		
		// İle Biten
		if( $type === "ending" ) 
		{
			$str = \DB::like($word, 'ending');
		}
		
		if( $type === 'equal')
		{
			$operator = ' = ';
			
		}
		// ------------------------------------------------------------------------

		foreach($conditions as $key => $values)
		{
			// Tekrarlayan verileri engelle.
			\DB::distinct();
			
			foreach($values as $keys)
			{	
				\DB::where($keys.$operator, $str, 'OR');
				
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
							\DB::where("$exval[0] ", $exval[1], 'AND');	
						}
						
						// Veya bağlaçlı or_filter kullanılmışsa
						if( $exval[2] === "or" )
						{
							\DB::where("$exval[0] ", $exval[1], 'OR');
						}
					}	
				}
			}
			
			// Sonuçları getir.
			\DB::get($key);
			
			// Sonuçları result dizisine yazdır.
			$this->result[$key] = \DB::result();
		}
		
		$result = $this->result;
		
		// Değişkenleri sıfırla
		$this->result = NULL;
		$this->type   = NULL;
		$this->word   = NULL;
		$this->filter = [];
		
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
			if( ! is_scalar($searchWord) ) 
			{
				return \Errors::set('Error', 'valueParameter', 'searchWord');
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