<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-gear fa-fw"></i> {{LANG['newConfig']}}</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['configName']}}</label>
                    @@Form::required()->class('form-control')->placeholder('Configs/ConfigName')->text('config'):
                </div>
            </div>
        </div>
    </div>
</div>
