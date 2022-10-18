<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <div class=" h-[100vh]">
        <div class="">
            @include('Navbar.navbar')
        </div>
        <div class="flex px-2 sm:px-4  py-2.5">
            <div class="w-1/4">
                @include('Layoutss.sidebar')
            </div>
            <div class="w-3/4">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
