<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        realpath(base_path('resources/views')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => realpath(storage_path('framework/views')),
    'paginate' => 5,
    
    'number' => [
        'zero' => 0,
        'one' => 1
    ],

    'yes' => 'Yes',
    'no' => 'No',
    'take-category' => 9,
    'take-product' => 8,
    'panigate-10' => 10,
    'panigate-24' => 24,
    'similar-product' => 6,
    'number-shop' => 8,
    'status' => ['status', 'on-sell', 'out-off'],
    'soft' => [0, 1, 2, 3, 4],
];
