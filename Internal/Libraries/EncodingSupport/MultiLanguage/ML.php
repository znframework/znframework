<?php namespace ZN\EncodingSupport;

class InternalML extends \Requirements implements MLInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------
    
    //--------------------------------------------------------------------------------------------------------
    // ML Properties Trait
    //--------------------------------------------------------------------------------------------------------
    // 
    // url()
    // limit()
    //
    //--------------------------------------------------------------------------------------------------------
    use MLPropertiesTrait;

    //--------------------------------------------------------------------------------------------------------
    // $appdir
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string: NULL
    //
    //--------------------------------------------------------------------------------------------------------
    protected $appdir;
    
    //--------------------------------------------------------------------------------------------------------
    // $extension
    //--------------------------------------------------------------------------------------------------------
    // 
    // @var string: .ml
    //
    //--------------------------------------------------------------------------------------------------------
    protected $extension = '.ml';
    
    /*
     * Aktif dil dosyası yol bilgisini tutar.
     *
     * @var lang
     */
    protected $lang;
    
    //--------------------------------------------------------------------------------------------------------
    // Constructor
    //--------------------------------------------------------------------------------------------------------
    // 
    // __construct()
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->config = config('EncodingSupport', 'ml');
    
        $this->appdir = STORAGE_DIR.'MultiLanguage/';   
        
        if( ! is_dir($this->appdir) )
        {
            \Folder::create($this->appdir, 0755);   
        }
            
        $this->lang   = $this->appdir.getLang().$this->extension;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // Dil dosyasına kelime eklemek için kullanılır.
    // @param string $app 
    // @param mixed  $key
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(String $app, $key, String $data = NULL) : Bool
    {
        $datas = [];
        
        $createFile = $this->_langFile($app);
        
        // Daha önce bir dil dosyası oluşturulmamışsa oluştur.
        if( ! \File::exists($createFile) )
        {
            \File::write($createFile, \Json::encode([]));   
        }
        
        // Json ile veriler diziye çevriliyor.
        $datas = \Json::decodeArray(\File::read($createFile));  

        if( ! empty($datas) )
        {
            $json = $datas;
        }   
        
        // 2. key parametresi hem dizi hemde string veri alabilir.
        // Bu parametrenin veri türüne göre ekleme işlemleri yapılıyor.
        if( ! is_array($key) )
        {
            $json[$key] = $data;
        }
        else
        {
            foreach( $key as $k => $v )
            {
                $json[$k] = $v; 
            }   
        }
        
        // Yeni eklenecek bir veri varsa ekle
        // Aksi halde herhangi bir işlem yapma.
        if( $json !== $datas )
        {
            return \File::write($createFile, \Json::encode($json));
        }
        else
        {
            return false;   
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // Silinecek dil dosyası.
    // @param string $app 
    // @param mixed  $key
    //
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $app, $key) : Bool
    {
        $datas = [];
        
        $createFile = $this->_langFile($app);
        
        // Dosya mevcutsa verileri al.
        if( \File::exists($createFile) )
        {
            $datas = \Json::decodeArray(\File::read($createFile));      
        }
        
        if( ! empty($datas) )
        {
            $json = $datas;
        }   
        
        // Yine anahtar parametresinin ver türüne göre
        // işlemleri gerçekleştirmesi sağlanıyor.
        if( ! is_array($key) )
        {
            unset($json[$key]);
        }
        else
        {
            foreach($key as $v)
            {
                unset($json[$v]);   
            }   
        }
        
        // Dosyayı yeniden yaz.
        return \File::write($createFile, \Json::encode($json));
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Delete All
    //--------------------------------------------------------------------------------------------------------
    //
    // Silinecek dil dosyası.
    // @param string $app 
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteAll($app = NULL) : Bool
    {
        if( ! is_string($app) )
        {
            if( $app === NULL )
            {
                $MLFiles = \Folder::files($this->appdir, 'ml');
            }
            elseif( is_array($app) )
            {
                $MLFiles = $app;
            }
            else
            {
                return false;   
            }
            
            $allMLFiles = [];
            
            if( ! empty($MLFiles) ) foreach( $MLFiles as $file )
            {
                $removeExtension = str_replace('.ml', '', $file);
                $this->deleteAll($removeExtension);
            }

            return true;
        }
        else
        {
            $createFile = $this->_langFile($app);
            // Dosya mevcutsa verileri al.
            if( \File::exists($createFile) )
            {
                return \File::delete($createFile);      
            }
            
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Update
    //--------------------------------------------------------------------------------------------------------
    //
    // Dil dosyasında yer alan bir kelimeyi güncellemek için kullanılır.
    // @param string $app 
    // @param mixed  $key
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function update(String $app = NULL, $key, String $data = NULL) : Bool
    {
        // Güncelleme işlemi ekleme yöntemi ile aynı özelliğe sahiptir.
        return $this->insert($app, $key, $data);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // Dil dosyasın yer alan istenilen kelimeye erişmek için kullanılır.
    // @param mixed $key 
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(String $key, $convert = NULL) : String
    {
        $read = \File::read($this->lang);
        
        $array = \Json::decodeArray($read);
        
        $return = '';
        
        if( isset($array[$key]) )
        { 
            if( is_array($convert) )
            {
                $return = str_replace(array_keys($convert), array_values($convert), $array[$key]);
            }
            else
            {
                $return = str_replace('%', $convert, $array[$key]);
            }
        }
        
        return $return;       
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Select All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $app 
    // @return array
    //
    //--------------------------------------------------------------------------------------------------------
    public function selectAll($app = NULL) : Array
    {
        if( ! is_string($app) )
        {
            if( $app === NULL )
            {
                $MLFiles = \Folder::files($this->appdir, 'ml');
            }
            elseif( is_array($app) )
            {
                $MLFiles = $app;
            }
            else
            {
                return false;   
            }           
            
            $allMLFiles = [];
            
            if( ! empty($MLFiles) ) foreach( $MLFiles as $file )
            {
                $removeExtension = str_replace('.ml', '', $file);
                $allMLFiles[$removeExtension] = $this->selectAll($removeExtension);
            }
            
            return $allMLFiles;
        }
        else
        {
            $createFile = $this->_langFile($app);   
            
            $read = \File::read($createFile);
            
            return \Json::decodeArray($read);
        }
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $app 
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function table($app = NULL) : String
    {
        $searchWord = '';
        if( \Method::post() )
        {
            $keyword   = \Method::post('ML_UPDATE_KEYWORD_HIDDEN');
            $languages = explode(',', \Method::post('ML_LANGUAGES'));
            $words     = \Method::post('ML_UPDATE_WORDS');
            
            // SEARCH
            if( \Method::post('ML_SEARCH_SUBMIT') )
            {
                $searchWord = \Method::post('ML_SEARCH');   
            }
            
            // ADD LANGUAGE
            if( \Method::post('ML_ADD_ALL_LANGUAGE_SUBMIT') )
            {
                $this->insert(\Method::post('ML_ADD_LANGUAGE'), 'example', 'Example');  
            }
            
            // ALL DELETE
            if( \Method::post('ML_ALL_DELETE_SUBMIT') )
            {
                $allDelete = \Method::post('ML_ALL_DELETE_HIDDEN');
                $this->deleteAll($allDelete);
            }
            
            // ADD
            if( \Method::post('ML_ADD_KEYWORD_SUBMIT') )
            {
                $addWords   = \Method::post('ML_ADD_WORDS');
                $addKeyword = \Method::post('ML_ADD_KEYWORD');

                if( is_numeric($addKeyword) )
                {
                    $addKeyword = 'Wrong Keyword! Only String.';
                }     
                
                if( ! empty($languages) ) foreach( $languages as $key => $lang )
                {
                    $this->insert($lang, $addKeyword, $addWords[$key]); 
                }   
            }
            
            // UPDATE
            if( \Method::post('ML_UPDATE_KEYWORD_SUBMIT') )
            {   
                if( ! empty($languages) ) foreach( $languages as $key => $lang )
                {
                    $this->update($lang, $keyword, $words[$key]);   
                }
            }
            
            // DELETE
            if( \Method::post('ML_DELETE_SUBMIT') )
            {
                if( ! empty($languages) ) foreach( $languages as $key => $lang )
                {
                    $this->delete($lang, $keyword); 
                }
            }
        }
        
        $config = $this->config['table'];
        
        $attributes         = $config['attributes'];
        $pagcon             = $config['pagination'];
        $placeHolders       = $config['placeHolders'];
        $buttonNames        = $config['buttonNames'];
        $title              = $config['labels']['title'];
        $confirmMessage     = $config['labels']['confirm'];
        $process            = $config['labels']['process'];
        $keywords           = $config['labels']['keywords'];
        
        $confirmBox = ' onsubmit="return confirm(\''.$confirmMessage.'\');"';
        
        
        $data = $this->selectAll($app); 
        $languageCount = count($data);
        
        $table  = $this->_styleElement();
        $table .= '<table id="ML_TABLE"'.\Html::attributes($attributes['table']).'>';
        $table .= '<thead>';
        $table .= '<tr><th colspan="'.($languageCount + 4).'">'.$title.'</th></tr>';
        $table .= '<tr><th>S/L</th>';
        $table .= '<td colspan="'.($languageCount + 3).'">';
        $table .= '<form name="ML_SEARCH_ADD_LANGUAGE_FORM" method="post">';
        $table .= \Form::attr($attributes['textbox'])->placeholder($placeHolders['search'])->text('ML_SEARCH');
        $table .= \Form::attr($attributes['add'])->submit('ML_SEARCH_SUBMIT', $buttonNames['search']);
        $table .= \Form::attr($attributes['textbox'])->placeholder($placeHolders['addLanguage'])->text('ML_ADD_LANGUAGE');
        $table .= \Form::attr($attributes['add'])->submit('ML_ADD_ALL_LANGUAGE_SUBMIT', $buttonNames['add']).'</td>';
        $table .= '</form>';
        $table .= '</tr>';
            
        $table .= '<tr><th>#</th><td><strong>'.$keywords.'</strong></td>';
        
        $words = [];
        $formObjects = '';
        
        $languages   = implode(',', array_keys($data));
        $mlLanguages = \Form::hidden('ML_LANGUAGES', $languages);
        
        foreach( $data as $lang => $values )
        {
            $upperLang = strtoupper($lang);
            
            $table .= '<form name="ML_TOP_FORM_'.$upperLang.'" method="post"'.$confirmBox.'>';
            $table .= '<td><strong>'.$upperLang.\Form::hidden('ML_ALL_DELETE_HIDDEN', $lang).\Form::attr($attributes['delete'])->submit('ML_ALL_DELETE_SUBMIT', $buttonNames['delete']).'</strong></td>';       
            $table .= '</form>';        
            foreach( $values as $key => $val )
            {
                $words[$key][] = $val;
            }
            
            $formObjects .= '<td>'.\Form::attr($attributes['textbox'])->placeholder($upperLang)->text('ML_ADD_WORDS[]').'</td>';
        }
        $table .= '<td><strong>'.$process.'</strong></td>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        $table .= '<tr>';
        $table .= '<form name="ML_TOP_FORM" method="post">';
        $table .= '<th>N</th>';
        $table .= '<td>'.$mlLanguages.\Form::attr($attributes['textbox'])->placeholder($placeHolders['keyword'])->text('ML_ADD_KEYWORD').'</td>';
        $table .= $formObjects;
        $table .= '<td>'.\Form::attr($attributes['add'])->submit('ML_ADD_KEYWORD_SUBMIT', $buttonNames['add']).' '.\Form::attr($attributes['clear'])->reset('ML_ADD_KEYWORD_RESET', $buttonNames['clear']).'</td>';
        $table .= '</form>';
        $table .= '</tr>';
        
        
        $limit     = $this->limit;
        $start     = (int) \URI::segment(-1);
        $totalRows = count($words);
        $index     = 1;
        
        if( ! empty($searchWord) )
        {
            $newWords = [];
            
            foreach( $words as $key => $val )
            {   
                if( stristr($key, $searchWord) )
                {
                    $newWords[$key] = $val;
                }   
                else
                {
                    $newValues = [];
                
                    foreach( $val as $v )
                    {
                        if( stristr($v, $searchWord) )
                        {
                            $newValues[] = $v;
                        }   
                    }
                    
                    if( ! empty($newValues) )
                    {
                        $newWords[$key] = $newValues;   
                    }       
                }
            }   
            
            $words = $newWords;
        }
        
        if( empty($searchWord) )
        {
            $words = array_slice($words, $start, $limit);
        }
        
        foreach( $words as $key => $val )
        {
            $table .= '<tr>';
            $table .= '<form name="ML_'.strtoupper($key).'_FORM" method="post"'.$confirmBox.'>';
            $table .= '<th>'.$index++.'</th>';
            $table .= '<td>'.\Form::hidden('ML_UPDATE_KEYWORD_HIDDEN', $key).$key.'</td>';
            
            for( $i = 0; $i < $languageCount; $i++ )
            {
                $table .= '<td>'.\Form::attr($attributes['textbox'])->text('ML_UPDATE_WORDS[]', ( ! empty($val[$i]) ? $val[$i] : '' )).'</td>'; 
            }
            
            $table .= '<td>'.$mlLanguages.\Form::attr($attributes['update'])->submit('ML_UPDATE_KEYWORD_SUBMIT', $buttonNames['update']);
            $table .= ' ';
            $table .= \Form::attr($attributes['delete'])->submit('ML_DELETE_SUBMIT', $buttonNames['delete']).'</td>';
            $table .= '</form>';
            $table .= '</tr>';  
        }
        
        if( empty($this->url) )
        {
            if( defined('_CURRENT_PROJECT_DIR') )
            {
                if( defined('CURRENT_PROJECT_DIR') )
                {
                    $preUrl = CURRENT_PROJECT_DIR;
                }
                else
                {
                    $preUrl = _CURRENT_PROJECT_DIR;
                }
                
                $paginationUrl = $preUrl.'/'.CURRENT_CONTROLLER.'/'.CURRENT_CFUNCTION;
            }
            else
            {
                $paginationUrl = '';    
            }
        }
        else
        {
            $paginationUrl = $this->url;    
        }
        
        if( empty($searchWord) )
        {
            $pagination = \Pagination::style($pagcon['style'])
                                     ->css($pagcon['class'])
                                     ->start($start)
                                     ->totalRows($totalRows)
                                     ->limit($limit)
                                     ->url($paginationUrl)
                                     ->create();
        }
        else
        {
            $pagination = '';   
        }
        
        if( ! empty($pagination) && ! empty($totalRows) )
        {
            $table .= '<tr><th>P</th><td colspan="'.($languageCount + 3).'">'.$pagination.'</td></tr>'; 
        }
        
        $table .= '</tbody>';
        $table .= '</table>';
    
        return $table;
    }

    //--------------------------------------------------------------------------------------------------------
    // Lang
    //--------------------------------------------------------------------------------------------------------
    //
    // Sayfanın aktif dilini ayarlamak için kullanılır.
    // @param string $lang 
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function lang(String $lang = 'tr') : Bool
    {
        setLang($lang);
    }

    //--------------------------------------------------------------------------------------------------------
    // Style Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _styleElement()
    {
        if( ! empty($this->config['table']['styleElement']) )
        { 
            $attributes = NULL;

            foreach( $this->config['table']['styleElement'] as $selector => $attr )
            {
                $attributes .= \Sheet::selector($selector)->attr($attr)->create();
            }

            return \Style::open().$attributes.\Style::close();
        }

        return NULL;
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Protected Lang File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $rows
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _langFile($app)
    {
        return $this->appdir.$app.$this->extension; 
    }
}