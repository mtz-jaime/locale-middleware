<?php

namespace MtzJaime\LocaleMiddleware;

use Illuminate\Support\ServiceProvider;
use MtzJaime\LocaleMiddleware\Console\GetGeoIPCommand;
use MtzJaime\LocaleMiddleware\Console\RemoveTestFilesCommand;

class LocaleMiddlewareServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/LocaleMiddleware.php' => config_path('LocaleMiddleware.php')], 'config');
        $this->publishes([
            __DIR__ . '/lang/en.php'           => resource_path('lang/en/languageTest.php'),
            __DIR__ . '/lang/de.php'           => resource_path('lang/de/languageTest.php'),
            __DIR__ . '/lang/es.php'           => resource_path('lang/es/languageTest.php'),
            __DIR__ . '/views/index.blade.php' => resource_path('views/vendor/mtzJaime/index.blade.php'),
        ], 'test');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('ENABLE_LOCALE_MIDDLEWARE', false) === true) {
            if (file_exists(resource_path('views/vendor/mtzJaime/index.blade.php'))) {
                include __DIR__ . '/routes.php';
            }
            $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
            $kernel->prependMiddleware('MtzJaime\LocaleMiddleware\Middleware\LocaleGeoIP');

            $this->app->singleton('command.mtzJaime.remove-test-files', function () {
                return new RemoveTestFilesCommand();
            });
            $this->commands('command.mtzJaime.remove-test-files');
            $this->app->singleton('command.mtzJaime.get-geoIP', function () {
                return new GetGeoIPCommand();
            });
            $this->commands('command.mtzJaime.get-geoIP');
        }
    }
}
