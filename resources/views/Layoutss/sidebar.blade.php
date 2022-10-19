<div class="flex flex-col py-2 px-4  space-y-8 ">
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
            <ul>

                <li class="flex gap-x-3 w-full justify-between">
                    <a href = "{{route('contact.index')}}" class="flex gap-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                          </svg>
                        <p class="font-bold">Contact</p>

                    </a>
                    <p class="font-medium font-mono">  {{ $contactCount->count() }}</p>
                </li>
            </ul>
        </div>
    </div>
</div>
