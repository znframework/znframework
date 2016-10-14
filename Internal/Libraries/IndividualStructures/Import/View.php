<?php namespace ZN\IndividualStructures\Import;

use ZN\ViewObjects\TemplateWizard;
use ZN\IndividualStructures\Import\Exception\FileNotFoundException;

class View implements ViewInterface
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
    // Template Wizard Extension
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $templateWizardExtension = '.wizard';

    //--------------------------------------------------------------------------------------------------------
    // page()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $obGetContents
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(String $page, Array $data = NULL, Bool $obGetContents = false, String $randomPageDir = VIEWS_DIR)
    {
        if( ! empty(Properties::$parameters['usable']) )
        {
            $obGetContents = Properties::$parameters['usable'];
        }

        if( ! empty(Properties::$parameters['data']) )
        {
            $data = Properties::$parameters['data'];
        }

        Properties::$parameters = [];

        if( stristr($page, $this->templateWizardExtension) )
        {
            return $this->_templateWizard($page, $data, $obGetContents, $randomPageDir);
        }

        return $this->_page($page, $data, $obGetContents, $randomPageDir);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Page
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $obGetContents
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _page($randomPageVariable, $randomDataVariable, $randomObGetContentsVariable = false, $randomPageDir = VIEWS_DIR)
    {
        if( ! extension($randomPageVariable) || stristr($randomPageVariable, $this->templateWizardExtension) )
        {
            $randomPageVariable = suffix($randomPageVariable, '.php');
        }

        $randomPagePath = $randomPageDir.$randomPageVariable;

        if( is_file($randomPagePath) )
        {
            if( is_array($randomDataVariable) )
            {
                extract($randomDataVariable, EXTR_OVERWRITE, 'zn');
            }

            if( $randomObGetContentsVariable === false )
            {
                return require($randomPagePath);
            }
            else
            {
                ob_start();
                require($randomPagePath);
                $randomViewFileContent = ob_get_contents();
                ob_end_clean();

                return $randomViewFileContent;
            }
        }
        else
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $randomPageVariable);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Template Wizard
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $obGetContents
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _templateWizard($page, $data, $obGetContents, $randomPageDir = PAGES_DIR)
    {
        $return = TemplateWizard::data($this->_page($page, $data, true, $randomPageDir), (array) $data);

        if( $obGetContents === true )
        {
            return $return;
        }

        echo $return;
    }
}
