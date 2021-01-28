<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('urls')->insert([
            'user_id' => 1,
            'url' => 'https://facebook.com',
            'short_url' => 'https://bit.ly/3cetIOF'
        ]);
        DB::table('urls')->insert([
            'user_id' => 1,
            'url' => 'https://github.com',
            'short_url' => 'https://bit.ly/3cet6Zn'
        ]);
    }
}
