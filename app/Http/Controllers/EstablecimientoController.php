<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;

class EstablecimientoController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Consultar las Categorias

        $categorias = Categoria::all();
        return view('establecimientos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Establecimiento $establecimiento)
    {
        //
        return "Desde Edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}