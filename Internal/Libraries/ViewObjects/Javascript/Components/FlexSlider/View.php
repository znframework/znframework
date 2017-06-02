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
    $extensions = array_merge(['jquery', 'flexSlider'], $extensions);
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

<div<?php echo Html::attributes($attributes);?> id="<?php echo $id ?>">
    <ul class="slides">
        <?php if( isArray($images ?? NULL) ) foreach( $images as $image ): ?>
        <li>
          <img src="<?php echo baseUrl($image); ?>" />
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>

<script>
$(function()
{
    $('#<?php echo $id ?>').flexslider(<?php echo ! empty($properties) ? Json::encode($properties) : NULL?>);
});
</script>
