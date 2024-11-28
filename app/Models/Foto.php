<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    public const CREATED_AT = 'fecha_creado';
    public const UPDATED_AT = 'fecha_modificado';

    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'fotos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'detalle',
        'foto',
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
