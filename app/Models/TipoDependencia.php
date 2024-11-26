<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\DataTables;

class TipoDependencia extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'tipo_dependencias';

    /**
     * @var string[]
     */
    protected $fillable = [
        'tipo',
        'descripcion',
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
        'usuario_creado_id', 'usuario_modificado_id'
    ];

    /**
     * @return mixed
     * @throws Exception
     */
    public static function dataTable(): mixed
    {
        $tipo_dependencias = TipoDependencia::orderBy('id');

        return DataTables::of($tipo_dependencias)
            ->toJson();
    }

    /**
     * @var string[]
     */
    protected $with = [

    ];
}
