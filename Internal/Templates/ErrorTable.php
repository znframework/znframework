<style type="text/css">
	.generalErrorTable
	{
		border:solid 1px #E1E4E5;
		background:#FEFEFE;
		padding:10px;
		margin:10px;
		font-family:Calibri, Ebrima, Century Gothic, Consolas, "Courier New", Courier, monospace, Tahoma, Arial;
		color:#666;
		font-size:14px;
		text-align:left;
	}
	.importantColorExceptionTable{ color:#900; }
</style>

<?php $lang = lang('Error'); ?>

<div class="generalErrorTable">
	<?php 
		if( isset($errors[$className]) )
		{
			$string  = '<table cellpadding="5" cellspacing="5">';
			$string .= '<tr>
							<td><b>'.$lang['upperLine'].'</b></td>
							<td><b>'.$lang['class'].'</b></td>
							<td><b>'.$lang['method'].'</b></td>
							<td><b>'.$lang['errorInfo'].'</b></td>
							<td><b>'.$lang['upperFile'].'</b></td>
						</tr>';
			
			if( isset($errors[$className][$methodName]['message']) )
			{
				$i = 0;
				foreach( $errors[$className][$methodName]['message'] as $error )
				{
					$string .= '<tr>
									<td>'.$errors[$className][$methodName]['line'][$i].'</td>
									<td>'.ucfirst($className).'</td>
									<td>::'.$methodName.'</td>
									<td><span class="importantColorExceptionTable">'.$error.'</span></td>
									<td>'.$errors[$className][$methodName]['file'][$i].'</td>
							    </tr>';
								
					$i++;
				} 
				
				$string .= '</table>';
				
				echo $string;
			}
			else
			{
				foreach( $errors[$className] as $key => $error )
				{	
					if( isset($errors[$className][$key]['message']) ) foreach( $errors[$className][$key]['message'] as $v )
					{
						$string .= '<tr>
									<td>'.$errors[$className][$key]['line'][0].'</td>
									<td>'.ucfirst($className).'</td>
									<td>::'.$key.'</td>
									<td><span class="importantColorExceptionTable">'.$v.'</span></td>
									<td>'.$errors[$className][$key]['file'][0].'</td>
							    </tr>';		
					}
				}	
				
				$string .= '</table>';
				
				echo $string;
			}
		}
		else
		{
			if( empty($errors) )
			{
				echo $lang['noError'];	
			}
			else
			{
				output($errors);
			}
		}
	?>
</div>