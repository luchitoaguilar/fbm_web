<?php

namespace App\Models;

use App\Traits\Auditoria;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yajra\DataTables\DataTables;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, Auditoria;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'persona_id',
        'rol_id',
        'cargo_id',
        'email',
        'password',
        'api_token',
        'usuario_creado_id',
        'usuario_modificado_id',
        'fecha_creado',
        'fecha_modificado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'api_token',
        'rol_id',
        'persona_id',
        'usuario_creado_id',
        'usuario_modificado_id'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'fecha_creado'      => 'datetime:d/m/Y H:i:s',
        'fecha_modificado'  => 'datetime:d/m/Y H:i:s',
    ];

    /**
     * @var string[]
     */
    protected $appends = [

    ];

    /**
     * @return bool
     */
    public function esAdministrador(): bool
    {
        return $this->rol->rol == 'ADMINISTRADOR';
    }

    /**
     * @return bool
     */
    public function esUsuario(): bool
    {
        return $this->rol->rol == 'USUARIO';
    }

    /**
     * @return bool
     */
    public function esOperador(): bool
    {
        return $this->rol->rol == 'OPERADOR';
    }

    /**
     * @return BelongsTo
     */
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    /**
     * @return BelongsTo
     */
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function ci(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'ci', 'id');
    }

    /**
     * @return HasOne
     */
    public function cargo(): HasOne
    {
        return $this->hasOne(Cargo::class, 'id', 'cargo_id');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public static function dataTable(): mixed
    {
        $usuarios = Usuario::join('personas', 'personas.id', '=', 'usuarios.persona_id')
            ->join('roles', 'roles.id', '=', 'usuarios.rol_id')
            ->join('cargos', 'cargos.id', '=', 'usuarios.cargo_id')
            ->select('usuarios.id', 'personas.paterno', 'personas.materno', 'personas.nombres', 'roles.rol', 'cargos.cargo', 'usuarios.usuario', 'usuarios.activo')
            ->orderBy('usuarios.activo');

        return DataTables::of($usuarios)
            ->toJson();
    }
}
