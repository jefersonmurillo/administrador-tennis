<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SugerenciaSabor extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sugerencias_sabor';

    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['id', 'url', 'tipo', 'asunto', 'fecha', 'created_at'];
}
