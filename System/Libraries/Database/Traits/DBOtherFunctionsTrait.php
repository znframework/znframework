<?php
trait DBOtherFunctionsTrait
{
	/******************************************************************************************
	* LIKE                                                                                    *
	*******************************************************************************************
	| 																						  |
		@param string $value
		@param string $type: starting, inside, ending
	|          																				  |
	******************************************************************************************/
	public function like($value = '', $type = 'starting')
	{
		// Parametrelerin string kontrolü yapılıyor.
		if( ! is_scalar($value) || ! is_string($type) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'value, type'));
		}
		
		$operator = $this->db->operators['like'];
		
		if( $type === "inside" ) 
		{
			$value = $operator.$value.$operator;
		}
		
		// İle Başlayan
		if( $type === "starting" ) 
		{
			$value = $value.$operator;
		}
		
		// İle Biten
		if( $type === "ending" ) 
		{
			$value = $operator.$value;
		}
		
		return $value;
	}
}