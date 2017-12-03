<?php
$style  = 'border:solid 1px #E1E4E5;';
$style .= 'background:#FEFEFE;';
$style .= 'padding:10px;';
$style .= 'margin-bottom:10px;';

$table  = 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
$table .= 'color:#666;';
$table .= 'text-align:left;';
$table .= 'font-size:14px;';

$color =  'color:#000;';
$lang  = ZN\IndividualStructures\Lang::select('Templates');
?>


<div style="<?php echo $style; ?>">
<table style="<?php echo $table; ?>">
    <?php if( ! empty($message) ): ?>
    <tr><td  style="<?php echo $color; ?>"><?php echo $lang['message']; ?> : </td><td><span><?php echo $message; ?></span></td></tr>
    <?php endif ?>

    <?php if( ! empty($file) ): ?>
    <tr><td style="<?php echo $color; ?>"><?php echo $lang['file']; ?> : </td><td><span><?php echo $file; ?></span></td></tr>
    <?php endif ?>

    <?php if( ! empty($line) ): ?>
    <tr><td style="<?php echo $color; ?>"><?php echo $lang['line']; ?> : </td><td><span><?php echo $line; ?></span></td></tr>
    <?php endif ?>
</table>
</div>
