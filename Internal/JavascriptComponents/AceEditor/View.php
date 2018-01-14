<?php
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/*
|--------------------------------------------------------------------------
| Autoloader Extension
|--------------------------------------------------------------------------
|
| @extension ace
|
*/

$extensions = JC::extensions($extensions, ['ace'], $autoloadExtensions);

/*
|--------------------------------------------------------------------------
| Available Style Extensions
|--------------------------------------------------------------------------
|
| Import extensions styles
|
*/

if( ! empty($extensions) )
{
    Import::style(...$extensions);
}

/*
|--------------------------------------------------------------------------
| Echo Content
|--------------------------------------------------------------------------
|
| Echo Content
|
*/

echo Html::style($style ?? 'position: absolute;top: 0;right: 0;bottom: 0;left: 0;')->attr($attributes)->id($id)->div('');

/*
|--------------------------------------------------------------------------
| Available Javascript Extensions
|--------------------------------------------------------------------------
|
| Import extensions styles
|
*/

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}

/*
|--------------------------------------------------------------------------
| Default Variables
|--------------------------------------------------------------------------
|
| Settings default variables
|
*/

$theme               = $properties['theme']               ?? 'monokai';
$mode                = $properties['language']            ?? 'php';
$tabSize             = $properties['tabSize']             ?? 4;
$softTabs            = $properties['softTabs']            ?? true;
$wrapMode            = $properties['wrapMode']            ?? true;
$highlightActiveLine = $properties['highlightActiveLine'] ?? false;
$showPrintMargin     = $properties['showPrintMargin']     ?? false;
$readOnly            = $properties['readOnly']            ?? false;

/*
|--------------------------------------------------------------------------
| Scripts
|--------------------------------------------------------------------------
|
| Settings script
|
*/

?>
<script>
        var editor = ace.edit('<?php echo $id; ?>');
        editor.setTheme('ace/theme/<?php echo $theme; ?>');
        editor.getSession().setMode("ace/mode/<?php echo $mode; ?>");
        editor.getSession().setTabSize(<?php echo $tabSize?>);
        editor.getSession().setUseSoftTabs(<?php echo $softTabs?>);
        editor.getSession().setUseWrapMode(<?php echo $wrapMode?>);
        editor.setHighlightActiveLine(<?php echo $highlightActiveLine?>);
        editor.setShowPrintMargin(<?php echo $showPrintMargin?>);
        editor.setReadOnly(<?php echo $readOnly?>);
</script>
