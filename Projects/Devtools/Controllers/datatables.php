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

use Http, Method, DBForge, DB, Import, DBTool, Session, Config, Folder, File;
use ZN\DataTypes\Arrays\RemoveElement;
use ZN\Security\Html;
use ZN\Base;

class Datatables extends Controller
{
    //--------------------------------------------------------------------------------------------------------
    // Controller
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function main(String $params = NULL)
    {
        Masterpage::pdata(['tables' => DBTool::listTables()]);
        Masterpage::page('datatable');
    }

    //--------------------------------------------------------------------------------------------------------
    // Save File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function alterTable()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $content = Html::decode(Method::post('content'));
        $type    = Method::post('type');

        if( $type === 'orm' )
        {
            $status  = eval('?><?php ' . Base::suffix($content, ';'));
        }
        else
        {
            $status = DB::query($content);
        }

        $result = Import::usable()->view('datatables-tables.wizard', ['tables' => DBTool::listTables()]);

        echo Encode::do
        ([
            'status' => $status,
            'result' => $result,
            'error'  => DBForge::error() . DB::error() . DBTool::error()
        ]);
    }

    public function dropTable()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $table   = Method::post('table');
        $status  = DBForge::dropTable($table);
        $result  = Import::usable()->view('datatables-tables.wizard', ['tables' => DBTool::listTables()]);

        echo Encode::do
        ([
            'status' => $status,
            'result' => $result,
            'error'  => DBForge::error()
        ]);
    }

    public function updateRows()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $post = Method::post();

        $columns = $post['columns'];
        $table   = $post['table'];
        $uniqueKey = $post['uniqueKey'];
        $newData = [];

        $i = 0;

        foreach( $columns as $key => $values )
        {
            foreach( $values as $value )
            {
                $newData[$i][$key] = $value;

                DB::where($uniqueKey, $newData[$i][$uniqueKey])->update($table, $newData[$i]);

                $i++;
            }

            $i = 0;
        }

        Import::view('datatables-rows.wizard', ['table' => $table, 'start' => (int) Session::select($table . 'paginationStart')]);
    }

    public function addRow()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $post = Method::post();

        $columns = $post['addColumns'];
        $table   = $post['table'];

        DB::insert('ignore:' . $table, $columns);

        Import::view('datatables-rows.wizard', ['table' => $table, 'start' => (int) Session::select($table . 'paginationStart')]);
    }

    public function deleteRow()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $table  = Method::post('table');
        $column = Method::post('column');
        $value  = Method::post('value');

        DB::where($column, $value)->delete($table);

        Import::view('datatables-rows.wizard', ['table' => $table, 'start' => (int) Session::select($table . 'paginationStart')]);
    }

    public function dropColumn()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $table  = Method::post('table');
        $column = Method::post('column');

        DBForge::dropColumn($table, $column);

        Import::view('datatables-rows.wizard', ['table' => $table, 'start' => (int) Session::select($table . 'paginationStart')]);
    }

    public function createNewDatatable()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }


        $table   = Method::post('table');
        $columns = RemoveElement::first(Method::post());
        $newData = [];
        $i       = 0;
        
        foreach( $columns as $key => $values )
        {
            foreach( $values as $value )
            {
                $newData[$i][$key] = $value;

                $i++;
            }

            $i = 0;
        }

        $newColumns = [];
        
        foreach( $newData as $data )
        {
            $maxLength = $data['maxLength'];
            $type      = $data['type'];

            if( in_array($type, ['DATE', 'DATETIME', 'TIME', 'TIMESTAMP']) )
            {
                $maxLength = 0;
            }

            $newColumns[$data['columnName']] =
            [
                ( $type ?: '' ).( ! empty($maxLength ) ? '('.$maxLength .')' : '' ),
                ! empty($data['primaryKey'])      ? DB::primaryKey()    : NULL,
                ! empty($data['autoIncrement'])   ? DB::autoIncrement() : NULL,
                $data['isNull'] === DB::notNull() ? DB::notNull()       : '',
                ! empty($default)                 ? 'DEFAULT '.$default : ''
            ];
        }

        $driver = Config::database('database')['driver'];

        if( $driver === 'postgres' || $driver === 'sqlite' )
        {
            $encoding = NULL;
        }
        else
        {
            $encoding = DB::encoding();
        }

        $status = DBForge::createTable($table, $newColumns, $encoding);
        $result = Import::usable()->view('datatables-tables.wizard', ['tables' => DBTool::listTables()]);

        echo Encode::do
        ([
            'status' => $status,
            'result' => $result,
            'error'  => DBForge::error()
        ]);
    }

    public function modifyColumn()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $table      = Method::post('table');
        $column     = Method::post('column');
        $columnName = Method::post('columnName');
        $type       = trim(Method::post('type'));
        $maxLength  = Method::post('maxLength');
        $isNull     = Method::post('isNull');
        $default    = Method::post('defaul');

        if( in_array($type, ['DATE', 'DATETIME', 'TIME', 'TIMESTAMP']) )
        {
            $maxLength = 0;
        }

        $columns =
        [
            $type.( ! empty($maxLength) ? '('.$maxLength.')' : '' ),
            $isNull === DB::notNull() ? DB::notNull()  : '',
            ! empty($default) ? 'DEFAULT '.$default    : ''
        ];

        if( $column !== 'add-column')
        {
            if( $column !== $columnName )
            {
                DBForge::renameColumn($table, [$column . ' ' . $columnName => $columns]);
            }
            else
            {
                DBForge::modifyColumn($table, [$column => $columns]);
            }
        }
        else
        {

            DBForge::addColumn($table, [$columnName => $columns]);
        }

        Import::view('datatables-rows.wizard', ['table' => $table, 'start' => (int) Session::select($table . 'paginationStart')]);
    }


    public function updateRow()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $table   = Method::post('table');
        $column  = Method::post('uniqueKey');
        $ids     = Method::post('ids');
        $columns = $_POST['updateColumns'][$ids]; // Origin Data

        DB::where($column, $ids)->update('ignore:' . $table, $columns);

        Import::view('datatables-rows.wizard', ['table' => $table, 'start' => (int) Session::select($table . 'paginationStart')]);
    }

    public function paginationRow()
    {
        if( ! Http::isAjax() )
        {
            return false;
        }

        $table = Method::post('table');
        $start = Method::post('start');

        Session::insert($table . 'paginationStart', $start);

        Import::view('datatables-rows.wizard', ['table' => $table, 'start' => $start]);
    }
}
