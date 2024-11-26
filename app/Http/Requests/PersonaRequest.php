<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
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
        if (!$this->hasFile('foto')) {
            return [
                'id' => 'exists:personas,id',
                'nombres'  => 'required|max:100',
                'paterno'  =>  'required|max:100',
                'materno'   => 'required|max:100',
                'fecha_nacimiento'   => 'max:100',
                'lugar_nacimiento_id'   => 'max:10',
                'ci' => 'required|max:10',
                'expedido_id'   => 'max:10',
                'complemento'    => 'max:10',
                'telefono'    => 'max:10',
                // 'archivo'   => 'nullable|mimes:pdf,rar,word | max:100000,' . $this->route('id'),

            ];
        } else {
            return [
                'id' => 'exists:personas,id',
                'nombres'  => 'required|max:100',
                'paterno'  =>  'required|max:100',
                'materno'   => 'required|max:100',
                'fecha_nacimiento'   => 'max:100',
                'lugar_nacimiento_id'   => 'max:10',
                'ci' => 'required|max:10',
                'expedido_id'   => 'max:10',
                'complemento'    => 'max:10',
                'telefono'    => 'max:10',
                // 'archivo'   => 'nullable|mimes:pdf,rar,word | max:100000,' . $this->route('id'),
            ];
        }
    }

    /**
     * @return array
     */
    protected function noexiste(): array
    {
        return [
            'nombres'  => 'required|max:100',
            'paterno'  =>  'required|max:100',
            'materno'   => 'required|max:100',
            'fecha_nacimiento'   => 'max:100',
            'lugar_nacimiento_id'   => 'max:10',
            'ci' => 'required|max:10',
            'expedido_id'   => 'max:10',
            'complemento'    => 'max:10',
            'telefono'    => 'max:10',
            // 'archivo'   => 'nullable|mimes:pdf,rar,word | max:100000',

        ];
    }
}
