<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompraRequest;
use App\Models\Ciudad;
use App\Models\Compra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class CompraController extends Controller
{
    public function view()
    {
        // $zafra = Zafra::where('estado', 1)
        // ->sum('peso_neto');

        $ciudad = Ciudad::where('estado', 1)->orderBy('departamento', 'asc')->get();

        return view('modules.Compra.compra', compact('ciudad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listar(Request $request)
    {
        // dd($request->ajax());
        if ($request->ajax()) {

            $compra = Compra::orderBy('id', 'asc')
            ->join('ciudad', 'ciudad.id', 'id_ciudad')
            ->select('ciudad.departamento as ciudad', 'compra.*')
                ->get();

            return DataTables::of($compra)
                ->addIndexColumn()
                ->addColumn('action', function ($compra) {
                    $button = '<a href="' . route('editar_compra', ['id' => $compra->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<form action="' . route('eliminar_compra', ['id' => $compra->id]) . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($compra) {
                    if ($compra->estado_correo == 2) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-check"></i>
                        Contactado Correo</button></div>';
                    } else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-exclamation-triangle"></i>
                            Por Contactar</button></div>';
                    }
                })
                ->addColumn('estado_whats', function ($compra) {
                    if ($compra->estado_whatsapp == 2) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-check"></i>
                        Contactado WhatsApp</button></div>';
                    }else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-exclamation-triangle"></i>
                            Por Contactar</button></div>';
                    }
                })
                
                ->rawColumns(['action', 'estado', 'estado_whats'])
                ->make(true);
        }
        return view('modules.Compra.view');
    }

 /**
     * @param int $contacto_id
     * @return JsonResponse
     */
    public function getCompra(int $compra_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Compra::where('compra.id', $compra_id)
                ->join('ciudad', 'ciudad.id', 'id_ciudad')
                ->select('ciudad.departamento as ciudad', 'compra.*')->first(),
                'message'   => __('messages.generico.datasuccess')
            ]);

        } catch (Exception $exception){

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);

        }
    }

    public function replyCompra(Request $request): JsonResponse
    {
        $contacto = Compra::find($request->id);
   
        $contacto->estado_correo = 2;
        $contacto->usuario_creado_id = Auth::user()->id;
        $contacto->usuario_modificado_id = Auth::user()->id;


            $remitente = 'jefe_com_fbm@cofadena.gob.bo';
            $destino = $contacto->email;
            $data = ['nombre' => $contacto->nombre, 'mensaje' => $request->msg];
            Mail::send('modules.PlantillaCorreo.respuestaContacto', $data, function ($mess) use ($destino, $remitente) {
                $mess->subject('Fabrica Boliviana de Munición - Respuesta');
                $mess->from($remitente, 'FBM - COFADENA');
                $mess->to($destino)->subject('Respuesta Información - FBM');
            });

    //   dump($contacto);
        $contacto->save();

        return response()->json([
            'mensaje' => __('messages.acciones.enviocorreo', ['item' => __('validation.attributes.compra')])
        ]);
    }

    public function replyWhatsappCompra(Request $request)
    {
        $compra = Compra::find($request->id);
   
        $compra->estado_whatsapp = 2;
        $compra->usuario_creado_id = Auth::user()->id;
        $compra->usuario_modificado_id = Auth::user()->id;

        $data = "https://wa.me/591$compra->celular/?text=$request->msg";

        $compra->save();

        return response()->json([
            'whatsapp' => $data,
            'mensaje' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.contacto')])
        ]);
    }

    public function replyWhatsappCompraMasiva(Request $request)
    {
        $data = "https://wa.me?text=$request->mensaje";

        return response()->json([
            'whatsapp' => $data,
            'mensaje' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.contacto')])
        ]);
    }

    public function store(CompraRequest $request): JsonResponse
    {
        $contacto = new Compra($request->all());

        $contacto->nombre = $request->nombre;
        $contacto->email = $request->email;
        $contacto->celular = $request->celular;
        $contacto->baucher = $request->baucher;
        $contacto->grado = $request->grado;
        $contacto->monto = $request->monto;
        $contacto->id_ciudad = $request->id_ciudad;
        $contacto->estado = 1;
        //usuario X porque los crea cualquier persona
        $contacto->usuario_creado_id = 9;
        $contacto->usuario_modificado_id = 9;


        // $remitente = 'jefe_com_fbm@cofadena.gob.bo';
        // $destino = $contacto->email;
        // $data = ['nombre' => $contacto->nombre, 'mensaje' => $request->msg];
        // Mail::send('modules.PlantillaCorreo.respuestaContacto', $data, function ($mess) use ($destino, $remitente) {
        //     $mess->from($remitente, 'FBM - COFADENA');
        //     $mess->to($destino)->subject('Respuesta Información - FBM');
        // });

        //   dump($contacto);
        $contacto->save();

        return response()->json([
            'message' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.compra')])
        ]);
    }
}
