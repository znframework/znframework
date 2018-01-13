<?php namespace ZN\Hypertext;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Singleton;

class Sheet
{
    /**
     * selector
     * 
     * @var string
     */
    protected $selector = 'this';
    
    /**
     * attr
     * 
     * @var array
     */
    protected $attr;

    /**
     * easing
     * 
     * @var string
     */
    protected $easing;

    /**
     * transitions
     * 
     * @var string
     */
    protected $transitions = '';

    /**
     * tag
     * 
     * @var bool
     */
    protected $tag = false;

    /**
     * Current browser list.
     * 
     * @var array
     */
    protected $browserList = ['', '-o-', '-ms-', '-moz-', '-webkit-'];

    /**
     * Magic construct
     * 
     * @param bool $tag = false
     * 
     * @return void
     */
    public function __construct($tag = false)
    {
        $this->browsers = $this->browserList;

        $this->tag = $tag;
    }

    /**
     * Sets attributes.
     * 
     * @param array $attributes
     * 
     * @return $this
     */
    public function attr(Array $attributes)
    {
        $this->attr = $this->_attr($attributes);

        return $this;
    }

    /**
     * Sets selector.
     * 
     * @param string $selector
     * 
     * @return $this
     */
    public function selector(String $selector)
    {
        $this->selector = $selector;

        return $this;
    }

    /**
     * Get complete.
     * 
     * @param void
     * 
     * @return string
     */
    public function complete() : String
    {
        $trans = $this->transitions;
        $this->_defaultVariable();

        return $trans;
    }

    /**
     * Creates element.
     * 
     * @param string ...$args
     * 
     * @return string
     */
    public function create(...$args) : String
    {
        $combineTransitions = $args;

        $str  = $this->selector."{";
        if( ! empty($this->attr) ) $str .= EOL.$this->attr.EOL;
        $str .= $this->complete();

        if( ! empty($combineTransitions) ) foreach( $combineTransitions as $transition )
        {
            $str .= $transition;
        }

        $str .= "}".EOL;

        return $this->_tag($str);
    }

    /**
     * protected tag
     * 
     * @param string $code
     * 
     * @return string
     */
    protected function _tag($code)
    {
        if( $this->tag === true )
        {
            $style = Singleton::class('ZN\Hypertext\Style');

            return $style->open().$code.$style->close();
        }

        return $code;
    }

    /**
     * protected attr
     * 
     * @param array $attributes = []
     * 
     * @return string
     */
    protected function _attr($attributes = [])
    {
        $attribute = '';

        if( is_array($attributes) )
        {
            foreach( $attributes as $key => $values )
            {
                if( is_numeric($key) )
                {
                    $key = $values;
                }

                $attribute .= ' '.$key.':'.$values.';';
            }
        }

        return $attribute;
    }

    /**
     * protected transitions
     * 
     * @param string $data
     * 
     * @return string
     */
    protected function _transitions($data)
    {
        $transitions = "";

        foreach( $this->browsers as $val )
        {
            $transitions .= "$val$data";
        }

        return EOL.$transitions;
    }

    /**
     * protected default variable
     * 
     * @param void
     * 
     * @return void
     */
    protected function _defaultVariable()
    {
        $this->attr        = NULL;
        $this->transitions = '';
        $this->selector    = 'this';
    }
}
