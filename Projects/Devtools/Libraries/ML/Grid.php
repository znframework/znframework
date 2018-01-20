<?php namespace ML;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Lang;
use ZN\Hypertext;
use ZN\Singleton;
use ZN\Request\URI;
use ZN\Request\Method;

class Grid extends MLExtends
{
    /**
     * Keeps limit
     * 
     * @var int
     */
    protected $limit = 10;

    /**
     * Keeps url
     * 
     * @var string
     */
    protected $url = NULL;

    /**
     * Magic Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->getLang = Lang::select('Language');
    }

    /**
     * Set URL
     * 
     * @param string $url = NULL
     * 
     * @return Grid
     */
    public function url(String $url = NULL) : Grid
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set Limit
     * 
     * @param int $limit = NULL
     * 
     * @return Grid
     */
    public function limit(Int $limit = NULL) : Grid
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Creates table
     * 
     * @param mixed $app = NULL
     * 
     * @return string
     */
    public function create($app = NULL) : String
    {
        $searchWord = '';

        if( Method::post() )
        {
            $keyword   = Method::post('ML_UPDATE_KEYWORD_HIDDEN');
            $languages = explode(',', Method::post('ML_LANGUAGES'));
            $words     = Method::post('ML_UPDATE_WORDS');

            // SEARCH
            if( Method::post('ML_SEARCH_SUBMIT') )
            {
                $searchWord = Method::post('ML_SEARCH');
            }

            // ADD LANGUAGE
            if( Method::post('ML_ADD_ALL_LANGUAGE_SUBMIT') )
            {
                (new Insert)->do(Method::post('ML_ADD_LANGUAGE'), 'example', 'Example');
            }

            // ALL DELETE
            if( Method::post('ML_ALL_DELETE_SUBMIT') )
            {
                $allDelete = Method::post('ML_ALL_DELETE_HIDDEN');
                (new Delete)->all($allDelete);
            }

            // ADD
            if( Method::post('ML_ADD_KEYWORD_SUBMIT') )
            {
                $addWords   = Method::post('ML_ADD_WORDS');
                $addKeyword = Method::post('ML_ADD_KEYWORD');

                if( is_numeric($addKeyword) )
                {
                    $addKeyword = 'Wrong Keyword! Only String.';
                }

                if( ! empty($languages) ) foreach( $languages as $key => $lang )
                {
                    (new Insert)->do($lang, $addKeyword, $addWords[$key]);
                }
            }

            // UPDATE
            if( Method::post('ML_UPDATE_KEYWORD_SUBMIT') )
            {
                if( ! empty($languages) ) foreach( $languages as $key => $lang )
                {
                    (new Update)->do($lang, $keyword, $words[$key]);
                }
            }

            // DELETE
            if( Method::post('ML_DELETE_SUBMIT') )
            {
                if( ! empty($languages) ) foreach( $languages as $key => $lang )
                {
                    (new Delete)->do($lang, $keyword);
                }
            }
        }

        $config = $this->gridConfig;

        $attributes         = $config['attributes'];
        $pagcon             = $config['pagination'];
        $title              = $this->getLang['ml:titleLabel'];
        $confirmMessage     = $this->getLang['ml:confirmLabel'];
        $process            = $this->getLang['ml:processLabel'];
        $keywords           = $this->getLang['ml:keywordsLabel'];

        $confirmBox = ' onsubmit="return confirm(\''.$confirmMessage.'\');"';

        $data = (new Select)->all($app);

        $languageCount = count($data);

        $formClass = Singleton::class('ZN\Hypertext\Form');

        $table  = $this->_styleElement();
        $table .= '<table id="ML_TABLE"'.Hypertext::attributes($attributes['table']).'>';
        $table .= '<thead>';
        $table .= '<tr><th colspan="'.($languageCount + 4).'">'.$title.'</th></tr>';
        $table .= '<tr><th>S/L</th>';
        $table .= '<td colspan="'.($languageCount + 3).'">';
        $table .= '<form name="ML_SEARCH_ADD_LANGUAGE_FORM" method="post">';
        $table .= $formClass->attr($attributes['textbox'])->placeholder($this->getLang['ml:searchPlaceHolder'])->text('ML_SEARCH');
        $table .= $formClass->attr($attributes['add'])->submit('ML_SEARCH_SUBMIT', $this->getLang['ml:searchButton']);
        $table .= $formClass->attr($attributes['textbox'])->placeholder($this->getLang['ml:addLanguagePlaceHolder'])->text('ML_ADD_LANGUAGE');
        $table .= $formClass->attr($attributes['add'])->submit('ML_ADD_ALL_LANGUAGE_SUBMIT', $this->getLang['ml:addButton']).'</td>';
        $table .= '</form>';
        $table .= '</tr>';
        $table .= '<tr><th>#</th><td><strong>'.$keywords.'</strong></td>';

        $words = [];
        $formObjects = '';

        $languages   = implode(',', $arrayKeys = array_keys($data));
        $mlLanguages = $formClass->hidden('ML_LANGUAGES', $languages);

        foreach( $data as $lang => $values )
        {
            $upperLang = strtoupper($lang);

            $table .= '<form name="ML_TOP_FORM_'.$upperLang.'" method="post"'.$confirmBox.'>';
            $table .= '<td><strong>'.$upperLang.$formClass->hidden('ML_ALL_DELETE_HIDDEN', $lang).$formClass->attr($attributes['delete'])->submit('ML_ALL_DELETE_SUBMIT', $this->getLang['ml:deleteButton']).'</strong></td>';
            $table .= '</form>';
            
            foreach( $values as $key => $val )
            {
                $words[$key][$lang] = $val;
            }

            $formObjects .= '<td>'.$formClass->attr($attributes['textbox'])->placeholder($upperLang)->text('ML_ADD_WORDS[]').'</td>';
        }

        $table .= '<td><strong>'.$process.'</strong></td>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        $table .= '<tr>';
        $table .= '<form name="ML_TOP_FORM" method="post">';
        $table .= '<th>N</th>';
        $table .= '<td>'.$mlLanguages.$formClass->attr($attributes['textbox'])->placeholder($this->getLang['ml:keywordPlaceHolder'])->text('ML_ADD_KEYWORD').'</td>';
        $table .= $formObjects;
        $table .= '<td>'.$formClass->attr($attributes['add'])->submit('ML_ADD_KEYWORD_SUBMIT', $this->getLang['ml:addButton']).' '.$formClass->attr($attributes['clear'])->reset('ML_ADD_KEYWORD_RESET', $this->getLang['ml:clearButton']).'</td>';
        $table .= '</form>';
        $table .= '</tr>';

        $limit     = $this->limit;
        $start     = (int) URI::segment(-1);
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

                    foreach( $val as $k => $v )
                    {
                        if( stristr($v, $searchWord) )
                        {
                            $newValues = array_merge($newValues, $val);
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
            $table .= '<td>'.$formClass->hidden('ML_UPDATE_KEYWORD_HIDDEN', $key).$key.'</td>';

            foreach( $arrayKeys as $i )
            {
                $table .= '<td>'.$formClass->attr($attributes['textbox'])->text('ML_UPDATE_WORDS[]', ( ! empty($val[$i]) ? $val[$i] : '' )).'</td>';
            }

            $table .= '<td>'.$mlLanguages.$formClass->attr($attributes['update'])->submit('ML_UPDATE_KEYWORD_SUBMIT', $this->getLang['ml:updateButton']);
            $table .= ' ';
            $table .= $formClass->attr($attributes['delete'])->submit('ML_DELETE_SUBMIT', $this->getLang['ml:deleteButton']).'</td>';
            $table .= '</form>';
            $table .= '</tr>';
        }

        if( empty($this->url) )
        {
            $paginationUrl = CURRENT_CFPATH;
        }
        else
        {
            $paginationUrl = $this->url;
        }

        if( empty($searchWord) )
        {
            $pagination = Singleton::class('ZN\Pagination\Paginator')
                                   ->style($pagcon['style'])
                                   ->css($pagcon['class'])
                                   ->start($start)
                                   ->totalRows($totalRows)
                                   ->limit($limit)
                                   ->url($paginationUrl)
                                   ->create();
        }
        else
        {
            $pagination = NULL;
        }

        if( ! empty($pagination) && ! empty($totalRows) )
        {
            $table .= '<tr><th>P</th><td colspan="'.($languageCount + 3).'">'.$pagination.'</td></tr>';
        }

        $table .= '</tbody>';
        $table .= '</table>';

        return $table;
    }

    /**
     * Protected Style Element
     */
    protected function _styleElement()
    {
        $styleElementConfig = $this->gridConfig['styleElement'] ?? NULL;

        if( ! empty($styleElementConfig) )
        {
            $attributes = NULL;

            $sheet = Singleton::class('ZN\Hypertext\Sheet');
            $style = Singleton::class('ZN\Hypertext\Style');

            foreach( $styleElementConfig as $selector => $attr )
            {
                $attributes .= $sheet->selector($selector)->attr($attr)->create();
            }

            return $style->open().$attributes.$style->close();
        }

        return NULL;
    }
}
