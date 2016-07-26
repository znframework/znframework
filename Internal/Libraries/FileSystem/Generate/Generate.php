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
	
	protected $settings = [];
	
	public function settings($settings = [])
	{
		$this->settings = $settings;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Object
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name    : empty
	// @param string $type    : empty
	// @param array  $settings: empty
	//
	//----------------------------------------------------------------------------------------------------
	protected function _object($name, $type, $settings)
	{
		if( ! empty($settings) )
		{
			$this->settings = $settings;
		}
		
		return $this->_contentWrite($name, $type);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Model
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name    : empty
	// @param array  $settings: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function model($name = '', $settings = [])
	{
		return $this->_object($name, __FUNCTION__, $settings);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Controller
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	// @param array  $settings: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function controller($name = '', $settings = [])
	{
		return $this->_object($name, __FUNCTION__, $settings);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Library
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	// @param array  $settings: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function library($name = '', $settings = [])
	{
		return $this->_object($name, __FUNCTION__, $settings);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name: empty
	// @param string $type: 'controller', 'model', 'library'
	// @param string $app : empty
	//
	//----------------------------------------------------------------------------------------------------
	public function delete($name = '', $type = 'controller', $app = '')
	{
		if( ! empty($app) )
		{
			$this->settings['application'] = $app;
		}
		
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
		if( empty($this->settings['application']) )
		{
			$this->settings['application'] = divide(APPDIR, '/', 1);
		}
		
		return APPLICATIONS_DIR.$this->settings['application'].$this->_type($type).suffix($name, '.php');
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
		$parameters = '';
		
		$controller  = "<?php".$eol;
		
		if( empty( $this->settings['object']) )
		{
			$this->settings['object'] = 'class';
		}
		
		if( ! empty($this->settings['namespace']) )
		{
			$controller .= "namespace ".$this->settings['namespace'].";".$eol.$eol;
		}
		
		if( ! empty($this->settings['use']) )
		{
			foreach( $this->settings['use'] as $key => $use )
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
		
		$controller .= $this->settings['object']." ".$name;
		
		if( ! empty($this->settings['extends']) )
		{
			$controller .= " extends ".$this->settings['extends'];
		}
		
		if( ! empty($this->settings['implements']) )
		{
			$controller .= " implements ".( is_array($this->settings['implements']) 
			                                ? implode(', ', $this->settings['implements']) 
										    : $this->settings['implements']
										  );
		}
		
		$controller .= ";".$eol;
		$controller .= "{".$eol;
		
		if( ! empty($this->settings['traits']) )
		{
			if( is_array($this->settings['traits']) ) foreach( $this->settings['traits'] as $trait )
			{
				$controller .= $ht."use {$trait};".$eol;
			}
			else
			{
				$controller .= $ht."use ".$this->settings['traits'].";".$eol;
			}
			
			$controller .= $eol;
		}
		
		if( ! empty($this->settings['constants']) )
		{
			foreach( $this->settings['constants'] as $key => $val )
			{
				$controller .= $ht."const {$key} = {$val};".$eol;
			}
			
			$controller .= $eol;
		}
		
		if( ! empty($this->settings['vars']) )
		{
			$var = '';
			foreach( $this->settings['vars'] as $isKey => $var )
			{
				if( ! is_numeric($isKey) )
				{
					$value = $var;
					$var   = $isKey;
				}
				
				$vars = $this->_varType($var);
				$controller .= $ht.$vars->priority.' $'.$vars->var.( ! empty($value) ? " = ".$value : '' ).";".$eol;
			}
			
			$controller .= $eol;
		}
		
		if( ! empty($this->settings['functions']) ) foreach( $this->settings['functions'] as $isKey => $function )
		{
			if( ! empty($function) )
			{
				if( ! is_numeric($isKey) )
				{
					if( is_array($function) )
					{	
						$subValue = '';
						
						foreach( $function as $key => $val )
						{
							if( ! is_numeric($key) )
							{
								$subValue = $val;
								$val      = $key;
							}
							
							if( strpos($val, '...') === 0 )
							{
								$varprefix = str_replace('...', '...$', $val);
								$subValue  = ''; 
							}
							else
							{
								$varprefix = '$'.$val;
							}
							
							$parameters .= $varprefix.( ! empty($subValue) ? ' = '.$subValue : '').', ';
						}
						
						$parameters = rtrim($parameters, ', ');
					}
					
					$function = $isKey;
				}	
				
				$function = $this->_varType($function);
				
				$controller .= $ht.$function->priority." function {$function->var}({$parameters})".$eol;
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
				return $this->success = getErrorMessage('Generate', 'success', $name);	
			}	
			else
			{
				return ! $this->error = getErrorMessage('Generate', 'notSuccess', $name);
			}
		}	
		else
		{
			return ! $this->error = getErrorMessage('File', 'alreadyFileError', $name);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Var Type
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $var: empty
	//
	//----------------------------------------------------------------------------------------------------
	protected function _varType($var)
	{
		if( stripos($var, 'protected:') === 0 )
		{
			$priority = 'protected';
			$var      = str_ireplace('protected:', '', $var);
		}
		elseif( stripos($var, 'public:') === 0 )
		{
			$priority = 'public';
			$var      = str_ireplace('public:', '', $var);
		}
		elseif( stripos($var, 'private:') === 0 )
		{
			$priority = 'private';
			$var     = str_ireplace('private:', '', $var);
		}
		else
		{
			$priority = 'public';
			$var      = $var;
		}
		
		return (object) 
		[
			'priority' => $priority, 
			'var'      => $var
		];
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