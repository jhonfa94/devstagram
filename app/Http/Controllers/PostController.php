<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(User $user)
    {
        // $posts = Post::where('user_id', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        return view('dashboard', compact('user', 'posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:1000',
            'imagen' => 'required',
        ]);

        Post::create([
            'titulo' =>  $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        # OTRA FORMA DE GUARDAR EL REGISTRO
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        # OTRA FORMA
        // $request->user()->post()->create([
        //     'titulo' =>  $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);


        return redirect()->route('post.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('post.show', compact('post', 'user'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        //Eliminar la imagen
        $imagen_path = public_path('uploads/') . $post->imagen;
        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }
        // if (file_exists($imagen_path)) {
        //     unlink($imagen_path);
        // }
        return redirect()->route('post.index', auth()->user()->username)->with('mensaje', 'Post eliminado correctamente');
    }
}
