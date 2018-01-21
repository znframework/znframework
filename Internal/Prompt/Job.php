<?php namespace ZN\Crontab;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;
use ZN\Config;
use ZN\Singleton;
use ZN\Filesystem;
use ZN\DataTypes\Arrays;
use ZN\Prompt\Exception\InvalidTimeFormatException;

class Job extends CrontabExtends implements JobInterface, CrontabIntervalInterface
{
    use CrontabIntervalTrait;

    /**
     * Command Type
     * 
     * @var string
     */
    protected $type;

    /**
     * Is Debug
     * 
     * @var bool
     */
    protected $debug = false;

    /**
     * Crontab Directory
     * 
     * @var string
     */
    protected $crontabDir = '';

    /**
     * Jobs
     * 
     * @var array
     */
    protected $jobs = [];

    /**
     * Basic Structure
     * 
     * @var string
     */
    protected $zeroneed;

    /**
     * Define
     * 
     * @var string
     */
    protected $dzerocore = NULL;

    /**
     * Crontab Commands
     * 
     * @var string
     */
    protected $crontabCommands;

    /**
     * Crontab File Name
     * 
     * @var string
     */
    protected $fileName = 'Crontab' . DS . 'Jobs';

    /**
     * @var string
     */
    protected $user = NULL;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $command;

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        $this->getConfig = Config::get('Services', 'processor');
        $this->zeroneed  = $this->_zeroneed();
        $this->processor = Singleton::class('ZN\Prompt\Processor');

        if( PROJECT_TYPE === 'EIP' )
        {
            $this->crontabCommands = EXTERNAL_DIR . $this->fileName;
            $this->user            = defined('_CURRENT_PROJECT') 
                                   ? _CURRENT_PROJECT
                                   : CURRENT_PROJECT;
            
            $this->_project($this->dzerocore = $this->zeroneed);
        }
        else
        {
            $this->crontabCommands = FILES_DIR . $this->fileName;
        }

        $this->path       = $this->getConfig['path'];
        $this->crontabDir = Filesystem\Info::originpath(STORAGE_DIR.'Crontab'.DS);
    }

    /**
     * Crontab Queue
     * 
     * @param int      $id
     * @param callable $callable
     * @param int      $decrement = 1
     */
    public function queue(Int $id, Callable $callable, Int $decrement = 1)
    {
        $queueFile = $this->crontabCommands . 'Queue.json';
        
        $fileLimitValue = 0;

        $key = 'ID' . $id;

        if( ! is_file($queueFile) )
        {
            file_put_contents($queueFile, json_encode([$key => $fileLimitValue]) . EOL);
        }
        
        $fileData = json_decode(file_get_contents($queueFile), true);

        $fileLimitValue = (int) ($fileData[$key] ?? NULL);

        if( $callable($fileLimitValue, $decrement) === false )
        {
            $this->remove((int) ltrim($key, 'ID'));

            if( isset($fileData[$key]) )
            {
                unset($fileData[$key]);
            }
        }
        else
        {
            $fileData[$key] = $fileLimitValue += $decrement;
        }
           
        file_put_contents($queueFile, json_encode($fileData) . EOL);
    }

    /**
     * Crontab Run Limit
     * 
     * @param int $id
     * @param int $limit = 1
     */
    public function limit(Int $id, Int $limit = 1)
    {
        $limitFile = $this->crontabCommands . 'Limit.json';
        
        $fileLimitValue = $default = 1;

        $key = 'ID' . $id;

        if( ! is_file($limitFile) )
        {
            file_put_contents($limitFile, json_encode([$key => $default]) . EOL);
        }
        
        $fileData = json_decode(file_get_contents($limitFile), true);

        $fileLimitValue = (int) ($fileData[$key] ?? NULL);

        if( $fileLimitValue === $limit )
        {
            $this->remove((int) ltrim($key, 'ID'));

            if( isset($fileData[$key]) )
            {
                unset($fileData[$key]);
            }
        }
        else
        {
            $fileData[$key] = $fileLimitValue++;   
        }

        file_put_contents($limitFile, json_encode($fileData) . EOL);
    }

    /**
     * Selects project
     * 
     * @param string $name
     * 
     * @return Job
     */
    public function project(String $name)
    {
        $this->user = $name;

        $this->crontabDir = str_replace(_CURRENT_PROJECT, $this->user, $this->crontabDir);

        $this->_project($this->dzerocore);

        return $this;
    }

    /**
     * Select Processor Driver
     * 
     * @param string $driver
     * 
     * @return Job
     */
    public function driver(String $driver) : Job
    {
        $this->processor->driver($driver);
        
        return $this;
    }

    /**
     * Gets crontab list array
     * 
     * @return array
     */
    public function listArray() : Array
    {
        if( ! is_file($this->crontabCommands) )
        {
            return [];
        }

        return Arrays\RemoveElement::element(explode(EOL, file_get_contents($this->crontabCommands)), '');
    }

    /**
     * Gets crontab list
     * 
     * @return string
     */
    public function list() : String
    {
        $list = '';

        if( is_file($this->crontabCommands) )
        {
            $jobs  = $this->listArray();
            $list  = '<pre>';
            $list .= '[ID] CRON JOB<br><br>';

            foreach( $jobs as $key => $job )
            {
                $list .= '[' . $key . ']: '. $job . '<br>';
            }

            $list .= '</pre>';
        }

        return $list;
    }

    /**
     * Last job
     * 
     * @return string
     */
    public function lastJob()
    {
        return $this->processor->exec('crontab -l');
    }

    /**
     * Remove cron job
     * 
     * @param string $key = NULL
     */
    public function remove($key = NULL)
    {
        $this->processor->exec('crontab -r');

        if( $key === NULL )
        {
            unlink($this->crontabCommands);
        }
        else
        {
            $jobs = $this->listArray();

            unset($jobs[$key]);

            file_put_contents($this->crontabCommands, implode(EOL, $jobs) . EOL);

            $this->processor->exec('crontab ' . $this->crontabCommands);
        }
    }

    /**
     * Debug status
     * 
     * @param bool $status = true
     * 
     * @return Job
     */
    public function debug(Bool $status = true) : Job
    {
        $this->debug = $status;
        return $this;
    }

    /**
     * Cron Controller
     * 
     * @param string $file
     */
    public function controller(String $file)
    {
        new ControllerCommand($file, $command);

        $path = $this->_convertFileName($file);
        $code = Base::prefix(Base::suffix($command, ';\''), ' -r \'' . $this->zeroneed);

        $this->run($code);
    }

    /**
     * Cron wget
     * 
     * @param string $url
     */
    public function wget(String $url)
    {
        $this->path('wget');
        $this->run($url);
    }

    /**
     * Cron Command
     * 
     * @param string $file
     * @param string $type = 'Project' - options[Project|External]
     */
    public function command(String $file, $type = 'Project')
    {
        $path     = $this->_convertFileName($file);
        $pathEx   = explode('-', $path);
        $command  = $pathEx[0];
        $method   = $pathEx[1] ?? 'main';

        $code = ' -r \'' . $this->zeroneed . '(new \\'.$type.'\Commands\\'.$command.')->'.$method.'();\'';

        $this->run($code);
    }

    /**
     * Path
     * 
     * @param string $path = NULL
     * 
     * @return Job
     */
    public function path(String $path = NULL)
    {
        $this->path = $path;
        
        return $this;
    }

    /**
     * Run Cron
     * 
     * @param string $cmd = NULL
     * 
     * @return int
     */
    public function run(String $cmd = NULL)
    {
        $execFile = $this->crontabCommands;

        if( ! is_file($execFile) )
        {
            Filesystem\Forge::create($execFile);
            $this->processor->exec('chmod 0777 ' . $execFile);
        }

        $content = file_get_contents($execFile);

        if( ! stristr($content, $cmd))
        {
            $content = $content . $this->_command() . $cmd . EOL;
            file_put_contents($execFile, $content);
        }

        return $this->processor->exec('crontab ' . $execFile);
    }

    /**
     * Protected Zerocore
     */
    protected function _zeroneed()
    {
        return 'define("CONSOLE_ENABLED", true); require_once __DIR__ . "/zeroneed.php"; ';
    }

    /**
     * Protected Project
     */
    protected function _project($value)
    {
        $this->zeroneed = 'define("CONSOLE_PROJECT_NAME", "'.$this->user.'"); ' . $value;
    }

    /**
     * Protected Convert File Name
     */
    protected function _convertFileName($file)
    {
        return str_replace(['/', ':'], '-', $file);
    }

    /**
     * Protected Date Time
     */
    protected function _datetime()
    {
        if( $this->interval !== '* * * * *' )
        {
            $interval = $this->interval.' ';
        }
        else
        {
            $interval = ( $this->minute    ?? '*' ) . ' '.
                        ( $this->hour      ?? '*' ) . ' '.
                        ( $this->dayNumber ?? '*' ) . ' '.
                        ( $this->month     ?? '*' ) . ' '.
                        ( $this->day       ?? '*' ) . ' ';
        }

        $this->_intervalDefaultVariables();

        return $interval;
    }

    /**
     * Protected Command
     */
    protected function _command()
    {
        $datetimeFormat = $this->_datetime();
        $type           = $this->type;
        $path           = $this->path;
        $command        = $this->command;
        $debug          = $this->debug;

        $match = '(\*|[0-9]{1,2}|\*\/[0-9]{1,2}|[0-9]{1,2}\s*\-\s*[0-9]{1,2}|(([0-9]{1,2})*\s*\,\s*[0-9]{1,2})+)\s+';

        if( ! preg_match('/^'.$match.$match.$match.$match.$match.'$/', $datetimeFormat) )
        {
            throw new InvalidTimeFormatException('Services', 'crontab:timeFormatError');
        }
        else
        {
            return $datetimeFormat.
                   ( ! empty($path)    ? $path    . ' ' : '' ).
                   ( ! empty($command) ? $command . ' ' : '' ).
                   ( ! empty($type)    ? $type    . ' ' : '' ).
                   ( $debug === true   ? '>> '    . $this->crontabDir . 'debug.log 2>&1' : '' );
        }
    }

    /**
     * Protected Default Variables
     */
    protected function _defaultVariables()
    {
        $this->type     = NULL;
        $this->path     = NULL;
        $this->command  = NULL;
        $this->debug    = false;
    }

    /**
     * Protected Interval Default Variables
     */
    protected function _intervalDefaultVariables()
    {
        $this->interval  = '* * * * *';
        $this->minute    = '*';
        $this->hour      = '*';
        $this->dayNumber = '*';
        $this->month     = '*';
        $this->day       = '*';
    }
}
