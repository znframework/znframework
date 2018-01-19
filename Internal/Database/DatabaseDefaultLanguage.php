<?php namespace ZN\Database;
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
class DatabaseDefaultLanguage
{
    /*
    |--------------------------------------------------------------------------
    | Database
    |--------------------------------------------------------------------------
    |
    | The language of the Database library.
    |
    */
    
    public $en = 
    [
        'tableNotExistsError'   => '`%` table is not exists!',
        'updateError'           => 'Update not performed!',
        'connectError'          => 'ERROR: Database connection error! Please check your connection settings.',
        'duplicateCheckError'   => '`%` Column or Columns could not be added because it has the same value as before!',
        'optimizeTablesSuccess' => 'The optimization process was completed successfully.',
        'backupTablesSuccess'   => 'The backup process was completed successfully.',
        'repairTablesSuccess'   => 'The repair process was completed successfully.'
    ];
    
    public $tr = 
    [
        'tableNotExistsError'   => '`%` tablosu bulunamadı!',
        'updateError'           => 'Güncelleme işlemi gerçekleştirilemedi!',
        'connectError'          => 'HATA: Veritabanı bağlantısı sağlanamadı! Lütfen bağlantı ayarlarınızı kontrol edin.',
        'duplicateCheckError'   => '`%` sütun veya sütunları daha önce aynı değere sahip olduğu için eklenemedi!',
        'optimizeTablesSuccess' => 'Optimizasyon işlemi başarı ile tamamlandı.',
        'backupTablesSuccess'   => 'Yedekleme işlemi başarı ile tamamlandı.',
        'repairTablesSuccess'   => 'Onarma işlemi başarı ile tamamlandı.'
    ];
}
