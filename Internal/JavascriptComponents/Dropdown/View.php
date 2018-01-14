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

/*
|--------------------------------------------------------------------------
| Autoloader Extension
|--------------------------------------------------------------------------
|
| @extension jquery
| @extension bootstrap
|
*/

$extensions = JC::extensions($extensions, ['jquery', 'bootstrap'], $autoloadExtensions);

/*
|--------------------------------------------------------------------------
| Available Extensions
|--------------------------------------------------------------------------
|
| Import styles
|
*/

if( ! empty($extensions) )
{
    Import::style(...$extensions);
}

/*
|--------------------------------------------------------------------------
| Dropdown
|--------------------------------------------------------------------------
|
| Dropdown Structure
|
*/

?>
<div class="drop<?php echo $type ?? 'down'; ?>">
    <button<?php echo Html::attributes($attributes); ?> class="btn <?php echo $class ?> dropdown-toggle" type="button" data-toggle="dropdown">
        <?php echo $value; ?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
    <?php
    foreach( $li as $l )
    {
        echo $l . EOL;
    }
    ?>
    </ul>
</div>
<?php

/*
|--------------------------------------------------------------------------
| Available Extensions
|--------------------------------------------------------------------------
|
| Import scripts
|
*/

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>
