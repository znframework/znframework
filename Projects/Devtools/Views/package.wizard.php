@Form::open():
<div class="row">
    <div class="col-lg-11">
        <h1 class="page-header">
            {{LANG['packages']}} <small> {{LANG['overview']}}</small>
        </h1>

    </div>

    <div class="col-lg-1">
        <h1 class="page-header">
            @Form::class('btn btn-info')->submit('search', LANG['searchButton']):
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-th fa-fw"></i> {{LANG['packages']}} </h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['name']}}</label>
                    @Form::required()->class('form-control')->placeholder('Packagist Package Name/: Example/: monolog/monolog')->text('name', Validation::postBack('name')):
                </div>

            </div>

            @if( isset($result) ):

            <div class="panel-body">
                <div id="tables" class="list-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{LANG['name']}}</th>
                                    <th>{{LANG['description']}}</th>
                                    <th>{{LANG['downloadCount']}}</th>
                                    <th>{{LANG['process']}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $result as $row ):


                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->description}}</td>
                                    <td>{{$row->downloads}}</td>
                                    <td>
                                        @if( ! Arrays::valueExists($list, $row->name) ):
                                            {{Form::class('form-control btn btn-info')->dval($row->name)->onclick('downloadPackage(this)')->button('download', LANG['downloadButton'])}}
                                        @else:
                                            {{Form::class('form-control btn btn-success')->dval($row->name)->disabled()->onclick('downloadPackage(this)')->button('download', strtoupper(LANG['available']))}}
                                        @endif:
                                    </td>
                                </tr>
                                @endforeach:
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @endif:


        </div>
    </div>
</div>

@if( ! empty($list) ):

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-th fa-fw"></i> {{LANG['myPackages']}} </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{LANG['name']}}</th>
                                <th>{{LANG['process']}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach( $list as $row ):
                            <tr>
                                <td>{{$row}}</td>
                                <td>
                                    {{Html::class('form-control btn btn-danger')->anchor('packages/delete/' . $row, LANG['deleteButton'])}}
                                </td>
                            </tr>
                            @endforeach:
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endif:

@Form::close():

<script>

function downloadPackage(obj)
{
    var ids = $(obj).attr('dval');

    $.ajax
    ({
        url: '{{URL::site('packages/download')}}',
        data: {'name': ids},
        type: 'post',
        success: function(data)
        {
            if( data == 1 )
            {
                alert('{{LANG['composerError']}}');
            }
            else
            {
                alert('{{Lang::select('Success', 'success')}}');
                $(obj).addClass('form-control btn btn-success').attr('disabled', 'disabled').val('{{strtoupper(LANG['available'])}}');
            }
        }
    });
}

$(document).ajaxSend(function(e, jqXHR)
{
  $('/#loadingDiv').removeClass('hide');
});

$(document).ajaxComplete(function(e, jqXHR)
{
  $('/#loadingDiv').addClass('hide');
});

</script>
