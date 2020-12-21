<?php

use Fecony\YandexSpeller\YandexSpeller;
use Illuminate\Http\JsonResponse;

if (! function_exists('speller')) {

    /**
     * Checks spelling in the specified $text passage.
     *
     * $text variable may be an array of strings.
     *
     * @param $text
     * @param string|null $lang
     * @param int|null $options
     * @param string|null $format
     * @return JsonResponse|mixed
     */
    function speller($text, string $lang = null, int $options = null, string $format = null)
    {
        return app(YandexSpeller::class)->check($text, $lang, $options, $format);
    }
}
