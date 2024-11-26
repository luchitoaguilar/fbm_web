<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zafra extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'zafra';

    /**
     * @var string[]
     */
    protected $fillable = [
        'tipo_cosecha',
        'fecha_ingreso',
        'cod_vehiculo',
        'peso_neto',
        'observaciones',
        'estado',
        'gestion',
        'personal_zafra_id',
        'personal_zafra',
        'archivo',
        'num_recibo',
        'usuario_creado_id', 
        'usuario_modificado_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'personal_zafra' => 'array',
        'personal_zafra_id' => 'array',
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
