@Form::id('gridForm')->open('gridForm'):
<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">
            @LANG['grids']: <small> {{LANG['overview']}}</small>
        </h1>
    </div>

    <div class="col-lg-1">
        <h1 class="pull-right page-header">
            @Form::class('btn btn-info')->onclick('submitPage(event)')->button('show', LANG['showButton']):
            @Form::hidden('show', 1):
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-table fa-fw"></i> {{LANG['table']}}</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['selectTable']}}</label>
                    @Form::class('form-control')->onchange('changeDefaultJoinTable(this)')->select('table', $tables, $selectTable):
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div style="cursor:pointer" data-target="/#joinsCollapse" data-toggle="collapse" class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-random fa-fw"></i> {{LANG['joins']}}</h3>
            </div>

            <div id="joinsCollapse" class="collapse panel-body">
                @if( ! empty($joinCollapse) ):
                    {{$joinCollapse}}
                @else:
                    @Import::view('add-join-column.wizard', ['tables' => $tables, 'selectTable' => $selectTable]):
                @endif:
            </div>

        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div style="cursor:pointer" data-target="/#columnsCollapse" data-toggle="collapse" class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-eye fa-fw"></i> {{LANG['viewColumns']}}</h3>
            </div>

            <div id="columnsCollapse" class="collapse panel-body">
                <div class="form-group">
                    @Form::class('form-control')->placeholder('table.column as Columns, table2.column2 as Columns2')->text('viewColumns', $viewColumns):
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div style="cursor:pointer" data-target="/#saveCollapse" data-toggle="collapse" class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-save fa-fw"></i> {{LANG['save']}}</h3>
            </div>

            <div id="saveCollapse" class="collapse panel-body">
                <div class="form-group">
                    @Form::class('form-control')->id('saves')->select('saves', $saves):
                </div>
                <div class="form-group">
                    @Form::class('form-control')->id('saveName')->placeholder('File Name')->text('saveName'):
                </div>
                <div class="form-group">
                    @Form::class('btn btn-success')->onclick('saveJoin()')->button('save', LANG['saveButton']):
                    @Form::class('btn btn-info')->onclick('loadJoin()')->button('load', LANG['loadButton']):
                    @Form::class('btn btn-danger')->onclick('deleteJoin()')->button('delete', LANG['deleteButton']):
                </div>

            </div>

        </div>
    </div>
</div>

@Form::close():

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-th fa-fw"></i> {{LANG['grids']}}</h3>
            </div>
            <div class="panel-body">
                <div style="overflow-x: auto;" class="list-group">

                    {{$table}}

                </div>

            </div>
        </div>
    </div>

</div>

<script>

changeDefaultJoinTable('select[name="table"]');

function changeDefaultJoinTable(obj)
{
    $('/#joinOtherTable1').attr('style', 'background:/#ddd').val($(obj).val()).trigger('change');
}

function addJoinColumn(id)
{
    $(id).removeClass('hide');
}

function removeJoinColumn(id, index)
{
    $('#' + 'joinTable' + index).val('none');
    $('#' + 'joinColumn' + index).val('none');
    $('#' + 'joinOtherTable' + index).val('none');
    $('#' + 'joinOtherColumn' + index).val('none');

    $(id).addClass('hide');
}

function changeSelected(obj)
{
    var optionValue = $(obj).val();

    $(obj).val(optionValue).find("option").removeAttr('selected')
    $(obj).val(optionValue).find("option[value=" + optionValue +"]").attr('selected', true);
}

function getColumns(obj, id, type)
{
    changeSelected(obj);

    $.ajax
    ({
        url/:"@URL::site('system/gridGetColumnsAjax'):",
    	data/:'table=' + $(obj).val() + '&type=' + type,
    	method/:"post",
    	success/:function(data)
    	{
            $(id).html(data);
    	}
    });
}

function submitPage(e)
{
    $.ajax
    ({
        url/:"@URL::site('system/grid'):",
    	data/:$('/#gridForm').serialize() + '&joinsCollapse=' + encodeURIComponent($('/#joinsCollapse').html()),
        method/:"post",
    	success/:function(data)
    	{
            document.documentElement.innerHTML = data;
    	}
    });
}

function saveJoin()
{
    $.ajax
    ({
        url/:"@URL::site('system/gridSaveAjax'):",
    	data/:'content=' + encodeURIComponent(document.documentElement.innerHTML) + '&saveName=' + $('/#saveName').val(),
        method/:"post",
    	success/:function(data)
    	{
            document.documentElement.innerHTML = data;
    	}
    });
}

function loadJoin()
{
    $.ajax
    ({
        url/:"@URL::site('system/gridLoadAjax'):",
    	data/:'saves=' + $('/#saves').val(),
        method/:"post",
    	success/:function(data)
    	{
            if( data )
            {
                document.documentElement.innerHTML = data;
            }
    	}
    });
}

function deleteJoin()
{
    $.ajax
    ({
        url/:"@URL::site('system/gridDeleteAjax'):",
    	data/:'delete=' + $('/#saves').val(),
        method/:"post",
    	success/:function(data)
    	{
            if( data )
            {
                document.documentElement.innerHTML = data;
            }
    	}
    });
}

$(document).ajaxSend(function(e, jqXHR)
{
  $('/#loadingDiv').removeClass('hide');
});

$(document).ajaxComplete(function(e, jqXHR)
{
  $('/#loadingDiv').addClass('hide');
});

</script>
