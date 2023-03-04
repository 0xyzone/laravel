<x-layout :titlename=$titlename>

    {{-- Content --}}
    <div class="flex flex-col w-full h-full items-center gap-4">
        @if (session()->has('bmi'))
            <x-clipboard clipTag='Your Result' class="fadeInTop">
                <div class="flex flex-col gap-2 justify-center items-center">
                    <p class="text-9xl font-bold text-white" id="count">
                        {{ session('bmi') }}<span class="text-2xl">kg/m<sup>2</sup></span>
                    </p>
                    <span class="text-2xl text-white">{{ session('result') }}</span>
                </div>
            </x-clipboard>
            <div
                class="w-11/12 lg:w-8/12 bg-white rounded-lg flex flex-col text-center items-center pb-10 pt-6 shadow-lg fadeInBottom">
                <span class="text-4xl text-center font-bold p-4 text-sky-600">Get free weight loss counseling</span>
                <span class="text-xl px-1.5 lg:px-0">Know more about your BMI & Obeseity </span>
                <span class="text-sm text-gray-500">Consultation by our dietitian </span>
            </div>
                <div id="player" class="w-full aspect-video mt-5 lg:w-8/12"></div>

            {{-- Products --}}
            <div id="products"
                class="lg:w-8/12 w-10/12 rounded-lg flex-wrap lg:flex-nowrap hidden bg-gray-200 fuss gap-4 p-4 fadeInBottom justify-center">
                <div class="flex flex-col gap-2">
                    <h1 class="text-xl font-bold text-center">
                        Take a quiz
                    </h1>
                    <div class="flex justify-between mb-1">
                        <span class="text-base font-medium text-sky-700">Progress</span>
                        <span class="text-sm font-medium text-sky-700 fuss" id="percent">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-400">
                        <div class="bg-sky-600 h-2.5 rounded-full fuss" style="width: 2%" id="bar"></div>
                    </div>
                </div>
                <div id="q1" class="mt-4 text-2xl flex flex-col gap-2 items-center">
                    <p>के तपाई दैनिक exercise गर्नुहुन्छ?</p>
                    <div class="flex gap-2 text-lg">
                        <button id="op1" class="btn-primary">Yes</button>
                        <button id="op2" class="btn-primary">No</button>
                    </div>
                </div>
                <div id="q2" class="mt-4 text-2xl flex flex-col gap-2 items-center">
                    <p>के तपाईलाई कुनै स्वास्थ्य समस्या छ?</p>
                    <div class="flex gap-2 text-lg">
                        <button id="op3" class="btn-primary">Yes</button>
                        <button id="op4" class="btn-primary">No</button>
                    </div>
                </div>
                <div id="q3" class="mt-4 text-2xl flex flex-col gap-2 items-center">
                    <p>तपाई कति वजन घटाउन चाहनुहुन्छ?</p>
                    <div class="flex gap-2 flex-col lg:flex-row text-lg">
                        <button id="op5" class="btn-primary">5 ~ 10 Kg</button>
                        <button id="op6" class="btn-primary">10 ~ 25 Kg</button>
                        <button id="op7" class="btn-primary">25 ~ 30+ Kg</button>
                    </div>
                </div>
                <div id="q4" class="mt-4 text-xl flex flex-col gap-2 items-center">
                    <p>तपाईं आफ्नो शरीरको कुन भागको Fat burn गर्न चाहनुहुन्छ?</p>
                    <div class="flex flex-col lg:flex-row gap-2 items-center justify-center">
                        <a href="{{ route('result2') }}"
                            class="rounded-lg bg-white shadow-lg p-2 flex flex-col gap-2 text-center justify-center items-center w-6/12 lg:w-4/12">
                            <img src="{{ asset('img/fat1.png') }}" alt="belly fat image" class="">
                            <span>Belly/पेट</span>
                        </a>
                        <a href="{{ route('result2') }}"
                            class="rounded-lg bg-white shadow-lg p-2 flex flex-col gap-2 text-center justify-center items-center w-6/12 lg:w-4/12">
                            <img src="{{ asset('img/fat2.png') }}" alt="whole body image" class="">
                            <span>Whole Body/पूरा शरीर</span>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Products end --}}
        @else
            <div
                class="w-max rounded-lg flex flex-col lg:flex-nowrap bg-gray-200 fuss gap-4 p-4 fadeInBottom items-center mt-10 text-2xl">
                <p>Calculate your BMI first</p>
                <a href="{{ route('home') }}" class="btn-primary">Take me there!</a>
            </div>
        @endif
    </div>
    {{-- Content end --}}
</x-layout>

<script>
    $(document).ready(function() {
        $("#q2").hide();
        $("#q3").hide();
        $("#q4").hide();
    });

    $("#op1").click(function() {
        $("#bar").css('width', '25%');
        $("#percent").html("25%");
        $("#q1").hide();
        $("#q2").show();
    });
    $("#op2").click(function() {
        $("#bar").css('width', '25%');
        $("#percent").html("25%");
        $("#q1").hide();
        $("#q2").show();
    });
    $("#op3").click(function() {
        $("#bar").css('width', '50%');
        $("#percent").html("50%");
        $("#q2").hide();
        $("#q3").show();
    });
    $("#op4").click(function() {
        $("#bar").css('width', '50%');
        $("#percent").html("50%");
        $("#q2").hide();
        $("#q3").show();
    });
    $("#op5").click(function() {
        $("#bar").css('width', '75%');
        $("#percent").html("75%");
        $("#q3").hide();
        $("#q4").show();
    });
    $("#op6").click(function() {
        $("#bar").css('width', '75%');
        $("#percent").html("75%");
        $("#q3").hide();
        $("#q4").show();
    });
</script>
<script>
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '100%',
            width: '100%',
            videoId: '7NidPMujl68',
            playerVars: {
                'playsinline': 1,
                'controls': 0,
                'rel': 0
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
            var time = player.getCurrentTime();
            setTimeout(showProducts, 30000);
            done = true;
        }
    }

    function stopVideo() {
        player.stopVideo();
        console.log(time);
    }

    function showProducts() {
        $('#products').show();
        console.log(time);
    }
</script>
