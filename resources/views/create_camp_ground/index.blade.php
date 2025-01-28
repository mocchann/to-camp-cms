<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top</title>
    @if(file_exists('./hot') || file_exists('./build/manifest.json'))
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/pages/create/index.tsx'])
    @endif
</head>

<body>
    <div id="create"></div>
</body>

</html>
