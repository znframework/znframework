<style type="text/css">
	.generalExceptionTable
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

<div class="generalExceptionTable">
<table>
    <tr><td><?php echo $lang['message']; ?></td><td>: <span class="importantColorExceptionTable"><?php echo $message; ?></span></td></tr>
    <tr><td><?php echo $lang['file']; ?></td><td>: <span class="importantColorExceptionTable"><?php echo $file; ?></span></td></tr>
    <tr><td><?php echo $lang['line']; ?></td><td>: <span class="importantColorExceptionTable"><?php echo $line; ?></span></td></tr>
</table>
</div>