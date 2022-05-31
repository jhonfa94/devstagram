@extends('layouts.app')

@section('titulo')
    Inicia sesión en Devstagram
@endsection


@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-4/12 p-5 ">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>

        <div class="md:w-6/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                @if(session('mensaje'))
                    <p class="bg-red-600 text-white my-2 rounded-lg p-2">{{ session('mensaje') }}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="email" name="email" id="email" placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg p-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input type="password" name="password" id="password" placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                </div>

                <input type="submit"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursos-pointer font-bold w-full p-3 text-white rounded-lg"
                    value="Iniciar sesión">
            </form>

        </div>


    </div>
@endsection
