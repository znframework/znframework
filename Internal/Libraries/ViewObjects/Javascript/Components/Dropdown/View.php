<?php
//--------------------------------------------------------------------------------------------------------
// Extract Vars
//--------------------------------------------------------------------------------------------------------
//
// @var array  $extensions
// @var array  $properties
// @var array  $attributes
//
//--------------------------------------------------------------------------------------------------------,
$extensions = $extensions ?? [];

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
    $extensions = array_merge(['jquery', 'bootstrap'], (array) $extensions);
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
?>

<div<?php echo Html::attributes($dropdown['attributes'] ?? []); ?> class="drop<?php echo $dropdown['type'] ?? 'down'; ?>">
    <button<?php echo Html::attributes($button['attributes'] ?? []); ?> class="btn <?php echo $button['class'] ?? 'btn-default' ?> dropdown-toggle" type="button" data-toggle="dropdown">
        <?php echo $value; ?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
    <?php echo $dropdowns(new ZN\ViewObjects\Javascript\Components\Dropdown); ?>
    </ul>
</div>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>
