<?php namespace ZN\Console;

use Folder;

class ProjectTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateProject()
    {
        $dir = PROJECTS_DIR . 'MyExampleProject';

        new CreateProject('MyExampleProject');

        $this->assertDirectoryExists($dir = PROJECTS_DIR . 'MyExampleProject');

        if( is_dir($dir) )
        {
            Folder::delete($dir);
        }
    }

    public function testDeleteProject()
    {
        $dir = PROJECTS_DIR . 'MyExampleProject';

        new CreateProject('MyExampleProject');
        new DeleteProject('MyExampleProject');

        $this->assertFalse(is_dir($dir));
    }
}