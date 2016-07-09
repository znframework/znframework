<?php
namespace ZN\Database\Drivers\PDO\Traits;

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
		return $this->connect->exec($query);
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
		$this->query = $this->connect->prepare($query);
		return $this->query->execute($security);
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki strat transaction özelliğinin kullanımıdır.  |
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		return $this->connect->beginTransaction();
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  	  	  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		return $this->connect->rollBack(); 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki commit özelliğinin kullanımıdır.        	  |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		return $this->connect->commit();
	}
}