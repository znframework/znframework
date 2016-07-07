<?php	
namespace ZN\Database;

class __USE_STATIC_ACCESS__Migration implements MigrationInterface
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
	// Migration Path
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string -- Application/Model/Migrations/
	//
	//----------------------------------------------------------------------------------------------------
	private $path;	
	
	//----------------------------------------------------------------------------------------------------
	// Config
	//----------------------------------------------------------------------------------------------------
	// 
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	private $config;
	
	//----------------------------------------------------------------------------------------------------
	// Class Fix
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string -- Migrate
	//
	//----------------------------------------------------------------------------------------------------
    private $classFix;
	
	//----------------------------------------------------------------------------------------------------
	// Extends Fix
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string -- Migration
	//
	//----------------------------------------------------------------------------------------------------
    private $extendsFix;
	
	//----------------------------------------------------------------------------------------------------
	// Table
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
    private $tbl;
	
	//----------------------------------------------------------------------------------------------------
	// Version
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
    private $versionDir = 'Version/';
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		$this->config = \Config::get('Database');
		$this->path   = MODELS_DIR.'Migrations/';
		
		if( ! is_dir($this->path) )
		{
			library('Folder', 'create', [$this->path, 0755]);	
		}
		
		$this->tbl = isset(static::$table)
				   ? static::$table	
				   : false;
		
		$this->_create();
		
		$this->classFix   = STATIC_ACCESS.'Migrate';
		$this->extendsFix = __CLASS__;
	}
	
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
	// success()
	// error()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Forge Methods Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Create Table
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $data
	//
	//----------------------------------------------------------------------------------------------------
	public function createTable($data = [])
	{
		if( \DBForge::createTable($this->_tableName(), $data) )
		{
			$this->_action(__FUNCTION__);	
		}	
		else
		{
			$this->error = \Errors::set(\DBForge::error(), true);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Drop Table
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function dropTable()
	{
		if( \DBForge::dropTable($this->_tableName()) )
		{
			$this->_action(__FUNCTION__);	
		}	
		else
		{
			$this->error = \Errors::set(\DBForge::error(), true);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Add Column
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $column
	//
	//----------------------------------------------------------------------------------------------------
	public function addColumn($column = [])
	{
		if( \DBForge::addColumn($this->_tableName(), $column) )	
		{
			$this->_action(__FUNCTION__);	
		}
		else
		{
			$this->error = \Errors::set(\DBForge::error(), true);	
		}
	}

	//----------------------------------------------------------------------------------------------------
	// Drop Column
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $column
	//
	//----------------------------------------------------------------------------------------------------
	public function dropColumn($column = [])
	{
		if( \DBForge::dropColumn($this->_tableName(), $column) )
		{
			$this->_action(__FUNCTION__);	
		}
		else
		{
			$this->error = \Errors::set(\DBForge::error(), true);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Modify Column
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $columns
	//
	//----------------------------------------------------------------------------------------------------
	public function modifyColumn($column = [])
	{
		if( \DBForge::modifyColumn($this->_tableName(), $column) )
		{
			$this->_action(__FUNCTION__);	
		}
		else
		{
			$this->error = \Errors::set(\DBForge::error(), true);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Truncate
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function truncate()
	{
		if( \DBForge::truncate($this->_tableName()) )	
		{
			$this->_action(__FUNCTION__);	
		}
		else
		{
			$this->error = \Errors::set(\DBForge::error(), true);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Action
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	protected function _action($type = '')
	{
		if( $type === '' )
		{
			$type = 'noAction';
		}
		
		$table   = $this->_tableName();
		$version = $this->_getVersion();
		
		\DB::insert($this->config['migrationTable'], ['name' => $table, 'type' => $type, 'version' => $version, 'date' => \Date::set('Ymdhis')]);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Table Name
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	protected function _tableName()
	{
		$table = preg_replace('/[0-9][0-9][0-9]/', '', $this->tbl);
		
		return str_replace($this->classFix, '', $table);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Forge Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Manipulation Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Create
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name -- Migrasyon Adı
	//
	//----------------------------------------------------------------------------------------------------
	public function create($name = '', $ver = 0)
	{
		if( $version = $this->_version($ver) )
		{
			$dir  = $this->path.$name.$this->versionDir;
			
			if( ! is_dir($dir) )
			{
				\Folder::create($dir);
			}
			
			$file = $dir.suffix($version, '.php');
			$name = $name.$version;	
		}
		else
		{
			$file = $this->path.suffix($name, '.php');
		}
		
		if( ! is_file($file) )
		{	
			$eol  = EOL;
			$str  = '<?php'.$eol;
			$str .= 'class '.$this->classFix.$name.' extends '.$this->extendsFix.$eol;
			$str .= '{'.$eol;
			$str .= "\t".'//----------------------------------------------------------------------------------------------------'.$eol;
			$str .= "\t".'// Call Undefined Method'.$eol;
			$str .= "\t".'//----------------------------------------------------------------------------------------------------'.$eol;
			$str .= "\t".'use CallUndefinedMethodTrait;'.$eol.$eol;
			$str .= "\t".'//----------------------------------------------------------------------------------------------------'.$eol;
			$str .= "\t".'// Class/Table Name'.$eol;
			$str .= "\t".'//----------------------------------------------------------------------------------------------------'.$eol;
			$str .= "\t".'protected static $table = __CLASS__;'.$eol.$eol;
			$str .= "\t".'//----------------------------------------------------------------------------------------------------'.$eol;
			$str .= "\t".'// Up'.$eol;
			$str .= "\t".'//----------------------------------------------------------------------------------------------------'.$eol;
			$str .= "\t".'public function up()'.$eol;
			$str .= "\t".'{'.$eol;
			$str .= "\t\t".'// Queries'.$eol;
			$str .= "\t".'}'.$eol.$eol;
			$str .= "\t".'//----------------------------------------------------------------------------------------------------'.$eol;
			$str .= "\t".'// Down'.$eol;
			$str .= "\t".'//----------------------------------------------------------------------------------------------------'.$eol;
			$str .= "\t".'public function down()'.$eol;
			$str .= "\t".'{'.$eol;
			$str .= "\t\t".'// Queries'.$eol;
			$str .= "\t\t".'$this->dropTable(); // Varsayılan işlem.'.$eol;
			$str .= "\t".'}'.$eol;
			$str .= '}';
		
			return \File::write($file, $str);
		}
		else
		{
			return \Errors::set('File', 'alreadyFileError', $file);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string  $name
	// @param numeric $version
	//
	//----------------------------------------------------------------------------------------------------
	public function delete($name = '', $ver = 0)
	{
		if( $version = $this->_version($ver) )
		{
			$dir  = $this->path.$name.$this->versionDir;
			$file = $dir.suffix($version, '.php');
			
			if( $ver === 'all' && is_dir($this->path.$name.$this->versionDir) )
			{
				\Folder::delete($this->path.$name.$this->versionDir);	
			}
		}
		else
		{
			$file = $this->path.suffix($name, '.php');
		}
		
		\File::delete($file);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete All
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function deleteAll()
	{
		if( is_dir($this->path) )
		{
			\Folder::delete($this->path);	
		}
		else
		{
			return \Errors::set('Folder', 'notFoundError', $this->path);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Migrations Table Create
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	protected function _create()
	{
		$table   = $this->config['migrationTable'];
		
		\DBForge::createTable('IF NOT EXISTS '.$table, array
		(
			'name'	  => [\DB::varchar(512), \DB::notNull()],
			'type'    => [\DB::varchar(256), \DB::notNull()],
			'version' => [\DB::varchar(3),   \DB::notNull()],
			'date' 	  => [\DB::varchar(15),  \DB::notNull()]
		));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Manipulation Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Version Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Version
	//----------------------------------------------------------------------------------------------------
	// 
	// @param numeric $numeric
	//
	//----------------------------------------------------------------------------------------------------
	public function version($version = 0)
	{
		if( empty($this->tbl) )
		{
			return false;	
		}
		
		$name = $this->classFix.$this->_tableName();
		
		if( $version <= 0 )
		{
			return uselib($name);	
		}
		
		$name .= $this->_version($version);
		
		return uselib($name);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get Version
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	protected function _getVersion()
	{
		preg_match('(\w+([0-9][0-9][0-9]))', $this->tbl, $match);
		
		return isset( $match[1] ) ? $match[1] : '000';
	}
	
	//----------------------------------------------------------------------------------------------------
	// Version
	//----------------------------------------------------------------------------------------------------
	// 
	// @param numeric $numeric
	//
	//----------------------------------------------------------------------------------------------------
	protected function _version($numeric)
	{
		$length = strlen((string)$numeric);
		
		if( (int)$numeric > 999 || (int)$numeric < 0 )
		{
			return \Errors::set('Error', 'invalidVersion', $numeric);
		}
	
		switch( $length )
		{
			case 1 : $numeric = '00'.$numeric; break;
			case 2 : $numeric = '0'.$numeric;  break;	
		}
		
		if( $numeric === '000' )
		{
			return false;	
		}
		
		return $numeric;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Version Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}