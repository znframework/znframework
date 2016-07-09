<?php
namespace ZN\Database\Drivers\Sybase\Traits;

trait QueryTrait
{
	/******************************************************************************************
	* EXEC                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki exec yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function exec($query, $security = NULL)
	{
		return sybase_query($this->connect, $query);
	}
	
	/******************************************************************************************
	* MULTI                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki multi query yönteminin kullanımıdır.   	  |
	|          																				  |
	******************************************************************************************/
	public function multiQuery($query, $security = NULL)
	{
		return $this->query($query, $security);
	}
	
	/******************************************************************************************
	* QUERY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki query yönteminin kullanımıdır.  			  |
	|          																				  |
	******************************************************************************************/
	public function query($query, $security = [])
	{
		$this->query = sybase_query($query, $this->connect);
		return $this->query;
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki begin transaction özelliğinin kullanımıdır.  |		
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		sybase_query($this->connect, 'BEGIN TRANSACTION');
		return true;
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  	  	  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		return sybase_query($this->connect, 'ROLLBACK TRANSACTION');	 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit özelliğinin kullanımıdır.        	  |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		return sybase_query($this->connect, 'COMMIT TRANSACTION');
	}
}