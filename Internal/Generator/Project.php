<?php namespace ZN\Generator;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Singleton;
use ZN\Request\Post;
use ZN\Filesystem\Forge;

class Project
{
    /**
     * Select project name
     * 
     * @param string $name
     * 
     * @return bool
     */
    public static function generate(String $name) : Bool
    {
        Post::project($name);

        $validation = Singleton::class('ZN\Validation\Data');

        $validation->rules('project', ['alpha'], 'Project Name');

        if( ! $error = $validation->error('string') )
        {
            $source = EXTERNAL_FILES_DIR . 'DefaultProject.zip';
            $target = PROJECTS_DIR . Post::project();

            Forge::zipExtract($source, $target);

            return true;
        }

        return false;
    }
}
