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

preg_match('/limit\s+([0-9]+)(\s*\OFFSET\s*([0-9]+))*/xi', $get->stringQuery(), $match);

$start = $match[3];

if( $type === 'ajax' )
{
    $start = Method::post('start');
}

$limit = $match[1] ?? Config::get('ViewObjects', 'pagination')['limit'];

$index = md5($index);

//--------------------------------------------------------------------------------------------------------
// Creating Pagination
//--------------------------------------------------------------------------------------------------------
//
// @output string
//
//--------------------------------------------------------------------------------------------------------
?>
<ul<?php echo Html::attributes($attributes); ?> class="pagination">
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
                $anchor = URL::site(Pagination::getURI($s));
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

//--------------------------------------------------------------------------------------------------------
// JC Ajax Pagination Function
//--------------------------------------------------------------------------------------------------------
//
// @param string start
//
//--------------------------------------------------------------------------------------------------------
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
