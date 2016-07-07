<?php
namespace ZN\Database\Drivers\Oracle8\Traits;

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
		$que = oci_parse($this->connect, $query);
		oci_execute($que);
		
		return $que;
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
		$this->query = oci_parse($this->connect, $query);
		return oci_execute($this->query);
	}
	
	/******************************************************************************************
	* TRANS START                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki autocommit özelliğinin kullanımıdır.  		  |
	|          																				  |
	******************************************************************************************/
	public function transStart()
	{
		$commit_mode = ( phpversion() > '5.3.2' ) 
					   ? OCI_NO_AUTO_COMMIT 
					   : OCI_DEFAULT;
		
		$this->exec($commit_mode);
		return true;
	}
	
	/******************************************************************************************
	* TRANS ROLLBACK                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki rollback özelliğinin kullanımıdır.  		  |
	|          																				  |
	******************************************************************************************/
	public function transRollback()
	{
		oci_rollback($this->connect);
		$commit_mode = OCI_COMMIT_ON_SUCCESS;
		return $this->exec($commit_mode);		 
	}
	
	/******************************************************************************************
	* TRANS COMMIT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veritabanı sürücülerindeki autocommits özelliğinin kullanımıdır.        |
	|          																				  |
	******************************************************************************************/
	public function transCommit()
	{
		oci_commit($this->connect);
		$commit_mode = OCI_COMMIT_ON_SUCCESS;
		return $this->exec($commit_mode);
	}
}