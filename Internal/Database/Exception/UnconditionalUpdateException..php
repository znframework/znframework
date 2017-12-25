<?php namespace ZN\Database\Exception;

use GeneralException;

class UnconditionalDeleteException extends GeneralException
{
    const lang = 
    [
        'tr' => 'Koşulsuz güncelleme işlemi gerçekleştiremezsiniz! Lütfen where() ile koşul tanımlayın.',
        'en' => 'You can not perform unconditional update! Please define the condition with where ().'
    ];
}
