<nav class="bg-white border-gray-200 px-2 sm:px-4 py-1 w-full">
    <div class=" flex w-full justify-between items-center ">
        <div class="flex items-center gap-x-3 w-1/4">
            <svg xmlns="http://www.w3.org/2000/svg" id ="sidebar" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                stroke="currentColor" class="w-8 h-8 font-bold cursor-pointer">
                <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

            <a href="#" class="flex items-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Google_Contacts_icon.svg/1200px-Google_Contacts_icon.svg.png"
                    class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
                <span class="self-center text-xl font-semibold whitespace-nowrap ">Contact</span>
            </a>

        </div>
        <div class="flex justify-start">
            <lottie-player class="mx-auto" src="{{ asset('lf30_editor_m8de2fxi.json') }}"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop autoplay></lottie-player>
        </div>
        <div class="w-2/4  ">

            <form action="{{ route('contact.index') }}" method="GEt" class="mx-auto">
                @csrf
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                <div class="relative w-full" bis_skin_checked="1">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none" bis_skin_checked="1">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="search" name="search" id="default-search" value = "{{ request('search') }}" class="block p-4 pl-10 w-[100%] text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  " placeholder="Search " required="">
                </div>
            </form>

        </div>

        <div class="" id="navbar-default">
            <ul
                class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">

                <li>
                    <div class="">
                        <x-nav-link :href="route('contact.index')" :active="request()->routeIs('contact.index')">
                            {{ __('Home') }}
                        </x-nav-link>
                    </div>
                </li>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    @if(isset(Auth::user()->userPhoto))
                                    <img class="w-8 h-8 mr-3 rounded-full border-2 border-black" src="{{ asset('storage/'.Auth::user()->name.'/'.Auth::user()->userPhoto) }}" alt="Rounded avatar">

                                    @else
                                    <img class="w-8 h-8 mr-3 rounded-full" src="https://cdn-icons-png.flaticon.com/512/892/892781.png?w=360" alt="Rounded avatar">
                                    @endif

                                <div>{{Str::ucfirst(Auth::user()->name) }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
            </ul>
        </div>
    </div>
</nav>
