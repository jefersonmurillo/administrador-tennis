<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::truncate();
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
            'name' => 'Administrator',
            'tipo_documento_id' => 1,
            'categoria_golfista_id' => 1,
            'estado_users_id' => 1,
            'documento' => '1092362256',
            'nombres' => 'Jeferson',
            'apellidos' => 'Murillo Ariza',
            'fecha_naci' => '12/02/1997',
            'telefono' => '3133708060',
            'direccion' => 'Calle 34',
            'genero' => 'MASCULÍNO',
            'codigo_afiliado' => '-1',
            'codigo_golfista' => null,
            'tipo_usuario_id' => 2
        ]);
    }
}
