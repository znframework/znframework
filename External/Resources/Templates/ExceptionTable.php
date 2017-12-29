<?php
Import::style('bootstrap', 'awesome', 'external-template-style'); Import::script('jquery', 'bootstrap');

$lang  = ZN\IndividualStructures\Lang::select('Templates');

unset($trace['params']);

Import::template('ExternalTemplateStyles');
?>

<div class="col-lg-12" style="z-index:1000000; margin-top:15px">
    <div class="panel panel-default panel-top-header">

        <div class="panel-heading" style="background:#222; border:none;">
            <h3 class="panel-title panel-text h-panel-header">
            <i class="fa fa-exclamation-triangle fa-fw"></i> 
            <?php echo '<span class="text-color">'.($type ?? 'ERROR').'</span> &raquo; ' ?>
            <?php echo $message ?? NULL; ?></h3>
        </div>

        <div class="panel-body" style="margin-bottom:-17px;">
            <div class="list-group">
                <?php
                displayExceptionTable($file, $line, NULL, $lang);
            
                foreach( $trace as $key => $debug )
                    if( $debug['file'] !== $file && ! empty($debug['file']) )
                        displayExceptionTable($debug['file'], $debug['line'], $key, $lang);
                ?>
            </div>
        </div>
    </div>
</div>
<?php 
if( isset($trace) ) foreach( $trace as $key => $bug )
{
    $bug['type'] = NULL;
    $bug['key']  = $key;
    $bug['message'] = $bug['file'];
}

function displayExceptionTable($file, $line, $key, $lang)
{
    ?>
    <a href="#openExceptionMessage<?php echo $key?>" class="list-group-item panel-header" data-toggle="collapse">
        <span><i class="fa fa-angle-down fa-fw panel-text"></i>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $file ?? NULL; ?></span>
    </a>
    <div id="openExceptionMessage<?php echo $key?>" class="collapse<?php echo $key !== NULL ? '' : ' in'?>">
    <pre style="background:#222; margin-top:-20px; border:0px">
    <?php
    $content = file($file);
    $newdata = '<?php' . EOL;
    $intline = $line;
    $errorBlock = '<div class="error-block col-lg-12"></div>';

    for( $i = (($startLine = ($intline - 10)) < 0 ? 0 : $startLine); $i < ($intcount = $intline + 10); $i++ )
    {
        if( ! isset($content[$i]) )
        {
            break;
        }

        $index = $i + 1;
        $line  = $content[$i];

        if( $index == $intline )
        {
            $problem = ' {!!!!}';
            
        }
        else
        {
            $problem = ' ';
        }
        
        $newdata .= $index.'.' . $problem .
        str_repeat(' ', strlen($intcount) - strlen($i + 1)) . 
        (str_replace($key !== NULL ? EOL : NULL, NULL, $line) ?? NULL);
    }

    echo str_replace(['<div style="">&#60;&#63;php<br />', '{!!!!}'], [NULL, $errorBlock], Converter::highlight($newdata, 
    [
        'default:color' => '#ccc',
        'keyword:color' => '#00BFFF',
        'string:color'  => '#fff'
    ]));
    ?></pre></div><?php
}