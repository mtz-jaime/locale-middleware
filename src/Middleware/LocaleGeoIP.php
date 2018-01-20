<?php

namespace MtzJaime\LocaleMiddleware\Middleware;

use Closure;
use GeoIp2\Database\Reader;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use GeoIp2\Exception\AddressNotFoundException;

class LocaleGeoIP
{

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = config('app.locale');

        try {
            $countryLang = config('LocaleMiddleware.countryLang');
            $map = config('LocaleMiddleware.mapToTranslations');
            $testMode = config('LocaleMiddleware.testMode');

            $clientISO = $testMode !== false ? $testMode : null;
            if ($clientISO === null) {
                $reader = new Reader(config('LocaleMiddleware.database'));
                $clientIP = $request->ip();
                $record = $reader->country($clientIP);
                $clientISO = $record->country->isoCode;
            }

            foreach ($map as $lang => $folderLang) {
                if (in_array($clientISO, $countryLang[$lang])) {
                    $locale = $folderLang;
                }
            }

            $this->app->setLocale($locale);

        } catch (AddressNotFoundException $clientIP) {

            $this->app->setLocale($locale);
        }

        return $next($request);
    }
}