<?php namespace ZN\IndividualStructures\Import;

use Config, HTML, Import, Arrays;

class Masterpage implements MasterpageInterface
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
        if( ! empty(Properties::$parameters['headData']) )
        {
            $head = Properties::$parameters['headData'];
        }

        if( ! empty(Properties::$parameters['data']) )
        {
            $randomDataVariable = Properties::$parameters['data'];
        }

        $bodyContent = Properties::$parameters['bodyContent'] ?? NULL;

        Properties::$parameters = [];

        $eol = EOL;

        $masterPageSet = Config::get('Masterpage');

        $randomPageVariable = $head['bodyPage'] ?? $masterPageSet['bodyPage'];
        $headPage           = $head['headPage'] ?? $masterPageSet['headPage'];

        $docType        = $head['docType'] ?? $masterPageSet["docType"];
        $header         = Config::get('ViewObjects', 'doctype')[$docType].$eol;
        $htmlAttributes = $head['attributes']['html'] ?? $masterPageSet['attributes']['html'];

        $header .= '<html xmlns="http://www.w3.org/1999/xhtml"'.Html::attributes($htmlAttributes).'>'.$eol;

        $headAttributes = $head['attributes']['head'] ?? $masterPageSet['attributes']['head'];

        $header .= '<head'.Html::attributes($headAttributes).'>'.$eol;

        $contentCharset = $head['content']['charset'] ?? $masterPageSet['content']['charset'];

        if( is_array($contentCharset) )
        {
            foreach( $contentCharset as $v )
            {
                $header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$v\">".$eol;
            }
        }
        else
        {
            $header .= '<meta http-equiv="Content-Type" content="text/html; charset='.$contentCharset.'">'.$eol;
        }

        $contentLanguage = $head['content']['language'] ?? $masterPageSet['content']['language'];

        $header .= '<meta http-equiv="Content-Language" content="'.$contentLanguage .'">'.$eol;

        $datas = $masterPageSet['data'];
        $metas = $masterPageSet['meta'];
        $title = $head['title'] ?? $masterPageSet["title"];

        if( ! empty($title) )
        {
            $header .= '<title>'.$title.'</title>'.$eol;
        }

        if( isset($head['meta']) )
        {
            $metas = array_merge($metas, $head['meta']);
        }

        if( ! empty($metas) ) foreach( $metas as $name => $content )
        {
            if( isset($head['meta'][$name]) )
            {
                $content = $head['meta'][$name];
            }

            if( ! empty($content) )
            {
                $nameEx     = explode(":", $name);
                $httpOrName = ( $nameEx[0] === 'http' ) ? 'http-equiv' : ( isset($nameEx[1]) ? $nameEx[0] : 'name' );
                $name       = $nameEx[1] ?? $nameEx[0];

                if( ! is_array($content) )
                {
                    $header .= "<meta $httpOrName=\"$name\" content=\"$content\">".$eol;
                }
                else
                {
                    foreach( $content as $key => $val )
                    {
                        $header .= "<meta $httpOrName=\"$name\" content=\"$val\">".$eol;
                    }
                }
            }
        }

        $header .= $this->_links($masterPageSet, $head, 'font');
        $header .= $this->_links($masterPageSet, $head, 'style');
        $header .= $this->_links($masterPageSet, $head, 'script');

        $browserIcon = $head['browserIcon'] ?? $masterPageSet["browserIcon"];

        if( ! empty($browserIcon) && is_file($browserIcon) )
        {
            $header .= '<link rel="shortcut icon" href="'.baseUrl($browserIcon).'" />'.$eol;
        }

        $theme          = Arrays::deleteElement(Arrays::merge((array) ($masterPageSet['theme']['name'] ?? []), (array) ($head['theme']['name'] ?? [])), '');
        $themeRecursive = $head['theme']['recursive'] ?? $masterPageSet['theme']['recursive'];

        if( ! empty($theme) )
        {
            $header .= Import::theme($theme, $themeRecursive, true);
        }

        $plugin          = Arrays::deleteElement(Arrays::merge((array) ($masterPageSet['plugin']['name'] ?? []), (array) ($head['plugin']['name'] ?? [])), '');
        $pluginRecursive = $head['plugin']['recursive'] ?? $masterPageSet['plugin']['recursive'];

        if( ! empty($plugin) )
        {
            $header .= Import::plugin($plugin, $pluginRecursive, true);
        }

        if( isset($head['data']) )
        {
            $datas = array_merge($datas, $head['data']);
        }

        if( ! empty($datas) )
        {
            if( ! is_array($datas) )
            {
                $header .= $datas.$eol;
            }
            else
            {
                foreach( $datas as $v )
                {
                    $header .= $v.$eol;
                }
            }
        }

        $header .= $this->_setpage($headPage);
        $header .= '</head>'.$eol;

        $backgroundImage  = $head['backgroundImage'] ?? $masterPageSet["backgroundImage"];
        $bgImage          = ( ! empty($backgroundImage) && is_file($backgroundImage) )
                          ? ' background="'.baseUrl($backgroundImage).'" bgproperties="fixed"'
                          : '';

        $bodyAttributes = $head['attributes']['body'] ?? $masterPageSet['attributes']['body'];

        $header .= '<body'.Html::attributes($bodyAttributes).$bgImage.'>'.$eol;

        echo $header;

        if( ! empty($randomPageVariable) )
        {
            $randomDataVariable['view'] = $bodyContent;

            Import::page($randomPageVariable, $randomDataVariable);
        }
        else
        {
            echo $bodyContent;
        }

        $randomFooterVariable  = $eol.'</body>'.$eol;
        $randomFooterVariable .= '</html>';

        echo $randomFooterVariable;
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

        $header .= Import::$type(...$params);

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

            $header .= Import::$type(...$headLinks);
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
            $eol    = EOL;
            $return = '';

            // Tek bir üst sayfa kullanımı için.
            if( ! is_array($page) )
            {
                $return .= Import::page($page, NULL, true).$eol;
            }
            else
            {
                // Birden fazla üst sayfa kullanımı için.
                foreach( $page as $p )
                {
                    $return .= Import::page($p, NULL, true).$eol;
                }
            }

            return $return;
        }

        return false;
    }
}
