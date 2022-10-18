@extends('Layoutss.master')
@section('content')
    <div class="px-7 pr-32 py-2 border-b-2 pb-12">
        <div class="grid grid-cols-4 gap-0">
            <div class="md:pl-8">
                @if($contact->contactPhoto)
                <img
                 class="w-40 h-40 object-cover rounded-[100%]"
                 src = "{{ asset('storage/'.$contact->folder.'/'.$contact->contactPhoto) }}"/>
                 @else
                 <p class=" !m-0 w-40 h-40  flex items-center justify-center text-6xl rounded-[100%]" style="background:{{ $contact->color }}">
                    {{ Str::substr($contact->fullName, 0, 1) }}
                </p>
                 @endif
            </div>
            <div class="col-span-2 flex items-center">
                <p class="text-2xl">{{ Str::ucfirst($contact->fullName ) }}</p>

            </div>
            <div class="flex items-end justify-end">
                <div class="flex gap-x-6">
                    <button id="dropdownDefault" data-dropdown-toggle="{{ $contact->id }}"
                        class="text-black "
                        type="button"> <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>

                    <!-- Dropdown menu -->
                    <div id="{{ $contact->id }}"
                        class="hidden z-20 w-40 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 688px);"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom">

                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefault">
                            <li>

                                <form action="{{ route('contact.destroy',$contact->id) }}" method="POST"
                                    class="flex p-2 gap-x-3 hover:bg-gray-100 d ark:hover:bg-gray-600 dark:hover:text-white">
                                    @csrf
                                    @method('delete')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                      </svg>


                                      <button>Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="">
                        <button class="px-7 py-2 text-white bg-blue-600 rounded-md">
                            <a href = "{{ route('contact.edit',$contact->id) }}">
                                Edit
                            </a>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <div class="">

        </div>
    </div>

    <div class="mt-16 pl-12">
        <div class="border-2 w-96 px-4 py-3 rounded-lg">
            <div class="flex flex-col gap-y-4">
                <p class="font-semibold">Contact details</p>
                <div class="flex gap-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                      </svg>
                    <p class="text-blue-700 font-medium ">
                    @if ($contact->email)
                        {{ $contact->email }}
                    @else
                        Add email
                    @endif
                    </p>
                </div>
                <div class="flex gap-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                      </svg>
                      <p class="text-blue-700 font-medium ">
                            {{ $contact->phone }}
                      </p>
                </div>
            </div>
        </div>
    </div>
@endsection
