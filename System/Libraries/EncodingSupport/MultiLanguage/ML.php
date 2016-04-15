<?php 
class __USE_STATIC_ACCESS__ML implements MLInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/*
	 * MultiLanguage/ uygulama dizini bilgisini tutar.
	 *
	 * @var string
	 */
	protected $appdir;
	
	/*
	 * Dil dosyası uzantı bilgisini tutar.
	 *
	 * @var string .ml
	 */
	protected $extension = '.ml';
	
	/*
	 * Dil dosyası yol bilgisini tutar.
	 *
	 * @var lang
	 */
	protected $lang;
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Başlangıç ayarları yapılandırılıyor.									  |
	|          																				  |
	******************************************************************************************/
	public function __construct()
	{
		// Dil doyalarının yer alacağı dizinin belirtiliyor.
		$this->appdir = STORAGE_DIR.'MultiLanguage/';	
		
		// Eğer dizin mevcut değilse oluşturulması sağlanıyor.
		if( ! is_dir($this->appdir) )
		{
			Folder::create($this->appdir, 0755);	
		}
			
		// Aktif dil dosyasının yolu belirtiliyor.
		$this->lang   = $this->appdir.getLang().$this->extension;
	}
	
	use CallUndefinedMethodTrait;
	
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
	
	/******************************************************************************************
	* INSERT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dil dosyasına kelime eklemek için kullanılır. 						  |
	
	  @param string $app 
	  @param mixed  $key
	  @param string $data
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function insert($app = '', $key = '', $data = '')
	{
		$datas = array();
		
		// Daha önce bir dil dosyası oluşturulmamışsa oluştur.
		if( ! is_file($this->lang) )
		{
			File::write($this->appdir.$app.$this->extension, Json::encode(array()));	
		}
		
		// Json ile veriler diziye çevriliyor.
		$datas = Json::decodeArray(File::read($this->lang));	
		
		if( ! empty($datas) )
		{
			$json = $datas;
		}	
		
		// 2. key parametresi hem dizi hemde string veri alabilir.
		// Bu parametrenin veri türüne göre ekleme işlemleri yapılıyor.
		if( ! is_array($key) )
		{
			$json[$key] = $data;
		}
		else
		{
			foreach( $key as $k => $v )
			{
				$json[$k] = $v;	
			}	
		}
		
		// Yeni eklenecek bir veri varsa ekle
		// Aksi halde herhangi bir işlem yapma.
		if( count($json) > count($datas) )
		{
			return File::write($this->appdir.$app.$this->extension, Json::encode($json));
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dil dosyasından kelime silmek için kullanılır. 						  |
	
	  @param string $app 
	  @param mixed  $key
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function delete($app = '', $key = '')
	{
		$datas = array();
		
		// Dosya mevcutsa verileri al.
		if( is_file($this->lang) )
		{
			$datas = Json::decodeArray(File::read($this->lang));		
		}
		
		if( ! empty($datas) )
		{
			$json = $datas;
		}	
		
		// Yine anahtar parametresinin ver türüne göre
		// işlemleri gerçekleştirmesi sağlanıyor.
		if( ! is_array($key) )
		{
			unset($json[$key]);
		}
		else
		{
			foreach($key as $v)
			{
				unset($json[$v]);	
			}	
		}
		
		// Dosyayı yeniden yaz.
		return File::write($this->appdir.$app.$this->extension, Json::encode($json));
	}
	
	/******************************************************************************************
	* UPDATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dil dosyasında yer alan bir kelimeyi güncellemek için kullanılır.		  |
	
	  @param string $app 
	  @param mixed  $key
	  @param string $data
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function update($app = '', $key = '', $data = '')
	{
		// Güncelleme işlemi ekleme yöntemi ile aynı özelliğe sahiptir.
		return $this->insert($app, $key, $data);
	}
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dil dosyasın yer alan istenilen kelimeye erişmek için kullanılır.  	  |
	
	  @param mixed  $key
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function select($key = '', $convert = '')
	{
		$read = File::read($this->lang);
		
		$array = Json::decodeArray($read);
		
		$return = '';
		
		if( isset($array[$key]) )
		{ 
			if( is_array($convert) )
			{
				$return = str_replace(array_keys($convert), array_values($convert), $array[$key]);
			}
			else
			{
				$return = str_replace('%', $convert, $array[$key]);
			}
		}
		
		return $return;       
	}
	
	/******************************************************************************************
	* LANG                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Sayfanın aktif dilini ayarlamak için kullanılır. 						  |
	
	  @param string $lang 
	  
	  @return bool
	|          																				  |
	******************************************************************************************/
	public function lang($lang = 'tr')
	{
		setLang($lang);
	}
}