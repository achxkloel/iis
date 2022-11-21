<html>
    <head>
        <title>WIS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet">
    </head>
    <body class="{{ ($title ?? null) ? 'body-top-margin' : '' }}">
        @if($title ?? null)
            <div class="title">
                {{ $title }}
            </div>
        @endif
        <x-sidebar />
        {{ $slot }}
    </body>
</html>
