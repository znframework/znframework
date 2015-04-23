<?php 
/************************************************************/
/*                       CLASS PAGINATION                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Pag
{
	private static $total_rows 		= 0;
	private static $limit 			= 0;
	private static $count_links 	= 10;
	private static $class			= array();
	private static $style			= array();
	private static $first_tag 		= '[prev]';
	private static $last_tag 		= '[next]';
	private static $firstest_tag 	= '[first]';
	private static $lastest_tag 	= '[last]';
	private static $url;
	
	public static function settings($config = array())
	{
		if( ! is_array($config)) return false;
		
		if(isset($config['total_rows']))	self::$total_rows 	= $config['total_rows'];
		if(isset($config['limit']))			self::$limit 		= $config['limit'];
		if(isset($config['url']))			self::$url 			= suffix(site_url($config['url']));	
		if(isset($config['count_links']))	self::$count_links 	= $config['count_links'];
		if(isset($config['class']))			self::$class 		= $config['class'];
		if(isset($config['style']))			self::$style 		= $config['style'];
		if(isset($config['prev_name']))		self::$first_tag 	= $config['prev_name'];
		if(isset($config['next_name']))		self::$last_tag 	= $config['next_name'];
		if(isset($config['first_name']))		self::$firstest_tag = $config['first_name'];
		if(isset($config['last_name']))		self::$lastest_tag 	= $config['last_name'];
		
		
	}
	
	public static function create($start = '')
	{
		
		import::library('Uri');
		$page  = "";
		$links = "";
		if(empty($start)) 
		{
			if( ! is_numeric(uri::segment(-1))) 
				$start_page = 0; 
			else 
				$start_page = uri::segment(-1);
		}
		else 
		{
			if( ! is_numeric($start)) $start = 0;
			$start_page = $start;
		}
		$per_page = @ceil(self::$total_rows / self::$limit);
		
		if(self::$count_links > $per_page)
		{
		
			for($i = 1; $i <= $per_page; $i++)
			{
				$page = ($i - 1) * self::$limit;
				
				if($i - 1 == $start_page / self::$limit)
				{
					$current_link = (isset(self::$class['current'])) ? 'class="'.self::$class['current'].'"' : "";
					$current_link_style =  (isset(self::$style['current'])) ? 'style="'.self::$style['current'].'"' : "";
				}
				else
				{
					$current_link = '';	
					$current_link_style = '';	
				}
				
				$class_links = (isset(self::$class['links'])) ? 'class="'.self::$class['links'].'"' : "";
				$style_links = (isset(self::$style['links'])) ? 'style="'.self::$style['links'].'"' : "";
				$links .= '<a href="'.self::$url.$page.'" '.$class_links.' '.$style_links.'><span '.$current_link.' '.$current_link_style.'> '.$i.'</span></a>';
			}
			
			if($start_page != 0)
			{
				$class_prev = (isset(self::$class['prev'])) ? 'class="'.self::$class['prev'].'"' : "";
				$style_prev = (isset(self::$style['prev'])) ? 'style="'.self::$style['prev'].'"' : "";
				$first = '<a href="'.self::$url.($start_page - self::$limit ).'" '.$class_prev .' '.$style_prev.'>'.self::$first_tag.'</a>';
			}
			else
			{
				$first = '';	
			}
			
			
			if($start_page != $page)
			{
				$class_next = (isset(self::$class['next'])) ? 'class="'.self::$class['next'].'"' : "";
				$style_next = (isset(self::$style['next'])) ? 'style="'.self::$style['next'].'"' : "";
				$last = '<a href="'.self::$url.($start_page + self::$limit).'" '.$class_next.' '.$style_next.'>'.self::$last_tag.'</a>';
			}
			else
			{
				$last = '';	
			}
		
			if(self::$total_rows > self::$limit) return $first.' '.$links.' '.$last;
		}
		else
		{
			
			$per_page = self::$count_links;
			
			if(isset(self::$class['last'])) $lastest_tag_class =  ' class="'.self::$class['last'].'" '; else $lastest_tag_class = '';
			if(isset(self::$class['first'])) $firstest_tag_class =  ' class="'.self::$class['first'].'" '; else $firstest_tag_class = '';
			if(isset(self::$class['next'])) $last_tag_class =  ' class="'.self::$class['next'].'" '; else $last_tag_class = '';
			if(isset(self::$class['current'])) $current_link_class =  ' class="'.self::$class['current'].'" '; else $current_link_class = '';
			if(isset(self::$class['links'])) $links_class =  ' class="'.self::$class['links'].'" '; else $links_class = '';
			if(isset(self::$class['prev'])) $first_tag_class =  ' class="'.self::$class['prev'].'" '; else $first_tag_class = '';
			
			$lastest_tag = '<a href="'.self::$url.(self::$total_rows - (self::$total_rows % self::$limit) - 1).'"'.$lastest_tag_class.'>'.self::$lastest_tag.'</a>';
			$firstest_tag = '<a href="'.self::$url.'0"'.$firstest_tag_class.'>'.self::$firstest_tag.'</a>';
			
			
			if($start_page > 0)
			{
				$first = '<a href="'.self::$url.($start_page - self::$limit ).'"'.$first_tag_class.'>'.self::$first_tag.'</a>';
				
			}
			else
			{
				$first = '';	
			}
			
			
			
			if(($start_page / self::$limit) == 0) $pag_index = 1; else $pag_index = @ceil( $start_page / self::$limit + 1);
			
			if($start_page < self::$total_rows - self::$limit)
			{
				$last = '<a href="'.self::$url.($start_page + self::$limit).'"'.$last_tag_class.'>'.self::$last_tag.'</a>';	
				
			}
			else
			{
				$last = '';
				$lastest_tag = '';
				$pag_index = @ceil(self::$total_rows / self::$limit) - self::$count_links + 1;
			}
			
			if($pag_index < 1 || $start_page == 0) $firstest_tag = '';
		
			$n_per_page = $per_page + $pag_index - 1;
			
			if($n_per_page >= @ceil(self::$total_rows / self::$limit)) 
			{
				$n_per_page = @ceil(self::$total_rows / self::$limit);
				$lastest_tag = '';
				$last = '';
			}
			
			$links = '';
			
			for($i = $pag_index; $i <= $n_per_page; $i++)
			{
				$page = ($i - 1) * self::$limit;
				
				if($i - 1 == $start_page / self::$limit)
				{
					$current_link = $current_link_class;
				}
				else
				{
					$current_link = '';	
				}
				
				$links .= '<a href="'.self::$url.$page.'"'.$links_class.'><span '.$current_link.'> '.$i.'</span></a>';
			}
	
			if(self::$total_rows > self::$limit) return $firstest_tag.' '.$first.' '.$links.' '.$last.' '.$lastest_tag;
		}
	}
}