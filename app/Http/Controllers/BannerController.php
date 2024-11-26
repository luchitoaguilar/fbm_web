<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    public function view()
    {
        return view('modules.Administrador.Banner.view');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request)
    {
        // dd($request->ajax());
        if ($request->ajax()) {

            $banner = Banner::where('estado', 1)
                ->orderBy('id', 'asc')
                ->get();

            return DataTables::of($banner)
                ->addIndexColumn()
                ->addColumn('imagen_frente', function ($banner) {
                    $button = '<a class="ver-usuario" style="text-align:center;display:block"><img
                    class="img-circle" src="' . asset("$banner->imagen_frente") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('imagen_fondo', function ($banner) {
                    $button = '<a class="ver-usuario" style="text-align:center;display:block"><img
                    class="img-circle" src="' . asset("$banner->imagen_fondo") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('action', function ($banner) {
                    $button = '<a href="' . route('editar_banner', ['id' => $banner->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i>
                  </a>';
                    $button .= '<form action="' . route('eliminar_banner', ['id' => $banner->id])  . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($banner) {
                    if ($banner->estado == 1) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-banner"></i>
                        Activo</button></div>';
                    } else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-banneres"></i>
                            Inactivo</button></div>';
                    }
                })
                /* ->addColumn('rol', function ($banner) {
                    return $banner->rol->nombre;
                }) */
                ->rawColumns(['action', 'estado', 'imagen_frente', 'imagen_fondo'])
                ->make(true);
        }
        return view('modules.Administrador.Banner.view');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
    }


    /**
     * @param BannerRequest $request
     * @return JsonResponse
     */
    public function storeBanner(BannerRequest $request): JsonResponse
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
        if ($request->file('imagen_fondo')) {
            $file = $request->file('imagen_fondo');

            $nombres = 'banner_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/banner/images/imagen_fondo/';

            $file->move($paths, $nombres);

            $direccion_imagen_fondo = $paths . $nombres;
        } else {
            $direccion_imagen_fondo = "/assets/banner/images/banner_fondo_default.png";
        }

        // Almacenamiento de la imagen.
        if ($request->file('imagen_frente')) {
            $file = $request->file('imagen_frente');

            $nombres = 'banner_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/banner/images/imagen_frente/';

            $file->move($paths, $nombres);

            $direccion_imagen_frente = $paths . $nombres;
        } else {
            $direccion_imagen_frente = null;
        }

        $banner = new Banner($request->all());

        $banner->nombre = $request->nombre;
        $banner->datos = $request->datos;
        $banner->enlace = $request->enlace;
        $banner->precio = $request->precio;
        $banner->imagen_fondo = $direccion_imagen_fondo;
        $banner->imagen_frente = $direccion_imagen_frente;
        $banner->estado = 1;
        $banner->usuario_creado_id = Auth::user()->id;
        $banner->usuario_modificado_id = Auth::user()->id;

        $banner->save();

        return response()->json([
            'message' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.banner')])
        ]);

        // return redirect()->route('listar_banner')->with('mensaje', 'creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::where('id', $id)
            ->get();
        //dd($boletin);
        return view('banner.show', compact('banner'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);

        if (!$banner || $banner->estado == 0) {
            abort(404);
        }

        //$roles = Rol::orderBy('nombre', 'asc')->where('estado', 1)->get();
        /* $roles = Rol::orderBy('nombre', 'asc')->where('estado', 1)->pluck('nombre', 'id'); */

        return view('banner.edit', compact('banner'));
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
        $banner = Banner::find($request->id);

        if (!$banner || $banner->estado == 0) {
            abort(404);
        }

        // Almacenamiento de la imagen fondo.
        if ($request->file('imagen_fondo')) {
            $file = $request->file('imagen_fondo');

            $nombres = 'banner_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/banner/imagen_fondo/';

            $file->move($paths, $nombres);

            $direccion_imagen_fondo = $paths . $nombres;
        } else {
            if ($banner->imagen_fondo != '/assets/banner/images/banner_fondo_default.png') {
                $direccion_imagen_fondo = $banner->imagen_fondo;
            } else {
                $direccion_imagen_fondo = "/assets/banner/images/banner_fondo_default.png";
            }
        }

        // Almacenamiento de la imagen frente.
        if ($request->file('imagen_frente')) {
            $file = $request->file('imagen_frente');

            $nombres = 'banner_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/banner/imagen_frente/';

            $file->move($paths, $nombres);

            $direccion_imagen_frente = $paths . $nombres;
        } else {
            if ($banner->imagen_frente != '/assets/banner/images/banner_frente_default.png') {
                $direccion_imagen_frente = $banner->imagen_frente;
            } else {
                $direccion_imagen_frente = "/assets/banner/images/banner_frente_default.png";
            }
        }

        $banner->nombre = $request->nombre;
        $banner->datos = $request->datos;
        $banner->enlace = $request->enlace;
        if (is_null($banner->precio)) {
            $banner->precio = "";
        } else{
            $banner->precio = $request->precio;
        }
        $banner->imagen_fondo = $direccion_imagen_fondo;
        $banner->imagen_frente = $direccion_imagen_frente;
        $banner->estado = 1;
        $banner->usuario_modificado_id = Auth::user()->id;

        $banner->save();

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
        $banner = Banner::find($id);

        if (!$banner || $banner->estado == 0) {
            abort(404);
        }

        $banner->estado = 0;

        $banner->save();

        return response()->json([
            'success' => true,
            'data' => null,
            'mensaje' => __('messages.acciones.eliminaritem')
        ]);

        // return response()->json(['mensaje' => true]);
    }

    /**
     * @param int $banner_id
     * @return JsonResponse
     */
    public function getBanner(int $banner_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Banner::findOrFail($banner_id),
                'message'   => __('messages.generico.datasuccess')
            ]);
        } catch (Exception $exception) {

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);
        }
    }
}
