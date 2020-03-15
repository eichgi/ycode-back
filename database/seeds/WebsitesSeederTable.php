<?php

use App\Website;
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
        factory(Website::class, 20)->create();
    }
}
