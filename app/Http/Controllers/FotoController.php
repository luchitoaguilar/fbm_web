<?php

namespace App\Http\Controllers;

use App\Http\Requests\FotoRequest;
use App\Models\Foto;
use App\Models\Zafra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $foto = Foto::where('estado', 1)
            ->orderBy('id', 'desc')
            ->get();
        //        dd($foto);
        return view('modules.Administrador.Foto.index', compact('foto', 'zafra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request)
    {
        //dd($request->ajax());
        if ($request->ajax()) {

            $foto = Foto::where('estado', 1)
                ->orderBy('id', 'asc')
                ->get();

            return DataTables::of($foto)
                ->addIndexColumn()
                ->addColumn('foto', function ($foto) {
                    $button = '<a class="ver-producto" style="text-align:center;display:block"><img
                    class="img-circle" src="' .asset("$foto->foto") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('action', function ($foto) {
                    $button = '<a href="' . route('editar_foto', ['id' => $foto->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<form action="' . route('eliminar_foto', ['id' => $foto->id]) . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($foto) {
                    if ($foto->estado == 1) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-foto"></i>
                        Activo</button></div>';
                    } else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-fotos"></i>
                            Inactivo</button></div>';
                    }
                })
                ->rawColumns(['action', 'estado', 'foto'])
                ->make(true);
        }
        return view('modules.Administrador.Foto.view');
    }

    /**
     * @param FotoRequest $request
     * @return JsonResponse
     */
    public function storefoto(FotoRequest $request) : JsonResponse
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

            $nombres = 'foto_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/foto/';

            $file->move($paths, $nombres);

            $direccion_foto = $paths. $nombres;

        } else {
            $direccion_foto = "/assets/foto/foto_default.pdf";
        }

      

        $foto = new foto($request->all());
        //dd($foto);
        $foto->detalle = strtoupper($request->detalle);
        $foto->foto = $direccion_foto;

        $foto->estado = 1;
        $foto->usuario_creado_id = Auth::user()->id;
        $foto->usuario_modificado_id = Auth::user()->id;

        $foto->save();

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
        $foto = Foto::find($request->id);

        if (!$foto || $foto->estado == 0) {
            abort(404);
        }

         // Almacenamiento del Foto.
         if ($request->file('foto')) {
            $file = $request->file('foto');

            $nombres = 'foto_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/foto/';

            $file->move($paths, $nombres);

            $direccion_foto = $paths. $nombres;

        }  else {
            if($foto->foto != '/assets/foto/foto_fondo_default.png'){
                $direccion_foto = $foto->foto;
            }
            else{
                $direccion_foto = "/assets/foto/foto_fondo_default.png";
            }
        }


        $foto->detalle = strtoupper($request->detalle);
        $foto->foto = $direccion_foto;
        $foto->estado = 1;
        $foto->usuario_modificado_id = Auth::user()->id;

        $foto->save();

        return response()->json([
            'message' => __('messages.acciones.actualizaritem', ['item' => __('validation.attributes.banner')])
        ]);

        // return redirect()->route('listar_banner')->with('mensaje', 'editado exitosamente');
    }

    public function mostrar($id)
    {
        $foto = Foto::find($id);
        if (!$foto || $foto->estado == 0) {
            abort(404);
        }

        return response()->json([
            'success' => true,
            'data' => $foto,
            'mensaje' => __('messages.generico.datasuccess')
        ]);

        // return view('modules.Administrador.Foto.mostrar', compact('foto'));
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = Foto::find($id);

        if (!$foto || $foto->estado == 0) {
            abort(404);
        }

        $foto->estado = 0;

        $foto->save();

        return response()->json([
            'success' => true,
            'data' => null,
            'mensaje' => __('messages.acciones.eliminaritem')
        ]);

        // return response()->json(['mensaje' => true]);
    }

    /**
     * @param int $foto_id
     * @return JsonResponse
     */
    public function getfoto(int $foto_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Foto::findOrFail($foto_id),
                'message'   => __('messages.generico.datasuccess')
            ]);

        } catch (Exception $exception){

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $foto = Foto::where('id', $id)
            ->get();
        //dd($foto);
        return view('modules.Administrador.Foto.show', compact('foto'));
    }
}
