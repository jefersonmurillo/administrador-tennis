<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $nombre
 * @property Instalacion[] $instalacions
 */
class Disciplina extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'disciplina';

    /**
     * @var array
     */
    protected $fillable = ['id', 'nombre'];

    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instalacions()
    {
        return $this->hasMany(Instalacion::class, 'disciplina_id');
    }
}
