<?php
//--------------------------------------------------------------------------------------------------------
// Properties
//--------------------------------------------------------------------------------------------------------
//
//
//
//--------------------------------------------------------------------------------------------------------
$theme               = $properties['theme']               ?? 'monokai';
$mode                = $properties['language']            ?? 'php';
$tabSize             = $properties['tabSize']             ?? 4;
$softTabs            = $properties['softTabs']            ?? true;
$wrapMode            = $properties['wrapMode']            ?? true;
$highlightActiveLine = $properties['highlightActiveLine'] ?? false;
$showPrintMargin     = $properties['showPrintMargin']     ?? false;
$readOnly            = $properties['readOnly']            ?? false;

//--------------------------------------------------------------------------------------------------------
// Autoloader Extension
//--------------------------------------------------------------------------------------------------------
//
// @extension jquery
// @extension bootstrap
// @extension raphael
// @extension morris
//
//--------------------------------------------------------------------------------------------------------

$extensions = JC::extensions($extensions, ['ace']);

//--------------------------------------------------------------------------------------------------------
// Available Extensions
//--------------------------------------------------------------------------------------------------------
//
// Internal/Config/ViewObjects
// 'cdn' =>
// [
//     script => [],
//     style  => []
// ]
//
//--------------------------------------------------------------------------------------------------------
if( ! empty($extensions) )
{
    Import::style(...$extensions);
}

echo Html::style($style ?? 'position: absolute;top: 0;right: 0;bottom: 0;left: 0;')->attr($attributes)->id($id)->div('');

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
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
