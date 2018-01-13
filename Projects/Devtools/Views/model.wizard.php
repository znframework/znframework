<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-database fa-fw"></i> {{LANG['newModel']}}</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['modelName']}}</label>
                    @@Form::required()->class('form-control')->placeholder('Models/ModelName')->text('model'):
                </div>

                <div class="form-group">
                    <label>{{LANG['namespace']}}</label>
                    @@Form::class('form-control')->placeholder('Example\ExampleModel')->text('namespace'):
                </div>

                <div class="form-group">
                    <label>{{LANG['extends']}}</label>
                    @@Form::class('form-control')->select('extends', ['Model' => 'Model', 'GrandModel' => 'GrandModel', 'RelevanceModel' => 'RelevanceModel'], 'Model'):
                </div>

                <div class="form-group">
                    <label>{{LANG['functions']}}</label>
                    @@Form::class('form-control')->placeholder('Function1,Function2,Function3 ...')->text('functions'):
                </div>

            </div>
        </div>
    </div>

</div>
