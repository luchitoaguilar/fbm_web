<?php

namespace App\Models;

use App\Traits\Auditoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Unidad
 * @package App\Models\Poa
 * @property int id
 * @property int dependencia_padre_id
 * @property string unidad
 * @property string sigla
 * @property string codigo
 * @property int prioridad
 * @property int nivel
 * @property int tipo_unidad_id
 * @property int usuario_creado_id
 * @property int usuario_modificado_id
 * @property string fecha_creado
 * @property string fecha_modificado
 */
class Dependencia extends Model
{
    use HasFactory, Auditoria;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'dependencias';

    /**
     * @var string[]
     */
    protected $fillable = [
        'dependencia_padre_id',
        'tipo_dependencia_id',
        'dependencia',
        'sigla',
        'ciudad',
        'prioridad',
        'nivel',
        'usuario_creado_id',
        'usuario_modificado_id',
        'usuario_borrado_id',
        'fecha_creado',
        'fecha_modificado',
        'fecha_borrado'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'fecha_creado' => 'datetime:d/m/Y H:i:s',
        'fecha_modificado' => 'datetime:d/m/Y H:i:s',
        'fecha_borrado' => 'datetime:d/m/Y H:i:s',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tipo_dependencia_id', 'usuario_creado_id', 'usuario_modificado_id', 'usuario_borrado_id'
    ];

    /**
     * @var string[]
     */
    protected $with = [

    ];

    public function roles()
    {
        return $this->belongsToMany(Despendencias::class, 'dependencias_rol');
    }

    public function getHijos($padres, $line)
    {
        $children = [];
        foreach ($padres as $line1) {
            if ($line['id'] == $line1['dependencia_padre_id']) {
                $children = array_merge($children, [array_merge($line1, ['subdependencias' => $this->getHijos($padres, $line1)])]);
            }
        }
        return $children;
    }

    public function getPadres($front)
    {
        if ($front) {
            return $this->whereHas('roles', function ($query) {
                $query->where('rol_id', session()->get('rol_id'))->orderby('dependencia_padre_id');
            })->orderby('dependencia_padre_id')
                ->orderby('orden')
                ->get()
                ->toArray();
        } else {
            return $this->orderby('dependencia_padre_id')
                ->orderby('prioridad')
                ->get()
                ->toArray();
        }
    }

    public static function getDependencias($front = false)
    {
        $dependencias = new Dependencia();
        $padres = $dependencias->getPadres($front);
        $dependenciasAll = [];
        foreach ($padres as $line) {
            if ($line['dependencia_padre_id'] != 0)
                break;
            $item = [array_merge($line, ['subdependencias' => $dependencias->getHijos($padres, $line)])];
            $dependenciasAll = array_merge($dependenciasAll, $item);
        }
        return $dependenciasAll;
    }

    public function guardarOrden($dependencias)
    {
        $dependencias = json_decode($dependencias);
        foreach ($dependencias as $var => $value) {
            $this->where('id', $value->id)->update(['dependencia_padre_id' => 0, 'prioridad' => $var + 1]);
            if (!empty($value->children)) {
                foreach ($value->children as $key => $vchild) {
                    $update_id = $vchild->id;
                    $parent_id = $value->id;
                    $this->where('id', $update_id)->update(['dependencia_padre_id' => $parent_id, 'prioridad' => $key + 1]);

                    if (!empty($vchild->children)) {
                        foreach ($vchild->children as $key => $vchild1) {
                            $update_id = $vchild1->id;
                            $parent_id = $vchild->id;
                            $this->where('id', $update_id)->update(['dependencia_padre_id' => $parent_id, 'prioridad' => $key + 1]);

                            if (!empty($vchild1->children)) {
                                foreach ($vchild1->children as $key => $vchild2) {
                                    $update_id = $vchild2->id;
                                    $parent_id = $vchild1->id;
                                    $this->where('id', $update_id)->update(['dependencia_padre_id' => $parent_id, 'prioridad' => $key + 1]);

                                    if (!empty($vchild2->children)) {
                                        foreach ($vchild2->children as $key => $vchild3) {
                                            $update_id = $vchild3->id;
                                            $parent_id = $vchild2->id;
                                            $this->where('id', $update_id)->update(['dependencia_padre_id' => $parent_id, 'prioridad' => $key + 1]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * devuelve los padres de una dependencia
     *
     * @return string
     */
    public static function padre(int $id, array $padres) : array
    {;
        static $father = [];
        $father = $padres;
        if ($id > 0) {
            $papa = Dependencia::select('dependencia_padre_id')->where('id', $id)->first();
            if ($papa->dependencia_padre_id == 0) {
                $prueba = Dependencia::select('id', 'sigla', 'dependencia', 'dependencia_padre_id')->where('id', $id)->first();
            } else {
                $prueba = Dependencia::select('id', 'sigla', 'dependencia', 'dependencia_padre_id')->where('dependencia_padre_id', $papa->dependencia_padre_id)->first();
            }

            array_push($father, [
                'id' => $prueba->id,
                'sigla' => $prueba->sigla,
                'dependencia' => $prueba->dependencia,
                'dependencia_padre_id' => $prueba->dependencia_padre_id
            ]);

            Dependencia::padre($prueba->dependencia_padre_id, $father);
        }

        return $father;
//        return $this->belongsTo(Dependencia::class, 'dependencia_padre_id', $id);
    }

    /**
     * devuelve los hijos en array
     *
     * @return HasMany
     */
    public function hijos(int $id): HasMany
    {
        $prueba = Dependencia::select('sigla', 'dependencia')->where('dependencia_padre_id', $id)->first();
        dd($prueba);
        return $this->hasMany(Dependencia::class, 'dependencia_padre_id', $id);
    }

    /**
     * para sacar el id de los hijos
     *
     * @return mixed
     */
    public function getHijosIdAttribute()
    {
        return Dependencia::where('dependencia_padre_id', $this->id)->get()->pluck('id');
    }

    /**
     * para sacar todos los id de los hijos mas el id propio de la unidad
     *
     * @return mixed
     */
    public function getTodosIdAttribute()
    {
        return Dependencia::where('dependencia_padre_id', $this->id)->orWhere('id', $this->id)->get()->pluck('id');
    }

    /**
     * @return BelongsTo
     */
    public function dependencias(): BelongsTo
    {
        return $this->belongsTo(Dependencia::class, 'id', 'cargo_id');
    }

}
