<?php namespace ZN\Components;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Inclusion;
use ZN\DataTypes\Arrays;
use ZN\DataTypes\Strings;
use ZN\RevolvingAbility;

class ComponentsExtends
{
    use RevolvingAbility;

    /**
     * @var string
     */
    protected $directory = __DIR__ . '/';

    /**
     * @var string
     */
    protected $button = NULL;

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->commponent = ltrim(rtrim(get_called_class(), '\Build'), __NAMESPACE__);
    }

    /**
     * Creates Button
     * 
     * @param string $name
     * @param string $value
     * @param array  $attr = []
     * 
     * @return self
     */
    public function button(String $name, String $value, Array $attr = [])
    {
        $this->button =
        [
            'name'       => $name,
            'value'      => $value,
            'attributes' => $attr,
            'class'      => $this->class ?? 'btn-info'
        ];

        $this->class  = NULL;

        return $this;
    }

    /**
     * Protected Load
     */
    protected function load($path, $attr) : String
    {
        return Inclusion\View::use($path, $attr, true, $this->directory);
    }

    /**
     * Protected Prop
     */
    protected function prop($attr, $view = NULL)
    {
        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? Arrays\RemoveElement::key((array) $this->revolvings, array_keys($attr));

        $this->defaultVariable();

        return $this->load(($view ?? $this->commponent) . '/View', $attr);
    }
}
