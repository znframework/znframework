<?php
$style  = 'position:absolute;bottom:10px;right:10px;';
$style .= 'border:solid 1px #E1E4E5;';
$style .= 'background:#FFF;';
$style .= 'padding:10px;';
$table  = 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
$table .= 'color:#666;';
$table .= 'text-align:left;';
$table .= 'font-size:14px;';

$color =  'color:#900;';

$lang  = Lang::select('IndividualStructures'); 
?>

<div style="<?php echo $style; ?>">
    <table width="100%" style="<?php echo $table; ?>">
        <tr><td width="160"><?php echo $lang['benchmark:elapsedTime']; ?></td><td>: <b><?php echo $elapsedTime." ".$lang['benchmark:second']; ?></b></td></tr>
        <tr><td><?php echo $lang['benchmark:memoryUsage']; ?></td><td>: <b><?php echo $memoryUsage." ".$lang['benchmark:byte']; ?></b></td></tr>
        <tr><td><?php echo $lang['benchmark:maxMemoryUsage']; ?></td><td>: <b><?php echo $maxMemoryUsage." ".$lang['benchmark:byte']; ?></b></td></tr>
        <tr><td><?php echo $lang['benchmark:countFile']; ?></td><td>: <b><?php echo count(get_required_files()); ?></b></td></tr>
    </table>
</div>
