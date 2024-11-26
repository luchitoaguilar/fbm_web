<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Http\Requests\TipoDocumentoRequest;
use App\Models\Ciudad;
use App\Models\TipoProducto;

class CiudadController extends Controller
{
    public function listar(Request $request) {
        $item = new Ciudad();
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
