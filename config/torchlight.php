<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Torchlight API Token
    |--------------------------------------------------------------------------
    |
    | Your Torchlight API token. You can get one at https://torchlight.dev
    |
    */

    'token' => env('TORCHLIGHT_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Torchlight Theme
    |--------------------------------------------------------------------------
    |
    | The theme to use for syntax highlighting. You can use any VS Code theme.
    | Default themes: 'dark-plus', 'light-plus', 'github-dark', 'github-light'
    |
    */

    'theme' => env('TORCHLIGHT_THEME', 'github-dark'),

    /*
    |--------------------------------------------------------------------------
    | Torchlight Options
    |--------------------------------------------------------------------------
    |
    | Additional options for Torchlight rendering.
    |
    */

    'options' => [
        'lineNumbers' => true,
        'summaryCollapsedIndicator' => 'Click to Show',
        'torchlightAnnotations' => true,
    ],
];
