<x-layout :titlename=$titlename>
    <div class="flex flex-col w-full h-full items-center gap-4">
        <x-clipboard clipTag='Successful!' class="px-4 pb-16 bg-sky-700">
            <div class="lg:w-4/12 w-8/12">
                @include('_partials.purchaseSuccess')
            </div>

            <h1 class="text-xl text-white">Thank you for purchasing!</h1>
            <p class="text-white mt-2 text-center">Your purchase has been processed successfully. One of our staff member shall contact you shorly. <br> Please stay available with the contact details that you have provided to us.
            </p><br>
            <p class="text-lg text-white text-center">If you have any queries or need more information, please call on the following number
            </p>
            <div
                class="text-white font-bold text-2xl text-center absolute -bottom-12 p-5 rounded-lg bg-slate-800 flex items-center gap-2">
                <i class="fa-duotone fa-phone-arrow-up-right fa-2x lg:!hidden"></i>
                <i class="fa-duotone fa-phone-arrow-up-right lg:!block !hidden"></i>
                <p class="">+977
                    982-5802747 <br class="lg:hidden"> +977 984-0163850</p>
            </div>
        </x-clipboard>
    </div>
</x-layout>
