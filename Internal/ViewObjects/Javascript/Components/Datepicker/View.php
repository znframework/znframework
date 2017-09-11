<?php
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

$extensions = JC::extensions($extensions, ['jquery', 'jqueryui', 'datepicker'], $autoloadExtensions);

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

if( ! empty($class) )
{
    Form::class($class);
}

echo Form::id($id)->attr($attributes)->text($name ?? $id);

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>

<script>
$(function()
{
    $('#<?php echo $id ?>').datepicker(<?php echo ! empty($properties) ? Json::encode($properties) : NULL?>);
});
</script>
