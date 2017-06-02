<?php
//--------------------------------------------------------------------------------------------------------
// Extract Vars
//--------------------------------------------------------------------------------------------------------
//
// @var string $id
// @var array  $extensions
// @var array  $properties
// @var array  $attributes
//
//--------------------------------------------------------------------------------------------------------,
$extensions = $extensions ?? [];
$attributes = $attributes ?? [];

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
if( ! empty($autoloadExtensions) )
{
    $extensions = array_merge(['jquery', 'jqueryui', 'datepicker'], $extensions);
}

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

echo Form::id($id)->attr($attributes)->text($id);

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
