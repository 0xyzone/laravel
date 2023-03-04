<!DOCTYPE html>
<html lang="en" class="scroll-smooth scroll-pt-32">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <title>
        @if (isset($titlename))
            {{ $titlename }} | KoverUp Portal
        @else
            KoverUp | Show off your style, KoverUp with a smile
        @endif
    </title>
</head>

<body class="bg-gray-50 default-scroll w-screen h-full pb-20">
    {{-- Background --}}
    <div class="w-full h-full bg-black/30 fixed -z-[9] fuss"></div>
    @if (str_contains(url()->current(), '/mobile'))
    @else
        <img src="{{ asset('img/1.jpg') }}" alt="img" class="w-full fixed top-0 object-cover -z-10 h-full">
    @endif
    <x-nav></x-nav>

    <x-flash-error />

    <x-flash-success />
    <div {{ $attributes->merge(['class' => 'w-full h-full']) }}>
        {{ $slot }}
    </div>
    @auth
        {{-- Logout Button --}}
        <a href="{{ route('logout') }}"
            class="w-max rounded-r-full py-2 pl-4 pr-2 fixed bottom-4 bg-white shadow-lg left-0 -translate-x-[4.2rem] flex items-center gap-2 fuss hover:translate-x-0 group"
            onclick="return confirm('Are you sure you want to logout?')">
            <span class="">Logout</span>
            <i class="fa-duotone fa-right-from-bracket"></i>
        </a>
    @endauth
    @auth
    @else
        @if (str_contains(url()->current(), 'login'))
        @else
            <!--Start of Tawk.to Script-->
            {{-- <script type="text/javascript">
                var Tawk_API = Tawk_API || {},
                    Tawk_LoadStart = new Date();
                (function() {
                    var s1 = document.createElement("script"),
                        s0 = document.getElementsByTagName("script")[0];
                    s1.async = true;
                    s1.src = 'https://embed.tawk.to/63b3099cc2f1ac1e202b4857/1glplr30v';
                    s1.charset = 'UTF-8';
                    s1.setAttribute('crossorigin', '*');
                    s0.parentNode.insertBefore(s1, s0);
                })
                ();
            </script> --}}
            <!--End of Tawk.to Script-->
            {{-- <script src="//code.tidio.co/ppp78m65vskhyo8pfx1wlg9tbcdfrzfu.js" async></script> --}}
        @endif
    @endauth
</body>

</html>
