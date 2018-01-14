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
| @extension jqueryui
| @extension datepicker
|
*/

$extensions = JC::extensions($extensions, ['jquery', 'jqueryui', 'datepicker'], $autoloadExtensions);

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
| Datepicker
|--------------------------------------------------------------------------
|
| Datepicker Structure
|
*/

if( ! empty($class) )
{
    Form::class($class);
}

echo Form::id($id)->attr($attributes)->text($name ?? $id);

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
| Datepicker Initialize
|--------------------------------------------------------------------------
|
| Init Datepicker With $properties
|
*/

$(function()
{
    $('#<?php echo $id ?>').datepicker(<?php echo ! empty($properties) ? json_encode($properties) : NULL?>);
});
</script>
