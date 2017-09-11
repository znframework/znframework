<?php
//--------------------------------------------------------------------------------------------------------
// Autoloader Extension
//--------------------------------------------------------------------------------------------------------
//
// @extension jquery
// @extension bootstrap
//
//--------------------------------------------------------------------------------------------------------

$extensions = JC::extensions($extensions, ['jquery', 'bootstrap'], $autoloadExtensions);

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
// Creating Modal
//--------------------------------------------------------------------------------------------------------
//
// @output string
//
//--------------------------------------------------------------------------------------------------------
?>

<?php if( isset($button) ): ?>
<input<?php echo Html::attributes($button['attributes'])?> type="button" value="<?php echo $button['value']?>" class="btn <?php echo $button['class']?>" data-toggle="modal" data-target="#<?php echo $id;?>">
<?php endif; ?>
<!-- Modal -->
<div<?php echo Html::attributes($modal['attributes'] ?? [])?> id="<?php echo $id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-<?php echo $modal['size'];?>">
        <div class="modal-content">
            <div class="modal-header">
            <?php if( $modal['close'] === true ): ?>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php endif; ?>
            <h4 class="modal-title"><?php echo $title ?? 'Modal Title'; ?></h4>
            </div>
            <div class="modal-body">
            <p><?php echo $content ?? 'Modal Content'?></p>
            </div>
            <?php if( is_callable($process ?? NULL) ): ?>
            <div class="modal-footer">
            <?php echo $process(new Form, new Html) ?>
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
