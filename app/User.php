<?php

namespace App;

use App\Models\CategoriaGolfista;
use App\Models\EstadosUsers;
use App\Models\TipoDocumento;
use App\Models\TipoUsuario;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'tipo_documento_id',
        'tipo_usuario_id',
        'categoria_golfista_id',
        'estado_users_id',
        'documento',
        'nombres',
        'apellidos',
        'fecha_naci',
        'telefono',
        'direccion',
        'genero',
        'codigo_afiliado',
        'codigo_golfista',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    // Rest omitted for brevity

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoriaGolfista()
    {
        return $this->belongsTo(CategoriaGolfista::class, 'categoria_golfista_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoUser()
    {
        return $this->belongsTo(EstadosUsers::class, 'estado_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class,'tipo_usuario_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
