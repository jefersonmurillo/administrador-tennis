<?php

use Illuminate\Database\Seeder;
use App\Models\TipoEvento;

class TipoEventoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoEvento::truncate();
        TipoEvento::create(
            ['tipo' => 'FAMILIAR'],
            ['tipo' => 'NIÑOS'],
            ['tipo' => 'ADULTOS']
        );
    }
}
