<?php namespace ZN\Database\Exception;

use GeneralException;

class ConnectionErrorException extends GeneralException
{
    const lang = 
    [
        'tr' => 'Veritabanı bağlantısı sağlanamadı! Lütfen bağlantı ayarlarınızı kontrol edin!',
        'en' => 'Database connection error! Please check your connection settings!'
    ];
}
