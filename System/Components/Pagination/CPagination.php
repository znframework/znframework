<?php
/************************************************************/
/*                  PAGINATION COMPONENT                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Pagination;

use Pagination;
/******************************************************************************************
* PAGINATION                                                                              *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->cpagination->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CPagination
{
	protected $settings = array();
	
	public function url($url = '')
	{
		if( is_string($url) )
		{
			$this->settings['url'] = $url;
		}
<<<<<<< HEAD

=======
		
		$this->settings['url'] = $url;
		
>>>>>>> origin/master
		return $this;
	}
	
	public function start($start = 0)
	{
		if( ! is_numeric($start) )
		{
			return $this;
		}
		
		$this->settings['start'] = $start;
		
		return $this;
	}
	
	public function limit($limit = 10)
	{
		if( ! is_numeric($limit) )
		{
			return $this;
		}
		
		$this->settings['limit'] = $limit;
		
		return $this;
	}
	
	public function totalRows($total_rows = 0)
	{
		if( ! is_numeric($total_rows) )
		{
			return $this;
		}
		
		$this->settings['totalRows'] = $total_rows;
		
		return $this;
	}
	
	public function countLinks($count_links = 10)
	{
		if( ! is_numeric($count_links) )
		{
			return $this;
		}
		
		$this->settings['countLinks'] = $count_links;
		
		return $this;
	}
	
	public function linkNames($prev = '[prev]', $next = '[next]', $first = '[first]', $last = '[last]')
	{	
		// ÖNCEKİ BUTONU
		if( ! empty($prev) )
		{
			$this->settings['prevName']    = $prev;
		}
		
		// SONRAKİ BUTONU
		if( ! empty($next) )
		{
			$this->settings['nextName']     = $next;
		}
		
		// EN BAŞTAKİ BUTON
		if( ! empty($first) )
		{
			$this->settings['firstName'] = $first;
		}
			
		// EN SONDAKİ BUTON
		if( ! empty($last) )
		{
			$this->settings['lastName']  = $last;
		}
		
		return $this;
	}
	
	public function css($css = '')
	{
		if( ! is_array($css) )
		{
			return $this;	
		}
		
		$this->settings['class'] = $css;
		
		return $this;
	}
	
	public function style($style = array())
	{
		if( ! is_array($style) )
		{
			return $this;	
		}
		
		$this->settings['style'] = $style;
		
		return $this;
	}
	
	public function create($start = NULL, $limit = NULL, $total_rows = NULL, $url = NULL)
	{
		Pagination::settings($this->settings);
		
		return Pagination::create($start);
	}
}
