<?php class FatalErrorException extends GeneralException
{
    public function __construct()
    {
        parent::__construct(lang('Exception', 'fatalError'));
    }
}
