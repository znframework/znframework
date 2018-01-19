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
class DatagridDefaultLanguage
{
    /*
    |--------------------------------------------------------------------------
    | DBGrid
    |--------------------------------------------------------------------------
    |
    | The language of the DBGrid library.
    |
    */
    
    public $en = 
    [
        'processLabel'       => 'Process',
        'deleteButton'       => 'Delete',
        'editButton'         => 'Edit',
        'saveButton'         => 'Save',
        'closeButton'        => 'Close',
        'updateButton'       => 'Update',
        'addButton'          => 'Add New',
        'deleteSelectedName' => 'Delete Selected',
        'deleteAllName'      => 'Delete All Page',
        'totalRowsText'      => 'Total Number of Records',
        'searchHolder'       => 'Search...',
        'inputsHolder'       => 'Enter the data!',
        'areYouSure'         => 'Are you sure you want to do this operation?',
        'noData'             => 'No data will be shown!',
        'noTable'            => 'Table name is not specified!',
        'noSearch'           => 'DBGrid::search(string $col1, string $col2, ...) method to search by specifying the column is required!'
    ];
    
    public $tr = 
    [
        'processLabel'       => 'İşlemler',
        'deleteButton'       => 'Sil',
        'editButton'         => 'Düzenle',
        'saveButton'         => 'Kaydet',
        'closeButton'        => 'Kapat',
        'updateButton'       => 'Güncelle',
        'addButton'          => 'Yeni Ekle',
        'deleteSelectedName' => 'Seçilileri Sil',
        'deleteAllName'      => 'Tüm Sayfayı Sil',
        'totalRowsText'      => 'Toplam Kayıt Sayısı',
        'searchHolder'       => 'Arama...',
        'inputsHolder'       => 'Veri girin!',
        'areYouSure'         => 'Bu işlemi yapmak istediğinizden emin misiniz?',
        'noData'             => 'Gösterilecek veri bulunamadı!',
        'noTable'            => 'Tablo adı belirtilmedi!',
        'noSearch'           => 'DBGrid::search(string $col1, string $col2, ...) yöntemi ile arama yapılacak sütunların belirtimesi gereklidir!'
    ];
}
