<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="">
        <div class="">
            @include('Navbar.navbar')
        </div>
        <div class="flex px-2 sm:px-4  py-2.5">
            <div class="w-1/6">
                @include('Layoutss.sidebar')
            </div>
            <div class="w-5/6">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            @if (session('status'))
                showToast("{{ session('status') }}")
            @endif
        });
    </script>
</body>

</html>
