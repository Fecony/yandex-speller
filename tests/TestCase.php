<?php

namespace Fecony\YandexSpeller\Tests;

use Fecony\YandexSpeller\Providers\YandexSpellerServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Foundation\Application;

/**
 * Override the standard PHPUnit testcase with the Testbench testcase
 *
 * @see https://github.com/orchestral/testbench#usage
 */
abstract class TestCase extends OrchestraTestCase
{
    /**
     * Include the package's service provider(s)
     *
     * @see https://github.com/orchestral/testbench#custom-service-provider
     * @param Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [YandexSpellerServiceProvider::class];
    }
}
