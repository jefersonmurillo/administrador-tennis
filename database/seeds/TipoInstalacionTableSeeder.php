<?php

use Illuminate\Database\Seeder;
use App\Models\TipoInstalacion;

class TipoInstalacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoInstalacion::truncate();
        TipoInstalacion::create(
            ['id' => 1, 'tipo' => 'ZONA RECREATIVA'],
            ['id' => 2, 'tipo' => 'SALÓN'],
            ['id' => 3, 'tipo' => 'DEPORTE'],
            ['id' => 4, 'tipo' => 'OTRO'],
            ['id' => 5, 'tipo' => 'SPA'],
            ['id' => 6, 'tipo' => 'RESTAURANTE']
        );
    }
}
