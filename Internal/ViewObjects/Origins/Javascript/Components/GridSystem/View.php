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

$extensions = JC::extensions($extensions, ['bootstrap'], $autoloadExtensions);

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

<div<?php echo Html::attributes($attributes); ?> class="container<?php echo isset($type) ? '-' . $type : NULL; ?>">
    <?php echo $contents; ?>
</div>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>
