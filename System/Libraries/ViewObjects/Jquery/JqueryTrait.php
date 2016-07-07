<?php
namespace ZN\ViewObjects;

trait JqueryTrait
{
	/* 
	 * Seçici seçimi
	 *
	 * $(this), $("#custom"), $(".example") 
	 *
	 * @var string this
	 */
	protected $selector = 'this';
	
	/* 
	 * Fonksiyon bloğu
	 *
	 * function(data){alert("example");}
	 *
	 * @var string
	 */
	protected $callback = '';
	
	protected $tag 			= false;
	protected $jqueryCdn 	= false;
	protected $jqueryUiCdn 	= false;

	public function __construct($tag = false, $jqueryCdn = false, $jqueryUiCdn = false)
	{
		$this->tag	 		= $tag;
		$this->jqueryCdn 	= $jqueryCdn;
		$this->jqueryUiCdn 	= $jqueryUiCdn;		
	}
	
	protected function _tag($code)
	{
		if( $this->tag === true )
		{
			return \Script::open(true, $this->jqueryCdn, $this->jqueryUiCdn).$code.\Script::close();
		}
		
		return $code;
	}
	
	protected function _nailConvert($str, $nail = '"')
	{
		if( $nail === '"')
		{
			$str = str_replace('"', "'", $str);
		}
		
		return $str;
	}
	
	/******************************************************************************************
	* SELECTOR                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Seçiciyi belirlemek için kullanılır.									  |
		
	  @param string $selector
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function selector($selector = '')
	{
		$this->selector = $selector;
		
		return $this;
	}
	
	/******************************************************************************************
	* CALLBACK                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sorgunun fonksiyon bloğunu oluşturmak için kullanılır.     		      |
		
	  @param string $params
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function callback($params = '', $callback = '')
	{
		$this->callback = \JQ::func($params, $callback);
		
		return $this;
	}
	
	/******************************************************************************************
	* FUNC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Callback işlevinin diğer adıdır.						     		      |
		
	  @param string $params
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function func($params = '', $callback = '')
	{
		$this->callback($params, $callback);
		
		return $this;
	}
	
	/******************************************************************************************
	* BOOL TO STR                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Parametre mantıksal türden string türe dönüştürülüyor. 	    		  |
	
	  @param bool $bool
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _boolToStr($bool = true)
	{
		if( $bool === true )
		{
			return 'true';
		}
		elseif( $bool === false )
		{
			return 'false';
		}
		else
		{
			return $bool;	
		}
	}
	
	/******************************************************************************************
	* IS KEY SELECTOR                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin seçici bir anahtar olup olmadığı kontrol ediliyor. 	 	  |
	
	  @param string $data
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	protected function _isKeySelector($data)
	{
		$keyword  = ['document', 'this', 'window'];
		
		if( in_array($data, $keyword) )
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* IS FUNC                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin fonksiyon olup olmadığı kontrol ediliyor. 	    		  |
	
	  @param array $array
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _isFunc($data)
	{
		if( preg_match('/function.*\(.*\)/', $data) )
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* IS JQUERY                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin fonksiyon olup olmadığı kontrol ediliyor. 	    		  |
	
	  @param array $array
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _isJquery($data)
	{
		if( preg_match('/(\$|jQuery)(\.\w+)*\(.*\)/i', $data) )
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* OBJECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin veri türüne göre object türe dönüştürülme yapılır. 		  |
	
	  @param string/array $array
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _object($array)
	{
		$object = '';
		
		if( is_array($array) )
		{		
			$object  = '';	
			$object .= "{";
			if( ! empty($array)) foreach($array as $k => $v)
			{
				$object .= $k.":".$v.", ";
			}
			$object  = substr($object, 0, -2);
			$object .= "}";
		}
		else
		{
			$object = EOL."\"$array\"";	
		}
		
		return $object;
	}	
	
	/******************************************************************************************
	* PARAMS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Parametrenin ne tür veri içerdiğinin kontrolü yapılır. 	    		  |
	
	  @param array $array
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _params($array = [])
	{
		$implode = '';
		
		if( is_array($array) )
		{
			if( ! empty($array) ) foreach( $array as $v )
			{
				if( ! empty($v) )
				{
					$implode .= \JQ::stringControl($v).",";
				}
			}
			
			$implode = rtrim($implode, ",");	
		}
		else
		{
			if( ! empty($array) )
			{
				$implode = \JQ::stringControl($array);
			}	
		}
		
		return $implode;
	}
}