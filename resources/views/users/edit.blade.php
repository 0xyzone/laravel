<x-dash :titlename=$titlename>
    <div class="flex justify-between w-full items-center px-5 mb-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-clipboard"></i> Edit User</h2>
        <a href="{{ url()->previous() }}" class="btn-primary fuss">Go back</a>
    </div>
    <form action="update" method="post" class="w-10/12 lg:w-full flex flex-col gap-2">
        @csrf
        {{-- name Start --}}
        <div class="flex flex-col gap-2 mt-5">
            <label for="name" class="text-2xl">Full Name</label>
            <input type="text" name="name" id="name" class="rounded-lg" value="{{ $id->name }}"
                placeholder="Staff's full name.">
            @error('name')
                <div>
                    <p class="text-sm text-red-600">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- name End --}}

        {{-- Username Start --}}
        {{-- <div class="flex flex-col gap-2">
            <label for="username" class="text-2xl">Username</label>
            <input type="text" name="username" id="username" class="rounded-lg" value="{{ $id->username }}"
                placeholder="Staff's username.">
            @error('username')
                <div>
                    <p class="text-sm text-red-600">{{ $message }}</p>
                </div>
            @enderror
        </div> --}}
        {{-- Username End --}}

        {{-- Email Start --}}
        <div class="flex flex-col gap-2">
            <label for="email" class="text-2xl">Email</label>
            <input type="email" name="email" id="email" class="rounded-lg" value="{{ $id->email }}"
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
            <label for="password" class="text-2xl">Password</label>
            <input type="password" name="password" id="password" class="rounded-lg peer" value="{{ old('password') }}"
                placeholder="********" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$">
            <div class="peer-invalid:block hidden">
                <p class="text-sm text-gray-800">Please use minimum eight characters, at least one letter, one number
                    and one special character.</p>
            </div>
            @error('password')
                <div>
                    <p class="text-sm text-red-600">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Password End --}}
        <button type="submit"
            class="px-4 py-2 bg-sky-600 hover:bg-sky-800 rounded-lg w-max text-white">Update</button>
    </form>
</x-dash>
