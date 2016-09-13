<?php class RuntimeErrorException extends GeneralException
{
    public function __construct()
    {
        parent::__construct(lang('Exception', 'runtimeError'));
    }
}
