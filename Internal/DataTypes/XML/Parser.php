<?php namespace ZN\DataTypes\XML;

use Json;

class Parser
{
    //--------------------------------------------------------------------------------------------------------
    // Parse
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $xml
    // @param string $result
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $xml, String $result = 'object')
    {
        $parser   = xml_parser_create();

        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $xml, $tags);
        xml_parser_free($parser);

        $elements = [];
        $stack    = [];

        if( ! empty($tags) ) foreach( $tags as $tag )
        {

            $index = count($elements);

            if( $tag['type'] === 'complete' || $tag['type'] === 'open' )
            {
                if( $result === 'object' )
                {
                    $elements[$index]          = new \stdClass;
                    $elements[$index]->name    = $tag['tag']        ?? NULL;
                    $elements[$index]->content = $tag['value']      ?? NULL;
                    $elements[$index]->attr    = $tag['attributes'] ?? NULL;

                    if( $tag['type'] === 'open' )
                    {
                        $elements[$index]->child = [];
                        $stack[count($stack)]       = &$elements;
                        $elements                   = &$elements[$index]->child;
                    }
                }
                else
                {
                    $elements[$index]               = [];
                    $elements[$index]['name']       = $tag['tag']        ?? NULL;
                    $elements[$index]['content']    = $tag['value']      ?? NULL;
                    $elements[$index]['attr']       = $tag['attributes'] ?? NULL;

                    if( $tag['type'] === 'open' )
                    {
                        $elements[$index]['child'] = [];
                        $stack[count($stack)]      = &$elements;
                        $elements                  = &$elements[$index]['child'];
                    }
                }
            }

            if( $tag['type'] === 'close' )
            {
                $elements = &$stack[count($stack) - 1];
                unset($stack[count($stack) - 1]);
            }
        }

        return $elements[0] ?? [];
    }

    //--------------------------------------------------------------------------------------------------------
    // Parse Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $data
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function array(String $data) : Array
    {
        return $this->do($data, 'array');
    }

    //--------------------------------------------------------------------------------------------------------
    // Parse Json
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $data
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function json(String $data) : String
    {
        return Json::encode($this->do($data, 'array'));
    }

    //--------------------------------------------------------------------------------------------------------
    // Parse Object
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string   $data
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function object(String $data)
    {
        return $this->do($data, 'object');
    }

    //--------------------------------------------------------------------------------------------------------
    // Parse Simple -> 5.3.5[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string   $data
    // @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function simple(String $data)
    {
        $data = preg_replace('/<xml(.*?)>/', '', $data);

        return uselib('SimpleXMLElement', [$data]);
    }
}
