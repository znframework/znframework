<?php
//--------------------------------------------------------------------------------------------------------
// Extract Vars
//--------------------------------------------------------------------------------------------------------
//
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
    $extensions = array_merge(['bootstrap'], (array) $extensions);
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

<div<?php echo Html::attributes($attributes); ?> class="container<?php echo isset($type) ? '-' . $type : NULL; ?>">
    <?php echo $grid(new ZN\ViewObjects\Javascript\Components\GridSystem); ?>
</div>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>
