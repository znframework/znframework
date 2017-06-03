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
$path       = ($path ? suffix($path) : NULL);

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

<div class="flexslider"<?php echo Html::attributes($attributes);?> id="<?php echo $id ?>">
    <ul class="slides">
        <?php if( isArray($images ?? NULL) ) foreach( $images as $image ): ?>
        <li>
            <?php
            if( ! is_array($image) ):
                echo Html::image($path . $image);
            else:
                echo Html::anchor($image[0], Html::image($path . $image[1]));
            endif;
            ?>
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
