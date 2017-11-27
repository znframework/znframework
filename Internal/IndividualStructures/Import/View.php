<?php namespace ZN\IndividualStructures\Import;

use ZN\In;
use View as Views, Arrays;
use ZN\ViewObjects\TemplateWizard;
use ZN\FileSystem\File;
use ZN\IndividualStructures\Buffer;

class View
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
    protected static $templateWizardExtension = '.wizard';

    //--------------------------------------------------------------------------------------------------------
    // page()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $obGetContents
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(String $page, Array $data = NULL, Bool $obGetContents = false, String $randomPageDir = VIEWS_DIR)
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

        if( ! empty($viewData = In::$view ) )
        {
            $inData = array_merge(...$viewData);
        }
        else
        {
            $inData = [];
        }

        $data = array_merge((array) $data, $inData, Views::$data);

        if( is_file($randomPageDir . suffix($page, '.php')) && ! strstr($page, self::$templateWizardExtension) )
        {
            return self::_page($page, $data, $obGetContents, $randomPageDir);
        }

        return self::_templateWizard(suffix(rtrim($page, '.php'), self::$templateWizardExtension), $data, $obGetContents, $randomPageDir);
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
    protected static function _page($randomPageVariable, $randomDataVariable, $randomObGetContentsVariable = false, $randomPageDir = VIEWS_DIR, $randomIsWizard = NULL)
    {
        if( ! File\Extension::get($randomPageVariable) || stristr($randomPageVariable, self::$templateWizardExtension) )
        {
            $randomPageVariable = suffix($randomPageVariable, '.php');
        }

        $randomPagePath = $randomPageDir.$randomPageVariable;

        if( $randomIsWizard === true )
        {
            TemplateWizard::isolation($randomPagePath);
        }

        if( is_file($randomPagePath) )
        {
            $return = Buffer\File::do($randomPagePath, $randomDataVariable);

            if( $randomObGetContentsVariable === false )
            {
                echo $return; return;
            }
            else
            {
                return $return;
            }
        }
        else
        {
            return false;
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
    protected static function _templateWizard($page, $data, $obGetContents, $randomPageDir = PAGES_DIR)
    {
        $return = TemplateWizard::data(self::_page($page, $data, true, $randomPageDir, true), (array) $data);

        if( $obGetContents === true )
        {
            return $return;
        }

        echo $return;
    }
}
