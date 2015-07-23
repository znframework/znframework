<style type="text/css">
	.generalErrorTable
	{
		border:solid 1px #E1E4E5;
		background:#F3F6F6;
		padding:10px;
		margin-bottom:10px;
		font-family:"Courier New", Courier, monospace, Tahoma, Arial;
		color:#333;
		font-size:16px;
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
							<td><b>'.$lang['class'].'</b></td>
							<td><b>'.$lang['method'].'</b></td>
							<td><b>'.$lang['errorInfo'].'</b></td>
						</tr>';
			
			if( isset($errors[$className][$methodName]) )
			{
				foreach( $errors[$className][$methodName] as $error )
				{
					$string .= '<tr>
									<td>'.ucfirst($className).'</td>
									<td>::'.$methodName.'</td>
									<td><span class="importantColorExceptionTable">'.$error.'</span></td>
							    </tr>';
				} 
				
				$string .= '</table>';
				
				echo $string;
			}
			else
			{
				foreach( $errors[$className] as $key => $error )
				{	
					if( isset($errors[$className][$key]) ) foreach( $errors[$className][$key] as $v )
					{
						$string .= '<tr>
									<td>'.ucfirst($className).'</td>
									<td>::'.$key.'</td>
									<td><span class="importantColorExceptionTable">'.$v.'</span></td>
							    </tr>';	
					}
				}	
				
				$string .= '</table>';
				
				echo $string;
			}
		}
		else
		{
			echo $lang['noError'];	
		}
	?>
</div>