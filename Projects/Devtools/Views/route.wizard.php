<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-repeat fa-fw"></i> {{LANG['newRoute']}}</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['routeName']}}</label>
                    @Form::required()->class('form-control')->placeholder('Routes/RouteName')->text('route'):
                </div>
            </div>
        </div>
    </div>
</div>
