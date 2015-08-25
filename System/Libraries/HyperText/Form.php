<?php
class __USE_STATIC_ACCESS__Form
{
	/***********************************************************************************/
	/* FORM LIBRARY	     					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Form
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: form::, $this->form, zn::$use->form, uselib('form')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Form::$method()"));	
	}
	
	/******************************************************************************************
	* OPEN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <form> tagının kullanımıdır. Yani form tagını açmak içindir.  	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  						      |
	| 2. array var @attributes => Özellik ve değer çiftlerini içerecek dizi parametresi.	  |
	|          																				  |
	| Örnek Kullanım: open('yeniForm', array('id' => 'zntr'));        	  					  |
	| // <form name="yeniForm" id="zntr">         											  |
	|          																				  |
	| ENCTYPE anahtar kelimesinin alabileceği değerler.         							  |
	| 2. parametrede enctype anahtar kelimesi kullanılırsa şu değerleri alabilir.         	  |
	|																						  |
	| 1. multipart    	=> multipart/form-data       										  |
	| 2. application 	=> application/x-www-form-urlencoded       							  |
	| 3. text 		 	=> text/plain      											          |
	|          																				  |
	******************************************************************************************/	
	public function open($name = '', $_attributes = '')
	{
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		
		// Herhangi bir id değeri tanımlanmamışsa
		// Id değeri olarak isim bilgisini kullan.
		$id = ( isset($_attributes["id"]) ) 
			  ? $_attributes["id"] 
			  : $name;
		
		// Id değer tanımlanmışsa
		// Id değeri olarak tanımalanan değeri kullan.
		$id_txt = ( isset($_attributes["id"]) ) 
			      ? ''
			      : "id=\"$id\"";
		
		// Enctype için 3 parametre kullamı.
		// 1. multipart    	=> multipart/form-data       										  
		// 2. application 	=> application/x-www-form-urlencoded       							  
		// 3. text 		 	=> text/plain      											           
		if( isset($_attributes['enctype']) )
		{
			switch( $_attributes['enctype'] )
			{
				case "multipart" : 
					$_attributes['enctype'] = 'multipart/form-data'; 					
				break;
				
				case "application" : 
					$_attributes['enctype'] = 'application/x-www-form-urlencoded';	
				break;
				
				case "text" : 
					$_attributes['enctype'] = 'text/plain'; 							
				break;
			}
		}
		
		// 2. parametrede dizi içerisinde method belirtilmemişse
		// Varsayılan olarak post değerini kullan.
		if( ! isset($_attributes['method']) ) 
		{
			$_attributes['method'] = 'post';
		}
		
		return '<form name="'.$name.'" '.$id_txt.Html::attributes($_attributes).'>'.eol();
	}

	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html </form> tagının kullanımıdır. Yani form tagını kapatmak içindir.   |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: close();        	  					  								  |
	| // </form>         											  						  |
	|          																				  |
	******************************************************************************************/	
	public function close()
	{
		return '</form>'.eol();
	}

	/******************************************************************************************
	* HIDDEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="hidden"> tagının kullanımıdır.    					  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string/array var @name => Form hidden nesnesinin ismi belirtilir.	  				  |
	| 2. string var @name => Form hidden nesnesinin değerini belirtilir.	  				  |
	|          																				  |
	| Örnek Kullanım: hidden('nesne', 'Değer');        	  					  				  |
	| // <input type="hidden" name="nesne" value="Değer">       							  |
	|          																				  |
	| Çoklu HIDDEN nesnesi oluştrumak için 2 parametre dizi olarak girilir.         		  |
	| Örnek Kullanım: hidden(array('nesne1' => 'değer1', 'nesne2' => 'değer2' ... ));         |
	|          																				  |
	| Not: Çoklu kullanım sadece hidden nesnesine özgüdür.         							  |
	|          																				  |
	******************************************************************************************/	
	public function hidden($name = '', $value = '')
	{
		if( ! isValue($value) ) 
		{
			$value = '';
		}
		
		$hiddens = NULL;
		
		$value = ( ! empty($value) ) 
				 ? 'value="'.$value.'"' 
				 : "";
		
		// 1. parametre dizi ise
		if( is_array($name) )foreach($name as $key => $val)
		{
			$hiddens .= '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$val.'">'.eol();	
		}
		else
		{
			$hiddens = 	'<input type="hidden" name="'.$name.'" id="'.$name.'" '.$value.'>'.eol();
		}
		
		return $hiddens;
	}	
	
	// Form Input Nesneleri
	protected function _input($name = "", $value = "", $_attributes = '', $type = '')
	{
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		
		if( ! isValue($value) ) 
		{
			$value = '';		
		}
		
		$value = ( ! empty($value)) 
				 ? 'value="'.$value.'"' 
				 : "";
		
		// Herhangi bir id değeri tanımlanmamışsa
		// Id değeri olarak isim bilgisini kullan.
		$id = ( isset($_attributes["id"]) ) 
			  ? $_attributes["id"] 
			  : $name;
		
		// Id değer tanımlanmışsa
		// Id değeri olarak tanımalanan değeri kullan.
		$id_txt = ( isset($_attributes["id"]) ) 
			      ? ''
			      : "id=\"$id\"";
	
		return '<input type="'.$type.'" name="'.$name.'" '.$id_txt.' '.$value.Html::attributes($_attributes).'>'.eol();
	}
	
	/******************************************************************************************
	* TEXT                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="text"> tagının kullanımıdır.    					  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: text('nesne', 'Değer', array('style' => 'color:red'));        	  	  |
	| // <input type="text" name="nesne" value="Değer" style="color:red">       			  |
	|          																				  |
	******************************************************************************************/	
	public function text($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'text');
	}
	
	/******************************************************************************************
	* PASSWORD                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Html <input type='password'> tagının kullanımıdır.    				  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: password('nesne', 'Değer', array('style' => 'color:red'));        	  |
	| // <input type='password' name="nesne" value="Değer" style="color:red">       		  |
	|          																				  |
	******************************************************************************************/	
	public function password($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'password');
	}

	/******************************************************************************************
	* TEXTAREA                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Html <textarea></textarea> tagının kullanımıdır.    				      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: textArea('nesne', 'Değer', array('style' => 'color:red'));        	  |
	| // <textarea name="nesne" style="color:red">Değer</textarea>				       		  |
	|          																				  |
	******************************************************************************************/	
	public function textArea($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		
		if( ! isValue($value) ) 
		{
			$value = '';		
		}
		
		// Herhangi bir id değeri tanımlanmamışsa
		// Id değeri olarak isim bilgisini kullan.
		$id = ( isset($_attributes["id"]) ) 
			  ? $_attributes["id"] 
			  : $name;
		
		// Id değer tanımlanmışsa
		// Id değeri olarak tanımalanan değeri kullan.
		$id_txt = ( isset($_attributes["id"]) ) 
			      ? ''
			      : "id=\"$id\"";
		
		return '<textarea name="'.$name.'" '.$id_txt.Html::attributes($_attributes).'>'.$value.'</textarea>'.eol();
	}

	/******************************************************************************************
	* RADIO                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="radio"> tagının kullanımıdır.    				      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: radio('nesne', 'Değer', array('style' => 'color:red'));        	      |
	| // <input type="radio" name="nesne" value="Değer" style="color:red">       		      |
	|          																				  |
	******************************************************************************************/	
	public function radio($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'radio');
	}

	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <select><option></option></select tagının kullanımıdır.    		  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. array var @name => Form nesnesinin seçeneklerini belirtilir.	  				      |
	| 3. string var @selected => Seçili olması istenen seçenek.	  				              |
	| 4. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: select('nesne', array(1 => 'a', 2 => 'b'), 2);        	              |
	| // <select name='nesne' id='nesne'>													  |
	|			<option value="1">a</option>  												  |
	|			<option selected="selected" value="1">a</option>   							  |
	|	 </select>   		      															  |
	|          																				  |
	******************************************************************************************/	
	public function select($name = '', $options = array(), $selected = '', $_attributes = '', $multiple = false)
	{
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		if( ! isValue($selected) )
		{
			$selected = '';
		}
		
		// Herhangi bir id değeri tanımlanmamışsa
		// Id değeri olarak isim bilgisini kullan.
		$id = ( isset($_attributes["id"]) ) 
			  ? $_attributes["id"] 
			  : $name;
		
		// Id değer tanımlanmışsa
		// Id değeri olarak tanımalanan değeri kullan.
		$id_txt = ( isset($_attributes["id"]) ) 
			      ? ''
			      : "id=\"$id\"";
		
		// Son parametrenin durumuna multiple olması belirleniyor.
		// Ancak bu parametrenin kullanımı gerekmez.
		// Bunun için multiple() yöntemi oluşturulmuştur.
		if( $multiple === true )
		{
			$multiple = 'multiple="multiple"';	
		}
		else
		{
			$multiple = '';	
		}
				  
		$selectbox = '<select '.$multiple.' name="'.$name.'" '.$id_txt.Html::attributes($_attributes).'>';
		
		if( is_array($options) )foreach($options as $key => $value)
		{
			if( $selected == $key ) 
			{
				$select= 'selected="selected"'; 
			}
			else 
			{
				$select = "";
			}
			$selectbox .= '<option value="'.$key.'" '.$select.'>'.$value.'</option>'.eol();
		}
		
		$selectbox .= '</select>'.eol();	
		
		return $selectbox;
	}

	/******************************************************************************************
	* MULTIPLE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Html <select><option></option></select tagının kullanımıdır.    		  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. array var @name => Form nesnesinin seçeneklerini belirtilir.	  				      |
	| 3. string var @selected => Seçili olması istenen seçenek.	  				              |
	| 4. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: select('nesne', array(1 => 'a', 2 => 'b'), 2);        	              |
	| // <select multiple="multiple" name='nesne' id='nesne'>								  |
	|			<option value="1">a</option>  												  |
	|			<option selected="selected" value="1">a</option>   							  |
	|	 </select>   		      															  |
	|          																				  |
	******************************************************************************************/	
	public function multiple($name = '', $options = array(), $selected = '', $_attributes = '')
	{
		return $this->select($name, $options, $selected, $_attributes, true);
	}
	
	/******************************************************************************************
	* CHECKBOX                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="checkbox"> tagının kullanımıdır.    				  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: checkBox('nesne', 'Değer', array('style' => 'color:red'));        	  |
	| // <input type="checkbox" name="nesne" value="Değer" style="color:red">       		  |
	|          																				  |
	******************************************************************************************/	
	public function checkBox($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'checkbox');
	}
	
	/******************************************************************************************
	* FILE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="file"> tagının kullanımıdır.         				  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: file('nesne', 'Değer', array('style' => 'color:red'));        	      |
	| // <input type="file" name="nesne" value="Değer" style="color:red">       		      |
	|          																				  |
	******************************************************************************************/	
	public function file($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'file');
	}
	
	/******************************************************************************************
	* SUBMIT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="submit"> tagının kullanımıdır.    				      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: submit('nesne', 'Değer', array('style' => 'color:red'));        	      |
	| // <input type="submit" name="nesne" value="Değer" style="color:red">       		      |
	|          																				  |
	******************************************************************************************/	
	public function submit($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'submit');
	}
	
	/******************************************************************************************
	* BUTTON                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="button"> tagının kullanımıdır.    				      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: button('nesne', 'Değer', array('style' => 'color:red'));        	      |
	| // <input type="button" name="nesne" value="Değer" style="color:red">       		      |
	|          																				  |
	******************************************************************************************/	
	public function button($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'button');
	}

	/******************************************************************************************
	* RESET                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="reset"> tagının kullanımıdır.    				      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: reset('nesne', 'Değer', array('style' => 'color:red'));        	      |
	| // <input type="reset" name="nesne" value="Değer" style="color:red">       		      |
	|          																				  |
	******************************************************************************************/	
	public function reset($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'reset');
	}	

	/******************************************************************************************
	* EMAIL OBJECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="email"> tagının kullanımıdır.    					  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: emailObject('nesne', 'Değer', array('style' => 'color:red'));          |
	| // <input type="email" name="nesne" value="Değer" style="color:red">       			  |
	|          																				  |
	******************************************************************************************/	
	public function email($name = '', $value = '', $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'email');
	}
	
	/******************************************************************************************
	* URL OBJECT                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="url"> tagının kullanımıdır.    					      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: urlObject('nesne', 'Değer', array('style' => 'color:red'));            |
	| // <input type="url" name="nesne" value="Değer" style="color:red">       			      | 
	|          																				  |
	******************************************************************************************/	
	public function url($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'url');
	}
	
	/******************************************************************************************
	* NUMBER OBJECT                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="number"> tagının kullanımıdır.    					  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: numberObject('nesne', 'Değer', array('style' => 'color:red'));         |
	| // <input type="url" name="nesne" value="Değer" style="color:red">       			  | 
	|          																				  |
	******************************************************************************************/	
	public function number($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'number');
	}
	
	/******************************************************************************************
	* SEARCH OBJECT                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="search"> tagının kullanımıdır.    					  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: searchObject('nesne', 'Değer', array('style' => 'color:red'));         |
	| // <input type="search" name="nesne" value="Değer" style="color:red">       			  | 
	|          																				  |
	******************************************************************************************/	
	public function search($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'search');
	}
	
	/******************************************************************************************
	* TEL OBJECT                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="tel"> tagının kullanımıdır.    					      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: telObject('nesne', 'Değer', array('style' => 'color:red'));            |
	| // <input type="tel" name="nesne" value="Değer" style="color:red">       			  | 
	|          																				  |
	******************************************************************************************/	
	public function tel($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'tel');
	}
	
	/******************************************************************************************
	* COLOR OBJECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="color"> tagının kullanımıdır.    					  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: colorObject('nesne', 'Değer', array('style' => 'color:red'));          |
	| // <input type="color" name="nesne" value="Değer" style="color:red">       			  | 
	|          																				  |
	******************************************************************************************/
	public function color($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'color');
	}
	
	/******************************************************************************************
	* DATE OBJECT                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="date"> tagının kullanımıdır.    					  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: dateObject('nesne', 'Değer', array('style' => 'color:red'));           |
	| // <input type="date" name="nesne" value="Değer" style="color:red">       			  | 
	|          																				  |
	******************************************************************************************/
	public function date($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'date');
	}
	
	/******************************************************************************************
	* DATETIME OBJECT                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="datetime"> tagının kullanımıdır.    				  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: datetimeObject('nesne', 'Değer', array('style' => 'color:red'));       |
	| // <input type="datetime" name="nesne" value="Değer" style="color:red">       		  | 
	|          																				  |
	******************************************************************************************/
	public function datetime($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'datetime');
	}
	
	/******************************************************************************************
	* DATETIME-LOCAL OBJECT                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="datetime-local"> tagının kullanımıdır.    			  |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: datetimeLocalObject('nesne', 'Değer', array('style' => 'color:red')); |
	| // <input type="datetime-local" name="nesne" value="Değer" style="color:red">       	  | 
	|          																				  |
	******************************************************************************************/
	public function datetimeLocal($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'datetime-local');
	}
	
	/******************************************************************************************
	* TIME OBJECT                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="time"> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: timeObject('nesne', 'Değer', array('style' => 'color:red'));           |
	| // <input type="time" name="nesne" value="Değer" style="color:red">       	          | 
	|          																				  |
	******************************************************************************************/
	public function time($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'time');
	}
	
	/******************************************************************************************
	* WEEK OBJECT                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="week"> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: weekObject('nesne', 'Değer', array('style' => 'color:red'));           |
	| // <input type="week" name="nesne" value="Değer" style="color:red">       	          | 
	|          																				  |
	******************************************************************************************/
	public function week($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'week');
	}
	
	/******************************************************************************************
	* MONTH OBJECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="month"> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: monthObject('nesne', 'Değer', array('style' => 'color:red'));          |
	| // <input type="month" name="nesne" value="Değer" style="color:red">       	          | 
	|          																				  |
	******************************************************************************************/
	public function month($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'month');
	}
	
	/******************************************************************************************
	* RANGE OBJECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="range"> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: rangeObject('nesne', 'Değer', array('style' => 'color:red'));          |
	| // <input type="range" name="nesne" value="Değer" style="color:red">       	          | 
	|          																				  |
	******************************************************************************************/
	public function range($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'range');
	}
	
	/******************************************************************************************
	* IMAGE OBJECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="image"> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 3. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: imageObject('nesne', 'Değer', array('style' => 'color:red'));          |
	| // <input type="image" name="nesne" value="Değer" style="color:red">       	          | 
	|          																				  |
	******************************************************************************************/
	public function image($name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, 'image');
	}

	/******************************************************************************************
	* INPUT OBJECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="xxxx"> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 4 parametresi vardır.		                                              |
	| 1. string var @type => Form nesnesinin türü belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 3. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 4. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: inputObject('text', 'nesne', 'Değer', array('style' => 'color:red'));  |
	| // <input type="text" name="nesne" value="Değer" style="color:red">       	          | 
	|          																				  |
	******************************************************************************************/
	public function input($type = "", $name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, $type);
	}
}