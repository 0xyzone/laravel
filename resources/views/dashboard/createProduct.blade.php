<x-dash :titlename=$titlename>
    <div class="flex justify-between w-full items-center px-5 mb-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-clipboard"></i> {{$titlename}}</h2>
        <a href="{{ url()->previous() }}" class="btn-primary fuss">Go back</a>
    </div>
    <form action="{{ route('storeProduct') }}" method="post" class="w-10/12 lg:w-full flex flex-col gap-4 pb-10 px-5">
        @csrf
        {{-- Product name Start --}}
        <div class="flex flex-col gap-2 mt-5">
            <label for="name" class="text-2xl">Product Name</label>
            <input type="text" name="name" id="name" class="rounded-lg" value="{{ old('name') }}"
                placeholder="Product name">
            @error('name')
                <div>
                    <p class="text-sm text-red-100">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Product name End --}}

        {{-- Product Price Start --}}
        <div class="flex flex-col gap-2">
            <label for="price" class="text-2xl">Price</label>
            <input type="number" name="price" id="price" class="rounded-lg" value="{{ old('price') }}"
                placeholder="3000">
            @error('price')
                <div>
                    <p class="text-sm text-red-100">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Product Price End --}}
        <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-800 rounded-lg w-max text-white">Create</button>
    </form>
</x-dash>
