<?php
class __USE_STATIC_ACCESS__Template implements TemplateInterface
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
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use CallUndefinedMethodTrait;
	
	/******************************************************************************************
	* DATA                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadelerde ayrıştırma işlemi yapmak için kullanılır.			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @string => Metinsel veri.					 							  |
	| 2. array var @data => Değiştirilecek veriler.					  					      |
	|          																				  |
	| Örnek Kullanım: ->data('test', array('test' => 'deneme'))         					  |
	|          																				  |
	******************************************************************************************/
	public function data($string = '', $data = array())
	{
		// Parametre konrolleri sağlanıyor.
		if( ! is_string($string) )
		{
			return Errors::set('Error', 'stringParameter', 'string');	
		}

		$htmlRegexChar  	   = '.*?';
		$functionVarExpression = '\w+(::|\$|\-\>|\w|[0-9]|\[.*?\]|\{.*?\})*';
		
		$pattern = array
		(
			// DECISION STRUCTURES & LOOPS	
			'/@(endif|endforeach|endfor|endwhile|break|continue)/' 			=> '<?php $1 ?>',	
			'/@(elseif|if|foreach|for|while)\s*\(('.$htmlRegexChar.')\)/'	=> '<?php $1($2): ?>',
			'/@else/' 														=> '<?php else: ?>',
			
			// PRINTABLE FUNCTIONS
			'/@@(\$*'.$functionVarExpression.'\s*\('.$htmlRegexChar.'\))/' 	=> '<?php echo $1 ?>',		
			
			// FUNCTIONS
			'/@(\$*'.$functionVarExpression.'\s*\('.$htmlRegexChar.'\))/' 	=> '<?php $1 ?>',
		
			// PRINTABLE VARIABLES
			'/@(\$'.$functionVarExpression.')/'   	  						=> '<?php echo $1 ?>',
			
			// COMMENTS
			'/\{\-\-\s*('.$htmlRegexChar.')\s*\-\-\}/'			 			=> '<!--$1-->',
			
			// HTMLENTITES PRINT
			'/\{\{\{\s*('.$htmlRegexChar.')\s*\}\}\}/'			  			=> '<?php echo htmlentities($1) ?>',
			
			// PRINT
			'/\{\{(\s*'.$htmlRegexChar.')\s*\}\}/'				  			=> '<?php echo $1 ?>',
			
			// PHP TAGS
			'/\{\[\s*('.$htmlRegexChar.')\s*\]\}/'				  			=> '<?php $1 ?>',
		);
			
		$string = preg_replace(array_keys($pattern), array_values($pattern), $string);
		
		if( is_array($data) )
		{
			extract($data, EXTR_OVERWRITE);
		}
		
		ob_start(); 
		@eval("?>$string");
		$content = ob_get_contents(); 
		ob_end_clean(); 
		
		if( $lastError = Errors::last() )
		{
			Exceptions::table('', $lastError['message'], '', $lastError['line']);
		}
		else
		{
			return $content;
		}
	}	
}