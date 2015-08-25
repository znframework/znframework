<?php
class __USE_STATIC_ACCESS__JQAnimate extends JSCommon
{
	/***********************************************************************************/
	/* ANIMATE COMPONENT     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: JQAnimate
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: JQAnimate::, $this->JQAnimate, zn::$use->JQAnimate, uselib('JQAnimate')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Easing Variables
	 * Easing 
	 * easeIn, ease ...
	 *
	 * 
	 */
	protected $easing = array();
	
	/* Callback Variables
	 * Data Function
	 * alert("example");
	 *
	 * function(data){alert("example");}
	 */
	protected $callback = '';
	
	/* Selector Variables
	 * Selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	protected $selector = 'this';
	
	/* Attributes Variables
	 * Attributes 
	 * 
	 *
	 * {key:val} 
	 */
	protected $attr = '';
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "JQAnimate::$method()"));	
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
		if( isValue($duration) )
		{
			$this->easing['duration'] = $duration;
		}
		else
		{
			Error::set(lang('Error', 'valueParameter', 'duration'));
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
			Error::set(lang('Error', 'valueParameter', 'queue'));
			return $this;
		}
		
		$this->easing['queue'] = $queue;
		
		return $this;	
	}
	
	/******************************************************************************************
	* CALLBACK                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Geri dönüş fonksiyonunu oluşturmak içindir.    						  |
		
	  @param string $param
	  @param string $callback
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function callback($params = '', $callback = '')
	{
		 $this->func($params, $callback);
		
		return $this;
	}
	
	/******************************************************************************************
	* FUNC / CALLBACK                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Geri dönüş fonksiyonunu oluşturmak içindir.    						  |
		
	  @param string $param
	  @param string $callback
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function func($params = '', $callback = '')
	{
		if( ! is_string($params) || ! is_string($callback) )
		{
			Error::set(lang('Error', 'stringParameter', 'params & callback'));
			return $this;	
		}
		
		$this->callback = JQ::func($param, $callback);
		
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
	public function attr($attr = array())
	{
		if( ! is_array($attr) )
		{
			Error::set(lang('Error', 'arrayParameter', 'attr'));
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
	public function specialEasing($specialEasing = array())
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
		$this->easing['step'] = JQ::func('now, fx', $step);	
		
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
		$this->easing['complete'] = JQ::func('', $comp);	
		
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
		$attr = array();
		
		$animate = JQ::property('animate', array($this->attr, $this->callback, $this->_object($this->easing)));
		
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
	public function create()
	{
		$combineAnimation = func_get_args();
		
		$animate  = eol()."\t".JQ::selector($this->selector);
		
		$animate .= $this->complete();
		
		if( ! empty($combineAnimation) ) foreach( $combineAnimation as $animation )
		{			
			$animate .= $animation;
		}
	
		$animate .= ";".eol();
			
		return $animate;
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
		if( ! empty($this->easing)) 	$this->easing = array();
		if( ! empty($this->callback))  	$this->callback = '';
		if($this->selector !== 'this')  $this->selector = 'this';
		if( ! empty($this->attr))  		$this->attr = '';
	}
}