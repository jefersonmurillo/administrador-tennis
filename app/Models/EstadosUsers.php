<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $estado
 * @property Users[] $users
 */
class EstadosUsers extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'estado_users';

    /**
     * @var array
     */
    protected $fillable = ['id', 'estado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Model\Users', 'estado_users_id');
    }
}
