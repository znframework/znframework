@Form::open():
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">
            {{LANG['home']}} <small> {{LANG['overview']}}</small>
        </h1>

    </div>

    <div class="col-lg-1">
        <h1 class="page-header">
            @Form::class('btn btn-info')->submit('create', LANG['createButton']):
        </h1>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-download fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">@$return->downloadCount ?? 0:</div>
                        <div>{{LANG['downloadCount']}}</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">@$return->fileCount ?? 0:</div>
                        <div>{{LANG['fileCount']}}</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-code fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">@$return->lineCount ?? 0:</div>
                        <div>{{LANG['lineCount']}}</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-book fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">@$return->libraryCount ?? 0:</div>
                        <div>{{LANG['libraryCount']}}</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->


<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book fa-fw"></i> {{LANG['newProject']}}</h3>
            </div>
            <div class="panel-body">

                    <div class="form-group">
                        @Form::required()->class('form-control')->placeholder('Projects/ProjectName')->text('project'):
                    </div>


            </div>
        </div>
    </div>

</div>

@Form::close():
<!-- /.container-fluid -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-book fa-fw"></i> {{LANG['projectList']}}</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">

                    @foreach( PROJECT_LIST as $project ):
                    <a href="{{URL::site('home/project/' . $project)}}" class="{{((Session::select('project') ? Session::select('project') : DEFAULT_PROJECT) === $project ) ? 'active ' : NULL}}list-group-item">
                        <i class="fa fa-fw fa-folder"></i> @$project:
                        @if( $project !== 'External' ):
                        <span class="pull-right"><i onclick="deleteProcess('home/delete/{{$project}}');" class="fa fa-trash-o fa-fw"></i></span>
                        @endif:
                    </a>

                    @endforeach:

                </div>

            </div>
        </div>
    </div>

</div>
