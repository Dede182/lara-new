@extends('Layoutss.master')
@section('content')
    <div class="relative">
        {{-- <div class="fixed-top bg-white h-[300px]">

        </div> --}}
        <div class="">
            <div class=" mb-6 w-full">
                <input type="file" form ="edit" name ="contactPhoto" class = "hidden" id="contactPhoto"/>
                <img id = "uploadUi" src="https://cdn-icons-png.flaticon.com/512/892/892781.png?w=360" class="w-[200px] h-[200px] object-cover  rounded-[50%] border-2" alt="">
            </div>
            <form action="{{route('contact.update',$contact->id)}}" id = "edit" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="firstName" id="firstName"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value ="{{$contact->firstName}}">
                        <label for="firstName"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
                            name</label>
                        @error('firstName')
                            <div class="text-sm text-red-600">&bull; {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="secondName" id="secondName"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value ="{{$contact->secondName}}">
                        <label for="secondName"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
                            name</label>
                            @error('secondName')
                            <div class="text-sm text-red-600">&bull; {{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="relative z-0 mb-6 w-full group">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value ="{{$contact->email}}">
                    <label for="email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                        address</label>
                        @error('email')
                        <div class="text-sm text-red-600">&bull; {{ $message }}</div>
                    @enderror
                </div>


                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="tel" name="phone" id="phone"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value ="{{$contact->phone}}">
                        <label for="phone"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone
                            number (123-456-7890)</label>
                            @error('phone')
                            <div class="text-sm text-red-600">&bull; {{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </form>

        </div>
    </div>
@endsection
@push('script')
    <script>
         const uploadUi = document.getElementById('uploadUi');
        const upload = document.getElementById('contactPhoto');
        // console.log(upload)
        uploadUi.addEventListener('click', _ => {
            upload.click();
            upload.addEventListener('change', (e) => {
                const readFile = e.target.files[0];
                // console.log(readFile);
                const reader = new FileReader();
                reader.addEventListener('load', (e) => {
                    console.log(e.target.result);
                    uploadUi.src = e.target.result;


                })
                reader.readAsDataURL(readFile)

            })
        })
    </script>
@endpush
