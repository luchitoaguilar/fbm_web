<?php

namespace App\Http\Controllers;

use App\Models\Variables;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VariablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.Administrador.Variables.view');
    }

    /**
     * @param int $noticia_id
     * @return JsonResponse
     */
    public function getZafra(Request $request): JsonResponse
    {
        try {
            return response()->json([
                'data'      => Variables::orderBy('id', 'desc')->first(),
                'message'   => __('messages.generico.datasuccess')
            ]);
        } catch (Exception $exception) {

            return response()->json([
                'message'   => $exception->getMessage()
            ], 422);
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {

        $zafra = new Variables($request->all());

        $zafra->precio_pago_zafrero = $request->precio_pago_zafrero;
        $zafra->gerente_cofadena = $request->gerente_cofadena;
        $zafra->cargo_gerente_cofadena = $request->cargo_gerente_cofadena;
        $zafra->gerente_upab = $request->gerente_upab;
        $zafra->cargo_gerente_upab = $request->cargo_gerente_upab;
        $zafra->jefe_prod_upab = $request->jefe_prod_upab;
        $zafra->cargo_jefe_prod_upab = $request->cargo_jefe_prod_upab;
        $zafra->aux_prod_upab = $request->aux_prod_upab;
        $zafra->cargo_aux_prod_upab = $request->cargo_aux_prod_upab;
        $zafra->gestion = date('Y');
        $zafra->usuario_creado_id = Auth::user()->id;
        $zafra->usuario_modificado_id = Auth::user()->id;

        $zafra->save();

        return response()->json([
            'message' => __('messages.acciones.guardaritem', ['item' => __('validation.attributes.banner')])
        ]);

        // return redirect()->route('listar_banner')->with('mensaje', 'creado exitosamente');
    }
}
