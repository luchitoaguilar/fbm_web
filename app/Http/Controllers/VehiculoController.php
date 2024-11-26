<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoRequest;
use App\Models\Vehiculo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class VehiculoController extends Controller
{
    public function listar(Request $request)
    {
        if ($request->ajax()) {

            $vehiculo = Vehiculo::where('estado', 1)
                ->orderBy('vehiculo.id', 'asc')
                ->get();

            return DataTables::of($vehiculo)
                ->addIndexColumn()
                ->addColumn('action', function ($vehiculo) {
                    $button = '<a href="' . route('editar_vehiculo', ['id' => $vehiculo->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<form action="' . route('eliminar_vehiculo', ['id' => $vehiculo->id]) . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($vehiculo) {
                    if ($vehiculo->estado == 1) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-vehiculo"></i>
                        Activo</button></div>';
                    } else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-vehiculos"></i>
                            Inactivo</button></div>';
                    }
                })
                /* ->addColumn('rol', function ($vehiculo) {
                    return $vehiculo->rol->nombre;
                }) */
                ->rawColumns(['action', 'estado'])
                ->make(true);
        }
        return view('modules.Administrador.Vehiculo.view');
    }


    public function getVehiculos(Request $request) {
        $item = new Vehiculo();
        $objeto = null;

        $objeto = $item->orderBy('cod_vehiculo', 'asc')->where('gestion', date("Y"))->get();

        $data = array(
            'success' => true,
            'data' => $objeto,
            'msg' => trans('messages.listed')
        );

        return response()->json($data);
    }
    /**
     * @param VehiculoRequest $request
     * @return JsonResponse
     */
    public function storeVehiculo(VehiculoRequest $request) : JsonResponse
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
         if ($request->file('archivo')) {
            $file = $request->file('archivo');

            $nombres = 'zafra_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/vehiculo/';

            $file->move($paths, $nombres);

            $direccion_archivo = $paths. $nombres;

        } else {
            $direccion_archivo = "/assets/vehiculo/vehiculo_default.pdf";
        }


        $vehiculo = new Vehiculo($request->all());
        //dd($vehiculo);
        $vehiculo->cod_vehiculo = $request->cod_vehiculo;
        $vehiculo->placa = $request->placa;
        $vehiculo->vehiculo = $request->vehiculo;
        $vehiculo->archivo = $direccion_archivo;
        $vehiculo->tara = $request->tara;
        $vehiculo->observaciones = $request->observaciones;
        $vehiculo->estado = 1;
        $vehiculo->gestion = $request->gestion;
        $vehiculo->usuario_creado_id = Auth::user()->id;
        $vehiculo->usuario_modificado_id = Auth::user()->id;

        $vehiculo->save();

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
        $vehiculo = Vehiculo::find($request->id);

        if (!$vehiculo || $vehiculo->estado == 0) {
            abort(404);
        }

         // Almacenamiento de la imagen fondo.
         if ($request->file('archivo')) {
            $file = $request->file('archivo');

            $nombres = 'vehiculo_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/vehiculo/';

            $file->move($paths, $nombres);

            $direccion_archivo = $paths. $nombres;

        }  else {
            if($vehiculo->archivo != '/assets/vehiculo/vehiculo_default.png'){
                $direccion_archivo = $vehiculo->archivo;
            }
            else{
                $direccion_archivo = "/assets/vehiculo/vehiculo_default.png";
            }
        }

        $vehiculo->cod_vehiculo = $request->cod_vehiculo;
        $vehiculo->placa = $request->placa;
        $vehiculo->vehiculo = $request->vehiculo;
        $vehiculo->archivo = $direccion_archivo;
        $vehiculo->tara = $request->tara;
        $vehiculo->observaciones = $request->observaciones;
        $vehiculo->estado = 1;
        $vehiculo->usuario_modificado_id = Auth::user()->id;

        $vehiculo->save();

        return response()->json([
            'message' => __('messages.acciones.actualizaritem', ['item' => __('validation.attributes.vehiculo')])
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
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo || $vehiculo->estado == 0) {
            abort(404);
        }

        $vehiculo->estado = 0;

        $vehiculo->save();

        return response()->json([
            'success' => true,
            'data' => null,
            'mensaje' => __('messages.acciones.eliminaritem')
        ]);

        // return response()->json(['mensaje' => true]);
    }

    /**
     * @param int $noticia_id
     * @return JsonResponse
     */
    public function getVehiculo(int $vehiculo_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Vehiculo::findOrFail($vehiculo_id),
                'message'   => __('messages.generico.datasuccess')
            ]);

        } catch (Exception $exception){

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);

        }
    }

}
