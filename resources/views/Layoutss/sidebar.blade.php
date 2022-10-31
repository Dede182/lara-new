<div class="flex transition flex-col py-2 pr-4  space-y-8 ">
    <div class="flex justify-between items-center">
        <button class="">
            <a href="{{ route('contact.create') }}"
                class="px-4 pr-6 py-2  flex hover:brightness-95 items-center bg-white shadow-lg rounded-3xl justify-center">
                <lottie-player class="mx-auto w-12 h-10" src="{{ asset('plus.json') }}"  background="transparent"  speed="1"   autoplay></lottie-player>
                <p class="text-md font-semibold ">Create contact</p>
            </a>
        </button>
        <div class="flex gap-x-4 items-center">
            <a href = "{{ route('noti') }}" class="mr-3 relative cursor-pointer hover:scale-110 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                  </svg>
                <div class="absolute -top-3 left-3 bg-red-600 text-white  px-2 py-1 text-xs rounded-full">
                    {{ Auth::user()->receivers()->count() }}
                </div>
            </a>

                <button id="dropdownDefault" data-dropdown-toggle="addition" class="text-black hidden"
            type="button"> <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></button>

        <!-- Dropdown menu -->
            <div id="addition"
                class="hidden z-20 w-20 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 688px);"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">

                <ul class="py-1 text-sm text-gray-500 dark:text-gray-800 divide-y-2"
                    aria-labelledby="dropdownDefault">
                    <li class="py-1 hover:text-black font-bold transition-all">
                        <button id="submit"
                        class="text-center w-full ">
                        Delete
                    </button>
                    </li>
                    <li class="py-1 hover:text-black font-bold transition-all">
                        <button id="bulkDupli"
                        class="text-center w-full ">
                        Duplicate
                        </button>

                    </li>
                    <li class="py-1 hover:text-black font-bold transition-all">
                        <button id="sendContacts"
                        class="text-center w-full ">
                        Send
                        </button>

                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="flex">
        <div class="w-full">
            <ul class="">

                <li
                    class="flex gap-x-3 w-full {{ request()->routeIs('contact.index') ? 'bg-blue-500' : '' }}  px-3 py-2 rounded-lg hoveron justify-between mb-8 cursor-pointer">
                    <a href="{{ route('contact.index') }}" class="flex gap-x-3 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <p class="font-bold">Contact</p>

                    </a>
                    <p class="font-medium font-mono"> {{ Auth::user()->contacts()->count() }}</p>
                </li>
                <li class="flex gap-x-3 w-full justify-between  mb-8 cursor-pointer">
                    <a href="{{ route('contact.export') }}" class="flex gap-x-3  px-3 py-2 rounded-lg hoveron ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>

                        <p class="font-bold">Export</p>
                    </a>
                    <form action="{{ route('contact.import') }}" id="import" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                    </form>
                    <div class="flex gap-x-3 px-3 py-2 rounded-lg hoveron">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <input type="file" id="importBox" name="importFile" class="hidden" form="import"
                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />

                        <p class="font-bold" id="im">Import</p>
                    </div>

                </li>
            </ul>
        </div>
    </div>
</div>

@push('script')
    <script>
        const importBox = document.getElementById('importBox');
        const im = document.getElementById('im');
        const importForm = document.getElementById('import')
        console.log('here')
        im.addEventListener('click', () => {
            importBox.click();
            importBox.addEventListener('change', () => {
                importForm.submit();
            })
        })
    </script>
@endpush
