<?php namespace ZN\ViewObjects\Javascript\Components;

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
    // @param string $id   = 'editor'
    // @param array  $attr = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate(String $id = 'editor', Array $attr = NULL) : String
    {
        $attr['id'] = $id;

        return $this->load('AceEditor/View', $attr);
    }
}
