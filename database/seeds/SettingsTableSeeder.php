<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'site_name'=>"Anil's Blog",
            'address'=>'Khumaltar, Lalitpur',
            'contact_email'=>'info@anil.com',
            'contact_number'=>'9843777152'
        ]);
    }
}
