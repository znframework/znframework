<?php
class Download
{
	/***********************************************************************************/
	/* DOWNLOAD LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
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
	private static $error;
	
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
	public static function start($file = '')
	{
		if( ! is_string($file) )
		{
			self::$error = getMessage('Download', 'stringParameterError');
			report('Error', self::$error, 'DownloadLibrary');
			return false;	
		}
		
		if( ! file_exists($file) )
		{
			self::$error = getMessage('Download', 'emptyParameterError');
			report('Error', self::$error, 'DownloadLibrary');
			return false;	
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
	public static function error()
	{
		if( isset(self::$error) )
		{
			return self::$error;
		}
		else
		{
			return false;
		}
	}
}