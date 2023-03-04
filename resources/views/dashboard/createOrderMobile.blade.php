<x-layout :titlename=$titlename>
    <div class="bg-white/80 my-4 pt-5 flex flex-col gap-2 items-center">
    <div class="w-full px-5 mb-4 ">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-clipboard"></i> Place Orders</h2>
    </div>
    <form action="{{ route('store_order_mobile') }}" method="post" class="w-10/12 lg:w-full flex flex-col gap-4 pb-10 px-5">
        @csrf
        @auth
            <input type="number" name="user_id" id="user_id" value="{{ auth()->user()->id }}" hidden>
        @else
            <input type="number" name="user_id" id="user_id" value="0" hidden>
        @endauth
        <x-orderform :products=$products />
    </form>
    </div>
</x-layout>