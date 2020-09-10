<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ADMIN',
            'email' => 'adsianalitys@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Cliente',
            'email' => '1234@gmail.com',
            'password' => bcrypt('12345678'),
            'created_at' => Carbon::now(),
        ]);
    }
}
