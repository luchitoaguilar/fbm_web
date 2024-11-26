<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZafraZafrero extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'zafra_zafrero';

    /**
     * @var string[]
     */
    protected $fillable = [
        'zafra_id',
        'zafrero_id',
        'cod_vehiculo',
        'peso_neto',
        'num_recibo',
        'fecha_ingreso',
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
}
