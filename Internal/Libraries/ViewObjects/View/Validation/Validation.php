<?php namespace ZN\ViewObjects;

class InternalValidation extends \CallController implements ValidationInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
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
    use ValidationPropertiesTrait;
    
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
    public function rules(String $name, Array $config = [], String $viewName = NULL, String $met = 'post')
    {
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

        // sistemte validation için oluşturulmuş dil dosyası yükleniyor.

        $viewName = ( empty($viewName) ) 
                    ? $name 
                    : $viewName;

        $edit = $this->_methodType($name, $met);
        
        if( ! isset($edit) ) 
        {
            return false;   
        }
        
        // kenar boşluklarını kaldırır.
        if( in_array('trim',$config) ) 
        {
            $edit = trim($edit);        
        }
        
        // nc_clean çirkin kodların kullanılmasını engellemek için kullanılır.
        if( in_array('nc', $config) )
        {
            $secnc = Config::get('IndividualStructures', 'security')['ncEncode'];
            $edit  = \Security::ncEncode($edit, $secnc['badChars'], $secnc['changeBadChars']);
        }   
        
        // xss_clean genel de xss ataklarını engellemek için kullanılır.
        if( in_array('html' ,$config) )
        {
            $edit = \Security::htmlEncode($edit);       
        }
        
        // nail_clean tırnak işaretlerini temizlemek için kullanılır.
        if( in_array('xss', $config) )
        {
            $edit = \Security::xssEncode($edit);    
        }
        
        // tırnak işaretleri ve injection saldırılarını engellemek için kullanılır.
        if( in_array('injection', $config) )
        {
            $edit = \Security::injectionEncode($edit);
        }
        
        // Script tag kullanımı engellemek için kullanılır.
        if( in_array('script' ,$config) )
        {
            $edit = \Security::scriptTagEncode($edit);      
        }
        
        // PHP tag kullanımı engellemek için kullanılır.
        if( in_array('php' ,$config) )
        {
            $edit = \Security::phpTagEncode($edit);     
        }
        
        // Süzgeç sonrası validation::nval() yönteminin yeni değeri
        $this->nval[$name] = $edit;
        
        // Süzgeç sonrası yeni değer
        $this->_methodNval($name, $edit, $met);
        
        // required boş geçilemez yapar.
        if( in_array('required', $config) )
        { 
            if( empty($edit) )
            {   
                $this->_messages('required', $name, $viewName); 
            } 
        }
        
        // security_code güvenlik kodunun uygulanması için kullanılır, bu saydece güvenlik kodu ile 
        // bu kural eşleşirse işleve devam edilecektir.
        
        if( in_array('captcha', $config) )
        { 
            \Session::start();
            
            if( $edit != \Session::select(md5('SystemCaptchaCodeData')) )
            { 
                $this->_messages('captchaCode', $name, $viewName);  
            } 
        }
        
        // register işlemlerinde iki şifre kutusunun eşleştirilmesi için kullanılmaktadır.
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
    
            if( \Encode::super($edit) != $pm )
            { 
                $this->_messages('oldPasswordMatch', $name, $viewName);
            } 
        }
        
        // numeric form aracının sayısal değer olması gerektiğini belirtir.
        if( in_array('numeric', $config) )
        { 
            if( ! \Validate::numeric($edit) )
            { 
                $this->_messages('numeric', $name, $viewName);
            } 
        }
        
        // verinin telefon bilgisi olup olmadığı kontrol edilir.
        if( in_array('phone', $config) )
        { 
            if( ! \Validate::phone($edit) )
            { 
                $this->_messages('phone', $name, $viewName);
            } 
        }
        // verinin belirtilen desende telefon bilgisi olup olmadığı kontrol edilir.
        if( isset($config['phone']) )
        { 
            $phoneData = preg_replace('/([^\*])/', 'key:$1', $config['phone']);         
            $phoneData = '/'.str_replace(['*', 'key:'], ['[0-9]', '\\'], $phoneData).'/';

            if( ! preg_match($phoneData, $edit) )
            { 
                $this->_messages('phone', $name, $viewName);
            } 
        }
        
        // verinin alfabetik karakter bilgisi olup olmadığı kontrol edilir.
        if( in_array('alpha', $config) )
        { 
            if( ! \Validate::alpha($edit) )
            { 
                $this->_messages('alpha', $name, $viewName);
            } 
        }
        
        // verinin alfabetik ve sayısal veri olup olmadığı kontrol edilir.
        if( in_array('alnum', $config) )
        { 
            if( ! \Validate::alnum($edit) )
            { 
                $this->_messages('alnum', $name, $viewName);
            } 
        }
        
        // email form aracının email olması gerektiğini belirtir.
        if( in_array('email', $config) )
        { 
            if( ! \Validate::email($edit) )
            { 
                $this->_messages('email', $name, $viewName);
            } 
        }
        
        if( in_array('url' ,$config) )
        { 
            if( ! \Validate::url($edit) )
            { 
                $this->_messages('url', $name, $viewName);
            } 
        }
        
        if( in_array('identity', $config) )
        { 
            if( ! \Validate::identity($edit) )
            { 
                $this->_messages('identity', $name, $viewName);
            } 
        }
        
        // no special char, özel karakterlerin kullanımını engeller.
        if( in_array('specialChar', $config) )
        {
            if( \Validate::specialChar($edit) )
            { 
                $this->_messages('noSpecialChar', $name, $viewName);
            } 
        }
        
        // maxchar form aracının maximum alacağı karakter sayısını belirtir.    
        if( isset($config['maxchar']) )
        { 
            if( ! \Validate::maxchar($edit, $config['maxchar']) )
            { 
                $this->_messages('maxchar', $name, ["%" => $viewName, "#" => $config['maxchar']]);
            } 
        }
        
        // minchar from aracının minimum alacağı karakter sayısını belirtir.
        if( isset($config['minchar']) )
        {   
            if( ! \Validate::minchar($edit, $config['minchar']) )
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
        
        // kurala uymayan seçenekler varsa hata mesajı dizisine eklenir.
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
        $message = lang('ViewObjects', 'validation:'.$type, $viewName);
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
        if( $met === "post" )       
        {
            return \Method::post($name);
        }
        
        if( $met === "get" )        
        {
            return \Method::get($name);
        }
        
        if( $met === "request" )    
        {
            return \Method::request($name);
        }   
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
        if( $met === "post" )       
        {
            return \Method::post($name, $val);
        }
        
        if( $met === "get" )        
        {
            return \Method::get($name, $val);
        }
        
        if( $met === "request" )    
        {
            return \Method::request($name, $val);
        }   
    }
}