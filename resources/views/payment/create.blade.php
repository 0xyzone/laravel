<x-dash :titlename=$titlename>
    <div class="flex justify-between w-full items-center px-5 mb-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-money-check-dollar-pen"></i> Record Payment</h2>
        <a href="{{ url()->previous() }}" class="btn-primary fuss">Go back</a>
    </div>
    <form action="{{ route('store_payments') }}" method="post" class="w-10/12 lg:w-full flex flex-col gap-4 pb-10 px-5">
        @csrf
        {{-- Payment Date Start --}}
        <div class="flex flex-col gap-2 mt-2">
            <label for="payment_date" class="text-2xl">Payment Date <span class="text-red-500">*</span></label>
            <input type="date" name="payment_date" id="payment_date" class="rounded-lg"
                value="{{ old('payment_date') }}">
            @error('payment_date')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Payment Date End --}}

        {{-- Paid to start --}}
        <div class="flex flex-col gap-2 mt-2">
            <label for="user_id" class="text-2xl">Paid to <span class="text-red-500">*</span></label>
            <select name="user_id" id="user_id">
                @foreach ($users as $var)
                    @if ($var->id == 1)
                        @continue
                    @endif
                    <option value="{{ $var->id }}" @if (old('user_id') == $var->id) selected @endif>
                        {{ $var->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Paid to end --}}

        {{-- Total Qty starts --}}
        <div class="flex flex-col gap-2 mt-2">
            <label for="qty" class="text-2xl">Total Quantity <span class="text-red-500">*</span></label>
            <input type="number" name="qty" id="qty" class="rounded-lg" value="{{ old('qty') }}"
                placeholder="50">
            @error('qty')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Total Qty end --}}

        <button type="submit" class="btn-primary">Submit</button>
    </form>
</x-dash>
