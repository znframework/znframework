<?php
/************************************************************/
/*                   TOOL UPLOADER                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
*  SQL FILE UPLOADER                                                           			  *
*******************************************************************************************
| Genel Kullanım: Sunucunuzda yer alan sql dosyasını mysql servere yüklemek 			  |
| için kullanılır.														                  |
|																						  |
| Parametreler: Tek parametresi vardır.                                              	  |
| 1. string var @sql_file => Sql dosyasının sunucudaki yolu.			  			      |
|          																				  |
| Örnek Kullanım: sql_file_uploader('Database/file.sql');         						  |
|          																				  |
******************************************************************************************/
if( ! function_exists('sql_file_uploader'))
{
	function sql_file_uploader($sql_file = '')
	{
		if( ! is_string($sql_file) || empty($sql_file) ) 
		{
			return false;
		}

		$file_contents = file::contents(suffix($sql_file,".sql"));
		
		$file_contents = preg_replace("/SET (.*?);/","",$file_contents);
		$file_contents = preg_replace("/\/\*(.*?)\*\//","",$file_contents);
		$file_contents = preg_replace("/--(.*?)\n/","",$file_contents);
		$file_contents = preg_replace("/\/\*!40101/","",$file_contents);
		
		$queries = explode(";\n", $file_contents);
		
		$db = uselib('Database\Db');
		
		foreach($queries as $query)
		{
			if( $query !== '' )
			{
				$db->exec_query(trim($query));
			}
		}
    }
}

/******************************************************************************************
* FILE UPLOADER                                                           			      *
*******************************************************************************************
| Genel Kullanım: Herhangi bir dosyayı sunucunuza yüklemek için kullanılır			      |													              
|																						  |
| Parametreler: 2 parametresi vardır.                                              	      |  
| 1. string var @filename => input file nesnesinin adı.			  					      |
| 2. string var @rootdir => Dosyanın hangi dizine yükleneceği.			  				  |
|          																				  |
| Örnek Kullanım: file_uploader('upload');         						      		      |
|          																				  |
******************************************************************************************/
if( ! function_exists('file_uploader'))
{
	function file_uploader($filename = 'upload', $rootdir = UPLOADS_DIR)
	{	
		if( ! is_string($filename) )
		{
			return false;
		}
		
		if( ! is_string($rootdir) ) 
		{
			$rootdir = UPLOADS_DIR;
		}
		
		$root = $rootdir;
	
		if( ! isset($_FILES[$filename]['name']) ) 
		{
			return false;
		}
		
		$name = $_FILES[$filename]['name'];
		
		if( is_array($name) )
		{	
			if( empty($name[0]) ) 
			{
				return false;		
			}
			
			$status = 0;	
			
			for($index = 0; $index < count($name); $index++)
			{	
				$source = $_FILES[$filename]['tmp_name'][$index];
				$target = $root.'/'.$name[$index];

				if( ! is_file($rootdir) )
				{ 
					move_uploaded_file($source,$target); 
					$status = 1;
				} 
			}
			
			return $status;
		}	
		else
		{
			$source = $_FILES[$filename]['tmp_name'];
			
			$target = $root.'/'.$name;		
	
			if( ! is_file($rootdir) ) 
			{
				move_uploaded_file($source,$target); 
			}
	
			return true;
		}	
    }
}