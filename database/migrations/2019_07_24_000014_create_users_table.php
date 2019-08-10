<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('tipo_documento_id')->unsigned();
            $table->integer('tipo_usuario_id')->unsigned();
            $table->string('documento', 45);
            $table->string('email', 65);
            $table->string('nombres', 60);
            $table->string('apellidos', 60);
            $table->string('fecha_naci', 60);
            $table->string('telefono', 10);
            $table->string('direccion', 70);
            $table->string('genero', 45)->nullable();
            $table->string('codigo_afiliado', 15);
            $table->string('codigo_golfista', 20);
            $table->integer('categoria_golfista_id')->unsigned()->nullable();
            $table->integer('estado_users_id')->unsigned();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(["estado_users_id"], 'fk_users_estado_users1_idx');

            $table->index(["categoria_golfista_id"], 'fk_users_categoria_golfista1_idx');

            $table->index(["tipo_documento_id"], 'fk_users_tipo_documento_idx');

            $table->index(["tipo_usuario_id"], 'fk_users_tipo_usuario1_idx');

            $table->unique(["codigo_afiliado"], 'codigo_afiliado_UNIQUE');

            $table->unique(["codigo_golfista"], 'codigo_golfista_UNIQUE');

            $table->unique(["documento"], 'documento_UNIQUE');

            $table->unique(["email"], 'email_UNIQUE');


            $table->foreign('tipo_documento_id', 'fk_users_tipo_documento_idx')
                ->references('id')->on('tipo_documento')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('categoria_golfista_id', 'fk_users_categoria_golfista1_idx')
                ->references('id')->on('categoria_golfista')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('tipo_usuario_id', 'fk_users_tipo_usuario1_idx')
                ->references('id')->on('tipo_usuario')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('estado_users_id', 'fk_users_estado_users1_idx')
                ->references('id')->on('estado_users')
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
