<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{LANG['versionNotes']}} <small> {{LANG['overview']}}</small>
        </h1>

    </div>
</div>
<div class="row">

    <div class="col-lg-12">

        @foreach( $notes as $key => $note ):

        @if( ! empty($note->description) ):
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 style="cursor:pointer" data-toggle="collapse" data-target="/#id{{$key}}" class="panel-title">
                    <i class="fa fa-book fa-fw"></i>
                    {{$note->version}}
                    <span><i class="fa fa-angle-down fa-fw"></i></span>
                </h3>
            </div>
            <div id="id{{$key}}" class="collapse panel-body">
                <div class="list-group">
                    {{specialWord($note->description)}}
                </div>
            </div>
        </div>
        @endif:

        @endforeach:
    </div>

</div>

@@Form::close():

@Import::plugin(array
(
	'Dashboard/highlight/styles/agate.css',
	'Dashboard/highlight/highlight.pack.js'
)):

<script>hljs.initHighlightingOnLoad();</script>
