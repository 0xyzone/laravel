<x-dash :titlename=$titlename>
    @if (auth()->user()->role == '1' || auth()->user()->role == '2')
        <div class="flex justify-between w-full items-center px-5 mb-4">
            <h2 class="text-2xl font-bold"><i class="fa-solid fa-briefcase"></i> Leads</h2>
        </div>
        <table class="w-full hidden lg:table">
            <thead>
                <x-tablehead>
                    <td class="text-right px-2 py-2">ID</td>
                    <td>Name</td>
                    <td>Created At</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td>
                        <div class="w-full flex justify-center">
                            Actions
                        </div>
                    </td>
                </x-tablehead>
            </thead>
            <tbody>
                @if (count($users) == 0)
                    <tr>
                        <td class="text-center" colspan="5">
                            No data available.
                        </td>
                    </tr>
                @endif
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-300/50 fuss">
                        <td class="py-2 text-right px-2">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at->format('M jS') }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td class="text-center">
                            <form action="leads/{{ $user->id }}/claim" method="post">
                                @csrf
                                <input type="number" name="user_id" id="user_id" value="{{ auth()->user()->id }}"
                                    hidden>
                                <input type="number" name="product_id" id="product_id" value="1" hidden>
                                <button type="submit" class="btn-secondary">Claim</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex lg:hidden flex-col gap-2 text-xs">
            @foreach ($users as $user)
                <div class="rounded-lg border p-4 space-y-4 border-gray-300 shadow-lg">
                    <div class="flex justify-between items-center">
                        <div class="w-max">
                            <span class="text-[0.7rem] text-gray-500">
                                <span class="font-bold">Lead ID #{{ $user->id }}</span> •
                                {{ $user->created_at->format('M jS') }}
                            </span>
                            <p class="capitalize font-bold text-lg">{{ $user->name }}</p>
                            <p class="capitalize grid grid-cols-2"><span><i class="fa-sharp fa-regular fa-location-dot"></i> {{ $user->address }}</span> <span><i class="fa-light fa-phone"></i> {{ $user->phone }}</span></p>
                        </div>
                        <div class="flex gap-4">
                            <a href="tel:{{ $user->phone }}"><i class="fa-solid fa-phone-volume text-2xl"></i></a>
                        <form action="leads/{{ $user->id }}/claim" method="post">
                            @csrf
                            <input type="number" name="user_id" id="user_id" value="{{ auth()->user()->id }}"
                                hidden>
                            <input type="number" name="product_id" id="product_id" value="1" hidden>
                            <button type="submit" class="btn-secondary">Claim</button>
                        </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-center">
            {{ $users->links() }}
        </div>
    @else
        You are not permitted!
    @endif
</x-dash>
