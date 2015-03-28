<?php
/************************************************************/
/*                     CLASS FORM                           */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Form
{
		
	public static function attributes($_attributes = '')
	{
		$attribute = "";
		if(is_array($_attributes))
		{
			foreach($_attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}
		
		return $attribute;		
	}
	
	
	public static function open($name = '', $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		if(isset($_attributes['enctype']))
		{
			switch($_attributes['enctype'])
			{
				case "multipart" 	: $_attributes['enctype'] = 'multipart/form-data'; 					break;
				case "application" 	: $_attributes['enctype'] = 'application/x-www-form-urlencoded';	break;
				case "text" 		: $_attributes['enctype'] = 'text/plain'; 							break;
			}
		}
		if(!isset($_attributes['method'])) $_attributes['method'] = 'post';
		
		return '<form name="'.$name.'" '.$id_txt.self::attributes($_attributes).'>'."\n";
	}


	public static function close()
	{
		return '</form>'."\n";
	}


	public static function hidden($name = '', $value = '')
	{
		if( ! (is_string($value) || is_numeric($value))) $value = '';
		
		$hiddens = NULL;
		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		
		if(is_array($name))foreach($name as $key => $val)
		{
			$hiddens .= '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$val.'">'."\n";	
		}
		else
		{
			$hiddens = 	'<input type="hidden" name="'.$name.'" id="'.$name.'" '.$value.'>'."\n";
		}
		
		return $hiddens;
	}	
	
	public static function text($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="text" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}
	
	public static function password($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";	
		return '<input type="password" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}


	public static function textarea($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';	
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<textarea name="'.$name.'" '.$id_txt.self::attributes($_attributes).'>'.$value.'</textarea>'."\n";
	}


	public static function radio($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="radio" name="'.$name.'" '.$id_txt.'" '.$value.self::attributes($_attributes).'>'."\n";
	}



	public static function select($name = '', $options = array(), $selected = '', $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! is_string($selected)) $selected = '';
		
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		$selectbox = '<select name="'.$name.'" '.$id_txt.self::attributes($_attributes).'>';
		if(is_array($options))foreach($options as $key => $value)
		{
			if($selected == $key) $select= 'selected="selected"'; else $select = "";
			$selectbox .= '<option value="'.$key.'" '.$select.'>'.$value.'</option>'."\n";
		}
		$selectbox .= '</select>'."\n";	
		
		return $selectbox;
	}



	public static function multiple($name = '', $options = array(), $selected = '', $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! is_string($selected)) $selected = '';
		
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		$selectbox = '<select multiple="multiple" name="'.$name.'"" '.$id_txt.self::attributes($_attributes).'>';
		if(is_array($options))foreach($options as $key => $value)
		{
			if($selected == $key) $select= 'selected="selected"'; else $select = "";
			$selectbox .= '<option value="'.$key.'" '.$select.'>'.$value.'</option>'."\n";
		}
		$selectbox .= '</select>'."\n";	
		
		return $selectbox;
	}



	public static function checkbox($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';	
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="checkbox" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}



	public static function file($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="file" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}



	public static function submit($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="submit" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}



	public static function button($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';	
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="button" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}



	public static function reset($name = "", $value = "", $_attributes = '')
	{
		if( ! is_string($name)) $name = '';
		if( ! (is_string($value) || is_numeric($value))) $value = '';		
		$value = ( ! empty($value)) ? 'value="'.$value.'"' : "";
		$id = (isset($_attributes["id"])) ? $_attributes["id"] : $name;
		if( ! isset($_attributes["id"]) ) $id_txt = 'id="'.$id.'"'; else $id_txt = "";
		return '<input type="reset" name="'.$name.'" '.$id_txt.' '.$value.self::attributes($_attributes).'>'."\n";
	}	
}