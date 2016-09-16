<?php namespace ZN\Helpers;

use CallController;

class InternalSearcher extends CallController implements SearcherInterface
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
    // Filter
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function filter(String $column, $value) : Searcher\SearcherDatabase
    {
        SearcherFactory::class('SearcherDatabase')->filter($column, $value);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Filter
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function orFilter(String $column, $value) : Searcher\SearcherDatabase
    {
        SearcherFactory::class('SearcherDatabase')->orFilter($column, $value);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Word
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $word
    //
    //--------------------------------------------------------------------------------------------------------
    public function word(String $word) : Searcher\SearcherDatabase
    {
        SearcherFactory::class('SearcherDatabase')->word($word);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function type(String $type) : Searcher\SearcherDatabase
    {
        SearcherFactory::class('SearcherDatabase')->type($type);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Database
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $conditions
    // @param string $word
    // @param string $type: auto, inside, equal, starting, ending
    //
    //--------------------------------------------------------------------------------------------------------
    public function database(Array $conditions, String $word = NULL, String $type = 'auto') : \stdClass
    {
        return SearcherFactory::class('SearcherDatabase')->do($conditions, $word, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $searchData
    // @param mixed  $searchWord
    // @param string $output: boolean, position, string
    //
    //--------------------------------------------------------------------------------------------------------
    public function data($searchData, $searchWord, String $output = 'boolean')
    {
        return SearcherFactory::class('SearcherData')->do($searchData, $searchWord, $output);
    }
}
