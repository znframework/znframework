<?php
class __USE_STATIC_ACCESS__Download
{
	/***********************************************************************************/
	/* DOWNLOAD LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Download
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: download::, $this->download, zn::$use->download, uselib('download')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Error Değişkeni
	 *  
	 * İndirme işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $error;
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Download::$method()"));	
	}
	
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
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Sepet işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error()
	{
		if( isset($this->error) )
		{
			return Error::set($this->error);
		}
		else
		{
			return false;
		}
	}
}