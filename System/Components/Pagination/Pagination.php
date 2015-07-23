<?php
class __USE_STATIC_ACCESS__CPagination
{
	/***********************************************************************************/
	/* PAGINATION COMPONENT	  	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CPagination
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->cpagination, zn::$use->cpagination, uselib('cpagination')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	protected $settings = array();
	
	public function url($url = '')
	{
		if( is_string($url) )
		{
			$this->settings['url'] = $url;
		}
		else
		{
			Error::set('CPagination', 'url', lang('Error', 'stringParameter', 'url'));	
		}
		
		return $this;
	}
	
	public function start($start = 0)
	{
		if( ! is_numeric($start) )
		{
			Error::set('CPagination', 'start', lang('Error', 'numericParameter', 'start'));
			return $this;
		}
		
		$this->settings['start'] = $start;
		
		return $this;
	}
	
	public function limit($limit = 10)
	{
		if( ! is_numeric($limit) )
		{
			Error::set('CPagination', 'limit', lang('Error', 'numericParameter', 'limit'));
			return $this;
		}
		
		$this->settings['limit'] = $limit;
		
		return $this;
	}
	
	public function totalRows($totalRows = 0)
	{
		if( ! is_numeric($totalRows) )
		{
			Error::set('CPagination', 'totalRows', lang('Error', 'numericParameter', 'totalRows'));
			return $this;
		}
		
		$this->settings['totalRows'] = $totalRows;
		
		return $this;
	}
	
	public function countLinks($countLinks = 10)
	{
		if( ! is_numeric($countLinks) )
		{
			Error::set('CPagination', 'countLinks', lang('Error', 'numericParameter', 'countLinks'));
			return $this;
		}
		
		$this->settings['countLinks'] = $countLinks;
		
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
			Error::set('CPagination', 'css', lang('Error', 'arrayParameter', 'css'));
			return $this;	
		}
		
		$this->settings['class'] = $css;
		
		return $this;
	}
	
	public function style($style = array())
	{
		if( ! is_array($style) )
		{
			Error::set('CPagination', 'style', lang('Error', 'arrayParameter', 'style'));
			return $this;	
		}
		
		$this->settings['style'] = $style;
		
		return $this;
	}
	
	public function create($start = NULL, $limit = NULL, $totalRows = NULL, $url = NULL)
	{
		Pagination::settings($this->settings);
		
		return Pagination::create($start);
	}
}
