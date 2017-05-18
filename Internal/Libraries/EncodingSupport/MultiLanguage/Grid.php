<?php namespace ZN\EncodingSupport\MultiLanguage;

use Method, Html, Form, URI, Pagination, Sheet, Style;

class Grid extends MLExtends implements GridInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // $limit
    //--------------------------------------------------------------------------------------------------------
    //
    // @var int: 10
    //
    //--------------------------------------------------------------------------------------------------------
    protected $limit = 10;

    //--------------------------------------------------------------------------------------------------------
    // $url
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string: NULL
    //
    //--------------------------------------------------------------------------------------------------------
    protected $url   = NULL;

    //--------------------------------------------------------------------------------------------------------
    // Url()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url
    //
    //--------------------------------------------------------------------------------------------------------
    public function url(String $url = NULL) : Grid
    {
        $this->url = $url;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // limit()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $limit
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit(Int $limit = NULL) : Grid
    {
        $this->limit = $limit;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  mixed $app
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
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
                Factory::class('Insert')->do(Method::post('ML_ADD_LANGUAGE'), 'example', 'Example');
            }

            // ALL DELETE
            if( Method::post('ML_ALL_DELETE_SUBMIT') )
            {
                $allDelete = Method::post('ML_ALL_DELETE_HIDDEN');
                Factory::class('Delete')->all($allDelete);
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
                    Factory::class('Insert')->do($lang, $addKeyword, $addWords[$key]);
                }
            }

            // UPDATE
            if( Method::post('ML_UPDATE_KEYWORD_SUBMIT') )
            {
                if( ! empty($languages) ) foreach( $languages as $key => $lang )
                {
                    Factory::class('Update')->do($lang, $keyword, $words[$key]);
                }
            }

            // DELETE
            if( Method::post('ML_DELETE_SUBMIT') )
            {
                if( ! empty($languages) ) foreach( $languages as $key => $lang )
                {
                    Factory::class('Delete')->do($lang, $keyword);
                }
            }
        }

        $config = ENCODINGSUPPORT_ML_CONFIG['table'];

        $attributes         = $config['attributes'];
        $pagcon             = $config['pagination'];
        $placeHolders       = $config['placeHolders'];
        $buttonNames        = $config['buttonNames'];
        $title              = $config['labels']['title'];
        $confirmMessage     = $config['labels']['confirm'];
        $process            = $config['labels']['process'];
        $keywords           = $config['labels']['keywords'];

        $confirmBox = ' onsubmit="return confirm(\''.$confirmMessage.'\');"';

        $data = Factory::class('Select')->all($app);

        $languageCount = count($data);

        $table  = $this->_styleElement();
        $table .= '<table id="ML_TABLE"'.Html::attributes($attributes['table']).'>';
        $table .= '<thead>';
        $table .= '<tr><th colspan="'.($languageCount + 4).'">'.$title.'</th></tr>';
        $table .= '<tr><th>S/L</th>';
        $table .= '<td colspan="'.($languageCount + 3).'">';
        $table .= '<form name="ML_SEARCH_ADD_LANGUAGE_FORM" method="post">';
        $table .= Form::attr($attributes['textbox'])->placeholder($placeHolders['search'])->text('ML_SEARCH');
        $table .= Form::attr($attributes['add'])->submit('ML_SEARCH_SUBMIT', $buttonNames['search']);
        $table .= Form::attr($attributes['textbox'])->placeholder($placeHolders['addLanguage'])->text('ML_ADD_LANGUAGE');
        $table .= Form::attr($attributes['add'])->submit('ML_ADD_ALL_LANGUAGE_SUBMIT', $buttonNames['add']).'</td>';
        $table .= '</form>';
        $table .= '</tr>';

        $table .= '<tr><th>#</th><td><strong>'.$keywords.'</strong></td>';

        $words = [];
        $formObjects = '';

        $languages   = implode(',', array_keys($data));
        $mlLanguages = Form::hidden('ML_LANGUAGES', $languages);

        foreach( $data as $lang => $values )
        {
            $upperLang = strtoupper($lang);

            $table .= '<form name="ML_TOP_FORM_'.$upperLang.'" method="post"'.$confirmBox.'>';
            $table .= '<td><strong>'.$upperLang.Form::hidden('ML_ALL_DELETE_HIDDEN', $lang).Form::attr($attributes['delete'])->submit('ML_ALL_DELETE_SUBMIT', $buttonNames['delete']).'</strong></td>';
            $table .= '</form>';
            foreach( $values as $key => $val )
            {
                $words[$key][] = $val;
            }

            $formObjects .= '<td>'.Form::attr($attributes['textbox'])->placeholder($upperLang)->text('ML_ADD_WORDS[]').'</td>';
        }
        $table .= '<td><strong>'.$process.'</strong></td>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        $table .= '<tr>';
        $table .= '<form name="ML_TOP_FORM" method="post">';
        $table .= '<th>N</th>';
        $table .= '<td>'.$mlLanguages.Form::attr($attributes['textbox'])->placeholder($placeHolders['keyword'])->text('ML_ADD_KEYWORD').'</td>';
        $table .= $formObjects;
        $table .= '<td>'.Form::attr($attributes['add'])->submit('ML_ADD_KEYWORD_SUBMIT', $buttonNames['add']).' '.Form::attr($attributes['clear'])->reset('ML_ADD_KEYWORD_RESET', $buttonNames['clear']).'</td>';
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
            $table .= '<td>'.Form::hidden('ML_UPDATE_KEYWORD_HIDDEN', $key).$key.'</td>';

            for( $i = 0; $i < $languageCount; $i++ )
            {
                $table .= '<td>'.Form::attr($attributes['textbox'])->text('ML_UPDATE_WORDS[]', ( ! empty($val[$i]) ? $val[$i] : '' )).'</td>';
            }

            $table .= '<td>'.$mlLanguages.Form::attr($attributes['update'])->submit('ML_UPDATE_KEYWORD_SUBMIT', $buttonNames['update']);
            $table .= ' ';
            $table .= Form::attr($attributes['delete'])->submit('ML_DELETE_SUBMIT', $buttonNames['delete']).'</td>';
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
            $pagination = Pagination::style($pagcon['style'])
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

    //--------------------------------------------------------------------------------------------------------
    // Style Element
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _styleElement()
    {
        $styleElementConfig = ENCODINGSUPPORT_ML_CONFIG['table']['styleElement'] ?? NULL;

        if( ! empty($styleElementConfig) )
        {
            $attributes = NULL;

            foreach( $styleElementConfig as $selector => $attr )
            {
                $attributes .= Sheet::selector($selector)->attr($attr)->create();
            }

            return Style::open().$attributes.Style::close();
        }

        return NULL;
    }
}
