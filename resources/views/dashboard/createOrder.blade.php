<x-dash :titlename=$titlename>
    <div class="flex justify-between w-full items-center px-5 mb-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-clipboard"></i> Place Orders</h2>
        <a href="{{ url()->previous() }}" class="btn-primary fuss">Go back</a>
    </div>
    <form action="{{ route('store_order') }}" method="post" class="w-full flex flex-col gap-4 pb-10 px-5 mx-auto">
        @csrf
        @auth
            <input type="number" name="user_id" id="user_id" value="{{ auth()->user()->id }}" hidden>
        @else
            <input type="number" name="user_id" id="user_id" value="0" hidden>
        @endauth
        <x-orderform :products=$products />
    </form>
</x-dash>