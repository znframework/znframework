<?php
namespace ZN\FileSystem;

class InternalExcel implements ExcelInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Output
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $rows
	//
	//----------------------------------------------------------------------------------------------------
	public function rows($rows = [])
	{
		$this->rows = $rows;
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// fileName
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $fileName
	//
	//----------------------------------------------------------------------------------------------------
	public function fileName($fileName = '')
	{
		$this->fileName = suffix($fileName, '.xls');
		
		return $this;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Array To XLS
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $data
	// @param string $file
	//
	//----------------------------------------------------------------------------------------------------
	public function arrayToXLS($data = [], $file = 'excel.xls')
	{
		if( ! is_array($data) ) 
		{
			return \Errors::set('Error', 'arrayParameter', '1.(data)');
		}
		
		if( ! is_string($file) ) 
		{
			return \Errors::set('Error', 'stringParameter', '2.(file)');
		}
		
		if( ! empty($this->fileName) )
		{
			$file = $this->fileName;
			$this->fileName = NULL;	
		}
		
		$file = suffix($file, '.xls');
		
		header("Content-Disposition: attachment; filename=\"$file\"");
		header("Content-Type: application/vnd.ms-excel;");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		if( ! empty($this->rows) )
		{
			$data = $this->rows;
			$this->rows = NULL;	
		}
		
		$output = fopen("php://output", 'w');
		
		foreach( $data as $column )
		{
			fputcsv($output, $column, "\t");
		}
		
		fclose($output);
	}
	
	//----------------------------------------------------------------------------------------------------
	// CSV To Array
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $file
	//
	//----------------------------------------------------------------------------------------------------
	public function CSVToArray($file = '')
	{
		if( ! is_string($file) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(file)');
		}
		
		if( ! empty($this->fileName) )
		{
			$file = $this->fileName;	
			$this->fileName = NULL;	
		}
		
		$file = suffix($file, '.csv');
		
		if( ! file_exists($file) )
		{
			return \Errors::set('File', 'notFoundError', $file);
		}
		
		$row  = 1;
		$rows = [];
		
		if( ($resource = fopen($file, "r") ) !== false ) 
		{
			while( ($data = fgetcsv($resource, 1000, ",")) !== false ) 
			{
				$num = count($data);
			
				$row++;
				for( $c = 0; $c < $num; $c++ ) 
				{
					$rows[] = explode(';', $data[$c]);
				}
			}
			 
			fclose($resource);
		 }	
		 
		 return $rows;
	}
}