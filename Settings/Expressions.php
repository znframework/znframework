<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Regex
    |--------------------------------------------------------------------------
    |
    | You can specify your custom regular expressions that 
    | you want to use for the route.
    |
    */

    'regex' =>
    [
        '{id}' => '[0-9]+'
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbols
    |--------------------------------------------------------------------------
    |
    | You can create usable expressions with the Symbol library.
    |
    | Example: Symbol::sum()
    |
    */

    'symbols' =>
    [
        'sum'   => '&#8721;', // ∑
        'empty' => '&#8709;'  // ∅
    ],

    /*
    |--------------------------------------------------------------------------
    | Mimem Types
    |--------------------------------------------------------------------------
    |
    | You can create new types of mime that are available with Mime library.
    |
    | Example: Mime::xlsxx()
    |
    */

    'mimeTypes' => [],

    /*
    |--------------------------------------------------------------------------
    | Accent Chars
    |--------------------------------------------------------------------------
    |
    | You can specify the characters you want to be converted with the 
    | Converter::accent() method.
    |
    */

    'accentChars' =>
    [
        'œ' => 'oe',
        'ü' => 'u'
    ],

    /*
    |--------------------------------------------------------------------------
    | Different Font Extensions
    |--------------------------------------------------------------------------
    |
    | Default fonts SVG, WOFF, EOT, OTF, TTF. You can also specify types that 
    | can be called with the Import::font() method.
    |
    */
    
    'differentFontExtensions' => [],

    /*
    |--------------------------------------------------------------------------
    | Document Types
    |--------------------------------------------------------------------------
    |
    | Apart from the built-in document type, you can add the document type 
    | yourself. You can use these definitions with Masterpage.
    |
    */

    'doctypes' => []
];
