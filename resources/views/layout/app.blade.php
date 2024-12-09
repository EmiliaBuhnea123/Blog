<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
<body class="font-sans m-0 p-0 bg-stone-100">

    <x-header />
    <div>
        @yield('content')
    </div>

   {{-- <div class="container max-w-4xl mx-auto my-5 p-5 bg-white rounded-lg shadow-lg"></div> --}}

</body>
</html>

