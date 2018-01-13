<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-file-code-o fa-fw"></i> {{LANG['newView']}}</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['viewName']}}</label>
                    @@Form::required()->class('form-control')->placeholder('Views/ViewName')->text('view'):
                </div>

                <div class="form-group">
                    <label>{{LANG['template']}}</label>
                    @@Form::class('form-control')->select('template', VIEW_TEMPLATES):
                </div>

                <div class="form-group">
                    <label>{{LANG['type']}}</label>
                    @@Form::class('form-control')->select('type', ['Normal' => 'Normal', 'Wizard' => 'Wizard'], 'Standart'):
                </div>

            </div>
        </div>
    </div>

</div>
