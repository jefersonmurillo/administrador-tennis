<?php

use Illuminate\Database\Seeder;
use App\Models\Disciplina;

class DisciplinaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disciplina::truncate();
        Disciplina::cretae(
            ['id' => 1, 'nombre' => 'Basquetbol'],
            ['id' => 2, 'nombre' => 'Golf'],
            ['id' => 3, 'nombre' => 'Natación'],
            ['id' => 4, 'nombre' => 'Tennis'],
            ['id' => 5, 'nombre' => 'Futbol'],
            ['id' => 6, 'nombre' => 'Voleibol']
        );
    }
}
