<?php

if( isset($table) && Method::post($submit) )
{
    if( DB::insert('post:' . $table) )
    {
        $successData = true;
    }
    else
    {
        $errorData = true;
    }
}

//--------------------------------------------------------------------------------------------------------
// Extract Vars
//--------------------------------------------------------------------------------------------------------
//
// @var array  $extensions
// @var array  $properties
// @var array  $attributes
//
//--------------------------------------------------------------------------------------------------------
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
    $extensions = array_merge(['bootstrap', 'jquery', 'jqueryValidator'], (array) $extensions);
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

if( ! empty($action) )
{
    Form::action($action);
}

if( ! empty($method) )
{
    Form::method($method);
}

if( ! empty($multipart) )
{
    Form::multipart($multipart);
}

if( ! empty($class) )
{
    Form::class($class);
}

echo Form::attr($attributes)->open($name);

echo $contents;

if( ! empty($successData) && ! empty($success) ):
?>
<div class="alert alert-success">
    <?php echo $success; ?>
</div>
<?php
endif;

if( ! empty($errorData) && ! empty($error)  ):
?>
<div class="alert alert-danger">
  <?php echo $error; ?>
</div>
<?php
endif;

echo Form::close();

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>

<script>
$(function()
{
    $.validate(<?php echo ! empty($properties) ? Json::encode($properties) : NULL?>);
});
</script>
