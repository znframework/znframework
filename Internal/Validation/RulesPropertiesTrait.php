<?php namespace ZN\Validation;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;

trait RulesPropertiesTrait
{
    /**
     * Keeps settings
     * 
     * @var array
     */
    protected $settings = [];

    /**
     * Method
     * 
     * @param string $method
     * 
     * @return Data
     */
    public function method(String $method) : Data
    {
        $this->settings['method'] = $method;

        return $this;
    }

    /**
     * Value
     * 
     * @param string $value
     * 
     * @return Data
     */
    public function value(String $value) : Data
    {
        $this->settings['value'] = $value;

        return $this;
    }

    /**
     * Required
     * 
     * @return Data
     */
    public function required() : Data
    {
        $this->settings['config'][] = 'required';

        return $this;
    }

    /**
     * Numeric
     * 
     * @return Data
     */
    public function numeric() : Data
    {
        $this->settings['config'][] = 'numeric';

        return $this;
    }

    /**
     * Match
     * 
     * @param string $match
     * 
     * @return Data
     */
    public function match(String $match) : Data
    {
        $this->settings['config']['match'] = $match;

        return $this;
    }

    /**
     * Match Password
     * 
     * @param string $match
     * 
     * @return Data
     */
    public function matchPassword(String $match) : Data
    {
        $this->settings['config']['matchPassword'] = $match;

        return $this;
    }

    /**
     * Match Old Password
     * 
     * @param string $oldPassword
     * 
     * @return Data
     */
    public function oldPassword(String $oldPassword) : Data
    {
        $this->settings['config']['oldPassword'] = $oldPassword;

        return $this;
    }

    /**
     * Compare
     * 
     * @param int $min = NULL
     * @param int $max = NULL
     * 
     * @return Data
     */
    public function compare(Int $min = NULL, Int $max = NULL) : Data
    {
        $this->settings['config']['minchar'] = $min;
        $this->settings['config']['maxchar'] = $max;

        return $this;
    }

    /**
     * Between
     * 
     * @param float $min = NULL
     * @param float $max = NULL
     * 
     * @return Data
     */
    public function between(Float $min = NULL, Float $max = NULL) : Data
    {
        $this->settings['config']['between'] = [$min, $max];

        return $this;
    }

    /**
     * Between Both
     * 
     * @param float $min = NULL
     * @param float $max = NULL
     * 
     * @return Data
     */
    public function betweenBoth(Float $min = NULL, Float $max = NULL) : Data
    {
        $this->settings['config']['betweenBoth'] = [$min, $max];

        return $this;
    }

    /**
     * Validate
     * 
     * @param mixed ...$args
     * 
     * @return Data
     */
    public function validate(...$args) : Data
    {
        $this->settings['validate'] = $args;

        return $this;
    }

    /**
     * Scure
     * 
     * @param string ...$args
     * 
     * @return Data
     */
    public function secure(...$args) : Data
    {
        $this->settings['secure'] = $args;

        return $this;
    }

    /**
     * Pattern
     * 
     * @param string $pattern
     * @param string $char = NULL
     * 
     * @return Data
     */
    public function pattern(String $pattern, String $char = NULL) : Data
    {
        $this->settings['config']['pattern'] = Base::presuffix($pattern).$char;

        return $this;
    }

    /**
     * Phone
     * 
     * @param string $design = NULL
     * 
     * @return Data
     */
    public function phone(String $design = NULL) : Data
    {
        if( empty($design) )
        {
            $this->settings['config'][] = 'phone';
        }
        else
        {
            $this->settings['config']['phone'] = $design;
        }

        return $this;
    }

    /**
     * Alpha
     * 
     * @return Data
     */
    public function alpha() : Data
    {
        $this->settings['config'][] = 'alpha';

        return $this;
    }

    /**
     * Alpha Numeric
     * 
     * @return Data
     */
    public function alnum() : Data
    {
        $this->settings['config'][] = 'alnum';

        return $this;
    }

    /**
     * Captcha
     * 
     * @return Data
     */
    public function captcha() : Data
    {
        $this->settings['config'][] = 'captcha';

        return $this;
    }
}
