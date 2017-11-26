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

$extensions = JC::extensions($extensions, ['jquery', 'raphael', 'morris'], $autoloadExtensions);

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

<div<?php echo Html::attributes($attributes)?> id="<?php echo $id?>"></div>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>

<script>
<?php $properties['element'] = $id ?>
$(function()
{
    Morris.<?php echo ZN\DataTypes\Strings\Casing::title($type) ?>(<?php echo ZN\DataTypes\Json\Encode::do($properties)?>);
});
</script>
