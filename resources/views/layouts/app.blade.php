<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Devstagram - @yield('titulo')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body class="bg-gray-2100">
    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black">Devstagram</h1>
            @auth
                <nav class="flex grap-2 items-center">
                    <a class="font-bold text-gray-600 text-sm mr-4" href="">
                        Hola <span class="font-normal">
                            {{ auth()->user()->username }}
                        </span>
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                            Cerrar sesión
                        </button>
                    </form>
                </nav>
            @endauth

            @guest
                <nav class="flex grap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm mr-4" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register.index') }}">
                        Crear cuenta
                    </a>
                </nav>
            @endguest



        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
        @yield('contenido')
    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        &copy; Devstagram - Todos los derechos reservados
        {{ date('Y') }}
    </footer>

</body>

</html>
