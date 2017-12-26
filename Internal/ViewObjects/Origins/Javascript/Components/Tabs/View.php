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

$i = 1;

?>
<ul class="nav nav-<?php echo $type; ?>s">
    <?php foreach( $tabs as $key => $val ): ?>
    <li<?php echo $i === 1 ? ' class="active"' : NULL; $i++?>><a data-toggle="<?php echo $type; ?>" href="#<?php echo ZN\Helpers\Converter::slug($key);?>"><?php echo $key;?></a></li>
    <?php endforeach; ?>
</ul>

<?php $i = 1;?>

<div class="tab-content">
    <?php foreach( $tabs as $key => $val ): ?>
    <div id="<?php echo ZN\Helpers\Converter::slug($key);?>" class="tab-pane fade<?php echo $i === 1 ? ' in active' : NULL; $i++?>">
        <?php echo $val ?>
    </div>
    <?php endforeach; ?>
</div>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
