<?php
namespace ZN\FileSystem;

class InternalRecord extends \CallController  implements RecordInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* ZN Record Dir Değişkeni
	 *  
	 * Kayıt dizin bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $znrDir;
	
	/* Extension Değişkeni
	 *  
	 * Dosya uzantı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $extension = '.record.php';
	
	/* Select Record Değişkeni
	 *  
	 * Seçili kayıtın bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $selectRecord;
	
	/* Table Değişkeni
	 *  
	 * Kayıtların tutulacağı tablo adı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $table;
	
	/* Config Değişkeni
	 *  
	 * Kayıt ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	/* Where Değişkeni
	 *  
	 * Hangi kaydın silineceği bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $where;
	
	/* Result Array Değişkeni
	 *
	 * Sonuçları dizi türünde tutar.
	 *
	 */
	protected $resultArray;
	
	/* Secure Fix Değişkeni
	 *  
	 * Kayıt güvenliği eki bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $secureFix = '<?php exit; ?>';
	
	/******************************************************************************************
	* CONSTRUCT                                                                           	  *
	*******************************************************************************************
	| Genel Kullanım: Nesnelere değerler atanıyor.			   							      |
	******************************************************************************************/	
	public function __construct()
	{
		// Ayarlar alınıyor...
		$this->config     = \Config::get('FileSystem', 'record');
		// Ana dizin belirleniyor...
		$this->znrDir     = STORAGE_DIR.'Records/';
		// Güvenlik eki olşturuluyor...
		$this->secureFix .= EOL;
		
		$recordName = $this->config['record'];
		$recordDir  = $this->_recordName($recordName);
		
		// Config/Record.php dosyasıda yer alan
		// record parametresi ayarlanmışsa 
		// oluşturma ve seçme işlemini otomatik yap.
		if( ! empty($recordName) )
		{
			if( ! is_dir($recordDir) )
			{
				$this->createRecord($recordName);
			}
			
			if( is_dir($recordDir) )
			{
				$this->selectRecord($recordName);
			}
		}
	}

	/******************************************************************************************
	* CREATE RECORD                                                                       	  *
	*******************************************************************************************
	| Genel Kullanım: Yeni kayıt dizini oluşturuluyor.		   							      |
	******************************************************************************************/	
	public function createRecord(String $recordName)
	{
		if( ! is_dir($this->znrDir) )
		{
			\Folder::create($this->znrDir, 0755, true);	
		}
		
		if( ! is_dir($this->znrDir.$recordName) )
		{
			\Folder::create($this->znrDir.$recordName, 0755, true);
		}
		else
		{
			return \Exceptions::throws('File', 'alreadyFileError', $this->znrDir.$recordName);	
		}
	}
	
	/******************************************************************************************
	* CREATE TABLE                                                                         	  *
	*******************************************************************************************
	| Genel Kullanım: Tablo oluşturmak için kullanılıyor.								      |
	******************************************************************************************/	
	public function createTable(String $tableName)
	{
		if( empty($this->selectRecord) )
		{
			return \Exceptions::throws('Error', 'emptyVariable', '$this->selectRecord');
		}
		
		$tableName = $this->_tableName($tableName);
		
		// Daha önce aynı tablodan oluşturulmamışsa oluşturur.
		if( ! is_file($tableName) )
		{
			return \File::create($tableName);	
		}
		else
		{
			return \Exceptions::throws('File', 'alreadyFileError', $tableName);	
		}
	}
	
	/******************************************************************************************
	* SELECT RECORD                                                                       	  *
	*******************************************************************************************
	| Genel Kullanım: Kayıt dizini seçiliyor     			   							      |
	******************************************************************************************/	
	public function selectRecord(String $recordName)
	{
		$this->selectRecord = $this->_recordName($recordName);
		
		if( ! is_dir($this->selectRecord) )
		{
			$selectRecord = $this->selectRecord
			$this->selectRecord = NULL;
			
			return \Exceptions::throws('Error', 'dirNotFound', $selectRecord);
		}
		
		return true;
	}
	
	
	
	/******************************************************************************************
	* TABLE                                                                              	  *
	*******************************************************************************************
	| Genel Kullanım: Tablo seçmek için kullanılıyor.		   							      |
	******************************************************************************************/	
	public function table(String $table)
	{
		$this->table = $this->_tableName($table);
		
		if( ! is_file($this->table) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', $table);	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* WHERE                                                                              	  *
	*******************************************************************************************
	| Genel Kullanım: Silinecek veri id'sini belirtmek için kullanılır.					      |
	******************************************************************************************/	
	public function where($where = 0)
	{
		if( ! is_numeric($where) )
		{
			return \Exceptions::throws('Error', 'numericParameter', '1.($where)');
		}
		
		$this->where = $where;
		
		return $this;
	}
	
	/******************************************************************************************
	* SELECT / GET                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veri seçmek için kullanılır.			   							      |
	******************************************************************************************/	
	public function select(String $table, $where = 0)
	{
		if( ! is_numeric($where) )
		{
			return \Exceptions::throws('Error', 'numericParameter', '2.($where)');
		}
		
		$this->get($table, $where);
		
		return $this;
	}
	
	/******************************************************************************************
	* GET / SELECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veri seçmek için kullanılır.			   							      |
	******************************************************************************************/	
	public function get($table = NULL, $where = 0)
	{
		if( ! empty($this->table) )
		{
			$where = $table; 
			$table = $this->table;	
			$this->table = NULL;
		}
		else
		{
			$table = $this->_tableName($table);	
		}
		
		if( ! empty($where) )
		{
			$this->where = $where;	
		}
		
		if( ! is_file($table) )
		{
			return \Exceptions::throws('File', 'notFoundError', $table);	
		}
		
		$content 		   = file_get_contents($table);
		$this->result      = $this->_secureDecodeData($content);
		$this->resultArray = $this->_secureDecodeData($content, true);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Select Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Result Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* ROW                                                                                	  *
	*******************************************************************************************
	| Genel Kullanım: Tek bir kayıdı seçmek için kullanılır	   							      |
	******************************************************************************************/	
	public function row($where = 'first')
	{
		if( ! empty($this->where) )
		{
			$where = $this->where;	
			$this->where = NULL;
		}
		
		if( ! is_scalar($where) )
		{
			return \Exceptions::throws('Error', 'valueParameter', '1.($where)');
		}
		
		if( $where === 'first' )
		{
			$return = $this->resultArray[1];	
		}
		elseif( $where === 'last' )
		{
			$return = end($this->resultArray);
		}
		else
		{
			$return  = $this->resultArray[$where];	
		}
		
		// tek bir satır veri üretiliyor.
		return (object)$return;
	}
	
	/******************************************************************************************
	* RESULT                                                                             	  *
	*******************************************************************************************
	| Genel Kullanım: Object veri türünde sonuçları listeler. 							      |
	******************************************************************************************/	
	public function result($type = 'object')
	{
		if( $type === 'object' )
		{
			if( ! empty($this->where) )
			{
				$r = $this->where;
				$this->where = NULL;
				$result = $this->result->$r;
				$this->result = $result;
			}
		
			return $this->result;	
		}
		else
		{
			return $this->resultArray();	
		}
	}
	
	/******************************************************************************************
	* JSON                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sorgu sonucu kayıt bilgilerini verir.     			   		          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: ->resultJson();              			                                  |
	|          																				  |
	******************************************************************************************/
	public function resultJson()
	{ 
		return json_encode($this->result());	
	}
	
	/******************************************************************************************
	* RESULT ARRAY                                                                        	  *
	*******************************************************************************************
	| Genel Kullanım: Array veri türünde sonuçları listeler.  							      |
	******************************************************************************************/	
	public function resultArray()
	{
		if( ! empty($this->where) )
		{
			$resultArray = $this->resultArray[$this->where];
			$this->where = NULL;
			$this->resultArray = $resultArray;
		}
	
		return $this->resultArray;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Result Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Update Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* UPDATE                                                                              	  *
	*******************************************************************************************
	| Genel Kullanım: Kayıtları güncellemek için kullanılmaktadır.   					      |
	******************************************************************************************/	
	public function update($table = NULL, $data = [], $where = 0)
	{
		// Parametreler kaydırılıyor...
		if( ! empty($this->table) )
		{
			$where = $data; 
			$data  = $table;
			$table = $this->table;
			$this->table = NULL;	
		}
		else
		{
			$table = $this->_tableName($table);	
		}
		
		if( ! empty($this->where) )
		{
			$where = $this->where;	
		}
		
		if( ! is_string($table) )
		{
			return \Exceptions::throws('Error', 'stringParameter', '1.($table)');
		}
		
		if( ! is_file($table) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', '1.($table)');
		}
		
		if( empty($where) )
		{
			return \Exceptions::throws('Error', 'emptyParameter', '3.($where)');	
		}
		
		$oldData = $this->_secureDecodeData(file_get_contents($table), true);
		
		// Eğer belirtilen kayıt varsa güncelleniyor...
		if( isset($oldData[$where]) )
		{
			$oldData[$where] = $data;

			if( ! file_put_contents($table, $this->_secureEncodeData($oldData)) )
			{
				return \Exceptions::throws('Error', 'fileNotWrite', $table);
			}
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Update Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Insert Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* INSERT                                                                             	  *
	*******************************************************************************************
	| Genel Kullanım: Kayıt eklemek için kullanılır.			   							      |
	******************************************************************************************/	
	public function insert($table = NULL, $data = [])
	{
		if( ! empty($this->table) )
		{

			$data  = $table;
			$table = $this->table;	
			$this->table = NULL;
		}
		else
		{
			$table = $this->_tableName($table);	
		}
		
		if( ! is_string($table) )
		{
			return \Exceptions::throws('Error', 'stringParameter', '1.($table)');
		}
		
		if( ! is_file($table) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', '1.($table)');
		}
		
		$oldData = $this->_secureDecodeData(file_get_contents($table), true);
		
		// Daha önce kayıt oluşturulmuşsa.
		if( is_array($oldData) )
		{
			end($oldData);
			
		  	$key  = key($oldData);
		  	$key += 1;
			
			$oldData[$key] = $data;
		}
		else
		{
			// Daha önce kayıt oluşturulmamışsa.
      		$oldData = [1 => $data];
		}
		
		if( ! is_file($table) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', '1.($table)');	
		}
		
		if( ! file_put_contents($table, $this->_secureEncodeData($oldData)) )
		{
			return \Exceptions::throws('Error', 'fileNotWrite', $table);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Insert Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Delete Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* DELETE                                                                             	  *
	*******************************************************************************************
	| Genel Kullanım: Kayıt silmek için kullanılır.			   							      |
	******************************************************************************************/	
	public function delete($table = NULL, $where = 0)
	{
		if( ! empty($this->table) )
		{
			$where = $table; 
			$table = $this->table;	
			$this->table = NULL;
		}
		else
		{
			$table = $this->_tableName($table);	
		}
		
		if( ! empty($this->where) )
		{
			$where = $this->where;	
		}
		
		if( ! is_string($table) )
		{
			return \Exceptions::throws('Error', 'stringParameter', '1.($table)');
		}
		
		if( ! is_file($table) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', '1.($table)');
		}
		
		if( ! is_numeric($where) )
		{
			return \Exceptions::throws('Error', 'numericParameter', '2.($where)');
		}

		$oldData = $this->_secureDecodeData(file_get_contents($table), true);
		
		if( isset($oldData[$where]) )
		{
			unset($oldData[$where]);
		}
		else
		{
			if( empty($where) )
			{
				$oldData = [];	
			}
		}
		
		if( ! file_put_contents($table, $this->_secureEncodeData($oldData)) )
		{
			return \Exceptions::throws('Error', 'fileNotWrite', $table);
		}
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Delete Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Protected Method Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* PRIVATE SECURE ENCODE DATA                                                          	  *
	*******************************************************************************************
	| Genel Kullanım: Json veri türüne çevirir.			   			     				      |
	******************************************************************************************/	
	protected function _secureEncodeData($data)
	{
		return $this->secureFix.json_encode($data);
	}
	
	/******************************************************************************************
	* PRIVATE SECURE DECODE DATA                                                          	  *
	*******************************************************************************************
	| Genel Kullanım: Json veri türünü dizi türüne çevirir.   							      |
	******************************************************************************************/	
	protected function _secureDecodeData($data, $array = false)
	{
		$data = str_replace($this->secureFix, '', $data);
		
		return json_decode($data, $array);	
	}

	/******************************************************************************************
	* PRIVATE TABLE NAME                                                                  	  *
	*******************************************************************************************
	| Genel Kullanım: Tablo yolunu oluşturmak için kullanılır. 							      |
	******************************************************************************************/	
	protected function _tableName($tableName)
	{	
		return $this->selectRecord.$tableName.$this->extension;
	}
	
	/******************************************************************************************
	* PRIVATE RECORD NAME                                                                 	  *
	*******************************************************************************************
	| Genel Kullanım: Kayıt yolunu oluşturmak için kullanılır.							      |
	******************************************************************************************/	
	protected function _recordName($recordName)
	{
		return $this->znrDir.suffix($recordName);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Method Bitiş
	//----------------------------------------------------------------------------------------------------
}