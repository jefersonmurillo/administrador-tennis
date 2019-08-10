<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesInstalacionTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'imagenes_instalacion';

    /**
     * Run the migrations.
     * @table imagenes_instalacion
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('instalacion_id')->unsigned();
            $table->string('url');

            $table->index(["instalacion_id"], 'fk_imagenes_instalacion_instalacion1_idx');


            $table->foreign('instalacion_id', 'fk_imagenes_instalacion_instalacion1_idx')
                ->references('id')->on('instalacion')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
