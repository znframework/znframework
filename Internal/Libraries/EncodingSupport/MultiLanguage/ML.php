<?php 
namespace ZN\EncodingSupport;

class InternalML implements MLInterface
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
	 * Aktif dil dosyası yol bilgisini tutar.
	 *
	 * @var lang
	 */
	protected $lang;
	
	//----------------------------------------------------------------------------------------------------
	// Constructor
	//----------------------------------------------------------------------------------------------------
	// 
	// __construct()
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		// Dil doyalarının yer alacağı dizinin belirtiliyor.
		$this->appdir = STORAGE_DIR.'MultiLanguage/';	
		
		// Eğer dizin mevcut değilse oluşturulması sağlanıyor.
		if( ! is_dir($this->appdir) )
		{
			\Folder::create($this->appdir, 0755);	
		}
			
		// Aktif dil dosyasının yolu belirtiliyor.
		$this->lang   = $this->appdir.getLang().$this->extension;
	}
	
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
	// Insert
	//----------------------------------------------------------------------------------------------------
	//
	// Dil dosyasına kelime eklemek için kullanılır.
	// @param string $app 
	// @param mixed  $key
	// @param string $data
	//
	//----------------------------------------------------------------------------------------------------
	public function insert($app = '', $key = '', $data = '')
	{
		$datas = [];
		
		$createFile = $this->_langFile($app);
		// Daha önce bir dil dosyası oluşturulmamışsa oluştur.
		if( ! is_file($createFile) )
		{
			\File::write($createFile, \Json::encode([]));	
		}
		
		// Json ile veriler diziye çevriliyor.
		$datas = \Json::decodeArray(\File::read($createFile));	

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
		if( $json !== $datas )
		{
			return \File::write($createFile, \Json::encode($json));
		}
		else
		{
			return false;	
		}
	}

	//----------------------------------------------------------------------------------------------------
	// Delete
	//----------------------------------------------------------------------------------------------------
	//
	// Silinecek dil dosyası.
	// @param string $app 
	// @param mixed  $key
	//
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function delete($app = '', $key = '')
	{
		$datas = [];
		
		$createFile = $this->_langFile($app);
		
		// Dosya mevcutsa verileri al.
		if( is_file($createFile) )
		{
			$datas = \Json::decodeArray(\File::read($createFile));		
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
		return \File::write($createFile, \Json::encode($json));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete All
	//----------------------------------------------------------------------------------------------------
	//
	// Silinecek dil dosyası.
	// @param string $app 
	//
	//----------------------------------------------------------------------------------------------------
	public function deleteAll($app = NULL)
	{
		if( ! is_string($app) )
		{
			if( $app === NULL )
			{
				$MLFiles = \Folder::files($this->appdir, 'ml');
			}
			elseif( is_array($app) )
			{
				$MLFiles = $app;
			}
			else
			{
				return false;	
			}
			
			$allMLFiles = [];
			
			if( ! empty($MLFiles) ) foreach( $MLFiles as $file )
			{
				$removeExtension = str_replace('.ml', '', $file);
				$this->deleteAll($removeExtension);
			}
		}
		else
		{
			$createFile = $this->_langFile($app);
			// Dosya mevcutsa verileri al.
			if( is_file($createFile) )
			{
				return \File::delete($createFile);		
			}
			
			return false;
		}
	}

	//----------------------------------------------------------------------------------------------------
	// Update
	//----------------------------------------------------------------------------------------------------
	//
	// Dil dosyasında yer alan bir kelimeyi güncellemek için kullanılır.
	// @param string $app 
	// @param mixed  $key
	// @param string $data
	//
	//----------------------------------------------------------------------------------------------------
	public function update($app = '', $key = '', $data = '')
	{
		// Güncelleme işlemi ekleme yöntemi ile aynı özelliğe sahiptir.
		return $this->insert($app, $key, $data);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Select
	//----------------------------------------------------------------------------------------------------
	//
	// Dil dosyasın yer alan istenilen kelimeye erişmek için kullanılır.
	// @param mixed $key 
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function select($key = '', $convert = '')
	{
		$read = \File::read($this->lang);
		
		$array = \Json::decodeArray($read);
		
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
	
	public function selectAll($app = NULL)
	{
		if( ! is_string($app) )
		{
			if( $app === NULL )
			{
				$MLFiles = \Folder::files($this->appdir, 'ml');
			}
			elseif( is_array($app) )
			{
				$MLFiles = $app;
			}
			else
			{
				return false;	
			}			
			
			$allMLFiles = [];
			
			if( ! empty($MLFiles) ) foreach( $MLFiles as $file )
			{
				$removeExtension = str_replace('.ml', '', $file);
				$allMLFiles[$removeExtension] = $this->selectAll($removeExtension);
			}
			
			return $allMLFiles;
		}
		else
		{
			$createFile = $this->_langFile($app);	
			
			$read = \File::read($createFile);
			
			return \Json::decodeArray($read);
		}
	}

	//----------------------------------------------------------------------------------------------------
	// Lang
	//----------------------------------------------------------------------------------------------------
	//
	// Sayfanın aktif dilini ayarlamak için kullanılır.
	// @param string $lang 
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function lang($lang = 'tr')
	{
		setLang($lang);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Lang File
	//----------------------------------------------------------------------------------------------------
	//
	// @param array  $rows
	//
	//----------------------------------------------------------------------------------------------------
	protected function _langFile($app = '')
	{
		return $this->appdir.$app.$this->extension;	
	}
}