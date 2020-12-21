<?php

namespace Fecony\YandexSpeller\Facade;

use Illuminate\Support\Facades\Facade;

class YandexSpeller extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'yandex-speller';
    }
}
