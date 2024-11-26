<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZafraRequest extends FormRequest
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
        if (!$this->hasFile('archivo')) {
            return [
                'id' => 'exists:zafra,id',
                'tipo_cosecha'  => 'required',
                'vehiculo'  => 'max:100',
                'cod_vehiculo'   => 'required|max:100',
                'fecha_ingreso'   => 'required',
                'peso_neto'   => 'required|max:100',
                'observaciones' => 'max:10',
                'num_recibo'    => 'required|max:10',
                // 'archivo'   => 'nullable|mimes:pdf,rar,word | max:100000,' . $this->route('id'),

            ];
        } else {
            return [
                'id' => 'exists:zafra,id',
                'tipo_cosecha'  => 'required',
                'vehiculo'  => 'max:100',
                'cod_vehiculo'   => 'required|max:100',
                'fecha_ingreso'   => 'required',
                'peso_neto'   => 'required|max:100',
                'observaciones' => 'max:10',
                'num_recibo'    => 'required|max:10',
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
            'tipo_cosecha'  => 'required',
            'cod_vehiculo'   => 'required|max:100',
            'vehiculo'  => 'max:100',
            'fecha_ingreso'   => 'required',
            'peso_neto'   => 'required|max:100',
            'observaciones' => 'max:10',
            'num_recibo'    => 'required|max:10',
            // 'archivo'   => 'nullable|mimes:pdf,rar,word | max:100000',

        ];
    }
}
