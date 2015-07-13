<?php
class CLister
{
	/***********************************************************************************/
	/* LISTER COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CLister
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->clister, zn::$use->clister, uselib('clister')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Attr Değişkeni
	 *  
	 * Liste nesnesine eklenecek özellik değer  
	 * çifti bilgisini tutması için oluşturulmuştur.
	 * 
	 */
	protected $attr = array();
	
	/* Lists Değişkeni
	 *  
	 * Listede yer alacak elemanların  
	 * bilgisini tutması için oluşturulmuştur.
	 * 
	 */
	protected $lists;
	
	/* Type Değişkeni
	 *  
	 * Listede tipi bilgisini 
	 * tutması için oluşturulmuştur.
	 * 
	 */
	protected $type;
	
	/******************************************************************************************
	* ATTR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Liste nesnesine eklenecek özellik değer çiftlerinin belirlenmesi içindir|
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @attributes => Eklenecek özellik değer çifleri.		    				  |
	|          																				  |
	| Örnek Kullanım: ->attr(array('name' => 'liste', 'type' => 'circ'));       			  |
	| // name="liste" type="circ"					 			 	 					      |
	|          																				  |
	******************************************************************************************/
	public function attr($attributes = array())
	{
		if( ! is_array($attributes))
		{
			return $this;	
		}
		
		foreach($attributes as $att => $val)
		{
			$this->attr[$att] = $val; 
		}
		return $this;
	}
	
	/******************************************************************************************
	* CSS                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Listeye class bilgileri eklemek için kullanılır.                        |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @css => Eklenecek class bilgileri. Örnek: 'bold, menu-text'		          |
	|          																				  |
	| Örnek Kullanım: ->css('bold, menu-text');       			                              |
	| // class="bold, menu-text"					 			 	 					      |
	|          																				  |
	******************************************************************************************/
	public function css($css = '')
	{
		if( ! is_string($css) )
		{
			return $this;	
		}
		
		if( ! empty($css)) $this->attr['class'] = $css;
		
		return $this;
	}
	
	/******************************************************************************************
	* TYPE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Listenin madde tipini belirlemek için kullanılır.                       |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @type => Liste madde tipi. 										          |
	|          																				  |
	| Örnek Kullanım: ->type('circ');       			                                      |
	| // type="circ"					 			 	 					      			  |
	|          																				  |
	|  ul için => circ, disc, square        												  |
	|  ol için => i, I, 1, a, A        														  |
	|          																				  |
	******************************************************************************************/
 	public function type($type = 'circ')
	{
		if( ! is_string($type) )
		{
			return $this;	
		}
		
		if( ! empty($type)) $this->attr['type'] = $type;
		
		return $this;
	}
	
	/******************************************************************************************
	* STYLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Listeye style öğeleri eklemek için kullanılır.                          |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @style => Eklenecek stil öğeleri. 										  |
	|          																				  |
	| Örnek Kullanım: ->style(array('font-size' => '11px' ... ));       			          |
	| // style="font-size:11px; ..."					 			 	 					  |
	|          																				  |
	******************************************************************************************/
	public function style($_attributes = array())
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
				$attribute .= ' '.$key.':'.$values.';';
			}	
		}
		
		$this->attr['style'] = $attribute;
		
		return $this;	
	}
	
	// Bazı yöntemler için.
	protected function _attributes($attributes = '')
	{
		$attribute = '';
		
		if(is_array($attributes))
		{
			foreach($attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}

		return $attribute;	
	}
	
	/******************************************************************************************
	* ELEMENTS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Listeye madde yada eleman eklemek için kullanılır.                      |
	|															                              |
	| Parametreler: Sıralı parametresi vardır.                                                |
	| 1. arguments/array var @args => Eklenecek liste maddeleri. 						      |
	|          																				  |
	| Örnek Kullanım: ->elements(array('a', 'b', 'c')); // Dizi olarak eleman eklemek.  	  |
	| Örnek Kullanım: ->elements('a', 'b', 'c');        // Argüman olarak elaman eklemek      |
	| // <li>a</li> <li>b</li> <li>c</li>					 			 	 				  |
	|          																				  |
	******************************************************************************************/
	public function elements()
	{
		$elements = func_get_args();
		
		// İlk parametre dizi tipi veri içeriyorsa
		// argüman olarak bu diziyi kullan.
		if( isset($elements[0]) && is_array($elements[0]) )
		{
			$elements = $elements[0];
		}
		
		if( ! is_array($elements))
		{
			return $this;	
		}
		
		$i = 0;
		
		$list = '';
		
		foreach($elements as $k => $values)
		{	
			$list .= "\t".'<li>'.$values.'</li>'.eol();
			$i++;
		}
				
		$this->lists = $list;
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Listeyi tamamlama yöntemidir. Bu yöntem nihai olarak kullanılır.        |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   | 
	| 1. string var @type => Liste türünü belirmek için kullanılır. Varsayılan:ul 			  |
	|          																				  |
	******************************************************************************************/
	public function create($type = 'ul')
	{	
		$list  = '<'.$type.$this->_attributes($this->attr).'>'.eol();
		$list .= $this->lists;	
		$list .= '</'.$type.'>'.eol();
		
		// **********************************************************
		// Nesneler varsayılan ayarlara getiriliyor.
		if( ! empty($this->lists)) $this->lists = NULL;
		if( ! empty($this->attr))  $this->attr = array();
		if( ! empty($this->type))  $this->type = NULL;
		// **********************************************************
		
		return $list;
	}	
}