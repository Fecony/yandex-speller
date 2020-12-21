<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Language Options
    |--------------------------------------------------------------------------
    |
    | This option specifies the default languages of the text to be checked.
    | The parameter value should be comma separated.
    |
    | Possible options: "en", "ru", "uk"
    |
    | Default: "en", "ru"
    |
    */
    'lang' => 'ru,en',

    /*
    |--------------------------------------------------------------------------
    | Format Option
    |--------------------------------------------------------------------------
    |
    | This option specifies the default format of the text to be checked.
    |
    | Possible options: "plain", "html"
    |
    | Default: "plain"
    |
    */
    'format' => 'plain',

    /*
    |--------------------------------------------------------------------------
    | Yandex Speller Options
    |--------------------------------------------------------------------------
    |
    | This option specifies the behaviour of the API.
    | The parameter value is the sum of the option values.
    |
    | Possible options: https://yandex.ru/dev/speller/doc/dg/reference/speller-options.html
    |
    | Default: 0
    |
    */
    'options' => 0,

];
