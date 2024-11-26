<?php

namespace App\Http\Controllers;

use App\Models\Zafra;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zafra = Zafra::where('estado', 1)
            ->sum('peso_neto');
        //        dd($noticia);
        return view('layouts.template', compact('zafra'));
    }
}
