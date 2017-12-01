<?php namespace ZN\ViewObjects\HTML\Helpers;

use ZN\ViewObjects\Abstracts\HTMLHelpersAbstract;
use ZN\DataTypes\Arrays;
use ZN\IndividualStructures\IS;

class Lists extends HTMLHelpersAbstract
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
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(...$elements) : String
    {
        return $this->_element($elements[0], '', 0);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed   $data
    // @param string  $tab
    // @param numeric $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _element($data, $tab, $start)
    {
        static $start;

        $eof     = EOL;
        $output  = '';
        $attrs   = '';
        $tab     = str_repeat("\t", $start);

        if( ! is_array($data) )
        {
            return $data.$eof;
        }
        else
        {
            foreach( $data as $k => $v )
            {
                if( IS::realNumeric($k) )
                {
                    $value = $k;
                    $k     = 'li';
                }
                else
                {
                    $value = NULL;
                }

                $end = prefix(Arrays\GetElement::first(explode(' ', $k)));

                if( ! is_array($v) )
                {

                    $output .= "$tab<$k>$v<$end>$eof";
                }
                else
                {
                    if( stripos($k, 'ul') !== 0 && stripos($k, 'ol') !== 0 && $k !== 'li' )
                    {
                        $value = $k;
                        $k     = 'li';
                        $end   = prefix($k);
                    }
                    else
                    {
                        $value = NULL;
                    }

                    $output .= $tab."<$k>$value$eof".$this->_element($v, $tab, $start++).$tab."<$end>".$tab.$eof;
                    $start--;
                }
            }
        }

        return $output;
    }
}
