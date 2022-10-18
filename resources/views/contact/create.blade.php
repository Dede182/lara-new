@extends('Layoutss.master')
@section('content')
    <div class="relative">
        {{-- <div class="fixed-top bg-white h-[300px]">

        </div> --}}
        <div class="">

            <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                       <x-input type="text" name="firstName" label="First Name" />
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <x-input type="text" name="secondName" label="Second Name" />
                    </div>
                </div>


                <div class="relative z-0 mb-6 w-full group">
                    <x-input type="email" name="email" label="Email Address" />
                </div>


                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <x-input type="tel" name="phone" label="Phone
                            number (123-456-7890)" />


                    </div>

                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <x-input type="file" name="contactPhoto" label="Photo" />
                    </div>

                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>

        </div>
    </div>
@endsection
