<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $tipo
 * @property Evento[] $eventos
 */
class TipoEvento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tipo_evento';

    /**
     * @var array
     */
    protected $fillable = ['id', 'tipo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos()
    {
        return $this->hasMany('App\Model\Evento');
    }
}
