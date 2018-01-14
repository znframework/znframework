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
| @extension tinymce
|
*/

$extensions = JC::extensions($extensions, ['tinymce'], $autoloadExtensions);

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
| Tinymce Editor
|--------------------------------------------------------------------------
|
| Tinymce Structure
|
*/

echo Form::attr($attributes)->textarea($id);

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

/*
|--------------------------------------------------------------------------
| Tinymce Initialize
|--------------------------------------------------------------------------
|
| Init Tinymce With $properties
|
*/

$properties['selector'] = $properties['selector'] ?? 'textarea';    

?>
<script>
    tinymce.init(<?php echo ! empty($properties) ? json_encode($properties) : NULL?>);
</script>
