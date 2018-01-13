<tr class="newTableColumn">
    <td>{{Form::class('form-control')->text('columnName[]')}}</td>
    <td>{{Form::class('form-control')->id('type')->select('type[]', DATATYPES)}}</td>
    <td>{{Form::class('form-control')->text('maxLength[]')}}</td>
    <td>{{Form::class('form-control')->select('primaryKey[]', [0, 1])}}</td>
    <td>{{Form::class('form-control')->select('autoIncrement[]', [0, 1])}}</td>
    <td>{{Form::class('form-control')->id('isNull')->select('isNull[]', NULLTYPES)}}</td>
    <td>{{Form::class('form-control')->text('default[]')}}</td>
    <td>{{Form::class('form-control btn btn-danger')->onclick('dropColumnInNewTable(this)')->button('dropColumn', LANG['dropColumnButton'])}}</td>
</tr>
