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

$extensions = JC::extensions($extensions, ['jquery', 'flexSlider'], $autoloadExtensions);

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
        <?php if( is_array($images ?? NULL) ) foreach( $images as $image ): ?>
        <li>
            <?php
            if( ! is_array($image) ):
                echo Html::image($path . $image);
            else:
                echo Html::anchor
                (
                    key($image), 
                    Html::image($path . current($image))
                );
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
    $('#<?php echo $id ?>').flexslider(<?php echo ! empty($properties) ? json_encode($properties) : NULL?>);
});
</script>
