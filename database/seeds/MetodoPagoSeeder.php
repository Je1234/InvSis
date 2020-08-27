<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('metodo_pagos')->insert([
            ['nom_metodo_pago' => 'Efectivo'],
            ['nom_metodo_pago' => 'Tarjeta de credito o debito'],
            ['nom_metodo_pago' => 'Cheque'],
            ['nom_metodo_pago' => 'Transferencia bancaria'],
            ['nom_metodo_pago' => 'Paypal']
        ]);
    }
}
