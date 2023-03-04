@php
    $btns = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-sharp fa-solid fa-gauge',
        ],
        [
            'name' => 'Users',
            'icon' => 'fa-solid fa-users',
        ],
        [
            'name' => 'Orders',
            'icon' => 'fa-solid fa-clipboard',
        ],
        [
            'name' => 'Products',
            'icon' => 'fa-solid fa-boxes',
        ],
        // [
        //     'name' => 'FollowUps',
        //     'icon' => 'fa-solid fa-boxes',
        // ],
        [
            'name' => 'Leads',
            'icon' => 'fa-solid fa-briefcase',
        ],
        [
            'name' => 'Payments',
            'icon' => 'fa-solid fa-money-check-dollar-pen',
        ],
    ];
@endphp
<ul class="flex gap-2 z-50 !text-xs lg:!text-xl sticky top-32">
    @foreach ($btns as $btn)
        @php
            $path = strtolower($btn['name']);
            $current = url()->current();
            if (str_contains($current, $path)) {
                $text = 'text-sky-600 bg-sky-500/10';
            } else {
                $text = '';
            }
        @endphp

        @if (
            (auth()->user()->role == '0' && $btn['name'] == 'Users') ||
                (auth()->user()->role == '0' && $btn['name'] == 'Products') ||
                (auth()->user()->role == '0' && $btn['name'] == 'Leads') ||
                (auth()->user()->role == '0' && $btn['name'] == 'Payments'))
            @continue
        @endif
        @if (
            (auth()->user()->role == '2' && $btn['name'] == 'Users') ||
                (auth()->user()->role == '2' && $btn['name'] == 'Products') ||
                (auth()->user()->role == '2' && $btn['name'] == 'Payments'))
            @continue
        @endif

        <a href="{{ route($path) }}" class="relative hover:bg-gray-300 px-2 py-2 {{ $text }}">
            <li id="{{ $path }}" class="flex items-center gap-2">
                <span class="w-8 h-8 flex justify-center items-center">
                    <i class="{{ $btn['icon'] }}"></i>
                </span>
                <span class="hidden lg:block">{{ $btn['name'] }}</span>
                @if (str_contains($current, $path))
                    <span class="w-full h-2 bg-lime-600 absolute right-0 bottom-0"></span>
                @endif
            </li>
        </a>
    @endforeach
</ul>
