<?php namespace ZN\ViewObjects;

use Coalesce;
use ZN\Services\URL;
use ZN\ViewObjects\Exception\InvalidArgumentException;
use ZN\IndividualStructures\Buffer;
use ZN\IndividualStructures\IS;

class HTML
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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

    //--------------------------------------------------------------------------------------------------------
    // Common
    //--------------------------------------------------------------------------------------------------------
    //
    // attributes()
    // _input()
    //
    //--------------------------------------------------------------------------------------------------------
    use ViewCommonTrait;

    //--------------------------------------------------------------------------------------------------------
    // ul -> 5.0.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $list
    // @param array    $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function ul(Callable $list, Array $attributes = []) : String
    {
        return $this->_multiElement(__FUNCTION__, Buffer\Callback::do($list, [new $this]), $attributes);
    }

    //--------------------------------------------------------------------------------------------------------
    // Form
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function form() : Form
    {
        return new Form;
    }

    //--------------------------------------------------------------------------------------------------------
    // Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function table() : HTML\Helpers\Table
    {
        return new HTML\Helpers\Table;
    }

    //--------------------------------------------------------------------------------------------------------
    // List
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function list() : HTML\Helpers\Lists
    {
        return new HTML\Helpers\Lists;
    }

    //--------------------------------------------------------------------------------------------------------
    // Image
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param int    $width
    // @param int    $height
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function image(String $src, Int $width = NULL, Int $height = NULL, Array $attributes = []) : String
    {
        if( ! IS::url($src) )
        {
            $src = URL::base($src);
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

    //--------------------------------------------------------------------------------------------------------
    // Label
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $for
    // @param  string $value
    // @param  string $form
    // @param  array  $attributes
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Anchor
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function anchor(String $url, String $value = NULL, Array $attributes = []) : String
    {
        if( ! IS::url($url) && strpos($url, '#') !== 0 )
        {
            $url = URL::site($url);
        }

        $attributes['href'] = $url;

        Coalesce::null($value, $url);

        return $this->_multiElement('a', $value, $attributes);
    }

    //--------------------------------------------------------------------------------------------------------
    // Mail To
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $mail
    // @param string $value
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function mailTo(String $mail, String $value = NULL, Array $attributes = []) : String
    {
        if( ! IS::email($mail) )
        {
            throw new InvalidArgumentException('Error', 'emailParameter', '1.($mail)');
        }

        $attributes['href'] = 'mailto:'.$mail;

        Coalesce::null($value, $mail);

        return $this->_multiElement('a', $value, $attributes);
    }

    //--------------------------------------------------------------------------------------------------------
    // Font
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param string $size
    // @param string $color
    // @param string $face
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // BR
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $cunt
    //
    //--------------------------------------------------------------------------------------------------------
    public function br(Int $count = 1) : String
    {
        return str_repeat($this->_singleElement(__FUNCTION__), $count);
    }

    //--------------------------------------------------------------------------------------------------------
    // Script -> 5.0.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    //
    //--------------------------------------------------------------------------------------------------------
    public function script(String $path) : String
    {
        if( ! IS::url($path) )
        {
            $path = URL::base(suffix($path, '.js'));
        }

        $attributes['href'] = $path;
        $attributes['type'] = 'text/javascript';

        return $this->_singleElement(__FUNCTION__, $attributes);
    }

    //--------------------------------------------------------------------------------------------------------
    // Link -> 5.0.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    //
    //--------------------------------------------------------------------------------------------------------
    public function link(String $path) : String
    {
        if( ! IS::url($path) )
        {
            $path = URL::base(suffix($path, '.css'));
        }

        $attributes['href'] = $path;
        $attributes['rel']  = 'stylesheet';
        $attributes['type'] = 'text/css';

        return $this->_singleElement('link', $attributes);
    }

    //--------------------------------------------------------------------------------------------------------
    // Space
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function space(Int $count = 4) : String
    {
        return str_repeat("&nbsp;", $count);
    }

    //--------------------------------------------------------------------------------------------------------
    // Heading
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $str
    // @param int    $type
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function heading(String $str, Int $type = 3, Array $attributes = []) : String
    {
        return $this->_multiElement('h'.$type, $str, $attributes);
    }

    //--------------------------------------------------------------------------------------------------------
    // Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $element
    // @param string $str
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function element(String $element, String $str = NULL, Array $attributes = []) : String
    {
        return $this->_multiElement($element, $str, $attributes);
    }

    //--------------------------------------------------------------------------------------------------------
    // Multi Attr
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $element
    // @param array  $array
    //
    //--------------------------------------------------------------------------------------------------------
    public function multiAttr(String $str, Array $array = []) : String
    {
        if( is_array($array) )
        {
            $open = '';
            $close = '';
            $att = '';

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
            return $str;
        }

        return $open.$str.$close;
    }

    //--------------------------------------------------------------------------------------------------------
    // Meta
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $name
    // @param string $content
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Content
    //--------------------------------------------------------------------------------------------------------
    protected function _content($html, $type)
    {
        $type = strtolower($type);

        $str = "<$type>$html</$type>";

        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Content Attribute
    //--------------------------------------------------------------------------------------------------------
    protected function _contentAttribute($content, $_attributes, $type)
    {
        if( ! is_scalar($content) )
        {
            $content = '';
        }

        $type = strtolower($type);

        return '<'.$type.$this->attributes($_attributes).'>'.$content."</$type>".EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Media
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $src
    // @param array  $attributes
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _media($src, $_attributes, $type)
    {
        return '<'.strtolower($type).'src="'.$src.'"'.$this->attributes($_attributes).'>'.EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Media Content
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $src
    // @param string $content
    // @param array  $attributes
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _mediaContent($src, $content, $_attributes, $type)
    {
        $type = strtolower($type);

        return '<'.$type.'src="'.$src.'"'.$this->attributes($_attributes).'>'.$content."</$type>".EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $element
    // @param string $str
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _multiElement($element, $str, $attributes = [])
    {
        $element = strtolower($element);

        return '<'.$element.$this->attributes($attributes).'>'.$str.'</'.$element.'>';
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Single Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $element
    // @param array  $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _singleElement($element, $attributes = [])
    {
        return '<'.strtolower($element).$this->attributes($attributes).'>';
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Single Meta
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $name
    // @param string $content
    //
    //--------------------------------------------------------------------------------------------------------
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
