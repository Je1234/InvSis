<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TipoDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('tipo_documentos')->insert([
            ['nom_tipo_documento' => 'Cedula de ciudadania(C.C)'],
            ['nom_tipo_documento' => 'Cedula de extranjeria(C.E)'],
            ['nom_tipo_documento' => 'Tarjeta de identidad(T.I)'],
            ['nom_tipo_documento' => 'Pasaporte(P.A)'],
            ['nom_tipo_documento' => 'Registro civil(R.C)'],
        ]);
    }
}
