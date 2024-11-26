<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Video;
use App\Models\Zafra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class VideoController extends Controller
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

        $video = Video::where('estado', 1)
            ->orderBy('id', 'desc')
            ->get();
        //        dd($video);
        return view('modules.Administrador.Video.index', compact('video', 'zafra'));
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

            $video = Video::where('estado', 1)
                ->orderBy('id', 'asc')
                ->get();

            return DataTables::of($video)
                ->addIndexColumn()
                ->addColumn('action', function ($video) {
                    $button = '<a href="' . route('editar_video', ['id' => $video->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<form action="' . route('eliminar_video', ['id' => $video->id]) . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($video) {
                    if ($video->estado == 1) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-video"></i>
                        Activo</button></div>';
                    } else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-videos"></i>
                            Inactivo</button></div>';
                    }
                })
                ->rawColumns(['action', 'estado', 'video'])
                ->make(true);
        }
        return view('modules.Administrador.Video.view');
    }

    /**
     * @param VideoRequest $request
     * @return JsonResponse
     */
    public function storevideo(VideoRequest $request) : JsonResponse
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
         if ($request->file('video')) {
            $file = $request->file('video');

            $nombres = 'video_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/video/';

            $file->move($paths, $nombres);

            $direccion_video = $paths. $nombres;

        } else {
            $direccion_video = "/assets/video/video_default.pdf";
        }

      

        $video = new video($request->all());
        //dd($video);
        $video->titulo = strtoupper($request->titulo);
        $video->video = $direccion_video;

        $video->estado = 1;
        $video->usuario_creado_id = Auth::user()->id;
        $video->usuario_modificado_id = Auth::user()->id;

        $video->save();

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
        $video = Video::find($request->id);

        if (!$video || $video->estado == 0) {
            abort(404);
        }

         // Almacenamiento del video.
         if ($request->file('video')) {
            $file = $request->file('video');

            $nombres = 'video_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/video/';

            $file->move($paths, $nombres);

            $direccion_video = $paths. $nombres;

        }  else {
            if($video->video != '/assets/video/video_fondo_default.png'){
                $direccion_video = $video->video;
            }
            else{
                $direccion_video = "/assets/video/video_fondo_default.png";
            }
        }


        $video->titulo = strtoupper($request->titulo);
        $video->video = $direccion_video;
        $video->estado = 1;
        $video->usuario_modificado_id = Auth::user()->id;

        $video->save();

        return response()->json([
            'message' => __('messages.acciones.actualizaritem', ['item' => __('validation.attributes.banner')])
        ]);

        // return redirect()->route('listar_banner')->with('mensaje', 'editado exitosamente');
    }

    public function mostrar($id)
    {
        $video = Video::find($id);
        if (!$video || $video->estado == 0) {
            abort(404);
        }

        return response()->json([
            'success' => true,
            'data' => $video,
            'mensaje' => __('messages.generico.datasuccess')
        ]);

        // return view('modules.Administrador.Video.mostrar', compact('video'));
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);

        if (!$video || $video->estado == 0) {
            abort(404);
        }

        $video->estado = 0;

        $video->save();

        return response()->json([
            'success' => true,
            'data' => null,
            'mensaje' => __('messages.acciones.eliminaritem')
        ]);

        // return response()->json(['mensaje' => true]);
    }

    /**
     * @param int $video_id
     * @return JsonResponse
     */
    public function getvideo(int $video_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Video::findOrFail($video_id),
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
        $video = Video::where('id', $id)
            ->get();
        //dd($video);
        return view('modules.Administrador.Video.show', compact('video'));
    }
}
