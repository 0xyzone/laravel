<x-layout :titlename=$titlename>
    <div class="flex flex-col w-full h-full items-center gap-4">
        <x-clipboard clipTag='Place your order'>
            <form action="{{route('storeOrder')}}" method="post" class="w-10/12 lg:w-8/12 flex flex-col gap-4">
                @csrf
                @auth
                <input type="number" name="user_id" id="user_id" value="{{auth()->user()->id}}" hidden>
                @else
                <input type="number" name="user_id" id="user_id" value="0" hidden>
                @endauth
                
                <input type="number" name="order_status_id" id="order_status_id" value="1" hidden>
                {{-- name Start --}}
                <div class="flex flex-col gap-2 mt-5">
                    <label for="fullName" class="text-white text-2xl">Full Name</label>
                    <input type="text" name="fullName" id="name" class="rounded-lg" value="{{ old('fullName') }}"
                        placeholder="Your full name.">
                    @error('fullName')
                        <div>
                            <p class="text-sm text-red-100">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- name End --}}

                {{-- phone Start --}}
                <div class="flex flex-col gap-2">
                    <label for="phone" class="text-white text-2xl">Phone Number</label>
                    <input type="number" name="phone" id="phone" class="rounded-lg" value="{{ old('phone') }}"
                        placeholder="9801234567">
                    @error('phone')
                        <div>
                            <p class="text-sm text-red-100">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- phone End --}}

                {{-- Address Start --}}
                <div class="flex flex-col gap-2">
                    <label for="address" class="text-white text-2xl">Address</label>
                    <input type="text" name="address" id="address" class="rounded-lg" value="{{ old('address') }}"
                        placeholder="Basantapur, Kathmandu, Nepal">
                    @error('address')
                        <div>
                            <p class="text-sm text-red-100">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- phone End --}}

                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-800 rounded-lg w-max text-white">Place Order</button>
            </form>
        </x-clipboard>
    </div>
</x-layout>
