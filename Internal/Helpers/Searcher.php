<?php namespace ZN\Helpers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use stdClass;
use ZN\Database\DB;

class Searcher
{
    /**
     * Search Settings
     * 
     * @var mixed
     */
    protected $result;
    protected $word;
    protected $type;
    protected $filter = [];

    /**
     * Search Data
     * 
     * @param mixed  $searchData
     * @param mixed  $searchWord
     * @param string $output = 'boolean' - options[string|position|boolean]
     */
    public static function data($searchData, $searchWord, String $output = 'boolean')
    {
        if( ! is_array($searchData) )
        {   
            switch( $output )
            {
                case 'string'  : return strstr($searchData, $searchWord);
                case 'position': return strpos($searchData, $searchWord);
                case 'boolean' : return strpos($searchData, $searchWord) > -1 ? true : false;
                default        : return false;
            }
        }
        else
        {
            $result = array_search($searchWord, $searchData);

            switch( $output )
            {
                case 'string'  : return $result ? $searchWord : false;
                case 'position': return $result ?: -1;
                case 'boolean' : return (bool) $result;
                default        : return false;
            }
        }
    }
    
    /**
     * Data And Filter
     * 
     * @param string $column
     * @param mixed  $value
     * 
     * @return Searcher
     */
    public function filter(String $column, $value)
    {
        $this->_filter($column, $value, 'and');

        return $this;
    }

    /**
     * Data Or Filter
     * 
     * @param string $column
     * @param mixed  $value
     * 
     * @return Searcher
     */
    public function orFilter(String $column, $value)
    {
        $this->_filter($column, $value, 'or');

        return $this;
    }

    /**
     * Defines word
     * 
     * @param string $word
     * 
     * @return Searcher
     */
    public function word(String $word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Search Type
     * 
     * @param string $type - options[auto|inside|equal|starting|ending]
     * 
     * @return Searcher
     */
    public function type(String $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Search Database
     * 
     * @param array  $conditions
     * @param string $word = NULL
     * @param string $type = 'auto' - options[auto|inside|equal|starting|ending]
     * 
     * @return object
     */
    public function database(Array $conditions, String $word = NULL, String $type = 'auto') : stdClass
    {
        if( ! empty($this->type) )
        {
            $type = $this->type ;
        }

        if( ! empty($this->word) )
        {
            $word = $this->word ;
        }

        $word     = addslashes($word);
        $operator = ' like ';
        $str      = $word;
        $db       = new DB;

        if( $type === 'equal')
        {
            $operator = ' = ';
        }
        elseif( $type === 'auto' )
        {
            if( is_numeric($word) )
            {
                $operator = ' = ';
            }
            else
            {
                $str = $db->like($word, 'inside');
            }
        }
        else
        {
            $str = $db->like($word, $type);
        }

        foreach( $conditions as $key => $values )
        {
            $db->distinct();

            foreach( $values as $keys )
            {
                $db->where($keys.$operator, $str, 'or');

                if( ! empty($this->filter) )
                {
                    foreach( $this->filter as $val )
                    {
                        $exval = explode('|', $val);

                        if( $exval[2] === 'and' )
                        {
                            $db->where($exval[0], $exval[1], 'and');
                        }

                        if( $exval[2] === 'or' )
                        {
                            $db->where($exval[0], $exval[1], 'or');
                        }
                    }
                }
            }

            $this->result[$key] = $db->get($key)->result();
        }

        $result = $this->result;

        $this->result = NULL;
        $this->type   = NULL;
        $this->word   = NULL;
        $this->filter = [];

        return (object) $result;
    }

    /**
     * Protected Filter
     */
    protected function _filter($column, $value, $type)
    {
        $this->filter[] = "$column|$value|$type";
    }
}
