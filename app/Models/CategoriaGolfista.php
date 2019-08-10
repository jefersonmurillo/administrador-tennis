<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $categoria
 * @property Users[] $users
 */
class CategoriaGolfista extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categoria_golfista';

    /**
     * @var array
     */
    protected $fillable = ['id', 'categoria'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Model\Users', 'categoria_golfista_id');
    }
}
