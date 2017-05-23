<?php namespace ZN\Services\Remote;

use CURL, Json, URL, XML, Http, Redirect, Route;

class InternalRestful implements InternalRestfulInterface
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
    // Protected $url
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $url;

    //--------------------------------------------------------------------------------------------------------
    // Protected $data
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $data;

    //--------------------------------------------------------------------------------------------------------
    // Protected $info
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $info;

    //--------------------------------------------------------------------------------------------------------
    // Protected $sslVerifyPeer
    //--------------------------------------------------------------------------------------------------------
    //
    // @var bool
    //
    //--------------------------------------------------------------------------------------------------------
    protected $sslVerifyPeer = false;

    //--------------------------------------------------------------------------------------------------------
    // Magic Call
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $method
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public function __call($method, $parameters)
    {
        return $this->info($method);
    }

    //--------------------------------------------------------------------------------------------------------
    // Content Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type    = 'json'
    // @param string $charset = 'utf-8'
    //
    //--------------------------------------------------------------------------------------------------------
    public function contentType(String $type = 'json', String $charset = 'utf-8') : InternalRestful
    {
        header('Content-Type: application/' . $type . '; charset=' . $charset);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Http Status
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $code
    //
    //--------------------------------------------------------------------------------------------------------
    public function httpStatus(Int $code = NULL) : InternalRestful
    {
        $code = $code ?? Redirect::status();

        header('HTTP/1.1 ' . $code . ' ' . Http::code($code));

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function info(String $key = NULL)
    {
        return $key === NULL ? $this->info : ($this->info[strtolower($key)] ?? false);
    }

    //--------------------------------------------------------------------------------------------------------
    // Url
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    //--------------------------------------------------------------------------------------------------------
    public function url(String $url) : InternalRestful
    {
        $this->url = $url;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function data(Array $data) : InternalRestful
    {
        $this->data = $data;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // SSL Verify Peer
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $type = false
    //
    //--------------------------------------------------------------------------------------------------------
    public function sslVerifyPeer(Bool $type = false) : InternalRestful
    {
        $this->sslVerifyPeer = $type;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Get
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    //--------------------------------------------------------------------------------------------------------
    public function get(String $url = NULL)
    {
        $response = CURL::init($this->url ?? $url)
                        ->option('returntransfer', true)
                        ->option('ssl_verifypeer', $this->sslVerifyPeer)
                        ->exec();

        return $this->_result($response);
    }

    //--------------------------------------------------------------------------------------------------------
    // Post
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    // @param array  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function post(String $url = NULL, Array $data = [])
    {
        $response = CURL::init($this->url ?? $url)
                        ->option('returntransfer', true)
                        ->option('post', true)
                        ->option('ssl_verifypeer', $this->sslVerifyPeer)
                        ->option('postfields', $this->data ?? $data)
                        ->exec();

        return $this->_result($response);
    }

    //--------------------------------------------------------------------------------------------------------
    // Put
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    // @param array  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function put(String $url = NULL, Array $data = [])
    {
        return $this->_customRequest($url, URL::buildQuery($this->data ?? $data), __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    // @param array  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $url = NULL, Array $data = [])
    {
        return $this->_customRequest($url, $this->data ?? $data, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Return
    //--------------------------------------------------------------------------------------------------------
    //
    // @param callable $callback
    //
    //--------------------------------------------------------------------------------------------------------
    public function return(Callable $callback)
    {
        if( ! Http::isCurl() )
        {
            Route::redirectInvalidRequest();
        }

        return $callback();
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Custom Request
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    // @param array  $data
    // @parma string $type
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _customRequest($url, $data, $type)
    {
        $response = CURL::init($this->url ?? $url)
                        ->option('returntransfer', true)
                        ->option('customrequest', strtoupper($type))
                        ->option('ssl_verifypeer', $this->sslVerifyPeer)
                        ->option('postfields', $data)
                        ->exec();

        return $this->_result($response);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Info
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $response
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _info()
    {
        $this->info['gethttpcode']          = CURL::info('http_code');
        $this->info['getfiletime']          = CURL::info('filetime');
        $this->info['gettotaltime']         = CURL::info('total_time');
        $this->info['getpretransfertime']   = CURL::info('pretransfer_time');
        $this->info['getstarttransfertime'] = CURL::info('starttransfer_time');
        $this->info['getredirecttime']      = CURL::info('redirect_time');
        $this->info['getuploadsize']        = CURL::info('size_upload');
        $this->info['getdownloadsize']      = CURL::info('size_download');
        $this->info['getrequestsize']       = CURL::info('request_size');
        $this->info['getdownloadspeed']     = CURL::info('speed_download');
        $this->info['getuploadspeed']       = CURL::info('speed_upload');
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $response
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _result($response)
    {
        $this->_info();

        CURL::close();

        $this->_default();

        if( Json::check($response) )
        {
            return Json::decodeObject($response);
        }
        elseif( XML::check($response) )
        {
            return XML::parseObject($response);
        }
        else
        {
            return $response;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Default
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _default()
    {
        $this->url           = NULL;
        $this->data          = NULL;
        $this->sslVerifyPeer = false;
    }
}
