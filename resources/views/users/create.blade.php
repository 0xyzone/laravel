<x-layout titlename="Create User">
    <div class="flex flex-col w-full h-full items-center gap-4">
        <x-clipboard clipTag='Create a user (Staff)'>
            <form action="{{ route('register') }}" method="post" class="w-10/12 lg:w-8/12 flex flex-col gap-2">
                @csrf
                {{-- name Start --}}
                <div class="flex flex-col gap-2 mt-5">
                    <label for="name" class="text-white text-2xl">Full Name</label>
                    <input type="text" name="name" id="name" class="rounded-lg" value="{{ old('name') }}"
                        placeholder="Staff's full name.">
                    @error('name')
                        <div>
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- name End --}}

                {{-- Username Start --}}
                <div class="flex flex-col gap-2">
                    <label for="username" class="text-white text-2xl">Username</label>
                    <input type="text" name="username" id="username" class="rounded-lg" value="{{ old('username') }}"
                        placeholder="Staff's username.">
                    @error('username')
                        <div>
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Username End --}}

                {{-- Email Start --}}
                <div class="flex flex-col gap-2">
                    <label for="email" class="text-white text-2xl">Email</label>
                    <input type="email" name="email" id="email" class="rounded-lg" value="{{ old('email') }}"
                        placeholder="Staff's username.">
                    @error('email')
                        <div>
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Email End --}}

                {{-- Password Start --}}
                <div class="flex flex-col gap-2">
                    <label for="password" class="text-white text-2xl">Password</label>
                    <input type="password" name="password" id="password" class="rounded-lg peer" value="{{ old('password') }}"
                        placeholder="********" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
                        <div class="peer-invalid:block hidden">
                            <p class="text-sm text-gray-800">Please use minimum eight characters, at least one letter, one number and one special character.</p>
                        </div>
                    @error('password')
                        <div>
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Password End --}}
                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-800 rounded-lg w-max text-white">Register</button>
            </form>
        </x-clipboard>
    </div>
</x-layout>