<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class Vehiculo extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'vehiculo';

    /**
     * @var string[]
     */
    protected $fillable = [
        'vehiculo',
        'cod_vehiculo',
        'placa',
        'gestion',
        'tara',
        'observaciones',
        'estado',
        'usuario_creado_id', 
        'usuario_modificado_id',
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
}
