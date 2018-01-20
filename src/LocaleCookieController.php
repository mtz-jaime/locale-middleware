<?php

namespace MtzJaime\LocaleMiddleware;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Foundation\Application;

class LocaleCookieController extends Controller
{

    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function index()
    {
        $getCookie = Cookie::has('visitLocale') ? Cookie::get('visitLocale') : null;
        if (!is_null($getCookie)) {
            $this->app->setLocale($getCookie);
        }

        return view('vendor.mtzJaime.index');
    }

    public function cookieRedirect($locale)
    {
        if (Cookie::has('visitLocale')) {
            unset($_COOKIE['visitLocale']);
        }

        $locales = config('LocaleMiddleware.mapToTranslations');
        if (in_array($locale, $locales)) {
            return redirect(route('middleware.test'), 301)->withCookie('visitLocale', $locale, 10080);
        } elseif ($locale == 'en') {
            return redirect(route('middleware.test'), 301)->withCookie('visitLocale', $locale, 10080);
        }

        return abort(404);
    }
}