<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escenario extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'escenario';

    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['id', 'disciplina_id', 'nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }

    public function programador(){
        return $this->hasMany(ProgramadorEscenario::class, 'escenario_id');
    }
}
