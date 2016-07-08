<?php
namespace ZN\Database\Drivers\MsSQL\Traits;

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
		return mssql_query($query, $this->connect);
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
		$this->query = mssql_query($query, $this->connect);
		
		return $this->query;
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki begin tran özelliğinin kullanımıdır.  		  |
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		return $this->query('BEGIN TRAN');
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback tran özelliğinin kullanımıdır.  	  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		return $this->query('ROLLBACK TRAN');
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit tran özelliğinin kullanımıdır.        |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		return $this->query('COMMIT TRAN');
	}
}