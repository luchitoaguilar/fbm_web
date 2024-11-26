<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticiaRequest;
use App\Models\Noticia;
use App\Models\Zafra;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Error\Notice;
use Yajra\DataTables\Facades\DataTables;

class NoticiaController extends Controller
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

        $noticia = Noticia::where('estado', 1)
            ->orderBy('id', 'desc')
            ->get();
        //        dd($noticia);
        return view('modules.Administrador.Noticia.index', compact('noticia', 'zafra'));
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

            $noticia = Noticia::where('estado', 1)
                ->orderBy('id', 'asc')
                ->get();

            return DataTables::of($noticia)
                ->addIndexColumn()
                ->addColumn('imagen_0', function ($noticia) {
                    $button = '<a class="ver-imagen" style="text-align:center;display:block"><img
                    class="img-circle" src="' . asset("$noticia->imagen_0") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('imagen_1', function ($noticia) {
                    $button = '<a class="ver-imagen" style="text-align:center;display:block"><img
                    class="img-circle" src="' . asset("$noticia->imagen_1") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('imagen_2', function ($noticia) {
                    $button = '<a class="ver-imagen" style="text-align:center;display:block"><img
                    class="img-circle" src="' . asset("$noticia->imagen_2") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('imagen_3', function ($noticia) {
                    $button = '<a class="ver-imagen" style="text-align:center;display:block"><img
                    class="img-circle" src="' . asset("$noticia->imagen_3") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('imagen_4', function ($noticia) {
                    $button = '<a class="ver-imagen" style="text-align:center;display:block"><img
                    class="img-circle" src="' . asset("$noticia->imagen_4") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('archivo', function ($noticia) {
                    $button = '<a href="' . route('mostrar_noticia', ['id' => $noticia->id]) . '" class="ver-noticia" style="text-align:center;display:block">
<span class="material-icons">article</span></a>';
                    return $button;
                })
                ->addColumn('action', function ($noticia) {
                    $button = '<a href="' . route('editar_noticia', ['id' => $noticia->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<form action="' . route('eliminar_noticia', ['id' => $noticia->id]) . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($noticia) {
                    if ($noticia->estado == 1) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-noticia"></i>
                        Activo</button></div>';
                    } else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-noticias"></i>
                            Inactivo</button></div>';
                    }
                })
                /* ->addColumn('rol', function ($noticia) {
                    return $noticia->rol->nombre;
                }) */
                ->rawColumns(['action', 'estado', 'imagen_0', 'imagen_1', 'imagen_2', 'imagen_3', 'imagen_4', 'archivo'])
                ->make(true);
        }
        return view('modules.Administrador.Noticia.view');
    }

    /**
     * @param NoticiaRequest $request
     * @return JsonResponse
     */
    public function storeNoticia(NoticiaRequest $request) : JsonResponse
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

            $nombres = 'noticia_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/noticia/archivo/';

            $file->move($paths, $nombres);

            $direccion_archivo = $paths. $nombres;

        } else {
            $direccion_archivo = "/assets/noticia/archivo/noticia_default.pdf";
        }

        // Almacenamiento de la imagen.
        $direccion_imagen = '';
        $array = [0, 1, 2, 3, 4];

        foreach ($array as $i) {
            if ($request->file('imagen_' . $i)) {
                $file = $request->file('imagen_' . $i);
                $nombres = 'noticia_imagen_' . $i . time() . '.' . $file->getClientOriginalExtension();

                $paths = 'assets/noticias/images/';

                $file->move($paths, $nombres);

                $direccion_imagen . $i = $paths . $nombres;
            } else {
                $direccion_imagen . $i = "/assets/noticias/images/noticia_default.png";
            }

            $arreglo[] = $direccion_imagen . $i;
        }

        $noticia = new Noticia($request->all());
        //dd($noticia);
        $noticia->titulo = strtoupper($request->titulo);
        $noticia->archivo = $direccion_archivo;

        foreach ($array as $i) {
            $aux = 'imagen_' . $i;
            $noticia->$aux = $arreglo[$i];
        }
        $noticia->descripcion = preg_replace('/\s+/', ' ', nl2br($request->descripcion));
        $noticia->estado = 1;
        $noticia->usuario_creado_id = Auth::user()->id;
        $noticia->usuario_modificado_id = Auth::user()->id;

        $noticia->save();

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
        $noticia = Noticia::find($request->id);

        if (!$noticia || $noticia->estado == 0) {
            abort(404);
        }

        // Almacenamiento de la imagen.
        $direccion_imagen = '';
        $array = [0, 1, 2, 3, 4];

        foreach ($array as $i) {
            if ($request->file('imagen_' . $i)) {
                $file = $request->file('imagen_' . $i);
                $nombres = 'noticia_imagen_' . $i . time() . '.' . $file->getClientOriginalExtension();

                $paths = 'assets/noticias/images/';

                $file->move($paths, $nombres);

                $direccion_imagen . $i = $paths . $nombres;
            } else {
                $direccion_imagen . $i = "/assets/noticias/images/noticia_default.png";
            }

            $arreglo[] = $direccion_imagen . $i;
        }

         // Almacenamiento de la imagen fondo.
         if ($request->file('archivo')) {
            $file = $request->file('archivo');

            $nombres = 'noticia_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/noticia/';

            $file->move($paths, $nombres);

            $direccion_archivo = $paths. $nombres;

        }  else {
            if($noticia->archivo != '/assets/noticia/noticia_fondo_default.png'){
                $direccion_archivo = $noticia->archivo;
            }
            else{
                $direccion_archivo = "/assets/noticia/noticia_fondo_default.png";
            }
        }


        foreach ($array as $i) {
            $aux = 'imagen_' . $i;
            $noticia->$aux = $arreglo[$i];
        }

        $noticia->descripcion = preg_replace('/\s+/', ' ', nl2br($request->descripcion));

        $noticia->titulo = strtoupper($request->titulo);
        $noticia->enlace = $request->enlace;
        $noticia->archivo = $direccion_archivo;
        $noticia->estado = 1;
        $noticia->usuario_modificado_id = Auth::user()->id;

        $noticia->save();

        return response()->json([
            'message' => __('messages.acciones.actualizaritem', ['item' => __('validation.attributes.banner')])
        ]);

        // return redirect()->route('listar_banner')->with('mensaje', 'editado exitosamente');
    }

    public function mostrar($id)
    {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $noticia = Noticia::find($id);

        if (!$noticia || $noticia->estado == 0) {
            abort(404);
        }

        return view('modules.Administrador.Noticia.mostrar', compact('noticia', 'zafra'));
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);

        if (!$noticia || $noticia->estado == 0) {
            abort(404);
        }

        $noticia->estado = 0;

        $noticia->save();

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
    public function getNoticia(int $noticia_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Noticia::findOrFail($noticia_id),
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
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $noticia = Noticia::where('id', $id)
            ->get();
        //dd($noticia);
        return view('modules.Administrador.Noticia.show', compact('noticia', 'zafra'));
    }


}
