<?php

namespace App\Http\Requests;

use App\Models\Producto;
use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        //para verificar si el id esta en uso(true/false) para evitar problemas en el request
        $verificacion = $this->id != "null";
        return $verificacion ? $this->existe() : $this->noExiste();
    }

    /**
     * @return array
     */
    public function validated(): array
    {
        $validos = parent::validated();

        if (!$this->id)
            $validos = array_merge($validos, [
                'usuario_creado_id' => $this->user()->id
            ]);

        return array_merge($validos, [
            'usuario_modificado_id' => $this->user()->id,
        ]);
    }

    /**
     * @return array
     */
    protected function existe(): array
    {
        //Una solucion no muy bonita pero funcional para actualizar la foto y firma digital, debido a que al actualizar ya no es de tipo File sino string en la BD
        if (!$this->hasFile('imagen')) {
            return [
                'id' => 'exists:producto,id',
                'nombre'   => 'nullable|max:250',
                'presentacion'   => 'nullable|max:250',
                'enlace'   => 'nullable|max:250',
                // 'precio'   => 'exists:banner,precio',
                'descripcion' => 'nullable',
                'imagen'   => 'nullable',

            ];
        } else {
            return [
                'id' => 'exists:producto,id',
                'nombre'   => 'nullable|max:250',
                'presentacion'   => 'nullable|max:250',
                'enlace'   => 'nullable|max:250',
                'descripcion' => 'nullable',
                // 'precio'   => 'exists:banner,precio',
                'imagen'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:30000',
            ];
        }
    }

    /**
     * @return array
     */
    protected function noexiste(): array
    {
        return [
            'nombre'   => 'nullable|max:250',
            'presentacion'   => 'nullable|max:250',
            'enlace'   => 'nullable|max:250',
            'descripcion' => 'nullable',
            // 'precio'   => 'max:10|double|between:1,10',
            'imagen'   => 'required|image|mimes:jpeg,png,bmp,jpg,gif|max:30000',
        ];
    }

}
