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

$extensions = JC::extensions($extensions, ['jquery', 'flexSlider']);

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
        <?php if( IS::array($images ?? NULL) ) foreach( $images as $image ): ?>
        <li>
            <?php
            if( ! is_array($image) ):
                echo Html::image($path . $image);
            else:
                echo Html::anchor(Arrays::key($image), Html::image($path . Arrays::value($image)));
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
