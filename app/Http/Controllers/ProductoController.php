<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Ciudad;
use App\Models\Producto;
use App\Models\Zafra;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductoController extends Controller
{
    public function view() {
        return view('modules.Administrador.Producto.view');
    }

    public function municion9() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $producto = Producto::where('estado', 1)
        ->where('producto.tipo_producto', 1)
        ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
        ->select('producto.*', 'tp.tipo_producto as tipoProducto')
        ->orderBy('id', 'asc')
        ->get();

        $ciudad = Ciudad::where('estado', 1)->orderBy('departamento', 'asc')->get();

        return view('modules.Productos.municion9', compact('producto', 'ciudad', 'zafra'));
    }

    public function municion762() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $producto = Producto::where('estado', 1)
        ->where('producto.tipo_producto', 2)
        ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
        ->select('producto.*', 'tp.tipo_producto as tipoProducto')
        ->orderBy('id', 'asc')
        ->get();

        $ciudad = Ciudad::where('estado', 1)->orderBy('departamento', 'asc')->get();

        return view('modules.Productos.municion762', compact('producto', 'ciudad', 'zafra'));
    }

    public function armamento() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $producto = Producto::where('estado', 1)
        ->where('producto.tipo_producto', 3)
        ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
        ->select('producto.*', 'tp.tipo_producto as tipoProducto')
        ->orderBy('id', 'asc')
        ->get();


        return view('modules.Productos.armamento', compact('producto', 'zafra'));
    }

    public function primers() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $producto = Producto::where('estado', 1)
        ->where('producto.tipo_producto', 5)
        ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
        ->select('producto.*', 'tp.tipo_producto as tipoProducto')
        ->orderBy('id', 'asc')
        ->get();


        return view('modules.Productos.primers', compact('producto', 'zafra'));
    }

    public function puntas_plomo() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $producto = Producto::where('estado', 1)
        ->where('producto.tipo_producto', 4)
        ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
        ->select('producto.*', 'tp.tipo_producto as tipoProducto')
        ->orderBy('id', 'asc')
        ->get();

        return view('modules.Productos.puntas_plomo', compact('producto', 'zafra'));
    }

    public function equipo_militar() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $producto = Producto::where('estado', 1)
        ->where('producto.tipo_producto', 6)
        ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
        ->select('producto.*', 'tp.tipo_producto as tipoProducto')
        ->orderBy('id', 'asc')
        ->get();

        return view('modules.Productos.equipo_militar', compact('producto', 'zafra'));
    }

    public function replicas() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $producto = Producto::where('estado', 1)
        ->where('producto.tipo_producto', 7)
        ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
        ->select('producto.*', 'tp.tipo_producto as tipoProducto')
        ->orderBy('id', 'asc')
        ->get();

        return view('modules.Productos.replicas', compact('producto', 'zafra'));
    }

    public function otros() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        $producto = Producto::where('estado', 1)
        ->where('producto.tipo_producto', 8)
        ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
        ->select('producto.*', 'tp.tipo_producto as tipoProducto')
        ->orderBy('id', 'asc')
        ->get();

        return view('modules.Productos.otros', compact('producto', 'zafra'));
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

            $producto = Producto::where('producto.estado', 1)
            ->join('tipo_producto as tp', 'tp.id', 'producto.tipo_producto')
            ->join('ciudad as cd', 'cd.id', 'producto.id_ciudad')
            ->select('producto.*', 'tp.tipo_producto as tipoProducto', 'cd.departamento as ciudad')
                ->orderBy('id', 'asc')
                ->get();

            return DataTables::of($producto)
                ->addIndexColumn()
                ->addColumn('imagen', function ($producto) {
                    $button = '<a class="ver-producto" style="text-align:center;display:block"><img
                    class="img-circle" src="' .asset("$producto->imagen") . '" width="50" height="50" /></a>';
                    return $button;
                })
                ->addColumn('action', function ($producto) {
                    $button = '<a href="' . route('editar_producto', ['id' => $producto->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i>
                  </a>';
                    $button .= '<form action="' . route('eliminar_producto', ['id' => $producto->id])  . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($producto) {
                    if ($producto->estado == 1) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-banner"></i>
                        Activo</button></div>';
                    } else{
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-banneres"></i>
                            Inactivo</button></div>';
                    }
                })
                /* ->addColumn('rol', function ($producto) {
                    return $producto->rol->nombre;
                }) */
                ->rawColumns(['action', 'estado', 'imagen'])
                ->make(true);
        }
        return view('modules.Administrador.Producto.view');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('producto.create');
    }


    /**
     * @param BannerRequest $request
     * @return JsonResponse
     */
    public function storeProducto(ProductoRequest $request) : JsonResponse
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
         if ($request->file('imagen')) {
            $file = $request->file('imagen');

            $nombres = 'producto_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/producto/images/imagen/';

            $file->move($paths, $nombres);

            $direccion_imagen = $paths. $nombres;

        } else {
            $direccion_imagen = "/assets/producto/images/producto_fondo_default.png";
        }


        $producto = new Producto($request->all());
   
        $producto->nombre = $request->nombre;
        $producto->presentacion = $request->presentacion;
        $producto->enlace = $request->enlace;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $direccion_imagen;
        $producto->tipo_producto = $request->tipo_producto;
        $producto->id_ciudad = $request->id_ciudad;
        $producto->estado = 1;
        $producto->usuario_creado_id = Auth::user()->id;
        $producto->usuario_modificado_id = Auth::user()->id;

        $producto->save();

        return response()->json([
            'message' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.producto')])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::where('id', $id)
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
        $producto = Producto::find($id);

        if (!$producto || $producto->estado == 0) {
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
    public function update(Request $request) : JsonResponse
    {
        $producto = Producto::find($request->id);

        if (!$producto || $producto->estado == 0) {
            abort(404);
        }

         // Almacenamiento de la imagen.
         if ($request->file('imagen')) {
            $file = $request->file('imagen');

            $nombres = 'producto_' . time() . '.' . $file->getClientOriginalExtension();

            $paths = 'assets/producto/images/imagen/';

            $file->move($paths, $nombres);

            $direccion_imagen = $paths. $nombres;

        } else {
            if($producto->imagen != '/assets/producto/images/producto_fondo_default.png'){
                $direccion_imagen = $producto->imagen;
            }
            else{
                $direccion_imagen = "/assets/producto/images/producto_fondo_default.png";
            }
        }


        $producto->nombre = $request->nombre;
        $producto->presentacion = $request->presentacion;
        $producto->enlace = $request->enlace;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $direccion_imagen;
        $producto->tipo_producto = $request->tipo_producto;
        $producto->id_ciudad = $request->id_ciudad;
        $producto->estado = 1;
        $producto->usuario_modificado_id = Auth::user()->id;

        $producto->save();

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
        $producto = Producto::find($id);

        if (!$producto || $producto->estado == 0) {
            abort(404);
        }

        $producto->estado = 0;

        $producto->save();

        return response()->json([
            'success' => true,
            'data' => null,
            'mensaje' => __('messages.acciones.eliminaritem')
        ]);

        // return response()->json(['mensaje' => true]);
    }

    /**
     * @param int $producto_id
     * @return JsonResponse
     */
    public function getProducto(int $producto_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Producto::findOrFail($producto_id),
                'message'   => __('messages.generico.datasuccess')
            ]);

        } catch (Exception $exception){

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);

        }
    }
}
