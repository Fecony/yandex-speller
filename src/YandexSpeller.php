<?php

namespace Fecony\YandexSpeller;

use Fecony\YandexSpeller\Http\HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class YandexSpeller extends HttpClient
{
    /** @var string contains an API endpoint */
    protected $uri;

    /** @var string|array contains passed in string or array of strings. */
    protected $text;

    /** @var string|null may contain comma separated languages to override default config. */
    protected $lang;

    /** @var int|null optional parameter value is the sum of the values of the required options. */
    protected $options;

    /** @var string|null option specifies the default format of the text. */
    protected $format;

    /** @var array query options used to determine API behaviour. */
    protected $query;

    /** @var array contains supported options. */
    protected $queryOptions = [
        'lang',
        'options',
        'format',
    ];

    /**
     * Checks spelling in the specified $text passage.
     *
     * $text variable may be an array of strings.
     *
     * @param $text
     * @param string|null $lang
     * @param int|null $options
     * @param string|null $format
     * @return JsonResponse|null
     */
    public function check($text, string $lang = null, int $options = null, string $format = null): ?JsonResponse
    {
        $this->text = $text;
        $this->lang = $lang;
        $this->options = $options;
        $this->format = $format;
        $this->query = [];

        return $this->checkText();
    }

    /**
     * @return JsonResponse
     */
    private function checkText(): ?JsonResponse
    {
        $query = $this->getQuery();

        try {
            $response = $this->client->request('POST', $this->uri, [
                'query' => $query,
            ]);

            return response()->json([
                'status' => $response->getStatusCode(),
                'data' => $response->getBody()->getContents(),
            ], $response->getStatusCode());
        } catch (GuzzleException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @return array
     */
    protected function getQuery(): array
    {
        return $this->buildTextQuery()->buildQueryParams();
    }

    /**
     * @return array
     */
    protected function buildQueryParams(): array
    {
        foreach ($this->queryOptions as $option) {
            $this->query[$option] = $this->{$option} ?: config('yandex-speller.'.$option);
        }

        return $this->query;
    }

    /**
     * @return YandexSpeller
     */
    protected function buildTextQuery(): YandexSpeller
    {
        if (is_array($this->text)) {
            $this->query['text'] = implode('&text=', $this->text);
            $this->uri = self::CHECK_TEXTS_ENDPOINT;
        } else {
            $this->query['text'] = $this->text;
            $this->uri = self::CHECK_TEXT_ENDPOINT;
        }

        return $this;
    }
}
