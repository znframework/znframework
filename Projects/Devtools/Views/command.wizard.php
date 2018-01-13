<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-code fa-fw"></i> {{LANG['newCommand']}}</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['commandName']}}</label>
                    @@Form::required()->class('form-control')->placeholder('Commands/CommandName')->text('command'):
                </div>

                <div class="form-group">
                    <label>{{LANG['functions']}}</label>
                    @@Form::class('form-control')->placeholder('Function1,Function2,Function3 ...')->text('functions'):
                </div>
            </div>
        </div>
    </div>
</div>
