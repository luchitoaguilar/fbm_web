<?php


namespace App\Traits;


use App\Models\Usuario;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Auditoria
{
    /**
     * @return BelongsTo
     */
    public function usuario_creado(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_creado_id');
    }

    /**
     * @return BelongsTo
     */
    public function usuario_modificado(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_modificado_id');
    }

    /**
     * @return BelongsTo
     */
    public function usuario_borrado(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_borrado_id');
    }

    /**
     * @return string|null
     */
    public function getNombreUsuarioCreadoAttribute(): ?string
    {
        if (is_null($this->usuario_creado_id))
            return null;

        return $this->usuario_creado->persona->nombres . ' '
            . $this->usuario_creado->persona->paterno . ' '
            . $this->usuario_creado->persona->materno . ' ('
            . $this->usuario_creado->usuario . ')';
    }

    /**
     * @return string|null
     */
    public function getNombreUsuarioModificadoAttribute(): ?string
    {
        if (is_null($this->usuario_modificado_id))
            return null;

        return $this->usuario_modificado->persona->nombres . ' '
            . $this->usuario_modificado->persona->paterno . ' '
            . $this->usuario_modificado->persona->materno . ' ('
            . $this->usuario_modificado->usuario . ')';
    }

    /**
     * @return string|null
     */
    public function getNombreUsuarioBorradoAttribute(): ?string
    {
        if (is_null($this->usuario_borrado_id))
            return null;

        return $this->usuario_borrado->persona->nombres . ' '
            . $this->usuario_borrado->persona->paterno . ' '
            . $this->usuario_borrado->persona->materno . ' ('
            . $this->usuario_borrado->usuario . ')';
    }
}
