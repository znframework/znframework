<?php class DebugException
{
    public function __construct(String $file, String $message = NULL, $changed = NULL)
    {
        if( $data = \Lang::select($file, $message, $changed) )
        {
            $message = $data;
        }
        else
        {
            $message = $file;
        }

        $debug = Debug::next();

        echo Exceptions::continue($message, $debug->file, $debug->line);
    }
}
