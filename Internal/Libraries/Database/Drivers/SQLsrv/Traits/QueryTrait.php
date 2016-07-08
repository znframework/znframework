<?php
namespace ZN\Database\Drivers\SQLsrv\Traits;

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
		return sqlsrv_query($this->connect, $query);
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
	public function query($query, $security = NULL)
	{
		$this->query = sqlsrv_query($this->connect, $query);
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
		return sqlsrv_begin_transaction($this->connect);
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  	  	  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		return sqlsrv_rollback($this->connect);		 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit özelliğinin kullanımıdır.        	  |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		return sqlsrv_commit($this->connect);
	}
}