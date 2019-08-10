<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $tipo
 * @property Instalacion[] $instalacions
 */
class TipoInstalacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tipo_instalacion';

    /**
     * @var array
     */
    protected $fillable = ['id', 'tipo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instalacions()
    {
        return $this->hasMany(Instalacion::class, 'tipo_instalacion_id');
    }
}
