@extends('Layoutss.master')
@section('content')
    <div class="relative">
        {{-- <div class="fixed-top bg-white h-[300px]">

        </div> --}}
        <div class=" px-10">
            <div class=" mb-6 w-full">
                <input type="file" form ="create" name ="contactPhoto" class = "hidden" id="contactPhoto"/>
                <img id = "uploadUi" src="https://cdn-icons-png.flaticon.com/512/892/892781.png?w=360" class="w-[200px] h-[200px] object-cover  rounded-[50%] border-2" alt="">
            </div>
            <form action="{{ route('contact.store') }} " id = "create" method="POST" class="w-full" enctype="multipart/form-data">
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


                <div class="grid  md:gap-6">
                    <div class="relative z-0 mb-6 w-full group">
                        <x-input type="tel" name="phone" label="Phone
                            number (123-456-7890)" />


                    </div>

                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>

        </div>
    </div>
@endsection

@push('script')

<script>
    const uploadUi = document.getElementById('uploadUi');
    const upload = document.getElementById('contactPhoto');
    // console.log(upload)
    uploadUi.addEventListener('click',_=>{
        upload.click();
        upload.addEventListener('change',(e)=>{
            const readFile = e.target.files[0];
            // console.log(readFile);
            const reader = new FileReader();
            reader.addEventListener('load',(e)=>{
                console.log(e.target.result);
                uploadUi.src = e.target.result;


            })
            reader.readAsDataURL(readFile)

        })
    })
</script>

@endpush
