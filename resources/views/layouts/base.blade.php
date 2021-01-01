<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <title>@yield('title')</title>
    <!-- Tailwind UI -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <!-- Alpine -->
{{--    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>--}}
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/gif">
    @livewireStyles
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.2.3/dist/trix.css">--}}

</head>
<body class="antialiased font-sans bg-white">
    {{ $slot }}

    @livewireScripts
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://unpkg.com/moment"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>--}}
{{--    <script src="https://unpkg.com/trix@1.2.3/dist/trix.js"></script>--}}
</body>
</html>
