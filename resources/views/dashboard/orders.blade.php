<x-dash :titlename=$titlename>
    <div class="flex flex-col lg:flex-row justify-between w-full lg:items-center px-5 mb-4 gap-4 lg:gap-0">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-clipboard"></i> Orders</h2>
        <div class="flex lg:flex-row flex-col gap-2 lg:w-6/12">
            <x-search query='orders' param='Order id' />
            <x-search query='phone' param='Phone number' />
        </div>
        {{-- <a href="{{ route('create_orders') }}" class="btn-primary fuss">Add New</a> --}}
    </div>
    <div class="mt-2 px-5">
        <x-ordersTable :orders=$orders />
        {{ $orders->onEachSide(1)->links() }}
    </div>
</x-dash>
