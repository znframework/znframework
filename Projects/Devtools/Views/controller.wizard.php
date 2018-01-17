<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gears fa-fw"></i> {{LANG['newController']}}</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['controllerName']}}</label>
                    @Form::required()->class('form-control')->placeholder('Controllers/ControllerName')->text('controller'):
                </div>

                <div class="form-group">
                    <label>{{LANG['functions']}}</label>
                    @Form::class('form-control')->placeholder('Function1,Function2,Function3 ...')->text('functions'):
                </div>

                <div class="form-group">
                    @Form::radio('withView', 'normal'):
                    <label>{{LANG['withView']}}</label>
                    @Form::radio('withView', 'wizard'):
                    <label>{{LANG['withWizard']}}</label>
                </div>
            </div>
        </div>
    </div>
</div>
