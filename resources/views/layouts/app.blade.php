<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'myDrive') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        li .dir {
            /* 🗁 🗋 🗀 📁 📂 */
        }

        li .file {
            /* 🗋 */
        }

        ul {
            list-style-type: none;
        }

        ul>ul {
            /* visibility: hidden; */
        }
    </style>
</head>

<body>
    <header>
        @include('partials.navigation')
    </header>
    <main class='container'>
        {{-- DANGER AREA --}}
        @session('danger')
            <div class='alert alert-danger fade show'> {{ $value }}</div>
        @endsession
        {{-- INFO AREA --}}
        @session('info')
            <div class='alert alert-info fade show'> {{ $value }}</div>
        @endsession
        {{ $slot }}
    </main>
    <footer>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
