@Form::open():
<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">
            @LANG['restApi']: <small> {{LANG['overview']}}</small>
        </h1>
    </div>

    <div class="col-lg-1">
        <h1 class="page-header">
            @Form::class('btn btn-info')->submit('request', LANG['requestButton']):
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-exchange fa-fw"></i> {{LANG['restApi']}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>{{LANG['url']}}</label>
                    @Form::required()->class('form-control')->placeholder('http/://www.example.com/api')->text('url', Validation::postBack('url')):
                </div>

                <div class="form-group">
                    <label>{{LANG['type']}}</label>
                    @Form::class('form-control')->select('type', ['post' => 'POST', 'get' => 'GET', 'put' => 'PUT', 'delete' => 'DELETE'], Validation::postBack('type')):
                </div>

                <div class="form-group">
                    @if( Validation::postback('sslVerifyPeer') ):
                        @Form::checked():
                    @endif:

                    @Form::checkbox('sslVerifyPeer', 1):
                    <label>{{LANG['sslVerifyPeer']}}</label>
                </div>

                <div class="form-group">
                    <label>{{LANG['sendData']}}</label>
                    @Form::class('form-control')->placeholder('data1/:value1,data2/:value2')->textarea('data', Validation::postBack('data')):
                </div>

            </div>
        </div>
    </div>

</div>

@if( ! empty($results) && ! is_scalar($results) ):
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-th-large fa-fw"></i> {{LANG['datas']}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr><td width="20%">{{LANG['keys']}}</td><td>{{LANG['values']}}</td></tr>
                        </thead>
                        <tbody>
                            @foreach( $results as $key => $val ):
                            <tr><td>{{$key}}</td><td>{{ ! is_scalar($val) ? output($val) : $val}}</td></tr>
                            @endforeach:
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endif:

@if( ! empty($infos) && ! is_scalar($infos) ):
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> {{LANG['info']}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr><td width="20%">{{LANG['keys']}}</td><td>{{LANG['values']}}</td></tr>
                    </thead>
                    <tbody>
                        @foreach( $infos as $key => $val ):
                        <tr><td>{{$key}}</td><td>{{ ! is_scalar($val) ? output($val) : $val}}</td></tr>
                        @endforeach:
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endif:


@Form::close():
