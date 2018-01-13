<div id="newDatatable" class="collapse panel panel-default">
    {{Form::id('newDatatableForm')->open()}}
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-table fa-fw"></i> {{LANG['newDatatable']}}</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Column Name</th>
                        <th>Data Type</th>
                        <th>Data Length</th>
                        <th>Primary Key</th>
                        <th>Auto Increment</th>
                        <th>Is NULL</th>
                        <th>Default Value</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <td colspan="8">{{Form::class('form-control')->placeholder('Table Name')->text('table')}}</td>
                </tbody>
                <tbody id="newTableColumnContent">
                    @Import::view('add-column.wizard'):
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="7">{{Form::onclick('createNewDatatable()')->class('form-control btn btn-info')->button('createDatatable', LANG['createButton'])}}</td>
                        <td colspan="1">{{Form::onclick('addColumnInNewTable()')->class('form-control btn btn-success')->button('addColumn', LANG['addColumnButton'])}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{Form::close()}}
</div>

@foreach( $tables as $key => $table ):

<a href="/#table-@$table:" class="list-group-item" data-toggle="collapse">
    <i class="fa fa-fw fa-table"></i> @$table:
    <span><i class="fa fa-angle-down fa-fw"></i></span>
    <span style="cursor:pointer"  class="pull-right"><i class="fa fa-trash-o fa-fw" onclick="dropTable('{{$table}}')" title="Delete Datatable"></i></span>
    <span style="cursor:pointer" class="pull-right"><i data-toggle="collapse" data-target="/#add-column-@$table:"  class="fa fa-plus fa-fw" title="Add Column"></i></span>
</a>

<div id="add-column-@$table:" class="collapse panel panel-default">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Column Name</th>
                        <th>Data Type</th>
                        <th>Data Length</th>
                        <th>Is NULL</th>
                        <th>Default Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{Form::class('form-control')->id($table.'add-columncolumnName')->text('columnName')}}</td>
                        <td>{{Form::class('form-control')->id($table.'add-columntype')->select('type', DATATYPES)}}</td>
                        <td>{{Form::class('form-control')->id($table.'add-columnmaxLength')->text('maxLength')}}</td>
                        <td>{{Form::class('form-control')->id($table.'add-columnisNull')->select('isNull', NULLTYPES)}}</td>
                        <td>{{Form::class('form-control')->id($table.'add-columndefault')->text('default')}}</td>
                    </tr>
                    <tr>
                        <td colspan="7">{{Form::onclick('modifyColumn(\''.$table.'\', \'add-column\', \'/#table-'.$table.'\')')->class('form-control btn btn-info')->button('createNewDatatable', LANG['createButton'])}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div id="table-@$table:" class="collapse table-responsive">
    @Import::view('datatables-rows.wizard', ['table' => $table]):
</div>

@endforeach:
