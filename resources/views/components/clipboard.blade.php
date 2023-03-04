<div {{$attributes->merge(['class' => 'w-11/12 lg:w-8/12 h-max bg-white/30 backdrop-blur-lg rounded-lg z-10 flex flex-col items-center pb-10 mt-10'])}}>
    <div
        class="w-max bg-white text-sky-600 flex justify-center rounded-b-lg py-4 px-8 text-2xl lg:text-4xl font-bold h-max">
        {{$clipTag}}
    </div>
    {{$slot}}
</div>
