<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramadorEscenarioTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'programador_escenario';

    /**
     * Run the migrations.
     * @table programador_escenario
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('escenario_id')->unsigned();
            $table->integer('grupo_jugadores_golf')->unsigned();
            $table->date('fecha');
            $table->time('hora', 6);
            $table->string('estado', 45)->comment('DISPONIBLE - RESERVADO - APROBADO');
            $table->timestamps();
            $table->softDeletes();

            $table->index(["grupo_jugadores_golf"], 'fk_programador_escenario_grupo_jugadores_golf1_idx');

            $table->index(["escenario_id"], 'fk_programador_escenario_escenario1_idx');

            $table->unique(["escenario_id", "fecha", "hora"], 'unique_progarm');


            $table->foreign('escenario_id', 'fk_programador_escenario_escenario1_idx')
                ->references('id')->on('escenario')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('grupo_jugadores_golf', 'fk_programador_escenario_grupo_jugadores_golf1_idx')
                ->references('id')->on('grupo_jugadores_golf')
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
