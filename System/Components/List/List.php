<?php
/************************************************************/
/*                       LIST COMPONENT                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class ComponentList
{
	protected $attr = array();
	protected $lists;
	protected $type;
	
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

	public function css($css = '')
	{
		if( ! is_string($css) )
		{
			return $this;	
		}
		
		if( ! empty($css)) $this->attr['class'] = $css;
		
		return $this;
	}
	
	// circ, disc, sequare for ul
	// i, I, 1, a, A for ol
 	public function type($type = 'circ')
	{
		if( ! is_string($type) )
		{
			return $this;	
		}
		
		if( ! empty($type)) $this->attr['type'] = $type;
		
		return $this;
	}
	
	public function style($_attributes = array())
	{
		$attribute = "";
		if(is_array($_attributes))
		{
			foreach($_attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.':'.$values.';';
			}	
		}
		
		$this->attr['style'] = $attribute;
		
		return $this;	
	}
	
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
	
	public function elements($elements = array())
	{
		if( ! is_array($elements))
		{
			return $this;	
		}
		$i=0;
		$list = '';
		foreach($elements as $k => $values)
		{	
			$list .= "\t".'<li>'.$values.'</li>'."\n";
			$i++;
		}
				
		$this->lists = $list;
		
		return $this;
	}
	
	public function create($type = 'ul')
	{	
		$list  = '<'.$type.$this->_attributes($this->attr).'>'."\n";
		$list .= $this->lists;	
		$list .= '</'.$type.'>'."\n";
		
		if( ! empty($this->lists)) $this->lists = NULL;
		if( ! empty($this->attr))  $this->attr = array();
		if( ! empty($this->type))  $this->type = NULL;
		
		return $list;
	}	
}