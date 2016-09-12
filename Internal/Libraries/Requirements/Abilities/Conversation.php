<?php namespace ZN\Requirements\Abilities;

use Classes;

trait Conversation
{
    //--------------------------------------------------------------------------------------------------------
    // Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $lang = [];

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
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
            foreach( $languages as $language )
            {
                $this->_singleLang($language, 'multiple');
            }
        }

        $constName = strtoupper(Classes::onlyName(get_called_class())).'_LANG';

        Illustrate($constName, $this->lang);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Single Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _singleLang($languages, $type = NULL)
    {
        $langEx = $this->_langEx($languages);

        if( $type === 'multiple' )
        {
            $this->lang = array_merge((array) $this->lang, (array) lang($langEx->name));
        }
        else
        {
            $this->lang = lang($langEx->name);
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
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Config Ex
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _langEx($lang)
    {
        $configEx = explode(':', $lang);
        $name     = $configEx[0] ?? NULL;
        $key      = $configEx[1] ?? NULL;

        return (object)
        [
            'name' => $name,
            'key'  => $key
        ];
    }
}

class_alias('ZN\Requirements\Abilities\Conversation', 'ConversationAbility');
