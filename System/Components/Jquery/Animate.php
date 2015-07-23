<?php
class __USE_STATIC_ACCESS__CAnimate extends CJqueryCommon
{
	/***********************************************************************************/
	/* ANIMATE COMPONENT     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CAnimate
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->canimate, zn::$use->canimate, uselib('canimate')
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
	
	/* Selector Function
	 * Params: string @selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	public function selector($selector = '')
	{
		if( ! isChar($selector) )
		{
			Error::set('CAnimate', 'selector', lang('Error', 'valueParameter', 'selector'));
			return $this;	
		}
		
		if($this->_isKeySelector($selector))
		{
			$this->selector = $selector;	
		}
		else
		{
			$this->selector = "\"$selector\"";	
		}
		
		return $this;
	}	
	
	/* Speed Function
	 * Speed 
	 * 1000, slow, fast
	 *
	 * 
	 */
	public function speed($duration = '')
	{
		if( isValue($duration) )
		{
			$this->easing['duration'] = $duration;
		}
		else
		{
			Error::set('CAnimate', 'speed', lang('Error', 'valueParameter', 'duration'));
		}
		
		return $this;
	}
	
	/* Speed Or Duration Function
	 * Duration 
	 * 1000, slow, fast
	 *
	 * 
	 */
	public function duration($duration = '')
	{
		if( isValue($duration) )
		{
			$this->easing['duration'] = $duration;
		}
		else
		{
			Error::set('CAnimate', 'duration', lang('Error', 'valueParameter', 'duration'));
		}
		
		return $this;
	}
	
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
			Error::set('CAnimate', 'queue', lang('Error', 'valueParameter', 'queue'));
			return $this;
		}
		
		$this->easing['queue'] = $queue;
		
		return $this;	
	}
	
	public function callback($params = '', $callback = '')
	{
		if( ! is_string($params) || ! is_string($callback) )
		{
			Error::set('CAnimate', 'callback', lang('Error', 'stringParameter', 'params & callback'));
			return $this;	
		}
		
		$this->callback = ",".eol()."\t\tfunction($params){".$callback."}";
		
		return $this;
	}
	
	public function func($params = '', $callback = '')
	{
		if( ! is_string($params) || ! is_string($callback) )
		{
			Error::set('CAnimate', 'func', lang('Error', 'stringParameter', 'params & callback'));
			return $this;	
		}
		
		$this->callback = ",".eol()."\t\tfunction($params){".$callback."}";
		
		return $this;
	}
	
	public function attr($attr = '')
	{
		if( ! is_array($attr) )
		{
			Error::set('CAnimate', 'attr', lang('Error', 'arrayParameter', 'attr'));
			return $this;	
		}
		
		$this->attr = $this->_object($attr);	
		
		return $this;
	}
	
	public function easing($easing = '')
	{	
		$this->easing['easing'] = $easing;	
		
		return $this;
	}
	
	public function specialEasing($specialEasing = '')
	{	
		$this->easing['specialEasing'] = $this->_object($specialEasing);	
		
		return $this;
	}
	
	public function step($params = 'now, fx', $step = '')
	{	
		$this->easing['step'] = "function($params){".$step."}";	
		
		return $this;
	}
	
	public function complete()
	{
		$animateMid = '';
		$animate  = ".animate".eol()."\t(";
		if( ! empty($this->attr ))     $animateMid .= eol()."\t".$this->attr;
		if( ! empty($this->speed) )    $animateMid .= $this->speed;
		if( ! empty($this->easing) )   $animateMid .= ",".eol()."\t".$this->_object($this->easing);
		if( ! empty($this->callback) ) $animateMid .= $this->callback;
		$animate .= trim($animateMid, ',');
		$animate .= eol()."\t)";
		
		$this->_defaultVariable();
		
		return $animate;
	}
	
	public function create()
	{
		$combineAnimation = func_get_args();
		
		$animate  = eol()."\t$($this->selector)";
		
		$animate .= $this->complete();
		
		if( ! empty($combineAnimation) ) foreach( $combineAnimation as $animation )
		{			
			$animate .= $animation;
		}
	
		$animate .= ";".eol();
			
		return $animate;
	}
	
	protected function _defaultVariable()
	{
		if( ! empty($this->easing)) 	$this->easing = array();
		if( ! empty($this->callback))  	$this->callback = '';
		if($this->selector !== 'this')  $this->selector = 'this';
		if( ! empty($this->attr))  		$this->attr = '';
	}
}