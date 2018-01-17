<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-renren fa-fw"></i> {{LANG['newFile']}}</h3>
            </div>

            <div class="panel-body">
                <div class="form-group">
                    <label>{{LANG['viewName']}}</label>
                    @Form::required()->class('form-control')->placeholder('Starting/FileName')->text('file'):
                </div>

                <div class="form-group">
                    <label>{{LANG['type']}}</label>
                    @Form::class('form-control')->select('type', ['Handload' => 'Handload', 'Autoload' => 'Autoload']):
                </div>
            </div>

        </div>
    </div>

</div>
