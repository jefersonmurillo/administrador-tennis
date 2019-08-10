<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TipoDocumentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::truncate();
        TipoDocumento::create(
            ['tipo' => 'CEDULA DE CIUDADANIA'],
            ['tipo' => 'CEDULA DE EXTRANGERIA'],
            ['tipo' => 'PASAPORTE']
        );
    }
}
