<?php namespace ZN\Inclusion;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\In;
use ZN\Base;
use ZN\Wizard;
use ZN\Buffering;
use ZN\Inclusion\Project\Theme;
use ZN\Inclusion\Project\View as Views;

class View
{
    /**
     * Template Wizard Extension
     * 
     * @var string
     */
    protected static $templateWizardExtension = '.wizard';

    /**
     * Get view
     * 
     * @param string $page
     * @param array  $data          = NULL
     * @param bool   $obGetContents = false
     * @param string $randomPageDir = VIEWS_DIR
     * 
     * @return mixed
     */
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

        if( is_file($randomPageDir . Base::suffix($page, '.php')) && ! strstr($page, self::$templateWizardExtension) )
        {
            return self::_page($page, $data, $obGetContents, $randomPageDir);
        }

        return self::_templateWizard(Base::suffix(rtrim($page, '.php'), self::$templateWizardExtension), $data, $obGetContents, $randomPageDir);
    }

    /**
     * Get view
     * 
     * @param string $page
     * @param array  $data          = NULL
     * @param bool   $obGetContents = false
     * @param string $randomPageDir = VIEWS_DIR
     * 
     * @return mixed
     */
    protected static function _page($randomPageVariable, $randomDataVariable, $randomObGetContentsVariable = false, $randomPageDir = VIEWS_DIR, $randomIsWizard = NULL)
    {
        if( ! pathinfo($randomPageVariable, PATHINFO_EXTENSION) || stristr($randomPageVariable, self::$templateWizardExtension) )
        {
            $randomPageVariable = Base::suffix($randomPageVariable, '.php');
        }

        $randomPagePath = $randomPageDir . $randomPageVariable;
        
        if( ($active = Theme::$active) !== NULL )
        {
            $activeRandomPagePath = $randomPageDir . $active . $randomPageVariable;

            if( is_file($activeRandomPagePath) )
            {
                $randomPagePath = $activeRandomPagePath;
            }
        }  

        if( $randomIsWizard === true )
        {
            Wizard::isolation($randomPagePath);
        }
        
        if( is_file($randomPagePath) )
        {
            $return = Buffering::file($randomPagePath, $randomDataVariable);
            
            if( $active !== NULL )
            {
                Theme::integration($active, $return);
            }

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

    /**
     * Get view
     * 
     * @param string $page
     * @param array  $data          = NULL
     * @param bool   $obGetContents = false
     * @param string $randomPageDir = PAGES_DIR
     * 
     * @return void|mixed
     */
    protected static function _templateWizard($page, $data, $obGetContents, $randomPageDir = PAGES_DIR)
    {
        $return = Wizard::data(self::_page($page, $data, true, $randomPageDir, true), (array) $data);

        if( $obGetContents === true )
        {
            return $return;
        }

        echo $return;
    }
}
