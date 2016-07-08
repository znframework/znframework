<?php
namespace ZN\ViewObjects\Jquery\Helpers;

use ZN\ViewObjects\JqueryTrait;

class Event
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
	
	/* Type Variables
	 * Event Types
	 * click, mouseover, keyup, ...
	 *
	 * bind('click'), bind('mouseover'), bind('keyup'), ...
	 */
	protected $type		= '';
	
	/*
	 * parametreler
	 *
	 * @var string
	 */
	protected $params		= '';
	
	/* Property Variables
	 * Property
	 * live, bind, unbind...
	 *
	 * .live(), .bind(), .unbind()
	 */
	protected $property = 'bind';
	
	/* Protected Event
	 * Params: string @type, string @selector, string @callback 
	 * 
	 *
	 * 
	 */
	protected function _event($type = '', $selector = '', $callback = '')
	{
		if( ! is_string($selector) || ! is_string($callback) )
		{
			\Errors::set('Error', 'stringParameter', 'selector & callback');	
		}
		
		$this->property = $type;
		
		if( ! empty($selector))
		{
			$this->selector($selector);	
		}
		
		if( ! empty($callback))
		{
			$this->callback('e', $callback);	
		}
	}
	
	/* Click Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: click, @callback: 'alert("example");'
	 * 
	 * 'click', 'function(e){alert("example");}'
	 */
	public function click($selector = '', $callback = '')
	{
		$this->_event('click', $selector, $callback);
		
		return $this->create();
	}
	
	/* Blur Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: blur, @callback: 'alert("example");'
	 * 
	 * 'blur', 'function(e){alert("example");}'
	 */
	public function blur($selector = '', $callback = '')
	{
		$this->_event('blur', $selector, $callback);
		
		return $this->create();
	}
	
	/* Change Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: change, @callback: 'alert("example");'
	 * 
	 * 'change', 'function(e){alert("example");}'
	 */
	public function change($selector = '', $callback = '')
	{
		$this->_event('change', $selector, $callback);
		
		return $this->create();
	}
	
	/* Double Click Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: dblclick, @callback: 'alert("example");'
	 * 
	 * 'dblclick', 'function(e){alert("example");}'
	 */
	public function dblClick($selector = '', $callback = '')
	{
		$this->_event('dblclick', $selector, $callback);
		
		return $this->create();
	}
	
	/* Error Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: error, @callback: 'alert("example");'
	 * 
	 * 'error', 'function(e){alert("example");}'
	 */
	public function error($selector = '', $callback = '')
	{
		$this->_event('error', $selector, $callback);
		
		return $this->create();
	}
	
	/* Resize Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: resize, @callback: 'alert("example");'
	 * 
	 * 'resize', 'function(e){alert("example");}'
	 */
	public function resize($selector = '', $callback = '')
	{
		$this->_event('resize', $selector, $callback);
		
		return $this->create();
	}
	
	/* Scroll Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: scroll, @callback: 'alert("example");'
	 * 
	 * 'scroll', 'function(e){alert("example");}'
	 */
	public function scroll($selector = '', $callback = '')
	{
		$this->_event('scroll', $selector, $callback);
		
		return $this->create();
	}
	
	/* Load Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: load, @callback: 'alert("example");'
	 * 
	 * 'load', 'function(e){alert("example");}'
	 */
	public function load($selector = '', $callback = '')
	{
		$this->_event('load', $selector, $callback);
		
		return $this->create();
	}
	
	/* Ready Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: ready, @callback: 'alert("example");'
	 * 
	 * 'ready', 'function(e){alert("example");}'
	 */
	public function ready($selector = '', $callback = '')
	{
		$this->_event('ready', $selector, $callback);
		
		return $this->create();
	}
	
	/* Unload Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: unload, @callback: 'alert("example");'
	 * 
	 * 'unload', 'function(e){alert("example");}'
	 */
	public function unload($selector = '', $callback = '')
	{
		$this->_event('unload', $selector, $callback);
		
		return $this->create();
	}
	
	/* Focus Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: focus, @callback: 'alert("example");'
	 * 
	 * 'focus', 'function(e){alert("example");}'
	 */
	public function focus($selector = '', $callback = '')
	{
		$this->_event('focus', $selector, $callback);
		
		return $this->create();
	}
	
	/* Focus In Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: focusin, @callback: 'alert("example");'
	 * 
	 * 'focusin', 'function(e){alert("example");}'
	 */
	public function focusIn($selector = '', $callback = '')
	{
		$this->_event('focusin', $selector, $callback);
		
		return $this->create();
	}
	
	/* Focus Out Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: focusout, @callback: 'alert("example");'
	 * 
	 * 'focusout', 'function(e){alert("example");}'
	 */
	public function focusOut($selector = '', $callback = '')
	{
		$this->_event('focusout', $selector, $callback);
		
		return $this->create();
	}
	
	/* Select Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: select, @callback: 'alert("example");'
	 * 
	 * 'select', 'function(e){alert("example");}'
	 */
	public function select($selector = '', $callback = '')
	{
		$this->_event('select', $selector, $callback);
		
		return $this->create();
	}
	
	/* Submit Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: submit, @callback: 'alert("example");'
	 * 
	 * 'submit', 'function(e){alert("example");}'
	 */
	public function submit($selector = '', $callback = '')
	{
		$this->_event('submit', $selector, $callback);
		
		return $this->create();
	}
	
	/* Keydown Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: keydown, @callback: 'alert("example");'
	 * 
	 * 'keydown', 'function(e){alert("example");}'
	 */
	public function keyDown($selector = '', $callback = '')
	{
		$this->_event('keydown', $selector, $callback);
		
		return $this->create();
	}
	
	/* Keypress Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: keypress, @callback: 'alert("example");'
	 * 
	 * 'keypress', 'function(e){alert("example");}'
	 */
	public function keyPress($selector = '', $callback = '')
	{
		$this->_event('keypress', $selector, $callback);
		
		return $this->create();
	}
	
	/* Keyup Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: keyup, @callback: 'alert("example");'
	 * 
	 * 'keyup', 'function(e){alert("example");}'
	 */
	public function keyUp($selector = '', $callback = '')
	{
		$this->_event('keyup', $selector, $callback);
		
		return $this->create();
	}
	
	/* Hover Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: hover, @callback: 'alert("example");'
	 * 
	 * 'hover', 'function(e){alert("example");}'
	 */
	public function hover($selector = '', $callback = '')
	{
		$this->_event('hover', $selector, $callback);
		
		return $this->create();
	}
	
	/* Mouse Down Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: mousedown, @callback: 'alert("example");'
	 * 
	 * 'mousedown', 'function(e){alert("example");}'
	 */
	public function mouseDown($selector = '', $callback = '')
	{
		$this->_event('mousedown', $selector, $callback);
		
		return $this->create();
	}
	
	/* Mouse Enter Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: mouseenter, @callback: 'alert("example");'
	 * 
	 * 'mouseenter', 'function(e){alert("example");}'
	 */
	public function mouseEnter($selector = '', $callback = '')
	{
		$this->_event('mouseenter', $selector, $callback);
		
		return $this->create();
	}
	
	/* Mouse Leave Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: mouseleave, @callback: 'alert("example");'
	 * 
	 * 'mouseleave', 'function(e){alert("example");}'
	 */
	public function mouseLeave($selector = '', $callback = '')
	{
		$this->_event('mouseleave', $selector, $callback);
		
		return $this->create();
	}
	
	/* Mouse Move Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: mousemove, @callback: 'alert("example");'
	 * 
	 * 'mousemove', 'function(e){alert("example");}'
	 */
	public function mouseMove($selector = '', $callback = '')
	{
		$this->_event('mousemove', $selector, $callback);
		
		return $this->create();
	}
	
	/* Mouse Out Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: mouseout, @callback: 'alert("example");'
	 * 
	 * 'mouseout', 'function(e){alert("example");}'
	 */
	public function mouseOut($selector = '', $callback = '')
	{
		$this->_event('mouseout', $selector, $callback);
		
		return $this->create();
	}
	
	/* Mouse Over Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: mouseover, @callback: 'alert("example");'
	 * 
	 * 'mouseover', 'function(e){alert("example");}'
	 */
	public function mouseOver($selector = '', $callback = '')
	{
		$this->_event('mouseover', $selector, $callback);
		
		return $this->create();
	}
	
	/* Mouse Up Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: mouseup, @callback: 'alert("example");'
	 * 
	 * 'mouseup', 'function(e){alert("example");}'
	 */
	public function mouseUp($selector = '', $callback = '')
	{
		$this->_event('mouseup', $selector, $callback);
		
		return $this->create();
	}
	
	/* Toogle Event
	 * Params: string @selector, string @callback 
	 * 
	 * @selector: toggle, @callback: 'alert("example");'
	 * 
	 * 'toggle', 'function(e){alert("example");}'
	 */
	public function toggle($selector = '', $callback = '')
	{
		$this->_event('toggle', $selector, $callback);
		
		return $this->create();
	}
	
	/* Event Type Function
	 * Event Types
	 * click, mouseover, keyup, ...
	 *
	 * bind('click'), bind('mouseover'), bind('keyup'), ...
	 */
 	public function type($type = 'click')
	{
		if( ! is_string($type))
		{
			\Errors::set('Error', 'stringParameter', 'type');
			return $this;	
		}
		
		$this->property = $type;
		
		return $this;
	}	
	
	/* Bind Property Function
	 * Bind
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .bind('click', '', '') 
	 */
	public function bind(...$args)
	{
		$this->property = 'bind';
		$this->params   = $args;
		
		return $this;	
	}
	
	/* Unbind Property Function
	 * Unbind
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .unbind('click', '', '') 
	 */
	public function unbind(...$args)
	{
		$this->property = 'unbind';
		$this->params   = $args;
	
		return $this;	
	}
	
	/* Trigger Property Function
	 * Trigger
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .trigger('click', '', '') 
	 */
	public function trigger(...$args)
	{
		$this->property = 'trigger';
		$this->params   = $args;
	
		return $this;	
	}
	
	/* Trigger Handler Property Function
	 * Trigger Handler
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .triggerHandler('click', '', '') 
	 */
	public function triggerHandler(...$args)
	{
		$this->property = 'triggerHandler';
		$this->params   = $args;
		
		return $this;	
	}
	
	/* Delegate Property Function
	 * Delegate
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .delegate('click', '', '') 
	 */
	public function delegate(...$args)
	{
		$this->property = 'delegate';
		$this->params   = $args;
		
		return $this;	
	}
	
	/* One Property Function
	 * One
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .one('click', '', '') 
	 */
	public function one(...$args)
	{
		$this->property = 'one';
		$this->params   = $args;
		
		return $this;	
	}
	
	/* On Property Function
	 * On
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .on('click', '', '') 
	 */
	public function on(...$args)
	{
		$this->property = 'on';
		$this->params   = $args;
		
		return $this;	
	}
	
	/* Off Property Function
	 * Off
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .off('click', '', '') 
	 */
	public function off(...$args)
	{
		$this->property = 'off';
		$this->params   = $args;
		
		return $this;	
	}
	
	/* Live Property Function
	 * live
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .live('click', '', '') 
	 */
	public function live(...$args)
	{
		$this->property = 'live';
		$this->params   = $args;
		
		return $this;	
	}
	
	/* Remove(Die) Property Function
	 * Remove(Die): die is keyword so It is selected to name remove
	 *
	 * Params: arg1, art2, ... argN
	 *
	 * 'click', '', '' ...
	 *
	 * .die('click', '', '') 
	 */
	public function remove(...$args)
	{
		$this->property = 'die';
		$this->params   = $args;
		
		return $this;	
	}
	
	/* Complete Function
	 *
	 * Jquery script completing
	 *
	 */
	public function complete()
	{	
		if( isset($this->callback) ) 
		{
			$this->params[] = $this->callback;
		}
		
		$event = \JQ::property($this->property, $this->params);
		
		$this->_defaultVariable();
		
		return $event;
	}
	
	/* Create Jquery Function
	 *
	 * Jquery script creating
	 *
	 */
	public function create(...$args)
	{
		$combineEvent = $args;
		
		$event  = EOL.\JQ::selector($this->selector);
		$event .= $this->complete();
		if( ! empty($combineEvent))foreach($combineEvent as $e)
		{			
			$event .= $e;
		}
		
		$event .= ";";
		
		return $this->_tag($event);
	}
	
	/* Default Variable
	 *
	 * 
	 *
	 */
	protected function _defaultVariable()
	{
		$this->selector = 'this';
		$this->type		= '';
		$this->callback = '';
		$this->property = 'bind';
		$this->params   = '';
	}
}