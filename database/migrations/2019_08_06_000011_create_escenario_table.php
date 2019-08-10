<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscenarioTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'escenario';

    /**
     * Run the migrations.
     * @table escenario
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('disciplina_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->index(["disciplina_id"], 'fk_escenario_disciplina1_idx');


            $table->foreign('disciplina_id', 'fk_escenario_disciplina1_idx')
                ->references('id')->on('disciplina')
                ->onDelete('cascade')
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
