<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Masterpage
{
    use ViewTrait;
}

# Alias Masterpage
class_alias('ZN\Masterpage', 'Project\Controllers\Masterpage');