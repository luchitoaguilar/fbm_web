<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'noticia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'imagen_0',
        'imagen_1',
        'imagen_2',
        'imagen_3',
        'imagen_4',
        'archivo',
        'enlace',
        'descripcion',
        'estado',
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
