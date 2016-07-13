<?php
namespace ZN\ViewObjects;

class InternalScript implements Common\ViewObjectsInterface
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
	 * Jquery Ready durumu 
	 *
	 * @var bool true 
	 */
	protected $ready = true;
	
	/* 
	 * Script text türü 
	 *
	 * @var string text/javascript 
	 */
	protected $type  = 'text/javascript';
	
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
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	/******************************************************************************************
	* TYPE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Scriptin türünü ayarlamak için kullanılır.       	  		    		  |
	
	  @param string $type text/javascript
	  
	  @return this
	|          																				  |
	******************************************************************************************/
	public function type($type = 'text/javascript')
	{
		if( ! is_string($type) )
		{
			\Errors::set('Error', 'stringParameter', 'type');
			return $this;	
		}
		
		$this->type = $type;
		
		return $this;
	}
	
	/******************************************************************************************
	* LIBRARY                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Yüklemek istediğiniz harici script kütüphanelerini dahil etmek içindir. |
	
	  @param string arguments k1, k2 ... kN
	  
	  @return this
	|          																				  |
	******************************************************************************************/
	public function library(...$libraries)
	{
		\Import::script(...$libraries);
		
		return $this;
	}
	
	/******************************************************************************************
	* OPEN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Script tagını açmak için kullanılır.           	  		    		  |
	
	  @param bool $ready true
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function open($ready = true, $jqueryCdn = false, $jqueryUiCdn = false)
	{		
		$this->ready = $ready;
		
		$eol     = EOL;
		$script  = "";
		
		if( $jqueryCdn === true ) 
		{
			$script .= \Import::script('jquery', true);
		}
		
		if( $jqueryUiCdn === true ) 
		{
			$script .= \Import::script('jqueryUi', true);
		}
		
		$script .= "<script type=\"$this->type\">".$eol;
		
		if( $this->ready === true )
		{
			$script .= "$(document).ready(function()".$eol."{".$eol;
		}
		
		return $script;
	}

	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Script tagını kapatmak için kullanılır.          	  		    		  |
	
	  @param void
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function close()
	{	
		$script = "";
		$eol    = EOL;
		
		if( $this->ready === true )
		{
			$script .= $eol.'});';
		}
		
		$script .=  $eol.'</script>'.$eol;
		
		return $script;
	}	
}