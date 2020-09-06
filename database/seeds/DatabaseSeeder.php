<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoDocSeeder::class);
        $this->call(MetodoPagoSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
    }
}
