@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection


@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8-12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}"
                    alt="usuario">
            </div>
            <div class="w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                <div class="flex items-center grap-2">

                    <p class="text-gray-700 text-2xl">
                        {{ $user->username }}
                    </p>

                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a class="text-gray-500 hover:text-gray-600 cursor-pointer" href="{{ route('perfil.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-700 text-sm mb-3 font-bold mt-5">
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count())</span>
                </p>

                <p class="text-gray-700 text-sm mb-3 font-bold">
                    {{ $user->followings->count() }}
                    <span class="font-normal">Siguiendo</span>
                </p>

                <p class="text-gray-700 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                @auth
                    @if ($user->id !== auth()->user()->id)
                        @if (!$user->siguiendo(auth()->user()))
                            <form action="{{ route('users.follow', $user) }}" method="post"> @csrf
                                <input type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py1 text-xs font-bold cursor-pointer"
                                    value="Seguir">
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py1 text-xs font-bold cursor-pointer"
                                    value="Dejar de Seguir">
                            </form>
                        @endif
                    @endif


                @endauth

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        <x-listar-post :posts="$posts" />
    </section>
@endsection
