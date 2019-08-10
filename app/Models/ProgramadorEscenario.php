<?php

namespace App\Models;

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
    protected $fillable = ['id', 'escenario_id', 'grupo_jugadores_golf', 'fecha', 'hora', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function escenario()
    {
        return $this->belongsTo(Escenario::class, 'escenario_id');
    }

    public function grupoJugadoresGolf()
    {
        return $this->belongsTo(GrupoJugadoresGolf::class, 'grupo_jugadores_golf');
    }
}
