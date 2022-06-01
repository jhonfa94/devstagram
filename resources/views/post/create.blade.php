@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('titulo')
    Crea una nueva Publicación
@endsection


@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="post" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10 bg-white  rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('post.store') }}" method="post">
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Título
                    </label>
                    <input type="text" name="titulo" id="titulo" placeholder="Título de la publicación"
                        class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror"
                        value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción de la publicación"
                        class="border p-3 w-full rounded-lg @error('descripción') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen" id="imagen" value="{{ old('imagen') }}">
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursos-pointer font-bold w-full p-3 text-white rounded-lg"
                    value="Publicar">
            </form>
        </div>
    </div>
@endsection
