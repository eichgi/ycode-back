<?php

use App\Website;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class WebsitesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Due to faker word repetition inside the factory this method is not 100% accurate
         * since you might have to run it several times until no uniqueness collision happens.
         */
        //factory(Website::class, 20)->create();

        /**
         * Unlike the previous method, this will consume an API for words gathering
         */
        try {
            $client = new Client();
            $response = $client->get('https://random-word-api.herokuapp.com/word?number=100');
            $sites = json_decode($response->getBody());

            collect($sites)->each(function ($site) {
                Website::create([
                    'name' => $site,
                    'url' => "{$site}.example.com",
                    'created_at' => now()->addMinutes(rand(1, 60)),
                ]);
            });
        } catch (Exception $exception) {
            $this->info($exception->getMessage());
        }
    }
}
