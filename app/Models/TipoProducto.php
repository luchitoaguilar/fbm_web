<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'tipo_producto';

    /**
     * @var string[]
     */
    protected $fillable = [
        'tipo_producto', 'descripcion',
        'usuario_creado_id', 'usuario_modificado_id',
        'fecha_creado', 'fecha_modificado'
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
     * @var string[]
     */
    protected $with = [

    ];
}
