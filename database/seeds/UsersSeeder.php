<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'email' => '123@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
