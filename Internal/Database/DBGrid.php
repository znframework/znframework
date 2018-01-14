<?php namespace ZN\Database;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IS;
use ZN\Config;
use ZN\Singleton;
use ZN\Request\URI;
use ZN\Request\URL;
use ZN\Language\Lang;
use ZN\Request\Method;
use ZN\Helpers\Limiter;
use ZN\DataTypes\Arrays;
use ZN\DataTypes\Strings;
use ZN\Database\Exception\NoTableException;
use ZN\Database\Exception\NoSearchException;
use ZN\Database\Exception\DatabaseErrorException;

class DBGrid
{
    /**
     * Keeps search data.
     * 
     * @var string
     */
    protected $search = NULL;

    /**
     * Keeps limit value.
     * 
     * @var int
     */
    protected $limit = NULL;

    /**
     * Defines joins.
     * 
     * @var array 
     */
    protected $joins = [];

    /**
     * Keeps join columns.
     * 
     * @var array
     */
    protected $joinColumns = [];

    /**
     * Keeps join tables.
     * 
     * @var array 
     */
    protected $joinTables = [];

    /**
     * Process column
     * 
     * @var string
     */
    protected $processColumn = 'id';

    /**
     * @var string
     */
    protected $confirm = NULL;

    /**
     * Exclude objects.
     * 
     * @var array
     */
    protected $exclude = [];

    /**
     * Hide objects.
     * 
     * @var array
     */
    protected $hide = [];

    /**
     * Add input objects.
     * 
     * @var array
     */
    protected $inputs = [];

    /**
     * Add output objects.
     * 
     * @var array
     */
    protected $outputs = [];

    /**
     * Select columns.
     * 
     * @var array
     */
    protected $select = [];

    //--------------------------------------------------------------------------------------------------------
    // Inputs -> 5.4.02
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $add = NULL;

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
        $this->getConfig = Config::get('Database', 'grid');
        $this->getLang   = Lang::select('Database');
        $this->confirm   = 'return confirm(\''.$this->getLang['areYouSure'].'\');';

        $this->db   = Singleton::class('ZN\Database\DB');
        $this->html = Singleton::class('ZN\Hypertext\Html');
        $this->form = Singleton::class('ZN\Hypertext\form');
    }

    //--------------------------------------------------------------------------------------------------------
    // Add -> 5.4.1
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $add
    //
    //--------------------------------------------------------------------------------------------------------
    public function add(String $add) : DBGrid
    {
        $this->add = $add;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function processColumn(String $column) : DBGrid
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
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit(Int $limit) : DBGrid
    {
        $this->limit = $limit;

        $this->db->limit((int) URI::get('page'), $limit);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Inputs
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $inputs
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function inputs(Array $inputs) : DBGrid
    {
        $this->inputs = $inputs;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Outputs -> 5.4.1
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $select
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function outputs(Array $outputs) : DBGrid
    {
        $this->outputs = $outputs;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $select
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns(...$select) : DBGrid
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
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function search(...$search) : DBGrid
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
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function joins(...$joins) : DBGrid
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
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function orderBy($orderBy, String $type = NULL) : DBGrid
    {
        $this->db->orderBy($orderBy, $type);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Group By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $search
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function groupBy(...$args) : DBGrid
    {
        $this->db->groupBy(...$args);

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
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function where($column, String $value = NULL, String $logical = NULL) : DBGrid
    {
        $this->db->where($column, $value, $logical);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Where Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array variadic $args
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function whereGroup(...$args) : DBGrid
    {
        $this->db->whereGroup(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function table(String $table) : DBGrid
    {
        $this->table = $table;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Exclude -> 5.4.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function hide(...$hide) : DBGrid
    {
        $this->hide = $hide;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Exclude -> 5.3.9
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table
    //
    // @return DBGrid
    //
    //--------------------------------------------------------------------------------------------------------
    public function exclude(...$exclude) : DBGrid
    {
        $this->exclude = $exclude;

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
            throw new NoTableException('Database', 'noTable');
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
        // @return DBGrid
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
        $get          = $this->db->get($this->table);
        $columns      = array_unique($get->columns());
        $result       = $get->resultArray();
        $countColumns = count($columns);

        if( $error = $this->db->error() )
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
            $pagination = $get->pagination(CURRENT_CFPATH . URI::manipulation(['column', 'process', 'order', 'type', 'page' => NULL], 'left'), $this->getConfig['pagination']);
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
           $this->_delete();
        }

        //----------------------------------------------------------------------------------------------------
        // Table
        //----------------------------------------------------------------------------------------------------
        //
        // Genel görünümün oluşturulduğu bölüm.
        //
        //----------------------------------------------------------------------------------------------------
        $table .= '<table id="DBGRID_TABLE"'.$this->html->attributes($this->getConfig['attributes']['table']).'>'.EOL;
        $table .= $this->_thead($columns, $countColumns);
        $table .= $this->_tbody($result, $countColumns, $joinsData, $columns);
        $table .= $this->_pagination($pagination, $countColumns);
        $table .= '</table>'.EOL;

        $this->_defaultVariables();

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
        $styleElementConfig = $this->getConfig['styleElement'] ?? NULL;

        if( ! empty($styleElementConfig) )
        {
            $attributes   = NULL;
            $styleElement = $styleElementConfig;

            $style = Singleton::class('ZN\Hypertext\Style');
            $sheet = Singleton::class('ZN\Hypertext\Sheet');

            foreach( $styleElement as $selector => $attr )
            {
                $attributes .= $sheet->selector($selector)->attr($attr)->create();
            }

            return $style->open().$attributes.$style->close();
        }

        return NULL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Hide Button
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $output
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _hideButton($output, $button)
    {
        if( in_array($button, $this->hide) )
        {
            return NULL;
        }

        return $output;
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
        $table .= '<tr'.$this->html->attributes($this->getConfig['attributes']['columns']).'>';
        $table .= '<td colspan="2">';
            
        if( ! empty($this->search) || ! empty($this->select) )
        {
            $table .= $this->_hideButton($this->form->open('addForm').
            $this->form->placeholder($this->getConfig['placeHolders']['search'])
                ->id('datagridSearch')
                ->attr($this->getConfig['attributes']['search'])
                ->text('search').
            $this->form->close(), 'search');
        }
        
        $table .= '</td><td colspan="'.($countColumns - 1).'">'.$this->add.'</td><td align="right" colspan="2">';
        
        $table .= $this->_hideButton($this->form->action(CURRENT_CFPATH . URI::manipulation(['process' => 'add', 'order', 'type', 'page'], 'left'))
                      ->open('addForm').
                  $this->form->attr($this->getConfig['attributes']['add'])
                      ->submit('addButton', $this->getConfig['buttonNames']['add']).
                  $this->form->close(), 'addButton');
        $table .= '</tr><tr'.$this->html->attributes($this->getConfig['attributes']['columns']).'>';
        $table .= '<td width="20">#</td>';

        //----------------------------------------------------------------------------------------------------
        // Head Columns
        //----------------------------------------------------------------------------------------------------
        //
        // Üst sütun bölümü.
        //
        //----------------------------------------------------------------------------------------------------
        if( IS::array($columns) ) foreach( $columns as $column )
        {
            $table .= '<td>'.$this->html->anchor
            (
                CURRENT_CFPATH . URI::manipulation(['column', 'process', 'order' => $column, 'type' => (URI::get('type') === 'asc' ? 'desc' : 'asc'), 'page'], 'left'),
                $this->html->strong($column), $this->getConfig['attributes']['columns']
            ).'</td>';
        }

        $table .= '<td align="right" colspan="2"><span'.
                  $this->html->attributes($this->getConfig['attributes']['columns']).'>'.
                  $this->html->strong($this->getLang['processLabel']).'</span></td>';
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
            static $i    = 0;

            // 5.4.02|5.4.05[edited]
            if( count($originColumns = $this->_origincolumns()) === count($value) )
            {
                $combine = array_combine($originColumns, $value);
            }
            else
            {
                $combine = $value;
            }

            $value       = array_change_key_case($combine);
            $hiddenValue = $value[strtolower($this->processColumn)] ?? NULL;
            $hiddenId    = $this->form->hidden('id', $hiddenValue);
     
            if( ! empty( $this->joins ) )
            {
                $hiddenJoins = $this->form->hidden('joinsId', $this->_encode($joinsData));
            }

            $table .= '<tr><td>'.($key + 1).'</td><td>'.
                    implode('</td><td>', Arrays\Force::do($value, function($data) use($i, $originColumns, $combine)
                    {   
                        static $i; $index = $i++;

                        if( $output = ($this->outputs[$originColumns[$index] ?? NULL] ?? NULL) )
                        {
                            return (string) $output($this->html, $data, (object) $combine) ?: $data;   
                        }

                        return Limiter::word((string) $data, 20);            
                    })).
                    '</td>'.$this->_hideButton('<td align="right">'. 
                    $this->form->action(CURRENT_CFPATH . URI::manipulation(['column' => $hiddenValue, 'process' => 'edit', 'order', 'type', 'page'], 'left'))
                        ->open('editButtonForm').
                    $hiddenId.
                    $hiddenJoins.
                    $this->form->attr($this->getConfig['attributes']['edit'])
                        ->submit('editButton', $this->getConfig['buttonNames']['edit']).
                    $this->form->close().
                    '</td>', 'editButton').
                    $this->_hideButton('<td width="60" align="right">'.
                    $this->form->onsubmit($this->confirm)
                        ->open('addButtonForm').
                    $hiddenId.
                    $hiddenJoins.
                    $this->form->attr($this->getConfig['attributes']['delete'])
                        ->submit('deleteButton', $this->getConfig['buttonNames']['delete']).
                    $this->form->close().

                    '</td>', 'deleteButton').'</tr>'.
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
        $table  = $this->form->open('saveForm');

        $table .= '<table type="DBGRID_ADD_EDIT_TABLE"'.$this->html->attributes($this->getConfig['attributes']['table']).'>'.EOL;
        $table .= '<tr>';

        $newGetRow = NULL;

        if( ! empty($this->joins) )
        {
            foreach( $joinsData as $join )
            {
                if( URI::get('process') === 'edit' )
                {
                    $this->db->where($this->joinTables[$join['table']], URI::get('column'));
                }

                $newGet = $this->db->get($join['table']);

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
                $this->db->where($this->processColumn, URI::get('column'));
            }

            $newGet = $this->db->get($this->table);

            if( URI::get('process') === 'edit' )
            {
                $newGetRow = $newGet->row();
            }

            $table .= '<td>'.$this->_editTable($newGet->columns(), $this->table, $newGetRow, $newGet->columnData()).'</td>';
        }

        $table .= '<tr><td colspan="'.count($joinsData).'">'.
        $this->_hideButton($this->form->attr($this->getConfig['attributes']['save'])->submit('saveButton', $this->getConfig['buttonNames']['save']), 'saveButton').
        $this->_hideButton($this->html->style('text-decoration:none')->anchor
                       (
                            CURRENT_CFPATH . URI::manipulation(['order', 'type', 'page'], 'left'),
                            $this->form->attr($this->getConfig['attributes']['save'])->button('closeButton', $this->getConfig['buttonNames']['close'] ?? 'Close')
                       ), 'closeButton').
                      '</td></tr>';
        $table .= '</tr></table>';
        $table .= $this->form->close();

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
        $table  = '<table'.$this->html->attributes($this->getConfig['attributes']['editTables']).'>';
        $table .= '<tr><td width="100">'.mb_convert_case($tbl, MB_CASE_UPPER, 'utf-8').'</td></tr>';

        $processColumn = strtolower($this->processColumn);
        $columnDatas   =
        [
            'VAR_STRING' => 'text',
            'BLOB'       => 'textarea'
        ];

        $columns = array_diff($columns, $this->exclude);
                
        $this->exclude = [];

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

                $table .= '<tr><td>'.mb_convert_case($column, MB_CASE_TITLE, 'utf-8').'</td><td>';

                $inputName = $tbl.':'.$column;

                // 5.4.0[added]
                if( ! $input = ($this->inputs[$column] ?? NULL) )
                {
                    $table .= $this->form->placeholder($column)
                                  ->attr($this->getConfig['attributes']['inputs'][$type])
                                  ->$type($inputName, $row->$column ?? NULL);
                }
                else
                {
                    $this->form->placeholder($column)->attr($this->getConfig['attributes']['inputs'][$type]);

                    $table .= $input($this->form, $inputName, $row->$column ?? NULL);
                }

                $table .= '</td></tr>';
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
            array_unshit($select, $this->table.'.'.$this->processColumn.' as ID');
        }

        $this->db->select(...$select);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Origin Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _origincolumns()
    {
        return array_map(function($data)
        {
            return explode(' ', $data)[0] ?? $data;
        }, $this->select);
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
        if( empty($this->search) && ! empty($this->select) )
        {
            $this->search = $this->_origincolumns();
        }

        if( is_array($this->search) )
        {
            foreach( $this->search as $column )
            {
                $whereGroup[] = [$column.' like ', $this->db->like($search, 'inside'), 'or'];
            }

            $this->db->whereGroup($whereGroup);
        }
        else
        {
            throw new NoSearchException($this->getLang['noSearch']);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Process Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _delete()
    {
        if( ! empty($this->joins) )
        {
            foreach( $this->_decode('joinsId') as $join )
            {
                $this->db->where($join['column'], Method::post('id'))->delete($join['table']);
            }
        }
        else
        {
            $this->db->where($this->processColumn, Method::post('id'))->delete($this->table);
        }

       redirect(URL::current());
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
            $this->db->insert($this->table, $newSaveData[$this->table]);

            if( ! empty($this->joins) )
            {
                $insertId = $this->db->insertID();

                unset($newSaveData[$this->table]);

                foreach( $newSaveData as $t => $d )
                {
                    $d[$this->joinTables[$t]] = $insertId;
                    $this->db->insert($t, $d);
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
            $this->db->where($this->processColumn, URI::get('column'))->update($this->table, $newSaveData[$this->table]);

            if( ! empty($this->joins) )
            {
                unset($newSaveData[$this->table]);

                foreach( $newSaveData as $t => $d )
                {
                    $this->db->where($this->joinTables[$t], URI::get('column'))->update($t, $d);
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

        redirect(URL::current());
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
        return json_decode(str_replace("'", '"', $_POST[$data]), true);
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
        return str_replace('"', "'", json_encode($data, JSON_UNESCAPED_UNICODE));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Joins
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string variadic $joins
    //
    // @return DBGrid
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

                $this->db->$joinType($joinTableColumn, $currentTableColumn);

                $joinTableColumnEx    = explode('.', $joinTableColumn);
                $currentTableColumnEx = explode('.', $currentTableColumn);

                $joinTable     = $joinTableColumnEx[0]    ?? NULL;
                $currentTable  = $currentTableColumnEx[0] ?? NULL;
                $joinColumn    = $joinTableColumnEx[1]    ?? NULL;
                $currentColumn = $currentTableColumnEx[1] ?? NULL;

                $this->joinColumns[] = $joinColumn;
                $this->joinColumns[] = $currentColumn;

                $this->joins = array_merge($this->joins, [$joinTableColumn, $currentTableColumn]);

                $this->joinTables[$joinTable]    = $joinColumn;
                $this->joinTables[$currentTable] = $currentColumn;
            }

            $this->joins = sort(array_unique($this->joins));
        }
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
        $this->hide    = [];
        $this->exclude = [];
        $this->search  = NULL;
        $this->joins   = [];
        $this->inputs  = [];
        $this->outputs = [];
        $this->select  = [];
        $this->add     = NULL;
    }
}
