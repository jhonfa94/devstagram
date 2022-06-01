<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        // $input = $request->all();
        $imagen = $request->file('file'); # RECIBIMOS EL ARCHIVO

        $nombreImagen = Str::uuid() . "." . $imagen->extension(); # GENERAMOS UN NOMBRE UNICO CON LA EXTENSIÓN DEL ARCHIVO

        $imagenServidor = Image::make($imagen); # PREPARAMOS LA IMAGEN CON EL PAQUETE DE IMAGE INTERVENTION
        $imagenServidor->fit(1000, 1000); # CORTAMOS LA IMAGEN

        //Debe estar la carpeta creada en public para que se pueda guardar la imagen
        $imagenPath = public_path('uploads') . '/' . $nombreImagen; # GENERAMOS EL PATH DE LA IMAGEN
        $imagenServidor->save($imagenPath);




        return response()->json(['imagen' => $nombreImagen]);
    }
}
