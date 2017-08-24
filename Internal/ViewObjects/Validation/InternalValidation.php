<?php namespace ZN\ViewObjects\View;

use Validator, Config, Security, Session, Encode, Method, CallController;
use ZN\ViewObjects\View\Validation\Exception\InvalidArgumentException;

class InternalValidation extends CallController implements InternalValidationInterface
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
    // Options
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $options   = ['post', 'get', 'request', 'data'];

    //--------------------------------------------------------------------------------------------------------
    // Errors
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $errors   = [];

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $error    = [];

    //--------------------------------------------------------------------------------------------------------
    // Nval
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $nval     = [];

    //--------------------------------------------------------------------------------------------------------
    // Messages
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $messages = [];

    //--------------------------------------------------------------------------------------------------------
    // Index
    //--------------------------------------------------------------------------------------------------------
    //
    // @var int
    //
    //--------------------------------------------------------------------------------------------------------
    protected $index = 0;

    //--------------------------------------------------------------------------------------------------------
    // Validation Properties Trait
    //--------------------------------------------------------------------------------------------------------
    //
    // @methdos
    //
    //--------------------------------------------------------------------------------------------------------
    use InternalValidationPropertiesTrait;

    //--------------------------------------------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param array  $config
    // @param string $viewName
    // @param string $met
    //
    //--------------------------------------------------------------------------------------------------------
    public function rules(String $name, Array $config = [], $viewName = '', String $met = 'post')
    {
        if( ! in_array($met, $this->options) )
        {
            throw new InvalidArgumentException('ViewObjects', 'validation:invalidMethodParameter', '4. ');
        }

        if( is_array($this->_methodType($name, $met)) )
        {
            return $this->_multipleRules($name, $config, $viewName, $met);
        }

        if( ! empty($this->settings['method']) )
        {
            $met = $this->settings['method'];
        }

        if( ! empty($this->settings['value']) )
        {
            $viewName = $this->settings['value'];
        }

        if( ! empty($this->settings['config']) )
        {
            $config = array_merge($config, $this->settings['config']);
        }

        if( ! empty($this->settings['validate']) )
        {
            $config = array_merge($config, $this->settings['validate']);
        }

        if( ! empty($this->settings['secure']) )
        {
            $config = array_merge($config, $this->settings['secure']);
        }

        if( ! empty($this->settings['pattern']) )
        {
            $config = array_merge($config, $this->settings['pattern']);
        }

        $this->settings = [];

        $viewName = ( empty($viewName) ) ? $name : $viewName;

        $edit = $this->_methodType($name, $met);

        if( ! isset($edit) )
        {
            return false;
        }

        if( in_array('trim',$config) )
        {
            $edit = trim($edit);
        }

        if( in_array('nc', $config) )
        {
            $secnc = \ZN\IndividualStructures\Security\Properties::$ncEncode;
            $edit  = Security::ncEncode($edit, $secnc['badChars'], $secnc['changeBadChars']);
        }

        if( in_array('html', $config) )
        {
            $edit = Security::htmlEncode($edit);
        }

        if( in_array('xss', $config) )
        {
            $edit = Security::xssEncode($edit);
        }

        if( in_array('injection', $config) )
        {
            $edit = Security::injectionEncode($edit);
        }

        if( in_array('script', $config) )
        {
            $edit = Security::scriptTagEncode($edit);
        }

        if( in_array('php', $config) )
        {
            $edit = Security::phpTagEncode($edit);
        }

        $this->nval[$name] = $edit;

        $this->_methodNval($name, $edit, $met);

        if( in_array('required', $config) )
        {
            if( empty($edit) )
            {
                $this->_messages('required', $name, $viewName);
            }
        }

        if( in_array('captcha', $config) )
        {
            Session::start();

            if( $edit != Session::select(md5('SystemCaptchaCodeData')) )
            {
                $this->_messages('captchaCode', $name, $viewName);
            }
        }

        if( isset($config['matchPassword']) )
        {
            $pm = $this->_methodType($config['matchPassword'], $met);

            if( $edit != $pm )
            {
                $this->_messages('passwordMatch', $name, $viewName);
            }
        }

        if( isset($config['match']) )
        {
            $pm = $this->_methodType($config['match'], $met);

            if( $edit != $pm )
            {
                $this->_messages('dataMatch', $name, $viewName);
            }
        }

        if( isset($config['oldPassword']) )
        {
            $pm = "";
            $pm = $config['oldPassword'];

            if( Encode::super($edit) != $pm )
            {
                $this->_messages('oldPasswordMatch', $name, $viewName);
            }
        }

        if( in_array('numeric', $config) )
        {
            if( ! Validator::numeric($edit) )
            {
                $this->_messages('numeric', $name, $viewName);
            }
        }

        if( in_array('phone', $config) )
        {
            if( ! Validator::phone($edit) )
            {
                $this->_messages('phone', $name, $viewName);
            }
        }

        if( isset($config['phone']) )
        {
            if( ! Validator::phone($edit, $config['phone']) )
            {
                $this->_messages('phone', $name, $viewName);
            }
        }

        if( in_array('alpha', $config) )
        {
            if( ! Validator::alpha($edit) )
            {
                $this->_messages('alpha', $name, $viewName);
            }
        }

        if( in_array('alnum', $config) )
        {
            if( ! Validator::alnum($edit) )
            {
                $this->_messages('alnum', $name, $viewName);
            }
        }

        if( in_array('email', $config) )
        {
            if( ! Validator::email($edit) )
            {
                $this->_messages('email', $name, $viewName);
            }
        }

        if( in_array('url' ,$config) )
        {
            if( ! Validator::url($edit) )
            {
                $this->_messages('url', $name, $viewName);
            }
        }

        if( in_array('identity', $config) )
        {
            if( ! Validator::identity($edit) )
            {
                $this->_messages('identity', $name, $viewName);
            }
        }

        if( in_array('specialChar', $config) )
        {
            if( Validator::specialChar($edit) )
            {
                $this->_messages('noSpecialChar', $name, $viewName);
            }
        }

        if( isset($config['maxchar']) )
        {
            if( ! Validator::maxchar($edit, $config['maxchar']) )
            {
                $this->_messages('maxchar', $name, ["%" => $viewName, "#" => $config['maxchar']]);
            }
        }

        if( isset($config['minchar']) )
        {
            if( ! Validator::minchar($edit, $config['minchar']) )
            {
                $this->_messages('minchar', $name, ["%" => $viewName, "#" => $config['minchar']]);
            }
        }

        if( isset($config['pattern']) )
        {
            if( ! preg_match($config['pattern'], $edit) )
            {
                $this->_messages('pattern', $name, $viewName);
            }
        }

        array_push($this->errors, $this->messages);

        $this->_defaultVariables();
    }

    //--------------------------------------------------------------------------------------------------------
    // Nval
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function nval(String $name)
    {
        if( isset($this->nval[$name]) )
        {
            return $this->nval[$name];
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function error(String $name = 'array')
    {
        if( $name === "string" || $name === "array" || $name === "echo" )
        {
            if( count($this->errors) > 0 )
            {
                $result = '';
                $resultArray = [];

                foreach( $this->errors as $key => $value )
                {
                    if( is_array($value) )foreach($value as $k => $val)
                    {
                        $result .= $val;
                        $resultArray[] = str_replace("<br>", '', $val);
                    }
                }

                if( $name === "string" || $name === "echo" )
                {
                    return $result;
                }

                if( $name === "array")
                {
                    return $resultArray;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            if( isset($this->error[$name]) )
            {
                return $this->error[$name];
            }
            else
            {
                return false;
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $met
    //
    //--------------------------------------------------------------------------------------------------------
    public function postBack(String $name, String $met = 'post')
    {
        $method = $this->_methodType($name, $met);

        if( ! isset($method) )
        {
            return false;
        }

        return $method;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Messages
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    // @param string $name
    // @param string $viewName
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _messages($type, $name, $viewName)
    {
        $message = \Lang::select('ViewObjects', 'validation:'.$type, $viewName);
        $this->messages[$this->index] = $message.'<br>'; $this->index++;
        $this->error[$name] = $message;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Default Variables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _defaultVariables()
    {
        $this->messages = [];
        $this->index    = 0;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Method Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $met
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _methodType($name, $met)
    {
        if( $met === "data" )
        {
            return $name;
        }

        return Method::$met($name);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Method Nval
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $val
    // @param string $met
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _methodNval($name, $val, $met)
    {
        if( $met === "data" )
        {
            return;
        }

        return Method::$met($name, $val);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Multiple Rules
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param string $val
    // @param string $met
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _multipleRules(String $name, Array $config = [], $viewName = '', String $met = 'post')
    {
        $postNames = [];
        $postKey   = '';
        $postDatas = (array) Method::$met($name);

        foreach( $postDatas as $key => $postData )
        {
            $postName = $name . $key;

            Method::$met($postName, $postData);

            $postKey = is_array($viewName)
                     ? $viewName[$key] ?? $postName
                     : $postName;

            $this->rules($postName, $config, $postKey, $met);
        }
    }
}
