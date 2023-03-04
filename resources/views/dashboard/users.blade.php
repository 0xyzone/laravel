<x-dash :titlename=$titlename>
    @if (auth()->user()->role == '1')
        <div class="flex justify-between w-full items-center px-5 mb-4">
            <h2 class="text-2xl font-bold"><i class="fa-solid fa-users"></i> Users</h2>
            <a href="{{ route('registration') }}" class="btn-primary fuss">Register New</a>
        </div>
        <table class="w-full hidden lg:table">
            <thead>
                <x-tablehead>
                    <td class="text-right px-2 py-2">ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Username</td>
                    <td class="text-center">Orders</td>
                    <td class="text-center">Pending</td>
                    <td class="text-center">Delivered</td>
                    <td class="text-center">Paid</td>
                    <td class="text-center">Payable</td>
                    <td>
                        <div class="w-full flex justify-center">
                            Actions
                        </div>
                    </td>
                </x-tablehead>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-300/50 fuss">
                        <td class="py-2 text-right px-2">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td class="text-center">{{ App\Models\Order::where('user_id', $user->id)->count() }}</td>
                        <td class="text-center">
                            {{ App\Models\Order::where(['user_id' => $user->id, 'order_status' => 'pending'])->count() }}
                        </td>
                        <td class="text-center">
                            {{ App\Models\Order::where(['user_id' => $user->id, 'order_status' => 'delivered'])->count() }}
                        </td>
                        <td class="text-center">
                            @php
                                $sum = 0;
                            @endphp
                            @foreach ($payments as $val)
                                @if ($val->user_id == $user->id)
                                    @php
                                        $sum = App\Models\Payment::sum('qty');
                                    @endphp
                                @endif
                            @endforeach
                            {{ $sum }}
                        </td>
                        <td class="text-center">
                            @php
                                $deliver = App\Models\Order::where(['user_id' => $user->id, 'order_status' => 'delivered'])->count();
                                $follow1 = App\Models\Order::where(['user_id' => $user->id, 'order_status' => 'follow1'])->count();
                                $follow2 = App\Models\Order::where(['user_id' => $user->id, 'order_status' => 'follow2'])->count();
                                $follow3 = App\Models\Order::where(['user_id' => $user->id, 'order_status' => 'follow3'])->count();
                                $follow4 = App\Models\Order::where(['user_id' => $user->id, 'order_status' => 'follow4'])->count();
                            @endphp
                            {{ $deliver + $follow1 + $follow2 + $follow3 + $follow4 - $sum }}
                        </td>
                        <td>
                            <div class="flex w-full justify-center gap-2">
                                <a href="/auth/users/{{ $user->id }}/edit"><i
                                        class="fa-solid fa-pen-to-square hover:scale-105 hover:text-sky-500 fuss"
                                        title="Edit"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex lg:hidden flex-col gap-2 text-xs">
            @foreach ($users as $val)
                <div class="rounded-lg border p-4 space-y-4 border-gray-300 shadow-lg">
                    <div class="flex justify-between items-center">
                        <div class="w-max">
                            <span class="text-[0.7rem] text-gray-500">
                                <span class="font-bold">User ID #{{ $val->id }}</span> • {{ $val->username }}
                            </span>
                            <p class="capitalize font-bold text-lg">{{ $val->name }}</p>
                            <span><i class="fa-light fa-envelopes-bulk"></i> {{ $val->email }}</span>
                        </div>
                        <a href="/auth/users/{{ $val->id }}/edit">
                            <i class="fa-solid fa-pen-to-square hover:scale-105 hover:text-sky-500 fuss text-2xl"
                                title="Edit"></i>
                        </a>
                    </div>
                    {{-- stats start --}}
                    <div class="p-2 rounded-lg bg-gray-300 grid grid-cols-5 text-center">
                        <p>
                            <i class="fa-light fa-boxes-stacked"></i>
                            <span>{{ App\Models\Order::where('user_id', $val->id)->count() }}</span>
                        </p>
                        <p>
                            <i class="fa-regular fa-hourglass-half"></i>
                            <span>{{ App\Models\Order::where(['user_id' => $val->id, 'order_status' => 'pending'])->count() }}</span>
                        </p>
                        <p>
                            <i class="fa-regular fa-truck"></i>
                            <span>{{ App\Models\Order::where(['user_id' => $val->id, 'order_status' => 'delivered'])->count() }}</span>
                        </p>
                        <p>
                            <i class="fa-regular fa-circle-dollar-to-slot"></i>
                            @php
                                $sum = 0;
                            @endphp
                            @foreach ($payments as $paid)
                                @if ($paid->user_id == $val->id)
                                    @php
                                        $sum = App\Models\Payment::sum('qty');
                                    @endphp
                                @endif
                            @endforeach
                            {{ $sum }}
                        </p>
                        <p>
                            <i class="fa-light fa-hand-holding-dollar"></i>
                            @php
                                $deliver = App\Models\Order::where(['user_id' => $val->id, 'order_status' => 'delivered'])->count();
                                $follow1 = App\Models\Order::where(['user_id' => $val->id, 'order_status' => 'follow1'])->count();
                                $follow2 = App\Models\Order::where(['user_id' => $val->id, 'order_status' => 'follow2'])->count();
                                $follow3 = App\Models\Order::where(['user_id' => $val->id, 'order_status' => 'follow3'])->count();
                                $follow4 = App\Models\Order::where(['user_id' => $val->id, 'order_status' => 'follow4'])->count();
                            @endphp
                            {{ $deliver + $follow1 + $follow2 + $follow3 + $follow4 - $sum }}
                        </p>
                    </div>
                    {{-- stats end --}}
                </div>
            @endforeach
        </div>

        <div>
            {{ $users->links() }}
        </div>
    @else
        You are not permitted!
    @endif
</x-dash>
