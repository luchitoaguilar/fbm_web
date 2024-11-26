<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Models\Contacto;
use App\Models\Zafra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function view() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        return view('modules.Contacto.contacto', compact('zafra'));
    }

    public function store(ContactoRequest $request): JsonResponse
    {
        $contacto = new Contacto($request->all());
   
        $contacto->nombre = $request->nombre;
        $contacto->email = $request->email;
        $contacto->telefono = $request->telefono;
        $contacto->asunto = $request->asunto;
        $contacto->mensaje = $request->mensaje;
        $contacto->estado = 1;
        $contacto->usuario_creado_id = Auth::user()->id;
        $contacto->usuario_modificado_id = Auth::user()->id;


            $remitente = 'jefe_com_fbm@cofadena.gob.bo';
            $destino = ['enc_ventas_nal_fbm@cofadena.gob.bo', 'jefe_com_fbm@cofadena.gob.bo'];
            $data = ['nombre' => $contacto->nombre, 'email' => $contacto->email , 'telefono' =>$contacto->telefono, 'asunto' => $contacto->asunto, 'mensaje' => $contacto->mensaje];
            Mail::send('modules.PlantillaCorreo.mensajeContacto', $data, function ($mess) use ($destino, $remitente) {
                $mess->from($remitente, 'FBM - COFADENA');
                $mess->to($destino)->subject('Solicitud Información - FBM');
            });

    //   dump($contacto);
        $contacto->save();

        return response()->json([
            'message' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.contacto')])
        ]);
    }
}
