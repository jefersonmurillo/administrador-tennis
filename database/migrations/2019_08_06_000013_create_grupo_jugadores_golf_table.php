<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoJugadoresGolfTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'grupo_jugadores_golf';

    /**
     * Run the migrations.
     * @table grupo_jugadores_golf
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('jugador1')->unsigned();
            $table->integer('jugador2')->unsigned();
            $table->integer('jugador3')->unsigned();
            $table->integer('jugador4')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(["jugador4"], 'fk_grupo_jugadores_golf_users4_idx');

            $table->index(["jugador2"], 'fk_grupo_jugadores_golf_users2_idx');

            $table->index(["jugador3"], 'fk_grupo_jugadores_golf_users3_idx');

            $table->index(["jugador1"], 'fk_grupo_jugadores_golf_users1_idx');


            $table->foreign('jugador1', 'fk_grupo_jugadores_golf_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('jugador2', 'fk_grupo_jugadores_golf_users2_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('jugador3', 'fk_grupo_jugadores_golf_users3_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('jugador4', 'fk_grupo_jugadores_golf_users4_idx')
                ->references('id')->on('users')
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
