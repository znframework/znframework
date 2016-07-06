<?php
namespace DB;

trait FunctionsTrait
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
	// Control Flow Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* SWITCH CASE                                                                             *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function switchCase($switch = '', $conditions = [], $return = false)
	{
		$case = ' CASE '.$switch;
		
		if( is_array($conditions) ) foreach( $conditions as $key => $val )
		{
			if( strtolower($key) === 'default' || strtolower($key) === 'else' )
			{
				$key = ' ELSE ';
			}
			else
			{
				$key = ' WHEN '.$key.' THEN ';
			}
			
			$case .= $key.$val;
		}
		
		$case .= ' END; ';
		
		if( $return === true )
		{
			return $case;
		}
		else
		{
			$this->selectFunctions[] = $case;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* IF ELSE                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ifElse()
	{
		$math = $this->_math('IF', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* IF NULL                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ifNull()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* NULL IF                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function nullIf()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Control Flow Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	
	
	//----------------------------------------------------------------------------------------------------
	// Variable Types Methods Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Math Functions Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* ABS                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Sayının mutlak değerini alarak pozitif değerini verir.			 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function abs()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
	
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* MOD                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Sayının mutlak değerini alarak pozitif değerini verir.			 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function mod()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ACOS                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function acos()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ASIN                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function asin()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ATAN                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function atan()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ATAN2                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function atan2()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CEIL                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ceil()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CEILING                                                                                 *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ceiling()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COS                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function cos()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COT                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function cot()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CRC32                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function crc32()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* DEGREES                                                                                 *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function degrees()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* EXP                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function exp()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* FLOOR                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function floor()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LN                                                                                      *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ln()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LOG10                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function log10()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LOG2                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function log2()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LOG                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function log()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* PI                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function pi()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* POW                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function pow()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* POWER                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function power()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* RADIANS                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function radians()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* RAND                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function rand()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* RAUND                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function raund()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SIGN                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sign()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SIN                                                                                     *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sin()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SQRT                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sqrt()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* TAN                                                                                    *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function tan()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Math Functions Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Other Single Functions Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* LIKE                                                                                    *
	*******************************************************************************************
	| 																						  |
		@param string $value
		@param string $type: starting, inside, ending
	|          																				  |
	******************************************************************************************/
	public function like($value = '', $type = 'starting')
	{
		// Parametrelerin string kontrolü yapılıyor.
		if( ! is_scalar($value) || ! is_string($type) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'value, type');
		}
		
		$operator = $this->db->operator(__FUNCTION__);
		
		if( $type === "inside" ) 
		{
			$value = $operator.$value.$operator;
		}
		
		// İle Başlayan
		if( $type === "starting" ) 
		{
			$value = $value.$operator;
		}
		
		// İle Biten
		if( $type === "ending" ) 
		{
			$value = $operator.$value;
		}
		
		return $value;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Other Single Functions Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// String Functions Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* ASCII                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ascii()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CHAR_LENGTH                                                                             *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function charLength()
	{
		$math = $this->_math('CHAR_LENGTH', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}

	/******************************************************************************************
	* FIELD                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function field()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* FORMAT                                                                                  *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function format()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LOWER                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function lower()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* UPPER                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function upper()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LENGTH                                                                                  *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function length()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}

	/******************************************************************************************
	* LTRIM                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ltrim()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SUBSTRING                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function substring()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ORD                                                                                     *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ord()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* POSITION                                                                                *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function position()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* QUOTE                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function quote()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* REPEAT                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function repeat()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* RTRIM                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function rtrim()

	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SOUNDEX                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function soundex()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SPACE                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function space()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SUBSTR                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function substr()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SUBSTRING_INDEX                                                                         *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function substringIndex()
	{
		$math = $this->_math('SUBSTRING_INDEX', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* TRIM                                                                                    *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function trim()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* UCASE                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function ucase()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LCASE                                                                                   *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function lcase()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// String Functions Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Information Functions Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* BENCHMARK                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function benchmark()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CHARSET                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function charset()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COERCIBILITY                                                                            *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function coercibility()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* USER                                                                                    *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function user()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COLLATION                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function collation()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CONNECTION ID                                                                           *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function connectionId()
	{
		$math = $this->_math('CONNECTION_ID', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* CURRENT USER                                                                            *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function currentUser()
	{
		$math = $this->_math('CURRENT_USER', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* DATABASE                                                                                *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function database()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SCHEMA                                                                                *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function schema()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* LAST_INSERT_ID                                                                          *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function lastInsertId()
	{
		$math = $this->_math('LAST_INSERT_ID', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SYSTEM_USER                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function systemUser()
	{
		$math = $this->_math('SYSTEM_USER', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SESSION_USER                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sessionUser()
	{
		$math = $this->_math('SESSION_USER', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* ROW_COUNT                                                                               *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function rowCount()
	{
		$math = $this->_math('ROW_COUNT', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* VERSION                                                                                 *
	*******************************************************************************************
	| 																 	 					  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function versionInfo()
	{
		$math = $this->_math('VERSION', func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Information Functions Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Aggregate Functions Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* AVG                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait kolonların ortamalasını alır.				 				  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function avg()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
	
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* MIN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait kolonlardan değeri minimum olanı alır.				 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function min()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* MAX                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait kolonlardan değeri maksimum olanı alır.				 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function max()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* COUNT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait satır sayısını verir.									 	  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function count()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	/******************************************************************************************
	* SUM                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Tabloya ait kolonların toplamını alır.				 				  |
	
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function sum()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;

		
			return $this;
		}
	}
	
	/******************************************************************************************
	* VARIANCE                                                                                   *
	*******************************************************************************************
	| 																					 	  |
	  @param args
		
	  @return string
	|          																				  |
	******************************************************************************************/
	public function variance()
	{
		$math = $this->_math(__FUNCTION__, func_get_args());
		
		if( $math->return === true )
		{
			return $math->args;
		}
		else
		{
			$this->selectFunctions[] = $math->args;
		
			return $this;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Aggregate Functions Bitiş
	//----------------------------------------------------------------------------------------------------
}