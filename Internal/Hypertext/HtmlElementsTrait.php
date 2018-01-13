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

trait HtmlElementsTrait
{
    /**
     * Sets aria attribute
     * 
     * @param string $type
     * @param string $element
     * 
     * @return self
     */
    public function aria(String $type, String $element)
    {
        $this->settings['attr']['aria-'.$type] = $element;

        return $this;
    }

    /**
     * Sets data attribute
     * 
     * @param string $type
     * @param string $element
     * 
     * @return self
     */
    public function data(String $type, String $element)
    {
        $this->settings['attr']['data-'.$type] = $element;

        return $this;
    }

    /**
     * Sets ice:repeating attribute
     * 
     * @param string $element
     * 
     * @return self
     */
    public function iceRepeating(String $element)
    {
        $this->settings['attr']['ice:repeating'] = $element;

        return $this;
    }

    /**
     * Sets spry attribute
     * 
     * @param string $type
     * @param string $element
     * 
     * @return self
     */
    public function spry(String $type, String $element)
    {
        $this->settings['attr']['spry-'.$type] = $element;

        return $this;
    }

    /**
     * Sets src attribute
     * 
     * @param string $element
     * 
     * @return self
     */
    public function source(String $element)
    {
        $this->settings['attr']['src'] = $element;

        return $this;
    }

    /**
     * Sets title attribute
     * 
     * @param string $element
     * 
     * @return self
     */
    public function title(String $element)
    {
        $this->settings['attr']['title'] = $element;

        return $this;
    }
}
