<?php
class __USE_STATIC_ACCESS__DataGrid implements DataGridInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	protected $config 			= array();
	protected $columns 			= array();
	protected $columnData 		= array();
	protected $rows    			= array();
	protected $pagination 		= '';
	protected $processColumn 	= 'id';
	protected $processEditable  = false;
	protected $prowData		    = '';
	
	public function __construct()
	{
		$this->config   = Config::get('Components', 'datagrid');	
		$this->prowData = md5('SystemPaginationRowData');
	}
	
	public function columns($columns = array())
	{
		$this->columns = $columns;
		
		return $this;
	}
	
	public function processColumn($column = 'id', $editable = false)
	{
		$this->processColumn   = $column;	
		$this->processEditable = $editable;
		
		return $this;
	}
	
	public function table($table = '')
	{
		$this->table = $table;
		
		return $this;
	}
	
	public function limit($limit = '')
	{
		$this->limit = $limit;
		
		return $this;
	}
	
	protected function generateInput($input = 'text', $name = '', $value = '', $selected = '')
	{
		
		$attrs = $this->config['attributes']['inputs'];
		
		switch( $input )
		{
			case 'textarea' :
				return Form::placeholder($this->config['placeHolders']['inputs'])->textarea($name, $value, $attrs['textarea']);
			break;
			
			case 'select' :
				return Form::select($name, $value, $selected, $attrs['select']);
			break;
			
			case 'text' :
				return Form::placeholder($this->config['placeHolders']['inputs'])->text($name, $value, $attrs['text']);
			break;
			
			case 'radio' :
			
				if( ! empty($value) )
				{
					Form::checked();	
				}
			
				return Form::radio($name, $value, $attrs['radio']);
			break;
			
			case 'checkbox' :
				
				if( ! empty($value) )
				{
					Form::checked();	
				}	

				return Form::checkbox($name, $value, $attrs['checkbox']);
			break;
		}
		
		return Form::text($name, $value, $attrs['text']);
	}
	
	protected function _table()
	{
		if( Http::isAjax() === false )
		{
			return false;	
		}	

		$columns = $this->columns;
		
		$prow = Method::post('prow');
		
		if( $prow !== 'undefined' )
		{
			Session::insert($this->prowData, $prow);
		}
		
		$editId      		= Method::post('editId');
		$deleteId    		= Method::post('deleteId');
		$deleteCurrentId    = Method::post('deleteCurrentId');
		$deleteAllId 		= Method::post('deleteAllId');
		$updateId    		= Method::post('updateId');
		$addId	     		= Method::post('addId');
		$saveId      		= Method::post('saveId');
		$datas       		= Method::post();	
		
		$processColumn = $this->processColumn;
		
		if( $saveId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = Session::select($this->prowData);
			}
			
			$newAddData = array();
			
			foreach( $datas as $key => $val )
			{
				$key = str_replace('insert', '', $key);
				
				if( isset($columns[$key]) && $processColumn !== $key )
				{
					$newAddData[$key] = $val;
				}	
			}
		
			DB::insert($this->table, $newAddData);
		}
		
		if( $deleteId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = Session::select($this->prowData);
			}
						
			DB::where($processColumn.' = ', $deleteId)->delete($this->table);
		}
		
		if( $deleteCurrentId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = Session::select($this->prowData);
			}
			
			$deleteColumns = $datas['datagridDeleteColumns'];
			
			if( ! empty($deleteColumns) ) foreach( $deleteColumns as $key )
			{
				DB::where($processColumn.' = ', $key)->delete($this->table);
			}
		}
		
		if( $deleteAllId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = Session::select($this->prowData);
			}
			
			DB::delete($this->table);
			
			$data['pagination'] = '';
			$data['grid']       = '';
		
			echo Json::encode($data); exit;
		}
		
		if( $updateId !== 'undefined' )
		{	
			if( $prow === 'undefined' )
			{
				$prow = Session::select($this->prowData);
			}
			
			$newUpdateData = array();
			
			foreach( $datas as $key => $val )
			{
				$key = str_replace('update', '', $key);
				
				if( isset($columns[$key]) )
				{
					$newUpdateData[$key] = $val;
				}	
			}
			
			DB::where($processColumn.' = ', $updateId)->update($this->table, $newUpdateData);
		}
		
		if( $editId !== 'undefined' )
		{
			if( $prow === 'undefined' )
			{
				$prow = Session::select($this->prowData);
			}
		}
		
		if( $search = Method::post('search') )
		{
			if( isArray($this->columns) ) foreach( $columns as $key => $val )
			{
				DB::where($key.' like ', DB::like($search, 'inside'), 'or');
			}
		}
		
		if( stristr('desc|asc', Method::post('sorting')) )
		{
			if( Session::select($this->prowData) )
			{
				$prow = Session::select($this->prowData);
			}
			
			DB::orderBy(Method::post('column'), Method::post('sorting'));	
		}
		
		DB::limit($prow, $this->limit);
		DB::get($this->table);
		
		$rows = DB::resultArray();
		$totalRows = DB::totalRows();
		
		$totalRowsText = lang('DataGrid', 'totalRowsText').': '.$totalRows.' / '.DB::totalRows(true);
		
		$paginationSettings = array_merge($this->config['pagination'], array('start' => $prow, 'type' => 'ajax'));
		
		$pagination = DB::pagination('', $paginationSettings);	
		$table      = $this->table;
		
		if( $addId !== 'undefined' )
		{
			$saveAttr = array_merge
			(
				$this->config['attributes']['save'], 
				array('DGSaveButton' => 'save', 'DGSaveId' => 'save')
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
			$table .= '<td align="right">'.Form::id('datagridSave')->button('datagridSave', $this->config['buttonNames']['save'], $saveAttr).'</td>';
			$table .= '</tr>'.EOL;
		}
		
		if( isArray($rows) ) foreach( $rows as $key => $row )
		{
			$no = ($key + 1);
			
			$orderColorArray = $this->config['colors']['rowOrder'];
			
			$orderColor = ( $no % 2 === 1 ) ? $orderColorArray['single'] : $orderColorArray['double'];
			
			$table .= '<tr bgcolor="'.$orderColor.'">';
			$table .= '<td>'.Form::checkbox('datagridDeleteColumns[]', $row[$processColumn], array('checkboxType' => 'datagrid')).'</td>';
			$table .= '<td>'.$no.'</td>';
			
			if( $editId !== 'undefined' && $row[$processColumn] == $editId )
			{
				if( Session::select($this->prowData) )
				{
					$prow = Session::select($this->prowData);
				}
					
				$row = DB::where($processColumn.' = ', $editId)->get($this->table)->row();
			
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
					array('DGUpdateButton' => 'update', 'DGUpdateId' => $row->$processColumn)
				);
				
				$table .= '<td align="right">'.Form::button('update', $this->config['buttonNames']['update'], $updateAttr).'</td>';
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
					array('DGEditButton' => 'edit', 'DGEditId' => $row[$processColumn])
				);
				
				$addAttr  = array_merge
				(
					$this->config['attributes']['delete'], 
					array('DGDeleteButton' => 'delete', 'DGDeleteId' => $row[$processColumn])
				);
				
				$table .= '<td align="right">'.Html::anchor
				(
					'#edit='.$row[$processColumn], 
					$this->config['buttonNames']['edit'], 
					$editAttr
				);
				$table .= ' '.Html::anchor
				(
					'#delete='.$row[$processColumn], 
					$this->config['buttonNames']['delete'], 
					$addAttr
				).'</td>';
			}
			
			$table .= '</tr>'.EOL;
		}	

		if( empty($rows) )
		{
			return false;	
		}
		
		$data['pagination'] = $pagination;
		$data['grid']       = $table;
		$data['totalRows']  = $totalRowsText;
		
		ob_end_clean();
		
		echo Json::encode($data); exit;
	}
	
	public function create()
	{
		if( empty($this->columns) )
		{
			$get     = DB::get($this->table);
			$columns = $get->columns();	
			$this->columnData = $get->columnData();
		
			if( isArray($columns) ) foreach( $columns as $column )
			{
				$this->columns[$column] = array('alias' => str_replace('_', ' ', Strings::pascalCase($column)), 'input' => 'text');	
			}
		}
	
		$this->_table();	
		
		Session::delete($this->prowData);
		
		return $this->_ajaxTable();
	}
	
	protected function _ajaxTable()
	{	
		$columns = $this->columns;
		
		$buttonNames = $this->config['buttonNames'];
		
		$addAttr = array_merge
		(
			$this->config['attributes']['add'], 
			array('DGAddButton' => 'add', 'DGAddId' => 'add')
		);
		
		$deleteCurrentAttr = array_merge
		(
			$this->config['attributes']['deleteSelected'], 
			array('DGDeleteCurrentButton' => 'deleteCurrent', 'DGDeleteCurrentId' => 'deleteCurrent')
		);
		
		$deleteAllAttr = array_merge
		(
			$this->config['attributes']['deleteAll'], 
			array('DGDeleteAllButton' => 'deleteAll', 'DGDeleteAllId' => 'deleteAll')
		);
		
		$table  = Form::id('datagridForm')->open();
		$table .= '<table type="datagrid"'.Html::attributes($this->config['attributes']['table']).'>'.EOL;
		$table .= '<thead>'.EOL;
		$table .= '<tr><td colspan="'.(count($columns) + 2).'">';
		$table .= Form::hidden('datagridSortingHidden');
		$table .= Form::hidden('datagridColumnNameHidden');
		$table .= Form::placeholder($this->config['placeHolders']['search'])->id('datagridSearch')->attr($this->config['attributes']['search'])->text('search');
		$table .= Form::attr($addAttr)->id('datagridAdd')->button('datagridAdd', $buttonNames['add']);	
		$table .= Form::attr($deleteCurrentAttr)->id('datagridDeleteCurrent')->button('datagridDeleteCurrent', $buttonNames['deleteSelected']);
		$table .= Form::attr($deleteAllAttr)->id('datagridDeleteAll')->button('datagridDeleteAll', $buttonNames['deleteAll']);
		$table .= '</td></tr>';	   
		$table .= '<tr>';	
		
		$table .= '<td width="20">'.Form::id('datagridSelectAll')->checkbox('datagridSelectAll').'</td>';
		$table .= '<td width="20">#</td>';

		if( isArray($columns) ) foreach( $columns as $column => $attr )
		{
			$columnsAttr = array_merge
			(
				$this->config['attributes']['columns'],
				array('column' => $column, 'type' => 'order')
			);
		
			$table .= '<td>'.Html::anchor('#column='.$column, Html::strong($attr['alias']), $columnsAttr).'</td>';
		}	
		
		$table .= '<td align="right"><span'.Html::attributes($this->config['attributes']['columns']).'>'.Html::strong(lang('DataGrid', 'processLabel')).'</span></td>';
		$table .= '</tr>'.EOL;
		$table .= '</thead>'.EOL;
		$table .= '<tbody datagrid="result">'.EOL;
		$table .= '</tbody>'.EOL;
		$table .= '<tr><td datagrid="pagination" colspan="'.(count($columns)).'"></td><td align="right" colspan="2" datagrid="totalRows"></td></tr>';
		$table .= '</table>'.EOL;
		$table .= Form::close();
		if( $this->config['cdn']['bootstrap'] === true )
		{
			$table .= Import::style('bootstrap', true);
		}
		$table .= Script::open(true, $this->config['cdn']['jquery'], $this->config['cdn']['jqueryUi']);
		
		$ajax = Jquery::ajax()->success
		(
			'data', 
			//JS::alert('data.test').
			JQ::html('tbody[datagrid="result"]', ':data.grid').
			JQ::html('td[datagrid="pagination"]', ':data.pagination').
			JQ::html('td[datagrid="totalRows"]', ':data.totalRows')
		)
		->dataType('json')
		->data
		(
			JQ::serialize('#datagridForm', '', false).' + 
			"&search="          + '.JQ::val('#datagridSearch', '', false).' + 
			"&sorting="         + '.JQ::val('#datagridSortingHidden', '', false).' +
		    "&column="          + '.JQ::val('#datagridColumnNameHidden', '', false).' +
			"&editId="          + '.JQ::attr(':selector', '"DGEditId"', false).' + 
			"&deleteId="        + '.JQ::attr(':selector', '"DGDeleteId"', false).' + 
			"&updateId="        + '.JQ::attr(':selector', '"DGUpdateId"', false).' + 
			"&saveId="          + '.JQ::attr(':selector', '"DGSaveId"', false).' + 
			"&addId="        	+ '.JQ::attr(':selector', '"DGAddId"', false).' +
			"&deleteCurrentId=" + '.JQ::attr(':selector', '"DGDeleteCurrentId"', false).' +
			"&deleteAllId="     + '.JQ::attr(':selector', '"DGDeleteAllId"', false).' +
			"&prow="            + '.JQ::attr(':selector', '"prow"', false)
		)
		->send();	
		
		$table .= JS::define('checking', '1');
		
		$table .= JS::defineFunc('javaScriptDataGridFunction', 'selector', $ajax);
		
		$func   = JS::func('javaScriptDataGridFunction', 'this');
		
		$callback = JQ::callback('e', $func);
		
		$confirm  = JQ::callback('e', JS::confirm(lang('DataGrid', 'areYouSure'), $func.JQ::prop('#datagridSelectAll', array('checked', ':false')).' checking = 1; '));
		
		$table .= $func;
		
		$table .= Jquery::event()->on('click', 'a[DGDeleteButton="delete"]', $confirm)->create();
		
		$table .= Jquery::event()->on('click', 'a[DGEditButton="edit"]', $callback)->create();
		
		$table .= Jquery::event()->on('click', 'input[DGUpdateButton="update"]', $callback)->create();
		
		$table .= Jquery::event()->on('click', 'input[DGSaveButton="save"]', $callback)->create();
		
		$table .= Jquery::event()->on('click', '#datagridAdd', $callback)->create();
		
		$table .= Jquery::event()->on('click', '#datagridDeleteCurrent', $confirm)->create();
		
		$table .= Jquery::event()->on('click', '#datagridDeleteAll', $confirm)->create();
		
	
		
		$table .= Jquery::event()->change
		(
			'#datagridSelectAll', 
			JS::ifClause
			(
				'checking == 1', 
				JQ::prop('input[checkboxtype="datagrid"]', array('checked', ':true')).' checking = 0;', 
				JQ::prop('input[checkboxtype="datagrid"]', array('checked', ':false')).' checking = 1;'
			)
			
		);
		
		$table .= JS::define('sorting', '"asc"');
		
		$table .= Jquery::event()->on('click', 'a[type="order"]', JQ::callback
		(
			'e', 
			JS::ifClause
			(
				'sorting == "asc"', 
				'sorting = "desc";', 
				'sorting = "asc";'
			).
			
			JQ::val('#datagridSortingHidden', ':sorting').
			
			JQ::val('#datagridColumnNameHidden', JQ::attr('this', 'column', false)).
			
			$func
		))
		->create();	
		
		$table .= Jquery::event()->on('click', 'a[ptype="ajax"]', $callback)->create();
		
		$table .= Jquery::event()->keyUp('#datagridSearch', $func);
		
		$table .= Script::close();
		
		return $table;
	}
}