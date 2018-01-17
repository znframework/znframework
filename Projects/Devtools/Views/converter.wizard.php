@Form::open():
<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">
            @LANG['sqlConverter']: <small> {{LANG['overview']}}</small>
        </h1>
    </div>

    <div class="col-lg-1">
        <h1 class="page-header">
            @Form::class('btn btn-info')->submit('convert', LANG['convert']):
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list fa-fw"></i> {{LANG['supportQueries']}}</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">

                    @foreach( $supportQueries as $query ):
                    <a href="/#" class="list-group-item">
                        <i class="fa fa-fw fa-code"></i> @$query:
                    </a>
                    @endforeach:

                </div>

            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-repeat fa-fw"></i> SQL {{LANG['syntax']}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                @Form::class('form-control')->textarea('sql', Validation::postBack('sql')):
                </div>
            </div>
        </div>
    </div>

</div>


@if( ! empty($orm) ):
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-th-large fa-fw"></i> ORM</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                @$orm:
                </div>
            </div>
        </div>
    </div>

</div>

@endif:

@Form::close():
