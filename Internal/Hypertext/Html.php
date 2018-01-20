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

use ZN\IS;
use ZN\Base;
use ZN\Request;
use ZN\Buffering;
use ZN\Hypertext\Exception\InvalidArgumentException;

class Html
{
    use ViewCommonTrait;

    protected $elements =
    [
        'multiElement' =>
        [
            'html'  , 'body', 'head'  , 'title', 'pre',
            'iframe', 'li'  , 'strong', 'button',

            'bold'      => 'b'  , 'italic'   => 'em' , 'parag'     => 'p',
            'overline'  => 'del', 'overtext' => 'sup', 'underline' => 'u',
            'undertext' => 'sub'
        ],

        'singleElement' =>
        [
            'hr', 'keygen'
        ],

        'mediaContent' =>
        [
            'audio', 'video'
        ],

        'media' =>
        [
            'embed', 'source'
        ],

        'contentAttribute' =>
        [
            'div'   , 'canvas'    , 'command' , 'datalist', 'details',
            'dialog', 'figcaption', 'figure'  , 'mark'    , 'meter'  ,
            'time'  , 'summary'   , 'progress', 'output'  ,
        ],

        'content' =>
        [
            'aside'  , 'article', 'footer',  'header', 'nav',
            'section', 'hgroup'
        ]
    ];

    /**
     * Sets ul attributes [5.0.0]
     * 
     * @param callable $list
     * @param array    $attributes = []
     * 
     * @return string
     */
    public function ul(Callable $list, Array $attributes = []) : String
    {
        return $this->_multiElement(__FUNCTION__, Buffering\Callback::do($list, [new $this]), $attributes);
    }

    /**
     * Creates form input
     * 
     * @return Form
     */
    public function form() : Form
    {
        return new Form;
    }

    /**
     * Creates table
     * 
     * @return Table
     */
    public function table() : Table
    {
        return new Table;
    }

    /**
     * Creates list
     * 
     * @return Lists
     */
    public function list() : Lists
    {
        return new Lists;
    }

    /**
     * Creates image element
     * 
     * @param string $src
     * @param int    $width
     * @param int    $height = NULL
     * @param array  $attributes = []
     * 
     * @return string
     */
    public function image(String $src, Int $width = NULL, Int $height = NULL, Array $attributes = []) : String
    {
        if( ! IS::url($src) )
        {
            $src = Request::getBaseURL($src);
        }

        $attributes['src'] = $src;

        if( ! empty($width) )
        {
            $attributes['width'] = $width;
        }

        if( ! empty($height) )
        {
            $attributes['height'] = $height;
        }

        if( ! isset($attributes['title']) )
        {
            $attributes['title'] = '';
        }

        if( ! isset($attributes['alt']) )
        {
            $attributes['alt'] = '';
        }

        return $this->_singleElement('img', $attributes);
    }

    /**
     * Creates label element
     * 
     * @param string $for
     * @param string $value      = NULL
     * @param string $form       = NULL
     * @param array  $attributes = []
     * 
     * @return string
     */
    public function label(String $for, String $value = NULL, String $form = NULL, Array $attributes = []) : String
    {
        if( ! empty($for) )
        {
            $attributes['for'] = $for;
        }

        if( ! empty($form) )
        {
            $attributes['form'] = $form;
        }

        return $this->_multiElement(__FUNCTION__, $value, $attributes);
    }

    /**
     * Creates anchor
     * 
     * @param string $url
     * @param string $value      = NULL
     * @param array  $attributes = []
     * 
     * @return string
     */
    public function anchor(String $url, String $value = NULL, Array $attributes = []) : String
    {
        if( ! IS::url($url) && strpos($url, '#') !== 0 )
        {
            $url = Request::getSiteURL($url);
        }

        $attributes['href'] = $url;

        return $this->_multiElement('a', $value ?? $url, $attributes);
    }

    /**
     * Creates mail to element
     * 
     * @param string $mail
     * @param string $value      = NULL
     * @param array  $attributes = []
     * 
     * @return string
     */
    public function mailTo(String $mail, String $value = NULL, Array $attributes = []) : String
    {
        if( ! IS::email($mail) )
        {
            throw new InvalidArgumentException('Error', 'emailParameter', '1.($mail)');
        }

        $attributes['href'] = 'mailto:' . $mail;

        return $this->_multiElement('a', $value ?? $mail, $attributes);
    }

    /**
     * Creates font elements
     * 
     * @param string $str
     * @param string $size       = NULL
     * @param string $color      = NULL
     * @param string $face       = NULL
     * @param array  $attributes = []
     * 
     * @return string
     */
    public function font(String $str, String $size = NULL, String $color = NULL, String $face = NULL, Array $attributes = []) : String
    {
        if( ! empty($size) )
        {
            $attributes['size'] = $size;
        }

        if( ! empty($color) )
        {
            $attributes['color'] = $color;
        }

        if( ! empty($face) )
        {
            $attributes['face'] = $face;
        }

        return $this->_multiElement('font', $str, $attributes);
    }

    /**
     * Creates br element
     * 
     * @param int $count = 1
     * 
     * @return string
     */
    public function br(Int $count = 1) : String
    {
        return str_repeat($this->_singleElement(__FUNCTION__), $count);
    }

    /**
     * Creates script element
     * 
     * @param string $path
     * 
     * @return string
     */
    public function script(String $path) : String
    {
        if( ! IS::url($path) )
        {
            $path = Request::getBaseURL(Base::suffix($path, '.js'));
        }

        $attributes['href'] = $path;
        $attributes['type'] = 'text/javascript';

        return $this->_singleElement(__FUNCTION__, $attributes);
    }

    /**
     * Creates link
     * 
     * @param string $path
     * 
     * @return string
     */
    public function link(String $path) : String
    {
        if( ! IS::url($path) )
        {
            $path = Request::getBaseURL(Base::suffix($path, '.css'));
        }

        $attributes['href'] = $path;
        $attributes['rel']  = 'stylesheet';
        $attributes['type'] = 'text/css';

        return $this->_singleElement('link', $attributes);
    }

    /**
     * Creates space
     * 
     * @param int $count = 4
     * 
     * @return string
     */
    public function space(Int $count = 4) : String
    {
        return str_repeat("&nbsp;", $count);
    }

    /**
     * Gets head element
     * 
     * @param string $str
     * @param int    $type       = 3
     * @param array  $attributes = []
     * 
     * @return string
     */
    public function heading(String $str, Int $type = 3, Array $attributes = []) : String
    {
        return $this->_multiElement('h'.$type, $str, $attributes);
    }

    /**
     * Gets multiple element
     * 
     * @param string $element
     * @param string $str        = NULL
     * @param array  $attributes = []
     * 
     * @return string
     */
    public function element(String $element, String $str = NULL, Array $attributes = []) : String
    {
        return $this->_multiElement($element, $str, $attributes);
    }

    /**
     * Gets multiple attributes
     * 
     * @param string $str
     * @param array  $array = []
     * 
     * @return string
     */
    public function multiAttr(String $str, Array $array = []) : String
    {
        $perm  = $this->settings['attr']['perm'] ?? NULL;

        if( is_array($array) )
        {
            $open  = '';
            $close = '';
            $att   = '';
           

            foreach( $array as $k => $v )
            {
                if( ! is_numeric($k) )
                {
                    $element = $k;

                    if( ! is_array($v) )
                    {
                        $att = ' '.$v;
                    }
                    else
                    {
                        $att = $this->attributes($v);
                    }
                }
                else
                {
                    $element = $v;
                }

                $open .= '<'.$element.$att.'>';
                $close = '</'.$element.'>'.$close;
            }
        }
        else
        {
            return $this->_perm($perm, $str);
        }

        return $this->_perm($perm, $open.$str.$close);
    }

    /**
     * Gets meta tag
     * 
     * @param mixed  $name
     * @param string $content = NULL
     * 
     * @return string
     */
    public function meta($name, String $content = NULL) : String
    {
        if( ! is_array($name) )
        {
            return $this->_singleMeta($name, $content);
        }
        else
        {
            $metas = NULL;

            foreach( $name as $key => $val )
            {
                $metas .= $this->_singleMeta($key, $val);
            }

            return $metas;
        }
    }

    /**
     * Protected Content
     */
    protected function _content($html, $type)
    {
        $type = strtolower($type);

        $perm = $this->settings['attr']['perm'] ?? NULL;

        return $this->_perm($perm, "<$type>$html</$type>");
    }

    /**
     * Protected Content Attribute
     */
    protected function _contentAttribute($content, $_attributes, $type)
    {
        if( ! is_scalar($content) )
        {
            $content = '';
        }

        $type   = strtolower($type);

        $perm   = $this->settings['attr']['perm'] ?? NULL;
        
        $return = '<'.$type.$this->attributes($_attributes).'>'.$content."</$type>".EOL;

        return $this->_perm($perm, $return);
    }

    /**
     * Protected Media
     */
    protected function _media($src, $_attributes, $type)
    {
        $perm = $this->settings['attr']['perm'] ?? NULL;

        return $this->_perm($perm, '<'.strtolower($type).'src="'.$src.'"'.$this->attributes($_attributes).'>'.EOL);
    }

    /**
     * Protected Media Content
     */
    protected function _mediaContent($src, $content, $_attributes, $type)
    {
        $type = strtolower($type);

        $perm = $this->settings['attr']['perm'] ?? NULL;

        return $this->_perm($perm, '<'.$type.'src="'.$src.'"'.$this->attributes($_attributes).'>'.$content."</$type>".EOL);
    }

    /**
     * Protected Element
     */
    protected function _multiElement($element, $str, $attributes = [])
    {
        $element = strtolower($element);

        $perm    = $this->settings['attr']['perm'] ?? NULL;

        return $this->_perm($perm, '<'.$element.$this->attributes($attributes).'>'.$str.'</'.$element.'>');
    }

    /**
     * Protected Single Element
     */
    protected function _singleElement($element, $attributes = [])
    {
        $perm = $this->settings['attr']['perm'] ?? NULL;

        return $this->_perm($perm, '<'.strtolower($element).$this->attributes($attributes).'>');
    }

    /**
     * Protected Single Meta
     */
    protected function _singleMeta($name, $content)
    {
        if( stripos($name, 'http:') === 0 )
        {
            $name = ' http-equiv="'.str_ireplace('http:', NULL, $name).'"';
        }
        elseif( stripos($name, 'property:') === 0 )
        {
            $name = ' property="'.str_ireplace('property:', NULL, $name).'"';
        }
        else
        {
            $name = ' name="'.str_ireplace('name:', NULL, $name).'"';
        }

        if( ! empty($content) )
        {
            $content = ' content="'.$content.'"';
        }
        else
        {
            $content = '';
        }

        return '<meta'.$name.$content.' />'."\n";
    }
}
