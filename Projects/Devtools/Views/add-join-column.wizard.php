{[ $tables = Arrays::addFirst($tables, ['none' => 'none']) ]}

@for( $i = 1; $i <= 10; $i++ ):
<div id="joinDiv{{$i}}" class="{{ $i == 1 ? NULL : 'hide'}}">
    <div class="form-group col-lg-1">
        <label>&nbsp;</label>
        <div class="form-control">#{{$i}}</div>
    </div>

    <div class="form-group col-lg-3">
        <label>{{LANG['table']}}</label>
        @@Form::class('form-control')->id('joinTable' . $i)->onchange('getColumns(this, \'/#addJoinColumn'.$i.'\', \'join1\')')->select('joinTables[]', $tables, 'none'):
    </div>

    <div id="addJoinColumn{{$i}}" class="form-group col-lg-1">
        <label>{{LANG['column']}}</label>
        @@Form::class('form-control')->id('joinColum' . $i)->select('joinColumns[]', ['none' => 'none']):
    </div>

    <div class="form-group col-lg-1">
        <label>{{LANG['type']}}</label>
        @@Form::class('form-control')->onchange('changeSelected(this)')->select('joinTypes[]', ['left' => 'Left', 'right' => 'Right', 'inner' => 'Inner']):
    </div>

    <div class="form-group col-lg-3">
        <label>{{LANG['table']}}</label>
        @@Form::class('form-control')->id('joinOtherTable' . $i)->onchange('getColumns(this, \'/#addOtherJoinColumn'.$i.'\', \'join2\')')->select('joinOtherTables[]', $tables, 'none'):
    </div>

    <div id="addOtherJoinColumn{{$i}}" class="form-group col-lg-1">
        <label>{{LANG['column']}}</label>
        @@Form::class('form-control')->id('joinOtherColum' . $i)->select('joinOtherColumns[]', ['none' => 'none']):
    </div>

    <div class="form-group col-lg-1">
        <label>&nbsp;</label>
        @if( $i == 10 ):
            {[Form::disabled()]}
        @endif:

        @@Form::class('form-control btn btn-success')->onclick('addJoinColumn(\'/#joinDiv'.($i + 1).'\')')->button('add', LANG['addButton']):
    </div>

    <div class="form-group col-lg-1">
        <label>&nbsp;</label>
        @if( $i == 1 ):
            {[Form::disabled()]}
        @endif:

        @@Form::class('form-control btn btn-danger')->onclick('removeJoinColumn(\'/#joinDiv'.$i.'\', \''.$i.'\')')->button('remove', LANG['removeButton']):
    </div>
</div>
@endfor:
