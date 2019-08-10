<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $tipo_instalacion_id
 * @property int $disciplina_id
 * @property string $nombre
 * @property string $descripcion
 * @property string $imagen_destacada
 * @property Disciplina $disciplina
 * @property TipoInstalacion $tipoInstalacion
 * @property ImagenesInstalacion[] $imagenesInstalacions
 */
class Instalacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'instalacion';

    /**
     * @var array
     */
    protected $fillable = ['id', 'tipo_instalacion_id', 'nombre', 'descripcion', 'imagen_destacada'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoInstalacion()
    {
        return $this->belongsTo(TipoInstalacion::class, 'tipo_instalacion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagenesInstalacions()
    {
        return $this->hasMany(ImagenesInstalacion::class, 'instalacion_id');
    }
}
