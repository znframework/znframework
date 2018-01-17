<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{LANG['experiments']}} <small> {{LANG['overview']}}</small>
        </h1>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div style="cursor:pointer" class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-table fa-fw"></i>

                    PHP & SQL
                </h3>

            </div>
            <div id="alterTableProcessTable">

                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th><pre><div style="width/:100%; height/:300px;" id="RunPHPCode" contenteditable="true"></div></pre></th>
                            <th><pre><div style="width/:100%; height/:300px;" id="RunSQLCode" contenteditable="true"></div></pre></th>

                        </tr>
                        <tr>
                            <th>@Form::onclick('alterTable(\'php\', \'RunPHPCode\')')->class('form-control btn btn-info')->button('update', LANG['runPHPButton']):</th>
                            <th>@Form::onclick('alterTable(\'sql\', \'RunSQLCode\')')->class('form-control btn btn-info')->button('update', LANG['runSQLButton']):</th>

                        </tr>
                    </thead>
                </table>
            
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-table fa-fw"></i> {{LANG['output'] ?? 'Output'}}
                    

                </h3>
            </div>
            <div class="panel-body">
        
                <div id="php" class="list-group">

                    
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-table fa-fw"></i> {{LANG['output'] ?? 'Output'}}
                    

                </h3>
            </div>
            <div class="panel-body">
        
                <div id="sql" class="list-group">

                    
                </div>

            </div>
        </div>
    </div>
</div>

<script>

var RunPHPCode = ace.edit("RunPHPCode");
RunPHPCode.setTheme("ace/theme/{{SELECT_EDITOR_THEME}}");
RunPHPCode.getSession().setMode("ace/mode/php");

var RunSQLCode = ace.edit("RunSQLCode");
RunSQLCode.setTheme("ace/theme/{{SELECT_EDITOR_THEME}}");
RunSQLCode.getSession().setMode("ace/mode/sql");

function alterTable(type, id)
{
    if( id === 'RunPHPCode' )
    {
        content = RunPHPCode.getValue();
    }
    else
    {
        content = RunSQLCode.getValue();
    }
    
    $.ajax
    ({
        url/:"@URL::site('experiments/alterTable'):",
    	data/:'content=' + encodeURIComponent(content) + '&type=' + type,
    	method/:"post",
    	success/:function(data)
    	{
            $('/#' + type).html(data);
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
