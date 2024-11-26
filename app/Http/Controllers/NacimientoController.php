<?php

namespace App\Http\Controllers;

use App\Models\Nacimiento;
use Illuminate\Http\Request;

class NacimientoController extends Controller
{
    public function getNacimiento(Request $request)
    {
        $nacimiento = Nacimiento::where('estado', 1);

        $data = array(
            'success' => true,
            'data' => $nacimiento
        );

        return response()->json($data);
    }
}
