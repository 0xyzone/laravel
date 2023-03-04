<table class="w-full border-separate border-2 hidden lg:inline-table">
    <thead>
        <x-tablehead>
            <td class="pl-2 py-2">ID</td>
            <td>Placed By</td>
            <td>Placed On</td>
            <td>Customer</td>
            <td>Phone</td>
            <td>Address</td>
            <td>Location</td>
            <td>Payment</td>
            <td>Advance</td>
            <td>Due</td>
            <td>Status</td>
            <td>Note</td>
        </x-tablehead>
    </thead>
    <tbody>
        <script>
            var id = '';
        </script>
        @foreach ($orders as $val)
            @php
                if ($val->payment_status == 'paid') {
                    $row = 'bg-lime-500';
                } else {
                    $row = '';
                }
                if ($val->order_status == 'pending') {
                    $status = 'bg-amber-500';
                } elseif ($val->order_status == 'confirmed') {
                    $status = 'bg-green-500';
                } elseif ($val->order_status == 'ncm') {
                    $status = 'bg-orange-500';
                } elseif ($val->order_status == 'delivered') {
                    $status = 'bg-lime-600';
                } elseif ($val->order_status == 'dispatch') {
                    $status = 'bg-stone-500';
                } elseif ($val->order_status == 'canceled') {
                    $status = 'bg-red-800';
                } elseif ($val->order_status == 'follow1') {
                    $status = 'bg-green-600';
                } elseif ($val->order_status == 'follow2') {
                    $status = 'bg-green-700';
                } elseif ($val->order_status == 'follow3') {
                    $status = 'bg-green-800';
                } elseif ($val->order_status == 'follow4') {
                    $status = 'bg-stone-500';
                } else {
                    $status = '';
                }
            @endphp
            <tr class="hover:bg-sky-300/50 fuss odd:bg-slate-200 z-0 {{ $row }}">
                <td class="pl-2 py-2 hover:cursor-pointer"
                    onclick="window.location.href = '{{ route('orders') }}/{{ $val->id }}'">
                    ADB#{{ $val->id }}</td>
                <td class="broder border-slate-300">
                    @foreach ($val->getUser as $user)
                        @php
                            $firstName = explode(' ', $user->name);
                        @endphp
                        {{ $firstName[0] }}
                    @endforeach
                </td>
                <td class="broder-2 border-slate-500">{{ $val->created_at->format('M jS') }}</td>
                <td class="broder-2 border-slate-500">{{ $val->fullName }}</td>
                <td class="broder-2 border-slate-500">
                    {{ $val->phone }}
                    @if (isset($val->additionalPhone))
                        <i class="fa-sharp fa-solid fa-phone-plus" title="{{ $val->additionalPhone }}"></i>
                    @endif
                </td>
                <td class="truncate max-w-[15rem] capitalize" title="{{ $val->address }}">{{ $val->address }}</td>
                <td class="truncate max-w-[5rem] capitalize">{{ $val->location }} valley</td>
                <td class="capitalize">{{ $val->payment_status }}</td>
                <td class="capitalize">
                    @if ($val->payment_status == 'paid')
                        {{ $val->total_price }}
                    @else
                        {{ $val->advance ? $val->advance : 0 }}
                    @endif
                </td>
                <td class="capitalize">
                    @if ($val->payment_status == 'paid')
                        0
                    @else
                        {{ $val->total_price - $val->advance }}
                    @endif
                </td>
                <td class="capitalize group {{ $status }} !px-0">
                    <form action="{{ route('orders') }}/{{ $val->id }}/update/status" method="post">
                        @csrf
                        @method('PUT')
                        @php
                            $current = url()->current();
                            if (str_contains($current, 'dashboard')) {
                                $view = 'dashboard';
                            } else {
                                $view = 'orders';
                            }
                        @endphp
                        <input type="text" name="view" id="view" value="{{ $view }}" hidden>
                        <select name="order_status" id="order_status"
                            class="bg-transparent border-none outline-none w-full focus:ring-0 font-semibold text-white !appearance-none hover:cursor-pointer"
                            onchange="this.form.submit()">
                            @if (
                                $val->order_status == 'delivered' ||
                                    $val->order_status == 'follow1' ||
                                    $val->order_status == 'follow2' ||
                                    $val->order_status == 'follow3' ||
                                    $val->order_status == 'follow4')
                                <option value="delivered" @if ($val->order_status == 'delivered') selected @endif
                                    class="text-black">Delivered
                                </option>
                                <option value="follow1" @if ($val->order_status == 'follow1') selected @endif
                                    class="text-black">1st Follow Up
                                </option>
                                <option value="follow2" @if ($val->order_status == 'follow2') selected @endif
                                    class="text-black">2nd Follow Up
                                </option>
                                <option value="follow3" @if ($val->order_status == 'follow3') selected @endif
                                    class="text-black">3rd Follow Up
                                </option>
                                <option value="follow4" @if ($val->order_status == 'follow4') selected @endif
                                    class="text-black">4th Follow Up
                                </option>
                            @else
                                <option value="pending" @if ($val->order_status == 'pending') selected @endif
                                    class="text-black">Pending</option>
                                <option value="confirmed" @if ($val->order_status == 'confirmed') selected @endif
                                    class="text-black">Confirmed
                                </option>
                                <option value="ncm" @if ($val->order_status == 'ncm') selected @endif
                                    class="text-black">
                                    NCM</option>
                                <option value="delivered" @if ($val->order_status == 'delivered') selected @endif
                                    class="text-black">Delivered
                                </option>
                                <option value="dispatch" @if ($val->order_status == 'dispatch') selected @endif
                                    class="text-black">Dispatched</option>
                                <option value="canceled" @if ($val->order_status == 'canceled') selected @endif
                                    class="text-black">Canceled</option>
                            @endif
                        </select>
                    </form>
                </td>
                <td class="truncate max-w-[10rem] group" title="{{ $val->note }}"><span
                        class="hidden group-hover:inline-block"><i class="fa-solid fa-edit"
                            id="edit{{ $val->id }}"></i></span><span> {{ $val->note }}</span>
                </td>
            </tr>
            <tr>
                <td id="note{{ $val->id }}" colspan="12">
                    <form action="orders/{{ $val->id }}/update/note" method="post" class="pt-2">
                        @csrf
                        @method('PUT')
                        <textarea name="note" id="noteText{{ $val->id }}" rows="auto"
                            class="outline-none bg-amber-400/50 rounded-lg ring-0 border-none focus:border-none focus:ring-0 h-auto py-2 px-4 note-scroll resize-none w-full"
                            placeholder="Type something...">{{ $val->note }}</textarea>
                        <button type="submit" class="btn-primary">Update</button>
                        <span class="btn-danger cursor-pointer" id="cancel{{ $val->id }}">Cancel</span>
                    </form>
                    <script type="text/javascript">
                        $("#note{{ $val->id }}").hide();
                        textarea = document.querySelector("#noteText{{ $val->id }}");
                        textarea.addEventListener('input', autoResize, false);

                        function autoResize() {
                            this.style.height = 'auto';
                            this.style.height = this.scrollHeight + 'px';
                        }
                    </script>
                    <script>
                        $("#edit{{ $val->id }}").click(function() {
                            $("#note{{ $val->id }}").show();
                        })
                        $("#cancel{{ $val->id }}").click(function() {
                            $("#note{{ $val->id }}").hide();
                        })
                    </script>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="flex lg:hidden flex-col gap-2 text-xs">
    @foreach ($orders as $val)
        @php
            if ($val->order_status == 'pending') {
                $statusText = 'text-amber-500';
            } elseif ($val->order_status == 'confirmed') {
                $statusText = 'text-green-500';
            } elseif ($val->order_status == 'ncm') {
                $statusText = 'text-orange-500';
            } elseif ($val->order_status == 'delivered') {
                $statusText = 'text-lime-600';
            } elseif ($val->order_status == 'dispatch') {
                $statusText = 'text-stone-500';
            } elseif ($val->order_status == 'canceled') {
                $statusText = 'text-red-800';
            } elseif ($val->order_status == 'follow1') {
                $statusText = 'text-lime-500';
            } elseif ($val->order_status == 'follow2') {
                $statusText = 'text-lime-500';
            } elseif ($val->order_status == 'follow3') {
                $statusText = 'text-lime-500';
            } elseif ($val->order_status == 'follow4') {
                $statusText = 'text-lime-500';
            } else {
                $status = '';
            }
        @endphp
        <div class="rounded-lg border p-4 space-y-2 border-gray-300 shadow-lg">
            <div class="flex justify-between items-center">
                <div onclick="window.location.href = '{{ route('orders') }}/{{ $val->id }}'" class="w-max">
                    <span class="text-[0.7rem] text-gray-500">
                        <span class="font-bold">ABD#{{ $val->id }}</span> •
                        {{ $val->created_at->format('M jS') }} • <span class="capitalize">{{ $val->location }}
                            Valley</span> • <span class="capitalize">
                            @if ($val->order_status == 'follow1')
                                1st Follow Up
                            @elseif ($val->order_status == 'follow2')
                                2nd Follow Up
                            @elseif ($val->order_status == 'follow3')
                                3rd Follow Up
                            @elseif ($val->order_status == 'dispatch')
                                Dispatched
                            @else
                                {{ $val->order_status }}
                            @endif
                        </span>
                    </span>
                    <p class="capitalize font-bold text-lg {{ $statusText }}">{{ $val->fullName }}</p>
                    <p><i class="fa-solid fa-bag-shopping"></i>
                        @foreach ($val->getProducts as $product)
                            {{ $product->name }}
                        @endforeach
                    </p>
                    <p class="capitalize"><i class="fa-solid fa-location-dot"></i> {{ $val->address }}</p>
                    <p>
                        <i class="fa-solid fa-sack-dollar"></i>
                        <span>
                            @if ($val->payment_status == 'paid')
                                0
                            @else
                                {{ $val->total_price - $val->advance }}
                            @endif
                        </span>
                    </p>
                </div>
                <div class="flex gap-4 text-2xl">
                    <a href="tel:{{ $val->phone }}">
                        <i class="fas fa-phone"></i>
                    </a>
                    @if (isset($val->additionalPhone))
                        <a href="tel:{{ $val->additionalPhone }}">
                            <i class="fa-sharp fa-solid fa-phone-plus"></i>
                        </a>
                    @else
                    @endif
                </div>
            </div>
            @if ($val->note !== null)
                <div class="p-2 rounded-lg bg-gray-300">
                    <span>{{ $val->note }}</span>
                </div>
            @endif
        </div>
    @endforeach
</div>
