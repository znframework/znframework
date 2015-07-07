<?php
/************************************************************/
/*                 FORM VALIDATION COMPONENT                */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* PROTECTED VALIDATION                                                                    *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilmez   		     							      |
| Sınıfı Kullanırken      :	Kullanılmaz      									 		  |
| 																						  |
| NOT: From kütüphanesine yardımcı sınıftır.     										  |
******************************************************************************************/
class CFormValidation extends CFormSecurity
{
	protected $required;
	protected $validError = array();

	protected function required($object = '', $value = '')
	{
		if( ! empty($value) )
		{
			return true;
		}
		else
		{
			$this->validError[$object][] = lang('Validation', 'required', $object);
		}
	}
	
	protected function email($object = '', $value = '')
	{
		$email = lang('Validation', 'email', $object);
		
		if( ! is_string($value) ) 
		{
			$this->validError[$object][] = $email;
			return false;
		}
		
		if( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value) ) 
		{
			$this->validError[$object][] = $email; 
		}
		else 
		{
			return true;
		}
	}
	
	protected function _match($object = '', $data1 = '', $data2 = '')
	{
		$dataMatch = lang('Validation', 'dataMatch', $object);
		
		if( ! (isValue($data1) || isValue($data2)) )
		{
			$this->validError[$object][] = $dataMatch;
			return false;	
		}
		
		if( $data1 === $data2 )
		{
			return true;	
		}
		else
		{
			$this->validError[$object][] = $dataMatch;
		}
	}
	
	protected function url($object = '', $value = '')
	{
		$url = lang('Validation', 'url', $object);
		
		if( ! is_string($value) )
		{ 
			$this->validError[$object][] = $url;
			return false;
		}
		
		if( ! preg_match('#^(\w+:)?//#i', $value) ) 
		{
			$this->validError[$object][] = $url; 
		}
		else
		{ 
			return true;
		}
	}
	
	protected function specialChar($object = '', $value = '')
	{
		$nospecialChar = lang('Validation', 'noSpecialChar', $object);
		
		if( ! is_string($value) )
		{
			$this->validError[$object][] = $nospecialChar;
			return false;
		}
		if( ! preg_match('#[!\'^\#\\\+\$%&\/\(\)\[\]\{\}=\|\-\?:\.\,;_ĞÜŞİÖÇğüşıöç]+#', $value) ) 
		{
			$this->validError[$object][] = $nospecialChar; 
		}
		else
		{ 
			return true;
		}
	}
	
	protected function numeric($object = '', $value = 0)
	{
		if( ! is_numeric($value) )
		{ 
			$this->validError[$object][] = lang('Validation', 'numeric',$object);
		} 
		else
		{
			return true;
		}
	}
	
	protected function _limit($object = '', $value = '', $minchar = 0, $maxchar = 0)
	{
		
		if( ! is_string($value) )
		{
			return false;
		}
		
		if( ! is_numeric($minchar) || ! is_numeric($maxchar) )
		{
			return false;
		}
		
		if( $minchar > strlen($value) )   
		{	
			$this->validError[$object][] = lang('Validation', 'minchar', array('%' => $object, '#' => $minchar));
		}
		
		if( $maxchar < strlen($value) ) 
		{
			$this->validError[$object][] = lang('Validation', 'maxchar', array('%' => $object, '#' => $maxchar));
		}
	}
	
	protected function identity($object = '', $value = 0)
	{
		$identity = lang('Validation', 'identity', $object);
		
		if( ! is_numeric($value) || strlen($value) != 11 )
		{
			$this->validError[$object][] = $identity;
			return false;
		}
		
		$numone 	= ( $value[0] + $value[2] + $value[4] + $value[6]  + $value[8] ) * 7;
		$numtwo 	= $value[1] + $value[3] + $value[5] + $value[7];
		$result 	= $numone - $numtwo;
		$tenth  	= $result % 10;
		$total  	= ( $value[0] + $value[1] + $value[2] + $value[3] + $value[4] + $value[5] + $value[6] + $value[7] + $value[8] + $value[9] );
		$elewenth 	= $total % 10;
		
		if( $value[0] == 0 )
		{
			$err = false;
		}
		elseif( $value[9] != $tenth ) 		
		{
			$err = false;
		}
		elseif( $value[10] != $elewenth ) 	
		{
			$err = false;
		}
		else
		{
			$err = true;
		}
		
		if( $err === false )
		{
			$this->validError[$object][] = $identity;
		}
		else 
		{
			return true;
		}
	}	
}