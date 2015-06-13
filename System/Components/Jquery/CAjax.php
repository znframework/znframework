<?php
/************************************************************/
/*                     COMPONENT  AJAX                   	*/
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Jquery;

require_once(COMPONENTS_DIR.'Jquery/Common.php');

use Jquery\ComponentJqueryCommon;
/******************************************************************************************
* AJAX                                                                                    *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->cajax->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CAjax extends ComponentJqueryCommon
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
		
		if( ! isUrl($url))
		{
			$url = siteUrl($url);	
		}
		
		$this->sets['url'] = "\turl:\"$url\",".eof();
		
		return $this;	
	}
	
	// DATA Property --------------------------------------------------------------
	// Ajax send data
	// data:'example=1&data=2'
	public function data($data = '')
	{
		if( ! isValue($data))
		{
			return $this;	
		}
		
		$this->sets['data'] = "\tdata:$data,".eof();
		
		return $this;	
	}
	
	// HEADERS Property -----------------------------------------------------------
	// Headers data
	// headers:{ h1, h2}
	public function headers($headers = '')
	{
		if( ! isValue($headers))
		{
			return $this;	
		}
		
		$this->sets['headers'] = "\theaders:$headers,".eof();
		
		return $this;	
	}
	
	// IF MODIFIED Property -------------------------------------------------------
	// ifModified data
	// ifModified:true or false
	public function ifModified($if_modified = true)
	{
		if( ! isValue($if_modified))
		{
			return $this;	
		}
		$if_modified = $this->_booltostr($if_modified);
		$this->sets['if_modified'] = "\tifModified:$if_modified,".eof();
		
		return $this;	
	}
	
	// IS LOCAL Property ---------------------------------------------------------
	// isLocal data
	// isLocal:true or false
	public function isLocal($is_local = true)
	{
		if( ! isValue($is_local))
		{
			return $this;	
		}
		$is_local = $this->_booltostr($is_local);
		$this->sets['is_local'] = "\tisLocal:$is_local,".eof();
		
		return $this;	
	}
	
	
	// MIME TYPE Property -------------------------------------------------------
	// mimeType data
	// mimeType:true or false
	public function mimeType($mime_type = true)
	{
		if( ! isValue($mime_type))
		{
			return $this;	
		}
		$mime_type = $this->_booltostr($mime_type);
		$this->sets['mime_type'] = "\tmimeType:$mime_type,".eof();
		
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
		
		$this->sets['jsonp'] = "\tjsonp:$jsonp,".eof();
		
		return $this;	
	}
	
	// JSONP CALLBACK Property ---------------------------------------------------
	// jsonpCallback data
	// jsonpCallback:string or function
	// is string 	 : "example data"
	// is function	 : function(){}
	public function jsonpCallback($jsonp_callback = '')
	{
		if( ! isValue($jsonp_callback))
		{
			return $this;	
		}
		
		if($this->_is_func($jsonp_callback) === false)
		{
			$jsonp_callback = "\"$jsonp_callback\"";
		}
		
		$this->sets['jsonp_callback'] = "\tjsonpCallback:$jsonp_callback,".eof();
		
		return $this;	
	}
	
	// DATA TYPE Property -------------------------------------------------------
	// dataType data
	// dataType:string : json, script, html ...
	public function dataType($type = '')
	{
		if( ! is_string($type))
		{
			return $this;	
		}
		
		$this->sets['type'] = "\tdataType:\"$type\",".eof();
		
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
		
		$this->sets['password'] = "\tpassword:\"$password\",".eof();
		
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
		
		$this->sets['username'] = "\tusername:\"$username\",".eof();
		
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
		
		$this->sets['method'] = "\ttype:\"$method\",".eof();
		
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
		
		$this->sets['method'] = "\ttype:\"$method\",".eof();
		
		return $this;
	}
	
	// SCRIPT CHARSET Property -------------------------------------------------------
	// scriptCharset data
	// scriptCharset:string
	public function scriptCharset($script_charset = 'utf-8')
	{
		if( ! is_string($script_charset))
		{
			return $this;	
		}
		
		$this->sets['script_charset'] = "\tscriptCharset:\"$script_charset\",".eof();
		
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
		$this->sets['traditional'] = "\ttraditional:$traditional,".eof();
		
		return $this;
	}
	
	// PROCESS DATA Property -------------------------------------------------------
	// processData data
	// processData:bool: true or false
	public function processData($process_data = true)
	{
		if( ! isValue($process_data))
		{
			return $this;	
		}
		$process_data = $this->_booltostr($process_data);
		$this->sets['process_data'] = "\tprocessData:$process_data,".eof();
		
		return $this;
	}
	
	// CACHE Property -------------------------------------------------------
	// cache data
	// cache:bool: true or false
	public function cache($cache = true)
	{
		if( ! isValue($cache))
		{
			return $this;	
		}
		$cache = $this->_booltostr($cache);
		$this->sets['cache'] = "\tcache:$cache,".eof();
		
		return $this;
	}
	
	// XHR FIELDS Property -------------------------------------------------------
	// xhrFields data
	// xhrFields:string
	public function xhrFields($xhr_fields = '')
	{
		if( ! is_string($xhr_fields))
		{
			return $this;	
		}
		
		$this->sets['xhr_fields'] = "\txhrFields:$xhr_fields,".eof();
		
		return $this;
	}
	
	// CONTEXT Property -------------------------------------------------------
	// context data
	// context:plain object
	public function context($context = '')
	{
		if( ! isValue($context))
		{
			return $this;	
		}
		
		$this->sets['context'] = "\tcontext:$context,".eof();
		
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
		
		$this->sets['accepts'] = "\taccepts:$accepts,".eof();
		
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
		
		$this->sets['contents'] = "\tcontents:$contents,".eof();
		
		return $this;
	}
	
	// ASYNC Property -------------------------------------------------------
	// async data
	// async:bool: true or false
	public function async($async = true)
	{
		if( ! isValue($async))
		{
			return $this;	
		}
		$async = $this->_booltostr($async);
		$this->sets['async'] = "\tasync:$async,".eof();
		
		return $this;
	}
	
	// CROSS DOMAIN Property -------------------------------------------------------
	// crossDomain data
	// crossDomain:bool: true or false
	public function crossDomain($cross_domain = true)
	{
		if( ! isValue($cross_domain))
		{
			return $this;	
		}
		$cross_domain = $this->_booltostr($cross_domain);
		$this->sets['cross_domain'] = "\tcrossDomain:$cross_domain,".eof();
		
		return $this;
	}
	
	// TIMEOUT Property -------------------------------------------------------
	// timeout data
	// timeout:numeric
	public function timeout($timeout = '')
	{
		if( ! isValue($timeout))
		{
			return $this;	
		}
		
		$this->sets['timeout'] = "\ttimeout:$timeout,".eof();
		
		return $this;
	}
	
	// GLOBAL Property -------------------------------------------------------
	// global data
	// global:bool : true or false
	// global is keywords so global is name globals
	public function globals($globals = true)
	{
		if( ! isValue($globals))
		{
			return $this;	
		}
		$globals = $this->_booltostr($globals);
		$this->sets['globals'] = "\tglobal:$globals,".eof();
		
		return $this;
	}
	
	// CONTENT TYPE Property -------------------------------------------------------
	// contentType data
	// contentType:bool or string
	// is bool  : true or false
	// is_string: 'application/x-www-form-urlencoded; charset=UTF-8'
	public function contentType($content_type = 'application/x-www-form-urlencoded; charset=UTF-8')
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
		
		$this->sets['content_type'] = "\tcontentType:$content_type,".eof();
		
		return $this;
	}
	
	protected function _object($name, $codes = array())
	{
		if( ! is_array($codes))
		{
			return $this;	
		}	
		
		$status_code = eof()."\t$name:".eof()."\t{";
		
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
				
				$status_code .= eof()."\t\t$code:function($param)".eof()."\t\t{".eof()."\t\t\t$value".eof()."\t\t},".eof();
			}
			$status_code = trim(trim($status_code), ',').eof();
		}
		$status_code .= "\t}";
		
		$this->functions[$name] = eof()."\t".$status_code;
	}
	
	// STATUS CODE Property -------------------------------------------------------
	// statusCode data
	// statusCode:array
	// array(404 => 'alert(404);', 403 => 'alert(403);') 
	// To use parameters :::::    param1, param2->codes...   ::::: function(param1, param2){codes}
	// -> parameters and codes is seperators
	// array(404 => 'data->alert(data);', 403 => 'data->alert(data);')
	public function statusCode($codes = array())
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
		
		$this->functions[$name] = eof()."\t$name:function($params)".eof()."\t{".eof()."\t\t$codes".eof()."\t}";
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
	public function beforeSend($params = 'e', $before_send = '')
	{
		$this->_functions('beforeSend', $params, $before_send);
		
		return $this;
	}	
	
	// DATA FILTER FUNCTION Property -------------------------------------------------------
	// dataFilter data
	// dataFilter: 2 Parameters
	// string @params       : 'param1, param2'
	// string @data_filter  : 'alert("example")'
	public function dataFilter($params = 'e', $data_filter = '')
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
		
		$this->callbacks[$name] = eof().".$name(function($params)".eof()."{".eof()."\t$codes".eof()."})";
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
		
		$ajax .= eof();
		
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
			$callbacks .= ";".eof();
		}
		else
		{
			$callbacks = ";".eof();
		}
		
		$ajax = eof()."$.ajax".eof()."({".eof()."$ajax".eof()."})$callbacks";
		
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