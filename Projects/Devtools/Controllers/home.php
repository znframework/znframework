<?php namespace Project\Controllers;

//------------------------------------------------------------------------------------------------------------
// HOME
//------------------------------------------------------------------------------------------------------------
//
// Author   : ZN Framework
// Site     : www.znframework.com
// License  : The MIT License
// Copyright: Copyright (c) 2012-2016, znframework.com
//
//------------------------------------------------------------------------------------------------------------

use Restful, Method, Validation, File, Folder, Session, Cookie, Json, Uri, Security, Http;

class Home extends Controller
{
    //--------------------------------------------------------------------------------------------------------
    // Main
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function main(String $params = NULL)
    {
        if( Method::post('create') )
        {
            Validation::rules('project', ['alpha'], 'Project Name');

            if( ! $error = Validation::error('string') )
            {
                $source = FILES_DIR . 'Default.zip';
                $target = PROJECTS_DIR . Method::post('project');

                File::zipExtract($source, $target);

                redirect(currentUri(), 0, ['success' => LANG['success']]);
            }
            else
            {
                $this->masterpage->error = $error;
            }
        }

        if( ! $return = Session::select('return') )
        {
            $return = Restful::get('https://api.znframework.com/statistics');

            Session::insert('return', $return);
        }

        $this->masterpage->page  = 'dashboard';
        $this->masterpage->pdata['return'] = $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Docs
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function docs(String $params = NULL)
    {
        $docs = FILES_DIR . 'docs.json';

        if( Method::post('refresh') )
        {
            File::delete($docs);
            clearstatcache();
        }

        if( ! File::exists($docs) )
        {
            $return = Restful::get('https://api.znframework.com/docs');

            if( ! empty($return) )
            {
                File::write($docs, Json::encode($return));
            }
        }
        else
        {
            $return = Json::decode(File::read($docs));
        }

        \Import::handload('Functions');

        $this->masterpage->plugin['name'] = [
            'Dashboard/highlight/styles/agate.css',
            'Dashboard/highlight/highlight.pack.js'
        ];

        $this->masterpage->pdata['docs'] = $return;
      
        $this->masterpage->page  = 'docs';
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete($project = NULL)
    {
        if( ! empty($project) )
        {
            $path = PROJECTS_DIR . $project;

            if( Folder::exists($path) )
            {
                Session::delete('project');
                Folder::delete($path);
            }
        }

        redirect((string) prevUrl(), 0, ['success' => LANG['success']]);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteBackup($backup = NULL)
    {
        $path = $path = STORAGE_DIR . 'ProjectBackup' . DS . $backup;

        if( Folder::exists($path) )
        {
            Folder::delete($path);
        }

        redirect((string) prevUrl(), 0, ['success' => LANG['success']]);
    }

    //--------------------------------------------------------------------------------------------------------
    // Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function lang($lang = NULL)
    {
        setlang($lang);
        redirect((string) prevUrl());
    }

    //--------------------------------------------------------------------------------------------------------
    // Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function project($project = NULL)
    {
        Session::insert('project', $project);
        redirect((string) prevUrl());
    }

    //--------------------------------------------------------------------------------------------------------
    // Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function editorTheme($theme = NULL)
    {
        Cookie::insert('editorTheme', $theme);
        redirect((string) prevUrl());
    }
}
