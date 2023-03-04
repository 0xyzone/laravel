<nav class="bottom-10 fixed max-w-md z-[999] text-center flex">
    {{-- Logo start --}}
    <img src="{{ asset('img/aphrodite-logo.png') }}" alt="logo" class="w-20 aspect-auto rounded-full bg-blend-color-dodge">
    {{-- Logo end --}}
    <div
        class="container mx-auto justify-between flex p-2 items-center h-full bg-gray-100/30 shadow-lg rounded-full px-4 backdrop-blur-xl text-neutral-300">
        {{-- menu items start --}}
        <div class="flex gap-4 text-xl font-bold">
            <a id="herobtn" href="#hero" class="nav-btn"><i class="fa-duotone fa-calculator-simple"></i><span
                    class="text-xs flex-shrink-0 w-max">BMI Calc</span></a>
            <a id="aboutbtn" href="#about" class="nav-btn"><i class="fa-duotone fa-id-card-clip"></i><span
                    class="text-xs flex-shrink-0 w-max">About Us</span></a>
            <a id="contactbtn" href="#contact" class="nav-btn"><i class="fa-duotone fa-at"></i><span
                    class="text-xs flex-shrink-0 w-max">Contact</span></a>
        </div>
        {{-- menu items end --}}
    </div>
</nav>
