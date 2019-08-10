<?php

use Illuminate\Database\Seeder;
use App\Models\ImagenesEvento;

class ImagenesEventoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagenesEvento::truncate();
        ImagenesEvento::create(
            ['evento_id' => 1, 'url' => 'storage/2.jpg'],
            ['evento_id' => 1, 'url' => 'storage/3.jpg'],
            ['evento_id' => 2, 'url' => 'storage/1.jpg'],
            ['evento_id' => 2, 'url' => 'storage/3.jpg']
        );
    }
}
