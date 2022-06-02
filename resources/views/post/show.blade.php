@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection


@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="p-3">
                <p>0 Likes</p>
            </div>
            <div class="">
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Agrega un comentario
                    </p>
                    @if (session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold" >
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <form action="{{ route('comment.store', ['user' => $user, 'post' => $post]) }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Agrega un comentario
                            </label>
                            <textarea name="comment" id="comentario" placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg @error('descripción') border-red-500 @enderror">{{ old('comentario') }}</textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg p-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursos-pointer font-bold w-full p-3 text-white rounded-lg"
                            value="Comentar">
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96">
                    {{-- {{ dd($post->comments) }} --}}
                    @if ($post->comments->count() > 0)
                        <p class="text-xl font-bold text-center mt-5 mb-4">
                            Comentarios
                        </p>
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('post.index', $comment->user) }}" class="mb-2 block text-gray-500 font-bold">
                                    {{ $comment->user->username }}
                                </a>
                                <p>{{ $comment->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach

                    @else
                        <p class="p-10 text-center">
                            No hay comentarios aún
                        </p>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
