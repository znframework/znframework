<?php namespace ZN\ViewObjects\Grids;

use DB, URI, Arrays, Method, Html, Form, Sheet, Style, Strings, Json;
use ZN\ViewObjects\Grids\Exception\NoTableException;
use ZN\ViewObjects\Grids\Exception\DatabaseErrorException;
use ZN\ViewObjects\Grids\Exception\NoSearchException;

class InternalDBGrid extends Abstracts\GridAbstract
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'ViewObjects:datagrid', lang = 'ViewObjects:dbgrid';

    //--------------------------------------------------------------------------------------------------------
    // Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $search = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Limit
    //--------------------------------------------------------------------------------------------------------
    //
    // @var int
    //
    //--------------------------------------------------------------------------------------------------------
    protected $limit = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Joins
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $joins = [];

    //--------------------------------------------------------------------------------------------------------
    // Join Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $joinColumns = [];

    //--------------------------------------------------------------------------------------------------------
    // Join Tables
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $joinTables = [];

    //--------------------------------------------------------------------------------------------------------
    // Process Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $processColumn = 'ID';

    //--------------------------------------------------------------------------------------------------------
    // Confirm
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $confirm = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->confirm = 'return confirm(\''.VIEWOBJECTS_DBGRID_LANG['areYouSure'].'\');';
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function processColumn(String $column) : InternalDBGrid
    {
        $this->processColumn = $column;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $limit
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit(Int $limit) : InternalDBGrid
    {
        $this->limit = $limit;

        DB::limit((int) URI::get('page'), $limit);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $select
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns(...$select) : InternalDBGrid
    {
        $this->select = $select;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $search
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function search(...$search) : InternalDBGrid
    {
        $this->search = $search;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Joins
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $joins
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function joins(...$joins) : InternalDBGrid
    {
        $this->joins = $joins;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Order By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $orderBy
    // @param string $type = NULL
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function orderBy($orderBy, String $type = NULL) : InternalDBGrid
    {
        DB::orderBy($orderBy, $type);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Group By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $search
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function groupBy(...$args) : InternalDBGrid
    {
        DB::groupBy(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Where
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $column
    // @param scalar $value
    // @param string $logical
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function where($column, String $value = NULL, String $logical = NULL) : InternalDBGrid
    {
        DB::where($column, $value, $logical);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Where Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array variadic $args
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function whereGroup(...$args) : InternalDBGrid
    {
        DB::whereGroup(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function table(String $table) : InternalDBGrid
    {
        $this->table = $table;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $table = NULL) : String
    {
        if( $table !== NULL )
        {
            $this->table($table);
        }

        if( ! isset($this->table) )
        {
            throw new NoTableException('ViewObjects', 'noTable');
        }

        $table = $this->_styleElement();

        //----------------------------------------------------------------------------------------------------
        // Search
        //----------------------------------------------------------------------------------------------------
        //
        // @search
        //
        //----------------------------------------------------------------------------------------------------
        if( $search = Method::post('search') )
        {
            $this->_search($search);
        }

        //----------------------------------------------------------------------------------------------------
        // Select
        //----------------------------------------------------------------------------------------------------
        //
        // @select
        //
        //----------------------------------------------------------------------------------------------------
        if( ! empty($this->select) )
        {
            $this->_select();
        }

        //----------------------------------------------------------------------------------------------------
        // Order By
        //----------------------------------------------------------------------------------------------------
        //
        // @orderby
        //
        //----------------------------------------------------------------------------------------------------
        if( $column = URI::get('order') )
        {
            $this->orderBy($column, URI::get('type'));
        }

        //----------------------------------------------------------------------------------------------------
        // Protected Joins
        //----------------------------------------------------------------------------------------------------
        //
        // @param string variadic $joins
        //
        // @return InternalDBGrid
        //
        //----------------------------------------------------------------------------------------------------
        if( ! empty($this->joins) )
        {
            $this->_joins();
        }

        //----------------------------------------------------------------------------------------------------
        // Getting Data
        //----------------------------------------------------------------------------------------------------
        //
        // object $get
        // array  $columns
        // array  $result
        // int    $countColumns
        //
        //----------------------------------------------------------------------------------------------------
        $get          = DB::get($this->table);
        $columns      = $get->columns();
        $result       = $get->resultArray();
        $countColumns = count($columns);

        if( $error = DB::error() )
        {
            throw new DatabaseErrorException($error);
        }

        //----------------------------------------------------------------------------------------------------
        // Pagination
        //----------------------------------------------------------------------------------------------------
        //
        // @pagination
        //
        //----------------------------------------------------------------------------------------------------
        if( ! empty($this->limit) )
        {
            $pagination = $get->pagination(CURRENT_CFPATH.'/page/', VIEWOBJECTS_DATAGRID_CONFIG['pagination']);
        }
        else
        {
            $pagination = NULL;
        }

        //----------------------------------------------------------------------------------------------------
        // Save
        //----------------------------------------------------------------------------------------------------
        //
        // Ekleme ve düzenleme işlemleri için oluşturulan bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        if( Method::post('saveButton') )
        {
            $this->_save();
        }

        //----------------------------------------------------------------------------------------------------
        // Joins Data
        //----------------------------------------------------------------------------------------------------
        //
        // @joinsdata
        //
        //----------------------------------------------------------------------------------------------------
        $joinsData = [];

        if( ! empty($this->joins) ) foreach( $this->joins as $join )
        {
            $joinEx        = explode('.', $join);
            $joinTable     = $joinEx[0] ?? NULL;
            $processColumn = $joinEx[1] ?? NULL;
            $joinsData[]   = ['table' => $joinTable, 'column' => $processColumn];
        }

        //----------------------------------------------------------------------------------------------------
        // Add / Edit Menu
        //----------------------------------------------------------------------------------------------------
        //
        // Ekleme ve güncelleme tablosunun açılması için oluşturulan bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        if( $uri = URI::get('process') === 'add' || URI::get('process') === 'edit' )
        {
            $table .= $this->_addEditTable($joinsData);
        }

        //----------------------------------------------------------------------------------------------------
        // Delete
        //----------------------------------------------------------------------------------------------------
        //
        // Silme işleminin yapıldığı bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        if( Method::post('deleteButton') )
        {
           $this->_delete($join);
        }

        //----------------------------------------------------------------------------------------------------
        // Table
        //----------------------------------------------------------------------------------------------------
        //
        // Genel görünümün oluşturulduğu bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        $table .= '<table id="DBGRID_TABLE"'.Html::attributes(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['table']).'>'.EOL;
        $table .= $this->_thead($columns, $countColumns);
        $table .= $this->_tbody($result, $countColumns, $joinsData);
        $table .= $this->_pagination($pagination, $countColumns);
        $table .= '</table>'.EOL;

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Style Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _styleElement()
    {
        $styleElementConfig = VIEWOBJECTS_DATAGRID_CONFIG['styleElement'] ?? NULL;

        if( ! empty($styleElementConfig) )
        {
            $attributes   = NULL;
            $styleElement = $styleElementConfig;

            foreach( $styleElement as $selector => $attr )
            {
                $attributes .= Sheet::selector($selector)->attr($attr)->create();
            }

            return Style::open().$attributes.Style::close();
        }

        return NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Thead
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $columns
    // @param int   $countColumns
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _thead($columns, $countColumns)
    {
        $table  = '<thead>'.EOL;
        $table .= '<tr'.Html::attributes(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['columns']).'>';
        $table .= '<td colspan="2">';
        $table .= Form::open('addForm').
                  Form::placeholder(VIEWOBJECTS_DATAGRID_CONFIG['placeHolders']['search'])
                      ->id('datagridSearch')
                      ->attr(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['search'])
                      ->text('search').
                  Form::close();
        $table .= '</td><td colspan="'.($countColumns - 1).'"></td><td align="right" colspan="2">';
        $table .= Form::action(CURRENT_CFPATH.( URI::get('page') ? '/page/'.URI::get('page') : NULL).'/process/add')
                      ->open('addForm').
                  Form::attr(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['add'])
                      ->submit('addButton', VIEWOBJECTS_DATAGRID_CONFIG['buttonNames']['add']).
                  Form::close();
        $table .= '</tr><tr'.Html::attributes(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['columns']).'>';
        $table .= '<td width="20">#</td>';

        //----------------------------------------------------------------------------------------------------
        // Head Columns
        //----------------------------------------------------------------------------------------------------
        //
        // Üst sütun bölümü.
        //
        //----------------------------------------------------------------------------------------------------
        if( isArray($columns) ) foreach( $columns as $column )
        {
            $table .= '<td>'.Html::anchor
            (
                CURRENT_CFPATH.'/order/'.$column.'/type/'.(URI::get('type') === 'asc' ? 'desc' : 'asc'),
                Html::strong($column), VIEWOBJECTS_DATAGRID_CONFIG['attributes']['columns']
            ).'</td>';
        }

        $table .= '<td align="right" colspan="2"><span'.
                  Html::attributes(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['columns']).'>'.
                  Html::strong(VIEWOBJECTS_DBGRID_LANG['processLabel']).'</span></td>';
        $table .= '</tr>'.EOL;
        $table .= '</thead>'.EOL;

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected TBody
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $columns
    // @param int   $countColumns
    // @param array $joinsData
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _tbody($result, $countColumns, $joinsData)
    {
        $table = '<tbody>'.EOL;

        //----------------------------------------------------------------------------------------------------
        // Body Datas
        //----------------------------------------------------------------------------------------------------
        //
        // Orta verilerin yer aldığı bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        $hiddenJoins = NULL;

        foreach( $result as $key => $value )
        {
            $value       = Arrays::casing($value, 'lower', 'key');
            $hiddenValue = $value[strtolower($this->processColumn)] ?? NULL;
            $hiddenId    = Form::hidden('id', $hiddenValue);

            if( ! empty( $this->joins ) )
            {
                $hiddenJoins = Form::hidden('joinsId', $this->_encode($joinsData));
            }

            $table .= '<tr><td>'.($key + 1).'</td><td>'.
                    implode('</td><td>', $value).
                    '</td><td align="right">'.

                    Form::action(CURRENT_CFPATH.( URI::get('page') ? '/page/'.URI::get('page') : NULL).'/column/'.suffix($hiddenValue).'process/edit')
                        ->open('editButtonForm').
                    $hiddenId.
                    $hiddenJoins.
                    Form::attr(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['edit'])
                        ->submit('editButton', VIEWOBJECTS_DATAGRID_CONFIG['buttonNames']['edit']).
                    Form::close().
                    '</td>'.
                    '<td width="60" align="right">'.
                    Form::onsubmit($this->confirm)
                        ->open('addButtonForm').
                    $hiddenId.
                    $hiddenJoins.
                    Form::attr(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['delete'])
                        ->submit('deleteButton', VIEWOBJECTS_DATAGRID_CONFIG['buttonNames']['delete']).
                    Form::close().

                    '</td></tr>'.
                    EOL;
        }

        $table .= '</tbody>'.EOL;

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Pagination
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $pagination
    // @param int    $countColumns
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _pagination($pagination, $countColumns)
    {
        if( ! empty($pagination) )
        {
            return '<tr><td colspan="'.($countColumns + 3).'" align="right">'.$pagination.'</td></tr>';
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Add Edit Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $joinsData
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _addEditTable($joinsData)
    {
        $table  = Form::open('saveForm');

        $table .= '<table type="DBGRID_ADD_EDIT_TABLE"'.Html::attributes(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['table']).'>'.EOL;
        $table .= '<tr>';

        $newGetRow = NULL;

        if( ! empty($this->joins) )
        {
            foreach( $joinsData as $join )
            {
                if( URI::get('process') === 'edit' )
                {
                    DB::where($this->joinTables[$join['table']], URI::get('column'));
                }

                $newGet = DB::get($join['table']);

                if( URI::get('process') === 'edit' )
                {
                    $newGetRow = $newGet->row();
                }

                $table .= '<td>'.$this->_editTable($newGet->columns(), $join['table'], $newGetRow, $newGet->columnData()).'</td>';
            }
        }
        else
        {
            if( URI::get('process') === 'edit' )
            {
                DB::where($this->processColumn, URI::get('column'));
            }

            $newGet = DB::get($this->table);

            if( URI::get('process') === 'edit' )
            {
                $newGetRow = $newGet->row();
            }

            $table .= '<td>'.$this->_editTable($newGet->columns(), $this->table, $newGetRow, $newGet->columnData()).'</td>';
        }

        $table .= '<tr><td colspan="'.count($joinsData).'">'.
                       Form::attr(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['save'])->submit('saveButton', VIEWOBJECTS_DATAGRID_CONFIG['buttonNames']['save']).
                       Html::style('text-decoration:none')->anchor(CURRENT_CFPATH,
                             Form::attr(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['save'])->button('closeButton', VIEWOBJECTS_DATAGRID_CONFIG['buttonNames']['close'] ?? 'Close')
                       ).
                      '</td></tr>';
        $table .= '</tr></table>';
        $table .= Form::close();

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Edit Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $columns
    // @param string $tbl
    // @param array  $row
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _editTable($columns, $tbl, $row, $columnData)
    {
        $table  = '<table'.Html::attributes(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['editTables']).'>';
        $table .= '<tr><td width="100">'.Strings::upperCase($tbl).'</td></tr>';

        $processColumn = strtolower($this->processColumn);

        $columnDatas =
        [
            'VAR_STRING' => 'text',
            'BLOB'       => 'textarea'
        ];

        foreach( $columns as $column )
        {
            if( ! in_array($column, $this->joinColumns) && strtolower($column) !== $processColumn )
            {
                $columnDataType = $columnData[$column]->type;
                $columnDataMax  = $columnData[$column]->maxLength;

                if( isset($columnDatas[$columnDataType]) )
                {
                    $type = $columnDatas[$columnDataType];
                }
                elseif( $columnDataMax > 255 || $columnDataMax === NULL )
                {
                    $type = 'textarea';
                }
                else
                {
                    $type = 'text';
                }

                $table .= '<tr><td>'.Strings::titleCase($column).'</td><td>'.
                          Form::placeholder($column)
                          ->attr(VIEWOBJECTS_DATAGRID_CONFIG['attributes']['inputs'][$type])
                          ->$type($tbl.':'.$column, $row->$column ?? NULL).
                          '</td></tr>';
            }
        }

        $table .= '</tr></table>';

        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _select()
    {
        $select = $this->select;

        if( ! empty($this->joins) )
        {
            $select = Arrays::addFirst($this->select, $this->table.'.'.$this->processColumn.' as ID');
        }

        DB::select(...$select);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Search
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $search
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _search($search)
    {
        if( is_array($this->search) )
        {
            foreach( $this->search as $column )
            {
                $whereGroup[] = [$column.' like ', DB::like($search, 'inside'), 'or'];
            }

            DB::whereGroup($whereGroup);
        }
        else
        {
            throw new NoSearchException(VIEWOBJECTS_DBGRID_LANG['noSearch']);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _delete($join)
    {
        if( ! empty($this->joins) )
        {
            foreach( $this->_decode('joinsId') as $join )
            {
                DB::where($join['column'], Method::post('id'))->delete($join['table']);
            }
        }
        else
        {
            DB::where($this->processColumn, Method::post('id'))->delete($this->table);
        }

       redirect(CURRENT_URL);
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Save Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _saveData()
    {
        $saveData = Method::post();

        unset($saveData['saveButton']);

        $newSaveData = [];

        foreach( $saveData as $key => $val )
        {
            $keyEx = explode(':', $key);

            $newSaveData[$keyEx[0]][$keyEx[1]] = $val;
        }

        return $newSaveData;
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Add
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $newSaveData
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _processAdd($newSaveData)
    {
        if( URI::get('process') === 'add' )
        {
            DB::insert($this->table, $newSaveData[$this->table]);

            if( ! empty($this->joins) )
            {
                $insertId = DB::insertID();

                unset($newSaveData[$this->table]);

                foreach( $newSaveData as $t => $d )
                {
                    $d[$this->joinTables[$t]] = $insertId;
                    DB::insert($t, $d);
                }
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Edit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $newSaveData
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _processEdit($newSaveData)
    {
        if( URI::get('process') === 'edit' )
        {
            DB::where($this->processColumn, URI::get('column'))->update($this->table, $newSaveData[$this->table]);

            if( ! empty($this->joins) )
            {
                unset($newSaveData[$this->table]);

                foreach( $newSaveData as $t => $d )
                {
                    DB::where($this->joinTables[$t], URI::get('column'))->update($t, $d);
                }
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Save
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _save()
    {
        $newSaveData = $this->_saveData();

        $this->_processAdd($newSaveData);

        $this->_processEdit($newSaveData);

        redirect(CURRENT_URL);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Decode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _decode($data)
    {
        return Json::decodeArray(str_replace("'", '"', $_POST[$data]));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _encode($data)
    {
        return str_replace('"', "'", Json::encode($data));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Joins
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $joins
    //
    // @return InternalDBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function _joins()
    {
        if( ! empty($this->joins) )
        {
            $joins = $this->joins;

            $this->joins = [];

            foreach( $joins as $key => $join )
            {
                $joinTableColumn    = $join[0] ?? NULL;
                $currentTableColumn = $join[1] ?? NULL;
                $joinType           = isset($join[2]) ? $join[2].'Join' : 'leftJoin';

                DB::$joinType($joinTableColumn, $currentTableColumn);

                $joinTableColumnEx    = explode('.', $joinTableColumn);
                $currentTableColumnEx = explode('.', $currentTableColumn);

                $joinTable     = $joinTableColumnEx[0]    ?? NULL;
                $currentTable  = $currentTableColumnEx[0] ?? NULL;
                $joinColumn    = $joinTableColumnEx[1]    ?? NULL;
                $currentColumn = $currentTableColumnEx[1] ?? NULL;

                $this->joinColumns[] = $joinColumn;
                $this->joinColumns[] = $currentColumn;

                $this->joins = Arrays::addLast($this->joins, [$joinTableColumn, $currentTableColumn]);

                $this->joinTables[$joinTable]    = $joinColumn;
                $this->joinTables[$currentTable] = $currentColumn;
            }

            $this->joins[1] = $this->joins[0];
            $this->joins[0] = $this->table.'.'.$this->processColumn;
        }
    }
}
