<?php namespace ZN\Services\Remote;

use Processor, SSH, Folder, File, Html, Arrays, Strings;
use ZN\Services\Remote\Crontab\Exception\InvalidTimeFormatException;

class InternalCrontab extends RemoteCommon implements InternalCrontabInterface, InternalCrontabIntervalInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = ['Services:crontab', 'Services:processor'];

    //--------------------------------------------------------------------------------------------------------
    // Crontab Interval
    //--------------------------------------------------------------------------------------------------------
    //
    // comands
    //
    //--------------------------------------------------------------------------------------------------------
    use InternalCrontabIntervalTrait;

    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $type;

    //--------------------------------------------------------------------------------------------------------
    // Debug
    //--------------------------------------------------------------------------------------------------------
    //
    // @var boolean: false
    //
    //--------------------------------------------------------------------------------------------------------
    protected $debug = false;

    //--------------------------------------------------------------------------------------------------------
    // Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $crontabDir = '';

    //--------------------------------------------------------------------------------------------------------
    // Jobs
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $jobs = [];

    protected $crontabCommands = STORAGE_DIR . 'Crontab/Jobs';

    //--------------------------------------------------------------------------------------------------------
    // Constructor
    //--------------------------------------------------------------------------------------------------------
    //
    // __costruct()
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->path   = SERVICES_PROCESSOR_CONFIG['path'];
        $this->debug  = SERVICES_CRONTAB_CONFIG['debug'];

        $this->crontabDir = File::originpath(STORAGE_DIR.'Crontab'.DS);
    }

    //--------------------------------------------------------------------------------------------------------
    // Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $driver: empty
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function driver(String $driver) : InternalCrontab
    {
        Processor::driver($driver);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $path: empty
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function path(String $path = NULL) : InternalCrontab
    {
        $this->path = $path;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // List Array
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function listArray() : Array
    {
        return explode(EOL, rtrim(File::read($this->crontabCommands), EOL));
    }

    //--------------------------------------------------------------------------------------------------------
    // List
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function list() : String
    {
        $list = '';

        if( is_file($this->crontabCommands) )
        {
            $jobs  = $this->listArray();

            $list  = '<pre>';
            $list .= 'Command Name: Crontab Value' . Html::br(2);

            foreach( $jobs as $job )
            {
                $list .= Strings::divide($job, '/', -1) . ': '. $job . Html::br();
            }

            $list .= '</pre>';
        }

        return $list;
    }

    //--------------------------------------------------------------------------------------------------------
    // Remove
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $name: crontab.txt
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function remove($key = NULL)
    {
        $files = Folder::allFiles(PROCESSOR_DIR);

        if( $key === NULL )
        {
            foreach( $files as $file )
            {
                File::delete($file);
            }

            Processor::exec('crontab -r');
            File::write($this->crontabCommands, '');
        }
        else
        {
            $jobs = explode(EOL, rtrim(File::read($this->crontabCommands), EOL));
            $key  = \Autoloader::lower($key);

            foreach( $jobs as $i => $k )
            {
                $match = \Autoloader::lower(\Strings::divide($k, '/', -1));

                if( $match === $key )
                {
                    $this->_removeJob($jobs[$i] ?? NULL); unset($jobs[$i]); break;
                }
            }

            File::write($this->crontabCommands, implode(EOL, $jobs));
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Debug
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  bool   $status: true
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function debug(Bool $status = true) : InternalCrontab
    {
        $this->debug = $status;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Controller
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $file: empty
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function controller(String $file)
    {
        $path     = $this->_convertFileName($file);
        $fullPath = PROCESSOR_DIR . $path;

        File::write($fullPath, prefix(suffix($this->_controller($file), ';'), '#!/usr/bin/env php' . EOL . '<?php require_once "' . REAL_BASE_DIR . 'zerocore.php"; '));

        $this->run($fullPath);
    }

    //--------------------------------------------------------------------------------------------------------
    // Controller
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $file: empty
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function command(String $file, $type = 'External')
    {
        $path    = $this->_convertFileName($file);
        $pathEx  = explode('-', $path);
        $command = $pathEx[0];
        $method  = $pathEx[1] ?? 'main';

        $fullPath = PROCESSOR_DIR . $path;

        File::write($fullPath, '#!/usr/bin/env php' . EOL . '<?php require_once "' . REAL_BASE_DIR . 'zerocore.php"; (new \\'.$type.'\Commands\\'.$command.')->'.$method.'();');

        $this->run($fullPath);
    }

    //--------------------------------------------------------------------------------------------------------
    // Run
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $cmd: empty
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function run(String $cmd = NULL)
    {
        Processor::exec('chmod 0777 ' . $cmd);

        $execFile = $this->crontabCommands;

        $fix    = EOL;

        clearstatcache();

        if( ! $content = File::read($execFile) )
        {
            $fix = NULL;
        }

        if( ! stristr($content, $cmd))
        {
            $command = $fix . $this->_command() . $cmd;

            File::append($execFile, $command);
        }

        return Processor::exec('crontab ' . $execFile);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Remove Job
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $job
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _removeJob($job)
    {
        if( isset($job) )
        {
            $file = \Strings::divide($job, ' ', -1);

            File::delete($file);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Convert File Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $file
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _convertFileName($file)
    {
        return str_replace(['/', ':'], '-', $file);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Date Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Date Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Date Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _defaultVariables()
    {
        $this->type     = NULL;
        $this->path     = NULL;
        $this->command  = NULL;
        $this->debug    = false;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Date Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
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
