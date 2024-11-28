<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Zafra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleriaController extends Controller
{
    public function view() {
        $foto = Foto::where('estado', 1)
        ->orderBy('id', 'desc')
            ->get();

        return view('modules.Galeria.galeria', compact('foto'));
    }

}
