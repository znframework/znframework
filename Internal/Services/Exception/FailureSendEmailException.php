<?php namespace ZN\Services\Exception;

class FailureSendEmailException extends IOException
{
    const lang = 
    [
        'tr' => 'PHP Sendmail kullanarak e-posta göndermek için açılamıyor! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!',
        'en' => 'Unable to send email using PHP Sendmail! Your server might not be configured to send mail using this method!'
    ];
}
