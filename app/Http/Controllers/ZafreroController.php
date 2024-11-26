<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonaRequest;
use App\Http\Requests\ZafreroRequest;
use App\Models\Zafrero;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZafreroController extends Controller
{
    public function zafreros()
    {
        return view('modules.Administrador.Zafrero.view');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(): mixed
    {
        return Zafrero::dataTable();
    }
    /**
     * @param int $noticia_id
     * @return JsonResponse
     */
    public function getZafrero(int $persona_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Zafrero::join('ciudad', 'ciudad.id', 'zafrero.lugar_nacimiento_id')
                ->join('expedidos', 'expedidos.id', 'zafrero.expedido_id')
                ->select('zafrero.*', 'expedidos.departamento')
                ->findOrFail($persona_id),
                'message'   => __('messages.generico.datasuccess')
            ]);

        } catch (Exception $exception){

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);

        }
    }
     /**
     * @param ZafreroRequest $request
     * @return JsonResponse
     */
    public function storeZafrero(ZafreroRequest $request) : JsonResponse
    {
        $datosValidos = $request->validated();

        if (!isset($datosValidos['id'])) {
            return $this->store($request->merge($datosValidos));
        }
        
        return $this->update($request->merge($datosValidos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
         // Almacenamiento de la imagen.
         if ($request->file('foto')) {
            $file = $request->file('foto');

            $nombres = 'pesona_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/pesona/';

            $file->move($paths, $nombres);

            $direccion_archivo = $paths. $nombres;

        } else {
            $direccion_archivo = "/assets/pesona/pesona_default.pdf";
        }


        $persona = new Zafrero($request->all());
        //dd($persona);
        $persona->nombres = $request->nombres;
        $persona->paterno = $request->paterno;
        $persona->materno = $request->materno;
        $persona->foto = $direccion_archivo;
        $persona->lugar_nacimiento_id = $request->lugar_nacimiento_id;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->ci = $request->ci;
        $persona->complemento = $request->complemento;
        $persona->expedido_id = $request->expedido_id;
        $persona->telefono = $request->telefono;
        $persona->usuario_creado_id = Auth::user()->id;
        $persona->usuario_modificado_id = Auth::user()->id;

        $persona->save();

        return response()->json([
            'message' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.banner')])
        ]);

        // return redirect()->route('listar_banner')->with('mensaje', 'creado exitosamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) : JsonResponse
    {
        $persona = Zafrero::find($request->id);

        if (!$persona || $persona->estado == 0) {
            abort(404);
        }

         // Almacenamiento de la imagen fondo.
         if ($request->file('foto')) {
            $file = $request->file('foto');

            $nombres = 'persona_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/persona/';

            $file->move($paths, $nombres);

            $direccion_archivo = $paths. $nombres;

        }  else {
            if($persona->archivo != '/assets/persona/persona_default.png'){
                $direccion_archivo = $persona->foto;
            }
            else{
                $direccion_archivo = "/assets/persona/persona_default.png";
            }
        }

        $persona->nombres = $request->nombres;
        $persona->paterno = $request->paterno;
        $persona->materno = $request->materno;
        $persona->foto = $direccion_archivo;
        $persona->lugar_nacimiento_id = $request->lugar_nacimiento_id;
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->ci = $request->ci;
        $persona->complemento = $request->complemento;
        $persona->expedido_id = $request->expedido_id;
        $persona->telefono = $request->telefono;
        $persona->usuario_creado_id = Auth::user()->id;
        $persona->usuario_modificado_id = Auth::user()->id;

        $persona->save();

        return response()->json([
            'message' => __('messages.acciones.actualizaritem', ['item' => __('validation.attributes.banner')])
        ]);

        // return redirect()->route('listar_banner')->with('mensaje', 'editado exitosamente');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Zafrero::find($id);

        if (!$persona || $persona->activo == false) {
            abort(404);
        }

        $persona->activo = false;

        $persona->save();

        return response()->json([
            'success' => true,
            'data' => null,
            'mensaje' => __('messages.acciones.eliminaritem')
        ]);

        // return response()->json(['mensaje' => true]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $persona = Zafrero::find($id);

        $persona->activo = true;

        $persona->save();
        return response()->json([
            'success' => true,
            'data' => null,
            'mensaje' => __('messages.acciones.activaritem')
        ]);

        // return response()->json(['mensaje' => true]);
    }
}
