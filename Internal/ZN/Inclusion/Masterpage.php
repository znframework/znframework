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

use ZN\Config;
use ZN\Request;
use ZN\Hypertext;

class Masterpage
{
    /**
     * Sets Head Data
     * 
     * @param array $headData
     * 
     * @return Masterpage
     */
    public function headData(Array $headData) : Masterpage
    {
        Properties::$parameters['headData'] = $headData;

        return $this;
    }

    /**
     * Sets Body Page
     * 
     * @param string $head
     * 
     * @return Masterpage
     */
    public function body(String $body) : Masterpage
    {
        Config::set('Masterpage', 'bodyPage', $body);

        return $this;
    }

    /**
     * Sets Head Page
     * 
     * @param mixed $head
     * 
     * @return Masterpage
     */
    public function head($head) : Masterpage
    {
        Config::set('Masterpage', 'headPage', $head);

        return $this;
    }

    /**
     * Sets Page Title
     * 
     * @param string $title
     * 
     * @return Masterpage
     */
    public function title(String $title) : Masterpage
    {
        Config::set('Masterpage', 'title', $title);

        return $this;
    }

    /**
     * Sets Meta Elements
     * 
     * @param array $meta
     * 
     * @return Masterpage
     */
    public function meta(Array $meta) : Masterpage
    {
        Config::set('Masterpage', 'meta', $meta);

        return $this;
    }

    /**
     * Sets Attributes
     * 
     * @param array $attributes
     * 
     * @return Masterpage
     */
    public function attributes(Array $attributes) : Masterpage
    {
        Config::set('Masterpage', 'attributes', $attributes);

        return $this;
    }

    /**
     * page Content
     * 
     * @param array $content
     * 
     * @return Masterpage
     */
    public function content(Array $content) : Masterpage
    {
        Config::set('Masterpage', 'content', $content);

        return $this;
    }

    /**
     * Body Content
     * 
     * @param string $content
     * 
     * @return Masterpage
     */
    public function bodyContent(String $content) : Masterpage
    {
        Properties::$parameters['bodyContent'] = $content;

        return $this;
    }

    /**
     * Get Masterpage
     * 
     * @param array $randomDataVariable = NULL
     * @param array $head               = NULL
     */
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
        $htmlAttributes = Hypertext::attributes($head['attributes']['html'] ?? $masterPageSet['attributes']['html']);

        $header .= '<html'.$htmlAttributes.'>'.EOL;
        $header .= '<head'.Hypertext::attributes($head['attributes']['head'] ?? $masterPageSet['attributes']['head']).'>'.EOL;
        $header .= $this->_contentCharset($head['content']['charset'] ?? $masterPageSet['content']['charset']);
        $header .= $this->_contentLanguage($head['content']['language'] ?? $masterPageSet['content']['language']);
        $header .= $this->_title($head['title'] ?? $masterPageSet["title"]);
        $header .= $this->_meta($masterPageSet['meta'], $head['meta'] ?? NULL);
        $header .= $this->_links($masterPageSet, $head, 'Font');
        $header .= $this->_links($masterPageSet, $head, 'Style');
        $header .= $this->_links($masterPageSet, $head, 'Script');
        $header .= $this->_browserIcon($head['browserIcon'] ?? $masterPageSet["browserIcon"]);
        $header .= $this->_theme($masterPageSet, $head);
        $header .= $this->_theme($masterPageSet, $head, 'plugin');
        $header .= $this->_setpage($head['headPage'] ?? $masterPageSet['headPage']);
        $header .= '</head>'.EOL;
        $header .= '<body'.Hypertext::attributes($head['attributes']['body'] ?? $masterPageSet['attributes']['body']).
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

    /**
     * Protected Content Charset
     */
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

    /**
     * Protected Content Language
     */
    protected function _contentLanguage($contentLanguage)
    {
        return '<meta http-equiv="Content-Language" content="'.$contentLanguage .'">'.EOL;
    }

    /**
     * Protected Background Image
     */
    protected function _bgImage($backgroundImage)
    {
        $bgImage = ( ! empty($backgroundImage) && is_file($backgroundImage) )
                 ? ' background="'.Request::getBaseURL($backgroundImage).'" bgproperties="fixed"'
                 : '';
                 
        return $bgImage;
    }

    /**
     * Protected Browser Icon
     */
    protected function _browserIcon($browserIcon)
    {
        if( ! empty($browserIcon) && is_file($browserIcon) )
        {
           return '<link rel="shortcut icon" href="'.Request::getBaseURL($browserIcon).'" />'.EOL;
        }

        return NULL;
    }

    /**
     * Protected Title
     */
    protected function _title($title)
    {      
        if( ! empty($title) )
        {
            return '<title>'.$title.'</title>'.EOL;
        }

        return NULL;
    }

    /**
     * Protected Meta Data
     */
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

    /**
     * Protected Theme
     */
    protected function _theme($masterPageSet, $head, $type = 'theme')
    {
        $theme = array_diff(array_merge((array) ($masterPageSet[$type]['name'] ?? []), (array) ($head[$type]['name'] ?? [])), ['']);

        if( ! empty($theme) )
        {   
            return Package::$type($theme, ($head[$type]['recursive'] ?? $masterPageSet[$type]['recursive']), true);
        }

        return NULL;
    }

    /**
     * Protected Links
     */
    protected function _links($masterPageSet, $head, $type)
    {
        $header = '';

        $class = 'ZN\Inclusion\\' . $type;

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

    /**
     * Protected Set Page
     */
    protected function _setpage($page)
    {
        if( ! empty($page) )
        {
            $return = '';

            # Single Masterpage
            if( ! is_array($page) )
            {
                $return .= View::use($page, NULL, true).EOL;
            }
            else
            {
                # Multiple Masterpage
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