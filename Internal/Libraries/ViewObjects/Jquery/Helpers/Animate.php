<?php
namespace ZN\ViewObjects\Jquery\Helpers;

use ZN\ViewObjects\JqueryTrait;

class Animate
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
	
	/* Easing Variables
	 * Easing 
	 * easeIn, ease ...
	 *
	 * 
	 */
	protected $easing = [];
		
	/* Attributes Variables
	 * Attributes 
	 * 
	 *
	 * {key:val} 
	 */
	protected $attr = '';
	
	/******************************************************************************************
	* SPEED                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Duration işlevi ile aynıdır. Animasonun hızı ayarlanır.				  |
		
	  @param mixed $duration
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function speed($duration = '')
	{
		$this->duration($duration);
		
		return $this;
	}
	
	/******************************************************************************************
	* DURATION                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Animasyonun hızını belirlemek için kullanılır.						  |
		
	  @param mixed $duration
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function duration($duration = '')
	{
		if( is_scalar($duration) )
		{
			$this->easing['duration'] = $duration;
		}
		else
		{
			\Errors::set('Error', 'valueParameter', 'duration');
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* QUEUE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Kuyruğun olup olmadığını ayarlamak içind kullanılır.					  |
		
	  @param mixed $queue true
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function queue($queue = true)
	{
		if( is_bool($queue) )
		{
			$queue = $this->_boolToStr($queue);	
		}
		elseif( is_string($queue) )
		{
			$queue = $queue;
		}
		else
		{
			\Errors::set('Error', 'valueParameter', 'queue');
			return $this;
		}
		
		$this->easing['queue'] = $queue;
		
		return $this;	
	}
	
	/******************************************************************************************
	* ATTR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Animasyona konu olacak öğeleri oluşturmak için kullanılır.			  |
		
	  @param array $attr
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function attr($attr = [])
	{
		if( ! is_array($attr) )
		{
			\Errors::set('Error', 'arrayParameter', 'attr');
			return $this;	
		}
		
		$this->attr = $this->_object($attr);	
		
		return $this;
	}
	
	/******************************************************************************************
	* EASING                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Animasyona özel efekt uygulamak için kullanılır. 						  |
		
	  @param string $easing 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function easing($easing = '')
	{	
		$this->easing['easing'] = $easing;	
		
		return $this;
	}
	
	/******************************************************************************************
	* SPECIAL EASING                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Animasyona çoklu özel efekt gurubu uygulamak için kullanılır. 		  |
		
	  @param array $specialEasing 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function specialEasing($specialEasing = [])
	{	
		$this->easing['specialEasing'] = $this->_object($specialEasing);	
		
		return $this;
	}
	
	/******************************************************************************************
	* STEP                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Animasyona step fonksiyonu eklemek için kullanılır. 		     		  |
		
	  @param string $step 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function step($step = '')
	{	
		$this->easing['step'] = \JQ::func('now, fx', $step);	
		
		return $this;
	}
	
	/******************************************************************************************
	* COMPLETE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Animasyona complete fonksiyonu eklemek için kullanılır. 		   		  |
		
	  @param string $comp 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function comp($comp = '')
	{	
		$this->easing['complete'] = \JQ::func('', $comp);	
		
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
		$attr = [];
		
		$animate = \JQ::property('animate', [$this->attr, $this->callback, $this->_object($this->easing)]);
		
		$this->_defaultVariable();
		
		return $animate;
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
		$combineAnimation = $args;
		
		$animate  = EOL."\t".\JQ::selector($this->selector);
		
		$animate .= $this->complete();
		
		if( ! empty($combineAnimation) ) foreach( $combineAnimation as $animation )
		{			
			$animate .= $animation;
		}
	
		$animate .= ";".EOL;
			
		return $this->_tag($animate);
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
		$this->easing = [];
		$this->callback = '';
		$this->selector = 'this';
		$this->attr = '';
	}
}