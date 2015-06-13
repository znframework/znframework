<?php
/************************************************************/
/*                      FORM COMPONENT                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Form;

require_once(COMPONENTS_DIR.'Form/Validation.php');

use Import;
use Form\ComponentFormValidation;
/******************************************************************************************
* FORM                                                                                    *
*******************************************************************************************
| Dahil(Import) Edilirken : CForm  		     							     			  |
| Sınıfı Kullanırken      :	$this->cform->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class CForm extends ComponentFormValidation
{
	/* Name Değişkeni
	 *  
	 * name="" bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $name;
	
	/* Id Değişkeni
	 *  
	 * id="" bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $id;
	
	/* Value Değişkeni
	 *  
	 * value="" bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $value;
	
	/* _Name Değişkeni
	 *  
	 * Sadece isim bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $_name;
	
	/* Validate Object Name Değişkeni
	 *  
	 * Kontrol nesnesi isim bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $validate_object_name;
	
	/* Attibutes Değişkeni
	 *  
	 * Özellikler bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $attr;
	
	/* Style Değişkeni
	 *  
	 * style="" bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $style;
	
	/* Css Değişkeni
	 *  
	 * class="" bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $css;
	
	/* Type Değişkeni
	 *  
	 * input type="" bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $type;
	
	/* Create Değişkeni
	 *  
	 * Form oluşturma bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $create;
	
	/* Enctype Değişkeni
	 *  
	 * Form encytpe bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $enctype;
	
	/* Method Değişkeni
	 *  
	 * Form method bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $method;
	
	/* _Method Değişkeni
	 *  
	 * Form method bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $_method = 'post';
	
	/* Action Değişkeni
	 *  
	 * Form action bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $action;
	
	/* Match Değişkeni
	 *  
	 * Veri karşılaştırma bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $match;
	
	/* Validate Değişkeni
	 *  
	 * Kontrol parametre bilgilerini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $validate = array();
	
	/* Limit Değişkeni
	 *  
	 * Limit bilgilerini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $limit = array();
	
	/* Secure Değişkeni
	 *  
	 * Güvenlik parametre bilgilerini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $secure = array();
	
	/* Options Değişkeni
	 *  
	 * Select nesnesi için seçenek bilgilerini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $options;
	
	/* Validate Error Değişkeni
	 *  
	 * Kontrol hata bilgilerini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $validate_error;
	
	// CONSTRUCT yapıcısı ile kütüphane ve
	// dil dosyası dahil ediliyor.
	
	public function name($name = '', $object_name = '')
	{
		$this->validate_object_name = $object_name;
		$this->_name = $name;
		
		$_name = ( ! empty($name) ) 
				 ? ' name="'.$name.'" '
				 : '';
				
		$this->name = $_name;
		
		return $this;
	}
	
	
	public function value($value = '')
	{
		$this->value = $value;
		
		return $this;
	}
	
	public function text($value = '')
	{	 
		$this->value = $_value;
		
		return $this;
	}
	
	public function css($css = '')
	{
		$css = ( ! empty($css) ) 
				 ? ' class="'.$css.'" '
				 : '';	
				 
		$this->css = $css;
		
		return $this;
	}
	
	public function id($id = '')
	{
		$id =  ( ! empty($id) ) 
				 ? ' id="'.$id.'" '
				 : '';	
				 
		$this->id = $id;
		
		return $this;
	}
	
	public function match($match = '')
	{
		$this->match = $match;
		
		return $this;
	}
	
	
	public function attr($_attributes = '')
	{
		$attribute = "";
		if( is_array($_attributes) )
		{
			foreach($_attributes as $key => $values)
			{
				if( is_numeric($key) )
				{
					$key = $values;
				}
				
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}
		
		$this->attr = $attribute;
		
		return $this;	
	}
	
	
	public function style($_attributes = array())
	{
		$attribute = '';
		
		if( is_array($_attributes) )
		{
			foreach($_attributes as $key => $values)
			{
				if( is_numeric($key) )
				{
					$key = $values;
				}
				
				$attribute .= ' '.$key.':'.$values.';';
			}	
		}
		
		$this->style = 'style="'.$attribute.'" ';
		
		return $this;	
	}
	
	public function type($type = 'text')
	{
		if( $type === 'textarea' )
		{
			$form_object = 'textarea';
		}
		elseif( $type === 'select' )
		{
			$form_object = 'select';
		}
		else
		{
			$form_object = 'input type="'.$type.'" ';
		}
		
		$this->type = $form_object;
		
		return $this;
	}
	
	public function options($options = array(), $selected = '')
	{
		$selectbox = '';
		
		if( ! empty($options) )foreach($options as $key => $value)
		{
			if( $selected == $key ) 
			{
				$select= 'selected="selected"'; 
			}
			else 
			{
				$select = '';
			}
			
			$selectbox .= '<option value="'.$key.'" '.$select.'>'.$value.'</option>'."\n";
		}
		
		$this->options = $selectbox;
		
		return $this;
	}
	
	public function validate()
	{
		$this->validate = func_get_args();
		
		return $this;
	}
	
	public function secure()
	{
		$this->secure = func_get_args();
		return $this;	
	}
	
	public function limit($minchar = 0, $maxchar = 0)
	{
		$this->limit['minchar'] = $minchar;
		$this->limit['maxchar'] = $maxchar;
		
		return $this;
	}
	
	protected function _validate_control()
	{	
		if( empty($this->value) )
		{
			$this->value = '';
		}
		
		if( ! empty($this->validate_object_name) )
		{
			$this->_name = $this->validate_object_name;
		}
		
		if( in_array('required', $this->validate) )
		{
			$this->required($this->_name, $this->value);	
		}
		
		if( in_array('identity', $this->validate) )
		{
			$this->identity($this->_name, $this->value);
		}
		
		if( in_array('email', $this->validate) )
		{
			$this->email($this->_name, $this->value);
		}
		
		if( in_array('url', $this->validate) )
		{
			$this->url($this->_name, $this->value);
		}
		
		if( in_array('numeric', $this->validate) )
		{
			$this->numeric($this->_name, $this->value);
		}
		
		if( in_array('specialchar', $this->validate) )
		{
			$this->specialChar($this->_name, $this->value);
		}
		
		if( ! empty($this->limit) )
		{
			$this->_limit($this->_name, $this->value, $this->limit['minchar'], $this->limit['maxchar']);
		}
		
		if( ! empty($this->match) )
		{
			$this->_match($this->_name, $this->value, $this->match); 
		}
	}
	
	protected function _secure_control()
	{
		if( in_array('xss', $this->secure) )
		{
			$this->value = $this->xssEncode($this->value);	
		}
		
		if( in_array('injection', $this->secure) )
		{
			$this->value = $this->injectionEncode($this->value);	
		}
		
		if( in_array('nc', $this->secure) )
		{
			$this->value = $this->ncEncode($this->value);	
		}
		
		if( in_array('html', $this->secure) )
		{
			$this->value = $this->htmlEncode($this->value);
		}
	}
	
	public function create($type = '')
	{	
		if( ! empty($type) )
		{
			$this->type($type);
		}
		
		$this->_secure_control();
		
		if( ! empty($this->_method) )
		{
			if( $this->_method === 'post' && isset($_POST[$this->_name]) )
			{
				$this->value = $_POST[$this->_name];	
			}
			elseif( $this->_method === 'get' && isset($_GET[$this->_name]) )
			{
				$this->value = $_GET[$this->_name];
			}
			elseif( $this->_method === 'request' && isset($_REQUEST[$this->_name]) )
			{
				$this->value = $_REQUEST[$this->_name];
			}
		}
		
		$value = $this->value;
		
		$value =  ( ! empty($value) ) 
				  ? ' value="'.$value.'" '
				  : '';	 
							
		if( $this->type === 'select' )
		{
			$create_object  = 	'<'.
								$this->type.
								$this->name.
								$this->id.
								$value.
								$this->css.
								$this->style.
								$this->attr.
								'>'.	
								$this->options.
								'</select>'.
								"\n";
		}
		elseif( $this->type === 'textarea' )
		{
			$create_object  = 	'<'.
								$this->type.
								$this->name.
								$this->id.
								$this->css.
								$this->style.
								$this->attr.							
								'>'.	
								$this->value.
								'</textarea>'.
								"\n";
		}
		else
		{
			$create_object  = 	'<'.
								$this->type.
								$this->name.
								$this->id.
								$value.
								$this->css.
								$this->style.
								$this->attr.
								'>'.
								"\n";	
		}
		
		$this->_validate_control();
		
		$this->create = $create_object;
		
		$this->_default_variable();
		
		return $this->create;
	}
	
	public function open($name = '')
	{
		if( ! empty($name) ) 
		{
			$this->name($name);
		}
		
		if( empty($this->method) ) 
		{
			$this->method = ' method="post" ';
		}
		
		$form = '<form'.
				$this->name.	
				$this->id.
				$this->enctype.
				$this->action.
				$this->method.
				$this->attr.
				'>'.
				"\n";
		
		return $form;
	}
	
	public function method($method = 'post')
	{
		$this->_method = $method;
		
		$method = ( ! empty($method) ) 
				  ? ' method="'.$method.'" '
				  : '';	
				 
		$this->method = $method;
		
		return $this;
	}
	
	public function action($action = '')
	{
		$action = ( ! empty($action) ) 
				  ? ' action="'.$action.'" '
				  : '';	
				 
		$this->action = $action;
		
		return $this;
	}
	
	public function enctype($enctype = '')
	{
		switch($enctype)
		{
			case "multipart" 	: $enctype = 'multipart/form-data'; 				break;
			case "application" 	: $enctype = 'application/x-www-form-urlencoded';	break;
			case "text" 		: $enctype = 'text/plain'; 							break;
		}
			
		$enctype = ( ! empty($enctype) ) 
				   ? ' enctype="'.$enctype.'" '
				   : '';	
				 
		$this->enctype = $enctype;
		
		return $this;
	}

	public function close()
	{
		$this->_form_default_variable();
		return '</form>'."\n";
	}
	
	public function validate_error($output = 'array')
	{
		if( $output === 'array' )
		{
			return $this->valid_error;
		}
		elseif( $output === 'echo' || $output === 'string' )
		{	
			$out = '';
			
			if( ! empty($this->valid_error) ) foreach($this->valid_error as $error)
			{
				if( is_array($error) )
				{
					foreach($error as $err)
					{
						$out .= $err.'<br>';	
					}
				}
			} 
			return $out;
		}
		else
		{
			if( isset($this->valid_error[$output]) )
			{
				return $this->valid_error[$output];
			}
		}
	}
	
	protected function _default_variable()
	{
		if( ! empty($this->name) ) $this->name = NULL;
		if( ! empty($this->id) ) $this->id = NULL;
		if( ! empty($this->_name) ) $this->_name = NULL;
		if( ! empty($this->match) ) $this->match = NULL;
		if( ! empty($this->value) ) $this->value = NULL;
		if( ! empty($this->validate_object_name) ) $this->validate_object_name = NULL;
		if( ! empty($this->attr) ) $this->attr = NULL;
		if( ! empty($this->style) ) $this->style = NULL;
		if( ! empty($this->css) ) $this->css = NULL;
	 	if( ! empty($this->type) ) $this->type = NULL;
		if( ! empty($this->validate) ) $this->validate = array();
		if( ! empty($this->limit) ) $this->limit = array();
		if( ! empty($this->secure) ) $this->secure = array();
		if( ! empty($this->options) ) $this->options = NULL;
	}
	
	protected function _form_default_variable()
	{
		if( ! empty($this->name) ) $this->name = NULL;
		if( ! empty($this->id) ) $this->id = NULL;
	 	if( ! empty($this->_name) ) $this->_name = NULL;
		if( ! empty($this->attr)  )$this->attr = NULL;
		if( ! empty($this->method) ) $this->method = NULL;
		if( ! empty($this->_method) ) $this->_method = 'post';
		if( ! empty($this->action) ) $this->action = NULL;
		if( ! empty($this->enctype) ) $this->enctype = NULL;
	}
}