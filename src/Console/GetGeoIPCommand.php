<?php

namespace MtzJaime\LocaleMiddleware\Console;

use PharData;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GetGeoIPCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtzJaime:get-geoIP';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get or update GeoIP DB from MaxMind';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $storage = storage_path('app/geoIP');

        $this->cleaner($storage);

        if (!file_exists($storage)) {
            mkdir($storage, 0755, true);
        }

        $client = new Client;
        $client->get(
            'http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.tar.gz',
            [
                'save_to' => $storage . '/GeoLite2-Country.tar.gz',
            ]);

        $file = new PharData($storage . '/GeoLite2-Country.tar.gz');
        $file->decompress();

        $phar = new PharData($storage . '/GeoLite2-Country.tar');
        $phar->extractTo($storage);

        $dir = scandir($storage);
        $origin = $storage . '/' . $dir[ 4 ] . '/GeoLite2-Country.mmdb';
        $destiny = storage_path('app/GeoLite2-Country.mmdb');
        exec("cp $origin $destiny");

        $this->cleaner($storage);

        $this->info('Done!');
    }

    /**
     * Delete unnecessary files
     *
     * @param string $storage
     */
    protected function cleaner($storage)
    {
        if (file_exists($storage)) {
            exec('rm -r ' . $storage);
        }
    }
}
