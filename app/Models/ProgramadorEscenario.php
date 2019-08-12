<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramadorEscenario extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'programador_escenario';

    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['id', 'escenario_id', 'grupo_jugadores_golf', 'fecha', 'hora', 'estado', 'jugador1', 'jugador2', 'jugador3', 'jugador4'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function escenario()
    {
        return $this->belongsTo(Escenario::class, 'escenario_id');
    }

    public function jugador1(){
        return $this->belongsTo(User::class, 'jugador1', 'codigo_afiliado');
    }

    public function jugador2(){
        return $this->belongsTo(User::class, 'jugador2', 'codigo_afiliado');
    }

    public function jugador3(){
        return $this->belongsTo(User::class, 'jugador3', 'codigo_afiliado');
    }

    public function jugador4(){
        return $this->belongsTo(User::class, 'jugador4', 'codigo_afiliado');
    }
}
