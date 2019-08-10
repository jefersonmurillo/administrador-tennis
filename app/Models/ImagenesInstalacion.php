<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $instalacion_id
 * @property string $url
 * @property Instalacion $instalacion
 */
class ImagenesInstalacion extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'imagenes_instalacion';

    /**
     * @var array
     */
    protected $fillable = ['id', 'instalacion_id', 'url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instalacion()
    {
        return $this->belongsTo(Instalacion::class, 'instalacion_id');
    }
}
