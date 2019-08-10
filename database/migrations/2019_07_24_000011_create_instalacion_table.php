<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstalacionTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'instalacion';

    /**
     * Run the migrations.
     * @table instalacion
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tipo_instalacion_id')->unsigned();
            $table->integer('disciplina_id')->unsigned()->nullable()->comment('En caso de que sea una instalación deportiva');
            $table->string('nombre', 60);
            $table->string('descripcion', 200);
            $table->string('imagen_destacada');

            $table->index(["disciplina_id"], 'fk_instalacion_disciplina1_idx');

            $table->index(["tipo_instalacion_id"], 'fk_instalacion_tipo_instalacion1_idx');


            $table->foreign('tipo_instalacion_id', 'fk_instalacion_tipo_instalacion1_idx')
                ->references('id')->on('tipo_instalacion')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('disciplina_id', 'fk_instalacion_disciplina1_idx')
                ->references('id')->on('disciplina')
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
