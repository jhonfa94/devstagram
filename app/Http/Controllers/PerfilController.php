<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //Modificar request
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:twitter,editar-perfil,facebook,google,instagram'],
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            // 'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->imagen) {
            // $input = $request->all();

            $imagen = $request->file('imagen'); # RECIBIMOS EL ARCHIVO
            // dd($imagen);

            $nombreImagen = Str::uuid() . '.' . $imagen->extension(); # GENERAMOS UN NOMBRE UNICO CON LA EXTENSIÓN DEL ARCHIVO



            $imagenServidor = Image::make($imagen); # PREPARAMOS LA IMAGEN CON EL PAQUETE DE IMAGE INTERVENTION
            $imagenServidor->fit(1000, 1000); # CORTAMOS LA IMAGEN

            //Debe estar la carpeta creada en public para que se pueda guardar la imagen
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen; # GENERAMOS EL PATH DE LA IMAGEN
            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? $usuario->imagen ?? NULL;
        $usuario->email = $request->email;

        $usuario->save();

        //Redireccionar el usuario

        return redirect()->route('post.index', $usuario->username)->with('status', 'Perfil actualizado correctamente');
    }
}
