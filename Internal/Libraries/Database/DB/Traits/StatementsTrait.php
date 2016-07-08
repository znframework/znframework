<?php
namespace ZN\Database\DB\Traits;

trait StatementsTrait
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* PROPERTY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sütunlara ait özel ifadelerin kullanımında evrensellik sağlar.		  |
	
	  @var string $col
	  
	  @return UNIQUE
	|          																				  |
	******************************************************************************************/
	public function property($type = '', $col = '', $output = true)
	{
		if( is_array($type) )
		{
			$state = '';
			
			foreach( $type as $key => $val )
			{
				if( ! is_numeric($key) )
				{
					$state .= $this->db->statements($key, $val);
				}
				else
				{
					$state .= $this->db->statements($val);
				}
			}
			
			return $state;
		}
		else
		{
			return $this->db->statements($type, $col, $output);
		}
	}
	
	/******************************************************************************************
	* AUTO INCREMENT                                                                          *
	*******************************************************************************************
	| Genel Kullanım: SQL AUTO_INCREMENT  kullanımının karşılığıdır.        	  			  |
	  
	  @return AUTO_INCREMENT
	|          																				  |
	******************************************************************************************/
	public function autoIncrement($col = '', $type = true)
	{
		return $this->db->statements(__FUNCTION__, $col, $type);
	}
	
	/******************************************************************************************
	* PRIMARY KEY                                                                             *
	*******************************************************************************************
	| Genel Kullanım: SQL PRIMARY KEY kullanımının karşılığıdır.   	  						  |
	
	  @var string $col
	  
	  @return PRIMARY KEY
	|          																				  |
	******************************************************************************************/
	public function primaryKey($col = '', $type = true)
	{
		return $this->db->statements(__FUNCTION__, $col, $type);
	}
	
	/******************************************************************************************
	* FOREIGN KEY                                                                             *
	*******************************************************************************************
	| Genel Kullanım: SQL FOREIGN KEY kullanımının karşılığıdır.   	  						  |
	
	  @var string $col
	  
	  @return FOREIGN KEY
	|          																				  |
	******************************************************************************************/
	public function foreignKey($col = '', $type = true)
	{
		return $this->db->statements(__FUNCTION__, $col, $type);
	}
	
	/******************************************************************************************
	* UNIQUE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: SQL UNIQUE kullanımının karşılığıdır.      	  						  |
	
	  @var string $col
	  
	  @return UNIQUE
	|          																				  |
	******************************************************************************************/
	public function unique($col = '', $type = true)
	{
		return $this->db->statements(__FUNCTION__, $col, $type);
	}
	
	/******************************************************************************************
	* NULL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: SQL NULL kullanımının karşılığıdır.       	  						  |
	
	  @return NULL / NOT NULL
	|          																				  |
	******************************************************************************************/
	public function null()
	{
		return $this->db->statements(__FUNCTION__);
	}
	
	/******************************************************************************************
	* NOT NULL                                                                                *
	*******************************************************************************************
	| Genel Kullanım: SQL NOT NULL kullanımının karşılığıdır.     	  						  |
	
	  @return NOT NULL
	|          																				  |
	******************************************************************************************/
	public function notNull()
	{
		return $this->db->statements(__FUNCTION__);
	}
	
	/******************************************************************************************
	* CONSTRAINT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: CONSTRAINT kullanımının karşılığıdır.     	  						  |
	
	  @return NOT NULL
	|          																				  |
	******************************************************************************************/
	public function constraint($constraint = '', $type = false)
	{
		return $this->db->statements(__FUNCTION__, $constraint, $type);
	}
	
	/******************************************************************************************
	* DEFAULT VALUE                                                                           *
	*******************************************************************************************
	| Genel Kullanım: DEFAULT kullanımının karşılığıdır.         	  						  |
	
	  @return NOT NULL
	|          																				  |
	******************************************************************************************/
	public function defaultValue($default = '', $type = false)
	{
		if( ! is_numeric($default) )
		{
			$default = presuffix($default, '"');	
		}
		
		return $this->db->statements('default', $default, $type);
	}
}