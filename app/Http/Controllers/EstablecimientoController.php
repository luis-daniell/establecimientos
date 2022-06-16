<?php

namespace App\Http\Controllers;

use auth;
use App\Imagen;
use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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


        $data = $request->validate([

            'nombre' => 'required',
            'categoria_id' => 'required|exists:App\Categoria,id',
            'imagen_principal' => 'required|image|max:1000',
            'direccion' => 'required',
            'colonia' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:50',
            'apertura' => 'date_format:H:i',
            'cierre' => 'date_format:H:i|after:apertura',
            'uuid' => 'required|uuid'

        ]);

        //Guardar Imagen
        $ruta_imagen = $request['imagen_principal']->store('principales', 'public');

        //Resize a la imagen
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(800, 600);
        $img->save();



        //PRIMER METODO
        //AGREGAR EN ESTABLECIMIENTO EN EL FILLABLE EL USUARIO_ID
        $establecimiento = new Establecimiento($data);
        $establecimiento->imagen_principal = $ruta_imagen;
        $establecimiento->user_id = auth()->user()->id;
        $establecimiento->save();


        return back()->with('estado', 'Tu información se almacenó correctamente');

        dd("Desde el store");

        //SEGUNDO METODO
        //Guardar en la base de datos
        // auth()->user()->establecimiento()->create([
        //     'nombre' => $data['nombre'],
        //     'categoria_id' => $data['categoria_id'],
        //     'imagen_principal' => $ruta_imagen,
        //     'direccion' => $data['direccion'],
        //     'colonia' => $data['colonia'],
        //     'lat' => $data['lat'],
        //     'lng' => $data['lng'],
        //     'telefono' => $data['telefono'],
        //     'descripcion' => $data['descripcion'],
        //     'apertura' => $data['apertura'],
        //     'cierre' => $data['cierre'],
        //     'uuid' => $data['uuid'],
        // ]);

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
        $categorias = Categoria::all();


        //Obtener el establecimiento
        $establecimiento = auth()->user()->establecimiento;


        //Cambia el formato de la apertura y cierre
        $establecimiento->apertura = date('H:i', strtotime($establecimiento->apertura));
        $establecimiento->cierre = date('H:i', strtotime($establecimiento->cierre));

        //Obtiene las imagenes del establecimiento
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();


        return view('establecimientos.edit', compact('categorias', 'establecimiento', 'imagenes'));
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establecimiento $establecimiento)
    {

        //Ejecutar el policy
        $this->authorize('update', $establecimiento);



        //Validacion
        $data = $request->validate([

            'nombre' => 'required',
            'categoria_id' => 'required|exists:App\Categoria,id',
            'imagen_principal' => 'image|max:1000',
            'direccion' => 'required',
            'colonia' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'telefono' => 'required|numeric',
            'descripcion' => 'required|min:50',
            'apertura' => 'date_format:H:i',
            'cierre' => 'date_format:H:i|after:apertura',
            'uuid' => 'required|uuid'

        ]);

        $establecimiento->nombre = $data['nombre'];
        $establecimiento->categoria_id = $data['categoria_id'];
        $establecimiento->direccion = $data['direccion'];
        $establecimiento->colonia = $data['colonia'];
        $establecimiento->lat = $data['lat'];
        $establecimiento->lng = $data['lng'];
        $establecimiento->telefono = $data['telefono'];
        $establecimiento->descripcion = $data['descripcion'];
        $establecimiento->apertura = $data['apertura'];
        $establecimiento->cierre = $data['cierre'];
        $establecimiento->uuid = $data['uuid'];



        //Si el usuario sube una imagen
       if (request('imagen_principal')) {
            //Guardar Imagen
            $ruta_imagen = $request['imagen_principal']->store('principales', 'public');

            //Resize a la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(800, 600);
            $img->save();

            $establecimiento->imagen_principal = $ruta_imagen;


       }

       $establecimiento->save();

       //Mensaje al usuario
       return back()->with('estado', 'Tu informacion se almacenó correctamente');


    }


    /**
     * Remove the specified resource from storage.
     *
     *
     * @param  \App\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establecimiento $establecimiento)
    {
        //
    }
}