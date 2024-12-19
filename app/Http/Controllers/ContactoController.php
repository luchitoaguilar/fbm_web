<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Models\Contacto;
use App\Models\Zafra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class ContactoController extends Controller
{
    public function view() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        return view('modules.Contacto.contacto', compact('zafra'));
    }

    public function store(ContactoRequest $request): JsonResponse
    {
        $contacto = new Contacto($request->all());
   
        $contacto->nombre = $request->nombre;
        $contacto->email = $request->email;
        $contacto->telefono = $request->telefono;
        $contacto->asunto = $request->asunto;
        $contacto->mensaje = $request->mensaje;
        $contacto->estado = 1;
        $contacto->usuario_creado_id = Auth::user()->id;
        $contacto->usuario_modificado_id = Auth::user()->id;


            $remitente = 'jefe_com_fbm@cofadena.gob.bo';
            $destino = ['enc_ventas_nal_fbm@cofadena.gob.bo', 'jefe_com_fbm@cofadena.gob.bo'];
            $data = ['nombre' => $contacto->nombre, 'email' => $contacto->email , 'telefono' =>$contacto->telefono, 'asunto' => $contacto->asunto, 'mensaje' => $contacto->mensaje];
            Mail::send('modules.PlantillaCorreo.mensajeContacto', $data, function ($mess) use ($destino, $remitente) {
                $mess->from($remitente, 'FBM - COFADENA');
                $mess->to($destino)->subject('Solicitud Información - FBM');
            });

    //   dump($contacto);
        $contacto->save();

        return response()->json([
            'message' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.contacto')])
        ]);
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

            $contacto = Contacto::orderBy('id', 'asc')
                ->get();

            return DataTables::of($contacto)
                ->addIndexColumn()
                ->addColumn('action', function ($contacto) {
                    $button = '<a href="' . route('editar_contacto', ['id' => $contacto->id]) . '" class="btn btn-primary btn-sm tooltipsC"
                    aria-hidden="true" title="Editar este registro">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<form action="' . route('eliminar_contacto', ['id' => $contacto->id]) . '" class="d-inline form-eliminar"
                method="POST">'
                        . csrf_field() . method_field("delete") . '
                <button type="submit" class="btn btn-danger btn-sm tooltipsC" aria-hidden="true"
                  title="Eliminar este registro"><i class="fa fa-trash"></i>
                </button>
              </form>';
                    return $button;
                })
                ->addColumn('estado', function ($contacto) {
                    if ($contacto->estado == 1) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-danger btn-flat margin disabled"><i class="fa fa-exclamation-triangle"></i>
                        Por Contactar</button></div>';
                    } if ($contacto->estado == 2) {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-success btn-flat margin disabled"><i class="fa fa-check"></i>
                        Contactado</button></div>';
                    }else {
                        return '<div class="d-flex justify-content-center"><button type="button" class="btn bg-warning btn-flat margin disabled" style="text-align:center;display:block"><i class="fa fa-contactos"></i>
                            Inactivo</button></div>';
                    }
                })
                
                ->rawColumns(['action', 'estado'])
                ->make(true);
        }
        return view('modules.Contacto.view');
    }

    /**
     * @param int $contacto_id
     * @return JsonResponse
     */
    public function getContacto(int $contacto_id): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Contacto::findOrFail($contacto_id),
                'message'   => __('messages.generico.datasuccess')
            ]);

        } catch (Exception $exception){

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);

        }
    }

    public function replyContacto(Request $request): JsonResponse
    {
        $contacto = Contacto::find($request->id);
   
        $contacto->estado = 2;
        $contacto->usuario_creado_id = Auth::user()->id;
        $contacto->usuario_modificado_id = Auth::user()->id;


            $remitente = 'jefe_com_fbm@cofadena.gob.bo';
            $destino = $contacto->email;
            $data = ['nombre' => $contacto->nombre, 'mensaje' => $request->msg];
            Mail::send('modules.PlantillaCorreo.respuestaContacto', $data, function ($mess) use ($destino, $remitente) {
                $mess->from($remitente, 'FBM - COFADENA');
                $mess->to($destino)->subject('Respuesta Información - FBM');
            });

    //   dump($contacto);
        $contacto->save();

        return response()->json([
            'mensaje' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.contacto')])
        ]);
    }

}
