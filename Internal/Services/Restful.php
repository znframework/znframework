<?php namespace ZN\Services;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Protection\Json;
use ZN\XML;
use ZN\Singleton;
use ZN\Request\Http;
use ZN\Response\Redirect;

class Restful implements RestfulInterface
{
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

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->curl = Singleton::class('ZN\Services\CURL');
    }

    //--------------------------------------------------------------------------------------------------------
    // Content Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type    = 'json'
    // @param string $charset = 'utf-8'
    //
    //--------------------------------------------------------------------------------------------------------
    public function contentType(String $type = 'json', String $charset = 'utf-8') : Restful
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
    public function httpStatus(Int $code = NULL) : Restful
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
    public function url(String $url) : Restful
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
    public function data(Array $data) : Restful
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
    public function sslVerifyPeer(Bool $type = false) : Restful
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
        $response = $this->curl->init($this->url ?? $url)
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
        $response = $this->curl->init($this->url ?? $url)
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
            Singleton::class('ZN\Routing\Route')->redirectInvalidRequest();
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
        $response = $this->curl->init($this->url ?? $url)
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
        $this->info['gethttpcode']          = $this->curl->info('http_code');
        $this->info['getfiletime']          = $this->curl->info('filetime');
        $this->info['gettotaltime']         = $this->curl->info('total_time');
        $this->info['getpretransfertime']   = $this->curl->info('pretransfer_time');
        $this->info['getstarttransfertime'] = $this->curl->info('starttransfer_time');
        $this->info['getredirecttime']      = $this->curl->info('redirect_time');
        $this->info['getuploadsize']        = $this->curl->info('size_upload');
        $this->info['getdownloadsize']      = $this->curl->info('size_download');
        $this->info['getrequestsize']       = $this->curl->info('request_size');
        $this->info['getdownloadspeed']     = $this->curl->info('speed_download');
        $this->info['getuploadspeed']       = $this->curl->info('speed_upload');
        $this->info['all']                  = $this->curl->info(NULL);
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

        $this->curl->close();

        $this->_default();

        if( Json::check($response) )
        {
            return json_decode($response);
        }
        elseif( XML\Check::check($response) )
        {
            return XML\Parser::object($response);
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
