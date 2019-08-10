<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class GrupoJugadoresGolf extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grupo_jugadores_golf';

    /**
     * @var array
     */
    protected $fillable = ['id', 'jugador1', 'jugador2', 'jugador3', 'jugador4'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jugador1()
    {
        return $this->belongsTo(User::class, 'jugador1');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jugador2()
    {
        return $this->belongsTo(User::class, 'jugador2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jugador3()
    {
        return $this->belongsTo(User::class, 'jugador3');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jugador4()
    {
        return $this->belongsTo(User::class, 'jugador4');
    }
}
