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
| @extension select2
|
*/

$extensions = JC::extensions($extensions, ['jquery', 'select2'], $autoloadExtensions);

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
| Select2
|--------------------------------------------------------------------------
|
| Select2 Structure
|
*/

if( ! empty($multiple) ) Form::multiple();
if( ! empty($table) )    Form::table($table);
if( ! empty($query) )    Form::query($query);
if( ! empty($class) )    Form::class($class);

echo Form::id($id)->attr($attributes)->select($name, $data ?? [], $selected);

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
| Select2 Initialize
|--------------------------------------------------------------------------
|
| Init Select2 With $properties
|
*/

$(function()
{
    $('#<?php echo $id ?>').select2(<?php echo ! empty($properties) ? json_encode($properties) : NULL?>);
});
</script>
