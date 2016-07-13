<?php
namespace ZN\Components;

class InternalTerminal implements TerminalInterface
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
	// Const CONFIG_NAME
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const CONFIG_NAME  = 'Components:terminal';
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		$this->config();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Config Method
	//----------------------------------------------------------------------------------------------------
	// 
	// config()
	//
	//----------------------------------------------------------------------------------------------------
	use \ConfigMethodTrait;
	
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
	* PROTECTED CLEAR COMMAND                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Oturum verilerini sıfılar.			  	                  		 	  |
	******************************************************************************************/
	protected function clearCommand()
	{	
		unset($_SESSION['persistCommands']);
		unset($_SESSION['commandResponses']);
		unset($_SESSION['commands']);
	}
	
	/******************************************************************************************
	* RUN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Terminali çalıştırır.					 	 						      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @terminalType => php , cmd.											      |
	| 2. array var @settings => Terminal ayarları.						 				      |
	|          																				  |
	| Örnek Kullanım: Terminal::run('cmd');        	  										  |
	|          																				  |
	******************************************************************************************/
	public function run($terminalType = 'php', $settings = [])
	{
		if( ! is_array($settings) )
		{
			return \Errors::set('Error', 'arrayParameter', 'settings');	
		}
		
		$configs = $this->config;
		
		$settings['width'] 		=  isset($settings['width']) 	  ? $settings['width']      : $configs['width'];
		$settings['height'] 	=  isset($settings['height']) 	  ? $settings['height']     : $configs['height'];
		$settings['bgColor'] 	=  isset($settings['bgColor'])    ? $settings['bgColor']    : $configs['bgColor'];
		$settings['barBgColor'] =  isset($settings['barBgColor']) ? $settings['barBgColor'] : $configs['barBgColor'];
		$settings['textColor'] 	=  isset($settings['textColor'])  ? $settings['textColor']  : $configs['textColor'];
		$settings['textType'] 	=  isset($settings['textType'])   ? $settings['textType']   : $configs['textType'];
		$settings['textSize'] 	=  isset($settings['textSize'])   ? $settings['textSize']   : $configs['textSize'];
		
		if( isset($_POST['clear']) && $_POST['clear'] === 'clear' ) 
		{
			$this->clearCommand();
		}
		
		if( ! isset($_SESSION['persistCommands']) || ! isset($_SESSION['commands']) ) 
		{
			$_SESSION['persistCommands']  = [];
			$_SESSION['commands'] 		  = [];
			$_SESSION['commandResponses'] = [];
		}
		
		$togglingPersist = false;
		
		if( isset($_POST['persistCommandId']) && is_numeric($_POST['persistCommandId']) ) 
		{
			$togglingPersist  = true;
			$persistCommandId = $_POST['persistCommandId'];
			
			if( count($_SESSION['persistCommands']) == $persistCommandId ) 
			{
				$togglingCurrentPersistCommand = true;
			} 
		}
		
		$previousCommands = '';
		$response = [];
		
		if( ! empty($_SESSION['persistCommands']) ) foreach( $_SESSION['persistCommands'] as $index => $persist ) 
		{
			if( ! empty($persist) ) 
			{
				$currentCommand = $_SESSION['commands'][$index];
				
				if( ! empty($currentCommand) ) 
				{
					$previousCommands .= $currentCommand.'; ';
				}
			}
		}
		
		if( isset($_POST['command']) ) 
		{
			$command = $_POST['command'];
			
			if( ! empty($command) && empty($togglingPersist) ) 
			{
				if( $command === 'clear' ) 
				{
					$this->clearCommand();
				}
				else 
				{
					if( $terminalType === 'php' )
					{
						$cmd = $command;
						
						ob_start(); 
						eval("$command");
						$content = ob_get_contents(); 
						ob_end_clean(); 
						
						$command = $content;
						
						if( $getError = error_get_last() )
						{
							$command = $cmd;
							$response[] = $getError['message']; 	
						}
					}
					else
					{
						$terminalType = 'cmd';
						exec($previousCommands.$command.' 2>&1', $response);
					}
				}
			} 

			
			if( $command !== 'clear' ) 
			{
				if( ! empty($togglingPersist) ) 
				{
					if( $togglingCurrentPersistCommand ) 
					{
						array_push($_SESSION['persistCommands'], true);
						array_push($_SESSION['commands'], $command);
						array_push($_SESSION['commandResponses'], $response);
						
						if( ! empty($command) ) 
						{
							$previousCommands = $previousCommands.$command.'; ';
						}
					}
				} 
				else 
				{
					array_push($_SESSION['persistCommands'], false);
					array_push($_SESSION['commands'], $command);
					array_push($_SESSION['commandResponses'], $response);
				}
			}
		}
	?>
		<style type="text/css">
			* 
			{
				margin: 0;
				padding: 0;
			}
			
			input 
			{
				color: inherit;
				font-family: inherit;
				font-size: inherit;
				font-weight: inherit;
				background-color: inherit;
				border: inherit;
			}
			.content 
			{
				width: <?php echo $settings['width']; ?>;
				min-width: 400px;
				margin: 0px auto;
				text-align: left;
				overflow: auto;
				background-color: <?php echo $settings['bgColor']; ?>;
				color: <?php echo $settings['textColor']; ?>;
				font-family: <?php echo $settings['textType']; ?>;
				font-weight: bold;
				font-size: <?php echo $settings['textSize']; ?>;
			}
			.terminal 
			{
				border: 1px solid #CCC;
				height: <?php echo $settings['height']; ?>;
				position: relative;
				overflow: auto;
				padding-bottom: 20px;
			}
			.terminal .bar 
			{
				background:<?php echo $settings['barBgColor']; ?>;;
				height:23px;
				padding: 2px;
				white-space: nowrap;
				overflow: hidden;
				color:<?php echo $settings['textColor']; ?>;
				text-align:center;
				padding-top:12px;
			}
			.terminal .commands 
			{
				padding: 2px;
				padding-right: 0;
			}
			.terminal #command 
			{
				width: 90%;
				outline:none;
				border:none;
			}
		</style>

		<div class="content">
			<div class="terminal" onclick="document.getElementById('command').focus();" id="terminal">
				<div class="bar">
					<?php echo 'ZN Framework Terminal Application '; ?>
				</div>
                
				<form action="<?php echo currentUrl(); ?>" method="post" class="commands" id="commands">
                    
					<?php if( ! empty($_SESSION['commands'])): ?>
					<div>
						<?php foreach ($_SESSION['commands'] as $index => $command): ?>
						
						<pre><?php echo $terminalType.' > ', $command, "\n"; ?></pre>
                        
							<?php foreach ($_SESSION['commandResponses'][$index] as $value):?>
                                		<pre><?php echo htmlentities($value), "\n"; ?></pre>
							<?php endforeach; ?>
                        
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
					<?php echo $terminalType.' > ';?>  
					<input type="text" name="command" id="command" autocomplete="off" onkeydown="return commandKeyedDown(event);" />
					
				</form>
			</div>
		</div>
		<script type="text/javascript">
			
			<?php
				$singleQuoteCancelledCommands = [];
				
				if( ! empty( $_SESSION['commands'] ) ) 
				{
					foreach( $_SESSION['commands'] as $command ) 
					{
						$cancelledCommand = str_replace('\\', '\\\\', $command);
						$cancelledCommand = str_replace('\'', '\\\'', $command);
						$singleQuoteCancelledCommands[] = $cancelledCommand;
					}
				}
			?>
			
			var previousCommands = ['', '<?php echo implode('\', \'', $singleQuoteCancelledCommands) ?>', ''];
			
			var currentCommandIndex = previousCommands.length - 1;
			
			document.getElementById('command').select();
			
			document.getElementById('terminal').scrollTop = document.getElementById('terminal').scrollHeight;
			
			function togglePersistCommand(command_id)
			{
				document.getElementById('persistCommandId').value = command_id;
				document.getElementById('commands').submit();
			}
			
			function commandKeyedDown(event)
			{
				var keyCode = getKeyCode(event);
				if( keyCode == 38 ) 
				{ 
					fillInPreviousCommand();
				} 
				else if( keyCode == 40 ) 
				{ 
					fillInNextCommand();
				} 
				else if( keyCode == 13 )
				{ 
					if (event.shiftKey) 
					{
						togglePersistCommand
						(
							<?php
							if( isset($_SESSION['commands']) ) 
							{
								echo count($_SESSION['commands']);
							} 
							else 
							{
								echo 0;
							}
							?>
						);
						return false;
					}
				}
				return true;
			}
			
			function fillInPreviousCommand()
			{
				currentCommandIndex--;
				
				if( currentCommandIndex < 0 ) 
				{
					currentCommandIndex = 0;
					return;
				}
				document.getElementById('command').value = previousCommands[currentCommandIndex];
			}
			
			function fillInNextCommand()
			{
				currentCommandIndex++;
				
				if( currentCommandIndex >= previousCommands.length ) 
				{
					currentCommandIndex = previousCommands.length - 1;
					return;
				}
				document.getElementById('command').value = previousCommands[currentCommandIndex];
			}
			
			function getKeyCode(event)
			{
				var eventKeyCode = event.keyCode;
				return eventKeyCode;
			}		
		</script>
    <?php
	}
}