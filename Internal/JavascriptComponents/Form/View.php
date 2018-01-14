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
| @extension bootstrap
| @extension jqueryValidator
|
*/

$extensions = JC::extensions($extensions, ['jquery', 'bootstrap', 'jqueryValidator'], $autoloadExtensions);

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
| Form
|--------------------------------------------------------------------------
|
| Form Structure
|
*/

if( ! empty($action) )    Form::action($action);
if( ! empty($method) )    Form::method($method);
if( ! empty($multipart) ) Form::multipart($multipart);
if( ! empty($class) )     Form::class($class);

echo Form::attr($attributes)->open($name);

echo $contents;

echo Form::close();

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
| Form Initialize
|--------------------------------------------------------------------------
|
| Init Form With $properties
|
*/

<?php if( ! empty($messageInterval) ): ?>
$(document).ready(function(){
   setInterval(function()
   {
       $(".alert").slideUp('fast');
   },<?php echo $messageInterval;?>);
});
<?php endif;?>

$(function()
{
    $.validate(<?php echo ! empty($properties) ? json_encode($properties) : NULL?>);
});
</script>
