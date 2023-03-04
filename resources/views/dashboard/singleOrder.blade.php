<x-dash :titlename=$titlename>
    @php
        if ($order->order_status == 'Delivered') {
            $status = 'text-lime-500';
        } else {
            $status = '';
        }
    @endphp
    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-lg font-bold text-gray-500 py-2">Order No. {{ $order->id }} <span
                    class="capitalize text-xs px-2 py-2 border-2 rounded-lg border-current {{ $status }}">{{ $order->order_status }}</span>
            </h1>
            <h2 class="text-3xl font-bold text-sky-600">
                @foreach ($order->getProducts as $val)
                    {{ $val->name }}
                @endforeach
            </h2>
            <p>Order placed by:
                <span class="font-bold">
                    @foreach ($order->getUser as $user)
                        {{ $user->name }}
                    @endforeach
                </span>
            </p>
        </div>
        <div class="text-2xl flex gap-4">
            @php
                $status = [
                    'delivered',
                    'follow1',
                    'follow2',
                    'follow3',
                    'follow4',
                ]
            @endphp
            @if (Illuminate\Support\Str::containsALL($order->order_status, [$status]))
            @else
                <a href="{{ $order->id }}/edit"><i class="fa-solid fa-edit"></i></a>
                {{-- <a href="{{ $order->id }}/delete"
                    onclick="return confirm('Are you sure you want to delete this order?')">
                    <i class="fa-solid fa-trash"></i>
                </a> --}}
            @endif
        </div>
    </div>
    <hr>
    <div class="flex flex-col lg:flex-row gap-2">
        <div class="mt-2 p-5 bg-gray-300 lg:w-4/12 w-full rounded-lg shadow-lg h-max flex-shrink-0">
            <h2 class="text-xl font-bold">Customer Details</h2>
            <table>
                <tr>
                    <td class="w-8 text-center"><i class="fa-solid fa-user"></i></td>
                    <td class="capitalize">{{ $order->fullName }}</td>
                </tr>
                <tr>
                    <td class="w-8 text-center"><i class="fa-solid fa-phone"></i></td>
                    <td>{{ $order->phone }} @if (isset($order->additionalPhone))
                            / {{ $order->additionalPhone }}
                        @endif
                    </td>
                </tr>
                @if ($order->email !== null)
                <tr>
                    <td class="w-8 text-center"><i class="fa-solid fa-envelope"></i></td>
                    <td class="lowercase">{{ $order->email }}</td>
                </tr>
                @endif
                <tr>
                    <td class="w-8 text-center"><i class="fa-solid fa-location-dot"></i></td>
                    <td class="capitalize">{{ $order->address }}</td>
                </tr>
                <tr>
                    <td class="w-8 text-center"><i class="fa-regular fa-map-location-dot"></i></td>
                    <td class="capitalize">{{ $order->location }} Valley</td>
                </tr>
            </table>
        </div>
        <div class="mt-2 p-5 bg-gray-200 w-full rounded-lg shadow-lg h-max">
            <div class="flex justify-between">
                <h2 class="text-xl font-bold">Invoice</h2>
                {{ $order->created_at->format('M jS, Y') }}
            </div>

            <div class="py-0.5 bg-sky-600 rounded-full my-1"></div>

            <table class="w-full text-right mt-2 table-fixed">
                @foreach ($order->getProducts as $val)
                    <tr class="bg-gray-300/80">
                        <td class="lg:w-10/12 w-8/12 text-left pl-2">{{ $val->name }}</td>
                        <td class="inline pr-2">Rs. {{ $val->price }}</td>
                    </tr>
                @endforeach
                <tr class="bg-gray-300/30 border-b border-b-gray-300">
                    <td class="text-right pr-2 py-2">Qty</td>
                    <td class="pr-2">
                        {{ $order->qty }}
                    </td>
                </tr>
                <tr class="bg-gray-300/30">
                    <td class="text-right pr-2 py-2">Discount</td>
                    <td class="pr-2">
                        @if ($order->discount != '')
                            Rs. {{ $order->discount }}
                        @else
                            Rs. 0
                        @endif
                    </td>
                </tr>
                <tr class="bg-gray-300/30">
                    <td class="text-right pr-2 py-2">Delivery</td>
                    <td class="pr-2">
                        @if ($order->location == 'inside')
                            Rs. 100
                        @else
                            Rs. 150
                        @endif
                    </td>
                </tr>
                <tr class="font-semibold bg-gray-300/90">
                    <td class="text-right pr-2 py-2">Total</td>
                    <td class="pr-2">Rs. {{ $order->total_price }}</td>
                </tr>
                <tr class="font-semibold bg-gray-300/90">
                    <td class="text-right pr-2 py-2">Advance</td>
                    <td class="pr-2">Rs. {{ $order->advance ? $order->advance : 0 }}</td>
                </tr>
                <tr class="font-semibold bg-gray-300/90">
                    <td class="text-right pr-2 py-2">Grand Total</td>
                    <td class="pr-2">Rs. {{ $order->total_price - $order->advance }}</td>
                </tr>
            </table>
            <div class="flex flex-col gap-2 mt-2">
                <label for="note">Notes</label>
                <span id='note' class="bg-amber-400/50 rounded-lg min-h-[3.5rem] py-2 px-4"
                    disabled>{{ $order->note }}</span>
            </div>
            <div class="flex gap-2 mt-2 font-bold">
                <p>Mode of payment: <span class="font-normal capitalize">{{ $order->gateway }}</span></p>
                <p>Payment status: <span class="font-normal capitalize">{{ $order->payment_status }}</span></p>
            </div>
        </div>
    </div>
</x-dash>
