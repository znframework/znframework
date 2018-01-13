<?php namespace Project\Controllers;

//------------------------------------------------------------------------------------------------------------
// GENERATE
//------------------------------------------------------------------------------------------------------------
//
// Author   : ZN Framework
// Site     : www.znframework.com
// License  : The MIT License
// Copyright: Copyright (c) 2012-2016, znframework.com
//
//------------------------------------------------------------------------------------------------------------

use Restful, JC, Method, Http, Processor, File, Arrays, URI, Json, Folder, Config, Strings;

class Packages extends Controller
{
    protected $downloadFileName = FILES_DIR . 'DownloadPackageList.json';

    protected $list = [];

    protected $vendor;

    public function __construct()
    {
        parent::__construct();

        if( ! File::exists($this->downloadFileName) )
        {
            File::write($this->downloadFileName, '[]' . EOL);
        }

        $vendor = Config::get('Autoloader', 'composer');

        if( is_bool($vendor) )
        {
            $this->vendor = 'vendor/';
        }
        else
        {
            $this->vendor = rtrim($vendor, 'autoload.php');
        }

        $this->list = Json::decodeArray(File::read($this->downloadFileName));
    }

    //--------------------------------------------------------------------------------------------------------
    // Controller
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function main(String $params = NULL)
    {
        if( Method::post('search') )
        {
            $data = Restful::get('https://packagist.org/search.json?q=' . Method::post('name') );

            $this->masterpage->pdata['result'] = $data->results;
         }

        $this->masterpage->pdata['list'] = $this->list;

        $this->masterpage->page = 'package';
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete()
    {
        $newList = Arrays::deleteElement($this->list, $packageName = URI::get('delete', 2, true));

        $deletePackageName = $this->vendor . Strings::divide($packageName, '/');

        if( Folder::exists($deletePackageName) )
        {
            Folder::delete($deletePackageName);
        }

        File::write($this->downloadFileName, Json::encode($newList) . EOL);

        redirect('packages');
    }

    //--------------------------------------------------------------------------------------------------------
    // Ajax Download
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function download()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $name = Method::post('name');

        exec('composer require ' . $name, $response, $return);

        if( $return == 0 )
        {
            $data = Json::decodeArray(File::read($this->downloadFileName));

            $data = Arrays::addLast($data, $name);

            File::write($this->downloadFileName, Json::encode($data) . EOL);
        }

        echo $return;

        exit;
    }
}
