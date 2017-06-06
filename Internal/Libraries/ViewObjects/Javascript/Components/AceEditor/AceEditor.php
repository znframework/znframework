<?php namespace ZN\ViewObjects\Javascript\Components;

use Arrays;

class AceEditor extends ComponentsExtends implements AceEditorInterface
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
    // @param string   $id   = 'editor'
    // @param callable $editors
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'editor', Callable $editors) : String
    {
        $editors($this);

        $attr['id']                 = $id;
        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? Arrays::removeKey($this->revolvings,
        [
            'autoloadExtensions', 'extensions', 'attributes', 'properties'
        ]);

        $this->defaultVariable();

        return $this->load('AceEditor/View', $attr);
    }
}
