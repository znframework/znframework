<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{LANG['datatables']}} <small> {{LANG['overview']}}</small>
        </h1>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div style="cursor:pointer" data-target="/#alterTableProcessTable" data-toggle="collapse"  class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-table fa-fw"></i>

                    ORM & SQL

                    <span><i class="fa fa-angle-down fa-fw"></i></span>
                </h3>

            </div>
            <div id="alterTableProcessTable"  class="collapse panel-body">

                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><pre><div style="width/:100%; height/:300px;" id="RunORMCode" contenteditable="true"><br>Run ORM<br><br></div></pre></th>
                            <th><pre><div style="width/:100%; height/:300px;" id="RunSQLCode" contenteditable="true"><br>Run SQL<br><br></div></pre></th>

                        </tr>
                        <tr>
                            <th>@Form::onclick('alterTable(\'orm\', \'RunORMCode\')')->class('form-control btn btn-info')->button('update', LANG['runORMButton']):</th>
                            <th>@Form::onclick('alterTable(\'sql\', \'RunSQLCode\')')->class('form-control btn btn-info')->button('update', LANG['runSQLButton']):</th>

                        </tr>
                    </thead>
                </table>
          
            </div>
        </div>
    </div>
</div>

@Import::view('alert-bar.wizard'):

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-table fa-fw"></i> {{LANG['datatables']}}
                    <span href="/#newDatatable" data-toggle="collapse" style="cursor:pointer" class="pull-right"><i class="fa fa-plus fa-fw" title="Add Datatable"></i></span>

                </h3>
            </div>
            <div class="panel-body">
                <div id="tables" class="list-group">

                    @Import::view('datatables-tables.wizard', ['tables' => $tables]):

                </div>

            </div>
        </div>
    </div>
</div>

<script>

var RunORMCode = ace.edit("RunORMCode");
RunORMCode.setTheme("ace/theme/{{SELECT_EDITOR_THEME}}");
RunORMCode.getSession().setMode("ace/mode/php");

var RunSQLCode = ace.edit("RunSQLCode");
RunSQLCode.setTheme("ace/theme/{{SELECT_EDITOR_THEME}}");
RunSQLCode.getSession().setMode("ace/mode/sql");


var i = 0;

function addColumnInNewTable()
{
    i++;
    $('/#newTableColumnContent').append('<tr>' + $('.newTableColumn').html() + '</tr>');
}

function dropColumnInNewTable(obj)
{
    if( i > 0 )
    {
        $(obj).closest('tr').remove();
        i--;
    }
}



function createNewDatatable()
{
    if( confirm("@LANG['areYouSure']:") )
    {
        $.ajax
        ({
            url/:"@URL::site('datatables/createNewDatatable'):",
        	data/:$('/#newDatatableForm').serialize(),
        	method/:"post",
            dataType/:"json",
        	success/:function(data)
        	{
                $('/#tables').html(data.result);

                if( data.status )
                {
                    $('/#success-process').removeClass('hide');
                }
                else
                {
                    $('/#error-process').removeClass('hide');
                    $('/#error-process-content').text(data.error);
                }
        	}
        });
    }
}

function dropTable(table)
{
    if( confirm("@LANG['areYouSure']:") )
    {
        $.ajax
        ({
            url/:"@URL::site('datatables/dropTable'):",
        	data/:"table=" + table,
        	method/:"post",
            dataType:"json",
        	success/:function(data)
        	{
                $('/#tables').html(data.result);

                if( data.status )
                {
                    $('/#success-process').removeClass('hide');
                }
                else
                {
                    $('/#error-process').removeClass('hide');
                    $('/#error-process-content').text(data.error);
                }
        	}
        });
    }
}

function dropColumn(table, column, id)
{
    if( confirm("@LANG['areYouSure']:") )
    {
        $.ajax
        ({
            url/:"@URL::site('datatables/dropColumn'):",
        	data/:{"table":table, "column":column},
        	method/:"post",

        	success/:function(data)
        	{
                $(id).html(data);
        	}
        });
    }
}

function modifyColumn(table, column, id)
{
    if( confirm("@LANG['areYouSure']:") )
    {
        var obj = '/#' + table + column;
        $.ajax
        ({
            url/:"@URL::site('datatables/modifyColumn'):",
        	data/:
            {
                "table"/:table,
                "column"/:column,
                "columnName"/:$(obj + 'columnName').val(),
                "type"/:$(obj + 'type').val(),
                "maxLength"/:$(obj + 'maxLength').val(),
                "isNull"/:$(obj + 'isNull').val(),
                "default"/:$(obj + 'default').val(),
            },

        	method/:"post",

        	success/:function(data)
        	{
                $(id).html(data);
        	}
        });
    }
}

function deleteRow(table, column, value, id)
{
    if( confirm("@LANG['areYouSure']:") )
    {
        $.ajax
        ({
            url/:"@URL::site('datatables/deleteRow'):",
        	data/:{"table":table, "column":column, "value":value},
        	method/:"post",

        	success/:function(data)
        	{
                $(id).html(data);
        	}
        });
    }
}

function updateRow(table, ids, id, uniqueKey)
{
    $.ajax
    ({
        url/:"@URL::site('datatables/updateRow'):",
    	data/:$('/#' + table).serialize() + '&uniqueKey=' + uniqueKey + '&table=' + table + '&ids=' + ids,
    	method/:"post",

    	success/:function(data)
    	{
            $(id).html(data);

            if( ! data )
            {
                $('/#success-process-' + table).removeClass('hide');
            }
            else
            {
                $('/#error-process-' + table).removeClass('hide');
            }
    	}
    });

}

function updateRows(table, id, uniqueKey)
{
    $.ajax
    ({
        url/:"@URL::site('datatables/updateRows'):",
    	data/:$('/#' + table).serialize() + '&table=' + table + '&uniqueKey=' + uniqueKey,
    	method/:"post",

    	success/:function(data)
    	{
            $(id).html(data);

            if( ! data )
            {
                $('/#success-process-' + table).removeClass('hide');
            }
            else
            {
                $('/#error-process-' + table).removeClass('hide');
            }
    	}
    });
}

function addRow(table, id)
{
    $.ajax
    ({
        url/:"@URL::site('datatables/addRow'):",
    	data/:$('#' + table).serialize() + '&table=' + table,
    	method/:"post",

    	success/:function(data)
    	{
            $(id).html(data);

            if( data )
            {
                $('/#success-process-' + table).removeClass('hide');
            }
            else
            {
                $('/#error-process-' + table).removeClass('hide');
            }
    	}
    });
}

function alterTable(type, id)
{
    if( id === 'RunORMCode' )
    {
        content = RunORMCode.getValue();
    }
    else
    {
        content = RunSQLCode.getValue();
    }
    
    $.ajax
    ({
        url/:"@URL::site('datatables/alterTable'):",
    	data/:'content=' + encodeURIComponent(content) + '&type=' + type,
    	method/:"post",
        dataType/:"json",
    	success/:function(data)
    	{
            $('/#tables').html(data.result);

            if( ! data.error )
            {
                $('/#success-process').removeClass('hide');
            }
            else
            {
                $('/#error-process').removeClass('hide');
                $('/#error-process-content').text(data.error);
            }
    	}
    });
}

function paginationRow(table, start, id)
{
    $.ajax
    ({
        url/:"@URL::site('datatables/paginationRow'):",
    	data/:{"table":table, "start":start},
    	method/:"post",

    	success/:function(data)
    	{
            $(id).html(data);
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
