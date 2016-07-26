<?php
namespace ZN\FileSystem;

class InternalGenerate implements GenerateInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
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
	// GeneratePropertiesTrait
	//----------------------------------------------------------------------------------------------------
	// 
	// application()
	// functions()
	// extend()
	//
	//----------------------------------------------------------------------------------------------------
	use GeneratePropertiesTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Constructor
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		$this->application = divide(APPDIR, '/', 1);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Model
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function model($name = '')
	{
		$this->_contentWrite($name, __FUNCTION__);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Controller
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function controller($name = '')
	{
		$this->_contentWrite($name, __FUNCTION__);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Library
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function library($name = '')
	{
		$this->_contentWrite($name, __FUNCTION__);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	// @param string $type: 'controller', 'model', 'library'
	//
	//----------------------------------------------------------------------------------------------------
	public function delete($name = '', $type = 'controller')
	{
		$file = $this->_path($name, $type);
		
		if( is_file($file) )
		{
			return \File::delete($file);	
		}
		
		return false;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Path
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	// @param string $type: empty
	//
	//----------------------------------------------------------------------------------------------------
	protected function _path($name, $type)
	{
		return APPLICATIONS_DIR.$this->application.$this->_type($type).suffix($name, '.php');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Content Write
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	// @param string $type: empty
	//
	//----------------------------------------------------------------------------------------------------
	protected function _contentWrite($name, $type)
	{	
		if( empty($name) )
		{
			$this->error = getErrorMessage('Error', 'emptyParameter', '1.(name)');
		}
			
		$eol = EOL;
		$ht  = HT;

		$controller  = "<?php".$eol;
		
		if( ! empty($this->namespaces) )
		{
			$controller .= "namespace {$this->namespaces};".$eol.$eol;
		}
		
		if( ! empty($this->using) )
		{
			foreach( $this->using as $key => $use )
			{
				if( is_numeric($key) )
				{
					$controller .= "use {$use};".$eol;
				}
				else
				{
					$controller .= "use {$key} as {$use};".$eol;
				}
			}
			
			$controller .= $eol;
		}
		
		$controller .= "class {$name} extends {$this->extend}".$eol;
		$controller .= "{".$eol;

		if( $type === 'model' && $this->extend === 'Grand' )
		{
			$controller .= $ht."// const table = '';".$eol;
		}
			
		if( ! empty($this->functions) ) foreach( $this->functions as $function )
		{
			if( ! empty($function) )
			{
				$controller .= $ht."public function {$function}()".$eol;
				$controller .= $ht."{".$eol;
				$controller .= $ht.$ht."// Your codes...".$eol;
				$controller .= $ht."}".$eol.$eol;
			}
		}

		$controller  = rtrim($controller, $eol);
		$controller .= $eol."}";

		$file = $this->_path($name, $type);
				
		if( ! is_file($file) )
		{
			if( \File::write($file, $controller) )
			{
				$this->success = getErrorMessage('Generate', 'success', $name);	
			}	
			else
			{
				$this->error = getErrorMessage('Generate', 'notSuccess', $name);
			}
		}	
		else
		{
			$this->error = getErrorMessage('File', 'alreadyFileError', $name);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Type
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $type: empty
	//
	//----------------------------------------------------------------------------------------------------
	protected function _type($type)
	{
		$return = '';
		
		if( $type === 'model' )
		{
			$return = 'Models';
		}
		elseif( $type === 'controller' )
		{
			$return = 'Controllers';
		}
		elseif( $type === 'library' )
		{
			$return = 'Libraries';
		}
		
		return presuffix($return);
	}
}