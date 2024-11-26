<?php

namespace App\Models;

use App\Traits\Auditoria;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Yajra\DataTables\DataTables;

class Persona extends Model
{
    use HasFactory, Auditoria;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'personas';

    /**
     * @var string[]
     */
    protected $fillable = [
        'paterno',
        'materno',
        'nombres',
        'ci',
        'complemento',
        'fecha_nacimiento',
        'lugar_nacimiento_id',
        'telefono',
        'expedido_id',
        'foto',
        'activo',
        'usuario_creado_id',
        'usuario_modificado_id',
        'fecha_creado',
        'fecha_modificado',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'fecha_creado' => 'datetime:d/m/Y H:i:s',
        'fecha_modificado' => 'datetime:d/m/Y H:i:s',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'expedido_id',
        'usuario_creado_id', 'usuario_modificado_id', 'usuario_creado', 'usuario_modificado'
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'estado'
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'expedido', 'lugar_nacimiento'
    ];

    /**
     * @return string
     */
    public function getEstadoAttribute(): string
    {
        return $this->activo ? 'HABILITADO' : 'DESHABILITADO';
    }

    /**
     * @return HasOne
     */
    public function expedido(): HasOne
    {
        return $this->hasOne(Expedido::class, 'id', 'expedido_id');
    }

    /**
     * @return HasOne
     */
    public function lugar_nacimiento(): HasOne
    {
        return $this->hasOne(Ciudad::class, 'id', 'lugar_nacimiento_id');
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public static function dataTable(): mixed
    {
        $personas = Persona::join('expedidos', 'personas.expedido_id', '=', 'expedidos.id')
            ->join('ciudad', 'personas.lugar_nacimiento_id', '=', 'ciudad.id')
            ->select('personas.id', 'personas.ci', 'personas.paterno', 'personas.materno', 'personas.paterno', 'personas.nombres',
                'expedidos.departamento', 'personas.complemento', 'personas.activo', 'personas.foto', 'personas.fecha_nacimiento',
                'personas.telefono', 'ciudad.departamento')
            ->without('expedido');

        return DataTables::of($personas)
            ->addIndexColumn()
            ->addColumn('foto', function ($personas) {
                $button = '<a class="ver-persona" style="text-align:center;display:block"><img
                    class="img-circle" src="' . asset("/$personas->foto") . '" width="50" height="50" /></a>';
                return $button;
            })
            ->addColumn('action', function ($persona) {
                $button = '<a href="' . route('editar_persona', ['id' => $persona->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                aria-hidden="true" title="Editar este registro">
                <i class="fa fa-edit"></i>
              </a>';
                $button .= '<form action="' . route('eliminar_persona', ['id' => $persona->id])  . '" class="d-inline form-eliminar"
            method="POST">'
                    . csrf_field() . method_field("delete") . '
            <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
              title="Eliminar este registro"><i class="fa fa-trash"></i>
            </button>
          </form>';
                return $button;
            })
            ->addColumn('estado', function ($persona) {
                if ($persona->activo == true) {
                    return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-check"></i>
                    Activo</button></div>';
                } else{
                    return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-close"></i>
                        Inactivo</button></div>';
                }
            })
            ->rawColumns(['foto', 'action', 'estado'])
            ->toJson();
    }

    /**
     * @return string
     */
    public function getNombreCompletoAttribute(): string
    {
        return $this->paterno . ' ' . $this->materno . ' ' . $this->nombres;
    }
}
