<?php
namespace ZN\Components;

class InternalDataGrid implements DataGridInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Const CONFIG_NAME
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const CONFIG_NAME  = 'Components:datagrid';
	
	//----------------------------------------------------------------------------------------------------
	// Columns
	//----------------------------------------------------------------------------------------------------
	//
	// @var array -> Sütunlar
	//
	//----------------------------------------------------------------------------------------------------
	protected $columns 			= [];
	
	//----------------------------------------------------------------------------------------------------
	// Joins
	//----------------------------------------------------------------------------------------------------
	//
	// @var array -> Birleştirmeler
	//
	//----------------------------------------------------------------------------------------------------
	protected $joins   			= [];
	
	//----------------------------------------------------------------------------------------------------
	// Where Tables
	//----------------------------------------------------------------------------------------------------
	//
	// @var array -> Tabloların nelere göre birleştirildiği
	//
	//----------------------------------------------------------------------------------------------------
	protected $whereJoins		= [];
	
	//----------------------------------------------------------------------------------------------------
	// Join Tables
	//----------------------------------------------------------------------------------------------------
	//
	// @var array -> Birleştirilen tablolar
	//
	//----------------------------------------------------------------------------------------------------
	protected $joinTables  		= [];
	
	//----------------------------------------------------------------------------------------------------
	// Alias Columns
	//----------------------------------------------------------------------------------------------------
	//
	// @var array -> Takma isim verilmiş sütunlar
	//
	//----------------------------------------------------------------------------------------------------
	protected $aliasColumns		= [];
	
	//----------------------------------------------------------------------------------------------------
	// Process Column
	//----------------------------------------------------------------------------------------------------
	//
	// @var string -> İşlem yapılan sütun
	//
	//----------------------------------------------------------------------------------------------------
	protected $processColumn 	= 'id';
	
	//----------------------------------------------------------------------------------------------------
	// Process Editable
	//----------------------------------------------------------------------------------------------------
	//
	// @var boolean -> İşlem yapılan sütunun düzenlenip düzenlenemeyeceği
	//
	//----------------------------------------------------------------------------------------------------
	protected $processEditable  = false;
	
	//----------------------------------------------------------------------------------------------------
	// Prow Data
	//----------------------------------------------------------------------------------------------------
	//
	// @var string -> Aktif sayfalama numarası
	//
	//----------------------------------------------------------------------------------------------------
	protected $prowData		    = '';
	
	//----------------------------------------------------------------------------------------------------
	// Limit
	//----------------------------------------------------------------------------------------------------
	//
	// @var string -> Tek bir sayfada gösterilecek kayıt miktarı
	//
	//----------------------------------------------------------------------------------------------------
	protected $limit  		    = 20;
	
	//----------------------------------------------------------------------------------------------------
	// Order By
	//----------------------------------------------------------------------------------------------------
	//
	// @var array -> Sıralama
	//
	//----------------------------------------------------------------------------------------------------
	protected $orderBy  		= [];
	
	//----------------------------------------------------------------------------------------------------
	// Order By
	//----------------------------------------------------------------------------------------------------
	//
	// @var string -> Gruplama
	//
	//----------------------------------------------------------------------------------------------------
	protected $groupBy  		= '';
	
	//----------------------------------------------------------------------------------------------------
	// Where
	//----------------------------------------------------------------------------------------------------
	//
	// @var array -> Koşul
	//
	//----------------------------------------------------------------------------------------------------
	protected $where     		= [];
	
	//----------------------------------------------------------------------------------------------------
	// Config Method
	//----------------------------------------------------------------------------------------------------
	// 
	// config()
	//
	//----------------------------------------------------------------------------------------------------
	use \ConfigMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		$this->config();	
		$this->prowData = md5('SystemPaginationRowData');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Columns
	//----------------------------------------------------------------------------------------------------
	//
	// @param  array $columns -> Grid'de gösterilecek sütunlar
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function columns($columns = [])
	{
		$this->columns = $columns;
		$this->realColumns = $columns;
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Process Columns
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $column   -> İşlem yapılacak sütun adı
	// @param  bool   $editable -> Bu sütunun düzenlenebilir olup olmayacağı
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function processColumn($column = 'id', $editable = false)
	{
		$this->processColumn   = $column;	
		$this->processEditable = $editable;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Table
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $table -> İşlem yapılacak esas tablo
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function table($table = '')
	{
		$this->table = $table;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Limit
	//----------------------------------------------------------------------------------------------------
	//
	// @param  numeric $limit -> Tek bir sayfada görüntülenecek kayıt sayısı.
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function limit($limit = 20)
	{
		$this->limit = $limit;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Order By
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $column -> Sıralama sütunu.
	// @param  string $order  -> Sıralama türü.
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function orderBy($column = '', $order = 'DESC')
	{
		$this->orderBy[$column] = $order;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Group By
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $column -> Gruplama sütunu.
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function groupBy($column = '')
	{
		$this->groupBy = $column;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Where
	//----------------------------------------------------------------------------------------------------
	//
	// @param  array  args -> koşul oluşturmak için kullanılır.
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function where(...$args)
	{
		$this->where[] = $args;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Table
	//----------------------------------------------------------------------------------------------------
	//
	// @param  array $tables -> Birleştirilecek tablolar dizisi
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function joins($tables = [])
	{
		$this->joins = $tables;
			
		if( ! empty($tables) ) foreach( $tables as $table => $column)
		{
			$tableEx = explode('.', $table);
			$this->joinTables[$tableEx[0]] = $tableEx[1]; 
			$this->whereJoins[$tableEx[0]] = $column;
		}
		
		$this->joinTables[$this->table] = $this->processColumn; 
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Generate Input
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $input    -> Input nesnesi türü
	// @param  string $name     -> Input isim bilgisi
	// @param  mixed  $value    -> Input değer bilgisi
	// @parma  mixed  $selected -> Inputun seçili değeri
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	protected function generateInput($input = 'text', $name = '', $value = '', $selected = '')
	{
		
		$attrs = $this->config['attributes']['inputs'];
		
		switch( $input )
		{
			case 'textarea' :
				return \Form::placeholder($this->config['placeHolders']['inputs'])->textarea($name, $value, $attrs['textarea']);
			break;
			
			case 'select' :
				return \Form::select($name, $value, $selected, $attrs['select']);
			break;
			
			case 'text' :
				return \Form::placeholder($this->config['placeHolders']['inputs'])->text($name, $value, $attrs['text']);
			break;
			
			case 'radio' :
			
				if( ! empty($value) )
				{
					\Form::checked();	
				}
			
				return \Form::radio($name, $value, $attrs['radio']);
			break;
			
			case 'checkbox' :
				
				if( ! empty($value) )
				{
					\Form::checked();	
				}	

				return \Form::checkbox($name, $value, $attrs['checkbox']);
			break;
		}
		
		return \Form::text($name, $value, $attrs['text']);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Table
	//----------------------------------------------------------------------------------------------------
	//
	// @param  void 
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	protected function _table()
	{
		if( \Http::isAjax() === false )
		{
			return false;	
		}	

		$columns = $this->columns;
		
		$prow = \Method::post('prow');
		
		if( $prow !== 'undefined' )
		{
			\Session::insert($this->prowData, $prow);
		}
		
		$editId      		= \Method::post('editId');
		$deleteId    		= \Method::post('deleteId');
		$deleteCurrentId    = \Method::post('deleteCurrentId');
		$deleteAllId 		= \Method::post('deleteAllId');
		$updateId    		= \Method::post('updateId');
		$addId	     		= \Method::post('addId');
		$saveId      		= \Method::post('saveId');
		$datas       		= \Method::post();	
		
		$processColumn = $this->processColumn;
		
		//------------------------------------------------------------------------------------------------
		// Insert
		//------------------------------------------------------------------------------------------------
		//
		// Ekleme işlemi yapılmaktadır. 
		//
		//------------------------------------------------------------------------------------------------
		if( $saveId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = \Session::select($this->prowData);
			}

			//--------------------------------------------------------------------------------------------
			// Multi Insert: Çoklu ekleme işlem yapılmaktadır.
			//--------------------------------------------------------------------------------------------
			if( ! empty($this->whereJoins) )
			{	
				$this->_columns();
				
				$whereJoins = $this->whereJoins;
	
				$newAddData = [];	
				
				foreach( $datas as $key => $val )
				{
					$key = str_replace('insert', '', $key);
						
					$t = explode('.', $this->aliasColumns[$key])[0];
					
					if( $t === $this->table && ! empty($this->aliasColumns[$key]) && $processColumn !== $key )
					{
						$newAddData[$this->aliasColumns[$key]] = $val;
					}
				}
				
				\DB::insert($this->table, $newAddData);
				
				$lastInsertId = \DB::insertId();
				
				foreach( $whereJoins as $table => $column)
				{	
					$newAddData = [];	
					
					if( ! empty($this->joinTables[$table]) )
					{
						$newAddData[$this->joinTables[$table]] = $lastInsertId;
					}
					
					foreach( $datas as $key => $val )
					{
						$key = str_replace('insert', '', $key);
						
						$t = explode('.', $this->aliasColumns[$key])[0];
						
						if( $t === $table && ! empty($this->aliasColumns[$key]) && $processColumn !== $key )
						{
							$newAddData[$this->aliasColumns[$key]] = $val;
						}
					}
					
					\DB::insert($table, $newAddData);		
				}	
			}
			//--------------------------------------------------------------------------------------------
			// Single Insert: Tekil ekleme işlem yapılmaktadır.
			//--------------------------------------------------------------------------------------------
			else
			{
				$newAddData = [];
				
				foreach( $datas as $key => $val )
				{
					$key = str_replace('insert', '', $key);
						
					if( isset($columns[$key]) && $processColumn !== $key )
					{
						$newAddData[$key] = $val;
					}
				}
				
				\DB::insert($this->table, $newAddData);	
			}
		}
		
		//------------------------------------------------------------------------------------------------
		// Delete Current
		//------------------------------------------------------------------------------------------------
		//
		// Belirtilen kayıtı silme işlemi yapılmaktadır. 
		//
		//------------------------------------------------------------------------------------------------
		if( $deleteId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = \Session::select($this->prowData);
			}
		
			$pcol = $processColumn;
						
			if( ! empty($this->whereJoins) )
			{
				$pcol = $this->joinTables[$this->table];

				foreach( $this->whereJoins as $table => $column )
				{
					$row = \DB::where($pcol.' =', $deleteId)->get($this->table)->row();
					
					\DB::where($this->joinTables[$table].' = ', $row->$column)->delete($table);
				}		
			}	
			
			\DB::where($pcol.' = ', $deleteId)->delete($this->table);
		}
		
		//------------------------------------------------------------------------------------------------
		// Delete Select
		//------------------------------------------------------------------------------------------------
		//
		// Seçilen kayıtları silme işlemi yapılmaktadır. 
		//
		//------------------------------------------------------------------------------------------------
		if( $deleteCurrentId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = \Session::select($this->prowData);
			}
			
			$deleteColumns = $datas['datagridDeleteColumns'];
			
			$pcol = $processColumn;
			
			if( ! empty($deleteColumns) ) foreach( $deleteColumns as $key )
			{				
				if( ! empty($this->whereJoins) )
				{
					$pcol = $this->joinTables[$this->table];
	
					foreach( $this->whereJoins as $table => $column )
					{
						$row = \DB::where($pcol.' =', $key)->get($this->table)->row();
						
						\DB::where($this->joinTables[$table].' = ', $row->$column)->delete($table);
					}		
				}	
				
				\DB::where($pcol.' = ', $key)->delete($this->table);
			}
		}
		
		//------------------------------------------------------------------------------------------------
		// Delete All
		//------------------------------------------------------------------------------------------------
		//
		// Tüm kayıtı silme işlemi yapılmaktadır. 
		//
		//------------------------------------------------------------------------------------------------
		if( $deleteAllId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = \Session::select($this->prowData);
			}
			
			if( ! empty($this->whereJoins) )
			{
				$result = $this->_query();
				
				$deleteRows = $result->result();
				
				$pcol = $processColumn;
				
				if( ! empty($deleteRows) ) foreach( $deleteRows as $r )
				{				
					$key = $r->$processColumn;
					
					if( ! empty($this->whereJoins) )
					{
						$pcol = $this->joinTables[$this->table];
		
						foreach( $this->whereJoins as $table => $column )
						{
							$row = \DB::where($pcol.' =', $key)->get($this->table)->row();
							
							\DB::where($this->joinTables[$table].' = ', $row->$column)->delete($table);
						}		
					}	
					
					\DB::where($pcol.' = ', $key)->delete($this->table);
				}			
			}
			else
			{
				\DB::delete($this->table);
			}
			
			$data['grid'] = '<tr><td colspan="'.(count($columns) + 3).'">'.lang('DataGrid', 'noData').'</td></tr>';
			
			echo \Json::encode($data); exit;
		}
		
		//------------------------------------------------------------------------------------------------
		// Update
		//------------------------------------------------------------------------------------------------
		//
		// Güncelleme işlemi yapılmaktadır. 
		//
		//------------------------------------------------------------------------------------------------
		if( $updateId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = \Session::select($this->prowData);
			}
			
			//--------------------------------------------------------------------------------------------
			// Multi Update: Birleştirilmiş tablolar için güncelleme işlemi
			//--------------------------------------------------------------------------------------------
			if( ! empty($this->whereJoins) )
			{
				$this->_columns();
				
				$whereJoins = $this->whereJoins;
	
				$newUpdateData = [];	
				
				foreach( $datas as $key => $val )
				{
					$key = str_replace('update', '', $key);
						
					$t = explode('.', $this->aliasColumns[$key])[0];
					
					if( $t === $this->table && ! empty($this->aliasColumns[$key]) && $processColumn !== $key )
					{
						$newUpdateData[$this->aliasColumns[$key]] = $val;
					}
				}
				
				\DB::where($this->aliasColumns[$processColumn].' = ', $updateId)->update($this->table, $newUpdateData);
	
				foreach( $whereJoins as $table => $column)
				{	
					$newUpdateData = [];	
					
					foreach( $datas as $key => $val )
					{
						$key = str_replace('update', '', $key);
						
						$t = explode('.', $this->aliasColumns[$key])[0];
						
						if( $t === $table && ! empty($this->aliasColumns[$key]) && $processColumn !== $key )
						{
							$newUpdateData[$this->aliasColumns[$key]] = $val;
						}
					}
								
					$row = \DB::where($this->joinTables[$table].' = ', $updateId)->get($table);
					
					$tr = $row->totalRows();
					
					if( $tr === 0 )
					{	
						$newUpdateData[$this->joinTables[$table]] = $updateId;
						\DB::insert($table, $newUpdateData);
					}
					else
					{
						\DB::where($this->joinTables[$table].' = ', $updateId)->update($table, $newUpdateData);	
					}
				}		
			}
			//--------------------------------------------------------------------------------------------
			// Single Update: tekil tablolar için güncelleme işlemi
			//--------------------------------------------------------------------------------------------
			else
			{
				$newUpdateData = [];
			
				foreach( $datas as $key => $val )
				{
					$key = str_replace('update', '', $key);
					
					if( isset($columns[$key]) )
					{
						$newUpdateData[$key] = $val;
					}	
				}
			
				\DB::where($processColumn.' = ', $updateId)->update($this->table, $newUpdateData);
			}
		}
		

		if( $editId !== 'undefined' )
		{
			if( $prow === 'undefined' )
			{
				$prow = \Session::select($this->prowData);
			}
		}
		
		if( $search = \Method::post('search') )
		{
			if( isArray($this->columns) ) foreach( $columns as $key => $val )
			{
				\DB::where($key.' like ', \DB::like($search, 'inside'), 'or');
			}
		}
		
		if( stristr('desc|asc', \Method::post('sorting')) )
		{
			if( \Session::select($this->prowData) )
			{
				$prow = \Session::select($this->prowData);
			}
			
			\DB::orderBy(\Method::post('column'), \Method::post('sorting'));	
		}
		else
		{
			$orderBy = $this->orderBy;

			if( ! empty($orderBy) )
			{
				\DB::orderBy(key($orderBy), current($orderBy));
			}	
		}
		
		\DB::limit($prow, $this->limit);
		
		$query     = $this->_query();	
		$rows      = $query->resultArray();
		$totalRows = $query->totalRows();
		
		$totalRowsText = lang('DataGrid', 'totalRowsText').': '.$totalRows.' / '.\DB::totalRows(true);
		
		$paginationSettings = array_merge($this->config['pagination'], ['start' => $prow, 'type' => 'ajax']);
		
		$pagination = \DB::pagination('', $paginationSettings);	
		$table      = $this->table;
		
		$columns = $this->columns;
		
		if( $addId !== 'undefined' )
		{
			$saveAttr = array_merge
			(
				$this->config['attributes']['save'], 
				['DGSaveButton' => 'save', 'DGSaveId' => 'save']
			);
				
			$table .= '<tr>';
			$table .= '<td width="20">N/A</td>';
			$table .= '<td width="20">N/A</td>';
			
			if( isArray($columns) ) foreach( $columns as $column => $attr)
			{
				if( $column === $processColumn  && $this->processEditable === false )
				{
					$input = 'N/A';	
				}
				else
				{
					$input = $this->generateInput((isset($attr['input']) ? $attr['input'] : 'text'), 'insert'.$column);
				}
				
				$table .= '<td>'.$input.'</td>';
			}	
			$table .= '<td align="right">'.\Form::id('datagridSave')->button('datagridSave', $this->config['buttonNames']['save'], $saveAttr).'</td>';
			$table .= '</tr>'.EOL;
		}
		
		if( isArray($rows) ) foreach( $rows as $key => $row )
		{
			$no = ($key + 1);
			
			$orderColorArray = $this->config['colors']['rowOrder'];
			
			$orderColor = ( $no % 2 === 1 ) ? $orderColorArray['single'] : $orderColorArray['double'];
			
			$table .= '<tr bgcolor="'.$orderColor.'">';
			$table .= '<td>'.\Form::checkbox('datagridDeleteColumns[]', $row[$processColumn], ['checkboxType' => 'datagrid']).'</td>';
			$table .= '<td>'.$no.'</td>';
			
			if( $editId !== 'undefined' && $row[$processColumn] == $editId )
			{
				if( \Session::select($this->prowData) )
				{
					$prow = \Session::select($this->prowData);
				}
				
				if( ! empty($this->whereJoins) )
				{
					\DB::where($this->aliasColumns[$processColumn].' = ', $editId);
				
					$result = $this->_query();
					
					$row = $result->row();
				}	
				else
				{
					$row = \DB::where($processColumn.' = ', $editId)->get($this->table)->row();	
				}
			
				if( isArray($columns) ) foreach( $columns as $column => $attr)
				{
					if( $column === $processColumn && $this->processEditable === false )
					{
						$input = $row->$column;
					}
					else
					{
						$input  = $this->generateInput((isset($attr['input']) ? $attr['input'] : 'text'), 'update'.$column, $row->$column);
					}
					
					$table .= '<td>'.$input.'</td>';
				}	

				$updateAttr = array_merge
				(
					$this->config['attributes']['update'], 
					['DGUpdateButton' => 'update', 'DGUpdateId' => $row->$processColumn]
				);
				
				$table .= '<td align="right">'.\Form::button('update', $this->config['buttonNames']['update'], $updateAttr).'</td>';
			}		  
			else
			{	  
				if( isArray($columns) ) foreach( $columns as $column => $attr)
				{
					$table .= '<td>'.$row[$column].'</td>';
				}	
				
				$editAttr = array_merge
				(
					$this->config['attributes']['edit'], 
					['DGEditButton' => 'edit', 'DGEditId' => $row[$processColumn]]
				);
				
				$addAttr  = array_merge
				(
					$this->config['attributes']['delete'], 
					['DGDeleteButton' => 'delete', 'DGDeleteId' => $row[$processColumn]]
				);
				
				$table .= '<td align="right">'.\Html::anchor
				(
					'#edit='.$row[$processColumn], 
					$this->config['buttonNames']['edit'], 
					$editAttr
				);
				$table .= ' '.\Html::anchor
				(
					'#delete='.$row[$processColumn], 
					$this->config['buttonNames']['delete'], 
					$addAttr
				).'</td>';
			}
			
			$table .= '</tr>'.EOL;
		}	
		else
		{
			$table .= '<tr><td colspan="'.(count($columns) + 3).'">'.lang('DataGrid', 'noData').'</td></tr>';
			$data['grid'] = $table;
			
			echo \Json::encode($data); exit;
		}
		
		$data['pagination'] = $pagination;
		$data['grid']       = $table;
		$data['totalRows']  = $totalRowsText;
		
		ob_end_clean();
		
		echo \Json::encode($data); exit;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Columns
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string void
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	protected function _columns()
	{
		if( ! empty($this->columns) && ! empty($this->joins) )
		{
			$newsColumns = [];
			$columns = '';
			
			if( ! empty( $this->realColumns) ) foreach( $this->realColumns as $column => $attr )
			{
				$columns .= $column.' as '.$attr['alias'].',';	
				$newsColumns[$attr['alias']] = array
				(
					'alias' => $attr['alias'], 
					'input' => isset($attr['input']) ? $attr['input'] : 'text', 
					'title' => isset($attr['title']) ? $attr['title'] : $this->_title($column)
				);
				
				$this->aliasColumns[$attr['alias']] = $column;
			} 
			
			$columns = rtrim($columns, ',');
			
			$this->columns = $newsColumns;	

			
			return $columns;
		}
		
		return false;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Title
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $column
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	protected function _title($column)
	{
		return str_replace('_', ' ', \Strings::pascalCase($column))	;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Query
	//----------------------------------------------------------------------------------------------------
	//
	// @param  void
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	protected function _query()
	{
		if( ! empty($this->where) ) foreach( $this->where as $where )
		{
			$column  = isset($where[0]) ? $where[0] : '';
			$value   = isset($where[1]) ? $where[1] : '';
			$logical = isset($where[2]) ? $where[2] : '';
			
			\DB::where($column, $value, $logical);
		}
		
		if( ! empty($this->joins) ) foreach( $this->joins as $key => $val )
		{
			\DB::leftJoin($key, prefix($val, $this->table.'.'));
		}
		
		if( ! empty($this->groupBy) )
		{
			\DB::groupBy($this->groupBy);	
		}

		\DB::select( $this->_columns() );
		
		return \DB::get($this->table);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Create
	//----------------------------------------------------------------------------------------------------
	//
	// @param  void
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function create()
	{
		if( empty($this->columns) )
		{
			$query   = $this->_query();
			$columns = $query->columns();	
			
			if( isArray($columns) ) foreach( $columns as $column )
			{
				$this->columns[$column] = ['alias' => $column, 'title' => $this->_title($column), 'input' => 'text'];	
			}
		}
		
		$this->_table();	
		
		\Session::delete($this->prowData);
		
		$return = $this->_ajaxTable();
		
		$this->_defaultVariables();
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Ajax Table
	//----------------------------------------------------------------------------------------------------
	//
	// @param  void   -> Ajax tablosu
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	protected function _ajaxTable()
	{	
		$columns = $this->columns;
		
		$buttonNames = $this->config['buttonNames'];
		
		$addAttr = array_merge
		(
			$this->config['attributes']['add'], 
			['DGAddButton' => 'add', 'DGAddId' => 'add']
		);
		
		$deleteCurrentAttr = array_merge
		(
			$this->config['attributes']['deleteSelected'], 
			['DGDeleteCurrentButton' => 'deleteCurrent', 'DGDeleteCurrentId' => 'deleteCurrent']
		);
		
		$deleteAllAttr = array_merge
		(
			$this->config['attributes']['deleteAll'], 
			['DGDeleteAllButton' => 'deleteAll', 'DGDeleteAllId' => 'deleteAll']
		);
		
		$table  = \Form::id('datagridForm')->open();
		$table .= '<table type="datagrid"'.\Html::attributes($this->config['attributes']['table']).'>'.EOL;
		$table .= '<thead>'.EOL;
		$table .= '<tr><td colspan="'.(count($columns) + 3).'">';
		$table .= \Form::hidden('datagridSortingHidden');
		$table .= \Form::hidden('datagridColumnNameHidden');
		$table .= \Form::placeholder($this->config['placeHolders']['search'])->id('datagridSearch')->attr($this->config['attributes']['search'])->text('search');
		$table .= \Form::attr($addAttr)->id('datagridAdd')->button('datagridAdd', $buttonNames['add']);	
		$table .= \Form::attr($deleteCurrentAttr)->id('datagridDeleteCurrent')->button('datagridDeleteCurrent', $buttonNames['deleteSelected']);
		$table .= \Form::attr($deleteAllAttr)->id('datagridDeleteAll')->button('datagridDeleteAll', $buttonNames['deleteAll']);
		$table .= '</td></tr>';	   
		$table .= '<tr>';	
		
		$table .= '<td width="20">'.\Form::id('datagridSelectAll')->checkbox('datagridSelectAll').'</td>';
		$table .= '<td width="20">#</td>';

		if( isArray($columns) ) foreach( $columns as $column => $attr )
		{
			$columnsAttr = array_merge
			(

				$this->config['attributes']['columns'],
				array('column' => $column, 'type' => 'order')
			);
			
			$title = isset($attr['title']) ? $attr['title'] : $this->_title($column);
			
			$table .= '<td>'.\Html::anchor('#column='.$column, \Html::strong($title), $columnsAttr).'</td>';
		}	
		
		$table .= '<td align="right"><span'.\Html::attributes($this->config['attributes']['columns']).'>'.\Html::strong(lang('DataGrid', 'processLabel')).'</span></td>';
		$table .= '</tr>'.EOL;
		$table .= '</thead>'.EOL;
		$table .= '<tbody datagrid="result">'.EOL;
		$table .= '</tbody>'.EOL;
		$table .= '<tr><td datagrid="pagination" colspan="'.((count($columns)) + 2).'"></td><td align="right" datagrid="totalRows"></td></tr>';
		$table .= '</table>'.EOL;
		$table .= \Form::close();
		
		if( $this->config['cdn']['bootstrap'] === true )
		{
			$table .= \Import::style('bootstrap', true);
		}
		
		$table .= \Script::open(true, $this->config['cdn']['jquery'], $this->config['cdn']['jqueryUi']);
		
		$ajax = \Jquery::ajax()->success
		(
			'data', 
			\JQ::html('tbody[datagrid="result"]', ':data.grid').
			\JQ::html('td[datagrid="pagination"]', ':data.pagination').
			\JQ::html('td[datagrid="totalRows"]', ':data.totalRows')
		)
		->dataType('json')
		->data
		(
			\JQ::serialize('#datagridForm', '', false).' + 
			"&search="          + '.\JQ::val('#datagridSearch', '', false).' + 
			"&sorting="         + '.\JQ::val('#datagridSortingHidden', '', false).' +
		    "&column="          + '.\JQ::val('#datagridColumnNameHidden', '', false).' +
			"&editId="          + '.\JQ::attr(':selector', '"DGEditId"', false).' + 
			"&deleteId="        + '.\JQ::attr(':selector', '"DGDeleteId"', false).' + 
			"&updateId="        + '.\JQ::attr(':selector', '"DGUpdateId"', false).' + 
			"&saveId="          + '.\JQ::attr(':selector', '"DGSaveId"', false).' + 
			"&addId="        	+ '.\JQ::attr(':selector', '"DGAddId"', false).' +
			"&deleteCurrentId=" + '.\JQ::attr(':selector', '"DGDeleteCurrentId"', false).' +
			"&deleteAllId="     + '.\JQ::attr(':selector', '"DGDeleteAllId"', false).' +
			"&prow="            + '.\JQ::attr(':selector', '"prow"', false)
		)
		->send();	
		
		$table .= \JS::define('checking', '1');
		
		$table .= \JS::defineFunc('javaScriptDataGridFunction', 'selector', $ajax);
		
		$func   = \JS::func('javaScriptDataGridFunction', 'this');
		
		$callback = \JQ::callback('e', $func);
		
		$confirm  = \JQ::callback('e', \JS::confirm(lang('DataGrid', 'areYouSure'), $func.\JQ::prop('#datagridSelectAll', ['checked', ':false']).' checking = 1; '));
		
		$table .= $func;
		
		$table .= \Jquery::event()->on('click', 'a[DGDeleteButton="delete"]', $confirm)->create();
		
		$table .= \Jquery::event()->on('click', 'a[DGEditButton="edit"]', $callback)->create();
		
		$table .= \Jquery::event()->on('click', 'input[DGUpdateButton="update"]', $callback)->create();
		
		$table .= \Jquery::event()->on('click', 'input[DGSaveButton="save"]', $callback)->create();
		
		$table .= \Jquery::event()->on('click', '#datagridAdd', $callback)->create();
		
		$table .= \Jquery::event()->on('click', '#datagridDeleteCurrent', $confirm)->create();
		
		$table .= \Jquery::event()->on('click', '#datagridDeleteAll', $confirm)->create();
		
		$table .= \Jquery::event()->change
		(
			'#datagridSelectAll', 
			\JS::ifClause
			(
				'checking == 1', 
				\JQ::prop('input[checkboxtype="datagrid"]', ['checked', ':true']).' checking = 0;', 
				\JQ::prop('input[checkboxtype="datagrid"]', ['checked', ':false']).' checking = 1;'
			)
			
		);
		
		$table .= \JS::define('sorting', '"asc"');
		
		$table .= \Jquery::event()->on('click', 'a[type="order"]', \JQ::callback
		(
			'e', 
			\JS::ifClause
			(
				'sorting == "asc"', 
				'sorting = "desc";', 
				'sorting = "asc";'
			).
			
			\JQ::val('#datagridSortingHidden', ':sorting').
			
			\JQ::val('#datagridColumnNameHidden', \JQ::attr('this', 'column', false)).
			
			$func
		))
		->create();	
		
		$table .= \Jquery::event()->on('click', 'a[ptype="ajax"]', $callback)->create();
		
		$table .= \Jquery::event()->keyUp('#datagridSearch', $func);
		
		$table .= \Script::close();
		
		return $table;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Config
	//----------------------------------------------------------------------------------------------------
	//
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected function _defaultVariables()
	{
		$this->config 			= [];
		$this->columns 			= [];
		$this->joins   			= [];
		$this->whereJoins		= [];
		$this->joinTables  		= [];
		$this->aliasColumns		= [];
		$this->processColumn 	= 'id';
		$this->processEditable  = false;
		$this->prowData		    = '';
		$this->limit  		    = 20;
		$this->orderBy  		= [];	
		$this->groupBy  		= '';	
		$this->where   	     	= [];
	}
}