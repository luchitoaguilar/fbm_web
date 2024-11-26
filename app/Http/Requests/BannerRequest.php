<?php

namespace App\Http\Requests;

use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
        if (!$this->hasFile('imagen_fondo') || !$this->hasFile('imagen_frente')) {
            return [
                'id' => 'exists:banner,id',
                'nombre'   => 'nullable|max:250',
                'datos'   => 'nullable|max:250',
                // 'precio'   => 'exists:banner,precio',
                'enlace'    => 'nullable|max:250',
                // 'imagen_fondo'   => 'nullable',
                // 'imagen_frente'   => 'nullable',

            ];
        } else {
            return [
                'id' => 'exists:banner,id',
                'nombre'   => 'nullable|max:250',
                'datos'   => 'nullable|max:250',
                // 'precio'   => 'exists:banner,precio',
                'enlace'    => 'nullable|max:250',
                'imagen_fondo'   => 'required|image|mimes:jpeg,png,bmp,jpg,gif|max:5120',
                'imagen_frente'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:5120',
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
            'datos'   => 'nullable|max:250',
            // 'precio'   => 'max:10|double|between:1,10',
            'enlace'    => 'nullable|max:250',
            'imagen_fondo'   => 'nullable',
            'imagen_frente'   => 'nullable',

        ];
    }

}
