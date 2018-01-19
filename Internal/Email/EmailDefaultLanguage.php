<?php namespace ZN\Email;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class EmailDefaultLanguage
{
    /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    |
    | The language of the Email library.
    |
    */

    public $en = 
    [
        'email:noSend'                  => 'Cannot send mail!',
        'email:attachmentMissing'       => 'Unable to locate the following email attachment: %',
        'email:attachmentUnreadable'    => 'Unable to open this attachment: %',
        'email:noFrom'                  => 'Cannot send mail with no "From" header!',
        'email:noSocket'                => 'Unable to open a socket to Sendmail! Please check settings!',
        'email:exitStatus'              => 'Exit status code: %',
        'email:mimeMessage'             => 'This is a multi-part message in MIME format.%Your email application may not support this format.',
        'email:templateColumnError'     => 'The template % parameter does not contain column information! Usage -> table: column',
        'email:templateValueError'      => 'The template % parameter does not contain column value information! Usage -> whereColumn: value'
    ];

    public $tr = 
    [
        'email:noSend'                  => 'E-posta gönderilmedi!',
        'email:attachmentMissing'       => 'E-posta eki eksik!',
        'email:attachmentUnreadable'    => 'E-posta eki okunamıyor!',
        'email:noFrom'                  => 'Kimden bilgisi belirtmeden e-posta gönderilemez!',
        'email:noSocket'                => 'E-posta gönderimi için bir yuva açılamıyor! Ayarlarınızı kontrol edin!',
        'email:exitStatus'              => 'Çıkış durum kodu: %',
        'email:mimeMessage'             => 'Bu MIME biçiminde çok parçalı mesajdır.%E-posta uygulaması bu formatı desteklemiyor olabilir.',
        'email:templateColumnError'     => 'Şablon % parametresi kolon bilgisi içermiyor! Kullanım -> table:column',
        'email:templateValueError'      => 'Şablon % parametresi kolon değer bilgisi içermiyor! Kullanım -> whereColumn:value'
    ];
}
