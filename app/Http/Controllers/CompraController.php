<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompraRequest;
use App\Models\Ciudad;
use App\Models\Compra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CompraController extends Controller
{
    public function view() {
        // $zafra = Zafra::where('estado', 1)
        // ->sum('peso_neto');

        $ciudad = Ciudad::where('estado', 1)->orderBy('departamento', 'asc')->get();

        return view('modules.Compra.compra', compact('ciudad'));
    }

    public function store(CompraRequest $request): JsonResponse
    {
        $contacto = new Compra($request->all());
   
        $contacto->nombre = $request->nombre;
        $contacto->email = $request->email;
        $contacto->celular = $request->celular;
        $contacto->baucher = $request->baucher;
        $contacto->grado = $request->grado;
        $contacto->id_ciudad = $request->id_ciudad;
        $contacto->estado = 1;
        $contacto->usuario_creado_id = Auth::user()->id;
        $contacto->usuario_modificado_id = Auth::user()->id;


            // $remitente = 'jefe_com_fbm@cofadena.gob.bo';
            // $destino = ['enc_ventas_nal_fbm@cofadena.gob.bo', 'jefe_com_fbm@cofadena.gob.bo'];
            // $data = ['nombre' => $contacto->nombre, 'email' => $contacto->email , 'telefono' =>$contacto->telefono, 'asunto' => $contacto->asunto, 'mensaje' => $contacto->mensaje];
            // Mail::send('modules.PlantillaCorreo.mensajeContacto', $data, function ($mess) use ($destino, $remitente) {
            //     $mess->from($remitente, 'FBM - COFADENA');
            //     $mess->to($destino)->subject('Solicitud Información - FBM');
            // });

    //   dump($contacto);
        $contacto->save();

        return response()->json([
            'message' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.contacto')])
        ]);
    }
}
