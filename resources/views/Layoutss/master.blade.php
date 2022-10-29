<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="w-fit xl:w-full">
    <div class="w-full">
        <div class="">
            @include('Navbar.navbar')
        </div>
        <div class="flex px-2 sm:px-4  w-full ease-in-out py-2.5 relative">
            <div class="w-1/4  transition duration-500 origin-left " id="side">
                @include('Layoutss.sidebar')
            </div>
            <div class="w-3/4 origin-right ease-in-out" id="content">
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
        const side = document.getElementById('side');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content')
        const sideorg = side.style.width;
        const contentorg = content.style.width;
        let toggle = true;
        sidebar.addEventListener('click', (e) => {
            toggle = !toggle;
            if (toggle) {
                side.style.width = sideorg;
                side.style.transform = "translate(0px)"
                side.classList.remove('w-0')
                side.classList.add('w-1/4');
                content.style.width = "80%";
            } else {
                side.style.transform = "translate(-800px)"
                side.style.width = '0px';
                content.style.width = "100%";
            }
        })
    </script>
    @stack('script')
</body>

</html>
