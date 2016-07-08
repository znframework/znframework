<?php
namespace ZN\Database\Drivers\PgSQL\Traits;

trait ToolTrait
{
	/******************************************************************************************
	* LIST DATABASES                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir.                 		  | 
	|          																				  |
	******************************************************************************************/
	public function listDatabases()
	{
		$this->query('SELECT datname FROM pg_database');
		
		if( $this->error() ) 
		{
			return false;
		}
		
		$newDatabases = [];
		
		foreach( $this->result() as $databases )
		{
			foreach( $databases as $db => $database )
			{
				$newDatabases[] = $database;
			}
		}
		
		return $newDatabases;
	}
	
	/******************************************************************************************
	* LIST TABLES                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Bu sürücü için bu yöntem desteklenmemektedir.                 		  | 
	|          																				  |
	******************************************************************************************/
	public function listTables()
	{
		$this->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
		
		if( $this->error() ) 
		{
			return false;
		}
		
		$newTables = [];
		
		foreach( $this->result() as $tables )
		{
			foreach( $tables as $tb => $table )
			{
				$newTables[] = $table;
			}
		}
		
		return $newTables;
	}
}