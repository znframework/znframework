<?php
class __USE_STATIC_ACCESS__Download implements DownloadInterface
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
	use ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use CallUndefinedMethodTrait;
	
	/******************************************************************************************
	* START                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: İndirme işlemini başlatmak için kullanılır.							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              |
	| 1. string var @file => İndirilecek dosyanın yolu.									      |
	|          																				  |
	| Örnek Kullanım: start('document/file.txt')         									  |
	|          																				  |
	******************************************************************************************/
	public function start($file = '')
	{
		if( ! is_string($file) )
		{
			$this->error = lang('Download', 'stringParameterError');
			return Error::set($this->error);	
		}
		
		if( ! file_exists($file) )
		{
			$this->error = getMessage('Download', 'emptyParameterError');
			return Error::set($this->error);
		}
		
		// İndirilecek dosyanın yolu ile adını ayırmak için 
		// explode ile ayırma işlemi yapılmaktadır.
		$fileEx   = explode("/", $file);
		
		// Parçalan yolun son elemanı dosya adını tuttmaktadır.
		$fileName = $fileEx[count($fileEx)-1];
		
		// Parçalanan dosya yolunu yeniden oluşturulmuştur.
		$filePath = trim($file, $fileName);
		
		// İndirme işlemi için gerekli header verileri oluşturulmuştur.	
		header("Content-type: application/x-download");
		header("Content-Disposition: attachment; filename=".$fileName);
		
		readfile($filePath.$fileName);
	}	
}