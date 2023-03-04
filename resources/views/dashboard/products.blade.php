<x-dash :titlename=$titlename>
    @if (auth()->user()->role == '1')
    <div class="flex justify-between w-full items-center px-5 mb-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-boxes"></i> Products</h2>
        <a href="{{ route('create_products') }}" class="btn-primary fuss">Add New</a>
    </div>
    <table class="w-full mt-2">
        <thead>
            <x-tablehead class="w-full font-bold bg-sky-600 text-white">
                <td class="pr-2 py-2 text-right">ID</td>
                <td>Product Name</td>
                <td>Product Price</td>
                <td>
                    <div class="w-full flex justify-center">
                        Actions
                    </div>
                </td>
            </x-tablehead>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="">
                    <td class="py-2 text-right pr-2">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <div class="flex w-full justify-center gap-2">
                            {{-- <a href="#"><i class="fa-solid fa-eye" title="View"></i></a> --}}
                            <a href="/auth/products/{{ $product->id }}/edit"><i class="fa-solid fa-pen-to-square"
                                    title="Edit"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        You are not permitted!
    @endif
</x-dash>
