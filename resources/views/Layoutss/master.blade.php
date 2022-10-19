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
        <div class="flex px-2 sm:px-4 transition duration-1000 ease-in-out py-2.5">
            <div class="" id = "side">
                @include('Layoutss.sidebar')
            </div>
            <div class="w-4/7 transition duration-1000 ease-in-out" id = "content">
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
        sidebar.addEventListener('click',(e)=>{
            toggle = !toggle;

            if(toggle){
                side.style.width = sideorg;
                side.style.transform = "translate(0px)"
                side.classList.add('w-3/7')
            }
            else{
                side.style.transform = "translate(-200px)"
                side.style.width = '0px';
                content.style.width = '100%';

            }
        })
    </script>

</body>

</html>
