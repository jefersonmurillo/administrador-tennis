<?php

use Illuminate\Database\Seeder;
use App\Models\EstadosUsers;

class EstadoUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadosUsers::truncate();
        EstadosUsers::create(
            ['estado' => 'ACTIVO'],
            ['estado' => 'EN ESPERA'],
            ['estado' => 'INACTIVO']
        );
    }
}
