@extends('layouts.navigation')


{{-- @section('content') --}}

<head>
    <title>{{ $product->productName }}</title>
</head>
<script src='https://sticksandbricksshop.com/wp-includes/js/jquery/jquery.min.js?ver=3.6.1' id='jquery-core-js'>
</script>

<body class="w-90">

    {{-- Product Name and Images --}}
    <section class="the-content pt-28">
        <div class="fadeTag mb-4 bg-white text-2xl md:text-3xl lg:text-4xl tracking-wide">
            @if (count($productPaths) > 1)
                <h1 class="font-serif font-bold pl-3 lg:pl-0 text-gray-600">{{ $product->productName }}</h1>
            @else
                <h1 class="font-serif font-bold pl-3 lg:pl-32 text-gray-600">{{ $product->productName }}</h1>
            @endif
        </div>
        <div class="fadeTag2 sab-gal-slider h-72 md:h-128 scale-95 lg:scale-100">
            @if ($productPaths)
                @foreach ($productPaths as $productPath)
                    <img class="first-slide object-cover"src="{{ asset($productPath) }}">
                @endforeach

            @endif
        </div>
    </section>

    {{-- Product Description --}}
    <section class="reveal the-content mt-5 md:mt-32">
        <h1 class="text-sm md:text-base px-6 text-center text-zinc-500">
            {{ $product->productDescription }}</h1>
    </section>
</body>

{{-- Assists Description animation --}}
<script>
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");
        var reveals2 = document.querySelectorAll(".reveal2");

        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 25;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            } else {
                reveals[i].classList.remove("active");
            }
        }

        for (var i = 0; i < reveals2.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 100;

            reveals2[i].classList.add("active");

        }
    }

    window.addEventListener("scroll", reveal);
</script>

{{-- Allows for fade-in and scroll animations --}}
<style>
    .fadeTag {
        opacity: 0;
        animation: fadeInAnimation ease 1s;
        animation-delay: 0.25s;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
    }

    .fadeTag2 {
        opacity: 0;
        animation: fadeInAnimation ease 1.75s;
        animation-delay: 0.5s;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
    }

    @keyframes fadeInAnimation {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }


    .reveal {
        position: relative;
        transform: translateY(200px);
        opacity: 0;
        /* transition: 1s all ease; */
    }

    .reveal.active {
        transform: translateY(0);
        opacity: 1;
        transition: 1s all ease;
    }
</style>

{{-- Need these styles for slide show --}}
<link rel='stylesheet' id='custom-google-fonts-css'
    href='https://fonts.googleapis.com/css2?family=Libre+Franklin%3Aital%2Cwght%400%2C300%3B0%2C400%3B0%2C500%3B0%2C700%3B1%2C400&#038;display=swap&#038;ver=6.1.1'
    media='all' />

{{-- --------------------------------------THESE ARE WHAT IS NEEDED TO RESTYLE SLIDE SHOW ---------------------------- --}}
<link rel='stylesheet' id='sticksbricks2020-style-css' href="{{ asset('style/slide-show-style.css') }}"
    media='all' />
<link rel='stylesheet' id='snap-slick-css-css' href="{{ asset('style/slide-show-slick.css') }}" media='all' />
<link rel='stylesheet' id='snap-slick-theme-css' href="{{ asset('style/slide-show-slick.css') }}" media='all' />
<link rel='stylesheet' id='snap-slick-theme-css' href="{{ asset('style/slide-show-slick-theme.css') }}"
    media='all' />
<link rel='stylesheet' id='jetpack_css-css'
    href='https://sticksandbricksshop.com/wp-content/plugins/jetpack/css/jetpack.css?ver=11.6' media='all' />


{{-- Need these scripts for slide show --}}

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src='https://sticksandbricksshop.com/wp-content/themes/sticksbricks2020/js/site.js?ver=1.0.0'
    id='site-scripts-js'></script>
<script src="https://use.fontawesome.com/7158d6ea68.js"></script>

@extends('layouts.footer')
