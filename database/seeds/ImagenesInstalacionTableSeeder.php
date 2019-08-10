<?php

use Illuminate\Database\Seeder;
use App\Models\ImagenesInstalacion;

class ImagenesInstalacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagenesInstalacion::truncate();
        ImagenesInstalacion::create(
            []
        );
    }
}
