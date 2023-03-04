<x-layout :titlename=$titlename>

    {{-- Content --}}
    <div class="flex flex-col w-full h-full items-center gap-4 mt-5">
        <div class="p-4 bg-white rounded-lg shadow-lg w-11/12 lg:w-8/12 fadeInTop">
            <h1 class="font-bold text-lg lg:text-2xl text-center">Thank you for taking part in quiz.</h1>
            <p class="text-center mt-2">Continue watching part 2</p>
        </div>

        <div
            class="w-full lg:w-8/12 bg-white rounded-lg flex flex-col text-center items-center lg:p-2 shadow-lg fadeInBottom fuss">
            <div id="player" class="w-full aspect-video"></div>
        </div>

        {{-- Products --}}
        <div class="lg:w-8/12 w-10/12 rounded-lg flex-wrap lg:flex-nowrap bg-gray-200 fuss gap-4 p-4 fadeInBottom justify-center items-center flex-col flex"
            id="products">
            <img src="{{ asset('img/product.png') }}" alt="product img" class="w-8/12 lg:w-4/12">
            <h1 class="lg:text-2xl text-xl font-bold text-center">30 days weight loss challenge</h1>
            <button id="order_now" class="btn-primary">Order Now</button>
            {{-- <h1 class="lg:text-2xl text-center">If you want to make purchase contact us through any of the following
                options</h1>
            <div class="flex gap-2 justify-center items-center text-sky-600">
                <a href="https://m.me/101666456128143"><i class="fa-brands fa-facebook-messenger fa-2x"></i></a>
                <a href="https://wa.me/aphrodite.nepal"><i class="fa-brands fa-whatsapp fa-2x"></i></a>
                <a href="#"><i class="fa-brands fa-viber fa-2x"></i></a>
                <a href="https://www.instagram.com/aphrodite.np3/"><i class="fa-brands fa-instagram fa-2x"></i></a>
                <a href="tel:+9779825802747"><i class="fa-solid fa-phone-rotary fa-2x"></i></a>
            </div> --}}
            <form action="{{ route('place_order') }}" method="post"
                class="lg:space-x-4 fadeInBottom flex flex-col lg:flex-row" id="leads">
                @csrf
                <div>
                    <input type="text" name="name" id="name" placeholder="Your name" class="custom-input">
                    @error('name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="number" name="phone" id="phone" placeholder="Contact Number"
                        class="custom-input">
                    @error('phone')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="text" name="address" id="address" placeholder="Address" class="custom-input">
                    @error('address')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn-secondary mt-2 lg:mt-0">Submit</button>
            </form>
            <script>
                $(document).ready(function() {
                    $("#products").hide();
                    $("#leads").hide();
                });
                $("#order_now").click(function() {
                    $("#leads").show();
                    $("#order_now").hide();
                });
            </script>
        </div>

    </div>
    {{-- Content end --}}

</x-layout>

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
            videoId: 'FR72RCc_Oog',
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
            setTimeout(showProducts, 120000);
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
