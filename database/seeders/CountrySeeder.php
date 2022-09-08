<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // return string
        //1) $json = file_get_contents('database/data/Country.json');
        
        // laravel path helper function, give 'database' folder dir
        
        $json = file_get_contents(database_path('data/Country.json'));
        // get string
        // $json = Storage::disk('hohey')->get('Country.json');

        // convert array
        $data = json_decode($json, true);

        DB::table('countries')->insert($data);
    }
}
