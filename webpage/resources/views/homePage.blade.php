{{-- ----------------------------------- --}}
{{-- --- BELOW IS THE HOMEPAGE CODE ---- --}}
{{-- ----------------------------------- --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="style/homePageHamburger.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="style/imageDivider.css?v=<?php echo time(); ?>" type="text/css">
    <link rel="stylesheet" href="style/businessLogo.css?v=<?php echo time(); ?>" type="text/css">

    {{-- Allows for Header text fade-in as well as About scroll animation --}}
    <link rel="stylesheet" href="style/fadeIn.css?v=<?php echo time(); ?>" type="text/css">

    <title>L7 Wood Working</title>

    @vite('resources/css/app.css')
</head>


<body class="antialiased bg-[#FCFBF4]">
    <header class="stick top-0">
        <div class="banner h-132">
            {{-- <img src="{{ asset('images/IMG_0030.JPG') }}" class="w-full h-132 object-cover brightness-50"> --}}
            <video autoplay muted loop id="myVideo" class="w-full h-132 object-cover brightness-30">
                <source src="{{ asset('images/L7_Banner.mp4') }}" type="video/mp4">
            </video>
            <!-- TITLE OF BUSINESS -->

            {{-- -------------------------- --}}
            {{-- --- L7 SVG FOR MOBILE ---- --}}
            {{-- -------------------------- --}}
            <div class="fadeTag absolute flex items-center font-fellPica text-[#FCFBF4] top-6 left-8 md:top-3 md:left-12 lg:top-28 lg:left-0 lg:justify-center lg:w-full lg:hidden"
                id="homePageTitle">
                <div>
                    <h1 class="text-[55px] md:text-[85px] lg:text-[180px]">L7</h1>
                </div>
                <div>
                    <h1 class="sticky top-0 text-[22px] tracking-wide ml-2 md:text-3xl md:ml-2 md:mt-3">woodworking
                    </h1>
                </div>
            </div>
        </div>
        <div class="absolute flex lg:top-0 lg:h-132 items-center lg:justify-center lg:w-full">
            <div class=" font-fellPica text-[#FCFBF4] top-6 left-8 md:top-3 md:left-12 w-1/3" id="homePageTitle">
                <div class="">
                    <div class="svgWoodWorkingFadeIn flex justify-center items-center -mt-5">
                        <h1 class="hidden lg:block text-[125px] tracking-wide md:mt-10 lg:mt-0">L7</h1>
                        <h1 class="hidden lg:block text-[22px] tracking-wide ml-2 md:text-3xl md:mt-20 lg:mt-5">
                            woodworking
                        </h1>
                    </div>
                    {{-- An image divider, separating the Business Logo/Name and Tabs --}}
                    <div class="svgBreakFadeIn w-full flex justify-center -mt-28 scale-75">
                        <img src="{{ asset('images/Header_Divider.png') }}"
                            class="hidden lg:block w-96 -mt-8 scale-125 filter: invert scale-85" />
                    </div>
                    <!--Website Options, i.e. Gallery and About -->
                    <div
                        class="svgTabFadeIn -mt-16 hidden absolute text-center lg:block text-[#FCFBF4] font-poppins text-[18px] tracking-wide w-1/3">
                        <div class="flex justify-center" id="homePageOptions">
                            <div id='col' class="-ml-3">
                                <h3 class="hover:text-gray-300 "><a href="{{ url('/products') }}">Gallery</a></h3>
                            </div>
                            <div id='col' class="ml-14">
                                <h3 class="hover:text-gray-300"><a href="#About" onclick="">About</a></h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- <div class="svgBreakFadeIn w-full flex justify-center -mt-28">
            <img src="{{ asset('images/Header_Divider.png') }}"
                class="hidden lg:block w-96 absolute -mt-72 scale-125 filter: invert" />
        </div> --}}

        </div>

        {{-- Once the screen is small enough the Hamburger menu icon and its functionality appears --}}
        <div class="fadeTag top-14 right-4 md:top-16 md:right-2 text-white font-poppins text-[18px] lg:hidden"
            id='dropDownContainer'>
            <div onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
                <ul id="menu">
                    <li>
                        <ul>
                            <li id="link" class="my-8"><a href="{{ url('/products') }}">Gallery</a></li>
                            <li id="link" class="mt-3"><a href="#about">About</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        {{-- This script is used for Hamburger button click animation --}}
        <script src="{{ asset('js/hamburgerButtonClickAnimation.js') }}"></script>

    </header>

    {{-- An image of the owner's work which also serves as a divider between the header and about sections --}}
    {{-- <section class="mt-128 mb-96 brightness-75 lg:mt-132 lg:pt-44">
        <div class="h-60 lg:h-72 bg-fixed fixed-bg brightness-75"></div>
    </section> --}}

    {{-- Used for the image divider --}}
    <style>
        .fixed-bg {
            background-image: url("images/ownersProductDivider.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    {{-- ABOUT Section used for mobile/tablet devices --}}
    <div class="hideme block lg:hidden">
        <section id='about' name='about' class="reveal justify-center items-center h-full mt-20 md:mt-28">
            <div class="bg-zinc-900 h-1/4 rounded-r-full drop-shadow-lg">
                <div class="w-full h-1/4 mr-20">
                    <img src="/images/BrianWilsonAbout.png"
                        class="w-1/4 h-16 md:h-24 object-cover rounded-r-full border-r-4 border-r-[#228280]">
                    <h1
                        class="absolute -mt-12 md:-mt-16 text-[#FCFBF4] right-16 md:right-24 font-bold text-xl md:text-2xl">
                        Brian & Wilson</h1>
                </div>
            </div>

            <div class="text-gray-600 mt-8 mx-8">
                <p>L7 woodworking was established by Brian Wolak in 2021. He has an at home workshop, residing in New Britain,
                    CT. a.k.a "Hardware City". L7 woodworking creates unique handmade
                    products, ranging from furniture to decorative and collective pieces. </p>
                <br>
                <p>
                    When Brian is not in the shop he can mostly be found hanging out with his American dingo,
                    Wilson, the potato, or in the kitchen cooking while blasting music.
                </p>
                <br>
                <p>
                    You might be asking, “Why L7 woodworking?”.
                    Make a L with one hand... Now, a 7 with the other and put them together… We square now?
                </p>
            </div>
        </section>
    </div>

    {{-- ABOUT Section used for larger screens --}}
    <div class="hidden lg:block bg-[#FCFBF4]">
        <section id='About' name='About' class="reveal flex justify-center h-screen">
            <div class="mx-80 grid grid-cols-2 gap-4 place-content-center">
                <div class="text-gray-600">
                    <h1 class="font-bold text-3xl text-gray-700 mb-5">Brian & Wilson</h1>
                    <p>L7 woodworking was established by Brian Wolak in 2021. He has an at home workshop, residing in New Britain,
                        CT. a.k.a "Hardware City". L7 woodworking creates unique handmade
                        products, ranging from furniture to decorative and collective pieces. </p>
                    <br>
                    <p>
                        When Brian is not in the shop he can mostly be found hanging out with his American dingo,
                        Wilson, the potato, or in the kitchen cooking while blasting music.
                    </p>
                    <br>
                    <p>
                        You might be asking, “Why L7 woodworking?”.
                        Make a L with one hand... Now, a 7 with the other and put them together… We square now?
                    </p>
                </div>
                <div class="rounded-sm ml-20">
                    <div class="w-full mr-20"><img src="/images/BrianWilsonAbout.png"
                            class="w-full object-cover grayscale rounded-l-sm"></div>
                </div>
            </div>
        </section>
    </div>
    @extends('layouts.footer')
</body>

</html>

{{-- Used to assist animation when presenting About once user scrolls to section --}}
<script src="{{ asset('js/scrollAnimation.js') }}"></script>
