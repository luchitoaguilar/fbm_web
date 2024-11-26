<?php

namespace App\Models;

use App\Traits\Auditoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variables extends Model
{
    use HasFactory, Auditoria;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'variables';

    /**
     * @var string[]
     */
    protected $fillable = [
        'precio_pago_zafrero',
        'gerente_cofadena',
        'cargo_gerente_cofadena',
        'gerente_upab',
        'cargo_gerente_upab',
        'jefe_prod_upab',
        'cargo_jefe_prod_upab',
        'aux_prod_upab',
        'cargo_aux_prod_upab',

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
        'usuario_creado_id', 'usuario_modificado_id', 'usuario_creado', 'usuario_modificado'
    ];
}
