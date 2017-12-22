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

if( isset($trace['params']) )
{
    unset($trace['params']);
}

?>

<div style="<?php echo $style; ?>">
<table style="<?php echo $table; ?>">
    <?php if( ! empty($type) ): ?>
    <tr><td  style="<?php echo $color; ?>"><?php echo $lang['type']; ?> : </td><td><span><?php echo '['.$type.']'; ?></span></td></tr>
    <?php endif ?>

    <?php if( ! empty($message) ): ?>
    <tr><td  style="<?php echo $color; ?>"><?php echo $lang['message']; ?>: </td><td><span><?php echo $message; ?></span></td></tr>
    <?php endif ?>

    <?php if( ! empty($file) ): ?>
    <tr><td style="<?php echo $color; ?>"><?php echo $lang['file']; ?> : </td><td><span><?php echo $file; ?></span></td></tr>
    <?php endif ?>

    <?php if( ! empty($line) ): ?>
    <tr><td style="<?php echo $color; ?>"><?php echo $lang['line']; ?> : </td><td><span><?php echo '['.$line.']'; ?></span></td></tr>

    
    <tr>
        <td colspan="2" style="border:solid 1px #E1E4E5; padding:10px;">
            <span><?php 
        
            $content = file($file);
            $newdata = '<?php' . EOL;
            $intline = $line;
            
            for( $i = (($startLine = ($intline - 10)) < 0 ? 0 : $startLine); $i < ($intcount = $intline + 10); $i++ )
            {
                if( ! isset($content[$i]) )
                {
                    break;
                }

                $index = $i + 1;
               
                if( $index == $intline )
                {
                    $problem = '⬤';
                }
                else
                {
                    $problem = '  ';
                }
                
                $newdata .= $index . $problem .
                str_repeat(' ', strlen($intcount) - strlen($i)) . 
                ($content[$i] ?? NULL);
            }

            echo str_replace('<div style="">&#60;&#63;php<br />', NULL, Converter::highlight($newdata));
            ?></span>
        </td>
    </tr>

    <?php endif ?>
    
</table>
</div>
