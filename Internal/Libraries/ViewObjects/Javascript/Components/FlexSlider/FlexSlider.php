<?php namespace ZN\ViewObjects\Javascript\Components;

use Arrays;

class FlexSlider extends ComponentsExtends implements FlexSliderInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Generate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string   $id   = 'datepicker'
    // @param callable $flexsliders
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'flexslider', Callable $flexsliders) : String
    {
        $flexsliders($this);

        $attr['id']     = $id;
        $attr['path']   = $this->path ? suffix($this->path) : NULL;
        $attr['images'] = $this->images ?? NULL;

        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? Arrays::removeKey($this->revolvings,
        [
            'autoloadExtensions', 'extensions', 'attributes', 'properties', 'path', 'images'
        ]);

        $this->defaultVariable();

        return $this->load('FlexSlider/View', $attr);
    }
}
