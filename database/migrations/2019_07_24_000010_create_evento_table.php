<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'evento';

    /**
     * Run the migrations.
     * @table evento
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('prioridad_id')->unsigned();
            $table->integer('tipo_evento_id')->unsigned();
            $table->string('nombre', 70);
            $table->string('descripcion', 200);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('imagen_destacada');

            $table->index(["prioridad_id"], 'fk_evento_prioridad1_idx');

            $table->index(["tipo_evento_id"], 'fk_evento_tipo_evento1_idx');


            $table->foreign('prioridad_id', 'fk_evento_prioridad1_idx')
                ->references('id')->on('prioridad')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tipo_evento_id', 'fk_evento_tipo_evento1_idx')
                ->references('id')->on('tipo_evento')
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
