<?php
namespace ZN\Foundations\Traits;

trait ErrorControlTrait
{
	/* Error Değişkeni
	 *  
	 * Dosya işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $error;
	
	//----------------------------------------------------------------------------------------------------
	// Protected Success
	//----------------------------------------------------------------------------------------------------
	//
	// Oluşan başarı bilgisi 
	//
	// @var  string
	//
	//----------------------------------------------------------------------------------------------------
	protected $success;
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dizin işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error()
	{
		if( isset($this->error) )
		{	
			return $this->error;
		}
		elseif( $error = \Errors::get(str_ireplace(STATIC_ACCESS, '', __CLASS__)) )
		{
			return $error;	
		}
		else
		{
			return false;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Success
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function success()
	{
		if( empty($this->error) && ! \Errors::get(str_ireplace(STATIC_ACCESS, '', __CLASS__)) ) 
		{
			if( ! empty($this->success) )
			{
				return $this->success;	
			}
			else
			{
				return lang('Success', 'success');
			}
		}
		else 
		{
			return false;
		}
	}
}