@extends('Layoutss.master')
@section('content')
    <div class="space-y-10  h-[100vh] px-6 py-2">

        @forelse ($sender as $user)
            <div id="toast-notification"
                class="p-4 w-full  shadow-lg text-gray-900 bg-white rounded-lg dark:bg-gray-800 dark:text-gray-300"
                role="alert" bis_skin_checked="1">
                <div class="flex items-center" bis_skin_checked="1">
                    <div class="inline-block relative shrink-0" bis_skin_checked="1">
                        @if ($user->contactPhoto)
                            <img class="w-12 h-12 mr-3 rounded-full border-2 border-black"
                                src="{{ asset('storage/' . $user->folder . '/' . $user->contactPhoto) }}" alt="Rounded avatar">
                        @else
                            <img class="w-12 h-12 mr-3 rounded-full"
                                src="https://cdn-icons-png.flaticon.com/512/892/892781.png?w=360" alt="Rounded avatar">
                        @endif
                        <span
                            class="inline-flex absolute right-0 bottom-0 justify-center items-center w-6 h-6 bg-blue-600 rounded-full">
                            <svg aria-hidden="true" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Message icon</span>
                        </span>
                    </div>
                    <div class="ml-3 text-sm font-normal" bis_skin_checked="1">
                        <div class="text-sm font-semibold text-gray-900 dark:text-white" bis_skin_checked="1">
                            {{ $user->name }}</div>
                        <div class="text-sm font-normal" bis_skin_checked="1">Sends {{ count($user->senders) }} contacts
                        </div>
                    </div>
                </div>

                <?php
                $sender = $user->senders;

                $senderRequest = [];
                foreach ($sender as $key => $ss) {
                    $senderRequest[$key] = $ss->sends;
                }
                $senderRequest = Arr::collapse($senderRequest);

                $last = [];
                $send = [];

                foreach ($senderRequest as $key => $l) {
                    $last[$key] = json_decode($l->message);
                    $sends[$key] = $l->created_at->diffForHumans();
                }
                ?>

                <div class="mt-8 flex items-center gap-x-5 flex-wrap gap-y-4">
                    @forelse ($last as $key=>$noti)
                        <div id="toast-interactive"
                            class="p-4 w-full flex items-center justify-between  text-gray-500 bg-slate-50 rounded-lg shadow-lg  dark:text-gray-400"
                            role="alert" bis_skin_checked="1">
                            <div class="flex" bis_skin_checked="1">
                                <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-blue-dark:text-blue-300"
                                    bis_skin_checked="1">
                                    @if ($noti->contactPhoto)
                                        <img src="{{ asset('storage/' . $noti->folder . '/' . $noti->contactPhoto) }}"
                                            class="w-7 h-7 object-cover rounded-[100%]" alt="p" />
                                    @else
                                        <p class=" !m-0 h-7 w-7 flex items-center justify-center text-xs rounded-[100%]"
                                            style="background:{{ $noti->color }}">
                                            {{ Str::substr($noti->fullName, 0, 1) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="ml-3 text-sm font-normal" bis_skin_checked="1">
                                    <p class="mb-1 text-sm flex font-semibold text-gray-900 dark:text-white">
                                        {{ $noti->fullName }}&nbsp;
                                        <span class="text-[11px] text-neutral-400">
                                            &bull; {{ $sends[$key] }}
                                        </span>
                                    </p>
                                    <div class="mb-2 text-sm font-normal" bis_skin_checked="1">{{ $noti->phone }}</div>

                                </div>
                            </div>
                            <div class="">
                                <div class="grid grid-cols-2 gap-2" bis_skin_checked="1">
                                    <div bis_skin_checked="1">
                                        <a href="{{ route('noti.accept',[$senderRequest[$key]->id , $noti->id]) }}"
                                            class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                            Accept
                                        </a>
                                    </div>
                                    <div bis_skin_checked="1">
                                        <a href="{{ route('noti.reject',[$senderRequest[$key]->id]) }}"
                                            class="inline-flex justify-center w-full px-2 py-1.5 text-xs font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">
                                            Reject
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>



                    @empty
                        <p>no</p>
                    @endforelse
                </div>

            </div>
        @empty
        @endforelse
    </div>
    </div>
@endsection
