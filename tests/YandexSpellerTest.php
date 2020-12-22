<?php

namespace Fecony\YandexSpeller\Tests;

use Fecony\YandexSpeller\Facade\YandexSpeller;
use Illuminate\Http\JsonResponse;

class YandexSpellerTest extends TestCase
{
    /** @test */
    public function it_returns_response_object()
    {
        $response = YandexSpeller::check('Helllo');
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /** @test */
    public function it_returns_success_status_code()
    {
        $response = YandexSpeller::check('Helllo');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function user_can_edit_default_config()
    {
        // It will return empty result since passed text in different language
        config()->set('yandex-speller.lang', 'en');

        $response = YandexSpeller::check('приветд мир');
        $jsonResponse = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertJson($response->getContent());
        $this->assertArrayHasKey('data', $jsonResponse);
    }

    /** @test */
    public function it_returns_response_from_helper_function()
    {
        $response = speller('Hello world!');
        $jsonResponse = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $jsonResponse['status']);
        $this->assertIsArray($jsonResponse['data']);
    }

    /** @test */
    public function it_returns_response_with_suggestions()
    {
        $response = speller('Helllo world!');
        $jsonResponse = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $jsonResponse['status']);
        $this->assertIsArray($jsonResponse['data']);
        $this->assertArrayHasKey('s', $jsonResponse['data'][0]);
        $this->assertIsArray($jsonResponse['data'][0]['s']);
    }

    /** @test */
    public function it_returns_response_with_suggestions_from_helper_function()
    {
        $response = speller('Helllo world!');
        $jsonResponse = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $jsonResponse['status']);
        $this->assertIsArray($jsonResponse['data']);
        $this->assertArrayHasKey('s', $jsonResponse['data'][0]);
        $this->assertIsArray($jsonResponse['data'][0]['s']);
    }

    /** @test */
    public function it_returns_response_with_suggestions_for_array_of_strings()
    {
        $wordOne = 'Helllo';
        $wordTwo = 'Worrld';

        $expectedSuggestionOne = 'Hello';
        $expectedSuggestionTwo = 'World';

        $response = speller([$wordOne, $wordTwo]);
        $jsonResponse = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $jsonResponse['status']);
        $this->assertIsArray($jsonResponse['data']);
        $this->assertIsArray($jsonResponse['data'][0]);
        $this->assertIsArray($jsonResponse['data'][0][0]);
        $this->assertIsArray($jsonResponse['data'][0][1]);

        $this->assertArrayHasKey('s', $jsonResponse['data'][0][0]);
        $this->assertArrayHasKey('s', $jsonResponse['data'][0][1]);

        $this->assertIsArray($jsonResponse['data'][0][0]['s']);
        $this->assertIsArray($jsonResponse['data'][0][1]['s']);

        $this->assertEquals($wordOne, $jsonResponse['data'][0][0]['word']);
        $this->assertEquals($wordTwo, $jsonResponse['data'][0][1]['word']);
        $this->assertEquals($expectedSuggestionOne, $jsonResponse['data'][0][0]['s'][0]);
        $this->assertEquals($expectedSuggestionTwo, $jsonResponse['data'][0][1]['s'][0]);
    }

    /** @test */
    public function method_params_allow_to_rewrite_config()
    {
        // It will return empty result since passed text in different language
        $response = YandexSpeller::check('приветд мир', 'en');
        $jsonResponse = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertJson($response->getContent());
        $this->assertArrayHasKey('data', $jsonResponse);
    }
}
