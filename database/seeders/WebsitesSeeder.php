<?php

namespace Database\Seeders;

use App\Models\Websites;
use Exception;
use Illuminate\Database\Seeder;

class WebsitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $websites_file = database_path("seeders/data/websites.csv");
        try {
            $websites = file_get_contents($websites_file);
            $lines = explode("\n", $websites);
            foreach ($lines as $website) {
                if ($website) {
                    Websites::firstOrCreate([
                        'domain' => $website
                    ]);
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
