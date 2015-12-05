<?php 
interface PermissionInterface
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
	* PROCESS                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Nesnelere yetki vermek için oluşturulmuştur.                            |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. numeric var @role_id => Yetkilerin uygulanacağı rol numarası.                        |
	| 2. string var @process => Yetkinin uygulanacağı nesnenin yetki ismi.                    |
	| 3. string var @process => Yetkinin uygulanacağı nesne.                   				  |
	|          																				  |
	| NOT: Yetkiler Config/Permission.php dosyasından ayarlanmaktadır.         				  |
	|          																				  |
	| Örnek Kullanım: process(4, 'guncelle', '<input type="button">');        	  			  |
	|          																				  |
	| Yukarıda yapılan işlem rol id'si 4 olan kullanıcı için yetki ismi guncelle olan		  |
	| nesneni bu kullanıcıya görüntülenip görüntülenmeyeceğidir. Eğer yetkisi rol id'si		  |
	| için izin verilmişse bu nesneyi görecektir. Aksi halde bu nesne yine bu kullanıcı için  |
	| görüntülenmeyecektir.         														  |
	|          																				  |
	******************************************************************************************/	
	public function process($roleId, $process, $object);
	
	/******************************************************************************************
	* PAGE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Sayfalara yetki vermek için oluşturulmuştur.                            |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. numeric var @role_id => Yetkilerin uygulanacağı rol numarası.                        |
	|          																				  |
	| NOT: Yetkiler Config/Permission.php dosyasından ayarlanmaktadır.         				  |
	|          																				  |
	| Örnek Kullanım: page(4);        	  			  									      |
	|          																				  |
	******************************************************************************************/
	public function page($roleId);	
}