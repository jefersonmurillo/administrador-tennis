<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $evento_id
 * @property string $url
 * @property Evento $evento
 */
class ImagenesEvento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'imagenes_evento';

    /**
     * @var array
     */
    protected $fillable = ['id', 'evento_id', 'url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evento()
    {
        return $this->belongsTo('App\Model\Evento');
    }
}
