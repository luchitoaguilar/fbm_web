<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaRequest extends FormRequest
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
        if ( !$this->hasFile('imagen_0') || !$this->hasFile('imagen_1') || !$this->hasFile('imagen_2') || !$this->hasFile('imagen_3') || !$this->hasFile('imagen_4') ) {
            return [
                'id' => 'exists:noticias,id',
                'titulo'   => 'required|max:100',
                'enlace'   => 'max:255',
                'descripcion'   => 'max:50000',
                // 'imagen_0'   => 'required|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'imagen_1'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'imagen_2'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'imagen_3'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'imagen_4'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'archivo'   => 'nullable|mimes:pdf,rar,word | max:100000,' . $this->route('id'),

            ];
        } else {
            return [
                'id' => 'exists:noticias,id',
                'titulo'   => 'required|max:100',
                'enlace'   => 'max:255',
                'descripcion'   => 'max:50000',
                // 'imagen_0'   => 'required|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'imagen_1'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'imagen_2'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'imagen_3'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
                // 'imagen_4'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
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
            'titulo'   => 'required|max:200',
            'enlace'   => 'max:255',
            'descripcion'   => 'max:50000',
            'imagen_0'   => 'required|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
            // 'imagen_1'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
            // 'imagen_2'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
            // 'imagen_3'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
            // 'imagen_4'   => 'nullable|image|mimes:jpeg,png,bmp,jpg,gif|max:15000',
            // 'archivo'   => 'nullable|mimes:pdf,rar,word | max:100000',

        ];
    }
}
