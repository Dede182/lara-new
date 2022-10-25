<div class="flex flex-col py-2 pr-4  space-y-8 ">
   <div class="">
        <a href ="{{route('contact.create')}}">
            <button class="px-4 pr-6 py-2 gap-x-2 flex hover:opacity-75 items-center bg-white shadow-lg rounded-3xl justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>

                <p class="text-sm font-normal ">Create contact</p>
            </button>
        </a>
    </div>

    <div class="flex">
        <div class="w-full">
            <ul class="">

                <li class="flex gap-x-3 w-full {{ request()->routeIs('contact.index') ? 'bg-blue-500': '' }}  px-3 py-2 rounded-lg hoveron justify-between mb-8 cursor-pointer">
                    <a href = "{{route('contact.index')}}"  class="flex gap-x-3 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                          </svg>
                        <p class="font-bold">Contact</p>

                    </a>
                    <p class="font-medium font-mono">  {{ Auth::user()->contacts()->count() }}</p>
                </li>
                <li class="flex gap-x-3 w-full justify-between  mb-8 cursor-pointer">
                    <a href = "{{route('contact.export')}}" class="flex gap-x-3  px-3 py-2 rounded-lg hoveron ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                          </svg>

                        <p class="font-bold">Export</p>
                    </a>
                    <form action="{{ route('contact.import') }}" id = "import" method="POST" enctype="multipart/form-data">
                      @csrf
                  </form>
                    <div class="flex gap-x-3 px-3 py-2 rounded-lg hoveron">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                          </svg>
                        <input type="file" id="importBox" name="importFile" class="hidden" form="import"
                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />

                        <p class="font-bold" id ="im">Import</p>
                    </div>

                </li>
            </ul>
        </div>
    </div>
</div>

@push('script')
    <script>
        const importBox = document.getElementById('importBox');
        const im =document.getElementById('im');
        const importForm = document.getElementById('import')
        console.log('here')
        im.addEventListener('click',()=>{
            importBox.click();
            importBox.addEventListener('change',()=>{
                importForm.submit();
            })
        })
    </script>
@endpush
