<?php

$width      = $width      ?? '100%';
$attributes = $attributes ?? [];
$id         = $id         ?? 'datatable';
$class      = $class      ?? 'table-striped table-bordered table-hover';
$process    = $process    ?? NULL;
$length     = $length     ?? 100;
$serverSide = $properties['serverSide'] ?? NULL;
$result     = (array) $result;

if( empty($serverSide) )
{
    $columns = Arrays::keys(Arrays::getFirst($result));
}
else
{
    $columns = $result;

    foreach( $columns as $column )
    {
        $properties['columns'][] = ['data' => $column];
    }
}

if( ! empty($extensions) )
{
    Import::style(...$extensions);
} ?>

<table width="<?php echo $width ?>" <?php echo Html::attributes($attributes)?> class="table <?php echo $class;?>" id="<?php echo $id?>">
    <thead>
        <tr>
            <?php foreach( $columns as $column ): ?>
            <th><?php echo $column ?></th>
            <?php endforeach; ?>
            <?php if( is_callable($process) ): ?>
            <th><?php echo lang('ViewObjects', 'dbgrid:processLabel') ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <?php if( empty($serverSide) ): ?>
    <tbody>
        <?php foreach( $result as $key => $row ): ?>
        <tr>
            <?php foreach( $columns as $column ): ?>
            <td><?php echo Limiter::word($row[$column] ?? '', $length) ?></td>
            <?php endforeach; ?>
            <?php if( is_callable($process) ): ?>
            <td><?php echo $process((object) $row); ?></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <?php endif; ?>
</table>

<?php if( ! empty($extensions) )
{
    Import::script(...$extensions);
} ?>

<script>
$(document).ready(function(){
    $('#<?php echo $id ?>').DataTable(<?php echo ! empty($properties) ? Json::encode($properties) : NULL?>);
});
</script>
