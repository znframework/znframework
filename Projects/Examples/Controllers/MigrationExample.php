<?php namespace Project\Controllers;

use Migration;

class MigrationExample extends Controller
{
    public function main(String $params = NULL)
    {
        // Create Frontend/Models/Migrations/Comments.php File.
        Migration::create('Comments');
    }

    public function up()
    {
        \MigrateComments::up();
    }

    public function down()
    {
        \MigrateComments::down();
    }

    public function versionCreate($version = 2)
    {
        // Create Frontend/Models/Migrations/CommentsVersion/002.php File.
        Migration::create('Comments', $version);
    }

    public function versionUp($version = 2)
    {
        \MigrateComments::version($version)->up();
    }

    public function versionDown($version = 2)
    {
        \MigrateComments::version($version)->down();
    }
}
