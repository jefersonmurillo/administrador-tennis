<?php

use Illuminate\Database\Seeder;
use App\Models\Prioridad;

class PrioridadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prioridad::truncate();
        Prioridad::create(
            ['estado' => 'ACTIVO'],
            ['estado' => 'EN ESPERA'],
            ['estado' => 'INACTIVO']
        );
    }
}
