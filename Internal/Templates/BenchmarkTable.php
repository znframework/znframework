<?php 
$style  = 'z-index:99999; position:absolute;';
$style .= 'border:solid 1px #E1E4E5;';
$style .= 'background:#FEFEFE;';
$style .= 'padding:10px;';

$table  = 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
$table .= 'color:#666;';
$table .= 'text-align:left;';
$table .= 'font-size:14px;';

$color =  'color:#900;';

$lang  = lang('Benchmark'); 
?>

<div style="<?php echo $style; ?>">
<table width="100%" style="<?php echo $table; ?>">
    <tr><td style="<?php echo $color;?>" colspan='2'><?php echo $lang['resultTable']; ?></td></tr>
    <tr><td width="160"><?php echo $lang['elapsedTime']; ?></td><td>: <b><?php echo $elapsedTime." ".$lang['second']; ?></b></td></tr>
    <tr><td><?php echo $lang['memoryUsage']; ?></td><td>: <b><?php echo $memoryUsage." ".$lang['byte']; ?></b></td></tr>
    <tr><td><?php echo $lang['maxMemoryUsage']; ?></td><td>: <b><?php echo $maxMemoryUsage." ".$lang['byte']; ?></b></td></tr>
    <tr><td><?php echo $lang['countFile']; ?></td><td>: <b><?php echo count(get_required_files()); ?></b></td></tr>
</table>
</div>