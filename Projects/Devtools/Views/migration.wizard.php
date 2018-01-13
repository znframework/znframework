<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-cubes fa-fw"></i> {{LANG['newMigration']}}</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label>{{LANG['migrationName']}}</label>
                    @@Form::required()->class('form-control')->placeholder('Models/Migrations/MigrationName')->text('migration'):
                </div>

                <div class="form-group">
                    <label>{{LANG['version']}}</label>
                    @@Form::class('form-control')->placeholder('1')->text('version'):
                </div>

            </div>
        </div>
    </div>

</div>
