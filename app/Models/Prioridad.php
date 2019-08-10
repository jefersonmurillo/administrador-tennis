<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $prioridad
 * @property Evento[] $eventos
 */
class Prioridad extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prioridad';

    /**
     * @var array
     */
    protected $fillable = ['id', 'prioridad'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos()
    {
        return $this->hasMany('App\Model\Evento');
    }
}
