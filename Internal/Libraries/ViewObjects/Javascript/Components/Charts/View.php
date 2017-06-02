<?php
//--------------------------------------------------------------------------------------------------------
// Extract Vars
//--------------------------------------------------------------------------------------------------------
//
// @var string $id
// @var array  $extensions
// @var array  $properties
// @var array  $attributes
// @var string $type
//
//--------------------------------------------------------------------------------------------------------
$id = $id ?? 'morris-area-chart';
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
    $extensions = array_merge(['jquery', 'bootstrap', 'raphael', 'morris'], $extensions);
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
?>

<div<?php echo Html::attributes($attributes)?> id="<?php echo $id?>"></div>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>

<script>
<?php $properties['element'] = $id ?>
$(function()
{
    Morris.<?php echo Strings::titleCase($type) ?>(<?php echo Json::encode($properties)?>);
});
</script>
