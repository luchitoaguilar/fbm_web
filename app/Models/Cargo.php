<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Yajra\DataTables\DataTables;

class Cargo extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'cargos';

    /**
     * @var string[]
     */
    protected $fillable = [
        'dependencia_id',
        'cargo',
        'usuario_creado_id',
        'usuario_modificado_id',
        'fecha_creado',
        'fecha_modificado'
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
    protected $hidden = [
        'usuario_creado_id', 'usuario_modificado_id', 'usuario_creado', 'usuario_modificado'
    ];

    /**
     * @return mixed
     * @throws Exception
     */
    public static function dataTable(): mixed
    {
        $cargos = Cargo::join('dependencias', 'dependencias.id', '=', 'cargos.dependencia_id')
            ->select('cargos.id', 'cargos.cargo', 'dependencias.dependencia')
            ->orderBy('dependencias.tipo_dependencia_id');

        return DataTables::of($cargos)
            ->toJson();
    }

    /**
     * @return string
     */
    public function getEstadoAttribute(): string
    {
        return $this->activo ? 'HABILITADO' : 'DESHABILITADO';
    }

    /**
     * @return string
     */
    public function getNombreUsuarioCreadoAttribute(): string
    {
        return $this->paterno . ' ' . $this->materno . ' ' . $this->nombres;
    }

}
