<?php namespace ZN\Language;
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
class GridDefaultLanguage
{
    /*
    |--------------------------------------------------------------------------
    | ML
    |--------------------------------------------------------------------------
    |
    | The language of the ML library.
    |
    */
    
    public $en = 
    [
        'ml:addButton'              => 'New Add',
        'ml:updateButton'           => 'Update',
        'ml:deleteButton'           => 'Delete',
        'ml:clearButton'            => 'Clear',
        'ml:searchButton'           => 'Search',
        'ml:titleLabel'             => 'Multi Language Data Table',
        'ml:confirmLabel'           => 'Are you sure you want to do this operation?',
        'ml:keywordsLabel'          => 'Keywords',
        'ml:processLabel'           => 'Process',
        'ml:addLanguagePlaceHolder' => 'Add Language',
        'ml:keywordPlaceHolder'     => 'New Keyword',
        'ml:searchPlaceHolder'      => 'Search Word'
    ];
    
    public $tr = 
    [
        'ml:addButton'              => 'Yeni Ekle',
        'ml:updateButton'           => 'Güncelle',
        'ml:deleteButton'           => 'Sil',
        'ml:clearButton'            => 'Temizle',
        'ml:searchButton'           => 'Ara',
        'ml:titleLabel'             => 'Çoklu Dil Veri Tablosu',
        'ml:confirmLabel'           => 'Bu işlemi yapmak istediğinizden emin misiniz?',
        'ml:keywordsLabel'          => 'Anahtar Kelimeler',
        'ml:processLabel'           => 'İşlemler',
        'ml:addLanguagePlaceHolder' => 'Dil Ekle',
        'ml:keywordPlaceHolder'     => 'Yeni Anahtar',
        'ml:searchPlaceHolder'      => 'Kelime Ara'
    ];
}
