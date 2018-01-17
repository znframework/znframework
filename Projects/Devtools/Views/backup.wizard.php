<!-- Page Heading -->
@Form::open():
<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">
            {{LANG['systemBackup']}} <small> {{LANG['overview']}}</small>
        </h1>

    </div>

    <div class="col-lg-1">
        <h1 class="page-header">
            @Form::class('btn btn-info')->submit('backup', LANG['backupButton']):

        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-floppy-o fa-fw"></i> {{LANG['databaseBackup']}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>
                    @Form::class('form-control')->checkbox('databaseBackup', true):
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-location-arrow fa-fw"></i> {{LANG['backupLocation']}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                {{STORAGE_DIR}}ProjectBackup/{{SELECT_PROJECT}}-xxxx-xx-xx-xx-xx-xx/
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.row -->
@if( ! empty($files) ):
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book fa-fw"></i> {{LANG['backupList']}}</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    @foreach( $files as $backup ):
                    <a href="/#" class="list-group-item">

                        <i class="fa fa-fw fa-folder"></i> @$backup:
                        <span class="pull-right"><i onclick="deleteProcess('home/deleteBackup/{{$backup}}');" class="fa fa-trash-o fa-fw"></i></span>
                    </a>
                    @endforeach:
                </div>
            </div>
        </div>
    </div>
</div>
@endif:

@Form::close():
<!-- /.container-fluid -->
