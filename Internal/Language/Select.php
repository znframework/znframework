<?php namespace ZN\Language;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 * @since   2011
 */

use ZN\Filesystem;

class Select extends MLExtends
{
    /**
     * Get select lang.
     * 
     * @var string
     */
    protected $select = NULL;

    /**
     * Select word.
     * 
     * @param string $key     = NULL
     * @param mixed  $convert = NULL
     */
    public function do(String $key = NULL, $convert = NULL)
    {
        if( $this->select === NULL )
        {
            if( is_file($this->lang) )
            {
                $read   = file_get_contents($this->lang);
            }

            if( is_file($this->externalLang) )
            {
                $eread  = file_get_contents($this->externalLang);
            }

            $read          = json_decode($read  ?? '', true);
            $eread         = json_decode($eread ?? '', true);
            $this->select  = array_merge((array) $eread, (array) $read);
        }
        
        if( $key === NULL )
        {
            return $this->select;
        }

        if( isset($this->select[$key]) )
        {
            if( is_array($convert) )
            {
                $return = str_replace(array_keys($convert), array_values($convert), $this->select[$key]);
            }
            else
            {
                $return = str_replace('%', $convert, $this->select[$key]);
            }
        }
        else
        {
            $return = $key;
        }

        return $return;
    }

    /**
     * Select all languages
     * 
     * @param mixed $app = NULL
     * 
     * @return array
     */
    public function all($app = NULL) : Array
    {
        if( ! is_string($app) )
        {
            if( $app === NULL )
            {
                $MLFiles = Filesystem::getFiles($this->appdir, 'ml');
            }
            elseif( is_array($app) )
            {
                $MLFiles = $app;
            }
            else
            {
                return false;
            }

            $allMLFiles = [];

            if( ! empty($MLFiles) ) foreach( $MLFiles as $file )
            {
                $removeExtension = str_replace($this->extension, '', $file);
                $allMLFiles[$removeExtension] = $this->all($removeExtension);
            }

            return $allMLFiles;
        }
        else
        {
            $createFile = $this->_langFile($app);

            $read = file_get_contents($createFile);

            return json_decode($read, true);
        }
    }
}
