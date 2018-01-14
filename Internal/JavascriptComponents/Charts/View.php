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
| @extension raphael
| @extension morris
|
*/

$extensions = JC::extensions($extensions, ['jquery', 'raphael', 'morris'], $autoloadExtensions);

/*
|--------------------------------------------------------------------------
| Available Style Extensions
|--------------------------------------------------------------------------
|
| Import extensions styles
|
*/

if( ! empty($extensions) )
{
    Import::style(...$extensions);
}

/*
|--------------------------------------------------------------------------
| Echo Content
|--------------------------------------------------------------------------
|
| Echo Content
|
*/

?><div<?php echo Html::attributes($attributes)?> id="<?php echo $id?>"></div><?php

/*
|--------------------------------------------------------------------------
| Available Javascript Extensions
|--------------------------------------------------------------------------
|
| Import extensions styles
|
*/

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}

/*
|--------------------------------------------------------------------------
| Scripts
|--------------------------------------------------------------------------
|
| Settings script
|
*/

?>
<script>
<?php $properties['element'] = $id ?>
$(function()
{
    Morris.<?php echo mb_convert_case($type, MB_CASE_TITLE, 'utf-8') ?>(<?php echo json_encode($properties)?>);
});
</script>
