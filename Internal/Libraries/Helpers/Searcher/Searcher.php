<?php namespace ZN\Helpers;

class InternalSearcher extends \CallController implements SearcherInterface
{
	//--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
	
	//--------------------------------------------------------------------------------------------------------
	// Result
	//--------------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//--------------------------------------------------------------------------------------------------------
	protected $result;
	
	//--------------------------------------------------------------------------------------------------------
	// Word
	//--------------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//--------------------------------------------------------------------------------------------------------
	protected $word;
	
	//--------------------------------------------------------------------------------------------------------
	// Type
	//--------------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//--------------------------------------------------------------------------------------------------------
	protected $type;
	
	//--------------------------------------------------------------------------------------------------------
	// Filter
	//--------------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//--------------------------------------------------------------------------------------------------------
	protected $filter = [];
	
	//--------------------------------------------------------------------------------------------------------
	// Protected Filter
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param string $column
	// @param string $value
	// @param string $type 
	//
	//--------------------------------------------------------------------------------------------------------
	protected function _filter($column, $value, $type)
	{
		$this->filter[] = "$column|$value|$type";
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Filter
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param string $column
	// @param string $value
	//
	//--------------------------------------------------------------------------------------------------------	
	public function filter(String $column, $value)
	{
		$this->_filter($column, $value, 'and');
		
		return $this;
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Filter
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param string $column
	// @param string $value
	//
	//--------------------------------------------------------------------------------------------------------
	public function orFilter(String $column, $value)
	{
		$this->_filter($column, $value, 'or');
		
		return $this;
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Word
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param string $word
	//
	//--------------------------------------------------------------------------------------------------------	
	public function word(String $word)
	{
		$this->word = $word;
		
		return $this;
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Type
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param string $type
	//
	//--------------------------------------------------------------------------------------------------------
	public function type(String $type)
	{
		$this->type = $type;
		
		return $this;
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Get
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param array  $conditions
	// @param string $word
	// @param string $type: auto, inside, equal, starting, ending
	//
	//--------------------------------------------------------------------------------------------------------
	public function get(Array $conditions, String $word = NULL, String $type = 'auto')
	{	
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
	
	//--------------------------------------------------------------------------------------------------------
	// Data
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param mixed  $searchData
	// @param mixed  $searchWord
	// @param string $output: bool, boolean, pos, position, str, string
	//
	//--------------------------------------------------------------------------------------------------------
	public function data($searchData, $searchWord, String $output = 'bool')
	{
		if( ! is_array($searchData) )
		{	
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