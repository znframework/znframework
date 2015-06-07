<?php
/************************************************************/
/*                     COMPONENT  AJAX                   	*/
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
require_once(COMPONENTS_DIR.'Jquery/Common.php');
/******************************************************************************************
* AJAX                                                                                    *
*******************************************************************************************
| Dahil(Import) Edilirken : Jquery/Ajax     							     			  |
| Sınıfı Kullanırken      :	$this->ajax->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Ajax extends ComponentJqueryCommon
{
	/* Function Variables
	 * success, error, complete...
	 *
	 * 
	 */
	protected $functions = array();
	
	/* Properties Variables
	 * url, method, data...
	 *
	 * 
	 */
	protected $sets = array();
	
	/* Callback Functions
	 * .done, .always, .then .fail
	 *
	 * 
	 */
	protected $callbacks = array();
	
	
	// URL Property ---------------------------------------------------------------
	// Ajax URL = 'example/ex' : "http://www.example.xxx/example/ex"
	// Ajax URL = 'http://www.example/example/ex' : "http://www.example/example/ex"
	public function url($url = '')
	{
		if( ! is_string($url))
		{
			return $this;	
		}
		
		if( ! is_url($url))
		{
			$url = site_url($url);	
		}
		
		$this->sets['url'] = "\turl:\"$url\",".ln();
		
		return $this;	
	}
	
	// DATA Property --------------------------------------------------------------
	// Ajax send data
	// data:'example=1&data=2'
	public function data($data = '')
	{
		if( ! is_value($data))
		{
			return $this;	
		}
		
		$this->sets['data'] = "\tdata:$data,".ln();
		
		return $this;	
	}
	
	// HEADERS Property -----------------------------------------------------------
	// Headers data
	// headers:{ h1, h2}
	public function headers($headers = '')
	{
		if( ! is_value($headers))
		{
			return $this;	
		}
		
		$this->sets['headers'] = "\theaders:$headers,".ln();
		
		return $this;	
	}
	
	// IF MODIFIED Property -------------------------------------------------------
	// ifModified data
	// ifModified:true or false
	public function if_modified($if_modified = true)
	{
		if( ! is_value($if_modified))
		{
			return $this;	
		}
		$if_modified = $this->_booltostr($if_modified);
		$this->sets['if_modified'] = "\tifModified:$if_modified,".ln();
		
		return $this;	
	}
	
	// IS LOCAL Property ---------------------------------------------------------
	// isLocal data
	// isLocal:true or false
	public function is_local($is_local = true)
	{
		if( ! is_value($is_local))
		{
			return $this;	
		}
		$is_local = $this->_booltostr($is_local);
		$this->sets['is_local'] = "\tisLocal:$is_local,".ln();
		
		return $this;	
	}
	
	
	// MIME TYPE Property -------------------------------------------------------
	// mimeType data
	// mimeType:true or false
	public function mime_type($mime_type = true)
	{
		if( ! is_value($mime_type))
		{
			return $this;	
		}
		$mime_type = $this->_booltostr($mime_type);
		$this->sets['mime_type'] = "\tmimeType:$mime_type,".ln();
		
		return $this;	
	}
	
	// JSONP Property -----------------------------------------------------------
	// jsonp data
	// jsonp:string or bool
	// is string : "example data"
	// is bool	 : true
	public function jsonp($jsonp = '')
	{
		if(is_bool($jsonp))
		{
			$jsonp = $this->_booltostr($jsonp);	
		}
		elseif(is_string($jsonp))
		{
			$jsonp = "\"$jsonp\"";
		}
		else
		{
			return $this;
		}
		
		$this->sets['jsonp'] = "\tjsonp:$jsonp,".ln();
		
		return $this;	
	}
	
	// JSONP CALLBACK Property ---------------------------------------------------
	// jsonpCallback data
	// jsonpCallback:string or function
	// is string 	 : "example data"
	// is function	 : function(){}
	public function jsonp_callback($jsonp_callback = '')
	{
		if( ! is_value($jsonp_callback))
		{
			return $this;	
		}
		
		if($this->_is_func($jsonp_callback) === false)
		{
			$jsonp_callback = "\"$jsonp_callback\"";
		}
		
		$this->sets['jsonp_callback'] = "\tjsonpCallback:$jsonp_callback,".ln();
		
		return $this;	
	}
	
	// DATA TYPE Property -------------------------------------------------------
	// dataType data
	// dataType:string : json, script, html ...
	public function data_type($type = '')
	{
		if( ! is_string($type))
		{
			return $this;	
		}
		
		$this->sets['type'] = "\tdataType:\"$type\",".ln();
		
		return $this;
	}
	
	// PASSWORD Property -------------------------------------------------------
	// password data
	// password:string
	public function password($password = '')
	{
		if( ! is_string($password))
		{
			return $this;	
		}
		
		$this->sets['password'] = "\tpassword:\"$password\",".ln();
		
		return $this;
	}
	
	// USERNAME Property -------------------------------------------------------
	// username data
	// username:string
	public function username($username = '')
	{
		if( ! is_string($username))
		{
			return $this;	
		}
		
		$this->sets['username'] = "\tusername:\"$username\",".ln();
		
		return $this;
	}
	
	// METHOD/TYPE Property ----------------------------------------------------
	// type() = method() 
	// type data
	// type:string : post, get ...
	public function method($method = 'post')
	{
		if( ! is_string($method))
		{
			return $this;	
		}
		
		$this->sets['method'] = "\ttype:\"$method\",".ln();
		
		return $this;
	}
	
	// METHOD/TYPE Property ----------------------------------------------------
	// type() = method() 
	// type data
	// type:string : post, get ...
	public function type($method = 'post')
	{
		if( ! is_string($method))
		{
			return $this;	
		}
		
		$this->sets['method'] = "\ttype:\"$method\",".ln();
		
		return $this;
	}
	
	// SCRIPT CHARSET Property -------------------------------------------------------
	// scriptCharset data
	// scriptCharset:string
	public function script_charset($script_charset = 'utf-8')
	{
		if( ! is_string($script_charset))
		{
			return $this;	
		}
		
		$this->sets['script_charset'] = "\tscriptCharset:\"$script_charset\",".ln();
		
		return $this;
	}
	
	// TRADITIONAL Property -------------------------------------------------------
	// traditional data
	// traditional:bool: true or false
	public function traditional($traditional = true)
	{
		if( ! is_string($traditional))
		{
			return $this;	
		}
		$traditional = $this->_booltostr($traditional);
		$this->sets['traditional'] = "\ttraditional:$traditional,".ln();
		
		return $this;
	}
	
	// PROCESS DATA Property -------------------------------------------------------
	// processData data
	// processData:bool: true or false
	public function process_data($process_data = true)
	{
		if( ! is_value($process_data))
		{
			return $this;	
		}
		$process_data = $this->_booltostr($process_data);
		$this->sets['process_data'] = "\tprocessData:$process_data,".ln();
		
		return $this;
	}
	
	// CACHE Property -------------------------------------------------------
	// cache data
	// cache:bool: true or false
	public function cache($cache = true)
	{
		if( ! is_value($cache))
		{
			return $this;	
		}
		$cache = $this->_booltostr($cache);
		$this->sets['cache'] = "\tcache:$cache,".ln();
		
		return $this;
	}
	
	// XHR FIELDS Property -------------------------------------------------------
	// xhrFields data
	// xhrFields:string
	public function xhr_fields($xhr_fields = '')
	{
		if( ! is_string($xhr_fields))
		{
			return $this;	
		}
		
		$this->sets['xhr_fields'] = "\txhrFields:$xhr_fields,".ln();
		
		return $this;
	}
	
	// CONTEXT Property -------------------------------------------------------
	// context data
	// context:plain object
	public function context($context = '')
	{
		if( ! is_value($context))
		{
			return $this;	
		}
		
		$this->sets['context'] = "\tcontext:$context,".ln();
		
		return $this;
	}
	
	// ACCEPTS Property -------------------------------------------------------
	// accepts data
	// accepts:plain object
	public function accepts($accepts = '')
	{
		if( ! is_string($accepts))
		{
			return $this;	
		}
		
		$this->sets['accepts'] = "\taccepts:$accepts,".ln();
		
		return $this;
	}
	
	// CONTENTS Property -------------------------------------------------------
	// contents data
	// contents:plain object
	public function contents($contents = '')
	{
		if( ! is_string($contents))
		{
			return $this;	
		}
		
		$this->sets['contents'] = "\tcontents:$contents,".ln();
		
		return $this;
	}
	
	// ASYNC Property -------------------------------------------------------
	// async data
	// async:bool: true or false
	public function async($async = true)
	{
		if( ! is_value($async))
		{
			return $this;	
		}
		$async = $this->_booltostr($async);
		$this->sets['async'] = "\tasync:$async,".ln();
		
		return $this;
	}
	
	// CROSS DOMAIN Property -------------------------------------------------------
	// crossDomain data
	// crossDomain:bool: true or false
	public function cross_domain($cross_domain = true)
	{
		if( ! is_value($cross_domain))
		{
			return $this;	
		}
		$cross_domain = $this->_booltostr($cross_domain);
		$this->sets['cross_domain'] = "\tcrossDomain:$cross_domain,".ln();
		
		return $this;
	}
	
	// TIMEOUT Property -------------------------------------------------------
	// timeout data
	// timeout:numeric
	public function timeout($timeout = '')
	{
		if( ! is_value($timeout))
		{
			return $this;	
		}
		
		$this->sets['timeout'] = "\ttimeout:$timeout,".ln();
		
		return $this;
	}
	
	// GLOBAL Property -------------------------------------------------------
	// global data
	// global:bool : true or false
	// global is keywords so global is name globals
	public function globals($globals = true)
	{
		if( ! is_value($globals))
		{
			return $this;	
		}
		$globals = $this->_booltostr($globals);
		$this->sets['globals'] = "\tglobal:$globals,".ln();
		
		return $this;
	}
	
	// CONTENT TYPE Property -------------------------------------------------------
	// contentType data
	// contentType:bool or string
	// is bool  : true or false
	// is_string: 'application/x-www-form-urlencoded; charset=UTF-8'
	public function content_type($content_type = 'application/x-www-form-urlencoded; charset=UTF-8')
	{
	
		if(is_bool($content_type))
		{
			$content_type = $this->_booltostr($content_type);		
		}
		elseif(is_string($content_type))
		{
			$content_type = "\"$content_type\"";
		}
		else
		{
			return $this;	
		}
		
		$this->sets['content_type'] = "\tcontentType:$content_type,".ln();
		
		return $this;
	}
	
	protected function _object($name, $codes = array())
	{
		if( ! is_array($codes))
		{
			return $this;	
		}	
		
		$status_code = ln()."\t$name:".ln()."\t{";
		
		if( ! empty($codes))
		{
			foreach($codes as $code => $value)
			{
				$param = '';
				if(strstr($value, '->'))
				{
					$params = explode('->', $value);	
					$param = $params[0];
					$value = $params[1];
				}
				
				$status_code .= ln()."\t\t$code:function($param)".ln()."\t\t{".ln()."\t\t\t$value".ln()."\t\t},".ln();
			}
			$status_code = trim(trim($status_code), ',').ln();
		}
		$status_code .= "\t}";
		
		$this->functions[$name] = ln()."\t".$status_code;
	}
	
	// STATUS CODE Property -------------------------------------------------------
	// statusCode data
	// statusCode:array
	// array(404 => 'alert(404);', 403 => 'alert(403);') 
	// To use parameters :::::    param1, param2->codes...   ::::: function(param1, param2){codes}
	// -> parameters and codes is seperators
	// array(404 => 'data->alert(data);', 403 => 'data->alert(data);')
	public function status_code($codes = array())
	{
		$this->_object('statusCode', $codes);
			
		return $this;
	}
	
	// CONVERTERS Property -------------------------------------------------------
	// converters data
	// converters:array
	// To use parameters :::::    param1, param2->codes...   ::::: function(param1, param2){codes}
	// -> parameters and codes is seperators
	// array('C1' => 'alert('c1');', C2 => 'param1, param2->alert('c2');') 
	public function converters($codes = array())
	{
		$this->_object('converters', $codes);
			
		return $this;
	}
	
	
	protected function _functions($name, $params, $codes)
	{
		if( ! ( is_string($params) || is_string($codes) ) )
		{
			return $this;
		}
		
		$this->functions[$name] = ln()."\t$name:function($params)".ln()."\t{".ln()."\t\t$codes".ln()."\t}";
	}
	
	// SUCCESS FUNCTION Property -------------------------------------------------------
	// success data
	// success: 2 Parameters
	// string @params : 'param1, param2'
	// string @success: 'alert("example")'
	public function success($params = 'e', $success = '')
	{
		$this->_functions('success', $params, $success);	
		
		return $this;
	}
	
	// ERROR FUNCTION Property -------------------------------------------------------
	// error data
	// error: 2 Parameters
	// string @params : 'param1, param2'
	// string @error  : 'alert("example")'
	public function error($params = 'e', $error = '')
	{
		$this->_functions('error', $params, $error);	
	
		return $this;
	}
	
	// COMPLETE FUNCTION Property -------------------------------------------------------
	// complete data
	// complete: 2 Parameters
	// string @params    : 'param1, param2'
	// string @complete  : 'alert("example")'
	public function complete($params = 'e', $complete = '')
	{
		$this->_functions('complete', $params, $complete);
		
		return $this;	
	}
	
	// BEFORE SEND FUNCTION Property -------------------------------------------------------
	// beforeSend data
	// beforeSend: 2 Parameters
	// string @params       : 'param1, param2'
	// string @before_send  : 'alert("example")'
	public function before_send($params = 'e', $before_send = '')
	{
		$this->_functions('beforeSend', $params, $before_send);
		
		return $this;
	}	
	
	// DATA FILTER FUNCTION Property -------------------------------------------------------
	// dataFilter data
	// dataFilter: 2 Parameters
	// string @params       : 'param1, param2'
	// string @data_filter  : 'alert("example")'
	public function data_filter($params = 'e', $data_filter = '')
	{
		$this->_functions('dataFilter', $params, $data_filter);
		
		return $this;
	}
	
	protected function _callbacks($name, $params, $codes)
	{
		if( ! ( is_string($params) || is_string($codes) ) )
		{
			return $this;
		}
		
		$this->callbacks[$name] = ln().".$name(function($params)".ln()."{".ln()."\t$codes".ln()."})";
	}	
	
	// DONE CALLBACK FUNCTION Property -------------------------------------------------------
	// done data
	// done: 2 Parameters
	// string @params : 'param1, param2'
	// string @done   : 'alert("example")'
	public function done($params = 'e', $done = '')
	{
		$this->_callbacks('done', $params, $done);
		
		return $this;
	}
	
	// FAIL CALLBACK FUNCTION Property -------------------------------------------------------
	// fail data
	// fail: 2 Parameters
	// string @params : 'param1, param2'
	// string @fail   : 'alert("example")'
	public function fail($params = 'e', $fail = '')
	{
		$this->_callbacks('fail', $params, $fail);
		
		return $this;
	}
	
	// ALWAYS CALLBACK FUNCTION Property -------------------------------------------------------
	// always data
	// always: 2 Parameters
	// string @params : 'param1, param2'
	// string @always : 'alert("example")'
	public function always($params = 'e', $always = '')
	{
		$this->_callbacks('always', $params, $always);
		
		return $this;
	}
	
	// THEN CALLBACK FUNCTION Property -------------------------------------------------------
	// then data
	// then: 2 Parameters
	// string @params : 'param1, param2'
	// string @then   : 'alert("example")'
	public function then($params = 'e', $then = '')
	{
		$this->_callbacks('then', $params, $then);
		
		return $this;
	}
	
	// Complementary method of operation
	// Optional Use Parameters
	// [string @url])  => url() method instead of the alternative  
	// [string @data]) => data() method instead of the alternative 
	public function send($url = '', $data = '')
	{
		if( ! ( is_string($url) || is_string($data) ) )
		{
			$url = '';
			$data = '';	
		}
		
		if( ! empty($url))
		{
			$this->url($url);	
		}
		
		if( ! empty($data))
		{
			$this->data($data);	
		}
		
		if( ! isset($this->sets['method']))
		{
			$this->method('post');
		} 
		
		$ajax = '';
		
		if( ! empty($this->sets))foreach($this->sets as $val)
		{
			$ajax .= $val;
		}
		
		$ajax = substr($ajax,0,-1);
		
		$ajax .= ln();
		
		if( ! empty($this->functions))foreach($this->functions as $val)
		{
			$ajax .= "\t$val,";
		}
		
		$ajax = substr($ajax,0,-1);
		
		$callbacks = '';
		if( ! empty($this->callbacks))
		{
			foreach($this->callbacks as $val)
			{
				$callbacks .= $val;	
			}
			$callbacks .= ";".ln();
		}
		else
		{
			$callbacks = ";".ln();
		}
		
		$ajax = ln()."$.ajax".ln()."({".ln()."$ajax".ln()."})$callbacks";
		
		$this->_default_variable();
		
		return $ajax;
	}
	
	public function create($url = '', $data = '')
	{
		return $this->send($url, $data);	
	}
	
	// DEFAULT VARIABLES
	protected function _default_variable()
	{
		if( ! empty($this->functions)) $this->functions = array();
		if( ! empty($this->sets)) $this->sets = array();
		if( ! empty($this->callbacks)) $this->callbacks = array();
	}
}