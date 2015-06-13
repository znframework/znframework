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

use Uri;
/******************************************************************************************
* PAGINATION                                                                              *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->cpagination->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CPagination
{
	protected $url			= NULL;
	protected $limit		= NULL;
	protected $start		= NULL;
	protected $total_rows	= NULL;
	protected $count_links	= 10;
	protected $attr			= array();
	protected $css			= array();
	protected $style		= array();
	protected $first_tag 	= '[prev]';
	protected $last_tag 	= '[next]';
	protected $firstest_tag = '[first]';
	protected $lastest_tag 	= '[last]';
	
	public function url($url = '')
	{
		if( ! isUrl($url) )
		{
			$url = siteUrl($url);	
		}
		
		$this->url = $url;
		
		return $this;
	}
	
	public function start($start = 0)
	{
		if( ! is_numeric($start) )
		{
			return $this;
		}
		
		$this->start = $start;
		
		return $this;
	}
	
	public function limit($limit = 10)
	{
		if( ! is_numeric($limit) )
		{
			return $this;
		}
		
		$this->limit = $limit;
		
		return $this;
	}
	
	public function totalRows($total_rows = 0)
	{
		if( ! is_numeric($total_rows) )
		{
			return $this;
		}
		
		$this->total_rows = $total_rows;
		
		return $this;
	}
	
	public function countLinks($count_links = 10)
	{
		if( ! is_numeric($count_links) )
		{
			return $this;
		}
		
		$this->count_links = $count_links;
		
		return $this;
	}
	
	public function linkNames($prev = '[prev]', $next = '[next]', $first = '[first]', $last = '[last]')
	{
		if( ! ( is_string($day) && is_string($month) ) )	
		{
			return $this;	
		}
		
		// ÖNCEKİ BUTONU
		if( ! empty($prev) )
		{
			$this->first_tag    = $prev;
		}
		
		// SONRAKİ BUTONU
		if( ! empty($next) )
		{
			$this->last_tag     = $next;
		}
		
		// EN BAŞTAKİ BUTON
		if( ! empty($first) )
		{
			$this->firstest_tag = $first;
		}
			
		// EN SONDAKİ BUTON
		if( ! empty($last) )
		{
			$this->lastest_tag  = $last;
		}
		
		return $this;
	}
	
	public function attr($attr = array())
	{
		if( ! is_array($attr) )
		{
			return $this;	
		}
		
		if(isset($attr['url']))			$this->url 			= $attr['url'];
		if(isset($attr['start']))		$this->start 		= $attr['start'];
		if(isset($attr['limit']))		$this->limit 		= $attr['limit'];
		if(isset($attr['total_rows']))	$this->total_rows 	= $attr['total_rows'];
		if(isset($attr['count_links']))	$this->count_links 	= $attr['count_links'];
		if(isset($attr['prev_name']))	$this->first_tag 	= $attr['prev_name'];
		if(isset($attr['next_name']))	$this->last_tag 	= $attr['next_name'];
		if(isset($attr['first_name']))	$this->firstest_tag = $attr['first_name'];
		if(isset($attr['last_name']))	$this->lastest_tag 	= $attr['last_name'];
		
		$this->attr = $attr;
		
		return $this;	
	}
	
	public function css($css = '')
	{
		if( ! is_array($css) )
		{
			return $this;	
		}
		
		$this->css = $css;
		
		return $this;
	}
	
	public function style($style = array())
	{
		if( ! is_array($style) )
		{
			return $this;	
		}
		
		$this->style = $style;
		
		return $this;
	}
	
	public function create($start = NULL, $limit = NULL, $total_rows = NULL, $url = NULL)
	{
		$start = 		( $start !== NULL ) 
				 		? $start
				 		: $this->start;
				 
		$total_rows = 	( $total_rows !== NULL ) 
				      	? $total_rows
				      	: $this->total_rows;
		
		$limit = 		( $limit !== NULL ) 
				 		? $limit
				 		: $this->limit;
				 
		if( $url !== NULL )
		{
			$this->url($url);
		}
		
		$url = suffix($this->url);
								 	
		$page  = "";
		$links = "";
		
		if( $start === NULL ) 
		{	
			if( ! is_numeric(uri::segment(-1)) )
			{ 
				$start_page = 0; 
			}
			else
			{ 
				$start_page = uri::segment(-1);
			}
		}
		else 
		{
			if( ! is_numeric($start) ) 
			{
				$start = 0;
			}
			
			$start_page = $start;
		}
		
		$per_page = @ceil($total_rows / $limit);
		
		if( $this->count_links > $per_page )
		{
		
			for($i = 1; $i <= $per_page; $i++)
			{
				$page = ($i - 1) * $limit;
				
				// CURRENT ---------------------------------------------------------------------
				if( $i - 1 == $start_page / $limit )
				{
					// CURRENT CLASS -----------------------------------------------------------
					$current_link = ( isset($this->css['current']) ) 
								    ? 'class="'.$this->css['current'].'"' 
									: '';
					// -------------------------------------------------------------------------
					
					// CURRENT STYLE -----------------------------------------------------------				
					$current_link_style =  ( isset($this->style['current']) ) 
								           ? 'style="'.$this->style['current'].'"' 
										   : '';
					// -------------------------------------------------------------------------
				}
				else
				{
					$current_link = '';	
					$current_link_style = '';	
				}
				// -------------------------------------------------------------------------
				
				// LINKS CLASS -------------------------------------------------------------
				$class_links = ( isset($this->css['links']) ) 
							   ? 'class="'.$this->css['links'].'"' 
							   : '';
				// -------------------------------------------------------------------------
				
				// LINKS STYLE -------------------------------------------------------------
				$style_links = ( isset($this->style['links']) ) 
							   ? 'style="'.$this->style['links'].'"' 
							   : '';
				// -------------------------------------------------------------------------
				
				// LINKS -------------------------------------------------------------------		   
				$links .= '<a href="'.$url.$page.'" '.$class_links.' '.$style_links.'>
						      <span '.$current_link.' '.$current_link_style.'> '.$i.'</span>
						  </a>';
				// -------------------------------------------------------------------------		  
			}
			
			if( $start_page != 0 )
			{
				// PREV LINK STYLE ---------------------------------------------------------
				if( isset($this->css['prev']) )
				{
					$class_prev = 'class="'.$this->css['prev'].'"';
				}
				elseif( isset($this->css['links']) )
				{
					$class_prev = 'class="'.$this->css['links'].'"';
				}
				else
				{
					$class_prev = '';	
				}
				// -------------------------------------------------------------------------
				
				// PREV LINK STYLE ---------------------------------------------------------
				if( isset($this->style['prev']) )
				{
					$style_prev = 'style="'.$this->style['prev'].'"';
				}
				elseif( isset($this->style['links']) )
				{
					$style_prev = 'style="'.$this->style['links'].'"';
				}
				else
				{
					$style_prev = '';	
				}
				// -------------------------------------------------------------------------
				
				// PREV LINK ---------------------------------------------------------------
				$first = '<a href="'.$url.($start_page - $limit ).'" '.$class_prev .' '.$style_prev.'>'.
						 $this->first_tag.
						 '</a>';
				// -------------------------------------------------------------------------
			}
			else
			{
				$first = '';	
			}
			
			if( $start_page != $page )
			{
				// NEXT LINK CLASS ---------------------------------------------------------
				if( isset($this->css['next']) )
				{
					$class_next = 'class="'.$this->css['next'].'"';
				}
				elseif( isset($this->css['links']) )
				{
					$class_next = 'class="'.$this->css['links'].'"';
				}
				else
				{
					$class_next = '';	
				}
				// -------------------------------------------------------------------------
				
				// NEXT LINK STYLE ---------------------------------------------------------
				if( isset($this->style['next']) )
				{
					$style_next = 'style="'.$this->style['next'].'"';
				}
				elseif( isset($this->style['links']) )
				{
					$style_next = 'style="'.$this->style['links'].'"';
				}
				else
				{
					$style_next = '';	
				}
				// -------------------------------------------------------------------------
				
				// NEXT LINK ---------------------------------------------------------------
				$last = '<a href="'.$url.($start_page + $limit).'" '.$class_next.' '.$style_next.'>'.
						$this->last_tag.
						'</a>';
				// -------------------------------------------------------------------------
			}
			else
			{
				$last = '';	
			}
		
			if($total_rows > $limit) return $first.' '.$links.' '.$last;
		}
		else
		{	
			$per_page = $this->count_links;
			

			/******************************************************************************************
			* CLASS                                                                                   *
			******************************************************************************************/
			
			// LAST LINK CLASS ---------------------------------------------------------
			$lastest_tag_class = ( isset($this->css['last']) ) 
								 ? ' class="'.$this->css['last'].'" ' 
								 : '';
			// -------------------------------------------------------------------------
			
			// FIRST LINK CLASS --------------------------------------------------------
			$firstest_tag_class = ( isset($this->css['first']) ) 
								  ? ' class="'.$this->css['first'].'" ' 
								  : '';
			// -------------------------------------------------------------------------
			
			// NEXT LINK CLASS ---------------------------------------------------------
			$last_tag_class = ( isset($this->css['next']) ) 
							  ? ' class="'.$this->css['next'].'" ' 
							  : '';
			// -------------------------------------------------------------------------
			
			// CURRENT LINK CLASS ------------------------------------------------------
			$current_link_class = ( isset($this->css['current']) ) 
								  ? ' class="'.$this->css['current'].'" ' 
								  : '';
			// -------------------------------------------------------------------------
			
			// LINKS CLASS -------------------------------------------------------------				  
			$links_class = ( isset($this->css['links']) ) 
						   ? ' class="'.$this->css['links'].'" ' 
						   : '';
			// -------------------------------------------------------------------------
			
			// PREV LINK CLASS ---------------------------------------------------------					  
			$first_tag_class = ( isset($this->css['prev']) ) 
							   ? ' class="'.$this->css['prev'].'" ' 
							   : '';					 
			// -------------------------------------------------------------------------
			
			
			/******************************************************************************************
			* STYLE                                                                                   *
			******************************************************************************************/
			
			// LAST LINK STYLE ---------------------------------------------------------
			$lastest_tag_style = ( isset($this->style['last']) ) 
							     ? ' style="'.$this->style['last'].'" ' 
							     : '';
			// -------------------------------------------------------------------------
			
			// FIRST LINK STYLE --------------------------------------------------------
			$firstest_tag_style = ( isset($this->style['first']) ) 
							      ? ' style="'.$this->style['first'].'" ' 
							      : '';	
			// -------------------------------------------------------------------------
			
			// NEXT LINK STYLE ---------------------------------------------------------
			$last_tag_style = ( isset($this->style['next']) ) 
							  ? ' style="'.$this->style['next'].'" ' 
							  : '';				   
			// -------------------------------------------------------------------------
			
			// CURRENT LINK STYLE ------------------------------------------------------ 
			$current_link_style = ( isset($this->style['current']) ) 
							      ? ' style="'.$this->style['current'].'" ' 
							      : '';
			// -------------------------------------------------------------------------
			
			// LINKS STYLE -------------------------------------------------------------
			$links_style = ( isset($this->style['links']) ) 
						   ? ' style="'.$this->style['links'].'" ' 
						   : '';
			// -------------------------------------------------------------------------
			
			// PREV LINK STYLE ---------------------------------------------------------
			$first_tag_style = ( isset($this->style['prev']) ) 
							   ? ' style="'.$this->style['prev'].'" ' 
							   : '';				   
			// -------------------------------------------------------------------------
			
			
			/******************************************************************************************
			* LINKS                                                                                   *
			******************************************************************************************/
			
			// LAST LINK ---------------------------------------------------------------
			$lastest_tag = '<a href="'.$url.($total_rows - ($total_rows % $limit) - 1).'"'.$lastest_tag_class.$lastest_tag_style.'>'.
						   $this->lastest_tag.
						   '</a>';
			// -------------------------------------------------------------------------
			
			// FIRST LINK --------------------------------------------------------------
			$firstest_tag = '<a href="'.$url.'0"'.$firstest_tag_class.$firstest_tag_style.'>'.
							$this->firstest_tag.
							'</a>';
			// -------------------------------------------------------------------------
						
			// PREV LINK ---------------------------------------------------------------
			if( $start_page > 0 )
			{
				$first = '<a href="'.$url.($start_page - $limit ).'"'.$first_tag_class.$first_tag_style.'>'.
						 $this->first_tag.
						 '</a>';
				
			}
			else
			{
				$first = '';	
			}
			// -------------------------------------------------------------------------
					
			if( ($start_page / $limit) == 0 )
			{
				$pag_index = 1; 
			}
			else 
			{
				$pag_index = @ceil( $start_page / $limit + 1);
			}
			
			// NEXT LINK ---------------------------------------------------------------
			if( $start_page < $total_rows - $limit )
			{
				$last = '<a href="'.$url.($start_page + $limit).'"'.$last_tag_class.$last_tag_style.'>'.
						$this->last_tag.
						'</a>';	
				
			}
			else
			{
				$last = '';
				$lastest_tag = '';
				$pag_index = @ceil($total_rows / $limit) - $this->count_links + 1;
			}
			// -------------------------------------------------------------------------
			
			if( $pag_index < 1 || $start_page == 0 ) 
			{
				$firstest_tag = '';
			}
			
			$n_per_page = $per_page + $pag_index - 1;
			
			if($n_per_page >= @ceil($total_rows / $limit)) 
			{
				$n_per_page = @ceil($total_rows / $limit);
				$lastest_tag = '';
				$last = '';
			}
			
			$links = '';
			
			for($i = $pag_index; $i <= $n_per_page; $i++)
			{
				$page = ($i - 1) * $limit;
				
				if($i - 1 == $start_page / $limit)
				{
					$current_link = $current_link_class.$current_link_style;
				}
				else
				{
					$current_link = '';	
				}
				
				// PAGINATION LINKS -------------------------------------------------------
				$links .= '<a href="'.$url.$page.'"'.$links_class.$links_style.'>
						      <span '.$current_link.'> '.$i.'</span>
						  </a>';
				// -------------------------------------------------------------------------
			}
			
			// Toplam satır, limit miktarından büyükse 
			// sayfalamayı oluştur.
			if( $total_rows > $limit ) 
			{
				return $firstest_tag.' '.$first.' '.$links.' '.$last.' '.$lastest_tag;
			}
		}
	}
}