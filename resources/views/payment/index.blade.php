<x-dash :titlename=$titlename>
    <div class="flex justify-between w-full items-center px-5 mb-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-money-check-dollar-pen"></i> Payments</h2>
        {{-- <x-search query='orders' /> --}}
        <a href="{{ route('create_payments') }}" class="btn-primary fuss">Add New</a>
    </div>
    <div class="mt-2 px-5">
        <x-paymentTable :payments=$payments />
    </div>
</x-dash>
