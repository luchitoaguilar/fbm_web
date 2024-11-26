<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacimiento extends Model
{
    use HasFactory;

    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    /**
     * @var string
     */
    protected $table = 'nacimiento';

    /**
     * @var string[]
     */
    protected $fillable = [
        'lugar_nacimiento_departamento',
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
     * @var string[]
     */
    protected $with = [

    ];
}
