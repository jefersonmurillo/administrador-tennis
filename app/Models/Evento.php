<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $prioridad_id
 * @property int $tipo_evento_id
 * @property string $nombre
 * @property string $descripcion
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $imagen_destacada
 * @property Prioridad $prioridad
 * @property TipoEvento $tipoEvento
 * @property ImagenesEvento[] $imagenesEventos
 */
class Evento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'evento';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'prioridad_id',
        'tipo_evento_id',
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'imagen_destacada'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'prioridad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoEvento()
    {
        return $this->belongsTo(TipoEvento::class, 'tipo_evento_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagenesEventos()
    {
        return $this->hasMany(ImagenesEvento::class, 'evento_id');
    }
}
