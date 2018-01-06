<?php 
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Lang;

trait ConversationAbility
{
    /**
     * protected lang
     * 
     * @var array
     */
    protected $lang = [];

    /**
     * Provides access to language data with constant.
     * 
     * @param void
     * 
     * @return void
     */
    public function conversation()
    {
        if( ! defined('static::lang') )
        {
            return false;
        }

        $languages = static::lang;

        if( ! is_array($languages) )
        {
            $this->_singleLang($languages);
        }
        else
        {
            $constName = $languages[0];

            foreach( $languages as $language )
            {
                $this->_singleLang($language, 'multiple');
            }
        }
    }

    /**
     * protected
     * 
     * @param mixed $languages
     * @param mixed $type = NULL
     * 
     * @return void
     */
    protected function _singleLang($languages, $type = NULL)
    {
        $langEx = $this->_langEx($languages);
        $const  = $langEx->const;

        if( $type === 'multiple' )
        {
            $this->lang = array_merge((array) $this->lang, (array) Lang::select($langEx->name));
        }
        else
        {
            $this->lang = Lang::select($langEx->name);
        }

        if( $langEx->key !== NULL )
        {
            $lang = $this->lang;

            foreach( $lang as $key => $val )
            {
                $newKey = str_ireplace($langEx->key.':', NULL, $key);

                $this->lang[$newKey] = $val;
            }
        }

        Illustrate($const, $this->lang);
    }

    /**
     * protected
     * 
     * @param mixed $lang
     * 
     * @return object
     */
    protected function _langEx($lang)
    {
        $configEx = explode(':', $lang);
        $name     = $configEx[0] ?? NULL;
        $key      = $configEx[1] ?? NULL;
        $constFix = '_LANG';

        if( $key !== NULL )
        {
            $const = $name.'_'.$key.$constFix;
        }
        else
        {
            $const = $name.$constFix;
        }

        return (object)
        [
            'name'  => $name,
            'key'   => $key,
            'const' => strtoupper($const)
        ];
    }
}
