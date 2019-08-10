<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesEventoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'imagenes_evento';

    /**
     * Run the migrations.
     * @table imagenes_evento
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('evento_id')->unsigned();
            $table->string('url');

            $table->index(["evento_id"], 'fk_imagenes_evento_evento1_idx');


            $table->foreign('evento_id', 'fk_imagenes_evento_evento1_idx')
                ->references('id')->on('evento')
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
