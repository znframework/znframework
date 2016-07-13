<?php
namespace ZN\ViewObjects;

class InternalJquery implements JqueryInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use JqueryTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
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
	
	protected $namespace = 'ZN\ViewObjects\Jquery\Helpers\\';
	
	/* Property Variables
	 * Property 
	 * css, attr, val
	 *
	 * $.css(), .attr(), .val()
	 */	 
	protected $property = '';
	
	/* Property Queue Variables
	 * 
	 *
	 * @string var = 1
	 * 
	 */	
	protected $propertyQueue = '';
	
	/* Attributes Variables
	 * Attributes 
	 * 
	 *
	 * {key:val} 
	 */
	protected $attr = '';
	
	/******************************************************************************************
	* PROPERTY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Özelliği belirlemek için kullanılır.									  |
		
	  @param string $property .property()
	  @param array  $attr     .property(p1, p2, p3 .... )
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function property($property = '', $attr = [])
	{
		if( ! is_string($property) )
		{
			\Errors::set('Error', 'stringParameter', 'property');
			return $this;	
		}
		
		$this->property = $property;

		$this->attr = $attr;
		
		$this->propertyQueue .= \JQ::property($property, $attr);

		return $this;
	}
	
	/******************************************************************************************
	* COMPLETE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bağlantılı dizge oluşturmak istenirse dizge bu yöntem ile sonlandırılır.|
		
	  @param string $void
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function complete()
	{
		$complete = $this->propertyQueue;

		$this->_defaultVariable();
		
		return $complete;
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizgeyi tamamlayıp oluşturmak için kullanılan nihai yöntemdir.	      |
		
	  @param string arguments $complete1, $complete2 ... $completeN
	  
	  @return $string
	|          																				  |
	******************************************************************************************/
	public function create(...$args)
	{
		$combineFunction = $args;
		
		$complete  = EOL.\JQ::selector($this->selector);
		
		$complete .= $this->complete();		
			
		if( ! empty($combineFunction)) foreach( $combineFunction as $function )
		{			
			$complete .= $function;
		}
		
		$complete .= ";";
		
		return $complete;	
	}
	
	/******************************************************************************************
	* PROTECTED DEFAULT VARIABLE                                                              *
	*******************************************************************************************
	| Genel Kullanım: Değişkenlerin var sayılan ayarlarına dönmeleri sağlanır.     		      |
		
	  @param void
	  
	  @return void
	|          																				  |
	******************************************************************************************/
	protected function _defaultVariable()
	{
		$this->selector = 'this';
		$this->property = '';
		$this->attr = '';
		$this->propertyQueue = '';
	}
	
	//----------------------------------------------------------------------------------------------------
	// Ajax
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function ajax($tag = false, $jq = false, $jqui = false)
	{
		return uselib($this->namespace.'Ajax', [$tag, $jq, $jqui]);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Action
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function action($tag = false, $jq = false, $jqui = false)
	{
		return uselib($this->namespace.'Action', [$tag, $jq, $jqui]);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Animate
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function animate($tag = false, $jq = false, $jqui = false)
	{
		return uselib($this->namespace.'Animate', [$tag, $jq, $jqui]);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Event
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function event($tag = false, $jq = false, $jqui = false)
	{
		return uselib($this->namespace.'Event', [$tag, $jq, $jqui]);
	}
}