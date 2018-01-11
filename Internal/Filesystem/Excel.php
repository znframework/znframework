<?php namespace ZN\Filesystem;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Controllers\FactoryController;

class Excel extends FactoryController
{
    const factory =
    [
        'methods' =>
        [
            'arraytoxls' => 'Excel\ArrayToXLS::do',
            'csvtoarray' => 'Excel\CSVToArray::do',
        ]
    ];
}
