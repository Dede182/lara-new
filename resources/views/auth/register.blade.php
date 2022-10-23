<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <div class=" mb-6 w-full">
                    <input type="file" name ="userPhoto" class = "hidden" id="userPhoto"/>
                    <img id = "userProfile" src="https://cdn-icons-png.flaticon.com/512/892/892781.png?w=360" class="w-[150px] h-[150px] cursor-pointer object-cover  rounded-[50%] border-2" alt="">
                </div>
            </div>
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
    @push('script')

    <script>
        const uploadUi = document.getElementById('userProfile');
        const upload = document.getElementById('userPhoto');
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
</x-guest-layout>

