<html>
    <head>
        <title>WIS</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
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

        <!-- Add jQuery -->
        <script
	        src="https://code.jquery.com/jquery-3.6.1.min.js"
		    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
		    crossorigin="anonymous">
        </script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        

        <!-- Custom js scripts -->
        {{ $js ?? '' }}
    </body>
</html>
