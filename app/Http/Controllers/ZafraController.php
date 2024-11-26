<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZafraRequest;
use App\Models\Zafra;
use App\Models\ZafraZafrero;
use App\Models\Zafrero;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ZafraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zafra = Zafra::where('estado', 1)
            ->orderBy('id', 'asc')
            ->get();
        //        dd($noticia);
        return view('modules.Administrador.Zafra.index', compact('zafra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request)
    {
        if ($request->ajax()) {

            $zafra = Zafra::where('zafra.estado', 1)
                ->join('vehiculo', 'vehiculo.id', 'zafra.cod_vehiculo')
                ->select('zafra.*', 'vehiculo.id as idv', 'vehiculo.cod_vehiculo', 'vehiculo.placa')
                ->orderBy('fecha_ingreso', 'desc')
                ->get();

            return DataTables::of($zafra)
                ->addIndexColumn()
                ->addColumn('action', function ($zafra) {
                    $button = '<a href="' . route('editar_zafra', ['id' => $zafra->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<form action="' . route('eliminar_zafra', ['id' => $zafra->id]) . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($zafra) {
                    if ($zafra->estado == 1) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-zafra"></i>
                        Activo</button></div>';
                    } else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-zafras"></i>
                            Inactivo</button></div>';
                    }
                })
                /* ->addColumn('rol', function ($zafra) {
                    return $zafra->rol->nombre;
                }) */
                ->rawColumns(['action', 'estado'])
                ->make(true);
        }
        return view('modules.Administrador.Zafra.view');
    }

    /**
     * @param ZafraRequest $request
     * @return JsonResponse
     */
    public function storeZafra(ZafraRequest $request): JsonResponse
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

            $paths = 'assets/zafra/';

            $file->move($paths, $nombres);

            $direccion_archivo = $paths . $nombres;
        } else {
            $direccion_archivo = "/assets/zafra/zafra_default.pdf";
        }


        $personal = [];
        $id_zafra = Zafra::latest()->first();
        $zafra = new Zafra($request->all());
        $zafra_zafrero = new ZafraZafrero($request->all());
        //dd($zafra);
        if (!$request->personal_zafra_id) {
            foreach ($request->personal_zafra_id as $codigo) {
                $zafra_zafrero->zafra_id = $id_zafra;
                $zafra_zafrero->zafrero_id = $codigo;
                $zafra_zafrero->cod_vehiculo = $request->cod_vehiculo;
                $zafra_zafrero->fecha_ingreso = $request->fecha_ingreso;
                $zafra_zafrero->peso_neto = $request->peso_neto;
                $zafra_zafrero->num_recibo = $request->num_recibo;


                $zafrero = Zafrero::where('id', $codigo)->first();
                //Creamos el seguimiento del documento para cada destinatario, con estado "DR" -> derivado
                array_push($personal, $zafrero->nombres . ' ' . $zafrero->paterno . ' ' . $zafrero->materno);
            }
        }

        $zafra->cod_vehiculo = $request->cod_vehiculo;
        $zafra->tipo_cosecha = $request->tipo_cosecha;
        $zafra->fecha_ingreso = $request->fecha_ingreso;
        $zafra->archivo = $direccion_archivo;
        $zafra->peso_neto = $request->peso_neto;
        $zafra->observaciones = $request->observaciones;
        $zafra->num_recibo = $request->num_recibo;
        $zafra->personal_zafra_id = $request->personal_zafra_id;
        $zafra->personal_zafra = $personal;
        $zafra->estado = 1;
        $zafra->gestion = date('Y');
        $zafra->usuario_creado_id = Auth::user()->id;
        $zafra->usuario_modificado_id = Auth::user()->id;

        $zafra->save();

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
    public function update(Request $request): JsonResponse
    {
        $zafra = Zafra::find($request->id);
        $zafra_zafrero =ZafraZafrero::where('zafra_id',$zafra->id)->delete();

        if (!$zafra || $zafra->estado == 0) {
            abort(404);
        }

        // Almacenamiento de la imagen fondo.
        if ($request->file('archivo')) {
            $file = $request->file('archivo');

            $nombres = 'zafra_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/zafra/';

            $file->move($paths, $nombres);

            $direccion_archivo = $paths . $nombres;
        } else {
            if ($zafra->archivo != '/assets/zafra/zafra_default.png') {
                $direccion_archivo = $zafra->archivo;
            } else {
                $direccion_archivo = "/assets/zafra/zafra_default.png";
            }
        }

        $personal = [];
        foreach ($request->personal_zafra_id as $codigo) {
            $zafra_zafrero = new ZafraZafrero($request->all());
            $zafra_zafrero->zafra_id = $request->id;
            $zafra_zafrero->zafrero_id = $codigo;
            $zafra_zafrero->cod_vehiculo = $request->cod_vehiculo;
            $zafra_zafrero->fecha_ingreso = $request->fecha_ingreso;
            $zafra_zafrero->peso_neto = $request->peso_neto / $request->total_personal_zafra;
            $zafra_zafrero->num_recibo = $request->num_recibo;
            $zafra_zafrero->usuario_creado_id = Auth::user()->id;
            $zafra_zafrero->usuario_modificado_id = Auth::user()->id;
            $zafra_zafrero->save();


            $zafrero = Zafrero::where('id', $codigo)->first();
            //Creamos el seguimiento del documento para cada destinatario, con estado "DR" -> derivado
            array_push($personal, $zafrero->nombres . ' ' . $zafrero->paterno . ' ' . $zafrero->materno);
        }

        $zafra->cod_vehiculo = $request->cod_vehiculo;
        $zafra->tipo_cosecha = $request->tipo_cosecha;
        $zafra->fecha_ingreso = $request->fecha_ingreso;
        $zafra->archivo = $direccion_archivo;
        $zafra->peso_neto = $request->peso_neto;
        $zafra->observaciones = $request->observaciones;
        $zafra->num_recibo = $request->num_recibo;
        $zafra->personal_zafra_id = $request->personal_zafra_id;
        $zafra->personal_zafra = $personal;
        $zafra->estado = 1;
        $zafra->gestion = date('Y');
        $zafra->usuario_creado_id = Auth::user()->id;
        $zafra->usuario_modificado_id = Auth::user()->id;

        $zafra->save();

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
        $zafra = Zafra::find($id);

        if (!$zafra || $zafra->estado == 0) {
            abort(404);
        }

        $zafra->estado = 0;

        $zafra->save();

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
    public function getZafra(int $zafra_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Zafra::join('vehiculo', 'vehiculo.id', 'zafra.cod_vehiculo')
                    ->select('zafra.*', 'vehiculo.id as idv', 'vehiculo.cod_vehiculo', 'vehiculo.placa')
                    ->findOrFail($zafra_id),
                'message'   => __('messages.generico.datasuccess')
            ]);
        } catch (Exception $exception) {

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);
        }
    }

    public function personalZafra(Request $request): JsonResponse
    {
        $zafra = Zafra::find($request->id);

        if (!$zafra || $zafra->estado == 0) {
            abort(404);
        }

        $zafra->personal_zafra = $request->personal_zafra;
        $zafra->usuario_modificado_id = Auth::user()->id;

        $zafra->save();

        return response()->json([
            'message' => __('messages.acciones.actualizaritem', ['item' => __('validation.attributes.banner')])
        ]);
    }

    public function getTotalZafra(Request $request)
    {
        $zafra = Zafra::where('estado', 1)
            ->sum('peso_neto');

        $data = array(
            'success' => true,
            'data' => $zafra
        );

        return response()->json($data);
    }
}
