<?php
namespace ZN\Database\Drivers\FrontBase\Traits;

trait ToolTrait
{
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: DbTool sınıfında kullanımı için oluşturulmuş yöntemdir.                 | 
	|          																				  |
	******************************************************************************************/
	public function listDatabases()
	{
		if( ! empty($this->connect) )
		{
			return fbsql_list_dbs($this->connect);
		}
		else
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* LIST TABLES                                                                             *
	*******************************************************************************************
	| Genel Kullanım: DbTool sınıfında kullanımı için oluşturulmuş yöntemdir.                 | 
	|          																				  |
	******************************************************************************************/
	public function listTables()
	{
		if( ! empty($this->connect) )
		{
			return fbsql_list_tables($this->config['database'], $this->connect);
		}
		else
		{
			return false;
		}
	}
}