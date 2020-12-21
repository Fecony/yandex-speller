<?php

namespace Fecony\YandexSpeller\Providers;

use Fecony\YandexSpeller\YandexSpeller;
use Illuminate\Support\ServiceProvider;

class YandexSpellerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/yandex-speller.php' => config_path('yandex-speller.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/yandex-speller.php', 'yandex-speller'
        );

        $this->app->singleton('yandex-speller', function () {
            return new YandexSpeller();
        });

        $this->app->bind(YandexSpeller::class, function () {
            return new YandexSpeller();
        });
    }
}
