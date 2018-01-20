<?php namespace ZN\Filesystem;
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
class FilesystemDefaultLanguage
{
    /*
    |--------------------------------------------------------------------------
    | Upload
    |--------------------------------------------------------------------------
    |
    | The language of the Upload library.
    |
    */

    public $en = 
    [
        'upload:extensionError'  => 'Invalid file extension!',
        'upload:mimeError'       => 'Invalid mime type!',
        'upload:unknownError'    => 'Unknown error or file is too large!',
        'upload:0'               => 'The file was uploaded successfully.',
        'upload:1'               => 'Maximum file size exceeded your php.ini file!',
        'upload:2'               => 'Form max_file_size directive file size limit has been exceeded!',
        'upload:3'               => 'File partially uploaded!',
        'upload:4'               => 'Upload file does not exist!',
        'upload:6'               => 'files to install a temporary directory not found!',
        'upload:7'               => 'File perpendicular to write on!',
        'upload:8'               => 'File upload does not support the extension!',
        'upload:9'               => 'File installation path is not valid!',
        'upload:10'              => 'Determine the maximum file size has been exceeded!'
    ];

    public $tr = 
    [
        'upload:extensionError'  => 'Geçersiz dosya uzantısı!',
        'upload:mimeError'       => 'Geçersiz mime türü!',
        'upload:unknownError'    => 'Bilinmeyen hata veya çok büyük boyutlu dosya!',
        'upload:0'               => 'Dosya başarı ile yüklendi.',
        'upload:1'               => 'Php.ini dosyasındaki maximum dosya boyutu aşıldı!',
        'upload:2'               => 'Formdaki max_file_size direktifindeki dosya boyutu limiti aşıldı!',
        'upload:3'               => 'Dosya kısmen yüklendi!',
        'upload:4'               => 'Yüklenecek dosya yok!',
        'upload:6'               => 'Dosyaların geçici olarak yükleneceği dizin bulunamadı!',
        'upload:7'               => 'Dosya dik üzerine yazılamadı!',
        'upload:8'               => 'Dosya yükleme uzantı desteği yok!',
        'upload:9'               => 'Dosya yükleme yolu geçerli değil!',
        'upload:10'              => 'Belirlenen maksimum dosya boyutu aşıldı!'
    ];
}
