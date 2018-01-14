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
| @extension jquery
| @extension flexSlider
|
*/

$extensions = JC::extensions($extensions, ['jquery', 'flexSlider'], $autoloadExtensions);

/*
|--------------------------------------------------------------------------
| Available Extensions
|--------------------------------------------------------------------------
|
| Import styles
|
*/

if( ! empty($extensions) )
{
    Import::style(...$extensions);
}

/*
|--------------------------------------------------------------------------
| Flex Slider
|--------------------------------------------------------------------------
|
| Flex Slider Structure
|
*/

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

/*
|--------------------------------------------------------------------------
| Available Extensions
|--------------------------------------------------------------------------
|
| Import scripts
|
*/

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>
<script>

/*
|--------------------------------------------------------------------------
| Flex Slider Initialize
|--------------------------------------------------------------------------
|
| Init Flex Slider With $properties
|
*/

$(function()
{
    $('#<?php echo $id ?>').flexslider(<?php echo ! empty($properties) ? json_encode($properties) : NULL?>);
});
</script>
