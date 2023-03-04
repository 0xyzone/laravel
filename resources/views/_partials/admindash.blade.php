<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-semibold mb-2">Orders</h1>
    <a href="{{ route('create_orders') }}" class="btn-primary fuss">Add New</a>
</div>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-white">
    <div class="flex bg-sky-500 rounded-lg p-5 lg:shadow-md lg:shadow-sky-300 justify-between items-center">
        <div class="flex justify-between lg:text-2xl w-full">
            <p class="lg:font-bold font-semibold">Today</p>
            <span>{{ $totalToday }}</span>
        </div>
    </div>
    <div class="flex bg-violet-600 rounded-lg p-5 lg:shadow-md lg:shadow-violet-300 justify-between items-center">
        <div class="flex justify-between lg:text-2xl w-full">
            <p class="lg:font-bold font-semibold">This Month</p>
            <span>{{ $thisMonth }}</span>
        </div>
    </div>
    <a href="#pending">
        <div class="flex bg-yellow-500 rounded-lg p-5 lg:shadow-md lg:shadow-yellow-300 justify-between items-center">
            <div class="flex justify-between lg:text-2xl w-full">
                <p class="lg:font-bold font-semibold">Pending</p>
                <span>{{ $pending }}</span>
            </div>
        </div>
    </a>
    <a href="#delivered">
        <div class="flex bg-lime-500 rounded-lg p-5 lg:shadow-md lg:shadow-lime-300 justify-between items-center">
            <div class="flex justify-between lg:text-2xl w-full">
                <p class="lg:font-bold font-semibold">Delivered</p>
                <span>{{ $delivered }}</span>
            </div>
        </div>
    </a>
    <a href="#ncm">
        <div class="flex bg-orange-500 rounded-lg p-5 lg:shadow-md lg:shadow-orange-300 justify-between items-center">
            <div class="flex justify-between lg:text-2xl w-full">
                <p class="lg:font-bold font-semibold">NCM</p>
                <span>{{ $ncm }}</span>
            </div>
        </div>
    </a>
    <a href="#dispatched">
        <div class="flex bg-stone-500 rounded-lg p-5 lg:shadow-md lg:shadow-stone-300 justify-between items-center">
            <div class="flex justify-between lg:text-2xl w-full">
                <p class="lg:font-bold font-semibold">Dispatched</p>
                <span>{{ $dispatched }}</span>
            </div>
        </div>
    </a>
    <a href="#confirmed">
        <div class="flex bg-green-500 rounded-lg p-5 lg:shadow-md lg:shadow-green-300 justify-between items-center">
            <div class="flex justify-between lg:text-2xl w-full">
                <p class="lg:font-bold font-semibold">Confirmed</p>
                <span>{{ $confirmed }}</span>
            </div>
        </div>
    </a>
    <div class="flex bg-red-500 rounded-lg p-5 lg:shadow-md lg:shadow-red-300 justify-between items-center">
        <div class="flex justify-between lg:text-2xl w-full">
            <p class="lg:font-bold font-semibold">Canceled</p>
            <span>{{ $canceled }}</span>
        </div>
    </div>
</div>

<h1 class="text-2xl font-semibold mb-2 mt-10" id="pending">Pending Orders</h1>
<x-ordersTable :orders=$pendingOrders />
<div class="w-11-12 flex justify-center">
{{ $pendingOrders->appends(['confirmed' => $confirmedOrders->currentPage(), 'delivered' => $deliveredOrders->currentPage(), 'ncm' => $ncmOrders->currentPage(), 'dispatched' => $dispatchedOrders->currentPage()])->onEachSide(0)->links() }}
</div>

<div class="flex justify-between mb-2 mt-10" id="confirmed">
    <h1 class="text-2xl font-semibold">Confirmed Orders</h1>
    @include('_partials.printBtn')
</div>
<x-ordersTable :orders=$confirmedOrders />
<div class="w-11-12 flex justify-center">
    {{ $confirmedOrders->appends(['pendings' => $pendingOrders->currentPage(), 'delivered' => $deliveredOrders->currentPage(), 'ncm' => $ncmOrders->currentPage(), 'dispatched' => $dispatchedOrders->currentPage()])->onEachSide(0)->links() }}
</div>
<div class="flex justify-between mb-2 mt-10" id="ncm">
    <h1 class="text-2xl font-semibold">NCM Orders</h1>
</div>
<x-ordersTable :orders=$ncmOrders />
<div class="w-11-12 flex justify-center">
    {{ $ncmOrders->appends(['pendings' => $pendingOrders->currentPage(), 'confirmed' => $confirmedOrders->currentPage(), 'delivered' => $deliveredOrders->currentPage(), 'dispatched' => $dispatchedOrders->currentPage()])->onEachSide(0)->links() }}
</div>
<div class="flex justify-between mb-2 mt-10" id="dispatched">
    <h1 class="text-2xl font-semibold">Dispatched Orders</h1>
</div>
<x-ordersTable :orders=$dispatchedOrders />
<div class="w-11-12 flex justify-center">
    {{ $dispatchedOrders->appends(['pendings' => $pendingOrders->currentPage(), 'confirmed' => $confirmedOrders->currentPage(), 'ncm' => $ncmOrders->currentPage(), 'delivered' => $deliveredOrders->currentPage()])->onEachSide(0)->links() }}
</div>
<div class="flex justify-between mb-2 mt-10" id="delivered">
    <h1 class="text-2xl font-semibold">Delivered Orders</h1>
</div>
<x-ordersTable :orders=$deliveredOrders />
<div class="w-11-12 flex justify-center">
    {{ $deliveredOrders->appends(['pendings' => $pendingOrders->currentPage(), 'confirmed' => $confirmedOrders->currentPage(), 'ncm' => $ncmOrders->currentPage(), 'dispatched' => $dispatchedOrders->currentPage()])->onEachSide(0)->links() }}
</div>
<div class="hidden">
    <div id="printContent">
        <div class="flex gap-2 flex-wrap justify-center">
            @foreach ($confirmedOrders as $val)
                <div class="border border-slate-800 p-5 w-[3in] text-xs">
                    <img src="{{ asset('img/aphrodite-logo-long.png') }}" alt="" class="w-[2in] mx-auto">
                    <div class="mt-5 flex flex-col gap-2">
                        <p>Name: <span class="font-bold">{{ $val->fullName }}</span></p>
                        <p>Phone: <span class="font-bold">{{ $val->phone }}</span></p>
                        <p>Address: <span class="font-bold">{{ $val->address }}</span></p>
                        <p>Price: <span class="font-bold">{{ $val->total_price - $val->advance }}</span></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
