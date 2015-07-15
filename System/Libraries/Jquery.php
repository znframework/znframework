<?php
class StaticJquery
{	
	/***********************************************************************************/
	/* JQUERY LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Jquery
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: jquery::, $this->jquery, zn::$use->jquery, uselib('jquery')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Ready Değişkeni
	 *  
	 * $(document).ready({ }) eklenip eklenmeyeceğinin
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	private $keywords = array('this', 'document', 'window');
	
	/* Keyword Değişkeni
	 *  
	 * Tırnak içersinde yazılmaması gereken anathar ifadelerin
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	private $ready;
	
	/******************************************************************************************
	* OPEN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <script> tagının kullanımıdır. Yani Script tagını açmak içindir.   |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. boolean var @jquery_library => Jquery kütüphanesi dahil edilsin mi ?.	  			  |
	| 2. boolean var @jquery_ui_library => JqueryUi kütüphanesi dahil edilsin mi ?.	          |
	| 3. boolean var @ready => $(document).ready({ }) kodu eklensin mi ?.	                  |
	|          																				  |
	| Örnek Kullanım: open();        	  					                                  |
	|          																				  |
	******************************************************************************************/	
	public function open($jqueryLibrary = true, $jqueryUiLibrary = false, $ready = true)
	{
		// Parametre kontrolleri yapılıyor. -------------------------------------------
		if( ! is_bool($jqueryLibrary) ) 
		{
			$jqueryLibrary = true;
		}
		
		if( ! is_bool($jqueryUiLibrary) ) 
		{
			$jqueryUiLibrary = false;
		}
		if( ! is_bool($ready) )
		{
			$ready = true;
		}
		// ----------------------------------------------------------------------------
		
		$this->ready = $ready;
		
		$script = '';
		
		// True ise Jquery kütüphanesini dahil et.
		if( $jqueryLibrary === true )
		{
			$script  .= Import::script('Jquery', true);
		}
		
		// True ise JqueryUi kütüphanesini dahil et.
		if( $jqueryUiLibrary === true )
		{
			$script  .= Import::script('JqueryUi', true);
		}
		
		$script .= '<script type="text/javascript">'.eol();
		
		// True ise $(document).ready({ }) kodunu dahil et.
		if( $ready === true )
		{
			$script .= '$(document).ready(function()'.eol().'{'.eol();
		}
		
		return $script;
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html </script> tagının kullanımıdır. Yani Script tagını kapatmak için.  |
	|															                              |
	| Parametreler: Herhangi parametresi yoktur.                                              |
	|          																				  |
	| Örnek Kullanım: close();        	  					                                  |
	|          																				  |
	******************************************************************************************/	
	public function close()
	{	
		$script = "";
		
		// True ise ready kodunun devamını sona 
		// eklemek için bu kontrol yapılıyor.
		if( $this->ready === true )
		{
			$this->ready = NULL;
			$script .= eol().'});'.eol();
		}
		
		$script .=  '</script>'.eol();
		
		return $script;
	}
	
	/******************************************************************************************
	* READY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: open() yöntemini kullanırken zaten ready satırlar ilave ediliyor. Fakat |
	| bunun dışında extra kullanımına ihtiyaç duyabilmeniz ihtimaline karşın oluşturulmuştur. |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @codes => $(document).ready(function(){}) kodu içine yazılacak kodlar.	  |
	|          																				  |
	| Örnek Kullanım: ready('alert(1);');        	  					                      |
	| $(document).ready(function(){ alert(1); });         									  |
	|															                              |
	******************************************************************************************/	
	public function ready($codes = '')
	{
		if( ! is_string($codes) ) 
		{
			return false;
		}
		
		$ready = '$(document).ready(function()'.eol().'{'.eol().$codes.eol().'});'.eol();
		
		return $ready;
	}
	
	/******************************************************************************************
	* EVENT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 2. string var @event_type => Olayın türü. Varsayılan:click  				              |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: event('#nesne', 'mouseover', 'alert(1);');        	  				  |
	| $('#nesne').bind('mouseover', function(e){ alert(1); });         						  |
	|															                              |
	******************************************************************************************/	
	public function event($element = 'this', $eventType = 'click', $callback = '')
	{	
		if( ! is_string($element) )
		{
			$element = 'this';
		}
		if( ! is_string($eventType) ) 
		{
			$eventType = 'click';
		}
		if( ! is_string($callback) ) 
		{
			$callback = '';
		}
		
		$element = ( in_array($element, $this->keywords) )
				   ? $element
				   : "\"$element\"";
		
		$event = '$('.$element.').bind("'.$eventType.'", function(e)'.eol().'{'.eol().$callback.eol().'});'.eol();
		
		return $event;
	}	
	
	// Olay olşturmak için
	protected function _event($type = '', $element = 'this', $callback = '', $callback2 = '')
	{	
		if( ! is_string($element) )
		{
			$element = 'this';
		}
		if( ! is_string($type) ) 
		{
			$type = 'click';
		}
		if( ! is_string($callback) ) 
		{
			$callback = '';
		}		
		
		if( ! is_string($callback2) ) 
		{
			$callback2 = '';
		}
		
		if( ! empty($callback2))
		{
			$callback2 = ", function(e)".eol()."{".eol().$callback2.eol()."}";
		}
		
		$element = ( in_array($element, $this->keywords) )
				   ? $element
				   : "\"$element\"";
		
		$event = '$('.$element.').'.$type.'(function(e)'.eol().'{'.eol().$callback.eol().'}'.$callback2.');'.eol();
		
		return $event;
	}	
	
	/******************************************************************************************
	* CLICK                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: click('#nesne', 'alert(1);');                     	  				  |
	|															                              |
	******************************************************************************************/	
	public function click($element = 'this', $callback = '')
	{
		return $this->_event('click', $element, $callback);
	}
	
	/******************************************************************************************
	* BLUR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: blur('#nesne', 'alert(1);');                  	     				  |
	|															                              |
	******************************************************************************************/	
	public function blur($element = 'this', $callback = '')
	{
		return $this->_event('blur', $element, $callback);
	}
	
	/******************************************************************************************
	* CHANGE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: change('#nesne',             'alert(1);');        	     			  |
	|															                              |
	******************************************************************************************/	
	public function change($element = 'this', $callback = '')
	{
		return $this->_event('change', $element, $callback);
	}
	
	/******************************************************************************************
	* DOUBLE CLICK                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: dblclick('#nesne', 'alert(1);');        	     						  |
	|															                              |
	******************************************************************************************/	
	public function dblClick($element = 'this', $callback = '')
	{
		return $this->_event('dblclick', $element, $callback);
	}
	
	/******************************************************************************************
	* RESIZE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: resize('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function resize($element = 'this', $callback = '')
	{
		return $this->_event('resize', $element, $callback);
	}
	
	/******************************************************************************************
	* SCROLL                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: scroll('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function scroll($element = 'this', $callback = '')
	{
		return $this->_event('scroll', $element, $callback);
	}
	
	/******************************************************************************************
	* LOAD                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: load('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function load($element = 'this', $callback = '')
	{
		return $this->_event('load', $element, $callback);
	}
	
	/******************************************************************************************
	* UNLOAD                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: unload('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function unload($element = 'this', $callback = '')
	{
		return $this->_event('unload', $element, $callback);
	}	
	
	/******************************************************************************************
	* FOCUS                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: focus('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function focus($element = 'this', $callback = '')
	{
		return $this->_event('focus', $element, $callback);
	}
	
	/******************************************************************************************
	* FOCUSIN                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: focusIn('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function focusIn($element = 'this', $callback = '')
	{
		return $this->_event('focusin', $element, $callback);
	}
	
	/******************************************************************************************
	* FOCUSOUT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: focusOut('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function focusOut($element = 'this', $callback = '')
	{
		return $this->_event('focusout', $element, $callback);
	}
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: select('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function select($element = 'this', $callback = '')
	{
		return $this->_event('select', $element, $callback);
	}
	
	/******************************************************************************************
	* SUBMIT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: submit('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function submit($element = 'this', $callback = '')
	{
		return $this->_event('submit', $element, $callback);
	}
	
	/******************************************************************************************
	* KEYDOWN                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: keyDown('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function keyDown($element = 'this', $callback = '')
	{
		return $this->_event('keydown', $element, $callback);
	}
	
	/******************************************************************************************
	* KEYPRESS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: keyPress('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function keyPress($element = 'this', $callback = '')
	{
		return $this->_event('keypress', $element, $callback);
	}
	
	/******************************************************************************************
	* KEYUP                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: keyUp('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function keyUp($element = 'this', $callback = '')
	{
		return $this->_event('keyup', $element, $callback);
	}
	
	/******************************************************************************************
	* HOVER                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: hover('#nesne', 'alert(1);');                     	     			  |
	|															                              |
	******************************************************************************************/	
	public function hover($element = 'this', $callback = '')
	{
		return $this->_event('hover', $element, $callback);
	}
	
	/******************************************************************************************
	* MOUSEOVER                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: mouseDown('#nesne', 'alert(1);');                     	     	      |
	|															                              |
	******************************************************************************************/	
	public function mouseDown($element = 'this', $callback = '')
	{
		return $this->_event('mousedown', $element, $callback);
	}
	
	/******************************************************************************************
	* MOUSEENTER                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: mouseEnter('#nesne', 'alert(1);');                     	     	      |
	|															                              |
	******************************************************************************************/	
	public function mouseEnter($element = 'this', $callback = '')
	{
		return $this->_event('mouseenter', $element, $callback);
	}
	
	/******************************************************************************************
	* MOUSELEAVE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: mouseLeave('#nesne', 'alert(1);');                     	     	      |
	|															                              |
	******************************************************************************************/	
	public function mouseLeave($element = 'this', $callback = '')
	{
		return $this->_event('mouseleave', $element, $callback);
	}
	
	/******************************************************************************************
	* MOUSEMOVE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: mouseMove('#nesne', 'alert(1);');                     	     	      |
	|															                              |
	******************************************************************************************/	
	public function mouseMove($element = 'this', $callback = '')
	{
		return $this->_event('mousemove', $element, $callback);
	}
	
	/******************************************************************************************
	* MOUSEOUT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: mouseOut('#nesne', 'alert(1);');                     	     	          |
	|															                              |
	******************************************************************************************/	
	public function mouseOut($element = 'this', $callback = '')
	{
		return $this->_event('mouseout', $element, $callback);
	}
	
	/******************************************************************************************
	* MOUSEOVER                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: mouseOver('#nesne', 'alert(1);');                     	     	      |
	|															                              |
	******************************************************************************************/	
	public function mouseOver($element = 'this', $callback = '')
	{
		return $this->_event('mouseover', $element, $callback);
	}
	
	/******************************************************************************************
	* MOUSEUP                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: mouseUp('#nesne', 'alert(1);');                     	     	          |
	|															                              |
	******************************************************************************************/	
	public function mouseUp($element = 'this', $callback = '')
	{
		return $this->_event('mouseup', $element, $callback);
	}
	
	/******************************************************************************************
	* TOGGLE CLICK                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jquery olay nesnesi oluşturmak için kullanılır.                         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @element => Olayın uygulanacağı seçici nesnesidir. Örnek: this, '.nesne'  |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: tglClick('#nesne', 'alert(1);');                     	     	          |
	|															                              |
	******************************************************************************************/	
	public function tglClick($element = 'this', $callback = '', $callback2 = '')
	{
		return $this->_event('toggle', $element, $callback, $callback2);
	}
	
	// Jquery nesneleri için.
	protected function _object($type = '', $element = "this", $speed = "", $easing = "",$callback = "")
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! isChar($speed) ) 
		{
			$speed = '';
		}
		
		if( ! is_string($callback) )
		{
			$callback = '';
		}
		
		if( ! empty($callback) )
		{
			$callback = ", function(){".eol().$callback.eol()."}";
		}
		if( ! empty($easing)) 
		{
			$easing = ", '".$easing."'"; 
		}
		
		$element = ( in_array($element, $this->keywords) )
				   ? $element
				   : "\"$element\"";
		
		$speed = ( is_numeric($speed) )
				 ? $speed
				 : "\"$speed\"";
		
		$str  = "$($element).$type({$speed}{$easing}{$callback});".eol();
		
		return $str;
	}
	
	/******************************************************************************************
	* FADE IN                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Jquery Fade animasyonu eklemek için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: fadeIn('#nesne', 1000, 'alert(1);');        	  				          |
	| $('#nesne').fadeIn(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public function fadeIn($element = 'this', $speed = '', $callback = '')
	{
		return $this->_object('fadeIn', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* FADE OUT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery Fade animasyonu eklemek için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: fadeOut('#nesne', 1000, 'alert(1);');        	  				          |
	| $('#nesne').fadeOut(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public function fadeOut($element = 'this', $speed = '', $callback = '')
	{
		return $this->_object('fadeOut', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* SLIDE UP                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Jquery Slide animasyonu eklemek için kullanılır.                        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: slideUp('#nesne', 1000, 'alert(1);');        	  				          |
	| $('#nesne').slideUp(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public function slideUp($element = 'this', $speed = '', $callback = '')
	{
		return $this->_object('slideUp', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* SLIDE DOWN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Jquery Slide animasyonu eklemek için kullanılır.                        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: slideDown('#nesne', 1000, 'alert(1);');        	  				      |
	| $('#nesne').slideDown(1000, function(e){ alert(1); });         						  |
	|															                              |
	******************************************************************************************/	
	public function slideDown($element = 'this', $speed = '', $callback = '')
	{
		return $this->_object('slideDown', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* SLIDE TOGGLE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jquery Slide animasyonu eklemek için kullanılır.                        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: slideToggle('#nesne', 1000, 'alert(1);');        	  				      |
	| $('#nesne').slideToggle(1000, function(e){ alert(1); });         						  |
	|															                              |
	******************************************************************************************/	
	public function slideToggle($element = 'this', $speed = '', $callback = '')
	{
		return $this->_object('slideToggle', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* TOGGLE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Jquery Toggle olayını eklemek için kullanılır.                          |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @easing => Geçiş animasyonu eklemek içindir.  				              |
	| 4. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: toggle('#nesne', 'up', 1000, 'alert(1);');        	  				  |
	| $('#nesne').toggle(1000, "easeInOut", function(e){ alert(1); });         				  |
	|															                              |
	******************************************************************************************/	
	public function toggle($element = "this", $speed = "", $easing = "", $callback = "")
	{
		return $this->_object('toggle', $element, $speed, $easing, $callback);
	}
	
	/******************************************************************************************
	* HIDE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery Hide animasyonu eklemek için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: hide('#nesne', 'up', 1000, 'alert(1);');        	  				      |
	| $('#nesne').hide(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public function hide($element = 'this', $speed = '', $callback = '')
	{
		return $this->_object('hide', $element, $speed, NULL, $callback);
	}
	
	/******************************************************************************************
	* SHOW                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery Hide animasyonu eklemek için kullanılır.                         |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 3. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| Örnek Kullanım: show('#nesne', 'up', 1000, 'alert(1);');        	  				      |
	| $('#nesne').show(1000, function(e){ alert(1); });         						      |
	|															                              |
	******************************************************************************************/	
	public function show($element = 'this', $speed = '', $callback = '')
	{
		return $this->_object('show', $element, $speed, NULL, $callback);
	}	
	
	/******************************************************************************************
	* ANIMATE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Jquery animate nesnesini kullanarak animasyon oluşturmak için kullanılır|
	|															                              |
	| Parametreler: 5 parametresi vardır.                                              	      |
	| 1. string var @element => Animasyonun uygulanacağı seçici nesnesidir. Örnek: this       |
	| 2. array var @params => Animasyona öğe eklemek için kullanılır.                         |
	| 3. mixed var @speed => Animasyonun hızı. Örnek: slow, fast, 1000 				          |
	| 4. string var @easing => Geçiş animasyonu eklemek içindir.  				              |
	| 5. string var @callback => Olay sonunda çalıştırılması istenen kodlar.                  |
	|          																				  |
	| $anismasyon_nesneleri = array															  |
	| (																						  |		
	|  	  'width' => '400px', 																  |
	|  	  'height' => '300px',                                                                |
	|  	  'opacity' => '.5',                                                                  |
	|  	  'boderWidth' => '10px'                                                              |
	| );																					  |
	|  																						  |
	| $mili_salise = '';																      |
	|  																						  |
	| $efektler = array																		  |
	| (																						  |
	|  	  'duration' => '1000', 															  |		
	|	  'specialEasing' => array('width' => 'easeOutBounce', 'height' => 'easeOutBounce')   |
	| );																					  |
	|																						  |
	| $kodlar = 'alert("Animasyon Tamamlandı")';                                              |
	|          																			      |
    | jquery::animate('#nesne', $anismasyon_nesneleri, $mili_salise, $efektler, $kodlar );    |
	|															                              |
	******************************************************************************************/	
	public function animate($element = 'this', $params = array(), $speed = '', $easing = '', $complete = '')
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_array($params) ) 
		{
			$params = array();
		}
		
		if( ! isChar($speed))  
		{
			$speed = '';
		}
		
		if( ! is_string($complete) ) 
		{
			$complete = '';
		}
		
		$jsAnimate = '';
		
		$animate = "\t\t";
		
		if( ! empty($params) )
		{
			$animate .= $this->objectData($params);
		}
		
		if( ! empty($speed) )
		{
			if( is_numeric($speed ) )    
			{
				$speed = ",".eol()."\t\t$speed";
			}
			else
			{
				$speed = ",".eol()."\t\t'".$speed."'";
			}
		}
	
		if( is_array($easing) )
		{
			$ease = ",".eol()."\t\t".$this->objectData($easing);			
			$easing = $ease;
	
		}
		else if( ! empty($easing) ) 
		{
			$easing   = ",".eol()."\t\t'".$easing."'";
		}
		
		if( ! empty($complete) )
		{
			$complete = ",".eol()."\t\tfunction(){".$complete."}";
		}
		
		$element = ( in_array($element, $this->keywords) )
				   ? $element
				   : "\"$element\"";
		
		$jsAnimate = "\t$($element).animate(".eol().$animate.$speed.$easing.$complete.eol()."\t);".eol();
		
		return $jsAnimate;
		
	}
	
	/******************************************************************************************
	* AJAX                                                                               	  *
	*******************************************************************************************
	| Genel Kullanım: Ajax ile veri gönderimi için kullanılır.								  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @methods => Ajax işlemleri için gerekli veriler.							  |
	|          																				  |
	| @methods parametresinin alabileceği değerler:											  |
	| type, url, dataType, error, success, complete, beforeSend, done ve diğer özellikler	  |
	******************************************************************************************/	
	public function ajax($methods = array())
	{
		return Ajax::send($methods);
	}
	
	// Jquery css class yapısı eklemek için.
	protected function _class($classType = '', $element = 'this', $class = '')
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_string($classType) ) 
		{
			$classType = '';
		}
		
		if( ! is_string($class) ) 
		{
			$class = '';
		}
		
		$element = ( in_array($element, $this->keywords) )
				   ? $element
				   : "\"$element\"";
		
		$str  = "\t$($element).$classType(\"$class\");".eol();
		
		return $str;
	}
	
	/******************************************************************************************
	* ADD CLASS                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Jquery addClass nesnesinden yararlanmak için kullanılır.                |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string var @class => Eklenecek css sınıfları.                                        |
	|          																				  |
	| Örnek Kullanım: addClass('#nesne', 'red-color, bold');        	  				      |
	| $('#nesne').addClass('red-color, bold');         						                  |
	|															                              |
	******************************************************************************************/	
	public function addClass($element = '', $class = '')
	{
		return $this->_class('addClass', $element, $class);
	}
	
	/******************************************************************************************
	* REMOVE CLASS                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jquery removeClass nesnesinden yararlanmak için kullanılır.             |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string var @class => Kaldırılacak css sınıfları.                                     |
	|          																				  |
	| Örnek Kullanım: removeClass('#nesne', 'red-color, bold');        	  				      |
	| $('#nesne').removeClass('red-color, bold');         						              |
	|															                              |
	******************************************************************************************/	
	public function removeClass($element = '', $class = '')
	{
		return $this->_class('removeClass', $element, $class);
	}
	
	/******************************************************************************************
	* TOGGLE CLASS                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Jquery toggleClass nesnesinden yararlanmak için kullanılır.             |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string var @class => Kaldırılacak css sınıfları.                                     |
	|          																				  |
	| Örnek Kullanım: toggleClass('#nesne', 'red-color, bold');        	  				      |
	| $('#nesne').toggleClass('red-color, bold');         						              |
	|															                              |
	******************************************************************************************/	
	public function toggleClass($element = '', $class = '')
	{
		return $this->_class('toggleClass', $element, $class);
	}
	
	// Jquery attr yapısı eklemek için. 
	protected function _attr($type = '', $element = "this", $attrs = "")
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'attr';
		}
		
		$attr = '';
		
		if( is_array($attrs) )
		{
			$attr .= $this->objectData($attrs);
		}
		else
		{
			$attrEx = explode(",", $attrs);
	
			$attr = "\"$attrEx[0]\"";	
			
			if( isset($attrEx[1]) )
			{
				$attr .= ', "'.trim($attrEx[1]).'"';	
			}
		}
			
		$element = ( in_array($element, $this->keywords) )
				   ? $element
				   : "\"$element\"";
		
		$str  = "\t$($element).$type($attr);".eol();
		
		return $str;
	}
	
	/******************************************************************************************
	* ATTR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery attr nesnesinden yararlanmak için kullanılır.                    |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string/array var @attr => Özellik eklemek için kullanılır. 2 tip parametre kullanır. |
	| Tek bir özellik ve değer eklenecekse string tipte parametre girilebilir ancak birden    |
	|  fazla özellik değer çiftli eklenecekse parametreye dizi tipi veri girilmelidir.        |
	|          																				  |
	| Örnek Kullanım: attr('#nesne', 'name, isim');        	  				                  |
	| $('#nesne').attr("name", "isim");         						                      |
	|															                              |
	| Örnek Kullanım: attr('#nesne', array('name' => 'isim', 'id' => 'nesne'));        	  	  |
	| $('#nesne').attr({"name":"isim", "id":"nesne"});         	                              |
	|															                              |
	******************************************************************************************/	
	public function attr($element = '', $attr = '')
	{
		return $this->_attr('attr', $element, $attr);
	}
	
	/******************************************************************************************
	* REMOVE ATTR                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Jquery removeAttr nesnesinden yararlanmak için kullanılır.              |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Kodun uygulanacağı seçici nesnesidir. Örnek: this             |
	| 3. string/array var @attr => Özellik kaldırmak için kullanılır. 2 tip parametre kullanır|
	| Tek bir özellik kaldırılacaksa string tipte parametre girilebilir ancak birden          |
	|  fazla özellik kaldırılacaksa parametreye dizi tipi veri girilmelidir.                  |
	|          																				  |
	| Örnek Kullanım: removeAttr('#nesne', 'name');        	  				                  |
	| $('#nesne').removeAttr("name");         						                          |
	|															                              |
	| Örnek Kullanım: removeAttr('#nesne', array('name', 'id'));        	  	              |
	| $('#nesne').removeAttr({"name", "id"});         	                                      |
	|															                              |
	******************************************************************************************/	
	public function removeAttr($element = '', $attr = '')
	{
		return $this->_attr('removeAttr', $element, $attr);
	}
	
	/******************************************************************************************
	* FUNC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery fonksiyon nesnesinden yararlanmak için kullanılır.               |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @property => Fonksiyonun propertisidir. Örnek: attr, class, bind          |
	| 2. string var @params => Fonksiyonun parametreleri belirtilir.                          |
	| 3. string var @code => Fonksiyonun çalıştıracağı kodlar yazılır.                        |
	|          																				  |
	| Örnek Kullanım: func('success', 'e1, e2', 'alert(1);');        	  				      |
	| :function(e1, e2){ alert(1); }         						                          |
	|															                              |
	******************************************************************************************/	
	public function func($property = 'this', $params = 'e', $code = '')
	{
		if( ! is_string($property) ) 
		{
			$element = NULL;
		}
		
		if( ! is_string($params) ) 
		{
			$params = 'e';
		}
		
		if( ! is_string($code) )
		{
			$code = '';
		}
		
		$func = '';
		
		if( ! empty($property) )
		{
			$func = "\t".$property.":";	
		}
		$func .= 'function('.$params.'){'.eol()."\t\t".$code.eol()."\t".'}'.eol();
		
		return $func;
	}
	
	/******************************************************************************************
	* CALLBACK / FUNC                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Jquery fonksiyon nesnesinden yararlanmak için kullanılır.               |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @property => Fonksiyonun propertisidir. Örnek: attr, class, bind          |
	| 2. string var @params => Fonksiyonun parametreleri belirtilir.                          |
	| 3. string var @code => Fonksiyonun çalıştıracağı kodlar yazılır.                        |
	|          																				  |
	| Örnek Kullanım: callback('success', 'e1, e2', 'alert(1);');        	  				  |
	| :function(e1, e2){ alert(1); }         						                          |
	|															                              |
	******************************************************************************************/	
	public function callback($element = 'this', $params = 'e', $code = '')
	{
		return $this->func($element, $params, $code);	
	}
	
	/******************************************************************************************
	* OBJECT DATA                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Parametre olarak girilen dizi verilerini object veri türüne çevirir.    |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. array var @data => Object türe çevrilecek dizi bilgisi.                              |
	|          																				  |
	| Örnek Kullanım: objectData(array(1 => 'a', 2 => 'b'));        	  				      |  
	| {1:'a', 2:'b'}        						                                          |
	|															                              |
	******************************************************************************************/	
	public function objectData($data = array())
	{
		return Arrays::objectData($data);
	}
	
	/******************************************************************************************
	* CODE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Jquery tipi kod yazmak için kullanılır.                                 |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @element => Fonksiyonun yazılacağı erişim nesnesi. this .nesne #nesne     |
    | 2. string var @property => Fonksiyonun propertisidir. Örnek: attr, class, bind          |
	| 3. string var @code => Fonksiyonun çalıştıracağı kodlar yazılır.                        |
	|          																				  |
	| Örnek Kullanım: code('#nesne', 'bind' '"click", function(e){alert("1")}');        	  |
	| $("$nesne").bind("click", function(e){alert("1")});       						      |                       
	|															                              |
	******************************************************************************************/	
	public function code($element = 'this', $property = '', $code = '')
	{
		if( ! is_string($element) ) 
		{
			$element = 'this';
		}
		
		if( ! is_string($code) ) 
		{
			$code = '';
		}
		
		$element = ( in_array($element, $this->keywords) )
				   ? $element
				   : "\"$element\"";
		
		$code = "$($element).$property($code);".eol();
		
		return $code;
	}
}