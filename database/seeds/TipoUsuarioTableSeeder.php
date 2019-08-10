<?php

use Illuminate\Database\Seeder;
USE App\Models\TipoUsuario;

class TipoUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoUsuario::truncate();
        TipoUsuario::create(
            ['tipo' => 'AFILIADO'],
            ['tipo' => 'ADMINISTRATIVO'],
            ['tipo' => 'GOLFISTA']
        );
    }
}
