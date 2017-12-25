<?php namespace ZN\ViewObjects;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class TemplateWizardUnitTest extends \UnitTestController
{
    const unit =
    [
        'class'   => 'TemplateWizard',
        'methods' => 
        [
            'isolation'         => ['Example Data'],
            'data'              => ['{{$data}}', ['data' => 10]]
        ]
    ];
}
