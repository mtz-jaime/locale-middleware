# Locale Middleware Package

This package will help you to localize your application depending from where a user is coming using geoIP, 
also offers the possibility to overwrite the default language provided via geoIP using a cookie.

## Getting Started

### Installation

Install via Composer.
 
```
composer require mtz-jaime/locale-middleware
```
If you are using Laravel 5.5 this package already includes the auto discovery package. 
If for some reason you decided to remove this functionality on your application, add the service provider into your application config. 

Do this by adding the following line to the 'providers' section of the application config (usually config/app.php):

```php
MtzJaime\LocaleMiddleware\LocaleMiddlewareServiceProvider::class,
```

Publish the config file in order to have control to decide which languages your applications is going to support, 
also to enable the middleware functionality. 
```php
php artisan vendor:publish --provider="MtzJaime\LocaleMiddleware\LocaleMiddlewareServiceProvider" --tag="config"
```

To enable the middleware add the following variable _ENABLE_LOCALE_MIDDLEWARE=true_ in your _.env_ file, 
to disable the middleware just delete the variable or change it to _false_. 

To download the geoIP binary file there are two options.
- (Option #1) 
You can find a free version [here](https://dev.maxmind.com/geoip/geoip2/geolite2) of the file GeoLite2 Country by MaxMind DB.
Also you need to add the following variable _GEOIP_MAXMIND_DATABASE='storage/path/of/the/binary'_ in your _.env_ file,
as a good practice is recommended to stored this kind of files under your storage folder. 

- (Option #2)
You can simply run the following command and let the package do the rest. You don't need to add here the .env variable
```php
php artisan mtzJaime:get-geoIP
```

### Setting up the cookie

On the file _app/Http/Middleware/EncryptCookies.php_ add under _$except array_ the value _'visitLocale',_

You can take a look and create your own version of the LocaleCookieController.php 
(_vendor/mtz-jaime/locale-middleware/src/LocaleCookieController.php_)


### Testing the middleware

This package offers you out of the box the possibility to test if the localization functionality is working.

Publish the needed views and translations using the following command:
```php
php artisan vendor:publish --provider="MtzJaime\LocaleMiddleware\LocaleMiddlewareServiceProvider" --tag="test"
```
Then add in your _.env_ file the following variable _ENABLE_TEST_MIDDLEWARE=LOCALE_ this variable can be set for any of the supported 
locales present on the config file _LocaleMiddleware_.
 
Note: add the locale in uppercase
```php
ENABLE_TEST_MIDDLEWARE=CH or
ENABLE_TEST_MIDDLEWARE=MX 
```

Finally just access to the following link _'http://your.app/middleware/test'_ and the middleware will be up and running

If you are switching between locales remember to clear the config cache of your application. 
```php
php artisan config:clear
```

To remove the testing files just run the following command and delete manually the variable that you added in your .env file
```php
php artisan mtzJaime:remove-test-files
```