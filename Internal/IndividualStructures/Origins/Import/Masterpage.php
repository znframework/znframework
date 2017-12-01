<?php namespace ZN\IndividualStructures\Import;

use Config, HTML;
use ZN\Services\URL;
use ZN\DataTypes\Arrays;

class Masterpage
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
    // headData()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string $headData
    //
    //--------------------------------------------------------------------------------------------------------
    public function headData(Array $headData) : Masterpage
    {
        Properties::$parameters['headData'] = $headData;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // body()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string $body
    //
    //--------------------------------------------------------------------------------------------------------
    public function body(String $body) : Masterpage
    {
        Config::set('Masterpage', 'bodyPage', $body);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // head()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var mixed $head
    //
    //--------------------------------------------------------------------------------------------------------
    public function head($head) : Masterpage
    {
        Config::set('Masterpage', 'headPage', $head);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // title()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string $title
    //
    //--------------------------------------------------------------------------------------------------------
    public function title(String $title) : Masterpage
    {
        Config::set('Masterpage', 'title', $title);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // meta()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array $meta
    //
    //--------------------------------------------------------------------------------------------------------
    public function meta(Array $meta) : Masterpage
    {
        Config::set('Masterpage', 'meta', $meta);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // attributes()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array $attributes
    //
    //--------------------------------------------------------------------------------------------------------
    public function attributes(Array $attributes) : Masterpage
    {
        Config::set('Masterpage', 'attributes', $attributes);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // content()
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array $content
    //
    //--------------------------------------------------------------------------------------------------------
    public function content(Array $content) : Masterpage
    {
        Config::set('Masterpage', 'content', $content);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // bodyContent() -> 4.6.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string $content
    //
    //--------------------------------------------------------------------------------------------------------
    public function bodyContent(String $content) : Masterpage
    {
        Properties::$parameters['bodyContent'] = $content;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // masterpage()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $randomDataVariable
    // @param array $head
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(Array $randomDataVariable = NULL, Array $head = NULL)
    {
        if( ! empty(Properties::$parameters['headData']) ) $head               = Properties::$parameters['headData'];
        if( ! empty(Properties::$parameters['data'])     ) $randomDataVariable = Properties::$parameters['data'];

        $bodyContent = Properties::$parameters['bodyContent'] ?? NULL;

        Properties::$parameters = [];

        $masterPageSet  = Config::get('Masterpage');
        $doctypes       = array_merge(Config::expressions('doctypes'), Properties::$doctype);
        $docType        = $head['docType'] ?? $masterPageSet["docType"];
        $header         = ($doctypes[$docType] ?? '<!DOCTYPE html>') . EOL;
        $htmlAttributes = Html::attributes($head['attributes']['html'] ?? $masterPageSet['attributes']['html']);

        $header .= '<html xmlns="http://www.w3.org/1999/xhtml"'.$htmlAttributes.'>'.EOL;
        $header .= '<head'.Html::attributes($head['attributes']['head'] ?? $masterPageSet['attributes']['head']).'>'.EOL;
        $header .= $this->_contentCharset($head['content']['charset'] ?? $masterPageSet['content']['charset']);
        $header .= $this->_contentLanguage($head['content']['language'] ?? $masterPageSet['content']['language']);
        $header .= $this->_title($head['title'] ?? $masterPageSet["title"]);
        $header .= $this->_meta($masterPageSet['meta'], $head['meta'] ?? NULL);
        $header .= $this->_links($masterPageSet, $head, 'font');
        $header .= $this->_links($masterPageSet, $head, 'style');
        $header .= $this->_links($masterPageSet, $head, 'script');
        $header .= $this->_browserIcon($head['browserIcon'] ?? $masterPageSet["browserIcon"]);
        $header .= $this->_theme($masterPageSet, $head);
        $header .= $this->_theme($masterPageSet, $head, 'plugin');
        $header .= $this->_data($masterPageSet['data'], $head['data'] ?? NULL);
        $header .= $this->_setpage($head['headPage'] ?? $masterPageSet['headPage']);
        $header .= '</head>'.EOL;
        $header .= '<body'.Html::attributes($head['attributes']['body'] ?? $masterPageSet['attributes']['body']).
                   $this->_bgImage($head['backgroundImage'] ?? $masterPageSet["backgroundImage"]).'>'.EOL;

        echo $header;

        $randomPageVariable = $head['bodyPage'] ?? $masterPageSet['bodyPage'];

        if( ! empty($randomPageVariable) )
        {
            $randomDataVariable['view'] = $bodyContent;

            View::use($randomPageVariable, $randomDataVariable);
        }
        else
        {
            echo $bodyContent;
        }

        $randomFooterVariable  = EOL.'</body>'.EOL;
        $randomFooterVariable .= '</html>';

        echo $randomFooterVariable;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Content Charset
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _contentCharset($contentCharset)
    {
        $header = NULL;

        if( is_array($contentCharset) )
        {
            foreach( $contentCharset as $v )
            {
                $header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$v\">".EOL;
            }
        }
        else
        {
            $header .= '<meta http-equiv="Content-Type" content="text/html; charset='.$contentCharset.'">'.EOL;
        }

        return $header;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Content Language
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _contentLanguage($contentLanguage)
    {
        return '<meta http-equiv="Content-Language" content="'.$contentLanguage .'">'.EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Bg Image
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _bgImage($backgroundImage)
    {
        $bgImage = ( ! empty($backgroundImage) && is_file($backgroundImage) )
                 ? ' background="'.URL::base($backgroundImage).'" bgproperties="fixed"'
                 : '';
                 
        return $bgImage;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Browser Icon
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _browserIcon($browserIcon)
    {
        if( ! empty($browserIcon) && is_file($browserIcon) )
        {
           return '<link rel="shortcut icon" href="'.URL::base($browserIcon).'" />'.EOL;
        }

        return NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Title
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _title($title)
    {      
        if( ! empty($title) )
        {
            return '<title>'.$title.'</title>'.EOL;
        }

        return NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Meta
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _meta($metas, $headMeta)
    {
        if( $headMeta !== NULL )
        {
            $metas = array_merge($metas, $headMeta);
        }

        $header = NULL;

        if( ! empty($metas) ) foreach( $metas as $name => $content )
        {
            if( isset($headMeta[$name]) )
            {
                $content = $headMeta[$name];
            }

            if( ! empty($content) )
            {
                $nameEx     = explode(":", $name);
                $httpOrName = ( $nameEx[0] === 'http' ) ? 'http-equiv' : ( isset($nameEx[1]) ? $nameEx[0] : 'name' );
                $name       = $nameEx[1] ?? $nameEx[0];

                if( ! is_array($content) )
                {
                    $header .= "<meta $httpOrName=\"$name\" content=\"$content\">".EOL;
                }
                else
                {
                    foreach( $content as $key => $val )
                    {
                        $header .= "<meta $httpOrName=\"$name\" content=\"$val\">".EOL;
                    }
                }
            }
        }

        return $header;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _data($datas, $headData)
    {
        if( $headData !== NULL )
        {
            $datas = array_merge($datas, $headData);
        }

        $header = NULL;

        if( ! empty($datas) )
        {
            if( ! is_array($datas) )
            {
                $header .= $datas.EOL;
            }
            else
            {
                foreach( $datas as $v )
                {
                    $header .= $v.EOL;
                }
            }
        }

        return $header;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Theme
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _theme($masterPageSet, $head, $type = 'theme')
    {
        $theme = Arrays\RemoveElement::element(array_merge((array) ($masterPageSet[$type]['name'] ?? []), (array) ($head[$type]['name'] ?? [])), '');

        if( ! empty($theme) )
        {   
            return Package::$type($theme, ($head[$type]['recursive'] ?? $masterPageSet[$type]['recursive']), true);
        }

        return NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Links
    //--------------------------------------------------------------------------------------------------------
    //
    // @params
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _links($masterPageSet, $head, $type)
    {
        $header = '';

        $class = 'ZN\IndividualStructures\Import\\' . $type;

        if( empty($masterPageSet[$type]) && empty($head[$type]) )
        {
            return false;
        }

        $params = $masterPageSet[$type];

        if( ! is_array($params) )
        {
            $params = [$params, true];
        }
        else
        {
            $params[] = true;
        }

        $header .= $class::use(...$params);

        if( isset($head[$type]) )
        {
            if( is_string($head[$type]) )
            {
                $headLinks = [$head[$type], true];
            }
            else
            {
                $head[$type][] = true;

                $headLinks = $head[$type];
            }

            $header .= $class::use(...$headLinks);
        }

        return $header;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Set Page
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $page
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _setpage($page)
    {
        if( ! empty($page) )
        {
            $return = '';

            // Tek bir üst sayfa kullanımı için.
            if( ! is_array($page) )
            {
                $return .= View::use($page, NULL, true).EOL;
            }
            else
            {
                // Birden fazla üst sayfa kullanımı için.
                foreach( $page as $p )
                {
                    $return .= View::use($p, NULL, true).EOL;
                }
            }

            return $return;
        }

        return false;
    }
}