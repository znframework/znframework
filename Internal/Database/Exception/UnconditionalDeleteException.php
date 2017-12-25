<?php namespace ZN\Database\Exception;

use GeneralException;

class UnconditionalDeleteException extends GeneralException
{
    const lang = 
    [
        'tr' => 'Koşulsuz silme işlemi gerçekleştiremezsiniz! Lütfen where() ile koşul tanımlayın.',
        'en' => 'You can not perform unconditional deletion! Please define the condition with where ().'
    ];
}
