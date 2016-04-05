<?php
namespace Cubrid;

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
			return cubrid_list_dbs($this->connect);
		}
		else
		{
			return false;
		}
	}
}