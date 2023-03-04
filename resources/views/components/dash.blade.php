<x-layout :titlename=$titlename>
    {{-- <div class="lg:hidden flex justify-center items-center h-screen p-5"> --}}
        {{-- <p class="bg-white p-5 text-xl font-bold text-center"><i class="fa-solid fa-warning"></i> Please use a desktop or PC to view this!</p> --}}
        {{-- <script>
            $(document).ready(function() {
                var x = window.matchMedia("(max-width: 450px)")
                myFunction(x) // Call listener function at run time
                x.addListener(myFunction) // Attach listener function on state changes

                function myFunction(x) {
                    if (x.matches) { // If media query matches
                        @if (str_contains(url()->current(), '/mobile'))
                        @else
                            window.location.href = "{{ route('create_orders_mobile') }}";
                        @endif
                    } else {

                    }
                }
            });
        </script> --}}
    </div>
    <div class="w-full flex flex-col container mx-auto gap-4 lg:pt-10 h-max items-center">
        <div class="w-max h-max bg-white fadeInTop block sticky lg:top-16 z-50 shadow-lg">
            @include('_partials.dashmenus')
        </div>
        <div {{ $attributes->merge(['class' => 'w-full h-max bg-white/95 rounded-lg p-4 shadow-lg fadeInBottom']) }}>
            {{ $slot }}
        </div>
    </div>
</x-layout>
