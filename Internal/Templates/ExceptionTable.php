<style type="text/css">
	.generalExceptionTable
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

<div class="generalExceptionTable">
<table>
    <?php if( ! empty($message) ): ?>
    <tr><td><?php echo $lang['message']; ?></td><td>: <span class="importantColorExceptionTable"><?php echo $message; ?></span></td></tr>
    <?php endif ?>
    
    <?php if( ! empty($file) ): ?>
    <tr><td><?php echo $lang['file']; ?></td><td>: <span class="importantColorExceptionTable"><?php echo $file; ?></span></td></tr>
    <?php endif ?>
    
    <?php if( ! empty($line) ): ?>
    <tr><td><?php echo $lang['line']; ?></td><td>: <span class="importantColorExceptionTable"><?php echo $line; ?></span></td></tr>
    <?php endif ?>
</table>
</div>