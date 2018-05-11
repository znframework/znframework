<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Head Page
    |--------------------------------------------------------------------------
    |
    | It is specified in which view the html codes in the [head] tags will be 
    | placed.
    |
    */

    'headPage' => '', # string or array

    /*
    |--------------------------------------------------------------------------
    | Head Page
    |--------------------------------------------------------------------------
    |
    | It is specified in which view the html codes in the [body] tags will be 
    | placed.
    |
    */

    'bodyPage' => '',

    /*
    |--------------------------------------------------------------------------
    | Document Type
    |--------------------------------------------------------------------------
    |
    | The type of document to use.
    |
    | Types: html5  , html4Frameset , html4Transitional , html4Strict
    |        xhtml11, xhtml1Frameset, xhtml1Transitional, xhtml1Strict
    |
    */

    'docType' => 'html5',

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Edit the [title] tag.
    |
    */

    'title' => '',

    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    |
    | The language and charset of your content.
    |
    */

    'content' =>
    [
        'language' => 'tr',
        'charset'  => ['utf-8']
    ],

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | The settings below are just like using the 
    | Import::theme/plugin/font/style/script() method.
    |
    */

    'theme'  =>
    [
        'name'      => [],
        'recursive' => false
    ],
    
    'plugin' =>
    [
        'name'      => '',
        'recursive' => false
    ],

    /*
    |--------------------------------------------------------------------------
    | Browser Icon
    |--------------------------------------------------------------------------
    |
    | The browser icon to be used.
    |
    */

    'browserIcon' => '',

    /*
    |--------------------------------------------------------------------------
    | Background Image
    |--------------------------------------------------------------------------
    |
    | The background image to be used.
    |
    */

    'backgroundImage' => '',

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    |
    | Adds a property value pair to the [html], [head] and [body] tags.
    |
    | ['id' => 'body', 'name' => 'Body'] <body id="body" name="Body">
    |
    */

    'attributes' =>
    [
        'html' => [],
        'head' => [],
        'body' => []
    ],

    /*
    |--------------------------------------------------------------------------
    | Meta 
    |--------------------------------------------------------------------------
    |
    | Used to edit meta tags.
    |
    */

    'meta' =>
    [
        'name:description'   => '',
        'name:author'        => '',
        'name:designer'      => '',
        'name:distribution'  => '',
        'name:keywords'      => '',
        'name:abstract'      => '',
        'name:copyright'     => '',
        'name:expires'       => '',
        'name:pragma'        => '',
        'name:revisit-after' => '',
        'http:cache-control' => '',
        'http:refresh'       => '',
        'name:robots'        => []
    ]
];
