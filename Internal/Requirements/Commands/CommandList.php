<?php namespace ZN\Commands;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class CommandList
{
    /**
     * Magic constructor
     * 
     * @param 
     * 
     * @return void
     */
    public function __construct()
    {   
        echo implode
        (EOL, [
            '+---------------------------+---------------------------------------------------------------------------+',
            '| Command Name              | Usage of Example                                                          |',
            '+---------------------------+---------------------------------------------------------------------------+',
            '| upgrade                   | upgrade                                                                   |',
            '| upgrade-files             | upgrade-files                                                             |',
            '| create-project            | create-project project name                                               |',
            '| delete-project            | delete-project project name                                               |',
            '| create-controller         | create-controller controller name                                         |',
            '| delete-controller         | delete-controller controller name                                         |',
            '| create-model              | create-model model name                                                   |',
            '| create-grand-model        | create-grand-model model name                                             |',
            '| delete-model              | delete-model model name                                                   |',
            '| create-grand-vision       | create-grand-vision [database name]                                       |',
            '| delete-grand-vision       | delete-grand-vision [database name]                                       |',
            '| start-restoration         | start-restoration project name [full, standart or [directories]]          |',
            '| end-restoration           | end-restoration project name                                              |',
            '| end-restoration-delete    | end-restoration-delete project name                                       |',
            '| clean-cache               | clean-cache                                                               |',
            '| generate-databases        | generate-databases                                                        |',
            '| run-uri                   | run-uri controller/function/p1/p2/.../pN                                  |',
            '| run-controller            | run-controller controller/function/p1/p2/.../pN                           |',
            '| run-model                 | run-model model:function p1 p2 ... pN                                     |',
            '| run-class                 | run-class class:function p1 p2 ... pN                                     |',
            '| run-cron                  | run-cron controller/method func param func param ...                      |',
            '| run-cron                  | run-cron command:method func param func param ...                         |',
            '| run-cron                  | run-cron http://example.com/                                              |',
            '| cron-list                 | Cron Job List                                                             |',
            '| remove-cron               | remove-cron cronID                                                        |',
            '| run-command               | run-command command:function p1 p2 ...pN                                  |',
            '| run-external-command      | run-command command:function p1 p2 ...pN                                  |',
            '| command:function          | command:function p1 p2 ...pN                                              |',
            '| external\command:function | external\command:function p1 p2 ...pN                                     |',
            '| run-function              | run-function function p1 p2 ... pN                                        |',
            '+---------------------------+---------------------------------------------------------------------------+',
        ]) . EOL;
    }
}