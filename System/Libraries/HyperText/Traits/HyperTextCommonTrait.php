<?php
trait HyperTextCommonTrait
{
	// Function: $this->attributes()
	// İşlev: Girilen dizi bilgisini html etiketlerinin özellik değer biglisi türüne dönüştürür.
	// Parametreler
	// @attributes = Özellik değer çifti içeren dizi bilgisi. Örnek array("a" => "b") dizi verisi, a="b" verisine dönüşür.
	// Dönen Değer: Dönüştürülmüş veri.
	public function attributes($attributes = '')
	{
		$attribute = '';
		
		if( is_array($attributes) )
		{
			foreach( $attributes as $key => $values )
			{
				if( is_numeric($key) )
				{
					$key = $values;
				}
				
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}
		
		return $attribute;	
	}
	
	// Form Input Nesneleri
	private function _input($name = "", $value = "", $_attributes = '', $type = '')
	{
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		
		if( ! isValue($value) ) 
		{
			$value = '';		
		}
		
		$value = ( ! empty($value)) 
				 ? 'value="'.$value.'"' 
				 : "";
		
		// Herhangi bir id değeri tanımlanmamışsa
		// Id değeri olarak isim bilgisini kullan.
		$id = ( isset($_attributes["id"]) ) 
			  ? $_attributes["id"] 
			  : $name;
		
		// Id değer tanımlanmışsa
		// Id değeri olarak tanımalanan değeri kullan.
		$id_txt = ( isset($_attributes["id"]) ) 
			      ? ''
			      : "id=\"$id\"";
	
		return '<input type="'.$type.'" name="'.$name.'" '.$id_txt.' '.$value.Html::attributes($_attributes).'>'.eol();
	}
}