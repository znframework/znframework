<?php
//--------------------------------------------------------------------------------------------------------
// Extract Vars
//--------------------------------------------------------------------------------------------------------
//
// @var string $id
// @var array  $extensions
// @var array  $properties
// @var array  $attributes
// @var array  $data
// @var scalar $selected
// @var string $class
// @var string $table
// @var string $query
//
//--------------------------------------------------------------------------------------------------------

$config = Config::get('ViewObjects', 'pagination');

$extensions = $extensions ?? [];
$attributes = $attributes ?? [];
$type       = $type       ?? $config['type'];
$index      = md5($index);

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

preg_match('/limit\s+([0-9]+)(\s*\,\s*([0-9]+))*/xi', $get->stringQuery(), $match);

$start = $match[1];

if( $type === 'ajax' )
{
    $start = Method::post('start');
}

$limit = $match[3] ?? $config['limit'];
?>

<ul class="pagination">
    <?php
    $rows = ceil($get->totalRows(true) / $limit);

    for( $i = 1; $i <= $rows; $i++ ):
        $s = ($i - 1) * $limit;
    ?>

    <li <?php echo $s == ($start ?? 0) ? 'class="active"' : '' ?>>
        <?php
            if( $type === 'ajax' )
            {
                Html::onclick('JCAjaxPagination'.$index.'('.$s.')');
                $anchor = '#' . $s;
            }
            else
            {
                $anchor = siteUrl(Pagination::getURI($s));
            }

            echo Html::anchor($anchor, $i);
        ?>
    </li>
    <?php endfor; ?>
</ul>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}

if( $type === 'ajax' ):
?>
<script>
function JCAjaxPagination<?php echo $index; ?>(start)
{
    $.ajax
    ({
    	data:{"start" : start},
    	method:"post",
    	success:function(data)
    	{
            document.documentElement.innerHTML = data;
    	}
    });
}
</script>
<?php endif; ?>
