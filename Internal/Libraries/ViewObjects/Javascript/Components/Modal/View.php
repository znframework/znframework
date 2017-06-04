<?php
//--------------------------------------------------------------------------------------------------------
// Extract Vars
//--------------------------------------------------------------------------------------------------------
//
// @var string $type
// @var array  $extensions
// @var array  $properties
// @var array  $attributes
//
//--------------------------------------------------------------------------------------------------------
$extensions = $extensions ?? [];
$buttonValue = $button['value'] ?? 'Open Modal';
$buttonClass = $button['class'] ?? 'btn-info btn-lg';
$size        = $size ?? 'normal';
$close       = $close ?? true;

//--------------------------------------------------------------------------------------------------------
// Autoloader Extension
//--------------------------------------------------------------------------------------------------------
//
// @extension jquery
// @extension bootstrap
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

//--------------------------------------------------------------------------------------------------------
// Creating Pagination
//--------------------------------------------------------------------------------------------------------
//
// @output string
//
//--------------------------------------------------------------------------------------------------------
?>

<?php if( isset($button) ): ?>
<input<?php echo Html::attributes($button['attributes'] ?? [])?> type="<?php echo $button['type'] ?? 'button'?>" value="<?php echo $button['value'] ?? 'Open Modal'?>" class="btn <?php echo $button['class'] ?? 'btn-info'?>" data-toggle="modal" data-target="#<?php echo $id;?>">
<?php endif; ?>
<!-- Modal -->
<div<?php echo Html::attributes($modal['attributes'] ?? [])?> id="<?php echo $id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-<?php echo $modal['size'];?>">
        <div class="modal-content">
            <div class="modal-header">
            <?php if( $close === true ): ?>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php endif; ?>
            <h4 class="modal-title"><?php echo $modal['title'] ?? 'Modal Title'; ?></h4>
            </div>
            <div class="modal-body">
            <p><?php echo $modal['content'] ?? 'Modal Content'?></p>
            </div>
            <?php if( is_callable($modal['process'] ?? NULL) ): ?>
            <div class="modal-footer">
            <?php echo $modal['process'](new Form, new Html) ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
