<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
        //Una solucion no muy bonita  debido a que al actualizar ya no es de tipo File sino string en la BD
        if ( !$this->hasFile('video')) {
            return [
                'id' => 'exists:videos,id',
                'titulo'   => 'required|max:100',
                'video' => 'nullable',
            ];
        } else {
            return [
                'id' => 'exists:videos,id',
                'titulo'   => 'required|max:100',
                'video'   => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm,mpg4,mpg | max:50000'
            ];
        }
    }

    /**
     * @return array
     */
    protected function noexiste(): array
    {
        return [
            // 'titulo'   => 'nullable|max:200',
            // 'video'   => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm,mpg4,mpg | max:50000'
        ];
    }
}
