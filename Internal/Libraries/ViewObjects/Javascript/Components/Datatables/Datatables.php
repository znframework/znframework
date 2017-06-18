<?php namespace ZN\ViewObjects\Javascript\Components;

use Arrays;

class Datatables extends ComponentsExtends implements DatatablesInterface
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
    // @param mixed    $result
    // @param callable $datatable = NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function generate($result, Callable $datatable = NULL) : String
    {
        if( $datatable !== NULL )
        {
            $datatable($this);
        }

        $attr['result']  = $result;
        $attr['width']   = $this->width   ?? '100%';
        $attr['id']      = $this->id      ?? 'datatable';
        $attr['class']   = $this->class   ?? 'table-striped table-bordered table-hover';
        $attr['process'] = $this->process ?? NULL;
        $attr['length']  = $this->length  ?? 100;

        $attr['autoloadExtensions'] = $this->autoloadExtensions ?? false;
        $attr['extensions']         = $this->extensions         ?? [];
        $attr['attributes']         = $this->attributes         ?? [];
        $attr['properties']         = $this->properties         ?? $this->prop($attr);

        $this->defaultVariable();

        return $this->load('Datatables/View', $attr);
    }
}
