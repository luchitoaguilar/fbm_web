<?php

namespace App\Http\Requests;

use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;

class CompraRequest extends FormRequest
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
        if ($this->id != "null" || $this->id == 0) {
            return [
                'nombre'   => 'required|max:250',
                'grado'   => 'max:250',
                'celular'   => 'required|max:250',
                'email'    => 'required|max:250|email',
                'baucher'   => 'required|max:250',
                'id_ciudad'   => 'required|max:2500',

            ];
        } else {
            return [
                'id' => 'exists:compra,id',
                'nombre'   => 'required|max:250',
                'grado'   => 'max:250',
                'celular'   => 'required|max:250',
                'email'    => 'required|max:250|email',
                'baucher'   => 'required|max:250',
                'id_ciudad'   => 'required|max:2500',
            ];
        }
    }

    /**
     * @return array
     */
    public function validated(): array
    {
        $validos = parent::validated();

        if (!$this->id)
            $validos = array_merge($validos,  [
                'usuario_creado_id' => $this->user()->id
            ]);

        return array_merge($validos, [
            'usuario_modificado_id' => $this->user()->id,
        ]);
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo debe contener xxx@xxxxx.xxx',
        ];
    }
}
