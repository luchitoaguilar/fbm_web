<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'contacto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'asunto',
        'mensaje',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $protected = [
        'id',
    ];
}
