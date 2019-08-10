<?php

use Illuminate\Database\Seeder;
use App\Models\Evento;

class GrupoJugadoresGolfTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evento::truncate();
        Evento::create(
            [
                'prioridad_id' => 2,
                'tipo_evento_id' => 3,
                'nombre' => 'Evento1',
                'descripcion' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T.',
                'fecha_inicio' => '2019-07-31',
                'fecha_fin' => '2019-08-02',
                'imagen_destacada' => 'storage/1.jpg'
            ],
            [
                'prioridad_id' => 1,
                'tipo_evento_id' => 1,
                'nombre' => 'Evento Familiar',
                'descripcion' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T.',
                'fecha_inicio' => '2019-07-31',
                'fecha_fin' => '2019-08-08',
                'imagen_destacada' => 'storage/2.jpg'
            ],
            [
                'prioridad_id' => 2,
                'tipo_evento_id' => 1,
                'nombre' => 'Evento familiar',
                'descripcion' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T.',
                'fecha_inicio' => '2019-07-23',
                'fecha_fin' => '2019-08-01',
                'imagen_destacada' => 'storage/3.jpg'
            ],
            [
                'prioridad_id' => 1,
                'tipo_evento_id' => 2,
                'nombre' => 'Evento infantil',
                'descripcion' => 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T.',
                'fecha_inicio' => '2019-07-31',
                'fecha_fin' => '2019-08-08',
                'imagen_destacada' => 'storage/1.jpg'
            ]
        );
    }
}
