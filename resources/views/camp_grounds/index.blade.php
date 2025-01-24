<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top</title>
    @if(file_exists('./hot') || file_exists('./build/manifest.json'))
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/pages/top/index.tsx'])
    @endif
</head>

<body>
    <div id="top"
        data-camp-grounds="{{ json_encode(
            array_map(
                fn($camp_ground) => [
                    'id'=> $camp_ground->id,
                    'name' => $camp_ground->name,
                    'address' => $camp_ground->address,
                    'price' => $camp_ground->price,
                    'image' => $camp_ground->image,
                    'status' => $camp_ground->status,
                    'location' => $camp_ground->location,
                    'elevation' => $camp_ground->elevation,
                ],
                $camp_grounds
            ),
        ) }}">
    </div>
</body>

</html>
