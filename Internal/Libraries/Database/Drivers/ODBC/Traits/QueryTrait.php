<?php
namespace ZN\Database\Drivers\ODBC\Traits;

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
		return odbc_exec($this->connect, $query);
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
		$this->query = odbc_prepare($this->connect, $query);
		return odbc_execute($this->query, $security);
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki autocommit özelliğinin kullanımıdır.  		  |		
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		return odbc_autocommit($this->connect, false);
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  	  	  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		$rollback = odbc_rollback($this->connect);
		odbc_autocommit($this->connect, true);
		return $rollback;	 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit özelliğinin kullanımıdır.        	  |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		$commit = odbc_commit($this->connect);
		odbc_autocommit($this->connect, true);
		return $commit;
	}
}