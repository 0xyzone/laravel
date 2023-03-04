<table class="w-full border-separate border-2">
    <thead>
        <x-tablehead>
            <td class="pl-2 py-2">ID</td>
            <td class="w-2/12">Payment Date</td>
            <td class="w-5/12">Paid to</td>
            <td class="w-1/12">Quantity</td>
            <td class="w-4/12">
                <div class="w-full flex justify-center">
                    Actions
                </div>
            </td>
        </x-tablehead>
    </thead>
    <tbody>
        @foreach ($payments as $val)
            <tr class="hover:bg-gray-300/50 fuss">
                <td class="py-2 text-right px-2">{{ $val->id }}</td>
                <td>{{ date('M jS, Y' , strtotime($val->payment_date)) }}</td>
                <td>
                    @foreach ($val->getUser as $user)
                        {{$user->name}}
                    @endforeach
                </td>
                <td>{{$val->qty}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    {{ $payments->links() }}
</div>