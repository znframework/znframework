@Form::id($table)->open($table):
<table class="table table-bordered table-hover table-striped">

    <thead>
        {[
            $get        = DB::get($table);
            $columns    = $get->columns();
            $columnData = $get->columnData();
            $columnCount= count($columns);
            $uniqueKey  = 'id';
            
            if( ! empty($columns) && ! Arrays::valueExists($columns, $uniqueKey) )
            {
                $uniqueKey = $columns[0];
            }
        ]}

        <tr>

            @foreach( $columns as $column):
            {[
                $columnDetail = $columnData[$column];
                if( $columnDetail->primaryKey != 1 )
                {
                    $dropColumn   = '<span title="Drop Column" onclick="dropColumn(\''.$table.'\', \''.$column.'\', \'/#table-'.$table.'\')" class="pull-right " style="cursor:pointer"><i class="fa fa-trash-o fa-fw"></i></span>';
                    $modifyColumn = '<span title="Modify Column" data-target="/#modifyColumn'.$table.$column.'" data-toggle="collapse" class="pull-right " style="cursor:pointer"><i class="fa fa-edit fa-fw"></i></span>';
                }
            ]}
            <th>@$column:<span class="text-muted">({{$dataTypesChange = DATATYPESCHANGE[$columnDetail->type] ?? $columnDetail->type}})</span> {{$dropColumn ?? NULL}} {{$modifyColumn ?? NULL}}
                <div class="collapse" id="modifyColumn{{$table.$column}}">
                    @Form::class('form-control')->id($table.$column.'columnName')->text('columnName', $column):
                    @Form::class('form-control')->id($table.$column.'type')->select('type', DATATYPES, $dataTypesChange):
                    @Form::class('form-control')->id($table.$column.'maxLength')->placeholder('Length')->text('maxLength', $columnDetail->maxLength):
                    @Form::class('form-control')->id($table.$column.'isNull')->select('isNull', NULLTYPES):
                    @Form::class('form-control')->id($table.$column.'default')->placeholder('Default')->text('default'):
                    @Form::class('form-control btn btn-info')->onclick('modifyColumn(\''.$table.'\', \''.$column.'\', \'/#table-'.$table.'\')')->button('modifyColumnButton', LANG['modifyColumnButton']):
                </div>
            </th>

            @endforeach:

            <th>
            
                <span style="cursor:pointer" class="pull-right"><i data-toggle="collapse" data-target="/#edit-@$table:"  class="fa fa-edit fa-fw" title="Edit Datatable"></i></span>
                <span style="cursor:pointer" class="pull-right"><i data-toggle="collapse" data-target="/#add-@$table:"  class="fa fa-plus fa-fw" title="Add Data"></i></span>

            </th>
        </tr>

    </thead>
    <tbody>

        {[
            $get = DB::limit($start ?? NULL, DASHBOARD_CONFIG['limits']['datatable'])->get($table);
            $result = $get->resultArray();
        ]}

        <tr class="collapse" id="add-@$table:">
            <td colspan="{{count($columns) + 1}}">
                <table class="table table-bordered table-hover table-striped">

                    <thead>
                        <tr>
                            @foreach( $columns as $key => $column):
                                <th>@Form::disabled()->class('form-control')->text('addColumn', $column):</th>
                            @endforeach:

                        </tr>

                    </thead>
                    <tbody>


                        <tr>
                            @foreach( $columns as $key => $column):
                            {[
                                if( $columnData[$column]->primaryKey == 1 )
                                {
                                    Form::disabled();
                                }
                            ]}
                            <td>{{ $columnData[$column]->maxLength > 255
                                                         ? Form::class('form-control')->textarea('addColumns['.$column.']')
                                                         : Form::class('form-control')->text('addColumns['.$column.']') }}
                            </td>
                            @endforeach:

                        </tr>

                        <tr>
                            <td colspan="{{count($columns) + 1}}">
                                @Form::onclick('addRow(\''.$table.'\', \'/#table-'.$table.'\')')->class('form-control btn btn-info')->button('update', LANG['addButton']):
                            </td>

                        <tr>

                    </tbody>
                </table>
                @Import::view('alert-bar.wizard', ['id' => '-' . $table]):

            </td>
        </tr>

        <tr class="collapse" id="edit-@$table:">
            <td colspan="{{count($columns) + 1}}">
                <table class="table table-bordered table-hover table-striped">

                    <thead>

                        <tr>
                            @foreach( $columns as $key => $column):

                            {[
                                if( $columnData[$column]->primaryKey == 1 )
                                {
                                    $uniqueKey = $column;
                                    echo Form::id('uniqueKey')->hidden('uniqueKey', $uniqueKey);
                                }

                                echo Form::hidden('columns['.$column.']', $column);
                            ]}

                            <th>@Form::disabled()->class('form-control')->text('columns['.$column.']', $column):</th>
                            @endforeach:

                        </tr>

                    </thead>
                    <tbody>

                        {[
                            $get = DB::limit($start ?? NULL, 10)->get($table);
                            $result = $get->resultArray();
                        ]}

                        @foreach( $result as $key => $row ):
                        <tr>
                            @foreach( $columns as $key => $column):
                            {[
                                if( $columnData[$column]->primaryKey == 1 )
                                {
                                    echo Form::hidden('columns['.$column.'][]', $row[$column]);
                                    Form::disabled();
                                }
                            ]}
                            <td>{{ strlen($row[$column]) > 255
                                                         ? Form::class('form-control')->textarea('columns['.$column.'][]', $row[$column])
                                                         : Form::class('form-control')->text('columns['.$column.'][]', $row[$column]) }}
                            </td>
                            @endforeach:

                        </tr>

                        @endforeach:
                        <tr>
                            <td colspan="{{count($columns) + 1}}">

                                @Form::onclick('updateRows(\''.$table.'\', \'/#table-'.$table.'\', \''.$uniqueKey.'\')')->class('form-control btn btn-info')->button('update', LANG['updateButton']):

                            </td>

                        <tr>


                    </tbody>
                </table>
                @Import::view('alert-bar.wizard', ['id' => '-' . $table]):

            </td>
        </tr>

        @foreach( $result as $key => $row ):
        <tr>
            @foreach( $columns as $column):
            <td>@Limiter::word((string) $row[$column], 10):</td>
            @endforeach:
            <td>
                <span style="cursor: pointer;" class="pull-right"><i onclick="deleteRow('{{$table}}', '@Arrays::getFirst($columns):', '@Arrays::getFirst($row):', '/#table-{{$table}}')" class="fa fa-trash-o fa-fw" title="Delete"></i></span>
                <span data-target="/#{{$table}}updateColumn{{$row[$uniqueKey]}}" data-toggle="collapse" style="cursor: pointer;" class="pull-right"><i class="fa fa-edit fa-fw" title="Edit Column"></i></span>

            </td>
        </tr>
        <tr id="{{$table}}updateColumn{{$row[$uniqueKey]}}" class="collapse">
            @foreach( $columns as $column):
            {[
                if( $columnData[$column]->primaryKey == 1 )
                {
                    echo Form::hidden('updateColumns['.$column.']', $row[$column]);
                    Form::disabled();
                }
            ]}
            <td>{{ strlen($row[$column]) > 255
                                         ? Form::class('form-control')->textarea('updateColumns['.$row[$uniqueKey].']['.$column.']', $row[$column])
                                         : Form::class('form-control')->text('updateColumns['.$row[$uniqueKey].']['.$column.']', $row[$column]) }}
            </td>

            @endforeach:

            <td>
                @Form::onclick('updateRow(\''.$table.'\', \''.$row[$uniqueKey].'\', \'/#table-'.$table.'\', \''.$uniqueKey.'\')')->class('form-control btn btn-info')->button('update', LANG['updateButton']):
            </td>
        </tr>
        @endforeach:

        <tr>
            <td colspan="{{count($columns) + 1}}">
                <ul class="pagination">
                  {[ $rows = ceil($get->totalRows(true) / 10) ]}
                  @for( $i = 1; $i <= $rows; $i++ ):
                  {[ $s = ($i - 1) * 10 ]}
                  <li {{ $s == ($start ?? 0) ? 'class="active"' : ''}}><a href="javascript:;" onclick="paginationRow('@$table:', '@$s:', '/#table-@$table:')">{{$i}}</a></li>
                  @endfor:
                </ul>
            </td>
        </tr>

    </tbody>

</table>

@Form::close():
