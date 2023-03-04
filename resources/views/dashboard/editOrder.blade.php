<x-dash :titlename=$titlename>
    <div class="flex justify-between w-full items-center px-5 mb-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-clipboard"></i> Edit Order</h2>
        <a href="{{ url()->previous() }}" class="btn-primary fuss">Go back</a>
    </div>
    <form action="update" method="post" class="w-full flex flex-col gap-4 pb-10 px-5">
        @csrf
        @method('PUT')
        <input type="number" name="user_id" id="user_id" value="{{ $order->user_id }}" hidden>

        {{-- name Start --}}
        <div class="flex flex-col gap-2 mt-2">
            <label for="fullName" class="text-2xl">Customer Name <span class="text-red-500">*</span></label>
            <input type="text" name="fullName" id="fullName" class="rounded-lg" value="{{ $order->fullName }}"
                placeholder="Customer full name">
            @error('fullName')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- name End --}}

        {{-- email Start --}}
        <div class="flex flex-col gap-2 mt-2">
            <label for="email" class="text-2xl">Customer Email</label>
            <input type="email" name="email" id="email" class="rounded-lg" value="{{ $order->email }}"
                placeholder="Customer email address">
            @error('email')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- email End --}}

        {{-- phone Start --}}
        <div class="flex flex-col gap-2">
            <label for="phone" class="text-2xl">Phone Number <span class="text-red-500">*</span></label>
            <input type="number" name="phone" id="phone" class="rounded-lg" value="{{ $order->phone }}"
                placeholder="9801234567">
            @error('phone')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- phone End --}}

        {{-- Additional phone Start --}}
        <div class="flex flex-col gap-2">
            <label for="additionalPhone" class="text-2xl">Additional Phone Number</label>
            <input type="number" name="additionalPhone" id="additionalPhone" class="rounded-lg"
                value="{{ $order->additionalPhone }}" placeholder="9801234567">
            @error('additionalPhone')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Additional phone End --}}

        {{-- Address Start --}}
        <div class="flex flex-col gap-2">
            <label for="address" class="text-2xl">Address <span class="text-red-500">*</span></label>
            <input type="text" name="address" id="address" class="rounded-lg" value="{{ $order->address }}"
                placeholder="Basantapur, Kathmandu, Nepal">
            @error('address')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- address End --}}

        {{-- location start --}}
        <div class="flex flex-col gap-2">
            <label for="location" class="text-2xl">Location <span class="text-red-500">*</span></label>
            <select name="location" id="location" class="rounded-lg">
                <option value="inside" @if ($order->location == 'inside') selected @endif>Inside Valley</option>
                <option value="outside" @if ($order->location == 'outside') selected @endif>Outside Valley</option>
            </select>
            @error('location')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- location end --}}

        {{-- Product start --}}
        <div class="flex flex-col gap-2">
            <label for="product_id" class="text-2xl">Product <span class="text-red-500">*</span></label>
            <select name="product_id" id="product_id" class="rounded-lg">
                <option value="">Please choose one.</option>
                @foreach ($products as $val)
                    <option value="{{ $val->id }}" @if ($order->product_id == $val->id) selected @endif>
                        {{ $val->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Product end --}}

        {{-- Quantity start --}}
        <div class="flex flex-col gap-2">
            <label for="qty" class="text-2xl">Quantity <span class="text-red-500">*</span></label>
            <input type="number" name="qty" id="qty" class="rounded-lg placeholder:text-gray-300"
                value="{{ $order->qty }}" placeholder="1">
            @error('qty')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Quantity end --}}

        {{-- Discount start --}}
        <div class="flex flex-col gap-2">
            <label for="discount" class="text-2xl">Discount</label>
            <input type="number" name="discount" id="discount" class="rounded-lg placeholder:text-gray-300"
                value="{{ $order->discount }}" placeholder="100">
            @error('discount')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Discount end --}}

        {{-- Advance start --}}
        <div class="flex flex-col gap-2">
            <label for="advance" class="text-2xl">Advance</label>
            <input type="number" name="advance" id="advance" class="rounded-lg placeholder:text-gray-300"
                value="{{ $order->advance }}" placeholder="500">
            @error('advance')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Advance end --}}

        {{-- Gateway start --}}
        <div class="flex flex-col gap-2">
            <label for="gateway" class="text-2xl">Payment Gateway <span class="text-red-500">*</span></label>
            <select name="gateway" id="gateway" class="rounded-lg">
                <option value="">Please choose one.</option>
                <option value="cash" @if ($order->gateway == 'cash') selected @endif>Cash</option>
                <option value="esewa" @if ($order->gateway == 'esewa') selected @endif>eSewa</option>
                <option value="bank" @if ($order->gateway == 'bank') selected @endif>Bank</option>
            </select>
            @error('gateway')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- gateway end --}}

        {{-- Payment Status start --}}
        <div class="flex flex-col gap-2">
            <label for="payment_status" class="text-2xl">Payment Status <span class="text-red-500">*</span></label>
            <select name="payment_status" id="payment_status" class="rounded-lg">
                <option value="cod" @if ($order->payment_status == 'cod') selected @endif>Cash on Delivery (cod)
                </option>
                <option value="paid" @if ($order->payment_status == 'paid') selected @endif>Paid</option>
            </select>
            @error('payment_status')
                <div>
                    <p class="text-sm text-red-500">{{ $message }}</p>
                </div>
            @enderror
        </div>
        {{-- Payment Status end --}}

        {{-- Order Status start --}}
        <div class="flex flex-col gap-2">
            <label for="order_status" class="text-2xl">Order Status</label>
            <select name="order_status" id="order_status" class="rounded-lg">
                <option value="pending" @if ($order->order_status == 'pending') selected @endif>Pending</option>
                <option value="confirmed" @if ($order->order_status == 'confirmed') selected @endif>Confirmed</option>
                <option value="ncm" @if ($order->order_status == 'ncm') selected @endif>NCM</option>
                <option value="delivered" @if ($order->order_status == 'delivered') selected @endif>Delivered</option>
                <option value="dispatch" @if ($order->order_status == 'dispatch') selected @endif>Dispatch</option>
                <option value="canceled" @if ($order->order_status == 'canceled') selected @endif>canceled</option>
                <option value="follow1" @if ($order->order_status == 'follow1') selected @endif>1st Follow up</option>
                <option value="follow2" @if ($order->order_status == 'follow2') selected @endif>2nd Follow up</option>
                <option value="follow3" @if ($order->order_status == 'follow3') selected @endif>3rd Follow up</option>
                <option value="follow4" @if ($order->order_status == 'follow4') selected @endif>4th Follow up</option>
            </select>
        </div>
        {{-- Order Status end --}}

        {{-- Note start --}}
        <div class="flex flex-col gap-2">
            <label for="note" class="text-2xl">Note</label>
            <textarea name="note" id="note" cols="30" rows="auto"
                class="outline-none bg-amber-400/50 rounded-lg ring-0 border-none focus:border-none focus:ring-0 h-auto py-2 px-4 note-scroll resize-none"
                placeholder="Type something...">{{ $order->note }}</textarea>
            <script type="text/javascript">
                textarea = document.querySelector("#note");
                textarea.addEventListener('input', autoResize, false);

                function autoResize() {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                }
            </script>
        </div>
        {{-- Note end --}}

        <button type="submit" class="px-4 py-2 bg-sky-600 text-white hover:bg-sky-800 rounded-lg w-max mt-4">Update
            Order</button>
    </form>
</x-dash>
