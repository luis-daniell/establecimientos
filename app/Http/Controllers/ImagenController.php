<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {

        //Leer la imagen
        $ruta_imagen = $request->file('file')->store('establecimientos', 'public');

        //Resize a la Imagen
        $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 450);
        $imagen->save();

        //Almacenar con Modelo
        $imagenDB = new Imagen;
        $imagenDB->id_establecimiento = $request['uuid'];

        $imagenDB->$ruta_imagen = $ruta_imagen;

        $imagenDB->save();


        //Retornar respuesta
        $respuesta = [
            'archivo' => $ruta_imagen
        ];

        return response()->json($respuesta);

    }

}