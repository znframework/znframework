<!-- Page Heading -->
@Form::open():
<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">
            {{LANG['systemInfo']}} <small> {{LANG['overview']}}</small>
        </h1>

    </div>

    <div class="col-lg-1">
        <h1 class="page-header">
            @Form::class('btn btn-info')->submit('upgrade', LANG['upgradeButton']):
        </h1>
    </div>
</div>
<!-- /.row -->

@if( ! empty($upgrades) ):

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book fa-fw"></i> ZN {{LASTEST_VERSION . ' - ' . LANG['updatedFiles']}}</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">

                    @foreach( $upgrades as $upgrade ):
                    <a href="/#" class="list-group-item">
                        <i class="fa fa-fw fa-file"></i> @$upgrade:
                    </a>
                    @endforeach:

                </div>

            </div>
        </div>
    </div>

</div>

 @endif:

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> {{LANG['dashboardVersion']}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                {{DASHBOARD_VERSION}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> ZN {{LANG['version']}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                {{ZN_VERSION}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-info fa-fw"></i> PHP {{LANG['version']}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                {{PHP_VERSION}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@Form::close():
