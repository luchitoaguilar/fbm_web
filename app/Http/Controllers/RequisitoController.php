<?php

namespace App\Http\Controllers;

use App\Models\Zafra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitoController extends Controller
{
    public function view() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');

        return view('modules.Requisitos.requisito', compact('zafra'));
    }

}
