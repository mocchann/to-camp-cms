<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @if(file_exists('./hot') || file_exists('./build/manifest.json'))
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.tsx'])
    @endif
</head>

<body>
    <div id="root" @if(View::hasSection('data-attributes')) @yield('data-attributes') @endif></div>
</body>

</html>
