@extends('Layoutss.master')
@section('content')
    <div class="relative">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">

                <tr>
                    <th scope="col" class="py-3 px-6">
                        Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Email
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Phone number
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Job title & company
                    </th>
                    <th scope="col" class="py-3 px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)

                    <tr  class="bg-white border-b group relative ">

                        <th scope="row" class="py-4 px-6 gap-x-2 font-medium flex group-hover:bg-slate-200 text-gray-900 whitespace-nowrap">
                            @if($contact->contactPhoto)
                            <img src = "{{ asset('storage/'.$contact->firstName.'/'.$contact->contactPhoto) }}"
                            class="w-7 h-7  rounded-[100%]"
                            alt ="contactPhoto"
                            />
                            @else
                            <p class=" !m-0 h-7 w-7 flex items-center justify-center text-xs rounded-[100%]" style="background:{{ $contact->color }}">
                                {{ Str::substr($contact->fullName, 0, 1) }}
                            </p>
                            @endif


                            {{ $contact->fullName }}
                        </th>
                        <td class="py-4 px-6 group-hover:bg-slate-200">
                            {{ $contact->email }}
                        </td>
                        <td class="py-4 px-6 group-hover:bg-slate-200">
                            {{ $contact->phone }}
                        </td>
                        <td class="py-4 px-6 group-hover:bg-slate-200">

                        </td>
                        <td class="py-4 px-6 group-hover:bg-slate-200 z-3">
                            <div class="flex items-center gap-x-3">
                                <a href="{{ route('contact.edit', $contact->id) }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>

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
                                        <li>
                                            <a href="{{ route('contact.show',$contact->id) }}"
                                                class="flex p-2 gap-x-3 hover:bg-gray-100 d ark:hover:bg-gray-600 dark:hover:text-white">
                                                @csrf
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                                  </svg>
                                                  <button>Info</button>
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                            </div>

                        </td>
                    </tr>

                @empty
                @endforelse


            </tbody>
        </table>
        <div class="mt-14"></div>
        {{ $contacts->onEachSide(5)->links() }}
    </div>
@endsection
