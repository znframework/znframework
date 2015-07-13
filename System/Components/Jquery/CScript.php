<?php
class CScript
{
	/***********************************************************************************/
	/* SCRIPT COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CScript
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->cscript, zn::$use->cscript, uselib('cscript')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	protected $ready    = true;
	protected $type 	= 'text/javascript';
	
	public function type($type = 'text/javascript')
	{
		if( ! is_string($type) )
		{
			return $this;	
		}
		
		$this->type = $type;
		
		return $this;
	}
	
	public function ready($type = true)
	{
		if( ! is_bool($type) )
		{
			return $this;	
		}
		
		$this->ready = $type;
		
		return $this;
	}
	
	public function library()
	{
		$arguments = array_unique(func_get_args());
		Import::script($arguments);
		
		return $this;
	}
	
	public function open()
	{		
		$script = "";
		$script .= Import::script('Jquery', true);
		$script .= "<script type=\"$this->type\">".eol();
		
		if( $this->ready )
		{
			$script .= "$(document).ready(function()".eol()."{".eol();
		}
		
		return $script;
	}
	
	public function close()
	{	
		$script = "";
		
		if( $this->ready )
		{
			$this->ready = true;
			$script .= eol().'});'.eol();
		}
		
		$script .=  '</script>'.eol();
		
		return $script;
	}	
}