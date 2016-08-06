<?php
namespace ZN\Services;

trait SessionTrait
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Name Değişkeni
	 *  
	 * Çerez adı bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $name;
	
	/* Value Değişkeni
	 *  
	 * Çerez değeri bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $value;
	
	/* Regenerate Değişkeni
	 *  
	 * Çerez id bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $regenerate = true;
	
	/* Encode Değişkeni
	 *  
	 * Çerez şifreleme bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $encode = [];
	
	//----------------------------------------------------------------------------------------------------
	// Name
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $name
	//
	//----------------------------------------------------------------------------------------------------
	public function name($name = '')
	{
		if( ! isChar($name) )
		{
			\Exceptions::throws('Error', 'valueParameter', 'name');
			return $this;
		}
		
		$this->name = $name;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Encode
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $name
	// @param string $value
	//
	//----------------------------------------------------------------------------------------------------
	public function encode($name = '', $value = '')
	{
		if( ! ( isHash($name) || isHash($value) ) )
		{
			\Exceptions::throws('Error', 'hashParameter', 'name | value');
			return $this;		
		}
		
		$this->encode['name']  = $name;
		$this->encode['value'] = $value;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Decode
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $hash
	//
	//----------------------------------------------------------------------------------------------------
	public function decode($name = '')
	{
		if( ! isHash($name))
		{
			\Exceptions::throws('Error', 'hashParameter', 'name');
			return $this;	
		}
		
		$this->encode['name'] = $name;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Regenerate
	//----------------------------------------------------------------------------------------------------
	//
	// @param bool $regenerate
	//
	//----------------------------------------------------------------------------------------------------
	public function regenerate($regenerate = true)
	{
		if( ! is_bool($regenerate) )
		{
			\Exceptions::throws('Error', 'booleanParameter', 'regenerate');
			return $this;		
		}
		
		$this->regenerate = $regenerate;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Value
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $value
	//
	//----------------------------------------------------------------------------------------------------
	public function value($value = '')
	{
		$this->value = $value;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Methods
	//----------------------------------------------------------------------------------------------------
	// 
	// defaultVariable()
	//
	//----------------------------------------------------------------------------------------------------
	protected function defaultVariable()
	{
		$this->name 	  = NULL;
		$this->value 	  = NULL;
		$this->encode     = [];
		$this->regenerate = true;
	}
}