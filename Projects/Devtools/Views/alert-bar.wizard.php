<div id="success-process{{$id ?? NULL}}" class="hide row">
    <div class="col-lg-12">
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-info-circle"></i>
            <span id="success-process-content{{$id ?? NULL}}">@LANG['success']:</span>
        </div>
    </div>
</div>


<div id="error-process{{$id ?? NULL}}" class="hide row">
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-info-circle"></i>
            <span id="error-process-content{{$id ?? NULL}}">@LANG['error']:</span>
        </div>
    </div>
</div>
