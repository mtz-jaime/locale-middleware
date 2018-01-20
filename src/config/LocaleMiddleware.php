<?php
return [
    'enableMiddleware' => env('ENABLE_LOCALE_MIDDLEWARE', false),

    'testMode' => env('ENABLE_TEST_MIDDLEWARE', false),

    'database' => env('GEOIP_MAXMIND_DATABASE', storage_path('app/GeoLite2-Country.mmdb')),

    /*
     * Add into this array all the languages and locales that your application will support
     */
    'countryLang' => [
        'langDE' => [
            'AT',
            'CH',
            'DE',
            'LI',
        ],
        'langES' => [
            'AR',
            'BO',
            'CL',
            'CO',
            'CR',
            'CU',
            'DO',
            'EC',
            'ES',
            'GQ',
            'GT',
            'HN',
            'MX',
            'NI',
            'PA',
            'PE',
            'PY',
            'SV',
            'UY',
            'VE',
        ],
    ],

    /*
     * This array will map the keys that you added in the previous array "countryLang" with
     * the name of the folder for the translations. visit https://laravel.com/docs/master/localization.
     *
     * Note:Keep in mind to use the same keys in both arrays.
     */
    'mapToTranslations' => [
        'langDE' => 'de',
        'langES' => 'es',
    ],
];