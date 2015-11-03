<?php
class __USE_STATIC_ACCESS__Schedule
{
	/***********************************************************************************/
	/* SCHEDULE COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Schedule
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Schedule::, $this->Schedule, zn::$use->Schedule, uselib('Schedule')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Listeyi oluşturmak için kullanılır.				                      |
	  
	  @param array $data
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function create($data = array())
	{ 			
		return $this->_element($data, '', 0);
	}
	
	/******************************************************************************************
	* PROTECTED ELEMENT                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Listeyi oluşturmak için kullanılır.				                      |
	  
	  @param mixed   $data
	  @param string  $tab
	  @param numeric $start
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	protected function _element($data = '', $tab = '', $start = 0)
	{
		static $start;
		
		$eof 	 = eol();
		$output  = '';
		$attrs 	 = '';
		$tab 	 = str_repeat("\t", $start);
		
		if( ! is_array($data) )
		{
			return $data.$eof;	
		}
		else
		{
			foreach( $data as $k => $v )
			{
				if( is_numeric($k) )
				{
					$k = 'li';
				}	
				
				$end = "/".Arrays::getFirst(explode(' ', $k));
				
				if( ! is_array($v) )
				{			
					$output .= "$tab<$k>$v<$end>$eof";
				}
				else
				{
					$output .= $tab."<$k>$eof".$this->_element($v, $tab, $start++).$tab."<$end>".$tab.$eof;	
					$start--;
				}
			}
		}
		
		return $output;
	}	
}