<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\File;
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

        $imagenDB->ruta_imagen = $ruta_imagen;
        $imagenDB->save();


        //Retornar respuesta
        $respuesta = [
            'archivo' => $ruta_imagen
        ];

        return response()->json($respuesta);

    }


    //Elimina una imagen de la BD y del servidor
    public function destroy( Request $request)
    {

        $imagen = $request->get('imagen');

        if(File::exists('storage/' . $imagen)){
            File::delete('storage/' . $imagen);
        }

        $respuesta = [
            'mensaje' => 'Imagen Eliminada',
            'imagen' => $imagen
        ];

        // Imagen::where('ruta_imagen', '=', $imagen)->delete();
        $imagenEliminar = Imagen::where('ruta_imagen', '=', $imagen)->firstOrFail();
        Imagen::destroy($imagenEliminar->id);



        return response()->json($respuesta);

    }








}