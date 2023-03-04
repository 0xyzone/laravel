<x-layout :titlename=$titlename>
    <div class="flex flex-col w-full h-full items-center gap-4">
        <x-clipboard clipTag='Edit product'>
            <form action="/auth/products/{{$product->id}}/update" method="post" class="w-10/12 lg:w-8/12 flex flex-col gap-4">
                @csrf
                {{-- Product name Start --}}
                <div class="flex flex-col gap-2 mt-5">
                    <label for="name" class="text-white text-2xl">Product Name</label>
                    <input type="text" name="name" id="name" class="rounded-lg" value="{{ $product->name }}"
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
                    <label for="price" class="text-white text-2xl">Price</label>
                    <input type="number" name="price" id="price" class="rounded-lg" value="{{ $product->price }}"
                        placeholder="9801234567">
                    @error('price')
                        <div>
                            <p class="text-sm text-red-100">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Product Price End --}}
                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-800 rounded-lg w-max text-white">Update Product</button>
            </form>
        </x-clipboard>
    </div>
</x-layout>
