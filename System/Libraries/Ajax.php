<?php 
/************************************************************/
/*                     CLASS  AJAX                   	    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Ajax
{
	
	public static function send($methods = array())
	{
		if( ! is_array($methods)) return false;
		
		$methods['type'] = ''; $method = '';		
		
		$methods['type'] = (!$methods['type']) ? 'post' : $methods['type'];
		
		if(isset($methods['url']))
		{
			$methods['url']  = ( ! is_url($methods['url'])) ? site_url($methods['url']) : $methods['url']; 
		}
		
		foreach($methods as $key => $val)
		{
		
			if($key === "error" || $key === "success" || $key === "complete" || $key === "beforeSend")
			{
				$value = "function(data){".$val."}"; 	
			}
			else
			{
				$value = '"'.$val.'"';
			}
			
			if($key !== 'done')
			$method .= "\t\t".$key.':'.$value.','."\n";
		}
		
		$method = substr($method,0,-2);
		
		$ajax = "\t".'$.ajax'."\n\t".'({'."\n".$method."\n\t".'})';
		if(isset($methods['done']))$ajax .= '.done(function(data){'."\n\t\t".$methods['done']."\n\t".'});'."\n";
		else $ajax .= ";\n";
		
		return $ajax;
	}
	
	
	public static function json_send_back($data = array())
	{
		if( empty($data) || ! is_array($data) ) return false;
		
		exit(json_encode($data));	
	}
	
	
	public static function send_back($data = '')
	{
		if(is_array($data)) return false;
		echo $data; exit;	
	}
	
	
	public static function pr($data = array())
	{
		if( empty($data) || ! is_array($data) ) return false;
		
		print_r($data); exit;
	}
	
	
	public static function dump($data)
	{
		if( empty($data) || ! is_array($data) ) return false;
		
		var_dump($data); exit;
	}
	
	
	public static function pagination($start = 0, $limit = 5, $total_rows = 20, $set = array())
	{
		if( ! is_numeric($start)) $start = 0;
		if( ! is_numeric($limit)) $limit = 5;
		if( ! is_numeric($total_rows)) $total_rows = 20;
		if( ! is_array($set)) $set = array();
		
		$next_tag = (isset($set['next_name'])) ? $set['next_name'] : 'Sonraki';
		$prev_tag = (isset($set['prev_name'])) ? $set['prev_name'] : 'Önceki';
		
		$next_class = (isset($set['class']['next'])) ? ' class="'.$set['class']['next'].'"' : '';
		$next_style = (isset($set['style']['next'])) ? ' style="'.$set['style']['next'].'"' : '';
		
		$prev_class = (isset($set['class']['prev'])) ? ' class="'.$set['class']['prev'].'"' : '';
		$prev_style = (isset($set['style']['prev'])) ? ' style="'.$set['style']['prev'].'"' : '';
		
		$attr = "";
		$link_count = ceil(($total_rows ) / $limit);
		
		if($start - $limit < 0) $prev = 0; else $prev = $start - $limit;
		$next = $start + $limit;
		
		$links  = "\n<div ajax='pagination'>\n";
		if($start > 0) $links .= "\t<input$prev_class$prev_style type='button' page='".$prev."' value='".$prev_tag."'>";
		for($i = 1; $i <= $link_count; $i++)
		{
			$current = (($i * $limit) - 1) - $limit;
			if($current < 0) $current = 0;
			if($start == $current)
			{ 
				if(isset($set["class"]["current"])) $attr = ' class="'.$set["class"]["current"].'" '; 
				if(isset($set["style"]["current"])) $attr = ' style="'.$set["style"]["current"].'" '; 
			}
			else
			{
				$attr = "";	
			}
			$links .= "\t<input$attr type='button' page='".$current."' value='".$i."'>\n";
		}
		if($next < $total_rows) $links .= "\t<input$next_class$next_style type='button' page='".$next."' value='".$next_tag."'>\n";
		$links .= "</div>\n";
		
		if($total_rows > $limit) return $links; else return false;
	}
	

}