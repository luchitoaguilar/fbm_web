<?php

namespace App\Http\Controllers;

use App\Models\Expedido;
use Illuminate\Http\Request;

class ExpedidoController extends Controller
{
    public function listar(Request $request) {
        $item = new Expedido();
        $objeto = null;

        $objeto = $item->orderBy('departamento', 'asc')->get();

        $data = array(
            'success' => true,
            'data' => $objeto,
            'msg' => trans('messages.listed')
        );

        return response()->json($data);
    }
}
